<?php

namespace App\Filament\Resources\Lessons\Pages;

use App\Constants\FeatureKey;
use App\Filament\Resources\Lessons\LessonResource;
use App\Filament\Pages\BaseListRecords;
use App\Livewire\LessonsStatusWidget;

class ListLessons extends BaseListRecords
{
    protected static string $resource = LessonResource::class;

    protected static string|null $moduleLimit = FeatureKey::LESSON_LIMIT;

    public function getHeaderWidgetsColumns(): int|array
    {
        return 3;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LessonsStatusWidget::class,
        ];
    }
}
