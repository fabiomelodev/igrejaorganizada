<?php

namespace App\Filament\Resources\Lessons\Pages;

use App\Constants\FeatureKey;
use App\Filament\Resources\Lessons\LessonResource;
use App\Filament\Pages\BaseCreateRecord;

class CreateLesson extends BaseCreateRecord
{
    protected static string $resource = LessonResource::class;

    protected static string|null $moduleLimit = FeatureKey::LESSON_LIMIT;
}
