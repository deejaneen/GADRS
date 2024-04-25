<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        // Check user role if authenticated
        $user = Auth::user();
        if ($user && !$this->hasPermission($user, $request)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    /**
     * Determine if the user has permission for the request.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasPermission($user, $request)
    {
        // Define your role check logic here
        switch ($request->route()->getName()) {
            case 'admin':
                return $user->role === 'Admin';
            case 'cashier':
                return $user->role === 'Cashier';
            case 'receiving':
                return $user->role === 'Receiving';
            case 'supply':
                return $user->role === 'Supply';
            case 'coa_employee':
                return $user->role === 'COA Employee';
            case 'guest':
                return $user->role === 'Guest';
            default:
                // Default to allowing access if the route is not role-restricted
                return true;
        }
    }
}
