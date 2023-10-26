<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use URL;
use Redirect;
use App\Guarantor;
use App\User;
use App\PropertiesUnit;
use App\Booking;
use App\Transactions;
use App\MeterReadings;
use App\UnitsRent;
Use Helper;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Terminate;
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
   
class PayingBillController extends Controller {
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function payUnitRent($id) {
        $rentDetail = UnitsRent::find($id);
        $payment_for = 'payUnitRent'; 
        $postData = Input::all();
        $amount = $rentDetail->rent;
        $tenant_id  = Auth::user()->id;
        $user       = Auth::user();
        return view('contracts.check-out',compact('payment_for', 'user', 'amount', 'rentDetail'));
    }
    public function payMeterBill($id) {
        $readingDetail = MeterReadings::find($id);
        $payment_for = 'payMeterBill'; 
        $postData = Input::all();
        $amount = $readingDetail->amount;
        $tenant_id  = Auth::user()->id;
        $user       = Auth::user();
        return view('contracts.check-out',compact('payment_for', 'user', 'amount', 'readingDetail'));
    }

    public function stripePayUnitRent(Request $request){
        if($request->stripeToken){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $currencyType =  helper::currencyType() ;
            $return = Stripe\Charge::create ([
                        "amount" => $request->get('amount'),
                        "currency" => $currencyType,
                        "source" => $request->stripeToken,
                        "description" => "Meter Rent ",
                    ]);
            if($return->status == 'succeeded'){
                
                $transaction = new Transactions();
                $transaction->related_to = 'rent';
                $transaction->tenant_id = Auth::user()->id;
                $transaction->amount = $request->get('amount') / 100;
                $transaction->payment_by = 'Stripe';
                $transaction->stripe_id = $return->id;
                $transaction->save();

                $rentDetail = UnitsRent::find($request->get('rent_id'));
                $rentDetail->rent_status = 'paid';
                $rentDetail->save();
                $this->sendRentMail($rentDetail->unit_id, ($request->get('amount') / 100), 'Stripe');
                toastr()->success('Unit Rent Payed successfully!');
                return redirect('my-wallet');
            } else {
                toastr()->error('Something Went Wrong!');
                return redirect()->back();
            }
        } else {
            toastr()->error('Payment not Recived!');
            return redirect()->back();
        }
    }
    public function stripePayMeterBill(Request $request){
        if($request->stripeToken){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $currencyType =  helper::currencyType() ;
            $return = Stripe\Charge::create ([
                        "amount" => $request->get('amount'),
                        "currency" => $currencyType,
                        "source" => $request->stripeToken,
                        "description" => "Meter Rent ",
                    ]);
            if($return->status == 'succeeded'){
                
                $transaction = new Transactions();
                $transaction->related_to = 'meter bill';
                $transaction->tenant_id = Auth::user()->id;
                $transaction->amount = $request->get('amount') / 100;
                $transaction->payment_by = 'Stripe';
                $transaction->stripe_id = $return->id;
                $transaction->save();
                
                $readingDetail = MeterReadings::find($request->get('reading_id'));
                $readingDetail->status = 'confirm';
                $readingDetail->save();
                $this->sendBillMail($readingDetail->unit_id, ($request->get('amount') / 100), 'Stripe');
                toastr()->success('Meter Bill Payed successfully!');
                return redirect('my-wallet');
            } else {
                toastr()->error('Something Went Wrong!');
                return redirect()->back();
            }
        } else {
            toastr()->error('Payment not Recived!');
            return redirect()->back();
        }
    }
    public function bankPayBill(Request $request){
        if($request->get('payment_method') == 'bank'){
            $transaction = new Transactions();
            $transaction->related_to = 'meter bill';
            $transaction->tenant_id = Auth::user()->id;
            $transaction->amount = $request->get('amount');
            $transaction->payment_by = 'Bank Transfer';
            $transaction->save();

            $readingDetail = MeterReadings::find($request->get('reading_id'));
            $readingDetail->status = 'hold';
            $readingDetail->save();
            $this->sendBillMail($readingDetail->unit_id, $request->get('amount'), 'Bank Transfer');
            toastr()->success('Meter Bill Payed successfully!');
            return redirect('my-wallet');
        }

        if($request->get('payment_method') == 'paypal'){
            $info = [   
            'user_id'=>Auth::user()->id,
            'amount'=>$request->get('amount'),
            'reading_id'=>$request->get('reading_id'),
            ];
            $request->session()->put('billinfo', $info);

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();
            $item_1->setName('Item 1') ->setCurrency(helper::currencyType()) ->setQuantity(1) ->setPrice($request->get('amount')); 

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency(helper::currencyType()) ->setTotal($request->get('amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('paypal.return.meterbill')) ->setCancelUrl(URL::route('my.wallet'));

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
                    return redirect('/my-wallet');
                } else {
                    toastr()->error('Some error occur, sorry for inconvenient');
                    \Session::put('error','Some error occur, sorry for inconvenient');
                    return redirect('/my-wallet');
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
            return redirect('/my-wallet');
        }
           
    }

    public function bankPayRent(Request $request){
        if($request->get('payment_method') == 'bank'){
            $transaction = new Transactions();
            $transaction->related_to = 'rent';
            $transaction->tenant_id = Auth::user()->id;
            $transaction->amount = $request->get('amount');
            $transaction->payment_by = 'Bank Transfer';
            $transaction->save();

            $rentDetail = UnitsRent::find($request->get('rent_id'));
            $rentDetail->rent_status = 'hold';
            $rentDetail->save();
            $this->sendRentMail($rentDetail->unit_id, $request->get('amount'), 'Bank Transfer');
            toastr()->success('Unit Rent Payed successfully!');
            return redirect('my-wallet');
        }

        if($request->get('payment_method') == 'paypal'){
            $info = [   
            'user_id'=>Auth::user()->id,
            'amount'=>$request->get('amount'),
            'rent_id'=>$request->get('rent_id'),
            ];
            $request->session()->put('billinfo', $info);

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();
            $item_1->setName('Item 1') ->setCurrency(helper::currencyType()) ->setQuantity(1) ->setPrice($request->get('amount')); 

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency(helper::currencyType()) ->setTotal($request->get('amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('paypal.return.unitrent')) ->setCancelUrl(URL::route('my.wallet'));

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
                    return redirect('/my-wallet');
                } else {
                    toastr()->error('Some error occur, sorry for inconvenient');
                    \Session::put('error','Some error occur, sorry for inconvenient');
                    return redirect('/my-wallet');
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
            return redirect('/my-wallet');
        }
           
    }

    public function paypalMeterbillReturn(Request $request){
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            toastr()->error('Payment failed');
            return redirect('/my-wallet');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 
            $billinfo = $request->session()->get('billinfo');
            $transaction = new Transactions();
            $transaction->related_to = 'meter bill';
            $transaction->tenant_id = Auth::user()->id;
            $transaction->amount = $billinfo['amount'];
            $transaction->payment_by = 'Paypal';
            $transaction->paypal_status = 'paid';
            $transaction->paypal_id = $request->paymentId;
            $transaction->paypal_PayerID = $request->PayerID;
            $transaction->save();

            $readingDetail = MeterReadings::find($billinfo['reading_id']);
            $readingDetail->status = 'paid';
            $readingDetail->save();
            $this->sendBillMail($readingDetail->unit_id, $billinfo['amount'], 'Paypal');
            toastr()->success('Meter Bill Payed successfully!');
            return redirect('my-wallet');
        }
        \Session::put('error','Payment failed');
        toastr()->error('Payment failed');
        return redirect('/my-wallet');
    }

    public function paypalUnitrentReturn(Request $request){
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            toastr()->error('Payment failed');
            return redirect('/my-wallet');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 
            $billinfo = $request->session()->get('billinfo');
            $transaction = new Transactions();
            $transaction->related_to = 'rent';
            $transaction->tenant_id = Auth::user()->id;
            $transaction->amount = $billinfo['amount'];
            $transaction->payment_by = 'Paypal';
            $transaction->paypal_status = 'paid';
            $transaction->paypal_id = $request->paymentId;
            $transaction->paypal_PayerID = $request->PayerID;
            $transaction->save();

            $rentDetail = UnitsRent::find($billinfo['rent_id']);
            $rentDetail->rent_status = 'paid';
            $rentDetail->save();
            $this->sendRentMail($rentDetail->unit_id, $billinfo['amount'], 'Paypal');

            toastr()->success('Unit Rent Payed successfully!');
            return redirect('my-wallet');
        }
        \Session::put('error','Payment failed');
        toastr()->error('Payment failed');
        return redirect('/my-wallet');
    }

    public function sendBillMail($unitId, $amount, $paymentMethod){
        $unit = PropertiesUnit::find($unitId);
        $emailData = array(
            'tenant_name'   => Auth::user()->name." ".Auth::user()->last_name,
            "email"         => Auth::user()->email,
            "unit_name"     => $unit->unit_name,
            "payment_method"   => $paymentMethod,
            "price"         => $amount,
        );
        $tenantEmail = Auth::user()->email;
        $poUser = User::find($unit->user_id);
        $poEmail = $poUser->email;
        Mail::send('emails.tenant_unit_meter_bill', $emailData, function($message) use ($tenantEmail, $poEmail) {
            $message->to($tenantEmail, $poEmail)
                    ->subject('Unit Bill Confirmation');
            $message->from('amitpunjvision@gmail.com','Reasy Property');
        });
    }

    public function sendRentMail($unitId, $amount, $paymentMethod){
        $unit = PropertiesUnit::find($unitId);
        $emailData = array(
            'tenant_name'   => Auth::user()->name." ".Auth::user()->last_name,
            "email"         => Auth::user()->email,
            "unit_name"     => $unit->unit_name,
            "payment_method"   => $paymentMethod,
            "price"         => $amount,
        );
        $tenantEmail = Auth::user()->email;
        $poUser = User::find($unit->user_id);
        $poEmail = $poUser->email;
        Mail::send('emails.tenant_unit_rent', $emailData, function($message) use ($tenantEmail, $poEmail) {
            $message->to($tenantEmail, $poEmail)
                    ->subject('Unit Rent Confirmation');
            $message->from('amitpunjvision@gmail.com','Reasy Property');
        });
    }


    public function billConfirmed($id){
        $reading  = MeterReadings::find($id);
        $reading->status = 'paid';
        $reading->save();
        toastr()->success('Updated successfully!');
        return redirect()->back();
    }

    public function rentConfirmed($id){
        $rent  = UnitsRent::find($id);
        $rent->rent_status = 'paid';
        $rent->save();
        toastr()->success('Updated successfully!');
        return redirect()->back();
    }
}
