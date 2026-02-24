<?php

namespace App\Filament\Resources\Schools\Pages;

use App\Constants\FeatureKey;
use App\Filament\Pages\BaseCreateRecord;
use App\Filament\Resources\Schools\SchoolResource;

class CreateSchool extends BaseCreateRecord
{
    protected static string $resource = SchoolResource::class;

    protected static string|null $moduleLimit = FeatureKey::SCHOOL_LIMIT;
}
