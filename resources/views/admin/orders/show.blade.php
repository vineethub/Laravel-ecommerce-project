<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - #{{ $order->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Header -->
        <div class="mb-8">
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">&larr; Back to All Orders</a>
            <h1 class="text-3xl font-bold text-gray-900">Order Details</h1>
            <p class="text-gray-600">Order #{{ $order->id }} - Placed on {{ $order->created_at->format('F j, Y, g:i a') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (Order Items) -->
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Items</h2>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between border-b pb-4">
                                <div class="flex items-center gap-4">
                                    <img src="https://placehold.co/100x100" alt="{{ $item->product->name }}" class="w-16 h-16 rounded-md object-cover">
                                    <div>
                                        <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                    <p class="text-sm text-gray-500">(${{ number_format($item->price, 2) }} each)</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Total -->
                    <div class="mt-6 text-right">
                        <p class="text-lg text-gray-700">Subtotal: <span class="font-semibold">${{ number_format($order->total_amount, 2) }}</span></p>
                        <p class="text-lg text-gray-700">Shipping: <span class="font-semibold">$0.00</span></p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">Total: ${{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Customer Info & Status Update) -->
            <div>
                <!-- Customer Details -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h3>
                    <div class="space-y-2 text-gray-700">
                        <p><span class="font-semibold">Name:</span> {{ $order->user->name }}</p>
                        <p><span class="font-semibold">Email:</span> {{ $order->user->email }}</p>
                    </div>
                    <hr class="my-4">
                    <h4 class="text-md font-semibold text-gray-800 mb-2">Shipping Address</h4>
                    <address class="not-italic text-gray-700">
                        {{ $order->address->line1 }}<br>
                        @if($order->address->line2)
                            {{ $order->address->line2 }}<br>
                        @endif
                        {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
                        {{ $order->address->country }}
                    </address>
                </div>

                <!-- Update Status Form -->
                <div class="mt-8 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Order Status</h3>

                    @if(session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="flex items-center gap-4">
                            <select name="status" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>

                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-medium whitespace-nowrap">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
