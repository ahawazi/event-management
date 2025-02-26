<?php

use App\Livewire\ConferenceSignUpPage;
use Illuminate\Support\Facades\Route;

Route::get('/conference-sign-up', ConferenceSignUpPage::class);

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
