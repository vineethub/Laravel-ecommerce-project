<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis; // Import Redis facade

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login'); // We will create this view next
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Get the guest cart key BEFORE logging the user in
        $guestCartKey = 'cart:' . $request->session()->getId();
        $guestCartItems = Redis::hgetall($guestCartKey);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // --- MERGE CART LOGIC ---
            if ($guestCartItems) {
                $userCartKey = 'cart:' . Auth::id();

                // Loop through the guest cart items and add them to the user's cart
                foreach ($guestCartItems as $productId => $quantity) {
                    Redis::hincrby($userCartKey, $productId, $quantity);
                }

                // Delete the old guest cart
                Redis::del($guestCartKey);
            }
            // --- END MERGE LOGIC ---

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session (logout).
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
