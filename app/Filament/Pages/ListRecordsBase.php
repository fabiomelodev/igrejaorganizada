<?php

namespace App\Filament\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRecordsBase extends ListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(static::$resource::getLabel())
                ->icon('heroicon-o-plus')
                ->hidden(fn() => !static::$resource::canCreate()),
        ];
    }
}
