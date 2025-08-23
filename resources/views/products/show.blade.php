<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - Premium Wireless Headphones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Back to Products Navigation -->
        <div class="mb-8">
            <a href="/products" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Products
            </a>
        </div>

        <!-- Product Detail Layout -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Left Column - Product Image (40% on desktop) -->
                <div class="lg:w-2/5 p-8">
                    <img 
                        src="https://placehold.co/800x600/e5e7eb/6b7280?text=Premium+Wireless+Headphones" 
                        alt="Premium Wireless Headphones" 
                        class="w-full h-auto rounded-lg shadow-md"
                    >
                </div>

                <!-- Right Column - Product Details (60% on desktop) -->
                <div class="lg:w-3/5 p-8">
                    <!-- Product Name -->
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                        Premium Wireless Headphones
                    </h1>

                    <!-- Product Price -->
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-blue-600">$89.99</span>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-8">
                        <p class="text-gray-700 leading-relaxed text-lg">
                            Experience exceptional sound quality with these premium wireless headphones. 
                            Featuring advanced noise cancellation technology, 30-hour battery life, and 
                            comfortable over-ear design. Perfect for music lovers, professionals, and 
                            anyone who demands superior audio performance. The lightweight construction 
                            and premium materials ensure all-day comfort, while the intuitive controls 
                            make it easy to manage your music and calls.
                        </p>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="/cart/add" method="POST" class="space-y-6">
                        <!-- Hidden Product ID -->
                        <input type="hidden" name="product_id" value="headphones-001">
                        
                        <!-- Quantity Input -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Quantity:
                            </label>
                            <input 
                                type="number" 
                                id="quantity" 
                                name="quantity" 
                                value="1" 
                                min="1" 
                                max="10"
                                class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>

                        <!-- Add to Cart Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors duration-200 text-lg shadow-md hover:shadow-lg"
                        >
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
