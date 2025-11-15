<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekSundayTable extends CultsFilterWeekTable
{
    public function getQuery(): Builder
    {
        return Cult::query()->active()->where('week', 'sunday');
    }

    public function getHeading(): string
    {
        return 'Domingo';
    }
}
