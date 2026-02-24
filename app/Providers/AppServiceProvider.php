<?php

namespace App\Providers;

use App\Models\Member;
use App\Observers\MemberObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; // Importe o Facade Event
use Laravel\Cashier\Events\WebhookReceived; // Importe o Evento do Cashier
use App\Listeners\StripeEventListener; // Importe o seu Listener

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        WebhookReceived::class => [
            StripeEventListener::class,
        ],
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Member::observe(MemberObserver::class);

        Event::listen(
            WebhookReceived::class,
            StripeEventListener::class
        );
    }
}
