<?php

namespace App\Livewire;

use App\Models\Member;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MembersActiveCountWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $membersActiveCount = Member::query()->active()->count();

        $membersMonthCurrentCount = Member::query()
            ->active()
            ->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])->count();

        return [
            Stat::make('Membros ativos', $membersActiveCount),
            Stat::make('Novos membros neste mês', $membersMonthCurrentCount)
        ];
    }
}
