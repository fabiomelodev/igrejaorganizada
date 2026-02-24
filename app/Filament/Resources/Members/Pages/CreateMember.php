<?php

namespace App\Filament\Resources\Members\Pages;

use App\Constants\FeatureKey;
use App\Filament\Pages\BaseCreateRecord;
use App\Filament\Resources\Members\MemberResource;

class CreateMember extends BaseCreateRecord
{
    use CheckPlanLimits;

    protected static string $resource = MemberResource::class;

    protected static string|null $moduleLimit = FeatureKey::MEMBER_LIMIT;

}
