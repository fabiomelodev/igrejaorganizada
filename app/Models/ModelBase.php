<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelBase extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->status = (int) $model->status;

            $model->church_id = Filament::getTenant()->id;
        });

        static::updating(function ($model) {
            $model->status = (int) $model->status;

            $model->church_id = Filament::getTenant()->id;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeChurchCurrent($query)
    {
        return $query->where('church_id', Filament::getTenant()->id);
    }

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}
