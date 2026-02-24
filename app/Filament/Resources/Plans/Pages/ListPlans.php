<?php

namespace App\Filament\Resources\Plans\Pages;

use App\Filament\Pages\BaseListRecords;
use App\Filament\Resources\Plans\PlanResource;
use Illuminate\Database\Eloquent\Builder;

class ListPlans extends BaseListRecords
{
    protected static string $resource = PlanResource::class;

    protected function getTableQuery(): Builder
    {
        return static::getResource()::getEloquentQuery()->withoutGlobalScopes();
    }
}
