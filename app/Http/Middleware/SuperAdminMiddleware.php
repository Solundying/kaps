<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role->name === 'super_admin') {
            return $next($request);
        }

        abort(403, "Unauthorized: Super Admin Only");
    }
}
