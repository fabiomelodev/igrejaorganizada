<?php

namespace App\Livewire;

use App\Constants\FeatureKey;
use App\Models\Lesson;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\StatCustom;

class LessonsStatusWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $lessonsCourseCount = Lesson::query()->active()->where('progress', 'course')->count();

        $lessonsFinishedCount = Lesson::query()->active()->where('progress', 'finished')->count();

        return [
            StatCustom::make('Classe(s) Cursando(s)', $lessonsCourseCount)
                ->icon(Heroicon::Home),
            StatCustom::make('Classe(s) Finalizada(s)', $lessonsFinishedCount)
                ->icon(Heroicon::Home),
            StatCustom::make('Limite de Classes', Filament::getTenant()->getLimit(FeatureKey::LESSON_LIMIT))
                ->icon(Heroicon::Document),
        ];
    }
}
