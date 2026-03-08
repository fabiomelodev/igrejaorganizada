<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Modality extends ModelBase
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'schedules' => 'array'
    ];

    public function frequencies(): MorphMany
    {
        return $this->morphMany(Frequency::class, 'frequencable');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Participant::class, 'modality_participants', 'modality_id', 'participant_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_modalities', 'modality_id', 'team_id');
    }
}
