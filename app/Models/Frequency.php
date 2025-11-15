<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Frequency extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'date' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->church_id = Filament::getTenant()->id;
        });

        static::updating(function ($model) {
            $model->church_id = Filament::getTenant()->id;
        });
    }

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'frequency_students', 'frequency_id', 'member_id');
    }
}
