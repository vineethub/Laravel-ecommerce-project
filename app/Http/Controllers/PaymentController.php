<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Models\Product;
use Stripe;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display the payment page.
     */
    public function create(Request $request)
    {
        // Ensure user came from the checkout page
        if (!$request->session()->has('shipping_address_id')) {
            return redirect()->route('checkout.create')->with('error', 'Please submit your shipping address first.');
        }
        return view('payment.create');
    }

    /**
     * Process the payment.
     */
    public function store(Request $request)
    {
        // --- START: This is the missing part ---
        // Get the cart details and calculate the total amount
        $cartKey = 'cart:' . Auth::id();
        $cartItems = Redis::hgetall($cartKey);

        if (empty($cartItems)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $productIds = array_keys($cartItems);
        $products = Product::whereIn('id', $productIds)->get(); // Get a collection of Product models

        $totalAmount = 0;
        foreach ($products as $product) {
            // Get the quantity for this specific product from the Redis cart
            $quantity = $cartItems[$product->id] ?? 0;
            $totalAmount += $product->price * $quantity;
        }
        // --- END: Missing part ---

        // Get the shipping address ID from the session
        $addressId = $request->session()->get('shipping_address_id');
        if (!$addressId) {
            return redirect()->route('checkout.create')->with('error', 'Shipping address not found.');
        }

        DB::beginTransaction(); // Start a database transaction for safety

        try {
            // Process the Stripe payment
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                "amount" => $totalAmount * 100, // Amount in cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Order payment from " . Auth::user()->email,
            ]);

            // Create the main order record
            $order = Order::create([
                'user_id' => Auth::id(),
                'address_id' => $addressId,
                'total_amount' => $totalAmount,
                'status' => 'processing',
            ]);

            // Create an order item for each product
            foreach ($products as $product) {
                $quantity = $cartItems[$product->id] ?? 0;
                if ($quantity > 0) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ]);
                }
            }

            DB::commit(); // Commit the transaction if everything was successful

            // Clear the user's cart and session data now that the order is complete
            Redis::del($cartKey);
            $request->session()->forget('shipping_address_id');

            return redirect()->route('dashboard')->with('success', 'Payment successful and order placed!');

        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction on any error
            return back()->with('error', 'An error occurred during payment: ' . $e->getMessage());
        }
    }
}
