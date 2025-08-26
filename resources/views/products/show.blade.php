<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - {{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Back to Products Navigation -->
        <div class="mb-8">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Products
            </a>
        </div>

        <!-- Product Detail Layout -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Left Column - Product Image -->
                <div class="lg:w-2/5 p-8">
                    <img 
                        src="https://placehold.co/800x600/e5e7eb/6b7280?text={{ urlencode($product->name) }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-auto rounded-lg shadow-md"
                    >
                </div>

                <!-- Right Column - Product Details -->
                <div class="lg:w-3/5 p-8">
                    <!-- Product Name -->
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                        {{ $product->name }}
                    </h1>

                    <!-- Product Price -->
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-8">
                        <p class="text-gray-700 leading-relaxed text-lg">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="10" class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors duration-200 text-lg shadow-md hover:shadow-lg">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Customer Reviews Section -->
        <div class="mt-12 bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>
            
            <!-- Review Submission Form -->
            @auth
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-8">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Leave a Review</h3>
                    @if(session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('reviews.store', $product) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                            <select name="rating" id="rating" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="5">5 Stars - Excellent</option>
                                <option value="4">4 Stars - Good</option>
                                <option value="3">3 Stars - Average</option>
                                <option value="2">2 Stars - Fair</option>
                                <option value="1">1 Star - Poor</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                            <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required minlength="10" placeholder="Tell us what you thought..."></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-medium">Submit Review</button>
                    </form>
                </div>
            @else
                <p class="text-gray-600 mb-8 bg-gray-100 p-4 rounded-md">
                    <a href="{{ route('login') }}" class="text-blue-600 font-semibold">Log in</a> or <a href="{{ route('register') }}" class="text-blue-600 font-semibold">register</a> to leave a review.
                </p>
            @endauth
            
            <!-- Existing Reviews List -->
            <div class="space-y-8">
                @forelse($product->reviews()->latest()->get() as $review)
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center mb-2">
                            <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                            <span class="text-yellow-500 ml-4 flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </span>
                        </div>
                        <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                        <p class="text-xs text-gray-500 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">This product has no reviews yet. Be the first to leave one!</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
