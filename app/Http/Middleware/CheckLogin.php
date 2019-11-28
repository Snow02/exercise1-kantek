<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path();
        if (Auth::guard('admin')->guest() && $path != 'admin/login') {
            return redirect()->route('admin.login');
        }
        else if (Auth::guard('admin')->check() && $path == 'admin/login') {
                return redirect()->route('admin.index');
        }
        else {
            return $next($request);
        }
    }


}
