<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use URL;
use Session;
use Redirect; 
use App\User;
use App\PropertiesUnit;
use App\UsersAvailability;
use App\Properties;
use App\Transactions;
use App\Messages;
use App\Meters;
use App\Contracts;
use App\Visits;
use App\appointments;
use App\Booking;
use App\TenantInvitation;
use App\Guarantor;
use App\email_log;
use App\Sub_Tenant;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; 
Use Helper;
use DB;
use Illuminate\Support\Facades\Hash;
use App\VerifyEmail;
use App\VerifyUser;
use App\UserBankAccount;
use App\Mail\VerifyMail;
use Mail;
use Notification;
use App\Notifications\CoTenantNotification;
use PDF;

class GuestController extends Controller {   
    public function __construct(){
     //   $this->middleware('auth');
    }

    public function createVisit(Request $request){
      // echo env('APP_email')."dffdfdf";
      // die('asasas');
        $postData = Input::all();
        $request->validate([
            'property_id'   => ['required'],
            'time'          => ['required','max:255'],
            'title'         => ['required'],
            'description'   => ['required'],
            'email'         => ['required'],
            'phone_number'  => ['required'],
            'name'          => ['required'],
        ]);  
        $tenant_id = "";
        $password = "";
        $phone_verify =  ($request->session()->get('phone_verify')) ? $request->session()->get('phone_verify') : 0 ;
        if(auth::guest())
        {
            $users = User::where(['email' => $postData['email'] ])->first();
            if(empty($users))
            {
                $password = rand();
                $user = new User;
                $user->name = $postData['name'];
                $user->email = $postData['email'];
                $user->password = Hash::make($password);
                $user->phone_no = $postData['phone_number'];
                $user->user_role     = "1";
                $user->verified = "1";
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->phone_verify = $phone_verify;
                $user->save();
                $tenant_id = $user->id;
                /************************/
                $to_name = $postData['name'];
                $to_email = $postData['email'];
                $data = array(
                    'name'=>$postData['name'],
                    "email" => $postData['email'],
                    "password" => $password,
                );
                    
                Mail::send('emails.welcome', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                            ->subject('Welcome Email from Reasy Properties');
                    $message->from(env('APP_email'),'Reasy Property');
                });
            }
    		else
    		{
                $phone_update = User::where(['id' => $users->id ])->update(['phone_verify' => $phone_verify,'phone_no' => $postData['phone_number']]);
    			$tenant_id = $users->id;
          		$password = $users->password;
    		}
            // die('amit');
        }
        else
        {
            $phone_update = User::where(['email' => $postData['email'] ])->update(['phone_verify' => $phone_verify, 'phone_no' => $postData['phone_number']]);
        }
        $vo = PropertiesUnit::select('property_visit_organizer_id')->find($request->input('property_id'))->toArray();
        $vo_id = $vo['property_visit_organizer_id'];
        $visits = new appointments;
        // $visits->name = $request->input('name');
        $visits->time = Helper::DateTime($request->input('time') );
        $visits->tenant_id = ($tenant_id) ? $tenant_id : Auth::user()->id;
        $visits->vo_id     = $vo_id;
        $visits->created_by     = ($tenant_id) ? $tenant_id : Auth::user()->id;
        $visits->assigned_to     = $vo_id;
        $visits->appointment_type     = 'Visit';
        // $visits->property_id = $request->input('property_id');
        $visits->unit_id = $request->input('property_id');
        $visits->title = $request->input('title');
        $visits->description = $request->input('description');
        // $visits->email = $request->input('email');
        // $visits->phone_number = $request->input('phone_number');
        $visits->save();
        $visit_id = $visits->id;

        $time = date('Y-m-d H:m:s', strtotime(date("Y-m-d H:m:s"). ' + 1 days'));
        $time = Helper::DateTime($time);

        $message = new Messages;
        $message->unit_id = $request->input('property_id');
        $message->appointment_id = $visit_id;
        $message->tenant_id = ($tenant_id) ? $tenant_id : Auth::user()->id;
        $message->vo_id     = $vo_id;
        $message->send      = ($tenant_id) ? $tenant_id : Auth::user()->id;
        $message->received  = $vo_id;
        $message->email_type     = 'Visit';
        $message->message   = $request->input('description');
        $message->time      = $time;
        $message->status      = '0';
        $message->save();

        $vo_details = User::find($vo_id)->toArray();

        $vo_name  = $vo_details['name'];
        $vo_email = trim($vo_details['email']);
        $vo_data = array(
            'name'      => $vo_details['name'],
            "email"     => $vo_details['email'],
            "title"     => $postData['title'],
            "time"      => Helper::DateTime($postData['time']),
            "description"   => $postData['description'],
        );

            
        Mail::send('emails.book_visit', $vo_data, function($message) use ($vo_name, $vo_email) {
            $message->to($vo_email, $vo_name)
                    ->subject('Book Appointment');
            $message->from(env('APP_email'),'Reasy Property');
        });

        $tenent_name = $postData['name'];
        $tenent_email = trim($postData['email']);
        $tenent_data = array(
            'name'      => $postData['name'],
            "email"     => $postData['email'],
            "title"     => $postData['title'],
            "time"      => Helper::DateTime($postData['time']),
            "description"     => $postData['description'],
        );
            
        Mail::send('emails.book_visit', $tenent_data, function($message) use ($tenent_name, $tenent_email) {
            $message->to($tenent_email, $tenent_name)
                    ->subject('Book Appointment');
            $message->from(env('APP_email'),'Reasy Property');
        });

