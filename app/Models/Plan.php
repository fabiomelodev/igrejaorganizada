<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    protected $guarded = ['id'];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'plan_features', 'plan_id', 'feature_id')->withPivot('value')->withTimestamps();
    }
}
