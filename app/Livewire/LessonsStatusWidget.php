<?php

namespace App\Livewire;

use App\Constants\FeatureKey;
use App\Models\Lesson;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LessonsStatusWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $lessonsCourseCount = Lesson::query()->active()->where('progress', 'course')->count();

        $lessonsFinishedCount = Lesson::query()->active()->where('progress', 'finished')->count();

        return [
            Stat::make('Classe(s) Cursando(s)', $lessonsCourseCount),
            Stat::make('Classe(s) Finalizada(s)', $lessonsFinishedCount),
            Stat::make('Limite de Classes', Filament::getTenant()->getLimit(FeatureKey::LESSON_LIMIT)),
        ];
    }
}
