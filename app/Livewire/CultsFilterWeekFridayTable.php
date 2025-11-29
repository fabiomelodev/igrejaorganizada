<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekFridayTable extends CultsFilterWeekTable
{
    protected string | null $dayWeek = 'friday';

    public function getHeading(): string
    {
        return 'Sexta';
    }
}
