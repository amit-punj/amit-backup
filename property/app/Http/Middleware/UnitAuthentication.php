<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
Use Helper;
use Illuminate\Http\Request;
use App\PropertiesUnit;
class UnitAuthentication
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
        if ( (\Request::is('edit-unit/*')) || (\Request::is('update-unit/*'))) {
            if(\Auth::user()->user_role == self::Property_Owner){
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('user_id', \Auth::user()->id)->get();
                if(count($unit) > 0){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            }else if( \Auth::user()->user_role == self::Property_Manager){
                $unitPermission = 2;
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_manager_id', \Auth::user()->id)->first();
                if($unit){
                    $unitPermission = Helper::accessPermission($unit->user_id,Auth::user()->user_role,'unit_permission');
                }
                if($unit && ($unitPermission != 0) ){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else if (\Request::is('delete-unit/*')){
            if(\Auth::user()->user_role == self::Property_Owner){
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('user_id', \Auth::user()->id)->get();
                if(count($unit) > 0){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            }else if( \Auth::user()->user_role == self::Property_Manager){
                $unitPermission = 2;
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_manager_id', \Auth::user()->id)->first();
                if($unit){
                    $unitPermission = Helper::accessPermission($unit->user_id,Auth::user()->user_role,'unit_permission');
                }
                if($unit && ($unitPermission != 0 && $unitPermission != 1) ){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else if ((\Request::is('list-tenants/*'))) {
            if(\Auth::user()->user_role == self::Property_Owner){
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('user_id', \Auth::user()->id)->get();
                if(count($unit) > 0){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else if( \Auth::user()->user_role == self::Property_Manager) {
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_manager_id', \Auth::user()->id)->first();
                if($unit){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else if( \Auth::user()->user_role == self::Legal_Advisor) {
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_legal_advisor_id', \Auth::user()->id)->first();
                if($unit){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else if ((\Request::is('unit-managment/*'))) {
            if(\Auth::user()->user_role == self::Property_Owner){
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('user_id', \Auth::user()->id)->get();
                if(count($unit) > 0){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else if( \Auth::user()->user_role == self::Property_Manager) {
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_manager_id', \Auth::user()->id)->first();
                if($unit){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else if( \Auth::user()->user_role == self::Legal_Advisor) {
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_legal_advisor_id', \Auth::user()->id)->first();
                if($unit){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else if ((\Request::is('list-contracts/*'))) {
            if(\Auth::user()->user_role == self::Property_Owner){
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('user_id', \Auth::user()->id)->get();
                if(count($unit) > 0){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else if( \Auth::user()->user_role == self::Property_Manager) {
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_manager_id', \Auth::user()->id)->first();
                if($unit){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
                    return redirect()->back();
                }
            } else if( \Auth::user()->user_role == self::Legal_Advisor) {
                $unit = PropertiesUnit::where('id', $parameterId['id'])->where('property_legal_advisor_id', \Auth::user()->id)->first();
                if($unit){
                    return $next($request);
                } else {
                    toastr()->error('Unit Access Authentication Failed');
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
