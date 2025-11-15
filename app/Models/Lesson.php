<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends ModelBase
{
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

    public function frequencies(): HasMany
    {
        return $this->hasMany(Frequency::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'lesson_students', 'lesson_id', 'member_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'teacher_id');
    }
}
