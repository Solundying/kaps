<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header('Authorization');

        // بررسی وجود هدر Authorization
        if (!$authorization || !str_starts_with($authorization, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // استخراج توکن از هدر Authorization
        $token = substr($authorization, 7);

        // پیدا کردن کاربر مرتبط با توکن
        $user = \App\Models\User::where('api_token', $token)->first();

        if (!$user) {
            \Log::error('Invalid token or user not found', ['token' => $token]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // ورود کاربر به سیستم
        auth()->login($user);

        \Log::info('Authorization Token:', ['token' => $token]);

        // ادامه درخواست
        return $next($request);
    }
}
