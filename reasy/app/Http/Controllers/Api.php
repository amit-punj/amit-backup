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
use Notification;
use App\Notifications\MyFirstNotification;
use App\Notifications\ReminderNotification;
use App\Notifications\TerminationNotification;
use App\Notifications\WarningEmail;


class Api extends Controller
{
    public function reminder_email(Request $request)
    {
        $current_time = strtotime(date("Y/m/d H:i:s"));
        $next_day = date("Y/m/d", strtotime("+1 days", $current_time));
        $next_day = Helper::Date($next_day);
        $appointments = appointments::where(['appointment_type' => 'Entry'])->whereDate('time', '=', $next_day)->get()->toArray();
        foreach ($appointments as $key => $appointment) {
            $appointment_time = Helper::DateTime($appointment['time']);
            $unit_details = PropertiesUnit::where('id', '=', $appointment['unit_id'])->first()->toArray();      

            $tenant_details = User::find($appointment['tenant_id']);
            $pde_details = User::find($appointment['pde_id']);
            $pm_details = User::find($unit_details['property_manager_id']);

            $details = [
                'subject'  => 'Reminder Email',
                'greeting' => 'Hi, '. $tenant_details->name,
                'body' => 'You have a entry appointment Tomorrow at '.$appointment_time,
                'thanks' => 'Thank you for using Reasy Property!',
            ];
            Notification::send($tenant_details, new ReminderNotification($details));
            $details['greeting'] = 'Hi, '. $pde_details->name;
            Notification::send($pde_details, new ReminderNotification($details));
            $details['greeting'] = 'Hi, '. $pm_details->name;
            Notification::send($pm_details, new ReminderNotification($details));

        }
    }

    public function check_appintment_reply(Request $request)
    {
        $current_time = strtotime(date("Y/m/d"));
        $appointments = appointments::where(['reply_status' => '0'])->get()->toArray();
        foreach ($appointments as $key => $appointment) 
        {
            $reply_time = date('Y/m/d', strtotime($appointment['created_at']. ' +1 day') );
            $reply_time = strtotime($reply_time);
            if($current_time > $reply_time)
            { 
                $unit_details = PropertiesUnit::where('id', '=', $appointment['unit_id'])->first();      
                $update = appointments::find($appointment['id']);
                $update->reply_status = 2;
                $update->save();
                // $tenant_details = User::find($appointment['tenant_id']);
                // $pde_details = User::find($appointment['pde_id']);
                $pm_details = User::find($unit_details->property_manager_id);
                $po_details = User::find($unit_details->user_id);

                $details = [
                    'subject'  => 'Warning Email',
                    'greeting' => 'Hi, '. $po_details->name,
                    'body'     => 'You had a appointment yesterday which you missed',
                    'thanks'   => 'Thank you for using Reasy Property!',
                ];
                Notification::send($po_details, new WarningEmail($details));
                $details['greeting'] = 'Hi, '. $pm_details->name;
                Notification::send($pm_details, new WarningEmail($details));
            }
        }
        die('done');
    }

    public function check_receipt_upload(Request $request)
    {
        $current = Helper::Date(date("Y-m-d"));
        $bookings = Booking::where(['status' => 0, 'payment_method' => 'bank', 'payment_status' => 'pending'])->whereDate('receipt_upload_time', '<', $current)->get()->toArray();
           
        // Helper::pr($bookings);
        // die('dddd');
        if(is_array($bookings) && !empty($bookings) && count($bookings) > 0)
        {
            foreach ($bookings as $key => $booking) {

                $update_data = array(
                    'status' =>  10,
                );
                $update = Booking::where(['id'=>$booking['id']])->update($update_data);
                
                $tenant = User::find($booking['tenant_id']);
                $tenant->receipt_failed_count += 1;
                $tenant->save(); 

                $unit = PropertiesUnit::find( $booking['unit_id'] );
                $unit->booking_status = 0;
                $unit->save();  
            }
            echo "Done";
        }
    }

    public function termination_notice(Request $request)
    {
        $current_time = strtotime(date("Y/m/d"));
        $endDate = date("Y/m/d", strtotime("+30 days", $current_time));
        $endDate = Helper::Date($endDate);
        // $endDate = Carbon::today()->addMonths(2)->format('Y/m/d');
        // echo $endDate;
        $contracts = Booking::where('status',6)->where('flag',0)->whereDate('end_date', '<', $endDate)->get()->toArray();
        if(is_array($contracts) && !empty($contracts) && count($contracts) > 0)
        {
            foreach ($contracts as $key => $contract) {
                $po_details = User::find($contract['po_id']);
                $tenant_details = User::find($contract['tenant_id']);
                $pm_details = User::find($contract['pm_id']);

                $details = [
                    'subject'  => 'Termination Reminder Email',
                    'greeting' => 'Hi, '. $po_details->name,
                    'body'     => 'Your contract will be end on '.$contract['end_date'].'.',
                    'actionURL' => $contract['id'],
                    'thanks'   => 'Thank you for using Reasy Property!',
                ];
                Notification::send($po_details, new TerminationNotification($details));
                $details['greeting'] = 'Hi, '. $tenant_details->name;
                Notification::send($tenant_details, new TerminationNotification($details));
                $details['greeting'] = 'Hi, '. $pm_details->name;
                Notification::send($pm_details, new TerminationNotification($details));

                $booking = Booking::find($contract['id']);
                $booking->flag = 1;
                $booking->save();
            }
        }
        die('Done');
    }
}




