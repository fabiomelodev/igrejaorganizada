<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Church extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function scopeAuthUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    // public function scopeChurchAuth()
    // {
    //     return Church::find(Auth::user()->churches()->first()->id);
    // }

    public function lessons(): MorphToMany
    {
        return $this->morphedByMany(Lesson::class, 'churchable');
    }

    public function members(): MorphToMany
    {
        return $this->morphedByMany(Member::class, 'churchable');
    }

    public function positions(): MorphToMany
    {
        return $this->morphedByMany(Position::class, 'churchable');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
