<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Participant extends ModelBase
{
    protected $casts = [
        'birthdate' => 'datetime',
        'is_active' => 'boolean',
        'is_internal' => 'boolean',
        'health_reports' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->is_active = (int) $model->is_active;

            if (Filament::getTenant()) {
                $model->team_id = Filament::getTenant()->id;
            }

            if ($model->member_id) {
                $member = Member::find(1);

                $model->name = $member->name;

                $model->birthdate = $member->birthdate;

                $model->email = $member->email;

                $model->phone = $member->phone;
            }
        });

        static::updating(function (Model $model) {
            $model->is_active = (int) $model->is_active;

            if (Filament::getTenant()) {
                $model->team_id = Filament::getTenant()->id;
            }
        });
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function frequencables(): MorphMany
    {
        return $this->morphMany(Frequency::class, 'frequencable');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(Responsible::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_participants', 'participant_id', 'team_id');
    }
}
