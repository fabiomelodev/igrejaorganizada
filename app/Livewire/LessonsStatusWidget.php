<?php

namespace App\Livewire;

use App\Models\Lesson;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LessonsStatusWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $lessonsCourseCount = Lesson::query()->active()->where('progress', 'course')->count();

        $lessonsFinishedCount = Lesson::query()->active()->where('progress', 'finished')->count();

        return [
            Stat::make('Classe(s) cursando(s)', $lessonsCourseCount),
            Stat::make('Classe(s) finalizada(s)', $lessonsFinishedCount),
        ];
    }
}
