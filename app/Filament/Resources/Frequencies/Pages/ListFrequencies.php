<?php

namespace App\Filament\Resources\Frequencies\Pages;

use App\Filament\Resources\Frequencies\FrequencyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFrequencies extends ListRecords
{
    protected static string $resource = FrequencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
