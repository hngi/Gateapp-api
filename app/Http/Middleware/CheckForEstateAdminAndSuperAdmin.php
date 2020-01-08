<?php

namespace App\Http\Middleware;

use Closure;

class CheckForEstateAdminAndSuperAdmin
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

        if (! in_array($user->user_type, ['super_admin', 'estate_admin'])) {
            return response(['message' => 'Forbidden'], 403);
        }
        return $next($request);
    }
}
