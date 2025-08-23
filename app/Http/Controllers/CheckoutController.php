<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page with cart summary.
     */
    public function create()
    {
        // Get the user's cart from Redis
        $cartKey = 'cart:' . Auth::id();
        $cartItems = Redis::hgetall($cartKey);

        if (empty($cartItems)) {
            return redirect()->route('products.index')->with('info', 'Your cart is empty. Please add items to proceed to checkout.');
        }

        // Fetch product details from the database
        $productIds = array_keys($cartItems);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $productId => $quantity) {
            if (isset($products[$productId])) {
                $subtotal += $products[$productId]->price * $quantity;
            }
        }

        return view('checkout.create', compact('cartItems', 'products', 'subtotal'));
    }
}
