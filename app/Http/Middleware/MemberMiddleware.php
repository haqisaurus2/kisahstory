<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use UnexpectedValueException;
use LogicException;
use Firebase\JWT\Key;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->header('Authorization');
            $token = str_replace("Bearer ", "", $token);

            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->merge(['userInfo' =>  (array) $decoded]);
            return $next($request);
        } catch (LogicException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => 401
            ], 401);
            // errors having to do with environmental setup or malformed JWT Keys
        } catch (UnexpectedValueException $e) {
            // errors having to do with JWT signature and claims
            return response()->json([
                'error' => $e->getMessage(),
                'code' => 401
            ], 401);
        }
    }
}
