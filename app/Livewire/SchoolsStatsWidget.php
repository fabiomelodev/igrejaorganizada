<?php

namespace App\Livewire;

use App\Constants\FeatureKey;
use App\Models\School;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\StatCustom;

class SchoolsStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $schoolsActiveCount = School::query()->active()->count();

        $schoolsMonthCurrentCount = School::query()
            ->active()
            ->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])->count();

        return [
            StatCustom::make('Escolas Ativos', $schoolsActiveCount)
                ->icon(Heroicon::AcademicCap)
                ->color('success'),
            StatCustom::make('Novas Escolas Neste Mês', $schoolsMonthCurrentCount)
                ->icon(Heroicon::AcademicCap),
            StatCustom::make('Limite de Escolas', Filament::getTenant()->getLimit(FeatureKey::SCHOOL_LIMIT))
                ->icon(Heroicon::Document),
        ];
    }
}
