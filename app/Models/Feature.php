<?php

namespace App\Models;

use App\Constants\FeatureKey;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($feature) {
            $feature->name = FeatureKey::all()[$feature->key] ?? $feature->key;
        });

        static::updating(function ($feature) {
            $feature->name = FeatureKey::all()[$feature->key] ?? $feature->key;
        });
    }
}
