<?php
namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class JwtMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'], 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'], 401);
            }else{
                return response()->json(['status' => 'Authorization Token not found'], 401);
            }
        }
        return $next($request);
    }
}
