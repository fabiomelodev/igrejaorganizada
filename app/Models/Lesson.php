<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        $frequenciesByStudentsCount = [];

        $frequencies = Frequency::with('lesson')->whereHas('lesson', function (Builder $query) use ($record): Builder {
            return $query->where('lessons.id', $record->id);
        })->get();

        foreach ($frequencies as $frequency) {
            array_push($frequenciesByStudentsCount, $frequency->students()->count());
        }

        $frequenciesByStudentsCount = array_sum($frequenciesByStudentsCount);

        $frequenciesCount = $record->frequencies()->count();

        $studentsCount = $record->students()->count();

        $expectedPresenceTotal = $frequenciesCount * $studentsCount;

        return number_format(($frequenciesByStudentsCount / $expectedPresenceTotal) * 100, 2, '.', '');

    }

    public function frequencies(): HasMany
    {
        return $this->hasMany(Frequency::class);
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
