<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsAgent
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
         if(Auth::user() && Auth::user()->isAgent()) {
            return $next($request);
        }

        return redirect('agent/login');
    }
}

