<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch the user's orders and calculate stats
        $orders = $user->orders;
        $orderCount = $orders->count();
        $totalSpent = $orders->sum('total_amount');

        return view('dashboard', compact('user', 'orderCount', 'totalSpent'));
    }
}
