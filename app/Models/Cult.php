<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cult extends ModelBase
{
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_cults', 'cult_id', 'team_id');
    }
}
