<?php

namespace App\Livewire;

use App\Models\Team;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\StatCustom;

class TeamsStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $teamsActiveCount = Team::isActive()->withoutGlobalScopes()->count();

        $teamsInactiveCount = Team::isInactive()->withoutGlobalScopes()->count();

        $lastTeam = Team::query()->withoutGlobalScopes()->latest()->first();

        return [
            StatCustom::make('Igreja(s) Ativa(s)', $teamsActiveCount)
                ->icon(Heroicon::OutlinedHomeModern)
                ->color('success'),
            StatCustom::make('Igreja(s) Inativa(s)', $teamsInactiveCount)
                ->icon(Heroicon::OutlinedHomeModern)
                ->color('success'),
            StatCustom::make('Última Igreja Registrada', $lastTeam->name)
                ->icon(Heroicon::AcademicCap),
        ];
    }
}
