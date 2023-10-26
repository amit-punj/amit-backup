<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\AccessPermission;
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
use App\general_setting;
use App\Invoice;


class Helper
{
    const CURRENCYSYMBAL = "€";
    public static function currencyType()
    {
        return 'EUR';
    }
    public static function shout(string $string)
    {
        return strtoupper($string);
    }
    public static function Date($date = '')
    {
        if($date == '')
        {
            return date("Y/m/d");
        }
        return date("Y/m/d", strtotime($date));
    }
    public static function DateTime($date = '')
    {
        if($date == '')
        {
            return date("Y/m/d H:i:s");
        }
        return date("Y/m/d H:i:s", strtotime($date));
    }
    public static function VisitDateTime(string $date)
    {
        $date = \DateTime::createFromFormat('d F, Y - h:i a',$date);
        return $date->format("Y/m/d H:i:s");
    }
    public static function DateTimeFormat()
    {
        // return "yyyy/m/d H:i:s";
        return "yyyy/m/d hh:ii";
    }
    // date format for datepicker
    public static function DateFormat()
    {
        return "yy/m/d";
    }

    public static function ContractStartDate()
    {
        return "0";
    }
    public static function AppointmentsDate()
    {
        // tenant can select the time of appointment after {1} days of curent date and time
        return "0";
    }
    public static function AppointmenteDate()
    {
        // tenant can select the time of appointment up to {2} days before the contract start date
        return "0";
    }
    public static function AppointmentBeforeContractStartDate()
    {
        // tenant only able to book appointment only befor 5 days of contract start date. he can not book appointment after this
        return "0";
    }
    public static function pr($string, $die = false)
    {
    	echo "<pre>";
		print_r($string);
		echo "</pre>";
		if( $die ) die;
    }
    public static function last_query(string $string)
    {
		\DB::enableQueryLog();
		 // write ur Query here
			$string;
		$query = \DB::getQueryLog();
        return $query;
    }
    public static function accessPermission($poId, $userRole, $permissionFor)
    {
        $permissions = AccessPermission::select($permissionFor)->where('po_id',$poId)
                                        ->where('user_role',$userRole)
                                        ->get();
        if(count($permissions) > 0 ){
            $data = $permissions->toArray();
            return $data[0][$permissionFor];
        } else {
            return false;
        }
    }
    public static function accessPermissionWithUnitId($unitId, $userRole, $permissionFor)
    {
        $unit = PropertiesUnit::find($unitId);
        $permissions = AccessPermission::select($permissionFor)->where('po_id',$unit->user_id)
                                        ->where('user_role',$userRole)
                                        ->get();
        if(count($permissions) > 0 ){
            $data = $permissions->toArray();
            return $data[0][$permissionFor];
        } else {
            return false;
        }
    }
    public static function encrypt_decrypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = 'jhgfdf89g5df7g5';
        $secret_iv = 'jhb^&%&*^kljhjg';
     
