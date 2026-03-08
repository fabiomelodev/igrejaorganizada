<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Responsible extends ModelBase
{
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_responsibles', 'responsible_id', 'team_id');
    }
}
