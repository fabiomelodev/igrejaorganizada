<?php

namespace App\Filament\Resources\Lessons\Pages;

use App\Filament\Resources\Lessons\LessonResource;
use App\Filament\Resources\Pages\BaseListRecords;
use App\Livewire\LessonsStatusWidget;
use Filament\Actions\CreateAction;

class ListLessons extends BaseListRecords
{
    protected static string $resource = LessonResource::class;

    public function getHeaderWidgetsColumns(): int | array
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
