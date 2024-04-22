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
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the user has any of the required roles
        $user = Auth::user();
        if (!$user->hasAnyRole($roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
