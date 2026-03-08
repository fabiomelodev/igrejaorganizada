<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends ModelBase
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->is_active = 1;
        });
    }

    public function modalities(): HasMany
    {
        return $this->hasMany(Modality::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_projects', 'project_id', 'team_id');
    }
}
