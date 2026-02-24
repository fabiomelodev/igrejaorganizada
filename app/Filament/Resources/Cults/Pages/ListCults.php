<?php

namespace App\Filament\Resources\Cults\Pages;

use App\Constants\FeatureKey;
use App\Filament\Resources\Cults\CultResource;
use App\Filament\Pages\BaseListRecords;
use App\Livewire\CultsFilterWeekFridayTable;
use App\Livewire\CultsFilterWeekMondayTable;
use App\Livewire\CultsFilterWeekSaturdayTable;
use App\Livewire\CultsFilterWeekSundayTable;
use App\Livewire\CultsFilterWeekThursdayTable;
use App\Livewire\CultsFilterWeekTuesdayTable;
use App\Livewire\CultsFilterWeekWednesdayTable;

class ListCults extends BaseListRecords
{
    protected static string $resource = CultResource::class;

    protected static ?string $moduleLimit = FeatureKey::CULT_LIMIT;

    public function getHeaderWidgetsColumns(): int|array
    {
        return 7;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CultsFilterWeekSundayTable::class,
            CultsFilterWeekMondayTable::class,
            CultsFilterWeekTuesdayTable::class,
            CultsFilterWeekWednesdayTable::class,
            CultsFilterWeekThursdayTable::class,
            CultsFilterWeekFridayTable::class,
            CultsFilterWeekSaturdayTable::class,
        ];
    }
}
