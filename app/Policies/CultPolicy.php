<?php

namespace App\Policies;

use App\Constants\FeatureKey;

class CultPolicy extends BasePolicy
{
    protected static string|null $module = FeatureKey::CULT_MODULE;
}
