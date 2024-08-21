<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JwtAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            // Validar el token JWT
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid'], 404);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired'], 403);
            } else {
                return response()->json(['status' => 'Authorization Token not found'], 401);
            }
        }

        return $next($request); // Continúa con la petición si el token es válido
    }
}