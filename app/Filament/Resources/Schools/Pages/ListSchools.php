<?php

namespace App\Filament\Resources\Schools\Pages;

use App\Constants\FeatureKey;
use App\Filament\Pages\BaseListRecords;
use App\Filament\Resources\Schools\SchoolResource;
use App\Livewire\SchoolsStatsWidget;

class ListSchools extends BaseListRecords
{
    protected static string $resource = SchoolResource::class;

    protected static ?string $moduleLimit = FeatureKey::SCHOOL_LIMIT;

    public function getHeaderWidgetsColumns(): int|array
    {
        return 3;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SchoolsStatsWidget::class,
        ];
    }
}
