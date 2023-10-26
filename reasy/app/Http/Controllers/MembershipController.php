<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Plans;
use App\Properties;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Validator;
use Stripe;
Use Helper;
use URL;
use Redirect;
use App\Transactions;
use App\MembershipPayments;
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
class MembershipController extends Controller
{
     public function __construct(){
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    //Register Membership For Guest User
    public function registerMembership($id){
        $plans = Plans::where('status',1)->orderBy('price','ASC')->get();
        $selectedPlan = Plans::find($id);
        return view('membership.register-member')->with(['plans' => $plans, 'selectedPlan' => $selectedPlan ]);
    }

    //Register Membership For Guest User
    public function listMembershipPlans(){
        $plans = Plans::where('status',1)->orderBy('price','ASC')->get();
        return view('membership.list-membership-plans')->with(['plans'=>$plans]);
    }

    //Plan detail Page
    public function planDetail($id){
        $planDetail = Plans::find($id);
        return view('membership.plan-detail')->with(['planDetail' => $planDetail]);
    }

    //Po Membership detail
    public function membershipDetails(){
        $plans = Plans::all();
        $membershipEndDate = DB::table('membership_payments')->where('user_id', \Auth::user()->id)->max('membership_end_at');
        $endDate = Carbon::parse($membershipEndDate);
        $currentDate = Carbon::now();
        $diffInDays = $endDate->diffInDays($currentDate);
        $membership_data = DB::table('membership_payments')
            ->join('plans', 'membership_payments.plan_id', '=', 'plans.id')
            ->where('membership_payments.user_id', \Auth::user()->id)
            ->select('membership_payments.*', 'plans.*', 'membership_payments.status')
            ->orderBy('membership_payments.membership_end_at', 'desc')
            ->get();
        return view('membership.member-ship-details')->with([
            'membership_data'=>$membership_data, 
            'plans'=>$plans,
            'membershipEndDate'=>$membershipEndDate,
            'diffInDays'=>$diffInDays,
        ]);
    }

    //Ajax request for verify membership email
    public function verifyMembershipEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 200);
        } else{
            return response()->json(['success'=>['valid']], 200);
        }
    }


    //for checkout page View
    public function membershipCheckout(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'plan_id' => ['required'],
        ]);
        $planDetail = Plans::find($request->plan_id);
        $payment_for = 'membershipPlan'; 
        $amount = $planDetail->price;
        $data = $request;
        return view('contracts.check-out',compact('payment_for', 'amount', 'planDetail', 'data'));
    }

    //membershipPaypal
    public function membershipPaypal(Request $request){
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
        //die('dsa');
        $item_1 = new Item();
        $item_1->setName('Item 1') ->setCurrency(helper::currencyType()) ->setQuantity(1) ->setPrice($request->get('amount')); 

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency(helper::currencyType()) ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('membership.redirect.paypal')) ->setCancelUrl(URL::route('membership.listpaln'));

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
                return redirect('/register-membership/'.$request->get('plan_id'));
            } else {
                toastr()->error('Some error occur, sorry for inconvenient');
                \Session::put('error','Some error occur, sorry for inconvenient');
                return redirect('/register-membership/'.$request->get('plan_id'));
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
        return redirect('/register-membership/'.$request->get('plan_id'));
    }

     //membershipPaypal return
    public function membershipPaypalReturn(Request $request){
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            toastr()->error('Payment failed');
            return redirect('/list-membership-plans');
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
            $userId = DB::table('users')->where('email', $userinfo['email'])->value('id');

            \Session::put('success','User create Succssfully');


            $transactions = $result->getTransactions();
            $currentTime = Carbon::now();
            $membership_end_at = null;
            $plan = Plans::find($userinfo['plan_id']);
            if($plan->time_period_type == 'monthly'){
                $TimeString = Carbon::parse($currentTime->toDateTimeString());
                $membership_end_at = $TimeString->addMonths($plan->time_period);
            } else if($plan->time_period_type == 'yearly'){
                $TimeString = Carbon::parse($currentTime->toDateTimeString());
                $membership_end_at = $TimeString->addYears($plan->time_period);
            }

            $transaction = new Transactions();
            $transaction->related_to = 'membership';
            $transaction->tenant_id = $userId;
            $transaction->amount = $transactions[0]->getAmount()->getTotal();
            $transaction->payment_by = 'Paypal';
            $transaction->paypal_status = 'paid';
            $transaction->paypal_id = $request->paymentId;
            $transaction->paypal_PayerID = $result->getPayer()->getPayerInfo()->getPayerId();
            $transaction->save();

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
            $this->sendMembershipMail($userId, $userinfo['plan_id'], $transactions[0]->getAmount()->getTotal(), 'Paypal');
            Auth::logout();
            toastr()->success('Membership Create Succssfully Please login!');
            return redirect('/login');

            \Session::put('success','Payment success');
            return redirect('/register-membership/'.$userinfo['plan_id']);
        }
        \Session::put('error','Payment failed');
        toastr()->error('Payment failed');
        return redirect('/list-membership-plans');
    }

    //stripe
    public function membershipStripe(Request $request){
        if($request->stripeToken){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $currencyType =  helper::currencyType() ;
            $return = Stripe\Charge::create ([
                        "amount" => $request->get('amount'),
                        "currency" => $currencyType,
                        "source" => $request->stripeToken,
                        "description" => "Membership",
                    ]);
            if($return->status == 'succeeded'){
                User::create([
                    'name' => $request->get('name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'user_role' => 2,
                    'password' => Hash::make($request->get('password')),
                ]);
                $userId = DB::table('users')->where('email', $request->get('email'))->value('id');

                $transaction = new Transactions();
                $transaction->related_to = 'membership';
                $transaction->tenant_id = $userId;
                $transaction->amount = $request->get('amount') / 100;
                $transaction->payment_by = 'Stripe';
                $transaction->stripe_id = $return->id;
                $transaction->save();

                $currentTime = Carbon::now();
                $membership_end_at = null;
                $plan = Plans::find($request->get('plan_id'));
                if($plan->time_period_type == 'monthly'){
                    $TimeString = Carbon::parse($currentTime->toDateTimeString());
                    $membership_end_at = $TimeString->addMonths($plan->time_period);
                } else if($plan->time_period_type == 'yearly'){
                    $TimeString = Carbon::parse($currentTime->toDateTimeString());
                    $membership_end_at = $TimeString->addYears($plan->time_period);
                }

                $MembershipPayment = new MembershipPayments;
                $MembershipPayment->user_id = DB::table('users')->where('email', $request->get('email'))->value('id');
                $MembershipPayment->payment_email = $request->get('email');
                $MembershipPayment->status = $return->status;
                $MembershipPayment->first_name = $request->get('name');
                $MembershipPayment->last_name = $request->get('last_name');
                $MembershipPayment->payer_id = $return->id;
                $MembershipPayment->total_amount = $request->get('amount') / 100;
                $MembershipPayment->currency = $currencyType;
                //$MembershipPayment->payment_time = $result->getCreateTime();
                $MembershipPayment->payment_time = $currentTime->toDateTimeString();
                $MembershipPayment->plan_id = $request->get('plan_id');
                $MembershipPayment->membership_end_at = $membership_end_at;
                $MembershipPayment->save();
                $this->sendMembershipMail($userId, $request->get('plan_id'), ($request->get('amount') / 100), 'Stripe');
                Auth::logout();
                toastr()->success('Membership Create Succssfully Please login!');
                return redirect('/login');
            } else {
                toastr()->error('Something Went Wrong!');
                return redirect('/list-membership-plans');
            }
        } else {
            toastr()->error('Payment not Recived!');
            return redirect('/list-membership-plans');
        }
    }

    public function sendMembershipMail($poId, $planId, $amount, $paymentMethod){
        $poUser = User::find($poId);
        $plan = Plans::find($planId);
        $emailData = array(
            'po_name'   => $poUser->name." ".$poUser->last_name,
            "membershipTitle"         => $plan->title,
            "membershipPaymentMethod"   => $paymentMethod,
            "membershipPrice"         => $amount,
        );
        $poEmail = $poUser->email;
        Mail::send('emails.membership_confirmation', $emailData, function($message) use ( $poEmail) {
            $message->to($poEmail)
                    ->subject('Membership Confirmation');
            $message->from('amitpunjvision@gmail.com','Reasy Property');
        });
    }

    public function upgradeMembershipCheckout($id){
        $planDetail = Plans::find($id);
        $payment_for = 'upgrade_membership'; 
        $amount = $planDetail->price;
        return view('contracts.check-out',compact('payment_for', 'amount', 'planDetail'));
    }

    public function upgradeMembershipStripe(Request $request){
        if($request->stripeToken){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $currencyType =  helper::currencyType() ;
            $return = Stripe\Charge::create ([
                        "amount" => $request->get('amount'),
                        "currency" => $currencyType,
                        "source" => $request->stripeToken,
                        "description" => "Membership",
                    ]);
            if($return->status == 'succeeded'){
                $transaction = new Transactions();
                $transaction->related_to = 'membership';
                $transaction->tenant_id = Auth::id();
                $transaction->amount = $request->get('amount') / 100;
                $transaction->payment_by = 'Stripe';
                $transaction->stripe_id = $return->id;
                $transaction->save();

                $currentTime = Carbon::now();
                $membership_end_at = null;
                $plan = Plans::find($request->get('plan_id'));
                if($plan->time_period_type == 'monthly'){
                    $TimeString = Carbon::parse($currentTime->toDateTimeString());
                    $membership_end_at = $TimeString->addMonths($plan->time_period);
                } else if($plan->time_period_type == 'yearly'){
                    $TimeString = Carbon::parse($currentTime->toDateTimeString());
                    $membership_end_at = $TimeString->addYears($plan->time_period);
                }

                $MembershipPayment = new MembershipPayments;
                $MembershipPayment->user_id = Auth::id();
                $MembershipPayment->payment_email = $return['billing_details']->name;
                $MembershipPayment->status = $return->status;
                $MembershipPayment->first_name =Auth::user()->name;
                $MembershipPayment->last_name = Auth::user()->last_name;
                $MembershipPayment->payer_id = $return->id;
                $MembershipPayment->total_amount = $request->get('amount') / 100;
                $MembershipPayment->currency = $currencyType;
                //$MembershipPayment->payment_time = $result->getCreateTime();
                $MembershipPayment->payment_time = $currentTime->toDateTimeString();
                $MembershipPayment->plan_id = $request->get('plan_id');
                $MembershipPayment->membership_end_at = $membership_end_at;
                $MembershipPayment->save();
                $this->sendMembershipMail(Auth::id(), $request->get('plan_id'), ($request->get('amount') / 100), 'Stripe');
                toastr()->success('Membership Upgrade Succssfully!');
                return redirect('/membership-details');
            } else {
                toastr()->error('Something Went Wrong!');
                return redirect('/membership-details');
            }
        } else {
            toastr()->error('Payment not Recived!');
            return redirect('/membership-details');
        }
    }
}
