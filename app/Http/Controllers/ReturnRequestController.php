<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ReturnRequestController extends Controller
{
    public function create(Order $order)
    {
        // Ensure the user owns this order and it's in a returnable state
        if (auth()->id() !== $order->user_id || $order->status !== 'completed') {
            abort(403);
        }
        return view('returns.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        if (auth()->id() !== $order->user_id || $order->status !== 'completed') {
            abort(403);
        }

        $request->validate(['reason' => 'required|string|min:20']);

        $order->returnRequests()->create([
            'user_id' => auth()->id(),
            'reason' => $request->reason,
        ]);

        // Update the main order status to show a return is in progress
        $order->update(['status' => 'return_pending']);

        return redirect()->route('orders.index')->with('success', 'Return request submitted successfully.');
    }
}
