<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for "{{ $query }}"</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Search Results</h1>
        <p class="text-lg text-gray-600 mb-8">Showing results for: <span class="font-semibold">"{{ $query }}"</span></p>

        @if($products->isEmpty())
            <div class="text-center bg-white p-8 rounded-lg shadow-sm">
                <p class="text-gray-700 text-lg">No products found matching your search.</p>
            </div>
        @else
            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Product Image -->
                        <img src="https://placehold.co/600x400" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600">{{ $product->name }}</a>
                            </h3>
                            <p class="text-2xl font-bold text-gray-900 mb-3">${{ number_format($product->price, 2) }}</p>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-medium hover:bg-blue-700">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination Links -->
            <div class="mt-12">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</body>
</html>
