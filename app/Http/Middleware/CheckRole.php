<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check() || !$request->user()->hasRole($role)) {
            // If the user is not logged in or doesn't have the role,
            // redirect them or show an error.
            // For an admin panel, aborting with a 403 Forbidden is a good choice.
            abort(403, 'Unauthorized Action');
        }

        return $next($request);
    }
}
