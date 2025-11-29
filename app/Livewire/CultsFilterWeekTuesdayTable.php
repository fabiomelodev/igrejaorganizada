<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekTuesdayTable extends CultsFilterWeekTable
{
    protected string | null $dayWeek = 'tuesday';

    public function getHeading(): string
    {
        return 'Terça';
    }
}
