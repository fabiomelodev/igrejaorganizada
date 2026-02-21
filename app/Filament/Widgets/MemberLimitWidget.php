<?php

namespace App\Filament\Widgets;

use App\Constants\FeatureKey;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MemberLimitWidget extends StatsOverviewWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $church = Filament::getTenant();

        $current = $church->getCurrentCount(FeatureKey::MEMBER_LIMIT);
        $limit = (int) $church->plan->features
            ->where('key', FeatureKey::MEMBER_LIMIT)
            ->first()?->pivot->value ?? 0;

        $percent = $limit > 0 ? ($current / $limit) * 100 : 0;

        $color = 'success';
        if ($percent >= 80)
            $color = 'warning';
        if ($percent >= 100)
            $color = 'danger';

        $stat = Stat::make('Uso do Plano: Membros', "{$current} / {$limit}")
            ->description($percent >= 100 ? 'Limite atingido!' : "Você utilizou " . number_format($percent, 1) . "% do seu limite.")
            ->descriptionIcon($percent >= 100 ? 'heroicon-m-lock-closed' : 'heroicon-m-users')
            ->color($color);

        // REGRA DO BOTÃO: Se o uso for maior que 80%, adicionamos o link de upgrade
        if ($percent >= 80) {
            $stat->extraAttributes([
                'class' => 'cursor-pointer',
            ])
                // Aqui você coloca a rota para a sua página de planos/assinatura
                ->url('#')
                ->description('Clique aqui para fazer Upgrade');
        }

        return [$stat];
    }
}
