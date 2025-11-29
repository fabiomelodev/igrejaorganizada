<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class UsersOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        if (Filament::getTenant()->slug == 'geral') {
            $usersActiveCount = User::query()->withoutGlobalScopes()->whereHas('roles', function (Builder $query): Builder {
                return $query->where('name', '!=', 'super_admin');
            })->count();

            $membersActiveCount = Member::query()->active()->withoutGlobalScopes()->count();
        } else {
            $usersActiveCount = User::query()->whereHas('roles', function (Builder $query): Builder {
                return $query->where('name', '!=', 'super_admin');
            })->count();

            $membersActiveCount = Member::query()->active()->count();
        }

        return [
            Stat::make('Usuários ativos', $usersActiveCount),
            Stat::make('Membros ativos', $membersActiveCount),
        ];
    }
}
