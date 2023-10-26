<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\MembershipPayments;
use Illuminate\Support\Facades\DB;
use App\Plans;
use App\Booking;
use Auth;
use Carbon\Carbon;
use App\Tickets;
use App\LegalActions;
use App\appointments;
use App\Transactions;
use App\Terminate;
use App\MeterReadings;
use App\PropertiesUnit;
use App\UnitsRent;
use App\Extend;
use App\Task;
Use Helper;

class DashboardController extends HomeController {

    const Tenant = 1;
    const Property_Owner = 2;
    const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;


    
    public function __construct(){
       $this->middleware('auth');
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */

    public function view(){
        $user = Auth::user();
        if(Auth::user()->user_role == self::Tenant){
            $contracts = count(Booking::where(['tenant_id' => $user->id,'status' => '3'])->get() );
            $appointments = appointments::where('tenant_id', \Auth::user()->id)->where('time', '>', date('Y/m/d H:i:s'))->orderBy('time','ASC')->take(5)->get();
            $transactions = Transactions::where('tenant_id','=', \Auth::user()->id)->orderBy('created_at','desc')->take(5)->get();
            $depositAmount = Transactions::where('tenant_id','=', \Auth::user()->id)->sum('amount');
            $PendingRequests = Booking::Join('property_units', 'property_units.id', '=', 'unit_booking.unit_id')
            ->where(['tenant_id' => $user->id,'status' => '-1'])
            ->where('property_units.booking_status', 0)->get();

            return view('userDashboard.tenant_dashboard')->with([
                'appointments' => $appointments,
                'transactions' => $transactions,
                'depositAmount' => $depositAmount,
                'contracts' => $contracts,
                'PendingRequests' => $PendingRequests,
            ]);
        }
        if(Auth::user()->user_role == self::Legal_Advisor){
            $buildingIds =  $unitIds = [];
            $numberOfUnits = null;
            $legalActions = [];
            $units = DB::table('property_units')
                            ->select('building_id')
                            ->where('property_legal_advisor_id', \Auth::user()->id)
                            ->where('building_id', '!=', 'NULL')
                            ->get();
            if($units){
                $numberOfUnits = $units->count();
                foreach ($units as $key => $value) {
                    $buildingIds[] = $value->building_id;
                }
            }
            $units = DB::table('property_units')
                            ->select('id')
                            ->where('property_legal_advisor_id', \Auth::user()->id)
                            ->get();
            $numberOfBuildings = count(array_unique($buildingIds));
            $numberOfContracts = Booking::where('lad_id', \Auth::user()->id)->count();
            $legalActions = LegalActions::where('legal_advisor_id', \Auth::user()->id )->orderBy('id','DESC')->take(5)->get();
            return view('userDashboard.legal_adviser_dashboard')->with([
                'legalActions' => $legalActions,
                'numberOfBuildings' => $numberOfBuildings,
                'numberOfUnits' => $numberOfUnits,
                'numberOfContracts' => $numberOfContracts,
            ]);
        }
        if(Auth::user()->user_role == self::Property_Owner){
            $unitIds = [];
            $extend_request_ids = [];
            $numberOfUnits = null;
            $units = DB::table('property_units')
                            ->select('id')
                            ->where('user_id', \Auth::user()->id)
                            ->get();
            $numberOfBuildings = DB::table('properties')
                            ->select('id')
                            ->where('user_id', \Auth::user()->id)
                            ->count();
            if($units){
                $numberOfUnits = $units->count();
                foreach ($units as $key => $value) {
                    $unitIds[] = $value->id;
                }
            }
            $contracts = DB::table('unit_booking')
                            ->where('status', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->get();
            $activeContracts = $contracts->count();
            $occuoideUnits = $contracts->count();
            // $unoccupideUnits = $numberOfUnits - $occuoideUnits;
            $unoccupideUnits = PropertiesUnit::where('user_id', \Auth::user()->id)->where('IsDeleted', '=' , 0)->where('booking_status', '=' , 0)
                                    ->orderBy('id', 'desc')
                                    ->get()->count();

            $running_contract = Booking::where('status','=', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(25)->get();
            if($running_contract){
                foreach ($running_contract as $key => $value) {
                    $extend_request_ids[] = $value->id;
                }
            }
            $extend_requests = Extend::whereIn('booking_id', $extend_request_ids)
                            ->orderBy('id','DESC')
                            ->take(5)->get();


            $endDate = Carbon::today()->addMonths(2)->format('d/m/Y');
            $contractEnd60Days = DB::table('unit_booking')
                            ->where('status', 6)
                            ->where('end_date','<', $endDate)
                            ->whereIn('unit_id', $unitIds)
                            ->count();
            $lastBookingRequests = Booking::where('status','<', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            
            $contractNearEnd = Booking::where('status','=', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('end_date','DESC')
                            ->take(5)->get();
            $newTenants = Booking::where('status','<', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('tenant_id','DESC')
                            ->distinct()->take(5)->get(['tenant_id']);
            $tickets = Tickets::whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            $legalActions  = LegalActions::where('po_id',\Auth::user()->id)
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            $terminateRequests  = Terminate::whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            $rentalBills = collect(MeterReadings::whereIn('unit_id',$unitIds)->where('status','pending')->get());
            $unitRent = collect(UnitsRent::whereIn('unit_id',$unitIds)->where('rent_status','pending')->get());
            $pendingPayments = $rentalBills->merge($unitRent)->sortByDesc('created_at');

            $rentalBills1 = collect(MeterReadings::whereIn('unit_id',$unitIds)->where('status','hold')->get());
            $unitRent1 = collect(UnitsRent::whereIn('unit_id',$unitIds)->where('rent_status','hold')->get());
            $tasks = $rentalBills1->merge($unitRent1)->sortByDesc('updated_at');

            $new_tasks = Task::where('status','Pending')->orWhere('status','Hold')->get();
            return view('userDashboard.po_dashboard')->with([
                'numberOfBuildings' => $numberOfBuildings,
                'numberOfUnits' => $numberOfUnits,
                'activeContracts' => $activeContracts,
                'occuoideUnits' => $occuoideUnits,
                'unoccupideUnits' => $unoccupideUnits,
                'contractEnd60Days' => $contractEnd60Days,
                'lastBookingRequests' => $lastBookingRequests,
                'contractNearEnd' => $contractNearEnd,
                'newTenants' => $newTenants,
                'tickets' => $tickets,
                'legalActions' => $legalActions,
                'tasks' => $tasks,
                'terminateRequests' => $terminateRequests,
                'pendingPayments' => $pendingPayments,
                'extend_requests' => $extend_requests,
                'new_tasks' => $new_tasks,
           ]);
        }
        if(Auth::user()->user_role == self::Property_Manager){
            $buildingIds =  $unitIds = []; $extend_request_ids = [];
            $numberOfUnits = null;
            $units = DB::table('property_units')
                            ->select('building_id')
                            ->where('property_manager_id', \Auth::user()->id)
                            ->where('building_id', '!=', 'NULL')
                            ->get();
            if($units){
                foreach ($units as $key => $value) {
                    $buildingIds[] = $value->building_id;
                }
            }
            $units = DB::table('property_units')
                            ->select('id')
                            ->where('property_manager_id', \Auth::user()->id)
                            ->get();
            $numberOfBuildings = count(array_unique($buildingIds));
            if($units){
                $numberOfUnits = $units->count();
                if($units){
                    $numberOfUnits = $units->count();
                    foreach ($units as $key => $value) {
                        $unitIds[] = $value->id;
                    }
                }
            }
            $contracts = DB::table('unit_booking')
                            ->where('status', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->get();
            $activeContracts = $contracts->count();
            $occuoideUnits   = $contracts->count();

            // $unoccupideUnits = $numberOfUnits - $occuoideUnits;
            $unoccupideUnits = PropertiesUnit::where('property_manager_id', \Auth::user()->id)->where('IsDeleted', '=' , 0)->where('booking_status', '=' , 0)
                                    ->orderBy('id', 'desc')
                                    ->get()->count();
                                    

            $endDate = Carbon::today()->addMonths(2)->format('Y/m/d');
            $contractEnd60Days = DB::table('unit_booking')
                            ->where('status', 6)
                            ->where('end_date','<', $endDate)
                            ->whereIn('unit_id', $unitIds)
                            ->count();
            $startDate = Carbon::today()->subDays(60)->format('Y/m/d');
            $contractStartLast60Days = DB::table('unit_booking')
                            ->where('status', 6)
                            ->where('start_date','>', $startDate)
                            ->whereIn('unit_id', $unitIds)
                            ->count();
            $lastBookingRequests = Booking::where('status','<', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(5)->get();


            $running_contract = Booking::where('status','=', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(25)->get();
            if($running_contract){
                foreach ($running_contract as $key => $value) {
                    $extend_request_ids[] = $value->id;
                }
            }
            $extend_requests = Extend::whereIn('booking_id', $extend_request_ids)
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            $contractNearEnd = Booking::where('status','=', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('end_date','DESC')
                            ->take(5)->get();
            $newTenants = Booking::where('status','<', 6)
                            ->whereIn('unit_id', $unitIds)
                            ->orderBy('tenant_id','DESC')
                            ->distinct()->take(5)->get(['tenant_id']);
            $tickets = Tickets::whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            $legalActions  = LegalActions::whereIn('unit_id', $unitIds )
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            $terminateRequests  = Terminate::whereIn('unit_id', $unitIds)
                            ->orderBy('id','DESC')
                            ->take(5)->get();
            $rentalBills = collect(MeterReadings::whereIn('unit_id',$unitIds)->where('status','pending')->get());
            $unitRent = collect(UnitsRent::whereIn('unit_id',$unitIds)->where('rent_status','pending')->get());
            $pendingPayments = $rentalBills->merge($unitRent)->sortByDesc('created_at');

            $rentalBills1 = collect(MeterReadings::whereIn('unit_id',$unitIds)->where('status','hold')->get());
            $unitRent1 = collect(UnitsRent::whereIn('unit_id',$unitIds)->where('rent_status','hold')->get());
            $tasks = $rentalBills1->merge($unitRent1)->sortByDesc('updated_at');
            return view('userDashboard.pm_dashboard')->with([
                'numberOfBuildings' => $numberOfBuildings,
                'numberOfUnits' => $numberOfUnits,
                'activeContracts' => $activeContracts,
                'contractStartLast60Days' => $contractStartLast60Days,
                'occuoideUnits' => $occuoideUnits,
                'unoccupideUnits' => $unoccupideUnits,
                'contractEnd60Days' => $contractEnd60Days,
                'lastBookingRequests' => $lastBookingRequests,
                'contractNearEnd' => $contractNearEnd,
                'newTenants' => $newTenants,
                'tickets' => $tickets,
                'tasks' => $tasks,
                'legalActions' => $legalActions,
                'pendingPayments' => $pendingPayments,
                'terminateRequests' => $terminateRequests,
                'extend_requests' => $extend_requests,
            ]);
        }
        if(Auth::user()->user_role == self::Property_Description_Experts){
            $buildingIds =  $unitIds = [];
            $numberOfUnits = null;
            $units = DB::table('property_units')
                            ->select('building_id')
                            ->where('property_description_experts_id', \Auth::user()->id)
                            ->where('building_id', '!=', 'NULL')
                            ->get();
            if($units){
                foreach ($units as $key => $value) {
                    $buildingIds[] = $value->building_id;
                }
            }
            $units = DB::table('property_units')
                            ->select('id')
                            ->where('property_description_experts_id', \Auth::user()->id)
                            ->get();
            $numberOfBuildings = count(array_unique($buildingIds));
            if($units){
                $numberOfUnits = $units->count();
                if($units){
                    $numberOfUnits = $units->count();
                    foreach ($units as $key => $value) {
                        $unitIds[] = $value->id;
                    }
                }
            }
            $numberOfTenants = Booking::whereIn('unit_id', $unitIds)->count();
            $today = Carbon::today()->format('Y/m/d');
            $tomorrow = Carbon::tomorrow()->format('Y/m/d');
            $appointments = appointments::where('pde_id', \Auth::user()->id)
                                                ->where('time', '>', $today)
                                                ->where('time', '<', $tomorrow)
                                                ->orderBy('time','ASC')
                                                ->take(5)->get();
            $NumberOfUpcomingAppointments = appointments::where('pde_id', \Auth::user()->id)
                                                ->where('time', '>', $today)
                                                ->count();
            $completedAppointments = appointments::where('pde_id', \Auth::user()->id)
                                                ->where('appointment_status', '=', 3)
                                                ->count();
            $upcomingAppointments = appointments::where('pde_id', \Auth::user()->id)
                                                ->where('time', '>', $tomorrow)
                                                ->orderBy('time','ASC')
                                                ->take(5)->get();                                    
            return view('userDashboard.p_description_e_dashboard')->with([
                'numberOfBuildings' => $numberOfBuildings,
                'numberOfUnits' => $numberOfUnits,
                'numberOfTenants' => $numberOfTenants,
                'NumberOfUpcomingAppointments' => $NumberOfUpcomingAppointments,
                'completedAppointments' => $completedAppointments,
                'appointments' => $appointments,
                'upcomingAppointments' => $upcomingAppointments,
            ]);
        }
        
        if(Auth::user()->user_role == self::Visit_Organizer){
            $buildingIds =  $unitIds = [];
            $numberOfUnits = null;
            $units = DB::table('property_units')
                            ->select('building_id')
                            ->where('property_visit_organizer_id', \Auth::user()->id)
                            ->where('building_id', '!=', 'NULL')
                            ->get();
            if($units){
                foreach ($units as $key => $value) {
                    $buildingIds[] = $value->building_id;
                }
            }
            $units = DB::table('property_units')
                            ->select('id')
                            ->where('property_visit_organizer_id', \Auth::user()->id)
                            ->get();
            $numberOfBuildings = count(array_unique($buildingIds));
            if($units){
                $numberOfUnits = $units->count();
                if($units){
                    $numberOfUnits = $units->count();
                    foreach ($units as $key => $value) {
                        $unitIds[] = $value->id;
                    }
                }
            }
            $numberOfTenants = Booking::whereIn('unit_id', $unitIds)->count();
            $today = Carbon::today()->format('Y/m/d');
            $tomorrow = Carbon::tomorrow()->format('Y/m/d');
            $appointments = appointments::where('vo_id', \Auth::user()->id)
                                                ->where('time', '>', $today)
                                                ->where('time', '<', $tomorrow)
                                                ->orderBy('time','ASC')
                                                ->take(5)->get();
            $NumberOfUpcomingAppointments = appointments::where('vo_id', \Auth::user()->id)
                                                ->where('time', '>', $today)
                                                ->count();
            $completedAppointments = appointments::where('vo_id', \Auth::user()->id)
                                                ->where('appointment_status', '=', 3)
                                                ->count();
            $upcomingAppointments = appointments::where('vo_id', \Auth::user()->id)
                                                ->where('time', '>', $today)
                                                ->orderBy('time','ASC')
                                                ->take(5)->get();                                    
            return view('userDashboard.visit_organiger_dashboard')->with([
                'numberOfBuildings' => $numberOfBuildings,
                'numberOfUnits' => $numberOfUnits,
                'numberOfTenants' => $numberOfTenants,
                'NumberOfUpcomingAppointments' => $NumberOfUpcomingAppointments,
                'completedAppointments' => $completedAppointments,
                'appointments' => $appointments,
                'upcomingAppointments' => $upcomingAppointments,
            ]);
        }
    }

    public function delete_booking(Request $request, $id)
    {
        Booking::where('id', $id)->delete();
        toastr()->success('Successfully canceled!');
        return Redirect('/dashboard');
    }
    
}