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
        
        <!-- Cart with Items -->
        <div id="cart-with-items" class="block">
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
                                    <!-- Cart Item 1 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-6 px-6">
                                            <div class="flex items-center gap-4">
                                                <img src="https://placehold.co/100x100" alt="Wireless Headphones" class="w-16 h-16 object-cover rounded-lg">
                                                <div>
                                                    <h3 class="font-semibold text-gray-900">Wireless Headphones</h3>
                                                    <p class="text-sm text-gray-600">Premium Audio Quality</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-6 px-4 text-gray-900 font-medium">$99.99</td>
                                        <td class="py-6 px-4 text-gray-900">2</td>
                                        <td class="py-6 px-4 text-gray-900 font-semibold">$199.98</td>
                                        <td class="py-6 px-6">
                                            <form method="POST" action="/cart/remove">
                                                <input type="hidden" name="product_id" value="1">
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    
                                    <!-- Cart Item 2 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-6 px-6">
                                            <div class="flex items-center gap-4">
                                                <img src="https://placehold.co/100x100" alt="Smart Watch" class="w-16 h-16 object-cover rounded-lg">
                                                <div>
                                                    <h3 class="font-semibold text-gray-900">Smart Watch</h3>
                                                    <p class="text-sm text-gray-600">Fitness Tracking & More</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-6 px-4 text-gray-900 font-medium">$249.99</td>
                                        <td class="py-6 px-4 text-gray-900">1</td>
                                        <td class="py-6 px-4 text-gray-900 font-semibold">$249.99</td>
                                        <td class="py-6 px-6">
                                            <form method="POST" action="/cart/remove">
                                                <input type="hidden" name="product_id" value="2">
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    
                                    <!-- Cart Item 3 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-6 px-6">
                                            <div class="flex items-center gap-4">
                                                <img src="https://placehold.co/100x100" alt="Bluetooth Speaker" class="w-16 h-16 object-cover rounded-lg">
                                                <div>
                                                    <h3 class="font-semibold text-gray-900">Bluetooth Speaker</h3>
                                                    <p class="text-sm text-gray-600">Portable & Waterproof</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-6 px-4 text-gray-900 font-medium">$79.99</td>
                                        <td class="py-6 px-4 text-gray-900">1</td>
                                        <td class="py-6 px-4 text-gray-900 font-semibold">$79.99</td>
                                        <td class="py-6 px-6">
                                            <form method="POST" action="/cart/remove">
                                                <input type="hidden" name="product_id" value="3">
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
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
                                <span>Subtotal (3 items)</span>
                                <span>$529.96</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>$9.99</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax</span>
                                <span>$43.20</span>
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex justify-between text-xl font-bold text-gray-900">
                                    <span>Cart Total</span>
                                    <span>$583.15</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <a href="#" class="block w-full bg-blue-600 text-white text-center py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Proceed to Checkout
                            </a>
                            <a href="index.html" class="block w-full text-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Empty Cart State -->
        <div id="empty-cart" class="hidden">
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 11-4 0v-6m4 0V9a2 2 0 10-4 0v4.01"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Your cart is empty</h2>
                    <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet. Start shopping to fill it up!</p>
                    <a href="index.html" class="inline-block bg-blue-600 text-white py-3 px-8 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        Start Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toggle between states for demo purposes -->
    <script>
        // This script is just for demo purposes to toggle between states
        // In a real application, this would be handled server-side
        function toggleCartState() {
            const cartWithItems = document.getElementById('cart-with-items');
            const emptyCart = document.getElementById('empty-cart');
            
            if (cartWithItems.classList.contains('block')) {
                cartWithItems.classList.add('hidden');
                cartWithItems.classList.remove('block');
                emptyCart.classList.add('block');
                emptyCart.classList.remove('hidden');
            } else {
                cartWithItems.classList.add('block');
                cartWithItems.classList.remove('hidden');
                emptyCart.classList.add('hidden');
                emptyCart.classList.remove('block');
            }
        }
        
        // Add a button to toggle states for demo
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.createElement('button');
            toggleButton.textContent = 'Toggle Empty/Full Cart (Demo)';
            toggleButton.className = 'fixed bottom-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg text-sm';
            toggleButton.onclick = toggleCartState;
            document.body.appendChild(toggleButton);
        });
    </script>
</body>
</html>