        $result = false;
        $enc_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0,16 );
     
        if( $action == 'e' ) {
            $result = base64_encode( openssl_encrypt( $string, $enc_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $result = openssl_decrypt( base64_decode( $string ), $enc_method, $key, 0, $iv );
        }
     
        return $result;
    }

    public static function unit_name($id){
        $unit = PropertiesUnit::find($id);
        return $unit->unit_name;
    }

    // public static function unit_tenant_name($id){
    //     $unit = PropertiesUnit::find($id);
    //     return $unit->unit_name;
    // }

    public static function generate_agreement($booking_id)
    {
        $booking_details = Booking::where('id',$booking_id)->first();

        $propertiesUnit = PropertiesUnit::find($booking_details->unit_id);
        $building = Properties::find($propertiesUnit->building_id);
        $building_name = '';
        if($building && !empty($building))
        {
            $building_name = $building->unit_name;
        }
        
        $expert = User::find($propertiesUnit->property_description_experts_id);
        $guarantor = Guarantor::find($booking_details->guarantor_id);
        $lessor = User::find($booking_details->po_id);
        $lessee1 = User::find($booking_details->tenant_id);

        $lessor_address = $lessor->postal;
        if (!empty($lessor->city)) {
            $lessor_address = $lessor_address.", ".$lessor->city;
        }
        $lessee1_address = $lessee1->postal;
        if (!empty($lessee1->city)) {
            $lessee1_address = $lessee1_address.", ".$lessee1->city;
        }
        $amenity_exploade = explode(',', $propertiesUnit->amenities);
        $amenities = DB::table('amenities')->whereIn('id', $amenity_exploade)->pluck('amenities_name')->toArray();
        $unit_amenities = implode(", ",$amenities);
        $bank_detail = UserBankAccount::find($lessor->id);

        $meters = Meters::where('unit_id',$propertiesUnit->id)->get();

        $interval = date_diff(date_create($booking_details->start_date), date_create($booking_details->end_date));
        $contract_months =  $interval->format('%m Month %d Day');

        if(!empty($booking_details->rent_agreement) && $booking_details->rent_agreement != '')
        {
            $path = public_path('images/agreements/'.$booking_details->rent_agreement);
            if(file_exists($path))
            {
                unlink($path);
            }
        }

        $general_setting = general_setting::first();
        $company_name =(isset($general_setting->company_name)) ? $general_setting->company_name :'';
        $country = DB::table("countries")->where('id',$general_setting->country)->first();
        $country_name = (isset($country->name)) ? $country->name :'';

        $Sub_Tenant = Sub_Tenant::where('booking_id',$booking_id)->get();
        $coTenant = array();
        if (count($Sub_Tenant) > 0) {
            foreach ($Sub_Tenant as $key => $value) {
                $subtenant = User::find($value->tenant_id);

                $cotenant_address = $subtenant->postal;
                if (!empty($subtenant->city)) {
                    $cotenant_address = $cotenant_address.", ".$subtenant->city;
                }

                $coTenant[] = array(
                    'lessee_name' => (isset($subtenant->name)) ? $subtenant->name : '--',
                    'lessee_email' => (isset($subtenant->email)) ? $subtenant->email : '--',
                    'lessee_phone' => (isset($subtenant->phone_no)) ? $subtenant->phone_no : '--',
                    'lessee_postal' => (isset($subtenant->postal_code)) ? $subtenant->postal_code : '--',
                    'lessee_address' => $cotenant_address,
                    'lessee_id' => (isset($subtenant->id_card)) ? $subtenant->id_card : '--',
                    'lessee_signature' => (isset($subtenant->tenant_photo_esignature)) ? $subtenant->tenant_photo_esignature : '',
                );
            }
        }
            
        $data = array(
            'lessor_name' =>(isset($lessor->name)) ? $lessor->name : '--',
            'lessor_email' =>(isset($lessor->email)) ? $lessor->email : '--',
            'lessor_phone' =>(isset($lessor->phone_no)) ? $lessor->phone_no : '--',
            'lessor_postal' =>(isset($lessor->postal_code)) ? $lessor->postal_code : '--',
            'lessor_address' =>(isset($lessor_address)) ? $lessor_address : '--',
            'lessor_id' =>(isset($lessor->id_card)) ? $lessor->id_card : '--',
            'lessor_signature' => $propertiesUnit->po_esignature,
            'furnished' => ($propertiesUnit->bed_funished == 'yes') ? 'Furnished' : 'Non Furnished',
            'unit_category' => ucfirst($propertiesUnit->unit_category),
            'unit_address' => $propertiesUnit->address,
            'building_name' => $building_name,
            'unit_amenities' => $unit_amenities,
            'rent' => $propertiesUnit->rent + $propertiesUnit->fix_price,
            'cost_provision' => $propertiesUnit->cost_provision,
            'fix_price' => $propertiesUnit->fix_price,
            'lessor_account' => (isset($bank_detail->account_number)) ? $bank_detail->account_number : ' ---- ',
            'lessor_bic' => (isset($bank_detail->ada_number)) ? $bank_detail->ada_number : ' ---- ',
            'meters' => $meters,
            'expert' => ($expert->name) ? $expert->name : ' ---- ',
            'signature' => $propertiesUnit->po_esignature,

            'guarantor_name' =>(isset($guarantor->name)) ? $guarantor->name : '--',
            'guarantor_email' =>(isset($guarantor->email)) ? $guarantor->email : '--',
            'guarantor_phone' =>(isset($guarantor->phone_no)) ? $guarantor->phone_no : '--',
            // 'guarantor_postal' =>(isset($guarantor->postal_code)) ? $guarantor->postal_code : '--',
            'guarantor_address' =>(isset($guarantor->address)) ? $guarantor->address : '--',
            'guarantor_id_proof' =>(isset($guarantor->photo_id_proof)) ? $guarantor->photo_id_proof : '--',
            'guarantor_signature' => (isset($guarantor->photo)) ? $guarantor->photo : '',

            'lessee1_name' => (isset($lessee1->name)) ? $lessee1->name : '--',
            'lessee1_email' => (isset($lessee1->email)) ? $lessee1->email : '--',
            'lessee1_phone' => (isset($lessee1->phone_no)) ? $lessee1->phone_no : '--',
            'lessee1_postal' => (isset($lessee1->postal_code)) ? $lessee1->postal_code : '--',
            'lessee1_address' => $lessee1_address,
            'lessee1_id' => (isset($lessee1->id_card)) ? $lessee1->id_card : '--',
            'lessee1_signature' => (isset($booking_details->tenant_photo_esignature)) ? $booking_details->tenant_photo_esignature : '',

            'used' =>(isset($booking_details->contract_type)) ? $booking_details->contract_type : '',
            'start_date' => Helper::Date($booking_details->start_date),
            'end_date' => Helper::Date($booking_details->end_date),
            'contract_months' => $contract_months,
            'company_name' => $company_name,
            'country' => $country_name,
            'coTenant' => $coTenant,
        );

        // echo "<pre>";
        // print_r($data);
        // die('amit0');

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('dynamic_pdf',compact('data')));
        $pdf->stream();
        $rent_agreement = 'agreement_'.time().'.pdf';
        $abc = $pdf->save(public_path('images/agreements/'.$rent_agreement));

        $booking_details->rent_agreement = $rent_agreement;
        $booking_details->save();

        return $rent_agreement;
        // return PDF::loadHTML('<h1>Test</h1> ')->save('/path//my_stored_file.pdf');

    }

    public static function generate_invoice($booking_id)
    {   
        $booking_details = Booking::where('id',$booking_id)->first();

        $propertiesUnit = PropertiesUnit::find($booking_details->unit_id);

        $lessor = User::find($booking_details->po_id);
        $lessee = User::find($booking_details->tenant_id);

        $interval = date_diff(date_create($booking_details->start_date), date_create($booking_details->end_date));
        $contract_months =  $interval->format('%m Month %d Day');

        $invoice_no = Invoice::all()->count() + 1;
        $invoice_no = 'Invoice #'.$invoice_no;

        $payment_method = ucfirst($booking_details->payment_method);
        if($booking_details->payment_method == 'stripe') 
            $payment_method = 'Credit or Debit Card';

        $data = array(
            'lessor_name' =>(isset($lessor->name)) ? $lessor->name : '--',
            'lessor_email' =>(isset($lessor->email)) ? $lessor->email : '--',
            'lessor_phone' =>(isset($lessor->phone_no)) ? $lessor->phone_no : '--',
            
            'unit_name' => $propertiesUnit->unit_name,
            'unit_id' => $booking_details->unit_id,
            'unit_address' => $propertiesUnit->address,
            'rent'         => $propertiesUnit->rent,
            'cost_provision' => $propertiesUnit->cost_provision,
            'monthly_fee' => $propertiesUnit->fix_price,
            'tax' => $propertiesUnit->tax,
            'deposit' => $propertiesUnit->deposit,
            'total_amount' => $propertiesUnit->total_amount,

            'lessee_name' => (isset($lessee->name)) ? $lessee->name : '--',
            'lessee_email' => (isset($lessee->email)) ? $lessee->email : '--',
            'lessee_phone' => (isset($lessee->phone_no)) ? $lessee->phone_no : '--',

            'start_date' => Helper::Date($booking_details->start_date),
            'end_date' => Helper::Date($booking_details->end_date),
            'invoice_date' => Helper::Date(date('y-m-d')),
            'contract_months' => $contract_months,

            'invoice_no' => $invoice_no,
            'payment_method' => $payment_method,
        );

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('invoice',compact('data')));
        $pdf->stream();
        $invoice = 'invoice'.time().'.pdf';
        $abc = $pdf->save(public_path('images/invoice/'.$invoice));

        $Invoice = new Invoice;
        $Invoice->booking_id = $booking_id;
        $Invoice->unit_id = $booking_details->unit_id;
        $Invoice->tenant_id = $booking_details->tenant_id;
        $Invoice->po_id = $booking_details->po_id;
        $Invoice->invoice_no = $invoice_no;
        $Invoice->save();

        return $invoice;
    }
}