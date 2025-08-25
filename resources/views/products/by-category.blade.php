<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products in {{ $category->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-gray-900">Category: {{ $category->name }}</h1>
        <p class="text-lg text-gray-600 mt-2 mb-8">{{ $category->description }}</p>

        @if($products->isEmpty())
            <p>No products found in this category.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($products as $product)
                    {{-- Re-use your product card component here --}}
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</body>
</html>
