<?php

namespace App\Livewire;

use App\Models\Plan;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\StatCustom;

class PlanStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $planFreeTeamsCount = Plan::where('name', 'Plano Gratuito')->first()->teams()->withoutGlobalScopes()->count();

        $planCompletedTeamsCount = Plan::where('name', 'Plano Completo')->first()->teams()->withoutGlobalScopes()->count();

        return [
            StatCustom::make('Igreja(s) com Plano Gratuito', $planFreeTeamsCount)
                ->icon(Heroicon::OutlinedHomeModern),
            StatCustom::make('Igreja(s) com Plano Completo', $planCompletedTeamsCount)
                ->icon(Heroicon::OutlinedHomeModern),
        ];
    }
}
