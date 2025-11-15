<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekWednesdayTable extends CultsFilterWeekTable
{
    public function getQuery(): Builder
    {
        return Cult::query()->active()->where('week', 'wednesday');
    }

    public function getHeading(): string
    {
        return 'Quarta';
    }
}
