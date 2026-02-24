<?php

namespace App\Filament\Resources\Members\Pages;

use App\Constants\FeatureKey;
use App\Filament\Resources\Members\MemberResource;
use App\Traits\CheckPlanLimits;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMember extends CreateRecord
{
    use CheckPlanLimits;

    protected static string $resource = MemberResource::class;

    public function mount(): void
    {
        parent::mount();

        $this->verifyLimit(FeatureKey::MEMBER_LIMIT);
    }
}
