<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'Advisement Management API is running.',
        'version' => '1.0.0',
    ]);
});

