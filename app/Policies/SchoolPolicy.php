<?php

namespace App\Policies;

use App\Constants\FeatureKey;
use App\Models\User;

class SchoolPolicy extends BasePolicy
{

    protected static string|null $module = FeatureKey::SCHOOL_MODULE;
}
