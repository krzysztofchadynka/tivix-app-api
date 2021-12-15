<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])
        ->name('tivix.user.register');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('tivix.user.login');

    Route::middleware('auth:sanctum')
        ->get('/data', [UserController::class, 'getUserData'])
        ->name('tivix.user.get_data');
});

