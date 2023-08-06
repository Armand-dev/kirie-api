<?php

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
        Route::middleware('role:landlord')->group(function() {
            /** Properties */
            Route::apiResource('/property', \App\Http\Controllers\Landlord\PropertyController::class)
                ->middleware('has_subscription:basic,standard,premium');

            /** Leases */
            Route::apiResource('/lease', \App\Http\Controllers\Landlord\LeaseController::class)
                ->middleware('has_subscription:basic,standard,premium');

            /** Lease templates */
            Route::apiResource('/lease-template', \App\Http\Controllers\Landlord\LeaseTemplateController::class)
                ->middleware('has_subscription:basic,standard,premium');

            /** Tenants */
            Route::apiResource('/tenant', \App\Http\Controllers\Landlord\TenantController::class)
                ->middleware('has_subscription:basic,standard,premium');
            Route::post('/tenant/attach/{tenant}', [\App\Http\Controllers\Landlord\TenantController::class, 'attachTenant'])->name('tenant.attach')
                ->middleware('has_subscription:basic,standard,premium');

            /** Transactions */
            Route::apiResource('/transaction', \App\Http\Controllers\Landlord\TransactionController::class)
                ->middleware('has_subscription:basic,standard,premium');

            /** Documents */
            Route::apiResource('/document', \App\Http\Controllers\Landlord\DocumentController::class, ['except' => ['update']])
                ->middleware('has_subscription:basic,standard,premium');
          
            /** Subscriptions */
            Route::post('/subscription-checkout-url', [\App\Http\Controllers\SubscriptionController::class, 'subscriptionCheckoutURL'])->name('cashier.subscription-checkout-url');
        });

        Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });

    Route::get('/test', function () {
        return app()->version();
    });
});
