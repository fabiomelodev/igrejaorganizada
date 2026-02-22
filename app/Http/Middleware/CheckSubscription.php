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

        // 1. Se não houver igreja (tenant) selecionada ainda, segue viagem
        if (!$church) {
            return $next($request);
        }

        // 2. DEFINE AQUI A ROTA DE EXCEÇÃO
        // Substitua pelo nome real da sua rota ou slug da página
        $planPageUrl = 'settings/plan-selector';

        if (!$church->subscribed('default')) {
            // Se a requisição atual JÁ FOR para a página de planos, não redireciona!
            if ($request->is("*$planPageUrl*")) {
                return $next($request);
            }

            \Filament\Notifications\Notification::make()
                ->warning()
                ->title('Assinatura Necessária')
                ->send();

            // Redireciona para a página de planos
            return redirect()->to(\App\Filament\Pages\Settings\PlanSelector::getUrl());
        }

        return $next($request);
    }
}
