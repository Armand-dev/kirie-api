<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->group(function() {
    Route::middleware('throttle:60,1')->group(function() {
        Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('register');
        Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login');
        Route::post('/verify_token', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'verifyToken'])->name('verify-token');
    });

    Route::middleware('auth:sanctum')->group(function() {
        Route::apiResource('/property', \App\Http\Controllers\PropertyController::class);
        Route::apiResource('/lease', \App\Http\Controllers\LeaseController::class);
        Route::apiResource('/lease-template', \App\Http\Controllers\LeaseTemplateController::class);

        Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });

    Route::get('/test', function () {
        return app()->version();
    });
});
