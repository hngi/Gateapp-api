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
        if ($user->role != 3) {
            return response(['Forbidden', 'Not allowed to access this route!'], 403);
        }

        return $next($request);
    }
<<<<<<< HEAD
}
=======

}

>>>>>>> 4405599b7d7597357c3ad174c1cf68c564dbc9e4
