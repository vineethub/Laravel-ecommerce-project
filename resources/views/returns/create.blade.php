<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Return</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-2xl">
        <!-- Page Header -->
        <div class="mb-8">
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">&larr; Back to My Orders</a>
            <h1 class="text-3xl font-bold text-gray-900">Request a Return</h1>
            <p class="text-gray-600 mt-1">For Order #{{ $order->id }}</p>
        </div>

        <!-- Return Request Form -->
        <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
            <form action="{{ route('returns.store', $order) }}" method="POST">
                @csrf
                <div>
                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason for Return</label>
                    <div class="mt-1">
                        <textarea 
                            id="reason" 
                            name="reason" 
                            rows="6" 
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" 
                            placeholder="Please describe the issue with your order and why you are requesting a return..."
                            required
                            minlength="20"
                        >{{ old('reason') }}</textarea>
                    </div>
                    @error('reason')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">Please be as detailed as possible. Our support team will review your request.</p>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 font-semibold">
                        Submit Return Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
