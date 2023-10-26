<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
Use Helper;
use Illuminate\Http\Request;
use App\PropertiesUnit;
use App\appointments;
class VisitAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;
    const Tenant = 1;
    const Property_Owner = 2;
    public function handle(Request $request, Closure $next){
        $parameterId =  $request->route()->parameters('id');
        $appointmentDetail = appointments::where('id', $parameterId['id'])->first();
        if ( (\Request::is('visit-details/*')) && ($appointmentDetail) ) {
            if(\Auth::user()->user_role == self::Visit_Organizer){
                if($appointmentDetail->vo_id == \Auth::user()->id){
                    return $next($request);
                } else {
                    toastr()->error('Visit Details Authentication Failed');
                    return redirect()->back();
                }
            } else if( \Auth::user()->user_role == self::Property_Description_Experts){
                if($appointmentDetail->pde_id == \Auth::user()->id){
                    return $next($request);
                } else {
                    toastr()->error('Visit Details Authentication Failed');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }
}
