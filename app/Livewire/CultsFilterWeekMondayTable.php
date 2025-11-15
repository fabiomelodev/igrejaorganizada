<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekMondayTable extends CultsFilterWeekTable
{
    public function getQuery(): Builder
    {
        return Cult::query()->active()->where('week', 'monday');
    }

    public function getHeading(): string
    {
        return 'Segunda';
    }
}
