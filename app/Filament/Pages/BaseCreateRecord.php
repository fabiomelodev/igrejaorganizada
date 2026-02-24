<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Traits\CheckPlanLimits;
use Filament\Resources\Pages\CreateRecord;

class BaseCreateRecord extends CreateRecord
{
    use CheckPlanLimits;

    protected static string|null $moduleLimit = null;

    public function mount(): void
    {
        parent::mount();

        $this->verifyLimit(static::$moduleLimit);
    }
}
