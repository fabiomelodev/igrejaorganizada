<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends ModelBase
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->status = 1;
        });

        static::deleted(function ($model) {
            $model->members()->each(function ($member) {
                $member->position_id = 1;

                $member->save();
            });
        });
    }

    public function isVisitor(): bool
    {
        if ($this->name === 'Visitante')
            return true;

        return false;
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
