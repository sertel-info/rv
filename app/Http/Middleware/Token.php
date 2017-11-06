<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class Token
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
        try {
            JWTAuth::setToken($request->cookie('token'));
            if (! $user = JWTAuth::authenticate()) {
                return response()->json(['error'=>'user_not_found'], 401);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['error'=>'token_expired'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['error'=>'token_invalid'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            
            return response()->json(['error'=>'token_absent'], $e->getStatusCode());

        }

        return $next($request);
    }
}
