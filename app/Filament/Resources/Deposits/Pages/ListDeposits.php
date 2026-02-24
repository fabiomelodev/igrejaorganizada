<?php

namespace App\Filament\Resources\Deposits\Pages;

use App\Filament\Resources\Deposits\DepositResource;
use App\Filament\Pages\BaseListRecords;
use Filament\Actions\CreateAction;

class ListDeposits extends BaseListRecords
{
    protected static string $resource = DepositResource::class;
}
