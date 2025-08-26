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
        $cartKey = $this->getCartKey();
        $rawCart = Redis::hgetall($cartKey);
    
        $cartItems = [];
        $subtotal = 0;
    
        if (!empty($rawCart)) {
            $productIds = array_keys($rawCart);
            // Fetch all product models at once for efficiency
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
    
            // Loop through the raw cart data and build the structured array the view needs
            foreach ($rawCart as $productId => $quantity) {
                // Ensure the product still exists
                if (isset($products[$productId])) {
                    $product = $products[$productId];
                    $quantity = (int)$quantity; // Ensure quantity is an integer
    
                    $cartItems[] = [
                        'id'          => $product->id,
                        'name'        => $product->name,
                        'price'       => $product->price,
                        'quantity'    => $quantity,
                        // You can add other fields here if needed, like 'image'
                    ];
    
                    $subtotal += $product->price * $quantity;
                }
            }
        }
    
        // Pass the perfectly formatted $cartItems array to the view
        return view('cart.show', compact('cartItems', 'subtotal'));
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

    public function update(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $cartKey = $this->getCartKey();
    $productId = $request->product_id;
    $quantity = $request->quantity;

    // Check if the product exists in the cart before updating
    if (Redis::hget($cartKey, $productId)) {
        Redis::hset($cartKey, $productId, $quantity);
        return back()->with('success', 'Cart updated successfully.');
    }

    return back()->withErrors('Product not found in cart.');
}
}

