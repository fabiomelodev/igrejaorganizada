<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelBase extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->is_active = (int) $model->is_active;

            if (Filament::getTenant()) {
                $model->team_id = Filament::getTenant()->id;
            }
        });

        static::updating(function (Model $model) {
            $model->is_active = (int) $model->is_active;

            if (Filament::getTenant()) {
                $model->team_id = Filament::getTenant()->id;
            }
        });
    }

    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
