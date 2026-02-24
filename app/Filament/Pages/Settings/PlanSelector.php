<?php

namespace App\Filament\Pages\Settings;

use App\Constants\FeatureKey;
use Filament\Pages\Page;
use App\Models\Plan;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use UnitEnum;

class PlanSelector extends Page
{
    protected string $view = 'filament.pages.settings.plan-selector';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    protected static ?string $title = 'Meu Plano';

    public function getPlans()
    {
        return Plan::with('features')->get();
    }

    public function getCurrentPlanId()
    {
        return Filament::getTenant()->plan_id;
    }

    // public function selectPlan($planId)
    // {
    //     $team = Filament::getTenant();

    //     $newPlan = Plan::with('features')->find($planId);

    //     // 1. Validação de Limites (Downgrade)
    //     // Se o novo plano for mais barato ou tiver limites menores, precisamos validar
    //     foreach ($newPlan->features as $feature) {
    //         if ($feature->type === FeatureKey::MEMBER_LIMIT) {
    //             $currentMembers = $team->getCurrentCount(FeatureKey::MEMBER_LIMIT);

    //             $newLimit = (int) $feature->pivot->value;

    //             if ($currentMembers > $newLimit) {
    //                 Notification::make()
    //                     ->danger()
    //                     ->title('Não é possível alterar para este plano')
    //                     ->body("Você possui {$currentMembers} membros, mas este plano permite apenas {$newLimit}. Remova registros ou escolha outro plano.")
    //                     ->persistent()
    //                     ->send();
    //                 return;
    //             }
    //         }
    //     }

    //     // 2. Lógica de Redirecionamento de Pagamento
    //     // Se o plano for pago (preço > 0), no futuro mandaremos para o Checkout.
    //     if ($newPlan->price > 0) {
    //         // Por enquanto, apenas avisamos que o financeiro virá a seguir
    //         Notification::make()
    //             ->info()
    //             ->title('Preparando pagamento...')
    //             ->body('Em breve você será redirecionado para o checkout.')
    //             ->send();

    //         // Simulação de troca:
    //         $team->update(['plan_id' => $planId]);
    //     } else {
    //         // Se for um plano gratuito (Trial)
    //         $team->update(['plan_id' => $planId]);
    //     }

    //     Notification::make()
    //         ->success()
    //         ->title('Plano alterado com sucesso!')
    //         ->send();

    //     return redirect()->to(static::getUrl());
    // }

    public function selectPlan($planId)
    {
        $team = Filament::getTenant();

        $plan = Plan::find($planId);

        if (!$plan->stripe_price_id) {
            return;
        }

        // Em vez de retornar diretamente, criamos a sessão e pegamos a URL
        $checkout = $team->checkout([$plan->stripe_price_id], [
            'success_url' => static::getUrl() . '?success=true',
            'cancel_url' => static::getUrl() . '?canceled=true',
            'mode' => 'subscription',
        ]);

        // O segredo está aqui: redirecionamos usando o helper do Livewire/Filament
        return redirect($checkout->url);
    }
}
