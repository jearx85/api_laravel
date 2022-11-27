<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;



class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $credentials = User::find(12)->only('email', 'password');
        $jwt = JWT::encode($credentials, env('JWT_SECRET'), 'HS256');

        if ($request->input('token') !== $jwt) {
            return response()->json([
               'message' => 'Invalid token'
            ]);
        }


        return $next($request);
    }
}
