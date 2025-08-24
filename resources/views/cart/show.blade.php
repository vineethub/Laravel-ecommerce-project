<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Your Shopping Cart</h1>
        
        {{-- Check if the cart is empty --}}
        @if (empty($cartItems))
            <!-- Empty Cart State -->
            <div id="empty-cart">
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Your cart is empty</h2>
                        <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet. Start shopping to fill it up!</p>
                        <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 text-white py-3 px-8 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Start Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Cart with Items -->
            <div id="cart-with-items">
                <div class="lg:flex lg:gap-8">
                    <!-- Cart Items Table -->
                    <div class="lg:flex-1">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 border-b">
                                        <tr>
                                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Product</th>
                                            <th class="text-left py-4 px-4 font-semibold text-gray-900">Price</th>
                                            <th class="text-left py-4 px-4 font-semibold text-gray-900">Quantity</th>
                                            <th class="text-left py-4 px-4 font-semibold text-gray-900">Total</th>
                                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        {{-- Loop through each item in the cart --}}
                                        @foreach($cartItems as $productId => $quantity)
                                            @if(isset($products[$productId]))
                                                @php
                                                    $product = $products[$productId];
                                                    $itemTotal = $product->price * $quantity;
                                                @endphp
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-6 px-6">
                                                        <div class="flex items-center gap-4">
                                                            <img src="https://placehold.co/100x100/e5e7eb/6b7280?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                                            <div>
                                                                <h3 class="font-semibold text-gray-900">{{ $product->name }}</h3>
                                                                <p class="text-sm text-gray-600">{{ Str::limit($product->description, 30) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="py-6 px-4 text-gray-900 font-medium">${{ number_format($product->price, 2) }}</td>
                                                    <td class="py-6 px-4 text-gray-900">{{ $quantity }}</td>
                                                    <td class="py-6 px-4 text-gray-900 font-semibold">${{ number_format($itemTotal, 2) }}</td>
                                                    <td class="py-6 px-6">
                                                        {{-- Add CSRF token to the remove form --}}
                                                        <form method="POST" action="{{ route('cart.remove') }}">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $productId }}">
                                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">
                                                                Remove
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cart Summary -->
                    <div class="lg:w-80 mt-8 lg:mt-0">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6">Cart Summary</h2>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal ({{ count($cartItems) }} items)</span>
                                    <span>${{ number_format($subtotal, 2) }}</span>
                                </div>
                                {{-- Placeholder for shipping and tax --}}
                                <div class="flex justify-between text-gray-600">
                                    <span>Shipping</span>
                                    <span class="text-sm">Calculated at checkout</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Tax</span>
                                    <span class="text-sm">Calculated at checkout</span>
                                </div>
                                <div class="border-t pt-4">
                                    <div class="flex justify-between text-xl font-bold text-gray-900">
                                        <span>Cart Total</span>
                                        <span>${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <a href="{{ route('checkout.create') }}" class="block w-full bg-blue-600 text-white text-center py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                    Proceed to Checkout
                                </a>
                                <a href="{{ route('products.index') }}" class="block w-full text-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
