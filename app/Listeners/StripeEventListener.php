<?php
namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Support\Facades\Log;
use App\Models\Team; // Ou Church, dependendo do seu model

class StripeEventListener
{
    public function handle(WebhookReceived $event)
    {
        Log::info('--- INÍCIO DO WEBHOOK STRIPE ---');
        Log::info('Tipo de Evento: ' . $event->payload['type']);

        // Verificamos se o evento é de checkout concluído
        if ($event->payload['type'] === 'checkout.session.completed') {
            $session = $event->payload['data']['object'];

            // 1. Localiza o time/igreja pelo stripe_id
            $team = Team::where('stripe_id', $session['customer'])->first();

            // 2. Pega o plan_id que enviamos no Metadata (no passo anterior)
            $planId = $session['metadata']['plan_id'] ?? null;

            if ($team && $planId) {
                $team->update(['plan_id' => $planId]);
                Log::info("Plano do Time {$team->id} atualizado para o ID {$planId}");
            } else {
                Log::warning("Webhook recebido, mas time ou plan_id não encontrados.", [
                    'stripe_id' => $session['customer'],
                    'plan_id' => $planId
                ]);
            }
        }
    }
}