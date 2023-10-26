<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\Properties;
use Illuminate\Support\Facades\DB;

class CheckAuthentication
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
        $authId = Auth::id();
        $parameters =  $request->route()->parameters('id');
        $invitationsConut = DB::table('invitations')->select('email')->where([['email', \Auth::user()->email],['property_unit_id',$parameters['id']]])->count();
        $property_id = DB::table('property_units')->where('id', $parameters['id'])->value('property_id');
        $user_id = DB::table('properties')->where('id', $property_id)->value('user_id');
        $created_user_id = DB::table('property_units')->where('id', $parameters['id'])->value('created_user_id');

        if($authId == $user_id || $authId == $created_user_id){
            return $next($request);
        }else if($invitationsConut>=1){   
             return $next($request);
        } else {
             return redirect('/');
        }
    }
}
