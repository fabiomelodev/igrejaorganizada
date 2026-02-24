<?php

namespace App\Policies;

use App\Constants\FeatureKey;
use App\Models\User;
use Filament\Facades\Filament;

class BasePolicy
{
    protected static string|null $module = null;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function viewAny(User $user): bool
    {
        return Filament::getTenant()->hasFeature(static::$module);
    }

    public function create(User $user): bool
    {
        return Filament::getTenant()->hasFeature(static::$module);
    }

    public function update(User $user): bool
    {
        return Filament::getTenant()->hasFeature(static::$module);
    }

    public function delete(User $user): bool
    {
        return Filament::getTenant()->hasFeature(static::$module);
    }
}
