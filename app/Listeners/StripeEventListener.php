<?php
namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Support\Facades\Log;
use App\Models\Team; // Ou Church, dependendo do seu model

class StripeEventListener
{
    public function handle(WebhookReceived $event)
    {
        $payload = $event->payload;
        $type = $payload['type'];

        Log::info("Processando evento: {$type}");

        // Lista de eventos que confirmam que o plano pode ser liberado
        $allowedEvents = [
            'checkout.session.completed',
            'invoice.payment_succeeded'
        ];

        if (in_array($type, $allowedEvents)) {
            $data = $payload['data']['object'];

            // O Stripe ID do cliente (começa com cus_...)
            $stripeCustomerId = $data['customer'];

            // Buscamos o Team/Church
            $team = \App\Models\Team::where('stripe_id', $stripeCustomerId)->first();

            if (!$team) {
                Log::warning("Time não encontrado para o Stripe ID: {$stripeCustomerId}");
                return;
            }

            // Tenta pegar o plan_id do metadata em diferentes níveis (Sessão ou Invoice)
            $planId = $data['metadata']['plan_id']
                ?? $data['lines']['data'][0]['metadata']['plan_id'] // Para Invoices
                ?? null;

            if ($planId) {
                $team->update(['plan_id' => $planId]);
                Log::info("Sucesso! Time {$team->id} atualizado para o plano {$planId}");
            } else {
                Log::error("Evento recebido, mas plan_id não encontrado no metadata.");
            }
        }
    }
}