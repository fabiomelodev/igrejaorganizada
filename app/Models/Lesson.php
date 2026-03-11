<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Lesson extends ModelBase
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->team_id = Filament::getTenant()->id;
        });

        static::updating(function ($model) {
            $model->team_id = Filament::getTenant()->id;
        });
    }

    public static function presenceAverage(Model $record): float|int
    {
        $frequencies = $record->frequencies();

        if ($frequencies->exists()) {
            $frequenciesByStudentsCount = [];

            foreach ($frequencies->get() as $frequency) {
                array_push($frequenciesByStudentsCount, $frequency->students()->isActive()->whereHas('lessons')->count());
            }

            $frequenciesByStudentsCount = array_sum($frequenciesByStudentsCount);


            $frequenciesCount = $record->frequencies()->count();

            $studentsCount = $record->students()->count();

            $expectedPresenceTotal = $frequenciesCount * $studentsCount;

            return number_format(($frequenciesByStudentsCount / $expectedPresenceTotal) * 100, 2, '.', '');
        }

        return 0;
    }

    public function frequencies(): MorphMany
    {
        return $this->morphMany(Frequency::class, 'frequencable');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'lesson_students', 'lesson_id', 'member_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'teacher_id');
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_lessons', 'lesson_id', 'team_id');
    }
}
