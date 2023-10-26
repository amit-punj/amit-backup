<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
Use Helper;
use Illuminate\Http\Request;
use App\PropertiesUnit;
use App\MeterReadings;
use App\Booking;
use App\UnitsRent;
use Illuminate\Support\Facades\DB;
class PaymentAuthentication
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
        if ( \Request::is('paymeter-bill/*') ) {
            $reading = MeterReadings::where('id', $parameterId['id'])->first();
            if((\Auth::user()->user_role == self::Tenant) && ($reading)){
                $unit =Booking::where('status',6)->where('tenant_id', \Auth::user()->id)->where('unit_id', $reading->unit_id)->first();
               if($unit){
                    return $next($request);
               } else {
                    toastr()->error('Payment Authentication Failed');
                    return redirect()->back();
               }
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else if ( \Request::is('payunit-rent/*') ) {
            $rent = UnitsRent::where('id', $parameterId['id'])->where('user_id', \Auth::user()->id)->first();
            if((\Auth::user()->user_role == self::Tenant) && ($rent)){
                return $next($request);
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else if ( \Request::is('rent-confirmed/*') ) {
            $unitIds = [];
            $rent = UnitsRent::where('id', $parameterId['id'])->first();
            if((\Auth::user()->user_role == self::Property_Manager) && ($rent)){
                $units = DB::table('property_units')
                            ->select('id')
                            ->where('property_manager_id', \Auth::user()->id)
                            ->get();
                if($units){
                    foreach ($units as $key => $value) {
                        $unitIds[] = $value->id;
                    }
                }
                if(in_array($rent->unit_id, $unitIds)){
                    return $next($request);
                } else {
                    toastr()->error('Not a Valid User!');
                    return redirect()->back();
                }
            } else if((\Auth::user()->user_role == self::Property_Owner) && ($rent)){
                $unit = PropertiesUnit::find($rent->unit_id);
                if($unit->user_id == \Auth::user()->id){
                    return $next($request);
                } else {
                    toastr()->error('Not a Valid User!');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Not a Valid User!');
                return redirect()->back();
            }
        } else if ( \Request::is('bill-confirmed/*') ) {
            $unitIds = [];
            $MeterReading = MeterReadings::where('id', $parameterId['id'])->first();
            if((\Auth::user()->user_role == self::Property_Manager) && ($MeterReading)){
                $units = DB::table('property_units')
                            ->select('id')
                            ->where('property_manager_id', \Auth::user()->id)
                            ->get();
                if($units){
                    foreach ($units as $key => $value) {
                        $unitIds[] = $value->id;
                    }
                }
                if(in_array($MeterReading->unit_id, $unitIds)){
                    return $next($request);
                } else {
                    toastr()->error('Not a Valid User!');
                    return redirect()->back();
                }
            } else if((\Auth::user()->user_role == self::Property_Owner) && ($MeterReading)){
                $unit = PropertiesUnit::find($MeterReading->unit_id);
                if($unit->user_id == \Auth::user()->id){
                    return $next($request);
                } else {
                    toastr()->error('Not a Valid User!');
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
