<?php

namespace App\Filament\Resources\Members\Pages;

use App\Constants\FeatureKey;
use App\Filament\Pages\BaseListRecords;
use App\Filament\Resources\Members\MemberResource;
use App\Livewire\{MembersStatsWidget, PositionTableWidget};

class ListMembers extends BaseListRecords
{
    protected static string $resource = MemberResource::class;

    protected static ?string $moduleLimit = FeatureKey::MEMBER_LIMIT;

    public function getHeaderWidgetsColumns(): int|array
    {
        return 3;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MembersStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            PositionTableWidget::class,
        ];
    }
}
