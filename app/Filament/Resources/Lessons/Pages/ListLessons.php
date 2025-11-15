<?php

namespace App\Filament\Resources\Lessons\Pages;

use App\Filament\Resources\Lessons\LessonResource;
use App\Livewire\LessonsStatusWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Classe')
                ->icon('heroicon-o-plus')
        ];
    }

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
