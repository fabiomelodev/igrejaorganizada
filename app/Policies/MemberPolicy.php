<?php

namespace App\Policies;

use App\Constants\FeatureKey;

class MemberPolicy extends BasePolicy
{
    protected static string|null $module = FeatureKey::MEMBER_MODULE;
}