<?php

namespace App\Filament\Pages\Settings;

use App\Constants\FeatureKey;
use Filament\Pages\Page;
use App\Models\Plan;
use App\Models\Team;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use UnitEnum;
use Filament\Actions\Concerns\InteractsWithActions;

class PlanSelector extends Page
{
    use InteractsWithActions;

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

    public function selectPlan($planId)
    {
        $team = Filament::getTenant();

        $plan = Plan::find($planId);

        if (!$plan || !$plan->stripe_price_id) {
            return;
        }

        $checkout = $team->newSubscription('default', $plan->stripe_price_id)
            ->checkout([
                'success_url' => static::getUrl() . '?success=true',
                'cancel_url' => static::getUrl() . '?canceled=true',
                'metadata' => [
                    'plan_id' => (string) $plan->id,
                ],
            ]);

        return redirect()->away($checkout->url);
    }

    public function cancelarAssinaturaAction(): Action
    {
        return Action::make('cancelarAssinatura')
            ->label('Cancelar Plano Atual')
            ->icon('heroicon-m-x-mark')
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Confirmar Cancelamento Imediato')
            ->modalDescription('Seu acesso premium será cortado agora. Tem certeza que deseja voltar ao plano gratuito?')
            ->modalSubmitActionLabel('Sim, cancelar agora')
            // Esta é a lógica que será executada
            ->action(function () {
                $team = Filament::getTenant();

                // 1. Verificamos se a assinatura REALMENTE existe no Stripe
                $subscription = $team->subscription('default');

                if ($subscription) {
                    try {
                        // Se existir, cancela no Stripe
                        $subscription->cancelNow();

                        // Atualiza o banco local
                        $team->update(['plan_id' => 1]);

                        Notification::make()
                            ->title('Assinatura cancelada com sucesso!')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Erro no Stripe')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                } else {
                    // 2. Se não existir no Stripe, apenas "limpamos" o banco local
                    // Isso resolve o erro de "null" e coloca a igreja no plano gratuito
                    $team->update(['plan_id' => 1]);

                    Notification::make()
                        ->title('Plano atualizado')
                        ->body('Não encontramos assinatura ativa no Stripe, o plano foi resetado localmente.')
                        ->warning()
                        ->send();
                }
            });
    }
}
