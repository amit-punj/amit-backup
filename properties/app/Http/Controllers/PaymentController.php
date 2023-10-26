<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use App\Subscription;
use App\Transactions;
use Auth;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function index()
    {
        $packages = Subscription::get();
        return view('paypal/package')->with(compact('packages'));
    }
    public function payWithpaypal(Request $request)
    {
        $postData = $request->all();
       
        $user_id = Auth::user()->id;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($postData['item_name']) /** item name **/
            ->setCurrency($postData['currency_code'])
            ->setQuantity(1)
            ->setPrice($postData['amount']); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

        $payment_response = $payment->create($this->_api_context);
            echo "<pre>";
            print_r($payment_response);
            die('test');

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/membership');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/membership');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/membership');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('/membership');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');
            return Redirect::to('/membership');

        }

        \Session::put('error', 'Payment failed');
        return Redirect::to('/membership');

    }


    public function payment_details(Request $request, $package_id)
    {
        $postData = $request->all();
        $packages = Subscription::where('id','=',$package_id)->first();
        return view('paypal/package_details')->with(compact('packages'));
    }

    public function package_update(Request $request)
    {
        $postData = $request->all();
        $update_data = array(
            'user_id'           => $postData['user_id'], 
            'package_id'        => $postData['data_pid'], 
            'package_amount'    => $postData['amount'], 
            'package_name'      => $postData['name']
            );
        $package = Transactions::create($update_data);

        return response()->json(['status' => 'success', 'package_id' =>$package['id']]);
    }

}
