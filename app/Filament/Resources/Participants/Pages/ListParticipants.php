<?php

namespace App\Filament\Resources\Participants\Pages;

use App\Constants\FeatureKey;
use App\Filament\Pages\BaseListRecords;
use App\Filament\Resources\Participants\ParticipantResource;

class ListParticipants extends BaseListRecords
{
    protected static string $resource = ParticipantResource::class;

    protected static ?string $moduleLimit = FeatureKey::PARTICIPANT_LIMIT;
}
