<?php

use App\Filament\Pages\Auth\Register as AuthRegister;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/atualizar-pagamento-interno', [\Laravel\Cashier\Http\Controllers\WebhookController::class, 'handleWebhook']);

// Route::get('/admin/register', AuthRegister::class);
