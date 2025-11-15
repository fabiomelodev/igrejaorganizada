<?php

use App\Filament\Pages\Auth\Register as AuthRegister;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/register', AuthRegister::class);
