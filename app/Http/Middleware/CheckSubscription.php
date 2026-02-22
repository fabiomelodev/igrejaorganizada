<?php

namespace App\Http\Middleware;

use App\Filament\Pages\Settings\PlanSelector;
use Closure;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $church = \Filament\Facades\Filament::getTenant();

        // 1. Se não houver igreja, segue o fluxo normal (login/seleção de igreja)
        if (!$church) {
            return $next($request);
        }

        // 2. Identifica a página de planos (Slug que aparece na URL)
        // No seu caso, a URL termina em 'plan-selector'
        $isPlanPage = str_contains($request->url(), 'plan-selector');

        // 3. Verifica a assinatura
        // Importante: use 'default' que é o padrão do Cashier se você não nomeou a assinatura
        if (!$church->subscribed('default')) {

            // Se ele JÁ ESTIVER na página de planos, permite o acesso (QUEBRA O LOOP)
            if ($isPlanPage) {
                return $next($request);
            }

            // Caso contrário, manda para lá
            return redirect()->to(\App\Filament\Pages\Settings\PlanSelector::getUrl());
        }

        // 4. Se ele tem assinatura mas tentou entrar na página de planos, 
        // opcionalmente você pode tirar ele de lá, mas o 'next' é mais seguro.
        return $next($request);
    }
}
