<?php

namespace App\Models;

use App\Constants\FeatureKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

class Team extends Model
{
    use Billable;

    protected $guarded = ['id'];

    protected $casts = ['is_active' => 'boolean'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function hasFeature(string $featureKey): bool
    {
        $feature = $this->plan->features->where('key', $featureKey)->first();

        if (!$feature)
            return false;

        return $feature->pivot->value === '1' || (int) $feature->pivot->value > 0;
    }

    public function getLimit(string $featureKey): int
    {
        $feature = $this->plan->features->where('key', $featureKey)->first();

        return $feature ? (int) $feature->pivot->value : 0;
    }

    public function hasReachedLimit(string $limitKey): bool
    {
        $feature = $this->plan->features->where('key', $limitKey)->first();

        if (!$feature) {
            return false;
        }

        $limit = (int) $feature->pivot->value;


        if ($limit === 0)
            return true;

        return $this->getCurrentCount($limitKey) >= $limit;
    }

    public function getCurrentCount(string $featureKey): int
    {
        $cacheKey = "church_{$this->id}_count_{$featureKey}";

        return cache()->remember($cacheKey, now()->addDay(), function () use ($featureKey) {
            return match ($featureKey) {
                FeatureKey::MEMBER_LIMIT => $this->members()->count(),
                FeatureKey::SCHOOL_LIMIT => $this->classes()->count(),
                default => 0,
            };
        });
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'team_lessons', 'team_id', 'lesson_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'team_members', 'team_id', 'member_id');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id');
    }
}
