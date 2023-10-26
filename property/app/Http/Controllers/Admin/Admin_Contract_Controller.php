<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use URL;
use Session;
use App\Http\Controllers\Controller;
use Redirect;
use App\User;
use App\Properties;
use App\Booking;
use App\Meters;
use App\MeterReadings;
use App\Contracts;
use App\PropertiesUnit;
use App\Transactions;
use App\Tickets;
use App\Ticket_thread;
use App\Rating;
use App\Documents;
use App\Vendors;
use App\Guarantor;
Use Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Terminate;
use App\UserBankAccount;
use App\appointments;

use Validator;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\Input;
class Admin_Contract_Controller extends Controller
{ 
      public function admin_contractDetails(Request $request, $id){
        $contract = Booking::find($id);
        $transactions = Transactions::where([ 'id' => $contract->transaction_id ])->orderBy('created_at','desc')->get();
        $tickets = Tickets::where([ 'booking_id' => $contract->id ])->orderBy('created_at','desc')->get();
        $documents = Documents::where(['unit_id' =>  $contract->unit_id, 'contract_id' => $id ])->get();
        $account_info = UserBankAccount::where(['user_id'=>$contract->tenant_id,'user_type'=>1])->first();
        $terminate = Terminate::find( $contract->terminate_id );
        $unit = PropertiesUnit::find( $contract->unit_id );
        $tenant = User::find( $contract->tenant_id);
        $guarantor = Guarantor::find( $contract->guarantor_id );
        $propertyManager = User::find( $contract->pm_id );
        $propertyOwner = User::find( $unit->user_id );
        $propertyLegalAdvisor = User::find( $unit->property_legal_advisor_id );
        return view('admin.contract.contract_detail')->with([
            'contract' => $contract,
            'unit' => $unit,
            'tenant' => $tenant,
            'propertyManager' => $propertyManager,
            'propertyOwner' => $propertyOwner,
            'propertyLegalAdvisor' => $propertyLegalAdvisor,
            'transactions' => $transactions,
            'documents' => $documents,
            'tickets' => $tickets,
            'terminate' => $terminate,
            'account_info' => $account_info,
            'guarantor' => $guarantor,
        ]); 
    }
     public function add_ticket(Request $request,$id)
     {
         if($request->isMethod('post'))
         {
             $postData = Input::all();
            $ticket = new Tickets();
            $ticket->title = $postData['t_title'];
            $ticket->description = $postData['t_description'];
            $ticket->department = $postData['t_department'];
            $ticket->status = 'pending';
            $ticket->unit_id = $postData['unit_id'];
            $ticket->booking_id = $id;
            $ticket->tenant_id = Auth::user()->id;
            $ticket->save();


            $booking = Booking::where(['id' => $id])->first()->toArray();
            $unit = PropertiesUnit::where(['id' => $postData['unit_id']])->first()->toArray();
            $pm_id = $booking['pm_id'];
            $pm_details = User::find($pm_id)->toArray();
            $pm_name      = $pm_details['name'];
            $pm_email     = trim($pm_details['email']);
            $tenant_details = User::find($booking['tenant_id'])->toArray();
            $tenant_name      = $tenant_details['name'];
            $tenant_email     = trim($tenant_details['email']);

            $pm_data = array(
                'name'      => $pm_details['name'],
                "email"     => $pm_details['email'],
                "title"     => $postData['t_title'],
                "description"   => $postData['t_description'],
                "department"   => $postData['t_department'],
                "tenant_name"   => $tenant_details['name'],
                "booking_id"    => $id,
            );
                
            Mail::send('emails.ticket_mail_to_pm', $pm_data, function($message) use ($pm_name, $pm_email) {
                $message->to($pm_email, $pm_name)
                        ->subject('Ticket Raised');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            toastr()->success('Ticket Raised Successfully!');
            return Redirect('contract-detail-admin/'.$id)->with('flash_message_success','ticket add Successfully');
         }
     }

     public function ticket_listing(Request $request)
     {
         $all_tickets = Tickets::orderBy('id','DESC')->paginate(10);
         return view('admin.tickets.ticket_list',compact('all_tickets'));
     } 
    public function admin_ticket_view(Request $request, $id)
    {
        $ticket = Tickets::find($id);
        $ticket_threads = Ticket_thread::where('ticket_id', $id)->get();
        // Helper::pr($ticket);
        // Helper::pr($ticket_threads);
        // die('aaaaaaaaaa');
        return view('admin.tickets.ticket_view',compact('ticket','ticket_threads'));
    } 



}