<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Models\Address;

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

    /**
     * Store the user's shipping address and proceed to payment.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming form data
        $validatedData = $request->validate([
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city'           => ['required', 'string', 'max:255'],
            'state'          => ['required', 'string', 'max:255'],
            'postal_code'    => ['required', 'string', 'max:20'],
            'country'        => ['required', 'string', 'max:255'],
        ]);

        // 2. Add the authenticated user's ID to the data
        $validatedData['user_id'] = Auth::id();

        // 3. Create and save the new address record
        $address = Address::create($validatedData);

        // --- PAYMENT GATEWAY LOGIC WILL GO HERE ---
        // For now, we'll simulate a successful next step.
        // We will store the chosen address ID in the session to use after payment.
        $request->session()->put('shipping_address_id', $address->id);

        // Redirect to a (future) payment page or order summary page
        // Let's create a placeholder route for this.
        return redirect()->route('payment.create')->with('success', 'Address saved! Proceed to payment.');
    }
}
