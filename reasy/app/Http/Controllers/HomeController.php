<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use App\User;
use App\Properties;
use App\Meters;
use App\Contracts;
use App\PropertiesUnit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Helper;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use App\Booking;
use App\Task;
use App\UnitsRent;
use App\Transactions;
use App\MeterReadings;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //HomePage View
    public function index(){
        $userIds = [];
        $validMemberShipUser = DB::table('membership_payments')
                              ->select('user_id')
                              ->where('membership_end_at', '>', Carbon::now())
                              ->get();
        foreach ($validMemberShipUser as $key => $value) {
          $userIds[] = $value->user_id;
        }
        $properties = PropertiesUnit::where('booking_status', '=' , 0)
                      ->where('IsDeleted', '=' , 0)
                      ->whereIn('user_id', $userIds);

        if(Session::get('user_role') == 1)
        {
          if(Auth::user())
          {
            $user = User::find(Auth::user()->id);
            if(!empty($user))
            {
              if($user->user_role == 3)
              {
                  $properties = $properties->where('property_manager_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 4) {
                  $properties = $properties->where('property_description_experts_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 5) {
                  $properties = $properties->where('property_legal_advisor_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 6) {
                  $properties = $properties->where('property_visit_organizer_id', '!=' , Auth::user()->id);
              }
            }
          }
        }
          $properties = $properties->orderBy('id', 'desc');
          $properties = $properties->paginate(8);
        return view('homepage')->with(['properties'=>$properties]);
    }
    //Home Page Ajax
    public function homePageAjax(Request $request){
        $userIds = [];
        $validMemberShipUser = DB::table('membership_payments')
                              ->select('user_id')
                              ->where('membership_end_at', '>', Carbon::now())
                              ->get();
        foreach ($validMemberShipUser as $key => $value) {
          $userIds[] = $value->user_id;
        }

        $properties = PropertiesUnit::where('booking_status', '=' , 0)
                      ->where('IsDeleted', '=' , 0)
                      ->whereIn('user_id', $userIds);

        if(Session::get('user_role') == 1)
        {
          if(Auth::user())
          {
            $user = User::find(Auth::user()->id);
            if(!empty($user))
            {
              if($user->user_role == 3)
              {
                  $properties = $properties->where('property_manager_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 4) {
                  $properties = $properties->where('property_description_experts_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 5) {
                  $properties = $properties->where('property_legal_advisor_id', '!=' , Auth::user()->id);
              }
              elseif ($user->user_role == 6) {
                  $properties = $properties->where('property_visit_organizer_id', '!=' , Auth::user()->id);
              }
            }
          }
        }
          $properties = $properties->orderBy('id', 'desc');
          $properties = $properties->paginate(8);

         // $properties = PropertiesUnit::where('booking_status', '=' , 0)
        //               ->where('IsDeleted', '=' , 0)
        //               ->whereIn('user_id', $userIds)
        //               ->orderBy('id', 'desc')
        //               ->paginate(8);
        $html = '';
        foreach ($properties as $key => $property) {
          $rent = Helper::CURRENCYSYMBAL.$property->rent;
          $url = '/images/property_banners/260X225/'.$property->cover_image;
          $html .='<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                      <a href="'.url('/propertydetails/'.$property->id).'">
                          <div class="property-main" style="background-image: url('.url($url).');">
                              <span class="prop-tag">'.substr($property->unit_name,0,15) .'...</span>
                              <div class="property-info">
                                  <h5 class="price">'.$rent.'</h5>
                                  <h5 class="add1">'.$property->address.'</h5>
                              </div>
                          </div>
                      </a>
                  </div>';
        }
        return $html;
    }

    public function search(Request $request)
    {
        $postData = Input::all();
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $page = $pageno;
        $limit = $no_of_records_per_page;

        $latitude = 0;
        $longitude = 0;
        $query = \DB::table('property_units')->select('*');
        if($postData['keyword'] != '' && !empty($postData['keyword']))
        { 
            $query = $query->where('unit_name', 'like', '%'.$postData['keyword'].'%');
        }
        if($postData['property_type'] != '' && !empty($postData['property_type']))
        {
            $query = $query->where('u_type',  $postData['property_type']);
        }

        if(isset($_GET['search']) && $_GET['search'] !="")
        { 
          if (isset($_GET['latitude']) && $_GET['latitude'] !="") 
          { 
            $latitude =$postData['latitude'];
            $longitude =$postData['longitude'];
            $query = $query->addSelect(DB::raw('( 
                  3959 * acos (
                    cos ( radians('.$latitude.') )
                    * cos( radians( latitude ) )
                    * cos( radians( longitude ) - radians('.$longitude.') )
                    + sin ( radians('.$latitude.') )
                    * sin( radians( latitude ) )
                  )
                ) as distance') )->having('distance','<',10);
          }
        }

        $query = $query->where('booking_status', '=' , 0);
        $query = $query->where('IsDeleted', '=' , 0);
        $total_property = $query->get();
        $property_list  = $query->limit($no_of_records_per_page)->offset($offset)->get();
       
        $total_rows = count($total_property);
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        return view('property_search_list',compact('property_list','page','total_pages','limit'));
    }

    public function change_to_tenant(Request $request)
    {
      if(Auth::user()->user_role == 3 || Auth::user()->user_role == 4 || Auth::user()->user_role == 5 || Auth::user()->user_role == 6)
      {
          Session::put('user_role', 1);
          Session::put('previous_role', Auth::user()->user_role);
          toastr()->success('Successfully switched!');
          return Redirect('/dashboard');
      }
      if(Session::get('user_role') == 1)
      {
          Session::put('user_role', 0);
          toastr()->success('Successfully switch back!');
          return Redirect('/dashboard');
      }
    }

    public function change_role(Request $request, $role)
    {
      if(Session::get('main_role') == 2)
      {
          Session::put('user_role', $role);
          // Session::put('previous_role', Auth::user()->user_role);
          toastr()->success('Successfully switched!');
          return Redirect('/dashboard');
      }
      // if(Session::get('user_role') == 1)
      // {
      //     Session::put('user_role', 0);
      //     toastr()->success('Successfully switch back!');
      //     return Redirect('/dashboard');
      // }
    }

    public function generate_rent(Request $request)
    {
        $currentDate = Carbon::now()->format('d');
        $today = Helper::Date(Carbon::now()->format('Y/m/d') );
        $contracts = Booking::where('status',6)->where('start_date', '<', $today)->where('end_date', '>=', $today)->get();
        if(count($contracts) > 0){
            foreach ($contracts as $key => $contract) {
                $contractStartDate = Carbon::parse($contract->start_date)->format('d');
                $contractMonthDiff = Carbon::parse($contract->start_date);

                if( ($currentDate == $contractStartDate) && ($contractMonthDiff->diffInMonths($today) > 0) ){
                    $unitRent = (int)$contract->rent;
                    if($unitRent > 0){
                        $unitsRent = UnitsRent::where('contract_id',$contract->id)
                                                ->where('user_id',$contract->tenant_id)
                                                ->where('date',$today)->first();
                        if($unitsRent){
                            $rent = $unitsRent;
                        } else {
                            $rent = new UnitsRent();
                        }

                        $user = User::find($contract->tenant_id);
                        $unit = PropertiesUnit::find($contract->unit_id);
                        if($user->wallet_amount >= $unitRent){
                            $user->wallet_amount = $user->wallet_amount - $unitRent;
                            $user->save();
                            $rent->rent_status = 'paid';

                            $transactions = new Transactions;
                            $transactions->tenant_id = $contract->tenant_id;
                            $transactions->contract_id = $contract->id;
                            $transactions->booking_id = $contract->id;
                            $transactions->related_to = 'rent';
                            $transactions->amount = $unitRent;
                            $transactions->payment_by ='wallet';
                            $transactions->save();

                            $emailData = array(
                                'tenant_name'   => $user->name." ".$user->last_name,
                                "email"         => $user->email,
                                "unit_name"     => $unit->unit_name,
                                "payment_method"   => 'wallet',
                                "price"         => $unitRent,
                            );
                            $tenantEmail = $user->email;
                            Mail::send('emails.tenant_unit_rent', $emailData, function($message) use ($tenantEmail) {
                                $message->to($tenantEmail)
                                        ->subject('Unit Rent Confirmation');
                                $message->from(env('APP_email'),'Reasy Property');
                            });
                        } else {
                            $rent->rent_status = 'pending';
                        }
                        $rent->rent = $unitRent;
                        $rent->total_amount = $unitRent+(int)$rent->electric_bill+(int)$rent->water_bill+(int)$rent->gas_bill;
                        $rent->user_id = $contract->tenant_id;
                        $rent->contract_id = $contract->id;
                        $rent->unit_id = $contract->unit_id;
                        $rent->date = $today;
                        $rent->save();
                    }
                }
            }
        }
    }

    public function generated_task(Request $request) 
    {
        // For pending Rent status with more than 7 days 
        $unitsRents = UnitsRent::where('rent_status','pending')->get();
        if(count($unitsRents) > 0){
            $today = Helper::Date(Carbon::now()->format('Y/m/d') );
            foreach ($unitsRents as $key => $rent) {
                // echo $rentDate = Carbon::parse($rent->updated_at);
                $rentDate = Carbon::parse($rent->date);
                if($rentDate->diffInDays($today) > 7){
                    // Helper::pr($rent->date);
                    // die('sdsdsd');

                    $task = Task::firstOrNew(['unit_id' =>$rent->unit_id,
                                        'contract_id' => $rent->contract_id,
                                        'status' => 'Pending']); 
                    $task->name         = 'Unit Rent Notification';
                    $task->description  = 'Task Descriptions';
                    $task->task_date    = $today;
                    $task->unit_id      = $rent->unit_id;
                    $task->contract_id  = $rent->contract_id;
                    $task->rent_id      = $rent->id;
                    $task->status       = 'Pending';
                    $task->purpose      = 'Unit Rent';
                    $task->save();

                    $unit = PropertiesUnit::find($rent->unit_id);
                    $user = User::find($rent->user_id);
                    $po = User::find($unit->user_id);
                    $pm = User::find($unit->property_manager_id);
                    
                    $emailData = array(
                        'tenant_name'   => $user->name." ".$user->last_name,
                        "email"         => $user->email,
                        "unit_name"     => $unit->unit_name,
                        "payment_method" => 'Bank Transfer',
                        "status"        => 'Pending',
                        "price"         => $rent->total_amount,
                    );
                    $tenantEmail = trim($user->email);
                    $poEmail = trim($po->email);
                    $pmEmail = trim($pm->email);

                    Mail::send('emails.hold_rent_notification', $emailData, function($message) use ($tenantEmail, $poEmail, $pmEmail) {
                        $message->to($tenantEmail, $poEmail, $pmEmail)
                                ->subject('Unit Rent Notification');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });
                }
            }
        }

        // //For Rent with hold status and more than 2 days
        $unitsRents = UnitsRent::where('rent_status','hold')->get();
        if(count($unitsRents) > 0){
            $today = Helper::Date(Carbon::now()->format('Y/m/d') );
            foreach ($unitsRents as $key => $rent) {
                $rentDate = Carbon::parse($rent->updated_at);
                if($rentDate->diffInDays($today) > 2){
                    $unit = PropertiesUnit::find($rent->unit_id);
                    $user = User::find($rent->user_id);
                    $po = User::find($unit->user_id);
                    $pm = User::find($unit->property_manager_id);

                    $task = Task::firstOrNew(['unit_id' =>$rent->unit_id,
                                        'contract_id' => $rent->contract_id,
                                        'status' => 'Pending']);

                    $task->name         = 'Unit Rent Notification';
                    $task->description  = 'Task Descriptions';
                    $task->task_date    = $today;
                    $task->unit_id      = $rent->unit_id;
                    $task->contract_id  = $rent->contract_id;
                    $task->purpose      = 'Unit Rent';
                    $task->rent_id      = $rent->id;
                    $task->status       = 'Hold';
                    $task->save();

                    $emailData = array(
                        'tenant_name'   => $user->name." ".$user->last_name,
                        "email"         => $user->email,
                        "unit_name"     => $unit->unit_name,
                        "payment_method" => 'Bank Transfer',
                        "status"        => 'Hold',
                        "price"         => $rent->total_amount,
                    );
                    $tenantEmail = $user->email;
                    $poEmail = $po->email;
                    $pmEmail = $pm->email;
                    Mail::send('emails.hold_rent_notification', $emailData, function($message) use ($tenantEmail, $poEmail, $pmEmail) {
                        $message->to($tenantEmail, $poEmail, $pmEmail)
                                ->subject('Unit Rent Notification');
                        $message->from(env('APP_email'),'Reasy Property');
                    });
                }
            }
        }

        //For Meter Bill with pending status and more than 7 days
        $meterReadings = MeterReadings::where('status','pending')->get();
        if(count($meterReadings) > 0){
            $today = Helper::Date(Carbon::now()->format('Y/m/d') );
            foreach ($meterReadings as $key => $reading) {
                $readingDate = Carbon::parse($reading->updated_at);
                if( $readingDate->diffInDays($today)  > 7 ){
                    $unit = PropertiesUnit::find($reading->unit_id);
                    $contract = Booking::where('unit_id',$reading->unit_id)->first();
                    $user = User::find($contract->tenant_id);
                    $po = User::find($unit->user_id);
                    $pm = User::find($unit->property_manager_id);

                    $contract = Booking::where('status',6)
                                    ->where('start_date', '<', $today)
                                    ->where('end_date', '>=', $today)
                                    ->where('unit_id', $reading->unit_id)
                                    ->first();

                    $task = Task::firstOrNew(['unit_id' =>$reading->unit_id,
                                        'contract_id' => $contract->id,
                                        'status' => 'Pending',
                                        'MeterReading_id' => $reading->id]); 
                    $task->name         = 'Meter Bill Notification';
                    $task->description  = 'Meter Descriptions';
                    $task->task_date    = $today;

                    $task->unit_id      = $reading->unit_id;
                    $task->contract_id  = $contract->id;
                    $task->purpose      = 'Meter Bill';
                    $task->MeterReading_id      = $reading->id;

                    $task->status       = 'Pending';
                    $task->save();
                    
                    $emailData = array(
                        'tenant_name'   => $user->name." ".$user->last_name,
                        "email"         => $user->email,
                        "unit_name"     => $unit->unit_name,
                        "payment_method" => 'Bank Transfer',
                        "status"        => 'Pending',
                        "price"         => $reading->amount,
                    );
                    $tenantEmail = $user->email;
                    $poEmail = $po->email;
                    $pmEmail = $pm->email;
                    Mail::send('emails.hold_bill_notification', $emailData, function($message) use ($tenantEmail, $poEmail, $pmEmail) {
                        $message->to($tenantEmail, $poEmail, $pmEmail)
                                ->subject('Meter Bill Notification');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });
                }
            }
        }

         //For Meter Bill with hold status and more than 2 days
        $meterReadings = MeterReadings::where('status','hold')->get();
        if(count($meterReadings) > 0){
            $today = Helper::Date(Carbon::now()->format('Y/m/d') );
            foreach ($meterReadings as $key => $reading) {
                $readingDate = Carbon::parse($reading->updated_at);
                if( $readingDate->diffInDays($today) > 7 ){
                    $unit = PropertiesUnit::find($reading->unit_id);
                    $contract = Booking::where('unit_id',$reading->unit_id)->first();
                    $user = User::find($contract->tenant_id);
                    $po = User::find($unit->user_id);
                    $pm = User::find($unit->property_manager_id);

                    $contract = Booking::where('status',6)
                                    ->where('start_date', '<', $today)
                                    ->where('end_date', '>=', $today)
                                    ->where('unit_id', $reading->unit_id)
                                    ->first();

                    $task = Task::firstOrNew(['unit_id' =>$reading->unit_id,
                                        'contract_id' => $contract->id,
                                        'status' => 'Pending',
                                        'MeterReading_id' => $reading->id]); 
                    $task->name         = 'Meter Bill Notification';
                    $task->description  = 'Meter Descriptions';
                    $task->task_date    = $today;

                    $task->unit_id      = $reading->unit_id;
                    $task->contract_id  = $contract->id;
                    $task->purpose      = 'Meter Bill';
                    $task->MeterReading_id      = $reading->id;

                    $task->status       = 'Hold';
                    $task->save();
                    
                    $emailData = array(
                        'tenant_name'   => $user->name." ".$user->last_name,
                        "email"         => $user->email,
                        "unit_name"     => $unit->unit_name,
                        "payment_method" => 'Bank Transfer',
                        "status"        => 'Hold',
                        "price"         => $rent->total_amount,
                    );
                    $tenantEmail = $user->email;
                    $poEmail = $po->email;
                    $pmEmail = $pm->email;
                    Mail::send('emails.hold_bill_notification', $emailData, function($message) use ($tenantEmail, $poEmail, $pmEmail) {
                        $message->to($tenantEmail, $poEmail, $pmEmail)
                                ->subject('Unit Rent Notification');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });
                }
            }
        }
    }
}
