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
        $team = Filament::getTenant();

        // Se a igreja não estiver assinada em nenhum plano ativo
        if ($team && !$team->subscribed('main')) {
            // Se ela já não estiver na página de planos, redireciona para lá
            if (!$request->routeIs('filament.app.pages.settings.plan-selector')) {
                Notification::make()
                    ->warning()
                    ->title('Assinatura Necessária')
                    ->body('Seu período de teste acabou ou sua assinatura está inativa.')
                    ->send();

                return redirect()->to(PlanSelector::getUrl());
            }
        }

        return $next($request);
    }
}
