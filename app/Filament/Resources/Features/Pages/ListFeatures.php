<?php

namespace App\Filament\Resources\Features\Pages;

use App\Filament\Resources\Features\FeatureResource;
use App\Filament\Resources\Pages\BaseListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFeatures extends BaseListRecords
{
    protected static string $resource = FeatureResource::class;

    protected function getTableQuery(): Builder
    {
        return static::getResource()::getEloquentQuery()->withoutGlobalScopes();
    }
}
