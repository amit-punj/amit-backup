<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
Use Helper;
use Illuminate\Http\Request;
use App\PropertiesUnit;
use App\LegalActions;
class LegalAuthentication
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
        if ( \Request::is('legal-action/*')) {
            if(\Auth::user()->user_role == self::Legal_Advisor) {
                $legalActions = LegalActions::where('id',$parameterId['id'])->where('legal_advisor_id',\Auth::user()->id)->first();
                if($legalActions) {
                    return $next($request);
                } else {
                    toastr()->error('Legal View Authentication Failed');
                    return redirect()->back();
                }
            } else if(\Auth::user()->user_role == self::Property_Owner) {
                $legalActions = LegalActions::where('id',$parameterId['id'])->where('po_id',\Auth::user()->id)->first();
                if($legalActions) {
                    return $next($request);
                } else {
                    toastr()->error('Legal View Authentication Failed');
                    return redirect()->back();
                }
            } else if(\Auth::user()->user_role == self::Property_Manager) {
                $legalActions = LegalActions::where('id',$parameterId['id'])->first();
                if($legalActions) {
                    $unit = PropertiesUnit::where('id', $legalActions->unit_id)->where('property_manager_id', \Auth::user()->id)->first();
                    if($unit){
                        return $next($request);
                    } else {
                        toastr()->error('Legal View Authentication Failed');
                        return redirect()->back();
                    }
                } else {
                    toastr()->error('Legal View Authentication Failed');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Legal View Authentication Failed');
                return redirect()->back();
            }
        } else if ( \Request::is('legal-actions')) {
            if(\Auth::user()->user_role == self::Legal_Advisor || \Auth::user()->user_role == self::Property_Owner || \Auth::user()->user_role == self::Property_Manager) {
                return $next($request);
            } else {
                toastr()->error('Legal View Authentication Failed');
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }
}
