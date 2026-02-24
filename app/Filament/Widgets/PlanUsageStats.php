<?php

namespace App\Filament\Widgets;

use App\Constants\FeatureKey;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PlanUsageStats extends BaseWidget
{
    public static function canView(): bool
    {
        return Filament::getTenant() !== null;
    }

    protected function getStats(): array
    {
        $church = Filament::getTenant();

        $plan = $church->plan;

        $memberLimit = (int) $plan->features->firstWhere('key', FeatureKey::MEMBER_LIMIT)?->pivot->value ?? 0;

        $memberCount = $church->members()->count();

        // $cultLimit = (int) $plan->features->firstWhere('key', FeatureKey::CULT_LIMIT)?->value ?? 0;

        // $cultCount = $church->cults()->count();

        return [
            Stat::make('Capacidade de Membros', "{$memberCount} / " . ($memberLimit == -1 ? '∞' : $memberLimit))
                ->description($this->getUsageMessage($memberCount, $memberLimit))
                ->descriptionIcon($memberCount >= $memberLimit ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-users')
                ->color($this->getColor($memberCount, $memberLimit)),

            // Stat::make('Cultos Registrados', "{$cultCount} / " . ($cultLimit == -1 ? '∞' : $cultLimit))
            //     ->description($this->getUsageMessage($cultCount, $cultLimit))
            //     ->descriptionIcon('heroicon-m-calendar-days')
            //     ->color($this->getColor($cultCount, $cultLimit)),
        ];
    }

    // Helper simples para definir a cor do card
    private function getColor($current, $limit): string
    {
        if ($limit == -1)
            return 'success';

        $percent = ($current / $limit) * 100;


        if ($percent >= 100)
            return 'danger';

        if ($percent >= 80)
            return 'warning';

        return 'success';
    }

    // Helper para a mensagem descritiva
    private function getUsageMessage($current, $limit): string
    {
        if ($limit == -1)
            return 'Uso ilimitado no plano atual';
        if ($current >= $limit)
            return 'Limite atingido! Faça upgrade.';
        return 'Dentro do limite do plano';
    }
}
