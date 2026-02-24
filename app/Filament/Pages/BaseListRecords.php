<?php

namespace App\Filament\Pages;

use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

class BaseListRecords extends ListRecords
{
    protected static string|null $moduleLimit = null;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(static::$resource::getLabel())
                ->icon('heroicon-o-plus')
                ->tooltip(fn() => Filament::getTenant()->hasReachedLimit(static::$moduleLimit) ? 'Limite atingido' : null),
        ];
    }
}
