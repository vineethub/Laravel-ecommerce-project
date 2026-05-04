<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

    // Public product and cart access
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::patch('/cart/update', [CartController::class, 'update']);
    Route::delete('/cart/remove', [CartController::class, 'remove']);
    Route::delete('/cart', [CartController::class, 'clear']);
    Route::post('/checkout', [CheckoutController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{order}', [OrderController::class, 'show']);
        Route::get('/addresses', [AddressController::class, 'index']);
        Route::post('/addresses', [AddressController::class, 'store']);
        Route::get('/addresses/{address}', [AddressController::class, 'show']);
        Route::patch('/addresses/{address}', [AddressController::class, 'update']);
        Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);
    });
});
