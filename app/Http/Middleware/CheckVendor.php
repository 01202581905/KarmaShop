<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckVendor
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
        if( Auth::check() && Auth::user()->rule == 0  && Auth::user()->status_shop == 1 )
        {
            return $next($request);
        }
        else
        {
            return redirect('/logout');
        }
        
    }
}
