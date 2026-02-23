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

        if (!$team) {
            return $next($request);
        }

        $freePlanId = 1;

        if ($team->plan_id == $freePlanId) {
            return $next($request);
        }

        if (!$team->subscribed('default')) {

            if (!str_contains($request->url(), 'plan-selector')) {
                return $next($request);
            }
        }

        return $next($request);
    }
}
