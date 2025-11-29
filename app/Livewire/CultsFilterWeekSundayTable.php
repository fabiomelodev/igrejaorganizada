<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;
use Illuminate\Support\Facades\Auth;

class CultsFilterWeekSundayTable extends CultsFilterWeekTable
{
    protected string | null $dayWeek = 'sunday';

    public function getHeading(): string
    {
        return 'Domingo';
    }
}
