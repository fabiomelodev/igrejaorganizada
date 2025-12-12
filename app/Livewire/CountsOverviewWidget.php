<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class CountsOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        if (Filament::getTenant()->slug == 'geral') {
            $usersActiveCount = User::query()->withoutGlobalScopes()->whereHas('roles', function (Builder $query): Builder {
                return $query->where('name', '!=', 'super_admin');
            })->count();

            $membersActiveCount = Member::query()->active()->withoutGlobalScopes()->count();

            $teamsCount = Team::where('slug', '!=', 'geral')->withoutGlobalScopes()->count();
        } else {
            $usersActiveCount = User::query()->whereHas('roles', function (Builder $query): Builder {
                return $query->where('name', '!=', 'super_admin');
            })->count();

            $membersActiveCount = Member::query()->active()->count();

            $teamsCount = Team::where('slug', '!=', 'geral')->count();
        }

        return [
            Stat::make('Usuário(s) ativo(s)', $usersActiveCount),
            Stat::make('Membro(s) ativo(s)', $membersActiveCount),
            Stat::make('Igreja(s) ativo(s)', $teamsCount)
        ];
    }
}
