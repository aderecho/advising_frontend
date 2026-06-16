<?php

use App\Http\Controllers\Our\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:our'])
    ->prefix('our')
    ->name('our.')
    ->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
    });
