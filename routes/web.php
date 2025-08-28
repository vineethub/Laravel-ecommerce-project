<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
Use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReturnRequestController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\ReturnRequestController as AdminReturnRequestController;


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
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Cart routes that can be used by guests
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


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
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show'); 
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Add other authenticated routes here, like:
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store'); 

    Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');


    // Route::get('/payment', function(Request $request) {
    //     // Check if an address has been submitted
    //     if (!$request->session()->has('shipping_address_id')) {
    //         return redirect()->route('checkout.create')->with('error', 'Please submit your shipping address first.');
    //     }
    //     return "This is the payment page. Address ID: " . $request->session()->get('shipping_address_id');
    // })->name('payment.create');

    // Previous placeholder route can be replaced by these
    Route::get('/payment', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');


    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store');

    Route::get('/orders/{order}/return', [ReturnRequestController::class, 'create'])->name('returns.create');
    Route::post('/orders/{order}/return', [ReturnRequestController::class, 'store'])->name('returns.store');

});



// --- Admin Panel Routes ---
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['auth', 'role:Super-Admin'])->group(function () {
    
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('products', AdminProductController::class);

        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::resource('coupons', AdminCouponController::class);
       
        Route::get('/return-requests', [AdminReturnRequestController::class, 'index'])->name('returns.index');
        Route::patch('/return-requests/{returnRequest}', [AdminReturnRequestController::class, 'update'])->name('returns.update');
        
        // Add other admin routes here in the future
        // (e.g., for managing products, categories, etc.)
        

    });
});



