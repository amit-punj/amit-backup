<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    const ADMIN_ROLE_ID = 0;
    public function handle($request, Closure $next)
    {
        if(Auth::user() && Auth::user()->user_role == self::ADMIN_ROLE_ID) {
            return $next($request);
        }

        return redirect('/admin-login');
    }
}
