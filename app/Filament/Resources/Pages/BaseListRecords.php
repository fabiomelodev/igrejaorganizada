<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BaseListRecords extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(static::getResource()::getModelLabel())
                ->icon('heroicon-o-plus')
        ];
    }

    protected function getTableQuery(): Builder
    {
        if (Auth::user()->hasRole('super_admin') && Filament::getTenant()->id == 1) {
            return static::getResource()::getEloquentQuery()->withoutGlobalScopes();
        }

        return static::getResource()::getEloquentQuery();
    }
}
