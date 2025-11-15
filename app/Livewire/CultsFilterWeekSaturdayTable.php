<?php

namespace App\Livewire;

use App\Models\Cult;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\CultsFilterWeekTable;

class CultsFilterWeekSaturdayTable extends CultsFilterWeekTable
{
    public function getQuery(): Builder
    {
        return Cult::query()->active()->where('week', 'saturday');
    }

    public function getHeading(): string
    {
        return 'Sábado';
    }
}
