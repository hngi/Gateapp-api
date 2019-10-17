<?php

namespace App\Http\Middleware;

use Closure;

class VerifyGateman
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
        $user = $request->user();

        if (!$user) {
            return response(['unauthorised'], 401);
        }

        if ($user->role != 2) {
            return response(['Forbidden'], 403);
        }

        return $next($request);
    }
}
