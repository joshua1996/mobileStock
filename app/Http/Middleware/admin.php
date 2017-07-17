<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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
        if (Auth::guard('admin')->check())
        {

            return redirect('/admin/sales');
        }elseif(Auth::guard('user')->check())
        {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
