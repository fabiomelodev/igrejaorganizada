<?php

namespace App\Filament\Resources\Frequencies\Pages;

use App\Filament\Resources\Frequencies\FrequencyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFrequency extends ViewRecord
{
    protected static string $resource = FrequencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
