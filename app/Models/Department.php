<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Department extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);

            $model->status = (int) $model->status;
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);

            $model->status = (int) $model->status;
        });
    }
}
