<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Order History</h1>

        @if($orders->isEmpty())
            <div class="text-center bg-white p-8 rounded-lg shadow-sm">
                <p class="text-gray-600">You have not placed any orders yet.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Start Shopping</a>
            </div>
        @else
            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-900">Order #{{ $order->id }}</p>
                                <p class="text-sm text-gray-600">Placed on: {{ $order->created_at->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
                                <span class="ml-4 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold mb-4 text-gray-800">Items in this order:</h3>
                            <ul class="divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                    <li class="py-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <img src="https://placehold.co/100x100" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-gray-800">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                            <p class="text-sm text-gray-500">(${{ number_format($item->price, 2) }} each)</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
