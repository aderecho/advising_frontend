<?php

use App\Http\Controllers\Adviser\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:adviser'])
    ->prefix('adviser')
    ->name('adviser.')
    ->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
    });
