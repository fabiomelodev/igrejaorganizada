<?php

namespace App\Filament\Resources\Teams\Pages;

use App\Filament\Resources\Teams\TeamResource;
use App\Livewire\TeamsStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListTeams extends ListRecords
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 3;
    }

    protected function getHeaderWidgets(): array
    {
        if (Filament::getTenant()->name == 'Geral') {
            return [
                TeamsStatsWidget::class,
            ];
        }

        return [];
    }

    protected function getTableQuery(): Builder
    {
        if (Auth::user()->hasRole('super_admin') && Filament::getTenant()->id == 1) {
            return static::getResource()::getEloquentQuery()->withoutGlobalScopes();
        }

        return static::getResource()::getEloquentQuery();
    }
}
