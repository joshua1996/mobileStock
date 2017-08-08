<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class user
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
        if (Auth::guard('user')->check())
        {
            return redirect('/');
        }
        elseif (Auth::guard('admin')->check())
        {
            return redirect()->route('adminSales');
        }
        elseif (Auth::guard('boss')->check()) {
            return redirect()->route('shop');
        }
        return $next($request);
    }
}
