<?php

use App\Http\Controllers\Evaluator\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:evaluator'])
    ->prefix('evaluator')
    ->name('evaluator.')
    ->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
    });
