<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Subadmin
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
        if(Auth::user() && (Auth::user()->isAdmin() || Auth::user()->subadmin())){
            return $next($request);
        }

        return redirect('admin');
    }

    /*protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect('admin');
    }*/
}
