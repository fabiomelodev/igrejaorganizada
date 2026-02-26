<?php

namespace App\Filament\Resources\Modalities\Pages;

use App\Constants\FeatureKey;
use App\Filament\Pages\BaseListRecords;
use App\Filament\Resources\Modalities\ModalityResource;
use Filament\Actions\CreateAction;

class ListModalities extends BaseListRecords
{
    protected static string $resource = ModalityResource::class;

    protected static ?string $moduleLimit = FeatureKey::MODALITY_LIMIT;
}
