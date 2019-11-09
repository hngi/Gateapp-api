<?php

namespace App\Http\Middleware;

use Closure;

class VerifyEstateAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // WE need  an authenticated user
        if (!$user) {
            return response(['unauthorised'], 401);
        }

        // The user must be an admin
        if ($user->role != 3 && $user->role != 0) {
            return response(['Forbidden', 'Not allowed to access this route!'], 403);
        }

        return $next($request);
    }
}
