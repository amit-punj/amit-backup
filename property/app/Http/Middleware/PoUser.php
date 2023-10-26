<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Properties;

class PoUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    const Property_Owner = 2;
    public function handle($request, Closure $next){
        if ((\Request::is('create-property')) || (\Request::is('delete-property/*')) || (\Request::is('access-permission')) ){
            if(Auth::user() && Auth::user()->user_role == self::Property_Owner) {
                return $next($request);
            } else {
                toastr()->error('Not a Valid User');
                return redirect()->back();
            }
        } else if((\Request::is('edit-building/*')) || (\Request::is('building-details/*')) || (\Request::is('update-building/*')) || (\Request::is('delete-property/*'))) {
            $parameterId =  $request->route()->parameters('id');
            $unit = Properties::where('id', $parameterId['id'])->where('user_id', \Auth::user()->id)->first();
            if($unit && Auth::user() && Auth::user()->user_role == self::Property_Owner) {
                return $next($request);
            } else {
                toastr()->error('Not a Valid User');
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }
}
