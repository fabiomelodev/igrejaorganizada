<?php

namespace App\Filament\Resources\Features\Pages;

use App\Filament\Resources\Features\FeatureResource;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFeatures extends ListRecords
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(static::$resource::getLabel())
                ->icon('heroicon-o-plus')
        ];
    }

    protected function getTableQuery(): Builder
    {
        return static::getResource()::getEloquentQuery()->withoutGlobalScopes();
    }
}
