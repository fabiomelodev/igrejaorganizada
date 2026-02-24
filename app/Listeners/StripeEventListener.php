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
        $object = $payload['data']['object'];

        Log::info("Webhook recebido: {$type}");

        // 1. Identificamos o ID do cliente Stripe
        $stripeCustomerId = $object['customer'] ?? null;

        if (!$stripeCustomerId) {
            Log::warning("Webhook {$type} ignorado: Nenhum customer_id encontrado.");
            return;
        }

        $planId = null;

        // 2. Buscamos o plan_id dependendo do tipo de evento
        if ($type === 'checkout.session.completed') {
            // No checkout, o metadata fica na raiz do objeto session
            $planId = $object['metadata']['plan_id'] ?? null;
        } elseif ($type === 'invoice.payment_succeeded') {
            // No invoice, tentamos a raiz ou as linhas da fatura (caso venha de assinatura)
            $planId = $object['metadata']['plan_id'] ??
                ($object['lines']['data'][0]['metadata']['plan_id'] ?? null);
        }

        // 3. Se encontramos um plan_id, atualizamos o banco de dados
        if ($planId) {
            $team = \App\Models\Team::where('stripe_id', $stripeCustomerId)->first();

            if ($team) {
                // Atualizamos o plano
                $team->update([
                    'plan_id' => $planId,
                ]);

                Log::info("SUCESSO: Time ID {$team->id} atualizado para o Plano ID {$planId} via {$type}");
            } else {
                Log::error("ERRO: Recebido plan_id {$planId}, mas nenhum Time com stripe_id {$stripeCustomerId} existe no banco.");
            }
        } else {
            // Se caiu aqui, o evento chegou mas não tinha o metadado que injetamos
            Log::warning("Webhook {$type} processado, mas nenhum 'plan_id' foi encontrado no metadata.");
        }

        if ($team) {
            try {
                // Log para ver o que temos antes de tentar salvar
                Log::info("Tentando salvar plano {$planId} no Time ID {$team->id}");

                $team->plan_id = $planId;
                $salvou = $team->save();

                if ($salvou) {
                    Log::info("O Laravel diz que salvou com sucesso!");
                } else {
                    Log::error("O Laravel retornou FALSE ao tentar salvar o model.");
                }
            } catch (\Exception $e) {
                Log::error("ERRO DE BANCO DE DADOS: " . $e->getMessage());
            }
        }
    }
}