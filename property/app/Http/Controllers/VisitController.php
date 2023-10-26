<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Plans;
use App\email_log;
use App\Properties;
use App\Book_appointment;
use App\Invitations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
Use Helper;
use Validator;
use App\appointments;
Use Carbon\Carbon;
use App\PropertiesUnit;
use App\Contracts;
use App\Documents;
use App\Booking;
use App\Tickets;
use App\Ticket_thread;
use App\Terminate;
use App\Transactions;
use Notification;
use App\MeterReadings;
use App\UnitsRent;
use App\Messages;
use App\Reason;
use App\Notifications\MyFirstNotification;
use App\Notifications\CancelAppointment;
use Session;
use App\UsersAvailability;
use App\Extend;
use App\Sub_Tenant;


class VisitController extends Controller
{
	const Tenant = 1;
	const Property_Owner = 2;
	const Property_Manager = 3;
	const Visit_Organizer = 6;
    const Property_Description_Experts = 4;

    protected $url;
    public function __construct(UrlGenerator $url){
        $this->middleware('auth');
        $this->url = $url;
    }

    public function visitDetails($id){
        $appointmentDetail = appointments::find($id);
        return view('dashboard.visitdetails')->with([ 'appointmentDetail' => $appointmentDetail ]);
    }
    public function ticket_view(Request $request, $id)
    {
        $ticket = Tickets::find($id);
        $ticket_threads = Ticket_thread::where('ticket_id', $id)->get();
        // Helper::pr($ticket_threads);
        // die('aaaaaaaaaa');
        return view('tickets.ticket_view',compact('ticket','ticket_threads'));
    }
    public function ticket_reply(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $role = Auth::user()->user_role;
        $postData = input::all();

        // Helper::pr($postData);
        // die('amit');
        $ticket = Tickets::find($id);

        $Ticket_thread = new Ticket_thread;
        $Ticket_thread->ticket_id   = $id;
        $Ticket_thread->unit_id     = $ticket->unit_id;
        $Ticket_thread->tenant_id   = $ticket->tenant_id;
        $Ticket_thread->booking_id  = $ticket->booking_id;
        $Ticket_thread->send        = $user_id;
        $Ticket_thread->role        = $role;
        $Ticket_thread->time        = Helper::DateTime(date('Y-m-d H:m:s'));
        $Ticket_thread->message     = $postData['message'];
        $Ticket_thread->save();
        
        toastr()->success('Reply sent successfully!');
        return Redirect('ticket-view/'.$id);
    }
    public function my_wallet(){
        $tenant_id  = Auth::user()->id;
        $user       = Auth::user();
        $unitIds = [];
        $today = Carbon::now()->format('Y/m/d');
        $contracts = Booking::where('status',6)
                            ->where('start_date', '<', $today)
                            ->where('end_date', '>=', $today)
                            ->where('tenant_id', $tenant_id)
                            ->get();
        if(count($contracts) > 0){
            foreach ($contracts as $key => $contract) {
                $unitIds[] = $contract->unit_id;
            }
        }
        $rentalBills = collect(MeterReadings::whereIn('unit_id',$unitIds)->where('status','pending')->get());
        $unitRent = collect(UnitsRent::whereIn('unit_id',$unitIds)->where('rent_status','pending')->get());
        $pendingPayments = $rentalBills->merge($unitRent)->sortByDesc('created_at');
        // echo "<pre>";
        // print_r($pendingPayments);die;
        $transactions = Transactions::where('tenant_id','=',$tenant_id)->orderBy('created_at','desc')->paginate(5);
        return view('tenant.my-wallet',compact('user','transactions','pendingPayments'));
    }
    public function add_money(Request $request)
    {
        $payment_for = 'add_money'; 
        $postData = Input::all();
        $amount = $postData['amount'];
        $tenant_id  = Auth::user()->id;
        $user       = Auth::user();
        return view('contracts.check-out',compact('payment_for','user','amount'));
    }
    public function messenger(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $unit_id = (isset($_GET['uid'])) ? $_GET['uid'] : '' ;
        $tenant_id = (isset($_GET['tid'])) ? $_GET['tid'] : '' ;
        if($user->user_role == self::Tenant){
            $emails  = email_log::where(
                        function ($query) use ($user_id)
                        { $query->where('send', '=', $user_id)
                            ->orWhere('received', '=', $user_id);
                        })->get();
            $emails = $emails->groupBy('unit_id');
            if(empty($unit_id) && empty($tenant_id) )
            {
                if(count($emails) > 0){
                    foreach ($emails as $key => $value) {
                        $unit_id = $key;
                        $tenant_id = $value[0]->tenant_id;
                        break;
                    }
                }
            }
            return view('dashboard.messenger',compact('emails','unit_id','tenant_id'));
        }
        elseif($user->user_role == self::Property_Owner){
            $emails = email_log::select('tenant_id','unit_id','vo_id')->where(
                    function ($query) use ($user_id)
                    { $query->where('send', '=', $user_id)
                        ->orWhere('received', '=', $user_id);
                    })->distinct('tenant_id')->get();
            $emails = $emails->groupBy('unit_id');

            if(empty($unit_id) && empty($tenant_id) )
            {
                if(count($emails) > 0){
                    foreach ($emails as $key => $value) {
                        $unit_id = $key;
                        $tenant_id = $value[0]->tenant_id;
                        break;
                    }
                }
            }
            $email_chat = email_log::where(['unit_id' => $unit_id, 'tenant_id' => $tenant_id])->where(
                    function ($query) use ($user_id)
                    { $query->where('send', '=', $user_id)
                        ->orWhere('received', '=', $user_id);
                    })->get();
            return view('dashboard.PO-PM-messenger',compact('emails','unit_id','email_chat','tenant_id'));
        }
    }
    public function email_reply(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $postData = input::all();

        $data = PropertiesUnit::where(['id' => $id])->first(); 
        // Helper::pr($data);
        // die('amit');
        $tenant_data = User::find($postData['tenant_id']);

        $owner_email = trim($data->user->email);
        $owner_name = $data->user->name;
        $subject = "Message Sent"; 
        $admin_mail = 'visionvivante@gmail.com';

        if(Auth::user()->user_role == 1)
        {
            $owner_data = array(
                'username' => $owner_name,
                'email'    =>  $owner_email,
                'message_data'  =>  $postData['message'],
                'phone_no' =>  $data->user->phone_no,
                'owner_name' => $owner_name,
                'tenant_name' => $tenant_data->name,
                'tenant_phone' => $tenant_data->phone_no,
                'tenant_email' => trim($tenant_data->email),
                'unit_id' => $id,
                'tenant_id' => $postData['tenant_id'],
            );

            /* Email to property owner start*/
            Mail::send(['html' => 'emails/send_message-owner'], $owner_data, function ($message) use ($owner_data,$owner_email,$admin_mail,$owner_name,$subject){
                    $message->from($admin_mail, 'Reasy Property');
                    $message->to($owner_email,$owner_name)->subject($subject);
            });
        }
        elseif(Auth::user()->user_role == 2)
        {
            /* Email to Tenant end */
            $email_data = array(
                'username' => $tenant_data->name,
                'email'    =>  trim($tenant_data->email),
                'message_data'  =>  $postData['message'],
                'new_user'  =>  $tenant_data->name,
                'phone_no' =>  $tenant_data->phone_no,
                'owner_name' => $owner_name,
                'unit_id' => $id,
                'tenant_id' => $postData['tenant_id'],
            );

            $customer_email = trim($tenant_data->email);
            $customer_name  = $tenant_data->name; 
            /* Email to tenant start*/
            Mail::send(['html' => 'emails/send_message'], $email_data, function ($message) use ($email_data,$customer_email,$admin_mail,$customer_name,$subject){
                    $message->from($admin_mail, 'Reasy Property');
                    $message->to($customer_email,$customer_name)->subject($subject);
            });
            /* Email to tenant end*/
        }
        
        $email_log = new email_log;
        $email_log->unit_id     = $id;
        $email_log->tenant_id   = $postData['tenant_id'];
        $email_log->vo_id       = $data->user->id;
        $email_log->send        = $postData['send'];
        $email_log->received    = $postData['received'];
        $email_log->email_type  = 'message';
        $email_log->message     = $postData['message'];
        $email_log->save();
        
        toastr()->success('Message sent successfully!');
        return Redirect('messenger?uid='.$id.'&tid='.$postData['tenant_id']);
    }
    public function messages(){
        $user_id = Auth::user()->id;
        $emails = Messages::where(function ($query) use ($user_id){ $query->where('send', '=', $user_id)->orWhere('received', '=', $user_id);})->orderBy('id', 'desc')->get(); 
        return view('dashboard.messages',compact('emails'));
    }
    public function send_message(Request $request)
    {
        $user_id = Auth::user()->id;
        $postData = input::all();

        $appointment = appointments::find($postData['id']);
        $appointment->reply_status    = 1;
        $appointment->save();

        $time = date('Y-m-d H:m:s', strtotime(date("Y-m-d H:m:s"). ' + 1 days'));
        $time = Helper::DateTime($time);

        $message = new Messages;
        $message->unit_id   = $appointment->unit_id;
        $message->appointment_id = $appointment->id;
        $message->tenant_id = $appointment->tenant_id;
        $message->vo_id     = $appointment->vo_id;
        $message->pde_id    = $appointment->pde_id;
        $message->send      = $user_id;
        $message->received  = $appointment->tenant_id;
        $message->email_type = 'Visit';
        $message->message   = $postData['message'];
        $message->time      = $time;
        $message->status    = 1;
        $message->save();

        return Redirect('my-appointments');
    }
    public function cancel_appointment(Request $request)
    {
        $user_id = Auth::user()->id;
        $postData = input::all();
       
        $appointment = appointments::find($postData['id']);
        $appointment->appointment_status    = 7;
        $appointment->save();

        $reason = new Reason;
        $reason->unit_id   = $appointment->unit_id;
        $reason->appointment_id = $appointment->id;
        $reason->tenant_id = $appointment->tenant_id;
        $reason->vo_id     = $appointment->vo_id;
        $reason->pde_id    = $appointment->pde_id;
        $reason->send      = $user_id;
        $reason->received  = $appointment->tenant_id;
        $reason->type      = $appointment->appointment_type;
        $reason->reason   = $postData['reason'];
        $reason->save();


        $assigned = User::find($appointment['assigned_to']);
        $tenant_details = User::find($appointment['tenant_id']);

        $tenant_details->email = 'apamitpunj@gmail.com';
        $details = [
            'subject'  => 'Cancel Appointment',
            'greeting' => 'Hi, '. $tenant_details->name,
            'body'     => 'Your appointment had been canceled by '.$assigned->name,
            'assigned_name' => 'Name :  '.$assigned->name,
            'assigned_email' => 'Email : '.$assigned->email,
            'assigned_phone' => 'Phone Number : '.$assigned->phone_no,
            'reason' => 'Reason : '.$postData['reason'],
            'thanks' => 'Thank you for using Reasy Property!',
        ];
        Notification::send($tenant_details, new CancelAppointment($details));

        return Redirect('my-appointments');
    }
    public function my_appointments(){

        $user_id = Auth::user()->id;
        $futures  = array();
        $archives = array();

        $futures = appointments::where('time', '>', date('Y/m/d H:i:s'))
                    ->where(['parent' => 0])
                    ->where(function ($query) use ($user_id)
                            { $query->where('created_by', '=', $user_id)
                                ->orWhere('assigned_to', '=', $user_id);
                            }
                        )
                    ->orderBy('time','ASC')
                    ->get();
        $archives = appointments::where('time', '<', date('Y/m/d H:i:s'))->where(['parent' => 0])->where(function ($query) use ($user_id)        { $query->where('created_by', '=', $user_id)->orWhere('assigned_to', '=', $user_id);})->orderBy('time','DESC')->get();
        // Helper::pr($futures);
        // $archives = appointments::where(['contract_id' => '45'])->get();
        // Helper::pr($archives);
        // Helper::pr($futures[3]->message->message);
        // die('dfdfff');

        return view('tenant.my-appointments',compact('futures','archives'));
    }

