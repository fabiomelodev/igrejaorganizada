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
        $object = $payload['data']['object'];

        if ($payload['type'] === 'invoice.payment_succeeded') {
            $stripeCustomerId = $object['customer'];

            // 1. Tenta pegar o plan_id da raiz do metadata
            $planId = $object['metadata']['plan_id'] ?? null;

            // 2. Se não estiver lá, tenta pegar do metadata da Assinatura vinculada
            if (!$planId && isset($object['subscription'])) {
                // O Cashier pode nos ajudar a buscar a assinatura se necessário, 
                // mas vamos tentar ver se veio no payload primeiro.
                $planId = $object['lines']['data'][0]['metadata']['plan_id'] ?? null;
            }

            if ($planId) {
                $team = \App\Models\Team::where('stripe_id', $stripeCustomerId)->first();

                if ($team) {
                    // Forçamos a atualização e limpamos o cache do model
                    $team->plan_id = (string) $planId;
                    $team->save();

                    Log::info("SUCESSO: Time {$team->id} atualizado para o plano {$planId}");
                } else {
                    Log::error("ERRO: Time não encontrado para o cliente {$stripeCustomerId}");
                }
            } else {
                Log::warning("AVISO: Webhook recebido, mas 'plan_id' não foi encontrado no JSON.");
            }
        }
    }
}