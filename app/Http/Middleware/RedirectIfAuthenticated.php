<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect(route('student.dashboard'));
        }
        else if (Auth::guard('admin')->check()) {
            return redirect(route('admin.dashboard'));
        }
        else if (Auth::guard('teacher')->check()) {
            return redirect(route('teacher.dashboard'));
        }

        return $next($request);
    }
}
