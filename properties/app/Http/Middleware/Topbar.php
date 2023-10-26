<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Topbar
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
        if(isset(Auth::user()->id))
        {
            if(Auth::user()->role == 1)
            {
               Auth::logout();
            }
        }  
         return $next($request);

    }
    
}
