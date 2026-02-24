<?php

namespace App\Policies;

use App\Constants\FeatureKey;

class LessonPolicy extends BasePolicy
{
    protected static string|null $module = FeatureKey::LESSON_MODULE;
}
