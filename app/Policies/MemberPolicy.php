<?php

namespace App\Policies;

use App\Constants\FeatureKey;
use App\Models\Member;
use App\Models\User;
use Filament\Facades\Filament;

class MemberPolicy
{
    public function viewAny(User $user): bool
    {
        return Filament::getTenant()->hasFeature(FeatureKey::MEMBER_MODULE);
    }


    public function create(User $user): bool
    {
        return Filament::getTenant()->hasFeature(FeatureKey::MEMBER_MODULE);
    }

    public function update(User $user, Member $member): bool
    {
        return Filament::getTenant()->hasFeature(FeatureKey::MEMBER_MODULE);
    }

    public function delete(User $user, Member $member): bool
    {
        return Filament::getTenant()->hasFeature(FeatureKey::MEMBER_MODULE);
    }
}