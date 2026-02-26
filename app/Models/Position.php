<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends ModelBase
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->is_active = 1;
        });

        static::deleted(function (Model $model) {
            $model->members()->each(function ($member) {
                $member->position_id = 1;

                $member->save();
            });
        });
    }

    public function isMember(): bool
    {
        if ($this->name === 'Membro')
            return true;

        return false;
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_positions', 'position_id', 'team_id');
    }
}
