<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekMondayTable extends CultsFilterWeekTable
{
    protected string | null $dayWeek = 'monday';

    public function getHeading(): string
    {
        return 'Segunda';
    }
}
