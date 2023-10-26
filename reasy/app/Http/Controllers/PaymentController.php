<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use App\User;
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

use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\MembershipPayments;
use Illuminate\Support\Facades\DB;
use App\Plans;
use Auth;
use Carbon\Carbon;
Use Helper;
use App\Booking;
use App\Transactions;
use App\PropertiesUnit;
use Mail;
use Paypalpayment;
use App\Guarantor;
use App\Tickets;
use App\Documents;
use App\Terminate;
use App\Refund;
use App\TenantInvitation;


class PaymentController extends HomeController
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */

    function refund_payment(Request $request)
    {
    	if($request->isMethod('post'))
        {
	    	$postData = Input::all();
	    	$id = $postData['id'];
	        $booking = booking::find($id)->toArray();
	        $Transactions = Transactions::find($booking['transaction_id'])->toArray();
        	$price = $postData['amount'];
        }
        $saleId = $Transactions['saleId'];
        $paymentValue =  (string) round($price,2);
            // ### Refund amount
            // Includes both the refunded amount (to Payer)
            // and refunded fee (to Payee). Use the $amt->details
            // field to mention fees refund details.
        $amt = new Amount();
        $amt->setCurrency('USD')
            ->setTotal($paymentValue);

            // ### Refund object
        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amt);

            // ###Sale
            // A sale transaction.
            // Create a Sale object with the
            // given sale transaction id.
        $sale = new Sale();
        $sale->setId($saleId);

        if($refundedSale = $sale->refundSale($refundRequest, $this->_api_context))
        {
        	$refund_data = array(
        		'contract_id'  => $id,
        		'unit_id'  => $booking['unit_id'],
        		'po_id'  => $booking['po_id'],
        		'tenant_id'  => $booking['tenant_id'],
        		'refund_amount'  => $paymentValue,
        		'method'  => 'paypal',
        		'refundID'  => $refundedSale->id,
        		'time'		=> Helper::DateTime(date("Y-m-d H:m:s")),
        		'status'    => 'done',
        		'related_to'  => 'PropertyReject',
    		);
        	$refund = Refund::create($refund_data);
            $update_data = array(
                'status' =>  3,
                'payment_status'=>'refund',
                'current_status'=> 1
            );
            $update = Booking::where(['id'=>$id])->update($update_data);

            $unit = PropertiesUnit::find( $booking['unit_id'] );
            $unit->booking_status = 0;
            $unit->save(); 

            toastr()->success('Refund done!');
            return redirect('my-contract-list?page=1');
        }
        else
        {
            die('else');
        }
        try {
            // Refund the sale
            // (See bootstrap.php for more on `ApiContext`)
        } catch (Exception $ex) {
            helper::pr($ex);
            helper::pr($refundedSale);
            die('dddd');
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            // ResultPrinter::printError("Refund Sale", "Sale", null, $refundRequest, $ex);
            exit(1);
        }

            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        // ResultPrinter::printResult("Refund Sale", "Sale", $refundedSale->getId(), $refundRequest, $refundedSale);

        // return $refundedSale;
    }


    public function payWithPaypal()
    {
        return view('paywithpaypal');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'plan_id' => ['required'],
        ]); 

        $plan_id = $request->get('plan_id');
        $plan = Plans::find($plan_id);
        if(!$plan->price){
            return back();
        } else {
            $price = $plan->price;
        }

        $info = [   
            'name'=>$request->get('name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'plan_id'=>$request->get('plan_id')
        ];
        $request->session()->put('userinfo', $info);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Item 1') ->setCurrency('USD') ->setQuantity(1) ->setPrice($price); 

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD') ->setTotal($price);

        $transaction = new Transaction();
        $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) ->setCancelUrl(URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));           
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                toastr()->error('Connection timeout');
                return redirect('/register-membership');
            } else {
                toastr()->error('Some error occur, sorry for inconvenient');
                \Session::put('error','Some error occur, sorry for inconvenient');
                return redirect('/register-membership');
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
         toastr()->error('Unknown error occurre');
        return redirect('/register-membership');
    }
    public function getPaymentStatus(Request $request)
    {   
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            toastr()->error('Payment failed');
            return redirect('/register-membership');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') { 
            $userinfo = $request->session()->get('userinfo');
            User::create([
                'name' => $userinfo['name'],
                'last_name' => $userinfo['last_name'],
                'email' => $userinfo['email'],
                'user_role' => 2,
                'password' => Hash::make($userinfo['password']),
            ]);
            $request->session()->forget('userinfo');

            \Session::put('success','User create Succssfully');

            $transactions = $result->getTransactions();
            $currentTime = Carbon::now();
            $membership_end_at = null;
            //$createdUser = $user = User::where('email', $userinfo['email'])->first();
            $plan = Plans::find($userinfo['plan_id']);
            if($plan->time_period_type == 'monthly'){
                $TimeString = Carbon::parse($currentTime->toDateTimeString());
                $membership_end_at = $TimeString->addMonths($plan->time_period);
            } else if($plan->time_period_type == 'yearly'){
                $TimeString = Carbon::parse($currentTime->toDateTimeString());
                $membership_end_at = $TimeString->addYears($plan->time_period);
            }

            $MembershipPayment = new MembershipPayments;
            $MembershipPayment->user_id = DB::table('users')->where('email', $userinfo['email'])->value('id');
            $MembershipPayment->payment_email = $result->getPayer()->getPayerInfo()->getEmail();
            $MembershipPayment->status = $result->getState();
            $MembershipPayment->first_name = $result->getPayer()->getPayerInfo()->getFirstName();
            $MembershipPayment->last_name = $result->getPayer()->getPayerInfo()->getLastName();
            $MembershipPayment->payer_id = $result->getPayer()->getPayerInfo()->getPayerId();
            $MembershipPayment->total_amount = $transactions[0]->getAmount()->getTotal();
            $MembershipPayment->currency = $transactions[0]->getAmount()->getCurrency();
            //$MembershipPayment->payment_time = $result->getCreateTime();
            $MembershipPayment->payment_time = $currentTime->toDateTimeString();
            $MembershipPayment->plan_id = $userinfo['plan_id'];
            $MembershipPayment->membership_end_at = $membership_end_at;
            $MembershipPayment->save();

            Auth::logout();
            toastr()->success('Membership Create Succssfully Please login!');
            return redirect('/login');
            // echo $time = $result->getCreateTime();
            // echo $email = $result->getPayer()->getPayerInfo()->getEmail();
            // echo $first_name = $result->getPayer()->getPayerInfo()->getFirstName();
            // echo $last_name = $result->getPayer()->getPayerInfo()->getLastName();
            // echo $payer_id = $result->getPayer()->getPayerInfo()->getPayerId();
            //  $transactions = $result->getTransactions();
            // echo $totalAmount = $transactions[0]->getAmount()->getTotal();
            // echo $currency = $transactions[0]->getAmount()->getCurrency();
            // die('dd');



            \Session::put('success','Payment success');
            return redirect('/register-membership');
        }
        \Session::put('error','Payment failed');
        toastr()->error('Payment failed');
        return redirect('/register-membership');
    }

    public function postUpgradeMembership(Request $request) {
        $plan_id = $request->get('plan_id');
        $plan = Plans::find($plan_id);
        if(!$plan->price){
            return back();
        } else {
            $price = $plan->price;
        }
        
        $info = ['plan_id'=>$request->get('plan_id')];
        $request->session()->put('userinfo', $info);




        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Item 1') ->setCurrency('USD') ->setQuantity(1) ->setPrice($price); 

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD') ->setTotal($price);

        $transaction = new Transaction();
        $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('upgrade.status')) ->setCancelUrl(URL::route('upgrade.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));           
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                toastr()->error('Connection timeout');
                return redirect('/membership-details');
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                toastr()->error('Some error occur, sorry for inconvenient');
                return redirect('/membership-details');
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        toastr()->error('Unknown error occurred');
        return redirect('/membership-details');
    }

    public function getUpgradetStatus(Request $request){
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            toastr()->error('Payment failed');
            return redirect('/register-membership');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 
            $userinfo = $request->session()->get('userinfo');
            $transactions = $result->getTransactions();
            $currentTime = Carbon::now();
            $membership_end_at = null;
            //$createdUser = $user = User::where('email', $userinfo['email'])->first();
            $plan = Plans::find($userinfo['plan_id']);
            if($plan->time_period_type == 'monthly'){
                $TimeString = Carbon::parse($currentTime->toDateTimeString());
                $membership_end_at = $TimeString->addMonths($plan->time_period);
            } else if($plan->time_period_type == 'yearly'){
                $TimeString = Carbon::parse($currentTime->toDateTimeString());
                $membership_end_at = $TimeString->addYears($plan->time_period);
            }
            $MembershipPayment = new MembershipPayments;
            $MembershipPayment->user_id = Auth::id();
            $MembershipPayment->payment_email = $result->getPayer()->getPayerInfo()->getEmail();
            $MembershipPayment->status = $result->getState();
            $MembershipPayment->first_name = $result->getPayer()->getPayerInfo()->getFirstName();
            $MembershipPayment->last_name = $result->getPayer()->getPayerInfo()->getLastName();
            $MembershipPayment->payer_id = $result->getPayer()->getPayerInfo()->getPayerId();
            $MembershipPayment->total_amount = $transactions[0]->getAmount()->getTotal();
            $MembershipPayment->currency = $transactions[0]->getAmount()->getCurrency();
            //$MembershipPayment->payment_time = $result->getCreateTime();
            $MembershipPayment->payment_time = $currentTime->toDateTimeString();
            $MembershipPayment->plan_id = $userinfo['plan_id'];
            $MembershipPayment->membership_end_at = $membership_end_at;
            $MembershipPayment->save();
            toastr()->success('Upgrade Succssfully');
            return redirect('/membership-details');
        } else {
            toastr()->error('Payment Failed');
            return redirect('/membership-details');
        }
    }

    public function PropertyPayment(Request $request) {
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            // helper::pr($postData);
            // die('ffffffffffffff');
            $booking = booking::where(['unit_id' => $postData['unit_id'], 'tenant_id' => $postData['tenant_id']])->first()->toArray();
            $unit = PropertiesUnit::find($postData['unit_id'])->toArray();
            $price = $booking['total_amount'];
            $name  = $unit['unit_name'];
            $description  = $unit['description'];
            if(isset($postData['paypal']) && $postData['paypal'] == 'paypal')
            {
                $info = [   
                    'name'=> $name,
                    'price'=> $price,
                    'description'=> $description,
                    'unit_id'=> $postData['unit_id'],
                    'tenant_id'=> $postData['tenant_id'],
                    "booking_id"    => $booking['id'],
                ];
                $request->session()->put('info', $info);

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($name) ->setCurrency('USD') ->setQuantity(1) ->setPrice($price); 

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));

                $amount = new Amount();
                $amount->setCurrency('USD') ->setTotal($price);

                $transaction = new Transaction();
                $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription($description);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('property-payment.status')) ->setCancelUrl(URL::route('property-payment.status'));

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));           
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        toastr()->error('Connection timeout!');
                        return redirect('/book-property/'.$postData['unit_id']);
                    } else {
                        toastr()->error('Some error occur, sorry for inconvenient!');
                        return redirect('/book-property/'.$postData["unit_id"]);
                    }
                }
                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                Session::put('paypal_payment_id', $payment->getId());
                if(isset($redirect_url)) {
                    return Redirect::away($redirect_url);
                }
                toastr()->error('Unknown error occurred!');
                return redirect('/book-property/'.$postData["unit_id"]);
            }
            // elseif(isset($postData['bank']) && $postData['bank'] == 'bank')
            else
            {
                $where_data = array('unit_id' => $postData['unit_id'], 'tenant_id' => $postData['tenant_id'], 'current_status' => '0');

                $receipt_upload_time = date('Y-m-d', strtotime(date("Y-m-d"). ' + 2 days'));
                $receipt_upload_time = Helper::Date($receipt_upload_time);

                $booking_data = array(
                    'step' =>5, 
                    'status' => '0',
                    'payment_method' => 'bank',
                    'payment_status' => 'pending',
                    'receipt_upload_time' => $receipt_upload_time,
                );
                $booking_update = Booking::where($where_data)->update($booking_data);
                $unit_update = PropertiesUnit::where(['id' => $postData['unit_id']])->update(['booking_status' => 1]);
                $pm_id = $unit['property_manager_id'];
                $pm_details = User::find($pm_id)->toArray();
                $pm_name      = $pm_details['name'];
                $pm_email     = trim($pm_details['email']);
                $tenant_details = User::find($postData['tenant_id'])->toArray();

                $TenantInvitation = TenantInvitation::where(['unit_id' => $postData['unit_id'],'booking_id' =>$booking['id'] ])->get();
                if(count($TenantInvitation) > 0)
                {
                    foreach ($TenantInvitation as $key => $value) {
                        $to_email = trim($value->email);
                        
                        $data = array(
                            "email"         => $to_email,
                            "Invitation_id" => $value->id,
                            'tenant_id'     => $value->tenant_id,
                            "tenant_name"   => $tenant_details['name'],
                            "unit_id"       => $value->unit_id,
                        );
                        Mail::send('emails.Co-Tenant-invitation', $data, function($message) use ($to_email) {
                            $message->to($to_email,'Tenant')
                                    ->subject('Invitation request to become Co-Tenant');
                            $message->from('amitpunjvision@gmail.com','Reasy Property');
                        });
                    }
                }
                
                $pm_data = array(
                    'name'      => $pm_details['name'],
                    "email"     => $pm_details['email'],
                    "unit_name"     => $unit['unit_name'],
                    "description"   => $unit['description'],
                    "price"         => $unit['rent'] + $unit['cost_provision'] + $unit['tax'] + $unit['fix_price'] + $unit['deposit'],
                    "tenant_name"   => $tenant_details['name'],
                    "booking_id"    => $booking['id'],
                );
                    
                Mail::send('emails.unit_booking_to_pm', $pm_data, function($message) use ($pm_name, $pm_email) {
                    $message->to($pm_email, $pm_name)
                            ->subject('Property Booking');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });

                $po_id = $unit['user_id'];
                $po_details = User::find($po_id)->toArray();
                $po_name      = $po_details['name'];
                $po_email     = trim($po_details['email']);

                $po_data = array(
                    'name'      => $po_details['name'],
                    "email"     => $po_details['email'],
                    "unit_name"     => $unit['unit_name'],
                    "description"   => $unit['description'],
                    "price"         => $unit['rent'] + $unit['cost_provision'] + $unit['tax'] + $unit['fix_price'] + $unit['deposit'],
                    "tenant_name"   => $tenant_details['name'],
                    "booking_id"    => $booking['id'],
                );

                Mail::send('emails.unit_booking_to_pm', $po_data, function($message) use ($po_name, $po_email) {
                    $message->to($po_email, $po_name)
                            ->subject('Property Booking');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });

                if($booking['guarantor_id'] != 0 && !is_null($booking['guarantor_id']) )
                {
                    $guarantor = Guarantor::find($booking['guarantor_id'])->toArray();
                    $guarantor_name      = $guarantor['name'];
                    $guarantor_email     = trim($guarantor['email']);
                    $guarantor_data = array(
                        'name'      => $guarantor['name'],
                        "email"     => $guarantor['email'],
                        "unit_name"     => $unit['unit_name'],
                        "description"   => $unit['description'],
                        "price"         => $unit['rent'] + $unit['cost_provision'] + $unit['tax'] + $unit['fix_price'] + $unit['deposit'],
                        "tenant_name"   => $tenant_details['name'],
                        "booking_id"    => $booking['id'],
                        "guarantor_id"  => Helper::encrypt_decrypt($booking['guarantor_id'], 'e' ),
                    );
                        
                    Mail::send('emails.guarantor_email', $guarantor_data, function($message) use ($guarantor_name, $guarantor_email) {
                        $message->to($guarantor_email, $guarantor_name)
                                ->subject('Guarantor Details');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });
                }
                toastr()->success('Payment Done!');
                return redirect('/thankyou-for-book-property');
                return redirect('/');
            }
        }
    }

    public function PropertyPaymentStatus(Request $request)
    {   
        $payment_id = Session::get('paypal_payment_id');
        $postData = Input::all();
        $info = $request->session()->get('info');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            toastr()->error('Payment failed!');
            return redirect('/book-property/'.$info['unit_id']);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 

            $transaction = new Transactions();
            $transaction->paypal_id = $postData['paymentId'];
            $transaction->paypal_PayerID = $postData['PayerID'];
            $transaction->paypal_status = 'paid';
            $transaction->related_to = 'rent';
            $transaction->saleId = $result->transactions[0]->related_resources[0]->sale->id;
            // $transaction->description = 'Description';
            $transaction->amount = $info['price'];
            $transaction->payment_by = 'Paypal';
            $transaction->booking_id = $info['booking_id'];
            $transaction->save();
            $transaction_id = $transaction->id;

            $where_data = array('unit_id' => $info['unit_id'], 'tenant_id' => $info['tenant_id'], 'current_status' => '0');
            $booking_data = array(
                'step' =>5, 
                'transaction_id' => $transaction_id,
                'status' => '0',
                'payment_method' => 'paypal',
                'payment_status' => 'paid',
            );
            $booking_update = Booking::where($where_data)->update($booking_data);
            $unit_update = PropertiesUnit::where(['id' => $info['unit_id']])->update(['booking_status' => 1]);

            $unit = PropertiesUnit::where(['id' => $info['unit_id']])->first()->toArray();
            $pm_id = $unit['property_manager_id'];
            $pm_details = User::find($pm_id)->toArray();
            $pm_name      = $pm_details['name'];
            $pm_email     = trim($pm_details['email']);
            $tenant_details = User::find($info['tenant_id'])->toArray();
            $tenant_name      = $tenant_details['name'];
            $tenant_email     = trim($tenant_details['email']);
                
            $TenantInvitation = TenantInvitation::where(['unit_id' => $info['unit_id'],'booking_id' => $info['booking_id'] ])->get();
            if(count($TenantInvitation) > 0)
            {
                foreach ($TenantInvitation as $key => $value) {
                    $to_email = trim($value->email);
                    
                    $data = array(
                        "email"         => $to_email,
                        "Invitation_id" => $value->id,
                        'tenant_id'     => $value->tenant_id,
                        "tenant_name"   => $tenant_details['name'],
                        "unit_id"       => $value->unit_id,
                    );
                    Mail::send('emails.Co-Tenant-invitation', $data, function($message) use ($to_email) {
                        $message->to($to_email,'Tenant')
                                ->subject('Invitation request to become Co-Tenant');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });
                }
            }

            /*Generate Invoice*/                
            $invoice = Helper::generate_invoice($info['booking_id']);
            $bookingUpdate = Booking::where('id',$info['booking_id'])->update(['invoice'=>$invoice]);
            $path = public_path('images/invoice/'.$invoice);
            $tenant_data = array(
                'name'      => $tenant_details['name'],
                "unit_name"     => $unit['unit_name'],
            );
                
            Mail::send('emails.invoice_to_tenant', $tenant_data, function($message) use ($tenant_name, $tenant_email,$path) {
                $message->to($tenant_email, $tenant_name)
                        ->subject('Property Booking');
                $message->from('amitpunjvision@gmail.com','Reasy Property')
                ->attach($path, [
                    'as' => 'Invoice.pdf', 
                    'mime' => 'application/pdf'
                ]);
            });
            
            $pm_data = array(
                'name'      => $pm_details['name'],
                "email"     => $pm_details['email'],
                "unit_name"     => $unit['unit_name'],
                "description"   => $unit['description'],
                "price"         => $info['price'],
                "tenant_name"   => $tenant_details['name'],
                "booking_id"    => $info['booking_id'],
            );
                
            Mail::send('emails.unit_booking_to_pm', $pm_data, function($message) use ($pm_name, $pm_email) {
                $message->to($pm_email, $pm_name)
                        ->subject('Property Booking');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            $po_id = $unit['user_id'];
            $po_details = User::find($po_id)->toArray();
            $po_name      = $po_details['name'];
            $po_email     = trim($po_details['email']);

            $po_data = array(
                'name'      => $po_details['name'],
                "email"     => $po_details['email'],
                "unit_name"     => $unit['unit_name'],
                "description"   => $unit['description'],
                "price"         => $unit['rent'] + $unit['cost_provision'] + $unit['tax'] + $unit['fix_price'] + $unit['deposit'],
                "tenant_name"   => $tenant_details['name'],
                "booking_id"    => $info['booking_id'],
            );

            Mail::send('emails.unit_booking_to_pm', $po_data, function($message) use ($po_name, $po_email) {
                $message->to($po_email, $po_name)
                        ->subject('Property Booking');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            $booking = booking::where($where_data)->first()->toArray();
            if($booking['guarantor_id'] != 0 && !is_null($booking['guarantor_id']) )
            {
                $guarantor = Guarantor::find($booking['guarantor_id'])->toArray();
                $guarantor_name      = $guarantor['name'];
                $guarantor_email     = trim($guarantor['email']);
                $guarantor_data = array(
                    'name'      => $guarantor['name'],
                    "email"     => $guarantor['email'],
                    "unit_name"     => $unit['unit_name'],
                    "description"   => $unit['description'],
                    "price"         => $info['price'],
                    "tenant_name"   => $tenant_details['name'],
                    "booking_id"    => $booking['id'],
                    "guarantor_id"  => Helper::encrypt_decrypt($booking['guarantor_id'], 'e' ),
                );
                    
                Mail::send('emails.guarantor_email', $guarantor_data, function($message) use ($guarantor_name, $guarantor_email) {
                    $message->to($guarantor_email, $guarantor_name)
                            ->subject('Guarantor Details');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });

            }

            toastr()->success('Payment Done!');
            return redirect('/thankyou-for-book-property');
            return redirect('/');
        }
        else
        {
            toastr()->error('Payment failed!');
            return redirect('/book-property/'.$info['unit_id']);
        }
    }
 
    public function PropertyPayDues(Request $request, $id) {
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            // Helper::pr($postData);
            // die('ffffffffffffff');
            $tenant_id = Auth::user()->id;
            $user = Auth::user();
            $contract = Booking::find($id);
            $terminate = Terminate::where(['booking_id' => $id, 'tenant_id' => $tenant_id])->first();
            
            $price = $postData['due_amount'];
            $name  = 'Pay dues';
            $description  = 'Pay dues for exit property';
            if(isset($postData['paypal']) && $postData['paypal'] == 'paypal')
            {
                $info = [   
                    'name'=> $name,
                    'price'=> $price,
                    'description'=> $description,
                    'unit_id'=> $terminate->unit_id,
                    'tenant_id'=> $tenant_id,
                    "booking_id"    => $id,
                ];
                $request->session()->put('info', $info);

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($name) ->setCurrency('USD') ->setQuantity(1) ->setPrice($price); 

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));

                $amount = new Amount();
                $amount->setCurrency('USD') ->setTotal($price);

                $transaction = new Transaction();
                $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription($description);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('property-pay-dues.status',[$id])) ->setCancelUrl(URL::route('property-pay-dues.status',[$id]));

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));           
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        toastr()->error('Connection timeout!');
                        return redirect('pay-dues/'.$id);
                    } else {
                        toastr()->error('Some error occur, sorry for inconvenient!');
                        return redirect('pay-dues/'.$id);
                    }
                }
                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                Session::put('paypal_payment_id', $payment->getId());
                if(isset($redirect_url)) {
                    return Redirect::away($redirect_url);
                }
                toastr()->error('Unknown error occurred!');
                return redirect('pay-dues/'.$id);
            }
        }
    }

    public function PropertyPayDuesStatus(Request $request, $id)
    {   
        $tenant_id = Auth::user()->id;
        $user = Auth::user();
        $contract = Booking::find($id);
        $terminate = Terminate::where(['booking_id' => $id, 'tenant_id' => $tenant_id])->first();

        $payment_id = Session::get('paypal_payment_id');
        $postData = Input::all();
        $info = $request->session()->get('info');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            toastr()->error('Payment failed!');
            return redirect('pay-dues/'.$id);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 

            $transaction = new Transactions();
            $transaction->paypal_id = $postData['paymentId'];
            $transaction->paypal_PayerID = $postData['PayerID'];
            $transaction->saleId = $result->transactions[0]->related_resources[0]->sale->id;
            $transaction->paypal_status = 'paid';
            $transaction->related_to = 'PayDues';
            $transaction->terminate_id = $terminate->id;
            $transaction->amount = $info['price'];
            $transaction->payment_by = 'Paypal';
            $transaction->booking_id = $id;
            $transaction->save();
            $transaction_id = $transaction->id;

             // $user = User::find($tenant_id);
            // $user->wallet_amount -= $postData['dues_amount'];
            // $user->save();

            // $unit = PropertiesUnit::find($contract->unit_id);
            $contract->deposit_amount -= $info['price'];
            $contract->save();

            $where_data = array('id' => $terminate->id );
            $terminate_data = array(
                'step'       => '4',
                'pay_dues'   => 'payment',
                'payment_method'   => 'paypal',
                'payment_status'   => 'paid',
                'transaction_id'   => $transaction->id,
                'status'     => '7',
            );
            $deposit = $contract->deposit_amount;
            if($deposit <= 0 )
            {
                $terminate_data['StatusForPMPO'] = 1;
            }
            $terminate_update = Terminate::where($where_data)->update($terminate_data);     

            toastr()->success('Payment Done!');
            $url = ($terminate->notice == 'BeforeTenancy') ? 'TerminateBT-Contract' : 'terminate-contract' ;
            return redirect($url.'/'.$id);
        }
        else
        {
            toastr()->error('Payment failed!');
            return redirect('/pay-dues/'.$id);
        }
    }

    public function PaypalAddMoney(Request $request) {
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            // Helper::pr($postData);
            // die('ffffffffffffff');
            $currencyType =  \App\Helpers\Helper::CURRENCYSYMBAL ;
            $tenant_id = Auth::user()->id;
            $user = Auth::user();

            $price = $postData['amount'];
            $name  = 'Add money';
            $description  = 'Add money to my wallet';
            if(isset($postData['paypal']) && $postData['paypal'] == 'paypal')
            {
                $info = [   
                    'name'=> $name,
                    'price'=> $price,
                    'description'=> $description,
                    'tenant_id'=> $tenant_id,
                ];
                $request->session()->put('info', $info);

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($name)->setCurrency('USD') ->setQuantity(1) ->setPrice($price); 

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));

                $amount = new Amount();
                $amount->setCurrency('USD') ->setTotal($price);

                $transaction = new Transaction();
                $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription($description);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('paypal-add-money.status')) ->setCancelUrl(URL::route('paypal-add-money.status'));

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));           
                try {
                        $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        toastr()->error('Connection timeout!');
                        return redirect('add-money');
                    } else {
                        toastr()->error('Some error occur, sorry for inconvenient!');
                        return redirect('add-money');
                    }
                }
                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                Session::put('paypal_payment_id', $payment->getId());
                if(isset($redirect_url)) {
                    return Redirect::away($redirect_url);
                }
                toastr()->error('Unknown error occurred!');
                return redirect('add-money');
            }
        }
    }

    public function PaypalAddMoneyStatus(Request $request)
    {   
        $tenant_id = Auth::user()->id;
        $user = Auth::user();

        $payment_id = Session::get('paypal_payment_id');
        $postData = Input::all();
        $info = $request->session()->get('info');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            toastr()->error('Payment failed!');
            return redirect('add-money');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 

            $transaction = new Transactions();
            $transaction->paypal_id = $postData['paymentId'];
            $transaction->tenant_id = $tenant_id;
            $transaction->paypal_PayerID = $postData['PayerID'];
            $transaction->paypal_status = 'paid';
            $transaction->related_to = 'AddMoney';
            $transaction->amount = $info['price'];
            $transaction->payment_by = 'Paypal';
            $transaction->save();

            $user = User::find($tenant_id);
            $user->wallet_amount += $info['price'];
            $user->save();

            toastr()->success('Payment Done!');
            return redirect('my-wallet');
        }
        else
        {
            toastr()->error('Payment failed!');
            return redirect('add-money');
        }
    }

  }