    public function appointment_view(Request $request, $id)
    {
        $appointment = appointments::find($id);
        // Helper::pr($appointment->unit);
        // die('aaaaaaaaaaaa');
        return view('tenant.appointment-view',compact('appointment'));
    }
    public function book_appointment(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $booking_ids = Sub_Tenant::where('tenant_id', $user->id)->pluck('booking_id')->toArray();
        \DB::enableQueryLog();
        $contracts = Booking::where(['status' => '3','appointment_booked' => '0'])
                    ->where(function ($query) use ($user_id,$booking_ids)
                            { $query->where('tenant_id', '=', $user_id)
                                ->orWhereIn('id',$booking_ids);
                            }
                        )->get();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $rules = array(
                'time'      => 'required|string',
                'title'     => 'required|string',
                'contract_id'   => 'required|string',
            );
            $message = array(
                'time' => 'Time field is required',
                'title' => 'Title field is required',
                'contract_id' => 'Contract field is required',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                $contracts = Booking::where(['id'=> $postData['contract_id']])->first();

                $pde_details = $contracts->pde;
                $unit_details = $contracts->unit;

                $appointments = new appointments;
                $appointments->time = Helper::DateTime($postData['time']);
                $appointments->tenant_id = $user->id;
                $appointments->pde_id     = $contracts->pde->id;
                $appointments->created_by     = $user->id;
                $appointments->assigned_to     = $contracts->pde->id;
                $appointments->appointment_type     = 'Entry';
                $appointments->contract_id      = $postData['contract_id'];
                $appointments->unit_id = $postData['unit_id'];
                $appointments->title = $postData['title'];
                $appointments->description = $postData['description'];
                $appointments->save();

                $update_data = array(
                    'appointment_booked' =>  '1',
                );
                $update = Booking::where(['id'=> $postData['contract_id'],'status' => '3'])->update($update_data);

                $tenent_name = $user->name;
                $tenent_email = trim($user->email);
                $tenent_data = array(
                    'name'          => $user->name,
                    "email"         => $user->email,
                    "time"          => Helper::DateTime($postData['time']),
                    "title"         => $postData['title'],
                    "description"   => $postData['description'],
                );
                    
                Mail::send('emails.entry_appointment_to_tenant', $tenent_data, function($message) use ($tenent_name, $tenent_email) {
                    $message->to($tenent_email, $tenent_name)
                            ->subject('Entry Appointment');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });
                toastr()->success('Appointment booked successfully!');
                return view('thankyou', compact('pde_details','unit_details'));
            } 
        }
        // return view('thankyou');
        return view('tenant.book-appointment',compact('user','contracts','id'));
    }

    public function upload_document(Request $request)
    { 
        if($request->isMethod('post'))
        {
        	$user = Auth::user();
            $postData = Input::all();
            $receipt_name = "";
            $rules = array(
                'receipt'=> 'required|mimes:jpeg,png,jpg,docx,doc,pdf|max:4096',
            );
            $message = array(
                'receipt.required' => 'Please upload receipt',
                'receipt.mimes'    => 'The receipt must be a file of type: jpeg, png, jpg, docx, doc, pdf.',
                'receipt.max'      => 'The receipt may not be greater than 4MB',
            );
            $validator = Validator::make($postData, $rules, $message);
            if ($validator->fails())
            {
                toastr()->error('Report is not Uploaded Successfully!');
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                if ($request->hasFile('receipt')) {
                    $image = $request->file('receipt');
                    $receipt_name = 'document'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('document');
                    $image->move($destinationPath, $receipt_name);
                }

                $where_data = array('id' => $postData['booking_id']);
                $booking_details = Booking::where($where_data)->first();

                // $related_to = ($postData['appointment_type'] == 'Entry') ? 'EntryPDReport' : 'ExitPDReport' ;
                $Documents = new Documents();
                $Documents->unit_id = $booking_details->unit_id;
                $Documents->contract_id = $postData['booking_id'];
                $Documents->user_type = '4';
                $Documents->uploaded_by = $user->id;
                $Documents->related_to = 'EntryPDReport';
                $Documents->doc_name   = $receipt_name;
                $Documents->save();
                $Documents = $Documents->id;

                // $status = ($postData['appointment_type'] == 'Entry') ? '6' : '8' ;

                $booking_data = array(
                    'status' => '6',
                );
                $booking = Booking::where($where_data)->update($booking_data);

                $tenant_details = User::find($booking_details->tenant_id);
                $pm_details = User::find($booking_details->pm_id);

		        $details = [
		        	'subject'  => 'Contract now active',
		            'greeting' => 'Hi, '. $user->name,
		            'body' => 'PDE upload the document.',
		            'thanks' => 'Thank you for using Reasy Property!',
		            'attach' => $destinationPath.'/'.$receipt_name,
		            'as' => 'PDE Report',
		        ];
		  
		        Notification::send($user, new MyFirstNotification($details));
		        $details['greeting'] = 'Hi, '. $tenant_details->name;
		        Notification::send($tenant_details, new MyFirstNotification($details));
		        $details['greeting'] = 'Hi, '. $pm_details->name;
		        Notification::send($pm_details, new MyFirstNotification($details));

                $get_sub_tenant = Sub_Tenant::where('booking_id', $booking_details->id)->get();
                if($get_sub_tenant)
                {
                    foreach ($get_sub_tenant as $key => $value) {
                        $tenant_details1 = User::find($value->tenant_id);
                        $details['greeting'] = 'Hi, '. $tenant_details1->name;
                        Notification::send($tenant_details1, new MyFirstNotification($details));
                    }
                }

                toastr()->success('PD Report Uploaded Successfully!');
                return Redirect('list-meters/'.$booking_details->unit_id);
            }
        }
    }

    public function upload_exit_document(Request $request)
    { 
        if($request->isMethod('post'))
        {
            $user = Auth::user();
            $postData = Input::all();
            // Helper::pr($postData);
            // die('dfffffff');
            $receipt_name = "";
            $rules = array(
                'receipt'=> 'required|mimes:jpeg,png,jpg,docx,doc,pdf|max:4096',
            );
            $message = array(
                'receipt.required' => 'Please upload receipt',
                'receipt.mimes'    => 'The receipt must be a file of type: jpeg, png, jpg, docx, doc, pdf.',
                'receipt.max'      => 'The receipt may not be greater than 4MB',
            );
            $validator = Validator::make($postData, $rules, $message);
            if ($validator->fails())
            {
                toastr()->error('Report is not Uploaded Successfully!');
                return back()->withInput()->withErrors($validator);
            }
            else
            {

                if ($request->hasFile('receipt')) {
                    $image = $request->file('receipt');
                    $receipt_name = 'document'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('document');
                    $image->move($destinationPath, $receipt_name);
                }

                if(!empty($postData['meter_id']) && is_array($postData['meter_id']))
                {
                    foreach ($postData['meter_id'] as $key => $value) {
                        // Helper::pr($value);
                        // die('ddd');
                        $MeterRe = new MeterReadings;
                        $MeterRe->unit_id = $postData['unit_id'];
                        $MeterRe->meter_id = $value;
                        $MeterRe->reading_date = Helper::DateTime(date('Y-m-d H:m:s'));
                        // $MeterRe->last_reading = $request->input('last_reading');
                        $MeterRe->current_reading = $postData['reading'][$key];
                        $MeterRe->per_unit_price = $postData['per_unit_price'][$key];
                        $MeterRe->amount = 0;
                        $MeterRe->upload_document = $receipt_name;
                        $MeterRe->status = 'pending';
                        $MeterRe->reading_type = 'last';
                        $MeterRe->save();
                    }
                }

                $where_data = array('id' => $postData['booking_id']);
                $booking_details = Booking::where($where_data)->first();

                // $related_to = ($postData['appointment_type'] == 'Entry') ? 'EntryPDReport' : 'ExitPDReport' ;
                $Documents = new Documents();
                $Documents->unit_id = $booking_details->unit_id;
                $Documents->contract_id = $postData['booking_id'];
                $Documents->user_type = '4';
                $Documents->uploaded_by = $user->id;
                $Documents->related_to = 'ExitPDReport';
                $Documents->doc_name   = $receipt_name;
                $Documents->save();
                $Documents = $Documents->id;

                // $status = ($postData['appointment_type'] == 'Entry') ? '6' : '8' ;

                $booking_data = array(
                    'status' => '8',
                    'damage' => $postData['damage'],
                    'dues'   => $postData['dues'],
                );
                $booking = Booking::where($where_data)->update($booking_data);
                
                $terminate_data = array('status' => '4',);
                $terminate = Terminate::where(['id' => $booking_details->terminate_id])->update($terminate_data);                




                $tenant_details = User::find($booking_details->tenant_id);
                $pm_details = User::find($booking_details->pm_id);

                $details = [
                    'subject'  => 'Upload Document',
                    'greeting' => 'Hi, '. $user->name,
                    'body' => 'PDE upload the document.',
                    'thanks' => 'Thank you for using Reasy Property!',
                    'attach' => $destinationPath.'/'.$receipt_name,
                    'as' => 'PDE Report',
                ];
          
                Notification::send($user, new MyFirstNotification($details));
                $details['greeting'] = 'Hi, '. $tenant_details->name;
                Notification::send($tenant_details, new MyFirstNotification($details));
                $details['greeting'] = 'Hi, '. $pm_details->name;
                Notification::send($pm_details, new MyFirstNotification($details));

                toastr()->success('PD Report Uploaded Successfully!');
                // return Redirect('list-meters/'.$booking_details->unit_id);
                return back();
            }
        }
    }

    public function getUnitByContract(Request $request)
    {
        if ($request->isMethod('post'))
        {
            // $holidays1 = array();
            // $weekends = '';
            // $holidays = '';
            $postData = input::all();
            $contracts = Booking::where(['id'=> $postData['id']])->first();
            $pde_id =  $contracts->unit->property_description_experts_id;
            // $UsersAvailability = UsersAvailability::where('user_id', $pde_id)->first();
            // if($UsersAvailability)
            // {
            //     $weekends  = $UsersAvailability->days;
            //     $holidays1 = explode(',', $UsersAvailability->selecteddates);
            //     foreach ($holidays1 as $key => $value) {
            //         $holidays[] = Helper::DateTime($value); 
            //     }
            // }           
            $unit_details = array(
                'unit_id' => $contracts->unit->id,
                'unit_name' => $contracts->unit->unit_name,
                // 'weekends'  => $weekends,
                // 'holidays'  => $holidays,
            );
            echo json_encode(array('response'=>$unit_details, 'status' => 'success'));
            die;
        }
    }

    public function book_appointment_by_mail(Request $request, $id)
    {
        $holidays1 = array();
        $holidays_array = array();
        $holidays = '';
        $weekends = '';
        $user = Auth::user();
        $status = (isset($_GET['type']) && $_GET['type'] == 'Exit') ? '6' : '3';
        // $contracts = Booking::where(['id'=> $id,'status' => '3'])->get();
        $contracts = Booking::where(['id'=> $id,'status' => $status])->get();
        $units = PropertiesUnit::where(['id' => $contracts[0]->unit_id])->first();

        $pde_details = $contracts[0]->pde;
        $unit_details = $contracts[0]->unit;

        $current_time = strtotime(date("Y-m-d H:m:s"));
        $sendMail_time = strtotime($contracts[0]->sendMail_time. ' + 1 days');

        $pde_id =  $units->property_description_experts_id;
        // $UsersAvailability = UsersAvailability::where('user_id', $pde_id)->first();
        // if($UsersAvailability)
        // {
        // // Helper::pr($UsersAvailability);
        // // die('dddtestd');
        //     $weekends  = $UsersAvailability->days;
        //     $holidays1 = explode(',', $UsersAvailability->selecteddates);
        //     foreach ($holidays1 as $key => $value) {
        //         $holidays_array[] = Helper::DateTime($value); 
        //     }
        //     $holidays = implode(',', $holidays_array);
        // }
        if($current_time > $sendMail_time)
        {
            toastr()->warning('Sorry! you already booked appointment!');
            return redirect('my-appointments');
        }
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $rules = array(
                'time'      => 'required|string',
                'title'     => 'required|string',
                'contract_id'   => 'required|string',
            );
            $message = array(
                'time' => 'Time field is required',
                'title' => 'Title field is required',
                'contract_id' => 'Contract field is required',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                $appointments = new appointments;
                $appointments->time = Helper::DateTime($postData['time']);
                $appointments->tenant_id = $user->id;
                $appointments->pde_id     = $contracts[0]->pde->id;
                $appointments->created_by     = $user->id;
                $appointments->assigned_to     = $contracts[0]->pde->id;
                $appointments->appointment_type     = $postData['type'];
                $appointments->contract_id      = $postData['contract_id'];
                $appointments->unit_id = $postData['unit_id'];
                $appointments->title = $postData['title'];
                $appointments->description = $postData['description'];
                $appointments->save();

                $sendMail_time = date('Y-m-d H:m:s', strtotime(date("Y-m-d H:m:s"). ' - 2 days'));
                $sendMail_time = Helper::DateTime($sendMail_time);
                $update_data = array(
                    'sendMail_time' =>  $sendMail_time,
                );
                $update = Booking::where(['id'=> $id,'status' => $status])->update($update_data);

                $tenent_name = $user->name;
                $tenent_email = trim($user->email);
                $tenent_data = array(
                    'name'          => $user->name,
                    "email"         => $user->email,
                    "time"          => Helper::DateTime($postData['time']),
                    "title"         => $postData['title'],
                    "description"   => $postData['description'],
                );
                    
                Mail::send('emails.entry_appointment_to_tenant', $tenent_data, function($message) use ($tenent_name, $tenent_email) {
                    $message->to($tenent_email, $tenent_name)
                            ->subject('Entry Appointment');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });

                toastr()->success('Appointment booked successfully!');
                return view('thankyou', compact('pde_details','unit_details'));
            } 
        }
        return view('tenant.book-appointment',compact('user','contracts','units','id','weekends','holidays'));
    }
    public function tenant_extend_contract(Request $request, $id)
    {
        $user = Auth::user();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $rules = array(
                'end_date'      => 'required',
            );
            $message = array(
                'end_date' => 'Please select date',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                $contract = Booking::find($id);
                $diff = strtotime($postData['end_date']) - strtotime($contract->end_date);
                $days = (round($diff / 86400));

                $extend = new Extend();
                $extend->unit_id    = $contract->unit_id;
                $extend->booking_id = $id;
                $extend->tenant_id  = $contract->tenant_id;
                $extend->pde_id     = $contract->pde_id;
                $extend->po_id      = $contract->po_id;
                $extend->pm_id      = $contract->pm_id;
                $extend->status     = '0';
                $extend->extend_date = $postData['end_date'];
                $extend->extend_time = $days;
                $extend->remark = $postData['remark'];
                $extend->save();
                

                $where_data = array('id' => $id, 'tenant_id' => $user->id);
                $booking_data = array(
                    'remark' => $postData['remark'],
                    'end_date' => $postData['end_date']
                );
                $booking = Booking::where($where_data)->update($booking_data);
                
                toastr()->success('Contract extend successfully!');
                return redirect('contract-details/'.$id);
            } 
        }
    }
    public function reschedule_appointment(Request $request)
    {
        $user = Auth::user();
        $postData = Input::all();
        if($request->isMethod('post'))
        {
            $time = array($postData['time1'],$postData['time2'],$postData['time3'] );
            $update_data = array(
                'appointment_status' =>  3,
                'assign_dates' =>  implode(',', $time),
            );
            $update = appointments::where(['id'=>$postData['appointment_id']])->update($update_data);

            $appointment = appointments::where(['id' => $postData['appointment_id']])->first();
            $vo_id = $appointment->assigned_to;
            $vo_details = User::find($vo_id)->toArray();
            $vo_name  = $vo_details['name'];
            $vo_email = $vo_details['email'];
            $vo_data = array(
                'name'      => $vo_details['name'],
                "email"     => $vo_details['email'],
                "title"     => $appointment->title,
                "description"   => $appointment->description,
                "time"      => Helper::DateTime($postData['time1']),
            );
                
            Mail::send('emails.book_visit', $vo_data, function($message) use ($vo_name, $vo_email) {
                $message->to($vo_email, $vo_name)
                        ->subject('Reschedule Appointment');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            $tenant_details = User::find($appointment->tenant_id)->toArray();
            $tenent_name = $tenant_details['name'];
            $tenent_email = trim($tenant_details['email']);
            $tenent_data = array(
                'name'      => $tenant_details['name'],
                "email"     => $tenant_details['email'],
                "time"      => Helper::DateTime($postData['time1']),
                "title"     => $appointment->title,
                "description"   => $appointment->description,
            );
                
            Mail::send('emails.book_visit', $tenent_data, function($message) use ($tenent_name, $tenent_email) {
                $message->to($tenent_email, $tenent_name)
                        ->subject('Reschedule Appointment');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            toastr()->success('Appointment reschedule successfully!');
            return redirect('my-appointments');
        }
    }
    public function update_appointment(Request $request)
    {
        $user = Auth::user();
        $postData = Input::all();
        // Helper::pr($postData);
        // // Helper::pr($postData['check_time'][0]);
        // die('fff');
        if($request->isMethod('post'))
        {
            if($postData['action'] == 1 )
            {
                $update_data = array(
                    'appointment_status' =>  1,
                    'time' =>  Helper::DateTime($postData['check_time'][0]),
                );   
            }
            elseif($postData['action'] == 2 )
            {
                $update_data = array(
                    'appointment_status' =>  4,
                ); 
                $update = appointments::where(['id'=>$postData['appointment_id']])->update($update_data);
                toastr()->success('Appointment rejected successfully by Tenant!');
                return response()->json(['data'=>'You can see detail of visit organizer','status' => '1']);
            }
            $update = appointments::where(['id'=>$postData['appointment_id']])->update($update_data);
            if($postData['action'] == 1 )
            {
                $appointment = appointments::where(['id' => $postData['appointment_id']])->first();
                $vo_id = $appointment->assigned_to;
                $vo_details = User::find($vo_id)->toArray();
                $vo_name  = $vo_details['name'];
                $vo_email = trim($vo_details['email']);
                $vo_data = array(
                    'name'      => $vo_details['name'],
                    "email"     => $vo_details['email'],
                    "title"     => $appointment->title,
                    "description"   => $appointment->description,
                    "time"      => Helper::DateTime($postData['check_time'][0]),
                );
                    
                Mail::send('emails.book_visit', $vo_data, function($message) use ($vo_name, $vo_email) {
                    $message->to($vo_email, $vo_name)
                            ->subject('Reschedule Appointment');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });

                $tenant_details = User::find($appointment->tenant_id)->toArray();
                $tenent_name = $tenant_details['name'];
                $tenent_email = $tenant_details['email'];
                $tenent_data = array(
                    'name'      => $tenant_details['name'],
                    "email"     => $tenant_details['email'],
                    "time"      => Helper::DateTime($postData['check_time'][0]),
                    "title"     => $appointment->title,
                    "description"   => $appointment->description,
                );
                    
                Mail::send('emails.book_visit', $tenent_data, function($message) use ($tenent_name, $tenent_email) {
                    $message->to($tenent_email, $tenent_name)
                            ->subject('Reschedule Appointment');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });
            }
            // echo "Appointment reschedule successfully!";
            toastr()->success('Appointment reschedule successfully!');
            return redirect('my-appointments');
        }
    }
    // public function legal_action(Request $request, $id){
    // 	return view('dashboard.legal-action');
    // }
    public function listVisits(){
    	$visits = $propertyIds = [];
    	$user = Auth::user();
        $user_id = $user->id;
    	if($user->user_role == self::Tenant){
    		// $invitations = DB::table('invitations')->select('property_id')->groupBy('property_id')->where('email', \Auth::user()->email)->get();
	     //    foreach ($invitations as $key => $value) {
	     //        $propertyIds[] = $value->property_id;
	     //    }
        	$visits = DB::table('property_visits')
			            ->join('properties', 'property_visits.property_id', '=', 'properties.id')
			            ->join('users', 'property_visits.tenant_id', '=', 'users.id')
			            ->where('property_visits.tenant_id', $user->id)
			            ->select('property_visits.title as visit_title','property_visits.*', 'properties.title','users.name as firstname','users.last_name as lastname')
			            ->get();
    	}
    	else if($user->user_role == self::Property_Owner){
    		$properties = DB::table('properties')->select('id')->where('user_id', Auth::id())->get();
	    	foreach ($properties as $key => $value) {
            	$propertyIds[] = $value->id;
        	}
			$visits = DB::table('property_visits')
			            ->join('properties', 'property_visits.property_id', '=', 'properties.id')
			            ->join('users', 'property_visits.tenant_id', '=', 'users.id')
			            ->whereIn('property_visits.property_id', $propertyIds)
			            ->select('property_visits.title as visit_title','property_visits.*', 'properties.title','users.name as firstname','users.last_name as lastname')
			            ->get();
    	}
    	else if($user->user_role == self::Property_Manager){
    		$invitations = DB::table('invitations')->select('property_id')->groupBy('property_id')->where('email', \Auth::user()->email)->get();
	        foreach ($invitations as $key => $value) {
	            $propertyIds[] = $value->property_id;
	        }
        	$visits = DB::table('property_visits')
			            ->join('properties', 'property_visits.property_id', '=', 'properties.id')
			            ->join('users', 'property_visits.tenant_id', '=', 'users.id')
			            ->whereIn('property_visits.property_id', $propertyIds)
			            ->select('property_visits.title as visit_title','property_visits.*', 'properties.title','users.name as firstname','users.last_name as lastname')
			            ->get();
    	}
    	else if($user->user_role == self::Visit_Organizer){
        	// $visits = DB::table('property_visits')
	        //     ->select('property_visits.title as visit_title','property_visits.*','property_visits.time as visit_time', 'properties.title as property_title','users.name as firstname','users.last_name as lastname')
	        //     ->join('properties', 'property_visits.property_id', '=', 'properties.id')
	        //     ->join('users', 'property_visits.tenant_id', '=', 'users.id')
	        //     // ->where('property_visits.property_visit_organizer_id', $user['id'])
	        //     ->orderBy('visit_time', 'desc')
	        //     ->get();
    		// die('dfffff');
            $visits = appointments::where('time', '<', date('Y/m/d H:i:s'))->where(function ($query) use ($user_id)        { $query->where('created_by', '=', $user_id)->orWhere('assigned_to', '=', $user_id);})->orderBy('time','DESC')->get();

    	}
        else if($user->user_role == self::Property_Description_Experts){
            // $invitations = DB::table('invitations')->select('property_id')->groupBy('property_id')->where('email', \Auth::user()->email)->get();
         //    foreach ($invitations as $key => $value) {
         //        $propertyIds[] = $value->property_id;
         //    }
            // echo "<pre>";
            $visits = DB::table('property_visits')
                        ->select('property_visits.title as visit_title','property_visits.time as visit_time','property_visits.*', 'properties.title as property_title','users.name as firstname','users.last_name as lastname')
                        ->join('properties', 'property_visits.property_id', '=', 'properties.id')
                        ->join('users', 'property_visits.tenant_id', '=', 'users.id')
                        // ->where('property_visits.property_visit_organizer_id', $user['id'])
                        ->orderBy('visit_time', 'desc')
                        ->get();
            // die('dfffff');
        }
        return view('dashboard.listvisits')->with(['visits'=>$visits]);
    }

    public function visit_addRemarks(Request $request, $id)
    {
    	if($request->isMethod('post'))
    	{
    		$postData = Input::all();
    		return redirect('completed-visits');
    	}
    	return view('dashboard.visit-add-remarks');
    }
    public function update_status(Request $request)
    {
        $postData = Input::all();
        $update_data = array(
            'appointment_status' =>  $postData['status']
        );
        $update = appointments::where(['id'=>$postData['id']])->update($update_data);
        if($postData['status'] == 2)
        {
            $appointments = appointments::where(['id'=>$postData['id']])->first();
            $update_data_booking = array(
                'appointment_booked' =>  '0',
            );
            $update = Booking::where(['id'=> $appointments->contract_id,'status' => '3'])->update($update_data_booking);
        }
        echo json_encode(array('response'=>$update));
        die;
    }
}
