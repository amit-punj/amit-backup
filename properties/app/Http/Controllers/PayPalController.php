<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Transactions;
use App\IPNStatus;
use App\Item;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Subscription;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class PayPalController extends Controller
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
        $user_id = "";
        if(isset(Auth::user()->id )){
            $user_id = Auth::user()->id;
        }
    }
    
    public function signuppre(Request $request)
    {
      return view('signuppre');
    }
    public function getIndex(Request $request)
    {
        $response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }

        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }
        $packages = Subscription::get();
        return view('paypal/package', compact('packages','response'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getExpressCheckout(Request $request)
    {
        $postData = $request->all();
        $package_id = ($request->get('p_id')) ? $request->get('p_id') : '';
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $cart = $this->getCheckoutData($recurring,$package_id);
        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');

            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }
    }

    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $package_id = ($request->get('p_id')) ? $request->get('p_id') : '';
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
              
        $cart = $this->getCheckoutData($recurring, $package_id);
        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {
                $user_id = "";
                if(isset(Auth::user()->id )){
                    $user_id = Auth::user()->id;
                }
                $Trasactions = Invoice::where(['user_id' => $user_id])->first();
                $startdate = Carbon::now()->toAtomString();
                if(!empty($Trasactions)  && $Trasactions != "")
                {
                    // $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                    // $transaction_id= $payment_status['PAYMENTINFO_0_TRANSACTIONID'];
                    // $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

                    // $response = $this->provider->createMonthlySubscription($response['TOKEN'], $cart['total'], $cart['subscription_desc']);
                   
                    $data = [
                      'PROFILESTARTDATE' => $startdate,
                      'DESC' => $cart['subscription_desc'],
                      'BILLINGPERIOD' => 'Month', // Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
                      'BILLINGFREQUENCY' => $cart['items'][0]['month_duration'], // 
                      'AMT' => $cart['total'], // Billing amount for each billing cycle
                      'CURRENCYCODE' => 'USD', // Currency code 
                    ];
                  // echo "<pre>";
                  // print_r($data);
                  // die('fffff');
                    $response = $this->provider->createRecurringPaymentsProfile($data, $token);
                    $subscription_id= $response['PROFILEID'];
                    $transaction_id= "";
                    if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                        $status = 'Processed';
                    } else {
                        $status = 'Invalid';
                    }
                }
                else
                {
                  $data = [
                    'PROFILESTARTDATE' => $startdate,
                    'DESC' => $cart['subscription_desc'],
                    'BILLINGPERIOD' => 'Month', // Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
                    'BILLINGFREQUENCY' => $cart['items'][0]['month_duration'], // 
                    'AMT' => $cart['total'], // Billing amount for each billing cycle
                    'CURRENCYCODE' => 'USD', // Currency code 
                    'TRIALBILLINGPERIOD' => 'Day',  // (Optional) Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
                    'TRIALBILLINGFREQUENCY' => 1, // (Optional) set 12 for monthly, 52 for yearly 
                    'TRIALTOTALBILLINGCYCLES' => 5, // (Optional) Change it accordingly
                    'TRIALAMT' => 0, // (Optional) Change it accordingly
                  ];
                  $response = $this->provider->createRecurringPaymentsProfile($data, $token);
                  $subscription_id= $response['PROFILEID'];
                  $transaction_id= "";

                  if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                      $status = 'Processed';
                  } else {
                      $status = 'Invalid';
                  }
                }
                // $response = $this->provider->createMonthlySubscription($response['TOKEN'], $cart['total'], $cart['subscription_desc']);               
            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                
                $subscription_id= "";
                $transaction_id= $payment_status['PAYMENTINFO_0_TRANSACTIONID'];
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            }

            $invoice = $this->createInvoice($cart, $status, $subscription_id, $transaction_id );

            if ($invoice->paid) {
                $user_id = "";
                if(isset(Auth::user()->id )){
                    $user_id = Auth::user()->id;
                }
                $user= User::where('id', $user_id)->update(['role' => '3']);
                $data = User::where('id', $user_id)->first();
                    Auth::attempt(['email' => $data->email, 'password' => $data->password,'role' => '3']);
                    return redirect('/agent_membership/renew');
                // session()->put(['code' => 'success', 'message' => "Order $invoice->id has been paid successfully!"]);
            } else {
                session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
            }

            return redirect('/membership');
        }
    }

    public function getAdaptivePay()
    {
        $this->provider = new AdaptivePayments();

        $data = [
            'receivers'  => [
                [
                    'email'   => 'johndoe@example.com',
                    'amount'  => 10,
                    'primary' => true,
                ],
                [
                    'email'   => 'janedoe@example.com',
                    'amount'  => 5,
                    'primary' => false,
                ],
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        dd($response);
    }

    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }

        $post = [
            'cmd' => '_notify-validate',
        ];
        $data = $request->all();
        foreach ($data as $key => $value) {
            $post[$key] = $value;
        }

        $response = (string) $this->provider->verifyIPN($post);

        $ipn = new IPNStatus();
        $ipn->payload = json_encode($post);
        $ipn->status = $response;
        $ipn->save();
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData($recurring = false, $package_id )
    {
        $data = [];

        $order_id = Invoice::all()->count() + 1;

        $packages = Subscription::where('id','=',$package_id)->first();
        if ($recurring === true) {
            $data['items'] = [
                [
                    'package_id' => $packages->id,
                    'name'  => $packages->name.' #'.$order_id,
                    'price' => $packages->price,
                    'month_duration' => $packages->duration,
                    'day_duration' => $packages->agent,
                    'month_price' => $packages->month_price,
                    'qty'   => 1,
                ],
            ];

            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring&p_id='.$package_id);
            $data['subscription_desc'] = $packages->description.' #'.$order_id;
        } else {
            $data['items'] = [
                [
                    'package_id' => $packages->id,
                    'name'  => $packages->name.' #'.$order_id,
                    'price' => $packages->price,
                    'month_duration' => $packages->duration,
                    'day_duration' => $packages->agent,
                    'month_price' => $packages->month_price,
                    'qty'   => 1,
                ]
               
            ];

            $data['return_url'] = url('/paypal/ec-checkout-success?p_id='.$package_id);
        }
        

        $data['invoice_id'] = config('paypal.invoice_prefix').'_'.$order_id;
        $data['invoice_description'] = "Invoice Order #$order_id";
        $data['cancel_url'] = url('/membership');

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;

        return $data;
    }

    /**
     * Create invoice.
     *
     * @param array  $cart
     * @param string $status
     *
     * @return \App\Invoice
     */
    protected function createInvoice($cart, $status, $subscription_id, $transaction_id)
    {
        $user_id = "";
        if(isset(Auth::user()->id )){
            $user_id = Auth::user()->id;
        }
        $duration = $cart['items'][0]['month_duration'];
        $currentDateTime = date('Y-m-d H:i:s');
        $next_update = date('Y-m-d H:i:s', strtotime('+'.$duration.' months'));
        $update_sts = Invoice::where('user_id', $user_id)
          ->update(['status' => 0]);
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->package_id = $cart['items'][0]['package_id'];
        $invoice->package_name = $cart['items'][0]['name'];
        $invoice->price = $cart['total'];
        $invoice->last_payment = $currentDateTime;
        $invoice->next_payment = $next_update;
        $invoice->subscription_id = $subscription_id;
        $invoice->transaction_id  = $transaction_id;
        $invoice->user_id  = $user_id;
        $invoice->status  = 1;

        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->paid = 1;
        } else {
            $invoice->paid = 0;
        }
        $invoice->save();
        // die('ddd');

        // collect($cart['items'])->each(function ($product) use ($invoice) {
        //     $item = new Item();
        //     $item->invoice_id = $invoice->id;
        //     $item->item_name = $product['name'];
        //     $item->item_price = $product['price'];
        //     $item->item_qty = $product['qty'];

        //     $item->save();
        // });

        return $invoice;
    }
    public function paypal_webhooks(Request $request)
    {
        $postData = '{
                  "id": "WH-77687562XN25889J8-8Y6T55435R66168T6",
                  "create_time": "2018-19-12T22:20:32.000Z",
                  "resource_type": "subscription",
                  "event_type": "BILLING.SUBSCRIPTION.RENEWED",
                  "summary": "A billing agreement was renewed.",
                  "resource": {
                    "quantity": "20",
                    "subscriber": {
                      "name": {
                        "given_name": "John",
                        "surname": "Doe"
                      },
                      "email_address": "customer@example.com",
                      "shipping_address": {
                        "name": {
                          "full_name": "John Doe"
                        },
                        "address": {
                          "address_line_1": "2211 N First Street",
                          "address_line_2": "Building 17",
                          "admin_area_2": "San Jose",
                          "admin_area_1": "CA",
                          "postal_code": "95131",
                          "country_code": "US"
                        }
                      }
                    },
                    "create_time": "2018-12-10T21:20:49Z",
                    "shipping_amount": {
                      "currency_code": "USD",
                      "value": "10.00"
                    },
                    "start_time": "2018-11-01T00:00:00Z",
                    "update_time": "2018-12-10T21:20:49Z",
                    "billing_info": {
                      "outstanding_balance": {
                        "currency_code": "USD",
                        "value": "10.00"
                      },
                      "cycle_executions": [
                        {
                          "tenure_type": "TRIAL",
                          "sequence": 1,
                          "cycles_completed": 1,
                          "cycles_remaining": 0,
                          "current_pricing_scheme_version": 1
                        },
                        {
                          "tenure_type": "REGULAR",
                          "sequence": 2,
                          "cycles_completed": 1,
                          "cycles_remaining": 0,
                          "current_pricing_scheme_version": 2
                        }
                      ],
                      "last_payment": {
                        "amount": {
                          "currency_code": "USD",
                          "value": "500.00"
                        },
                        "time": "2018-12-01T01:20:49Z"
                      },
                      "next_billing_time": "2019-01-01T00:20:49Z",
                      "final_payment_time": "2020-01-01T00:20:49Z",
                      "failed_payments_count": 2
                    },
                    "links": [
                      {
                        "href": "https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G",
                        "rel": "self",
                        "method": "GET"
                      },
                      {
                        "href": "https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G",
                        "rel": "edit",
                        "method": "PATCH"
                      },
                      {
                        "href": "https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G/suspend",
                        "rel": "suspend",
                        "method": "POST"
                      },
                      {
                        "href": "https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G/cancel",
                        "rel": "cancel",
                        "method": "POST"
                      },
                      {
                        "href": "https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G/capture",
                        "rel": "capture",
                        "method": "POST"
                      }
                    ],
                    "id": "I-BW452GLLEP1G",
                    "plan_id": "P-5ML4271244454362WXNWU5NQ",
                    "auto_renewal": true,
                    "status": "ACTIVE",
                    "status_update_time": "2018-12-10T21:20:49Z"
                  },
                  "links": [
                    {
                      "href": "https://api.paypal.com/v1/notifications/webhooks-events/WH-77687562XN25889J8-8Y6T55435R66168T6",
                      "rel": "self",
                      "method": "GET",
                      "encType": "application/json"
                    },
                    {
                      "href": "https://api.paypal.com/v1/notifications/webhooks-events/WH-77687562XN25889J8-8Y6T55435R66168T6/resend",
                      "rel": "resend",
                      "method": "POST",
                      "encType": "application/json"
                    }
                  ],
                  "event_version": "1.0",
                  "resource_version": "2.0"
        }';
        $subscription_id = 'I-EL0JB7NTB2GA';
        $invoice = Invoice::where('subscription_id',$subscription_id)->first();
        $data = array();
        $array = (array) json_decode($postData);
        $data = array(
            'invoice_id'      => $invoice->id,
            'subscription_id' => $array['resource']->id,
            'plan_id'         => $array['resource']->plan_id,
            'renew_time'      => $array['resource']->create_time,
            'amount'          => $array['resource']->billing_info->outstanding_balance->value,
            'next_payment'    => $array['resource']->billing_info->next_billing_time,
            'failed'          => $array['resource']->billing_info->failed_payments_count,
        );
        $transaction = Transactions::create($data); 
        echo $transaction;
        die('end');
    }

}
