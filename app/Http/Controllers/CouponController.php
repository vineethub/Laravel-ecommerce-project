<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return back()->withErrors('Invalid coupon code. Please try again.');
        }

        // Put the coupon details into the session
        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->value, // For simplicity, we'll calculate on the fly later
            'type' => $coupon->type,
        ]);

        return back()->with('success', 'Coupon has been applied!');
    }
}
