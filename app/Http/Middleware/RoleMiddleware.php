<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // بررسی ورود کاربر
        if (!auth()->check()) {
            abort(403, 'Unauthorized: User not authenticated.');
        }
        
        // بررسی نقش کاربر
        if (auth()->user()->role && auth()->user()->role->name !== $role) {
            abort(403, "Unauthorized action. Role: $role");
        }
        if (auth()->user()->role->name === 'super_admin') {
            return $next($request); // سوپر ادمین به همه چیز دسترسی دارد
        }
        
        if (auth()->user()->role->name !== $role) {
            abort(403, "Unauthorized action. Role required: {$role}");
        }

        return $next($request);
    }
}
