<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Get the cart key.
     * For authenticated users: 'cart:{userId}'
     * For guests: 'cart:{cartId}' where cartId is provided or generated
     */
    private function getCartKey(Request $request)
    {
        if (Auth::check()) {
            return 'cart:' . Auth::id();
        } else {
            $cartId = $request->header('X-Cart-ID') ?: $request->input('cart_id');
            if (!$cartId) {
                $cartId = Str::uuid()->toString();
            }
            return 'cart:' . $cartId;
        }
    }

    /**
     * Get cart contents
     */
    public function index(Request $request)
    {
        $cartKey = $this->getCartKey($request);
        $rawCart = Redis::hgetall($cartKey);

        $cart = [];
        $total = 0;

        foreach ($rawCart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cart[] = [
                    'product' => $product,
                    'quantity' => (int) $quantity,
                    'subtotal' => $product->price * (int) $quantity
                ];
                $total += $product->price * (int) $quantity;
            }
        }

        return response()->json([
            'cart' => $cart,
            'total' => $total,
            'cart_id' => Auth::check() ? null : str_replace('cart:', '', $cartKey)
        ]);
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;
        $cartKey = $this->getCartKey($request);

        // Check if product exists and has stock
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // TODO: Add stock check when inventory is implemented

        Redis::hincrby($cartKey, $productId, $quantity);

        return response()->json(['message' => 'Product added to cart']);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;
        $cartKey = $this->getCartKey($request);

        if ($quantity <= 0) {
            Redis::hdel($cartKey, $productId);
        } else {
            Redis::hset($cartKey, $productId, $quantity);
        }

        return response()->json(['message' => 'Cart updated']);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $productId = $request->product_id;
        $cartKey = $this->getCartKey($request);

        Redis::hdel($cartKey, $productId);

        return response()->json(['message' => 'Product removed from cart']);
    }

    /**
     * Clear cart
     */
    public function clear(Request $request)
    {
        $cartKey = $this->getCartKey($request);
        Redis::del($cartKey);

        return response()->json(['message' => 'Cart cleared']);
    }
}