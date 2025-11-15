<?php

namespace App\Filament\Resources\Cults\Pages;

use App\Filament\Resources\Cults\CultResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCult extends EditRecord
{
    protected static string $resource = CultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
