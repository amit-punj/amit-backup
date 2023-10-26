<?php

namespace App\Console\Commands;

use App\UnitsRent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\User;
use App\PropertiesUnit;
use App\MeterReadings;
use App\Booking;
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

        //For Rent
        $unitsRents = UnitsRent::where('rent_status','hold')->get();
        if(count($unitsRents) > 0){
            $today = Carbon::now()->format('Y/m/d');
            foreach ($unitsRents as $key => $rent) {
                $rentDate = Carbon::parse($rent->updated_at);
                if($rentDate->diffInDays($today) >2){
                    $unit = PropertiesUnit::find($rent->unit_id);
                    $user = User::find($rent->user_id);
                    $po = User::find($unit->user_id);
                    $pm = User::find($unit->property_manager_id);
                    
                    $emailData = array(
                        'tenant_name'   => $user->name." ".$user->last_name,
                        "email"         => $user->email,
                        "unit_name"     => $unit->unit_name,
                        "payment_method"   => 'Bank Transfer',
                        "price"         => $rent->total_amount,
                    );
                    $tenantEmail = $user->email;
                    $poEmail = $po->email;
                    $pmEmail = $pm->email;
                    Mail::send('emails.hold_rent_notification', $emailData, function($message) use ($tenantEmail, $poEmail, $pmEmail) {
                        $message->to($tenantEmail, $poEmail, $pmEmail)
                                ->subject('Unit Rent Notification');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });
                }
            }
        }


        //For Meter Bill
        $meterReadings = MeterReadings::where('status','hold')->get();
        if(count($meterReadings) > 0){
            $today = Carbon::now()->format('Y/m/d');
            foreach ($meterReadings as $key => $reading) {
                $readingDate = Carbon::parse($reading->updated_at);
                if( $readingDate->diffInDays($today) > 2 ){
                    $unit = PropertiesUnit::find($reading->unit_id);
                    $contract = Booking::where('unit_id',$reading->unit_id)->first();
                    $user = User::find($contract->tenant_id);
                    $po = User::find($unit->user_id);
                    $pm = User::find($unit->property_manager_id);
                    
                    $emailData = array(
                        'tenant_name'   => $user->name." ".$user->last_name,
                        "email"         => $user->email,
                        "unit_name"     => $unit->unit_name,
                        "payment_method"   => 'Bank Transfer',
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
