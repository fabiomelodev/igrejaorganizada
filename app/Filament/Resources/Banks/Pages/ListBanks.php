<?php

namespace App\Filament\Resources\Banks\Pages;

use App\Filament\Resources\Banks\BankResource;
use App\Filament\Resources\Pages\BaseListRecords;
use Faker\Provider\Base;
use Filament\Actions\CreateAction;

class ListBanks extends BaseListRecords
{
    protected static string $resource = BankResource::class;
}
