<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing - E-commerce Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-900 text-center">Explore Our Products</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            {{-- This loop will create a card for each product from the database --}}
            @foreach($products as $product)
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Product Image -->
                    <div class="aspect-w-3 aspect-h-2">
                        {{-- Placeholder image, but you could use $product->image_url if you had one --}}
                        <img src="https://placehold.co/600x400/e5e7eb/6b7280?text={{ urlencode($product->name) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover">
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{-- Link to the single product page --}}
                            <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600 transition-colors">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="text-2xl font-bold text-gray-900 mb-3">${{ number_format($product->price, 2) }}</p>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ $product->description }}
                        </p>
                        
                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add') }}" method="POST" class="space-y-3">
                            {{-- THIS IS THE CRITICAL FIX --}}
                            @csrf 
                            
                            {{-- Hidden input to send the product ID with the form --}}
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="flex items-center space-x-3">
                                <label for="quantity-{{ $product->id }}" class="text-sm font-medium text-gray-700">Qty:</label>
                                <input type="number" 
                                       id="quantity-{{ $product->id }}" 
                                       name="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="10"
                                       class="w-16 px-2 py-1 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <button type="submit" 
                                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </main>
</body>
</html>
