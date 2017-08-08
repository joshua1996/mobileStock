<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class boss
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
        if (Auth::guard('boss')->check())
        {
            return redirect('/boss/shop');
        }
        elseif(Auth::guard('user')->check())
        {
            return redirect()->route('home');
        }
        elseif (Auth::guard('admin')->check())
        {
            return redirect()->route('adminSales');
        }
        return $next($request);
    }
}
