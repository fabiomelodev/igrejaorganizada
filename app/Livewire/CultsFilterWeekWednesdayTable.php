<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekWednesdayTable extends CultsFilterWeekTable
{
    protected string | null $dayWeek = 'wednesday';

    public function getHeading(): string
    {
        return 'Quarta';
    }
}
