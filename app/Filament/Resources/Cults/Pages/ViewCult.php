<?php

namespace App\Filament\Resources\Cults\Pages;

use App\Filament\Resources\Cults\CultResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCult extends ViewRecord
{
    protected static string $resource = CultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
