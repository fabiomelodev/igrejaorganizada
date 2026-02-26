<?php

namespace App\Models;

use App\Constants\FeatureKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;

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

    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    public function scopeIsInactive(Builder $query): Builder
    {
        return $query->where('is_active', 0);
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

    public function hasReachedLimit(string $featureKey): bool
    {
        $feature = $this->plan->features()
            ->where('key', $featureKey)
            ->first();

        if (!$feature) {
            return true;
        }

        $limit = (int) $feature->pivot->value;

        if ($limit === -1 || $limit >= 999999) {
            return false;
        }

        $currentCount = match ($featureKey) {
            FeatureKey::CULT_LIMIT => $this->cults()->count(),
            FeatureKey::LESSON_LIMIT => $this->lessons()->count(),
            FeatureKey::MEMBER_LIMIT => $this->members()->count(),
            FeatureKey::MODALITY_LIMIT => $this->modalities()->count(),
            FeatureKey::SCHOOL_LIMIT => $this->schools()->count(),
            FeatureKey::PROJECT_LIMIT => $this->projects()->count(),
            default => 0,
        };

        return $currentCount >= $limit;
    }

    public function getCurrentCount(string $featureKey): int
    {
        $cacheKey = "church_{$this->id}_count_{$featureKey}";

        return cache()->remember($cacheKey, now()->addDay(), function () use ($featureKey) {
            return match ($featureKey) {
                FeatureKey::CULT_LIMIT => $this->cults()->count(),
                FeatureKey::LESSON_LIMIT => $this->lessons()->count(),
                FeatureKey::MEMBER_LIMIT => $this->members()->count(),
                FeatureKey::MODALITY_LIMIT => $this->modalities()->count(),
                FeatureKey::SCHOOL_LIMIT => $this->classes()->count(),
                FeatureKey::PROJECT_LIMIT => $this->projects()->count(),
                default => 0,
            };
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withoutGlobalScopes();
    }

    public function cults(): BelongsToMany
    {
        return $this->belongsToMany(Cult::class, 'team_cults', 'team_id', 'cult_id');
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'team_lessons', 'team_id', 'lesson_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'team_members', 'team_id', 'member_id');
    }

    public function modalities(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'team_modalities', 'team_id', 'modality_id');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'team_projects', 'team_id', 'project_id');
    }

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class, 'team_schools', 'team_id', 'school_id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'team_id')->orderBy('created_at', 'desc');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id');
    }
}
