<?php

namespace App\Livewire;

use App\Constants\FeatureKey;
use App\Models\Member;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\StatCustom;

class MembersStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $membersActiveCount = Member::query()->isActive()->count();

        $membersMonthCurrentCount = Member::query()
            ->isActive()
            ->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])->count();

        return [
            StatCustom::make('Membro(s) Ativo(s)', $membersActiveCount)
                ->icon(Heroicon::Users),
            StatCustom::make('Novos Membro(s) Neste Mês', $membersMonthCurrentCount)
                ->icon(Heroicon::Users),
            StatCustom::make('Limite de Membros', Filament::getTenant()->getLimit(FeatureKey::MEMBER_LIMIT))
                ->icon(Heroicon::Document),
        ];
    }
}
