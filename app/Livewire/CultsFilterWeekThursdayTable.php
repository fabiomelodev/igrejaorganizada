<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekThursdayTable extends CultsFilterWeekTable
{
    protected string | null $dayWeek = 'thursday';

    public function getHeading(): string
    {
        return 'Quinta';
    }
}
