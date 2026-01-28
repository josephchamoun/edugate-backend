<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class BearerCookieAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('access_token');

        if (!$token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        auth()->login($accessToken->tokenable);

        return $next($request);
    }
}
