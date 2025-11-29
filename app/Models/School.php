<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class School extends ModelBase
{
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_schools', 'school_id', 'team_id');
    }
}
