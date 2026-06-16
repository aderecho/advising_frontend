<?php

use App\Http\Controllers\Admin\CurriculumBuilderController;
use App\Http\Controllers\Admin\ProspectusPreviewController;
use App\Http\Controllers\Admin\PublishCurriculumController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::redirect('/dashboard', '/admin/curriculum-builder')->name('dashboard');

        Route::get('/curriculum-builder', CurriculumBuilderController::class)->name('curriculum-builder');
        Route::get('/prospectus-preview', ProspectusPreviewController::class)->name('prospectus-preview');
        Route::get('/publish-curriculum', PublishCurriculumController::class)->name('publish-curriculum');
    });
