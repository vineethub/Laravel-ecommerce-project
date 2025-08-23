<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    /**
     * Get the dynamic cart key based on user login status.
     * If the user is logged in, the key is 'cart:{userId}'.
     * If they are a guest, the key is 'cart:{sessionId}'.
     */
    private function getCartKey()
    {
        if (Auth::check()) {
            // User is logged in
            return 'cart:' . Auth::id();
        } else {
            // User is a guest
            return 'cart:' . session()->getId();
        }
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $cartKey = $this->getCartKey(); // Use the new dynamic key

        Redis::hincrby($cartKey, $productId, $quantity);

        return back()->with('success', 'Product added to cart!');
    }

    /**
     * Show the shopping cart.
     */
    public function show()
    {
        $cartKey = $this->getCartKey(); // Use the new dynamic key
        $cartItems = Redis::hgetall($cartKey);

        $products = [];
        if ($cartItems) {
            $productIds = array_keys($cartItems);
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
        }

        return view('cart.show', compact('cartItems', 'products'));
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cartKey = $this->getCartKey(); // Use the new dynamic key

        Redis::hdel($cartKey, $productId);

        return back()->with('success', 'Product removed from cart.');
    }
}

