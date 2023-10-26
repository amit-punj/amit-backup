<?php

namespace App\Console\Commands;

use App\UnitsRent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\User;
use App\PropertiesUnit;
use App\MeterReadings;
use App\Booking;
use App\Task;
use Illuminate\Support\Facades\Mail;

class generateTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generated:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generated:task for PO or PM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() { 
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