        if(auth::guest())
        {
            Auth::loginUsingId($tenant_id);
        }
        toastr()->success('Visit booked successfully!');
        return back();

    }
    public function viewProperty($id){
        $units = PropertiesUnit::find($id);
        $amenities = DB::table('amenities')->get();
        // $contracts = Contracts::where(['property_unit_id' => $id])->get();
        $contracts = Booking::where(['unit_id' => $id,'status' => '6'])->get();
        $verifyEmail = 0;
        if(Auth::user() )
        {
            $email = Auth::user()->email;
            $EmailData = VerifyEmail::select('status')->where(['email' => $email])->first();
            $verifyEmail = ($EmailData) ? $EmailData->status : 0 ;            
        }

        $meters = Meters::where(['unit_id' => $id])->get();

        $vo_id =  $units->property_visit_organizer_id;
        $UsersAvailability = UsersAvailability::where('user_id', $vo_id)->first();
        $weekends  = $UsersAvailability['days'];
        $holidays1 = explode(',', $UsersAvailability['selecteddates']);
        foreach ($holidays1 as $key => $value) {
            $holidays[] = Helper::DateTime($value); 
        }
        $holidays = implode(',', $holidays);
        if($units){
            $images = array();
            if($units['images']) {
                $images = explode(',', $units['images']);
            }
            // Helper::pr($units);
            return view('viewproperty')->with(['data'=>$units,'images'=> $images,'amenities'=>$amenities,'contracts' => $contracts, 'VerifyEmail' => $verifyEmail,'weekends' => $weekends,'holidays' => $holidays,'meters' => $meters]);
        } else {
            return abort(404);
        }      
    }

    public function bookProperty(Request $request , $id){
        // /*Generate Invoice*/                
        // $rent_agreement = Helper::generate_invoice('67');
        $VerifyEmail = 0;
        $user = array();
        $guarantor = array();
        $booking_details = array();
        $tenant_ids = array();
        $tenant_photo = "";
        $tenant_photo_id_proof = "";
        $tenant_photo_esignature = "";
        $tenant_pay_slip = "";
        $unit = PropertiesUnit::find($id);
        $tenant_list = User::where('user_role','1')->get();
        if(Auth::user())
        {
            $email = Auth::user()->email; 
            $EmailData = VerifyEmail::select('status')->where(['email' => $email])->first();
            $VerifyEmail = ($EmailData) ? $EmailData->status : 0 ; 
            $user = Auth::user();           
            $booking_details = booking::where(['unit_id' => $id, 'tenant_id' => $user->id,'current_status' => '0'])->first();
            if($booking_details)
            {
                $tenant_ids = Sub_Tenant::where('booking_id', $booking_details->id)->pluck('tenant_id')->toArray();
            }
            // Helper::pr($booking_details);
            // Helper::pr($tenant_ids);
            // die('DDDDDDD');
            // if(!empty($booking_details)){
            //     if($booking_details->status == 9){
            //         $booking_details = array();
            //     }
            // }
            $guarantor = Guarantor::where(['unit_id' => $id, 'tenant_id' => $user->id])->first();
            $tenant_photo = $user->tenant_photo;
            $tenant_photo_id_proof = $user->tenant_photo_id_proof;
            $tenant_photo_esignature = $user->tenant_photo_esignature;
        }
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            // Helper::pr($postData);
            // die('ffftest');
            if($postData['step'] == 1)
            {
                $rules = array(
                    'email'         => 'required',
                    'phone_number'  => 'required',
                    'name'          => 'required',
                    'tenant_photo'                  => 'required|mimes:jpeg,png,jpg|max:2048',
                    'tenant_photo_id_proof'         => 'required|mimes:jpeg,png,jpg|max:2048',
                    // 'tenant_photo_esignature'       => 'required',
                );
                $message = array(
                    'name'          => 'Please enter name',
                    'email'         => 'Please enter email',
                    'phone_number'  => 'Please enter phone number',
                    'tenant_photo.required'             => 'Please upload photo',
                    'tenant_photo_id_proof.required'    => 'Please upload photo id proof',
                    'tenant_photo.mimes'            => 'The photo must be a file of type: jpeg, png, jpg.',
                    'tenant_photo_id_proof.mimes'   => 'The photo id proof must be a file of type: jpeg, png, jpg.',
                    'tenant_photo.max'           => 'The photo may not be greater than 2MB',
                    'tenant_photo_id_proof.max'  => 'The photo id proof may not be greater than 2MB',
                );
                $validator = Validator::make($postData, $rules, $message);
                if ($validator->fails())
                {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                    )); // 400 being the HTTP code for an invalid request.
                }
                else
                {
                    $tenant_id = "";
                    $password = "";
                    $tenant_photo = $tenant_photo_id_proof = '';
                    $phone_verify = ($request->session()->get('phone_verify')) ? $request->session()->get('phone_verify') : 0 ;

                    if ($request->hasFile('tenant_photo')) {
                        $image = $request->file('tenant_photo');
                        $tenant_photo = 'photo'.time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('images/users');
                        $image->move($destinationPath, $tenant_photo);
                    }
                    if ($request->hasFile('tenant_photo_id_proof')) {
                        $image = $request->file('tenant_photo_id_proof');
                        $tenant_photo_id_proof = 'photo_id_proof'.time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('images/users');
                        $image->move($destinationPath, $tenant_photo_id_proof);
                    }
                    if ($request->hasFile('tenant_pay_slip')) {
                        $image = $request->file('tenant_pay_slip');
                        $tenant_pay_slip = 'pay_slip'.time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('images/users');
                        $image->move($destinationPath, $tenant_pay_slip);
                    }

                    if(auth::guest())
                    {   
                        $users = User::where(['email' => $postData['email'] ])->first();
                        if(empty($users))
                        {
                            $password = rand();
                            $user = new User;
                            $user->name = $postData['name'];
                            $user->email = $postData['email'];
                            $user->password = Hash::make($password);
                            $user->phone_no = $postData['phone_number'];
                            $user->user_role     = "1";
                            $user->verified = "1";
                            $user->email_verified_at = date('Y-m-d H:i:s');
                            $user->phone_verify = $phone_verify;
                            $user->tenant_type = request('tenant_type');

                            $user->tenant_address = $postData['tenant_address'];

                            $user->company_name = $postData['company_name'];
                            $user->vat_nr = $postData['vat_nr'];
                            $user->company_address = $postData['company_address'];
                            $user->company_email = $postData['company_email'];
                            $user->company_phone = $postData['company_phone'];
                            $user->tenant_photo = $tenant_photo;
                            $user->tenant_photo_id_proof = $tenant_photo_id_proof;

                            $user->save();
                            $tenant_id = $user->id;
                            /************************/
                            $to_name = $postData['name'];
                            $to_email = $postData['email'];
                            $data = array(
                                'name'=>$postData['name'],
                                "email" => $postData['email'],
                                "password" => $password,
                            );
                                
                            Mail::send('emails.welcome', $data, function($message) use ($to_name, $to_email) {
                                $message->to($to_email, $to_name)
                                        ->subject('Welcome Email from Reasy Properties');
                                $message->from(env('APP_email'),'Reasy Property');
                            });
                        }
                        else
                        {
                            $user_update = array(
                                'tenant_type' => $postData['tenant_type'],
                                'tenant_address' => $postData['tenant_address'],
                                'company_name'  => $postData['company_name'],
                                'company_email' => $postData['company_email'],
                                'company_phone' => $postData['company_phone'],
                                'vat_nr'        => $postData['vat_nr'],
                                'company_address' => $postData['company_address'],
                                'phone_verify'  => $phone_verify,
                                'phone_no'      => $postData['phone_number'],
                                'tenant_photo'      => $tenant_photo,
                                'tenant_photo_id_proof'      => $tenant_photo_id_proof,
                            );

                            $phone_update = User::where(['id' => $users->id ])->update($user_update);
                            $tenant_id = $users->id;
                            $password = $users->password;
                        }
                        Auth::loginUsingId($tenant_id);
                    }
                    else
                    {
                        $tenant_id = $user->id;
                        $user_update = array(
                            'tenant_type' => $postData['tenant_type'],
                            'tenant_address' => $postData['tenant_address'],
                            
                            'company_name' => $postData['company_name'],
                            'company_email' => $postData['company_email'],
                            'company_phone' => $postData['company_phone'],
                            'vat_nr'        => $postData['vat_nr'],
                            'company_address' => $postData['company_address'],
                            'phone_verify' => $phone_verify,
                            'phone_no'      => $postData['phone_number'],
                        );
                        $phone_update = User::where(['email' => $postData['email'] ])->update($user_update);
                    }

                    
                    // $tenant_photo_esignature = $postData['tenant_photo_esignature'];
                    $where_data = array('unit_id' => $id, 'tenant_id' => $tenant_id, 'current_status' => '0');
                    $booking_data = array(
                        'step' => $postData['step'],
                        'tenant_photo' =>$tenant_photo,
                        'tenant_photo_id_proof' =>$tenant_photo_id_proof,
                        // 'tenant_photo_esignature' =>$tenant_photo_esignature,
                        'tenant_pay_slip'       =>$tenant_pay_slip,
                        'pde_id'=>$unit->property_description_experts_id,
                        'lad_id'=>$unit->property_legal_advisor_id,
                        'vo_id' =>$unit->property_visit_organizer_id,
                        'po_id' =>$unit->user_id,
                        'pm_id' =>$unit->property_manager_id,
                        'rent'  =>$unit->rent,
                        'deposit_amount'  =>$unit->deposit,
                        'cost_provision' =>$unit->cost_provision,
                        'fixed_charges' =>$unit->fix_price,
                        'property_tax' =>$unit->tax,
                    );

                    $booking = Booking::updateOrCreate($where_data, $booking_data);
                    // if(isset($postData['selected_tenant']) && is_array($postData['selected_tenant']))
                    // {
                    //     foreach ($postData['selected_tenant'] as $key => $value) {
                    //         $subTenant = new Sub_Tenant;
                    //         $subTenant->unit_id = $id;
                    //         $subTenant->booking_id = $booking->id;
                    //         $subTenant->tenant_id = $value;
                    //         $subTenant->save();                     
                    //     }
                    // }

                    if(isset($postData['co_tenant_1']) && !empty($postData['co_tenant_1']))
                    {
                        $to_email = trim($postData['co_tenant_1']);

                        $TenantInvitation = new TenantInvitation;
                        $TenantInvitation->unit_id = $id;
                        $TenantInvitation->booking_id = $booking->id;
                        $TenantInvitation->tenant_id = $tenant_id;
                        $TenantInvitation->email = $to_email;
                        $TenantInvitation->send_time = Helper::DateTime(date('Y-m-d h:i:s'));
                        $TenantInvitation->save();

                        // $data = array(
                        //     "email" => trim($to_email),
                        //     "Invitation_id" => $TenantInvitation->id,
                        //     'tenant_id'     => $tenant_id,
                        //     "tenant_name"   => Auth::user()->name,
                        //     "unit_id"       => $id,
                        // );
                            
                        // Mail::send('emails.Co-Tenant-invitation', $data, function($message) use ($to_email) {
                        //     $message->to($to_email,'Tenant')
                        //             ->subject('Invitation request to become Co-Tenant');
                        //     $message->from('amitpunjvision@gmail.com','Reasy Property');
                        // });
                    }
                    if(isset($postData['co_tenant_2']) && !empty($postData['co_tenant_2']))
                    {
                        $to_email = trim($postData['co_tenant_2']);

                        $TenantInvitation = new TenantInvitation;
                        $TenantInvitation->unit_id = $id;
                        $TenantInvitation->booking_id = $booking->id;
                        $TenantInvitation->tenant_id = $tenant_id;
                        $TenantInvitation->email = $to_email;
                        $TenantInvitation->send_time = Helper::DateTime(date('Y-m-d h:i:s'));
                        $TenantInvitation->save();

                        // $data = array(
                        //     "email" => trim($to_email),
                        //     "Invitation_id" => $TenantInvitation->id,
                        //     'tenant_id'     => $tenant_id,
                        //     "tenant_name"   => Auth::user()->name,
                        //     "unit_id"       => $id,
                        // );
                            
                        // Mail::send('emails.Co-Tenant-invitation', $data, function($message) use ($to_email) {
                        //     $message->to($to_email,'Tenant')
                        //             ->subject('Invitation request to become Co-Tenant');
                        //     $message->from('amitpunjvision@gmail.com','Reasy Property');
                        // });
                    }
                    if(isset($postData['co_tenant_3']) && !empty($postData['co_tenant_3']))
                    {
                        $to_email = trim($postData['co_tenant_3']);

                        $TenantInvitation = new TenantInvitation;
                        $TenantInvitation->unit_id = $id;
                        $TenantInvitation->booking_id = $booking->id;
                        $TenantInvitation->tenant_id = $tenant_id;
                        $TenantInvitation->email = $to_email;
                        $TenantInvitation->send_time = Helper::DateTime(date('Y-m-d h:i:s'));
                        $TenantInvitation->save();

                        // $data = array(
                        //     "email" => trim($to_email),
                        //     "Invitation_id" => $TenantInvitation->id,
                        //     'tenant_id'     => $tenant_id,
                        //     "tenant_name"   => Auth::user()->name,
                        //     "unit_id"       => $id,
                        // );
                            
                        // Mail::send('emails.Co-Tenant-invitation', $data, function($message) use ($to_email) {
                        //     $message->to($to_email,'Tenant')
                        //             ->subject('Invitation request to become Co-Tenant');
                        //     $message->from('amitpunjvision@gmail.com','Reasy Property');
                        // });
                    }
                    return Response()->json(array(
                        'success' => true,
                        'booking' => $booking,
                        'booking_id' => $booking->id,
                        'tenant_id'	 => $tenant_id,
                    ));
                }
            }
            elseif ($postData['step'] == 2) 
            {
                $photo = "";
                $photo_id_proof = "";
                $tenant_id = $postData['tenant_id'];
                // Helper::pr($postData);
                // die('ffffffffffff');
                if($postData['choose_guarantor'] == 'yes')
                {
                    $rules = array(
                        'name'          => 'required',
                        'email'         => 'required',
                        'phone_no'      => 'required',
                        // 'photo'         => 'required|mimes:jpeg,png,jpg|max:2048',
                        'photo_id_proof'=> 'required|mimes:jpeg,png,jpg|max:2048',
                    );
                    $message = array(
                        'name'          => 'Please enter name',
                        'email'         => 'Please enter email',
                        'phone_no'      => 'Please enter phone number',
                        // 'photo.required'             => 'Please upload photo',
                        // 'photo_id_proof.required'    => 'Please upload photo id proof',
                        // 'photo.mimes'            => 'The photo must be a file of type: jpeg, png, jpg.',
                        'photo_id_proof.mimes'   => 'The photo id proof must be a file of type: jpeg, png, jpg.',
                        'photo.max'           => 'The photo may not be greater than 2MB',
                        'photo_id_proof.max'  => 'The photo id proof may not be greater than 2MB',
                    );
                    $validator = Validator::make($postData, $rules, $message);
                    if ($validator->fails())
                    {
                        return Response()->json(array(
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray()
                        )); // 400 being the HTTP code for an invalid request.
                    }
                    else
                    {
                        // if ($request->hasFile('photo')) {
                        //     $image = $request->file('photo');
                        //     $photo = 'photo'.time().'.'.$image->getClientOriginalExtension();
                        //     $destinationPath = public_path('images/guarantor');
                        //     $image->move($destinationPath, $photo);
                        // }
                        if ($request->hasFile('photo_id_proof')) {
                            $image = $request->file('photo_id_proof');
                            $photo_id_proof = 'photo_id_proof'.time().'.'.$image->getClientOriginalExtension();
                            $destinationPath = public_path('images/guarantor');
                            $image->move($destinationPath, $photo_id_proof);
                        }
                        $where_data = array('unit_id' => $id, 'tenant_id' => $tenant_id);
                        $guarantor_data = array(
                            'name' =>$postData['name'],
                            'email' =>$postData['email'],
                            'phone_no' =>$postData['phone_no'],
                            'address' =>$postData['address'],
                            // 'photo' =>$photo,
                            'photo_id_proof' =>$photo_id_proof,
                        );
                        if($guarantor = Guarantor::updateOrCreate($where_data, $guarantor_data))
                        {
                            $booking_data = array(
                                'step' =>2, 
                                'choose_guarantor' =>$postData['choose_guarantor'],
                                'guarantor_id' => $guarantor->id
                            );
                            $booking = Booking::where($where_data)->where(['current_status' => '0'])->update($booking_data);
                            return Response()->json(array(
    	                        'success' => true,
    	                        'booking' => $booking,
    	                        'tenant_id' => $tenant_id
    	                    ));
                        }
                    }
                }
                elseif($postData['choose_guarantor'] == 'no')
                {
                    $where_data = array('unit_id' => $id, 'tenant_id' => $tenant_id);
                    $guarantor = Guarantor::where($where_data)->delete();
                    $booking_data = array(
                        'step' =>2, 
                        'choose_guarantor' =>$postData['choose_guarantor'],
                        'guarantor_id' => '0'
                    );
                    $booking = Booking::where($where_data)->where(['current_status' => '0'])->update($booking_data);
                    return Response()->json(array(
                        'success' => true,
                        'booking' => $booking,
                        'tenant_id' => $tenant_id
                    ));
                }
            }
            elseif ($postData['step'] == 3) 
            {
            	// Helper::pr($postData);
            	// die('dddddddddddd');
                $tenant_id = $postData['tenant_id'];
                $rules = array(
                    'start_date'    => 'required',
                    'end_date'      => 'required',
                    'tenant_photo_esignature'       => 'required',
                );
                $message = array(
                    'start_date.required'      => 'Please select start date',
                    'end_date.required'        => 'Please select end date',
                );
                $validator = Validator::make($postData, $rules, $message);
                if ($validator->fails())
                {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                    )); // 400 being the HTTP code for an invalid request.
                }
                else
                {
                	$where_data = array('unit_id' => $id, 'tenant_id' => $tenant_id, 'current_status' => '0');
                    $tenant_photo_esignature = $postData['tenant_photo_esignature'];
                    $booking_data = array(
                    	'step' =>3, 
                    	'contract_type' => $postData['contract_type'],
                    	'start_date'    => Helper::Date($postData['start_date']),
                    	'end_date'      => Helper::Date($postData['end_date']),
                        'tenant_photo_esignature' =>$tenant_photo_esignature,
                	);
                    $booking = Booking::where($where_data)->update($booking_data);
                    return Response()->json(array(
                        'success' => true,
                        'booking' => $booking,
                        'tenant_id' => $tenant_id
                    ));
                }
            }
            elseif ($postData['step'] == 4) 
            {
            	// Helper::pr($postData);
            	// die('dddddddddddd');
                $tenant_id = $postData['tenant_id'];
            	$where_data = array('unit_id' => $id, 'tenant_id' => $tenant_id, 'current_status' => '0');
                $booking_details = Booking::where($where_data)->first();

                /*Generate Agreement*/                
                $rent_agreement = Helper::generate_agreement($booking_details->id);
               
                $booking_data = array(
                    'step' =>4, 
                    'total_amount' => $postData['total_amount'],
                    // 'rent_agreement' => $rent_agreement,
                );
                $booking = Booking::where($where_data)->update($booking_data);
                // Helper::pr($rent_agreement);
                // die('dfdff');
                return Response()->json(array(
                    'success' => true,
                    'booking' => $booking,
                    'tenant_id' => $tenant_id,
                    'booking_id' => $booking_details->id,
                ));
            }
        }
        return view('book_property',compact('VerifyEmail','user','booking_details', 'id', 'guarantor','unit','tenant_list','tenant_ids')); 
    }

    public function co_tenant_response(Request $request, $id, $response)
    {
        if (Auth::user())
        {
            toastr()->warning('Sorry! you already logged in!');
            return redirect('/');
        }
        $postData = input::all();
        $TenantInvitation = TenantInvitation::find($id);
        // helper::pr($TenantInvitation);
        // die('dfdf');
        $unit_id = $TenantInvitation->unit_id;
        $booking_id = $TenantInvitation->booking_id;
        $tenant_id = $TenantInvitation->tenant_id;
        $current_time = strtotime(date("Y/m/d"));
        $send_time = date('Y/m/d', strtotime($TenantInvitation->send_time. ' +3 day') );
        $send_time = strtotime($send_time);

        if($TenantInvitation->response == 1)
        {
            toastr()->warning('Sorry! you already respond on this!');
            return redirect('propertydetails/'.$unit_id);
        }

        if($current_time > $send_time )
        {
            toastr()->warning('Sorry! Now, you are late to response!');
            return redirect('propertydetails/'.$unit_id);
        }
        else
        {
            if($response == 'Yes')
            {
                /*check already exist or not*/
                $user = User::where('email',$TenantInvitation->email)->first();
                if($user && !empty($user))
                {
                    $subTenant = new Sub_Tenant;
                    $subTenant->unit_id = $unit_id;
                    $subTenant->booking_id = $booking_id;
                    $subTenant->tenant_id = $user->id;
                    $subTenant->save(); 

                    $TenantInvitation->status = 'Yes';
                    $TenantInvitation->response = 1;
                    $TenantInvitation->save();

                    /*Generate Agreement*/                
                    $rent_agreement = Helper::generate_agreement($booking_id);

                    $tenant_details = User::find($tenant_id);
                    $details = [
                        'subject'  => 'Co-Tenant Response',
                        'greeting' => 'Hi, '. $tenant_details->name,
                        'body' => 'Co-Tenant invitation request accepted by '.$TenantInvitation->email,
                        'actionURL' => $unit_id,
                        'thanks' => 'Thank you for using Reasy Property!',
                    ];
                    Notification::send($tenant_details, new CoTenantNotification($details));

                    toastr()->success('You accepted successfully!');
                    return redirect('propertydetails/'.$unit_id);    
                }
                else
                {
                    return view('tenant.co-tenant-register',compact('TenantInvitation'));
                }
            }
            else
            {
                $TenantInvitation->status = 'No';
                $TenantInvitation->response = 1;
                $TenantInvitation->save();

                $tenant_details = User::find($tenant_id);
                $details = [
                    'subject'  => 'Co-Tenant Response',
                    'greeting' => 'Hi, '. $tenant_details->name,
                    'body' => 'Co-Tenant invitation request rejected by '.$TenantInvitation->email,
                   'actionURL' => $unit_id,
                    'thanks' => 'Thank you for using Reasy Property!',
                ];
                Notification::send($tenant_details, new CoTenantNotification($details));

                toastr()->success('You denied successfully!');
                return redirect('propertydetails/'.$unit_id);
            }
        }
    }

    public function co_tenant_register(Request $request)
    {
        $postData = Input::all();
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tenant_photo_esignature' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
        ], [
            'password.regex' => 'Your password must be atleast 8 characters long, 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.',
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'user_role' => 1,
            'password' => Hash::make($request->input('password')),
            'verified' => "1",
            'email_verified_at' => date('Y-m-d H:i:s'),
            'tenant_photo_esignature' => $request->input('tenant_photo_esignature'),
        ]); 

        $TenantInvitation = TenantInvitation::find($postData['co_tenant_id']);
        $unit_id = $TenantInvitation->unit_id;
        $booking_id = $TenantInvitation->booking_id;
        $tenant_id = $TenantInvitation->tenant_id;

        $subTenant = new Sub_Tenant;
        $subTenant->unit_id = $unit_id;
        $subTenant->booking_id = $booking_id;
        $subTenant->tenant_id = $user->id;
        $subTenant->save(); 

        $TenantInvitation->status = 'Yes';
        $TenantInvitation->response = 1;
        $TenantInvitation->save();

        /*Generate Agreement*/                
        $rent_agreement = Helper::generate_agreement($booking_id);
        $tenant_details = User::find($tenant_id);
        $details = [
            'subject'  => 'Co-Tenant Response',
            'greeting' => 'Hi, '. $tenant_details->name,
            'body' => 'Co-Tenant invitation request accepted by '.$TenantInvitation->email,
            'actionURL' => $unit_id,
            'thanks' => 'Thank you for using Reasy Property!',
        ];
        Notification::send($tenant_details, new CoTenantNotification($details));

        toastr()->success('You accepted successfully!');
        return redirect('propertydetails/'.$unit_id);    
    }
    public function buy_property(Request $request, $id)
    {
        $payment_for = 'buy_property'; 
        $tenant_id  = Auth::user()->id;
        $user       = Auth::user();
        $contract   = Booking::find($id);
        $unit = PropertiesUnit::find($contract->unit_id);
        return view('contracts.check-out',compact('contract','unit','id','payment_for','user'));
    }

    public function upload_receipt(Request $request)
    {
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $receipt_name = "";
            $rules = array(
                'receipt'=> 'required|mimes:jpeg,png,jpg|max:2048',
            );
            $message = array(
                'receipt.required' => 'Please upload receipt',
                'receipt.mimes'    => 'The receipt must be a file of type: jpeg, png, jpg.',
                'receipt.max'      => 'The receipt may not be greater than 2MB',
            );
            $validator = Validator::make($postData, $rules, $message);
            if ($validator->fails())
            {
                toastr()->error('Receipt is not Uploaded Successfully!');
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                if ($request->hasFile('receipt')) {
                    $image = $request->file('receipt');
                    $receipt_name = 'receipt'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('images/bank_receipt');
                    $image->move($destinationPath, $receipt_name);
                }

                $where_data = array('id' => $postData['booking_id']);
                $booking_details = Booking::where($where_data)->first();

                $transaction = new Transactions();
                $transaction->related_to = 'Rent';
                // $transaction->description = 'Description';
                $transaction->amount = $booking_details->total_amount;
                $transaction->payment_by = 'Bank Transfer';
                $transaction->booking_id = $postData['booking_id'];
                $transaction->save();
                $transaction_id = $transaction->id;

                $booking_data = array(
                    'receipt_status' =>'yes', 
                    'bank_receipt' => $receipt_name,
                    'payment_status' => 'paid',
                    'transaction_id' => $transaction_id,
                );

                $tenant = User::find($booking_details->tenant_id);
                $tenant->receipt_failed_count = 0;
                $tenant->save(); 

                $tenant_name      = $tenant['name'];
                $tenant_email     = trim($tenant['email']);

                /*Generate Invoice*/                
                $invoice = Helper::generate_invoice($postData['booking_id']);
                $booking_data['invoice'] = $invoice;
                
                $path = public_path('images/invoice/'.$invoice);
                $tenant_data = array(
                    'name'      => $tenant['name'],
                    "unit_name"     => Helper::unit_name($booking_details->unit_id),
                );

                Mail::send('emails.invoice_to_tenant', $tenant_data, function($message) use ($tenant_name, $tenant_email,$path) {
                    $message->to($tenant_email, $tenant_name)
                            ->subject('Property Booking');
                    $message->from(env('APP_email'),'Reasy Property')
                    ->attach($path, [
                        'as' => 'Invoice.pdf', 
                        'mime' => 'application/pdf'
                    ]);
                });

                $booking = Booking::where($where_data)->update($booking_data);
                toastr()->success('Receipt Uploaded Successfully!');
                return Redirect($postData['url']);
            }
        }
    }

    public function guarantor_view(Request $request, $id)
    {
        $id = Helper::encrypt_decrypt($id, 'd' );
        $guarantor = Guarantor::where(['id' => $id])->first();
        return view('guarantor.view',compact('guarantor'));
    }
    public function contract_guarantor_view(Request $request, $id)
    {
        $guarantor = Guarantor::where(['id' => $id])->first();
        return view('guarantor.contract-guarantor',compact('guarantor'));
    }

    public function guarantor_update(request $request, $id)
    {
        $id = Helper::encrypt_decrypt($id, 'd' );
        $guarantor = Guarantor::where(['id' => $id])->first();
        if($request->isMethod('post'))
        {
            $postData = input::all();
            $rules = array(
                'name'=> 'required',
                'address'=> 'required',
                'phone_no'=> 'required|numeric',
                'email'=>'required|email',
                'photo_id_proof.*' => 'mimes:jpeg,png,jpg|max:2048',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                $photo = ($postData['photo']) ? $postData['photo'] : $guarantor->photo ;
                $photo_id_proof = $guarantor->photo_id_proof;
                if ($request->hasFile('photo_id_proof')) {
                    $image = $request->file('photo_id_proof');
                    $photo_id_proof = 'photo_id_proof'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('images/guarantor');
                    $image->move($destinationPath, $photo_id_proof);
                }

                $guarantor->name = $postData['name']; 
                $guarantor->phone_no = $postData['phone_no']; 
                $guarantor->address = $postData['address']; 
                $guarantor->email = $postData['email'];
                $guarantor->photo = $photo;
                $guarantor->photo_id_proof = $photo_id_proof;
                $guarantor->save();

                $bID= '';
                if(isset($_GET['booking_id']) && !empty($_GET['booking_id']))
                {
                    $booking_id = $_GET['booking_id'];
                    $bID = '?booking_id='.$_GET['booking_id'];
                    if(!empty($guarantor->photo) && !is_null($guarantor->photo) && $guarantor->photo != '')
                    {
                        $rent_agreement = Helper::generate_agreement($booking_id);
                    }
                }
                toastr()->success('Guarantor Details Updated Successfully!');
                return redirect('/guarantor-view/'.Helper::encrypt_decrypt($id, 'e' ).''.$bID);
            }
        }
        return view('guarantor.guarantor-update',compact('guarantor') );
    }

    public function upload_signature(Request $request)
    {
        if($request->isMethod('post'))
        {
            $result = array();
            $imagedata = base64_decode($_POST['img_data']);
            // echo $filename = md5(date("dmYhisA"));
            $filename = $image_name = 'photo_esignature'.time().'.png';
            //Location to where you want to created sign image
            $destinationPath = public_path('images/users');
            $file_name = $destinationPath.'/'.$filename;
            file_put_contents($file_name,$imagedata);
            $result['status'] = 1;
            $result['file_name'] = $file_name;
            $result['image_name'] = $image_name;
            // Helper::pr($result);
            echo json_encode($result);
        }
    }

    public function send_message(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            $postData = input::all();
            $rules = array(
                'email' => 'required|email',
                'phone_number' => 'required',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                $tenant_id = "";
                $password = "";
                $phone_verify =  ($request->session()->get('phone_verify')) ? $request->session()->get('phone_verify') : 0 ;
                if(auth::guest())
                {
                    $users = User::where(['email' => $postData['email'] ])->first();
                    if(empty($users))
                    {
                        $password = rand();
                        $user = new User;
                        $user->name = $postData['name'];
                        $user->email = $postData['email'];
                        $user->password = Hash::make($password);
                        $user->phone_no = $postData['phone_number'];
                        $user->user_role     = "1";
                        $user->verified = "1";
                        $user->email_verified_at = date('Y-m-d H:i:s');
                        $user->phone_verify = $phone_verify;
                        $user->save();
                        $tenant_id = $user->id;
                        /************************/
                        $to_name = $postData['name'];
                        $to_email = $postData['email'];
                        $data = array(
                            'name'=>$postData['name'],
                            "email" => $postData['email'],
                            "password" => $password,
                        );
                            
                        Mail::send('emails.welcome', $data, function($message) use ($to_name, $to_email) {
                            $message->to($to_email, $to_name)
                                    ->subject('Welcome Email from Reasy Properties');
                            $message->from(env('APP_email'),'Reasy Property');
                        });
                    }
                    else
                    {
                        $phone_update = User::where(['id' => $users->id ])->update(['phone_verify' => $phone_verify]);
                        $tenant_id = $users->id;
                        $password = $users->password;
                    }
                    // die('amit');
                }
                else
                {
                    $tenant_id = Auth::user()->id;
                    $phone_update = User::where(['email' => $postData['email'] ])->update(['phone_verify' => $phone_verify]);
                }

                // $user = User::where(['email' => $postData['email'] ])->first();
                // if(empty($user) && $user == "" )
                // {
                //     $user = User::create([
                //                 'name'      => $postData['name'],
                //                 'email'     => $postData['email'],
                //                 'phone_no'  => $postData['phone_number'],
                //                 'user_role' => 1,
                //                 'password'  => '',
                //             ]);
                //     $verifyUser = VerifyUser::create([
                //         'user_id' => $user->id,
                //         'token' => str_random(40)
                //     ]);
                //     $user['token'] = $verifyUser->token;
                //     Mail::to($user->email)->send(new VerifyMail($user));
                // }
                /* Get Data of property owner*/
                // $data = DB::table('users')
                //     ->select('users.*','users.id as user_id')
                //     ->Join('property_units', 'users.id', '=', 'property_units.user_id')
                //     ->where(['property_units.id' => $id])
                //     ->first();
                // echo $id;
                $data = PropertiesUnit::where(['id' => $id])->first();
                    // Helper::pr($data->user->email);
                    // die('fff');

                $owner_email = $data->user->email;
                $owner_name = $data->user->name;
                $subject = "Email Sent"; 
                $admin_mail = env('APP_email');

                $owner_data = array(
                    'username' => $data->name,
                    'logo'     => 'http://angular.visionvivante.com/assets/manga/logo.png',
                    'email'    =>  $data->email,
                    'message_data'  =>  $postData['message'],
                    'phone_no' =>  $data->phone_no,
                    'owner_name' => $owner_name,
                    'tenant_name' => $postData['name'],
                    'tenant_phone' => $postData['phone_number'],
                    'tenant_email' => trim($postData['email']),
                    'unit_id' => $id,
                    'tenant_id' => $tenant_id,
                );

                /* Email to property owner start*/
                Mail::send(['html' => 'emails/send_message-owner'], $owner_data, function ($message) use ($owner_data,$owner_email,$admin_mail,$owner_name,$subject){
                        $message->from($admin_mail, 'Reasy Property');
                        $message->to($owner_email,$owner_name)->subject($subject);
                });
                /* Email to property owner end*/
                
                /* Email to Tenant end */
                $email_data = array(
                    'username' => $postData['name'],
                    'logo'     => 'http://angular.visionvivante.com/assets/manga/logo.png',
                    'email'    =>  $postData['email'],
                    'message_data'  =>  $postData['message'],
                    'new_user'  =>  $postData['new_user'],
                    'phone_no' =>  $postData['phone_number'],
                    'owner_name' => $owner_name,
                    'url' => '',
                    'unit_id' => $id,
                    'tenant_id' => $tenant_id,

                );

                $customer_email = trim($postData['email']);
                $customer_name = $postData['name']; 
                /* Email to tenant start*/
                Mail::send(['html' => 'emails/send_message'], $email_data, function ($message) use ($email_data,$customer_email,$admin_mail,$customer_name,$subject){
                        $message->from($admin_mail, 'Reasy Property');
                        $message->to($customer_email,$customer_name)->subject($subject);
                });
                /* Email to tenant end*/

                $email_log = new email_log;
                $email_log->unit_id = $id;
                $email_log->tenant_id = $tenant_id;
                $email_log->vo_id     = $data->user->id;
                $email_log->send        = $tenant_id;
                $email_log->received     = $data->user->id;
                $email_log->email_type     = 'message';
                $email_log->message     = $postData['message'];
                $email_log->save();

                
                if(auth::guest())
                {   
                    Auth::loginUsingId($tenant_id);
                }
                toastr()->success('Email sent successfully!');
                return Redirect('propertydetails/'.$id);
            }
        }

        return view('tenant/send_message',compact('id')); 
    }

    public function check_user(Request $request)
    {
        if($request->isMethod('post'))
        {
            $postData = input::all();
            $rules = array(
                'email' => 'required|string|email|max:255',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                return response()->json(['data'=>'Please enter a valid email','status' => 'error']);
            }
            else
            {
                $users = User::where(['email' => $postData['email'] ])->first();
                if(!empty($users) && $users )
                {
                    return response()->json(['data'=>'User already exist','status' => 'success']);
                }
                else
                {
                    $confirmation_code = $this->randomPassword();
                    $customer_email =  $postData['email'];
                    $admin_mail = env('APP_email');
                    $customer_name = 'Reasy Property';
                    $subject = "Email Verification";
                    $email_data = array(
                        'email' => $postData['email'],
                        'confirmation_code' => $confirmation_code,
                    );
                    $VerifyEmail = VerifyEmail::updateOrCreate(
                        ['email' => $postData['email'] ],
                        ['confirmation_code' => $confirmation_code]
                    );
                    Mail::send(['html' => 'emails/verify-email'], $email_data, function ($message) use ($email_data,$customer_email,$admin_mail,$customer_name,$subject){
                        $message->from($admin_mail, 'Reasy Property');
                        $message->to($customer_email,$customer_name)->subject($subject);
                    });
                    return response()->json(['data'=>'Email is successfully sent. Verify it.','status' => 'mail']);
                }
                return response()->json(['data'=>'no','status' => 'error']);
            }
        }
    }

    public function verify_email(Request $request)
    {
        if($request->isMethod('post'))
        {
            $postData = input::all();
            $VerifyEmail = VerifyEmail::where(['email' => $postData['email'], 'confirmation_code'=> $postData['confirmation_code'] ])->first();
            if(!empty($VerifyEmail) && $VerifyEmail )
            {
                $update = VerifyEmail::where(['email' => $postData['email'], 'confirmation_code'=> $postData['confirmation_code'] ])->update(['status' => 1]);
                return response()->json(['data'=>'Email verified successfully','status' => 'success']);
            }
            else
            {
                return response()->json(['data'=>'Email not verified','status' => 'error']);
            }
        }
    }

    public function randomPassword() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }



    /**************************For book visit*******************************/
    public function sendOtp(Request $request){
        if($request->input('phone_number') != ''){
            $otp = 12345;
            //$otp = str_pad(rand(0, pow(10, 5)-1), 5, '0', STR_PAD_LEFT);
            // $apiKey = urlencode('QxAxtPC4tB0-GfMWocfmwQ2eb0ldqbFe9ehxxeTWPu');
            // $numbers = array($request->input('phone_number')); //$numbers = array(917707907575);
            // $sender = urlencode('TXTLCL');
            // $message = rawurlencode('OPT for phone number confirmation is '.$otp);
            // $numbers = implode(',', $numbers);
            // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
            // $ch = curl_init('https://api.textlocal.in/send/');
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($ch);
            // curl_close($ch);
            $response = '{"balance":8,"batch_id":802686449,"cost":1,"num_messages":1,"message":{"num_parts":1,"sender":"TXTLCL","content":"This is your message"},"receipt_url":"","custom":"","messages":[{"id":"11056714424","recipient":917707907575}],"status":"success"}';
            $data = json_decode($response);
            if($data->status == 'success'){
                $request->session()->put('opt', $otp);
                return '<span style="color:green">Sent Successfully</span>';
            } else {
                return '<span style="color:red">Please check your phone number</span>';
            }
            return '<span style="color:red">Please check your phone number</span>';
        } else {
            return '<span style="color:red">Please enter valid number</span>';
        }
    }

    public function verifyOtp(Request $request){
        if($request->input('opt') != ''){
            if($request->session()->get('opt') == $request->input('opt')){
                $request->session()->put('phone_verify', '1');
                return response()->json(['message'=>'Verified!','status' => 'true']);
            } else {
                return response()->json(['message'=>'Not Verified!','status' => 'false']);
            }
        } else {
            return response()->json(['message'=>'Enter valid OTP','status' => 'false']);
        }
    }

    public function verifyEmail(Request $request){
        $request->validate([
            'email' => ['required','string', 'email'],
        ]); 
        if($request->input('email') != '') {
            $users = User::where(['email' => $request->input('email') ])->first();
            if(!empty($users) && $users ) {
                return response()->json(['message'=>'Verified!','status' => 'true']);
            } else {
                $confirmation_code = str_pad(rand(0, pow(10, 5)-1), 5, '0', STR_PAD_LEFT);
                $customer_email =  $request->input('email');
                $admin_mail = env('APP_email');
                $customer_name = 'Reasy Property';
                $subject = "Email Verification";
                $email_data = array(
                    'email' => $request->input('email'),
                    'confirmation_code' => $confirmation_code,
                );
                $VerifyEmail = VerifyEmail::updateOrCreate(
                    ['email' => $request->input('email') ],
                    ['confirmation_code' => $confirmation_code]
                );
                Mail::send(['html' => 'emails/verify-email'], $email_data, function ($message) use ($email_data,$customer_email,$admin_mail,$customer_name,$subject){
                    $message->from($admin_mail, 'Reasy Property');
                    $message->to($customer_email,$customer_name)->subject($subject);
                });
                return response()->json(['message'=>'Email is successfully sent. Verify it.','status' => 'sent']);
            }
        } else {

        }
    }

    public function verifyToken(Request $request)
    {
        if($request->isMethod('post'))
        {
            $VerifyEmail = VerifyEmail::where(['email' => $request->input('email'), 'confirmation_code'=> $request->input('confirmation_code') ])->first();
            if(!empty($VerifyEmail) && $VerifyEmail ) {
                $update = VerifyEmail::where(['email' => $request->input('email'), 'confirmation_code'=> $request->input('confirmation_code') ])->update(['status' => 1]);
                return response()->json(['message'=>'Verified!','status' => 'true']);
            } else {
                return response()->json(['message'=>'Not Verifed!','status' => 'false']);
            }
        }
    }
    public function unit_detail_view($id)
    {
       $units = PropertiesUnit::find($id);
       if($units->property_id !=""){
       $data = Properties::find($units->property_id);
          }
       $amenities = DB::table('amenities')->get();
       if($data){
            $images = array();
            if($data->images) {
                $images = json_decode($data->images, true);
            }
       return view('unit_detail_view',compact('units','data','images','amenities'));
      }
      else {
            return abort(404);
        }  
    }

    public function thankYouBooingProperty(){
        return view('thankyou_for_booking');
    }
}
