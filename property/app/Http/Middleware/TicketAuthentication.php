<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
Use Helper;
use Illuminate\Http\Request;
use App\Booking;
use App\Tickets;
use App\PropertiesUnit;
use App\Sub_Tenant;

class TicketAuthentication
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
        $user_id = Auth::user()->id;
        $tenant_ids = Sub_Tenant::where('booking_id', $parameterId['id'])->pluck('tenant_id')->toArray();

        if ( \Request::is('raise-ticket/*') ) {
            // $contract = Booking::where('id',$parameterId['id'])->where('tenant_id',\Auth::user()->id)->first();
            $contract = Booking::where('id',$parameterId['id'])->first();
            if($contract && ( \Auth::user()->user_role == self::Tenant) 
                    && (\Auth::user()->id == $contract->tenant_id || in_array(\Auth::user()->id, $tenant_ids) ) ) {
                return $next($request);
            } else {
                toastr()->error('Raise Ticket Authentication Failed');
                return redirect()->back();
            }
        } else if(\Request::is('ticket-view/*')){
            if( \Auth::user()->user_role == self::Tenant ) {
                $tickets = Tickets::where('id',$parameterId['id'])->where('tenant_id',\Auth::user()->id)->first();
                if($tickets){
                    return $next($request);
                } else {
                    toastr()->error('Ticket View Authentication Failed');
                    return redirect()->back();
                }
            } else if(\Auth::user()->user_role == self::Property_Owner){
                $tickets = Tickets::where('id', $parameterId['id'])->first();
                if($tickets){
                   $unit = PropertiesUnit::where('id', $tickets->unit_id)->where('user_id', \Auth::user()->id)->first();
                   if($unit){
                        return $next($request);
                    } else {
                        toastr()->error('Ticket View Authentication Failed');
                        return redirect()->back();
                    }
                } else {
                    return abort(404);
                }
            } else if(\Auth::user()->user_role == self::Property_Manager){
                $tickets = Tickets::where('id', $parameterId['id'])->first();
                if($tickets){
                   $unit = PropertiesUnit::where('id', $tickets->unit_id)->where('property_manager_id', \Auth::user()->id)->first();
                   if($unit){
                        return $next($request);
                    } else {
                        toastr()->error('Ticket View Authentication Failed');
                        return redirect()->back();
                    }
                } else {
                    return abort(404);
                }
            } else {
                toastr()->error('Ticket View Authentication Failed');
                return redirect()->back();
            }
        } else {
            return abort(404);
        }
    }
}
