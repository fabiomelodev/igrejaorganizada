<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Constants\FeatureKey;
use App\Filament\Pages\BaseListRecords;
use App\Filament\Resources\Projects\ProjectResource;

class ListProjects extends BaseListRecords
{
    protected static string $resource = ProjectResource::class;

    protected static ?string $moduleLimit = FeatureKey::PROJECT_LIMIT;
}
