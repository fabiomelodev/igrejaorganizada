<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Frequency extends Model
{
    protected $guarded = ['id'];

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

    protected function totalParticipants(): Attribute
    {
        return Attribute::make(
            get: fn(): int|string => $this->participants()->count(),
        );
    }

    public function frequencable(): MorphTo
    {
        return $this->morphTo();
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Participant::class, 'frequency_participants', 'frequency_id', 'participant_id');
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
