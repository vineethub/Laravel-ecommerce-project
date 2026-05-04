<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CheckoutController extends Controller
{
    private function getCartKey(Request $request)
    {
        if (Auth::check()) {
            return 'cart:' . Auth::id();
        }

        $cartId = $request->header('X-Cart-ID') ?: $request->input('cart_id');
        if (! $cartId) {
            return null;
        }

        return 'cart:' . $cartId;
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'payment_method_id' => 'required|string',
            'stripe_email' => 'nullable|email',
            'customer_name' => 'nullable|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'cart_id' => 'nullable|string',
        ]);

        if (! Auth::check()) {
            $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
            ]);
        }

        $cartKey = $this->getCartKey($request);
        if (! $cartKey) {
            return response()->json(['message' => 'Cart identifier is required for guest checkout'], 422);
        }

        $rawCart = Redis::hgetall($cartKey);
        if (empty($rawCart)) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        $productIds = array_keys($rawCart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $orderTotal = 0;
        foreach ($rawCart as $productId => $quantity) {
            $product = $products->get($productId);
            if (! $product) {
                return response()->json(['message' => "Product {$productId} not found"], 404);
            }

            if ($product->stock_quantity !== null && $product->stock_quantity < $quantity) {
                return response()->json(['message' => "Product {$product->name} does not have enough stock"], 422);
            }

            $orderTotal += $product->price * (int) $quantity;
        }

        DB::beginTransaction();
        try {
            $address = Address::create([
                'user_id' => Auth::id(),
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]);

            $customerName = Auth::check() ? Auth::user()->name : $request->customer_name;
            $customerEmail = Auth::check() ? Auth::user()->email : $request->customer_email;

            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => (int) round($orderTotal * 100),
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'receipt_email' => $customerEmail,
                'metadata' => [
                    'customer_email' => $customerEmail,
                    'customer_name' => $customerName,
                ],
            ]);

            if ($paymentIntent->status !== 'succeeded') {
                DB::rollBack();

                return response()->json([
                    'message' => 'Payment requires additional action',
                    'payment_intent_status' => $paymentIntent->status,
                    'client_secret' => $paymentIntent->client_secret,
                ], 202);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'address_id' => $address->id,
                'status' => 'processing',
                'payment_status' => 'paid',
                'currency' => 'usd',
                'total_amount' => $orderTotal,
                'payment_provider' => 'stripe',
                'provider_payment_id' => $paymentIntent->id,
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
            ]);

            foreach ($rawCart as $productId => $quantity) {
                $product = $products->get($productId);
                if (! $product) {
                    continue;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);

                if ($product->stock_quantity !== null) {
                    $product->decrement('stock_quantity', $quantity);
                }
            }

            DB::commit();
            Redis::del($cartKey);

            return response()->json(new OrderResource($order->load('items.product', 'address')));
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json(['message' => 'Unable to complete checkout', 'error' => $exception->getMessage()], 500);
        }
    }
}
