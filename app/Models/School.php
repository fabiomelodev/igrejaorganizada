<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends ModelBase
{
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_schools', 'school_id', 'team_id');
    }
}
