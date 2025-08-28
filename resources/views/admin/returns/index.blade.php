<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Return Requests - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Return Requests</h1>
            <p class="text-gray-600 mt-1">Review and process customer return requests.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Return Requests List -->
        <div class="space-y-6">
            @forelse ($requests as $returnRequest)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Return for Order #{{ $returnRequest->order_id }}</h3>
                                <p class="text-sm text-gray-600">Requested by: {{ $returnRequest->user->name }}</p>
                                <p class="text-sm text-gray-500">Date: {{ $returnRequest->created_at->format('F d, Y') }}</p>
                                <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @switch($returnRequest->status)
                                        @case('pending') bg-yellow-100 text-yellow-800 @break
                                        @case('approved') bg-blue-100 text-blue-800 @break
                                        @case('completed') bg-green-100 text-green-800 @break
                                        @case('declined') bg-red-100 text-red-800 @break
                                    @endswitch">
                                    {{ ucfirst($returnRequest->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 border-t pt-4">
                            <p class="font-medium text-gray-700">Customer's Reason:</p>
                            <p class="text-gray-600 italic">"{{ $returnRequest->reason }}"</p>
                        </div>
                    </div>
                    
                    <!-- Admin Action Form -->
                    <div class="bg-gray-50 px-6 py-4">
                        <form action="{{ route('admin.returns.update', $returnRequest) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                <div>
                                    <label for="status-{{ $returnRequest->id }}" class="block text-sm font-medium text-gray-700">Update Status</label>
                                    <select name="status" id="status-{{ $returnRequest->id }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="pending" {{ $returnRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $returnRequest->status === 'approved' ? 'selected' : '' }}>Approve</option>
                                        <option value="declined" {{ $returnRequest->status === 'declined' ? 'selected' : '' }}>Decline</option>
                                        <option value="completed" {{ $returnRequest->status === 'completed' ? 'selected' : '' }}>Mark as Completed</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                     <label for="admin_comment-{{ $returnRequest->id }}" class="block text-sm font-medium text-gray-700">Admin Comment (Optional)</label>
                                    <input type="text" name="admin_comment" id="admin_comment-{{ $returnRequest->id }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="e.g., Return approved, please ship item back." value="{{ $returnRequest->admin_comment }}">
                                </div>
                                <div class="md:col-start-3">
                                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-medium">Update Request</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center bg-white p-12 rounded-lg shadow-sm border">
                    <h3 class="text-xl font-semibold text-gray-800">No Return Requests Found</h3>
                    <p class="text-gray-600 mt-2">There are currently no open return requests to process.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $requests->links() }}
        </div>
    </div>
</body>
</html>
