<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use App\UnitsRent;
use Carbon\Carbon;
use App\User;
use App\PropertiesUnit;
use Illuminate\Support\Facades\Mail;
use App\Transactions;
class generateRent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generated:rent'; 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rent Generated Successfully';

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
    public function handle() 
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
}
