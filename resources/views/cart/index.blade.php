<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Your Shopping Cart</h1>

        @if (count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <div class="space-y-6">
                        @foreach ($cartItems as $item)
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-4">
                                    <img src="https://placehold.co/100x100" alt="{{ $item['name'] }}" class="w-20 h-20 rounded-md object-cover">
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-900">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-600">${{ number_format($item['price'], 2) }}</p>
                                        <!-- Remove Item Form -->
                                        <form action="{{ route('cart.remove') }}" method="POST" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <!-- Update Quantity Form -->
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-20 px-2 py-1 border border-gray-300 rounded-md text-center">
                                        <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 mt-1">Update</button>
                                    </form>
                                    <p class="font-semibold text-lg text-gray-900 mt-2">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Summary</h2>

                    <!-- Coupon Form -->
                    <form action="{{ route('coupon.store') }}" method="POST" class="mb-6">
                        @csrf
                        <label for="coupon_code" class="block text-sm font-medium text-gray-700">Have a coupon?</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="coupon_code" id="coupon_code" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-l-md border-gray-300" placeholder="Enter code">
                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-gray-500 text-sm hover:bg-gray-100">
                                Apply
                            </button>
                        </div>
                        @if ($errors->any())
                            <p class="text-red-500 text-sm mt-2">{{ $errors->first() }}</p>
                        @endif
                        @if (session('success'))
                            <p class="text-green-600 text-sm mt-2">{{ session('success') }}</p>
                        @endif
                    </form>

                    <!-- Totals Calculation -->
                    @php
                        $discount = 0;
                        if (session()->has('coupon')) {
                            $coupon = session()->get('coupon');
                            if ($coupon['type'] === 'fixed') {
                                $discount = $coupon['discount'];
                            } elseif ($coupon['type'] === 'percent') {
                                $discount = ($subtotal * $coupon['discount']) / 100;
                            }
                        }
                        $grandTotal = $subtotal - $discount;
                    @endphp

                    <div class="space-y-4 border-t pt-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        @if ($discount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Discount ({{ session('coupon')['name'] }})</span>
                                <span>-${{ number_format($discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between font-bold text-xl text-gray-900 border-t pt-4 mt-4">
                            <span>Total</span>
                            <span>${{ number_format($grandTotal, 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="mt-8 w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 font-semibold text-center block">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="text-center bg-white p-12 rounded-lg shadow-sm border">
                <h2 class="text-2xl font-semibold text-gray-800">Your cart is empty.</h2>
                <p class="text-gray-600 mt-2">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-block bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 font-semibold">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
</body>
</html>
