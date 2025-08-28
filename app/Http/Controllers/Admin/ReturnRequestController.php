<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnRequest;
class ReturnRequestController extends Controller
{
    public function index()
{
    $requests = ReturnRequest::with('user', 'order')->latest()->paginate(15);
    return view('admin.returns.index', compact('requests'));
}

public function update(Request $request, ReturnRequest $returnRequest)
{
    $request->validate(['status' => 'required|in:approved,declined,completed']);

    $returnRequest->update([
        'status' => $request->status,
        'admin_comment' => $request->admin_comment,
    ]);

    // Also update the main order's status to reflect the decision
    $returnRequest->order->update(['status' => 'return_' . $request->status]);

    return back()->with('success', 'Return request status updated.');
}
}
