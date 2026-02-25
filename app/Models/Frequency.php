<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Frequency extends Model
{
    protected $fillable = [
        'date',
        'team_id',
        'lesson_id'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

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

    protected function totalStudents(): Attribute
    {
        return Attribute::make(
            get: fn(): int|string => $this->students()->count(),
        );
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'frequency_students', 'frequency_id', 'member_id');
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_frequencies', 'frequency_id', 'team_id');
    }
}
