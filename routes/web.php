<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController; // Assuming you have a dashboard
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| These routes are accessible to everyone, including guests.
|
*/

// Product routes
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart routes that can be used by guests
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


/*
|--------------------------------------------------------------------------
| Guest-Only Routes
|--------------------------------------------------------------------------
|
| These routes are only for unauthenticated users. If a logged-in
| user tries to access them, they will be redirected to the dashboard.
|
*/
Route::middleware('guest')->group(function () {
    // Registration Routes
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login Routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| These routes require the user to be logged in. If a guest
| tries to access them, they will be redirected to the login page.
|
*/
Route::middleware('auth')->group(function () {
    // Logout Route (must be authenticated to log out)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Example of a user dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Add other authenticated routes here, like:
    // Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
});

