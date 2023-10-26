<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use URL;
use Session;
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
use App\Rating;
use App\Documents;
use App\Vendors;
Use Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Terminate;
use App\UserBankAccount;
use App\appointments;
use App\Guarantor;
use App\Sub_Tenant;
use App\Refund;
use Excel;

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
class ContractController extends Controller
{ 
    const Tenant = 1;
    const Property_Manager = 3;
    const Property_Description_Experts = 4;
    const Legal_Advisor = 5;
    const Visit_Organizer = 6;
    private $_api_context;
    public function __construct() {
        $this->middleware('auth');
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function terminate_contract(Request $request, $id)
    {
        $tenant_id = Auth::user()->id;
        $user = Auth::user();
        $contract = Booking::find($id);
        $terminate = Terminate::where(['booking_id' => $id, 'tenant_id' => $tenant_id])->first();
        $document = Documents::where(['contract_id' => $id, 'related_to' =>'ExitPDReport', 'uploaded_by' => $contract->pde_id])->first();
        $account_info = UserBankAccount::where(['user_id'=>$tenant_id,'user_type'=>$user->user_role])->first();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            if($postData['step'] == 1)
            {
                $rules = array(
                    'notice'         => 'required',
                );
                $message = array(
                    'notice.required'          => 'Please select notice type',
                );
                $validator = Validator::make($postData, $rules, $message);
                if ($validator->fails())
                {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    )); // 400 being the HTTP code for an invalid request.
                }
                else
                {
                    $where_data = array('booking_id' => $id, 'tenant_id' => $tenant_id);
                    $terminate_data = array(
                        'unit_id'    => $contract->unit_id,
                        'step'       => '1',
                        'booking_id' => $id,
                        'tenant_id'  => $contract->tenant_id,
                        'pde_id'     => $contract->pde_id,
                        'po_id'      => $contract->po_id,
                        'pm_id'      => $contract->pm_id,
                        'notice'     => $postData['notice'],
                        'status'     => '0',
                    );
                    if($postData['notice'] == 'Yes')
                    {
                        $current_time = strtotime(date("Y/m/d"));
                        $next_day = date("Y/m/d", strtotime("+90 days", $current_time));
                        $terminate_data['notice_period_date'] = Helper::Date($next_day);
                    }
                    else
                    {
                        $terminate_data['notice_period_date'] = 'Null';
                    }
                    $terminate = Terminate::updateOrCreate($where_data, $terminate_data);
                    $terminate_id = $terminate->id;
                    $booking_data = array(
                        'status' => '8',
                        'terminate_id' => $terminate_id,
                    );
                    $booking = Booking::where(['id' => $id])->update($booking_data);
                    return Response()->json(array(
                        'success' => true,
                        'terminate' => $terminate,
                        'terminate_id' => $terminate_id,
                        'tenant_id'  => $tenant_id,
                        'notice'     => $postData['notice'],
                        'contract_id'     => $id,
                        'notice_period_date'  => $terminate->notice_period_date,

                    ));
                }
            }
            if($postData['step'] == 2)
            {
                $rules = array(
                    'title' => 'required',
                    'time'  => 'required',
                );
                $message = array(
                    'title.required' => 'Please enter title',
                    'time.required'  => 'Please enter time',
                );
                $validator = Validator::make($postData, $rules, $message);
                if ($validator->fails())
                {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    )); // 400 being the HTTP code for an invalid request.
                }
                else
                {
                    $appointment_data = array(
                        'time' =>   Helper::DateTime($postData['time']),
                        'tenant_id'    =>   $tenant_id,
                        'pde_id'       =>   $contract->pde_id,
                        'created_by'       =>   $tenant_id,
                        'assigned_to'      =>   $contract->pde_id,
                        'appointment_type'     =>   'Exit',
                        'contract_id'      =>   $id,
                        'unit_id'  =>   $contract->unit_id,
                        'terminate_id' =>   $postData['terminate_id'],
                        'title'    =>   $postData['title'],
                        'description'  =>   $postData['description'],
                        'appointment_status'  =>   0,
                    );
                    // $appointments = new appointments;
                    // $appointments->time = Helper::DateTime($postData['time']);
                    // $appointments->tenant_id = $tenant_id;
                    // $appointments->pde_id     = $contract->pde_id;
                    // $appointments->created_by     = $tenant_id;
                    // $appointments->assigned_to     = $contract->pde_id;
                    // $appointments->appointment_type     = 'Exit';
                    // $appointments->contract_id      = $id;
                    // $appointments->unit_id = $contract->unit_id;
                    // $appointments->terminate_id = $postData['terminate_id'];
                    // $appointments->title = $postData['title'];
                    // $appointments->description = $postData['description'];
                    // $appointments->save();

                    $appointments = appointments::updateOrCreate(['terminate_id' => $postData['terminate_id']], $appointment_data);

                    $tenent_name = $user->name;
                    $tenent_email = trim($user->email);
                    $tenent_data = array(
                        'name'          => $user->name,
                        "email"         => $user->email,
                        "time"          => Helper::DateTime($postData['time']),
                        "title"         => $postData['title'],
                        "description"   => $postData['description'],
                    );
                        
                    Mail::send('emails.entry_appointment_to_tenant', $tenent_data, function($message) use ($tenent_name, $tenent_email) {
                        $message->to('amitpunjvision@gmail.com', $tenent_name)
                                ->subject('Exit Appointment');
                        $message->from('amitpunjvision@gmail.com','Reasy Property');
                    });

                    $where_data = array('id' => $postData['terminate_id'] );
                    $terminate_data = array(
                        'step'       => '2',
                        'status'     => '1',
                        'appointment_time' => Helper::DateTime($postData['time']),
                        'appointment_id'   => $appointments->id,
                    );
                    
                    $terminate = Terminate::where($where_data)->update($terminate_data);
                    return Response()->json(array(
                        'success' => true,
                        'terminate_id' => $postData['terminate_id'],
                        'tenant_id'  => $tenant_id,
                        'contract_id'     => $id,
                        'appointment_id'   => $appointments->id,
                    ));
                }
            }
            if($postData['step'] == 3)
            {
                $rules = array(
                    'receipt'=> 'required|mimes:jpeg,png,jpg,docx,doc,pdf|max:2048',
                );
                $message = array(
                    'receipt.required' => 'Please upload receipt',
                    'receipt.mimes'    => 'The receipt must be a file of type: jpeg, png, jpg, docx, doc, pdf.',
                    'receipt.max'      => 'The receipt may not be greater than 2MB',
                );
                $validator = Validator::make($postData, $rules, $message);
                if ($validator->fails())
                {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                    )); // 400 being the HTTP code for an invalid request.
                }
                else
                {

                    if ($request->hasFile('receipt')) {
                        $image = $request->file('receipt');
                        $receipt_name = 'Tdocument'.time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('document');
                        $image->move($destinationPath, $receipt_name);
                    }

                    $Documents = new Documents();
                    $Documents->unit_id = $contract->unit_id;
                    $Documents->contract_id = $id;
                    $Documents->user_type = '1';
                    $Documents->uploaded_by = $tenant_id;
                    $Documents->related_to = 'TenantExitPDReport';
                    $Documents->doc_name   = $receipt_name;
                    $Documents->save();
                    $Document_id = $Documents->id;

                    $where_data = array('id' => $postData['terminate_id'] );
                    $terminate_data = array(
                        'step'       => '3',
                    );
                    $deposit = $contract->deposit_amount;
                    $dues_amount = ($contract->rent * 3) + $contract->damage + $contract->dues;
                    if($deposit <= 0 && $dues_amount <= 0)
                    {
                        $terminate_data['StatusForPMPO'] = 1;
                    }
                    
                    $terminate = Terminate::where($where_data)->update($terminate_data);
                    $terminate = Terminate::find($postData['terminate_id']);
                    return Response()->json(array(
                        'success' => true,
                        'terminate_id' => $postData['terminate_id'],
                        'tenant_id'  => $tenant_id,
                        'contract_id'     => $id,
                        'status'     => $terminate->status,
                    ));
                }
            }
            if($postData['step'] == 4)
            {
                $where_data = array('id' => $postData['terminate_id'] );
                if($postData['pay_dues'] == 'adjust')
                {
                    // echo $tenant_id;
                    // Helper::pr($postData);
                    // die('amitg');
                    $amount = $postData['dues_amount'];
                    $transaction = new Transactions();
                    $transaction->related_to = 'PayDues';
                    $transaction->tenant_id = $tenant_id;
                    $transaction->amount = $amount;
                    $transaction->payment_by = 'Wallet';
                    $transaction->booking_id = $id;
                    $transaction->terminate_id = $terminate->id;
                    $transaction->save();
                    $transaction_id = $transaction->id;

                    // $user = User::find($tenant_id);
                    // $user->wallet_amount -= $postData['dues_amount'];
                    // $user->save();

                    $unit = PropertiesUnit::find($contract->unit_id);
                    $unit->deposit -= $postData['dues_amount'];
                    $unit->save();

                    $terminate_data = array(
                        'step'       => '4',
                        'pay_dues'   => $postData['pay_dues'],
                        'status'     => '7',
                        'transaction_id'   => $transaction->id,
                        'payment_method'   => '',
                    );
                    $deposit = $unit->deposit;
                    if($deposit <= 0 )
                    {
                        $terminate_data['StatusForPMPO'] = 1;
                    }

                    $terminate = Terminate::where($where_data)->update($terminate_data);


                    return Response()->json(array(
                        'success' => true,
                        'terminate_id' => $postData['terminate_id'],
                        'tenant_id'  => $tenant_id,
                        'contract_id'     => $id,
                        'wallet_amount'     => $user->wallet_amount,
                    ));
                    
                }
                else if($postData['pay_dues'] == 'payment')
                {
                    // echo $tenant_id;
                    // Helper::pr($postData);
                    // die('fffff');
                    if ($request->hasFile('receipt')) {
                        $image = $request->file('receipt');
                        $receipt_name = 'receipt'.time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('images/bank_receipt');
                        $image->move($destinationPath, $receipt_name);
                    }

                    $amount = ($contract->unit->rent * 3) + $contract->damage + $contract->dues;
                    $transaction = new Transactions();
                    $transaction->related_to = 'PayDues';
                    $transaction->tenant_id = $tenant_id;
                    $transaction->bank_receipt = $receipt_name;
                    $transaction->amount = $amount;
                    $transaction->payment_by = 'Bank Transfer';
                    $transaction->booking_id = $id;
                    $transaction->terminate_id = $terminate->id;
                    $transaction->save();
                    $transaction_id = $transaction->id;

                    // $user = User::find($tenant_id);
                    // $user->wallet_amount -= $postData['dues_amount'];
                    // $user->save();

                    $unit = PropertiesUnit::find($contract->unit_id);
                    $unit->deposit -= $postData['dues_amount'];
                    $unit->save();

                    $terminate_data = array(
                        'step'       => '4',
                        'pay_dues'   => $postData['pay_dues'],
                        'payment_method'   => 'bank',
                        'payment_status'   => 'paid',
                        'transaction_id'   => $transaction->id,
                        'status'     => '7',
                    );
                    $deposit = $unit->deposit;
                    if($deposit <= 0 )
                    {
                        $terminate_data['StatusForPMPO'] = 1;
                    }
                    $terminate = Terminate::where($where_data)->update($terminate_data);

                    return Response()->json(array(
                        'success' => true,
                        'terminate_id' => $postData['terminate_id'],
                        'tenant_id'  => $tenant_id,
                        'contract_id'     => $id,
                        'wallet_amount'     => $user->wallet_amount,
                    ));
                    
                }
                
                return Response()->json(array(
                    'success' => true,
                    'terminate_id' => $postData['terminate_id'],
                    'tenant_id'  => $tenant_id,
                    'contract_id'     => $id,
                ));
            }
            if($postData['step'] == 5)
            {
                $where_data = array('id' => $postData['terminate_id'] );
                if($postData['refund'] == 'bank')
                {
                    $rules = array(
                        'refund'            => 'required',
                        'bank_name'         => 'required',
                        'ada_number'        => 'required',
                        'account_number'    => 'required',
                        'routing_number'    =>'required',
                    );
                    $message = array(
                        'refund.required'          => "Please select method to get refund",
                        'notice.required'          => 'Please select notice type',
                        'bank_name.required'         => 'Please enter bank name',
                        'ada_number.required'        => 'Please enter ADA number',
                        'account_number.required'    => 'Please enter account number',
                        'routing_number.required'    =>'Please enter routing number',
                    );
                    $validator = Validator::make($postData, $rules, $message);
                    if ($validator->fails())
                    {
                        return Response()->json(array(
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray(),
                        )); // 400 being the HTTP code for an invalid request.
                    }
                    else
                    {
                        $bank_where_data=array('user_id'=>$tenant_id,'user_type'=>$user->user_role);
                        $bank_data = array(
                            'user_id'           =>  $tenant_id,
                            'user_type'         =>  $user->user_role,
                            'bank_name'         =>  $postData['bank_name'],
                            'ada_number'        =>  $postData['ada_number'],
                            'account_number'    =>  $postData['account_number'],
                            'routing_number'    =>  $postData['routing_number'],
                            'booking_id'        =>  $id,
                            'terminate_id'      =>  $postData['terminate_id'],
                            // 'paypal_email'      =>  '',
                        );

                        $bank = UserBankAccount::updateOrCreate($bank_where_data, $bank_data);
                        
                        $terminate_data = array(
                            'step'       => '5',
                            'status'     => '8',
                            'claim_method'   => $postData['refund'],
                            'refund_status'   => 'pending',
                            'StatusForPMPO'   => '1',
                        );
                        $terminate = Terminate::where($where_data)->update($terminate_data);

                        return Response()->json(array(
                            'success' => true,
                            'terminate_id' => $postData['terminate_id'],
                            'tenant_id'  => $tenant_id,
                            'contract_id'     => $id,
                        ));
                    }
                }
                else if($postData['refund'] == 'paypal')
                {
                    $rules = array(
                        'refund'            => 'required',
                        'paypal_email'      => 'required|email',
                    );
                    $message = array(
                        'refund.required'          => "Please select method to get refund",
                        'paypal_email.required'     => 'Please enter paypal email',
                        'paypal_email.email'        => 'Please enter a valid email'
                        
                    );
                    $validator = Validator::make($postData, $rules, $message);
                    if ($validator->fails())
                    {
                        return Response()->json(array(
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray(),
                        )); // 400 being the HTTP code for an invalid request.
                    }
                    else
                    {
                        $bank_where_data=array('user_id'=>$tenant_id,'user_type'=>$user->user_role);
                        $bank_data = array(
                            'user_id'           =>  $tenant_id,
                            'user_type'         =>  $user->user_role,
                            'paypal_email'      =>  $postData['paypal_email'],
                            'booking_id'        =>  $id,
                            'terminate_id'      =>  $postData['terminate_id'],
                            // 'bank_name'         =>  '',
                            // 'ada_number'        =>  '',
                            // 'account_number'    =>  '',
                            // 'routing_number'    =>  ''
                        );

                        $bank = UserBankAccount::updateOrCreate($bank_where_data, $bank_data);
                        
                        $terminate_data = array(
                            'step'       => '5',
                            'status'     => '8',
                            'claim_method'   => $postData['refund'],
                            'refund_status'   => 'pending',
                            'StatusForPMPO'   => '1', 
                        );
                        $terminate = Terminate::where($where_data)->update($terminate_data);

                        return Response()->json(array(
                            'success' => true,
                            'terminate_id' => $postData['terminate_id'],
                            'tenant_id'  => $tenant_id,
                            'contract_id'     => $id,
                        ));
                    }
                }
            }
        }
        return view('tenant.terminate-contract',compact('contract','terminate','id','document','user','account_info'));
    }

    public function TerminateBT_contract(Request $request, $id)
    {
        $tenant_id = Auth::user()->id;
        $user = Auth::user();
        $contract = Booking::find($id);
        $terminate = Terminate::where(['booking_id' => $id, 'unit_id' =>$contract->unit_id, 'tenant_id' => $tenant_id])->first();
        $document = Documents::where(['contract_id' => $id, 'related_to' =>'ExitPDReport', 'uploaded_by' => $contract->pde_id])->first();
        $account_info = UserBankAccount::where(['user_id'=>$tenant_id,'user_type'=>$user->user_role])->first();
        if (empty($terminate) && $terminate == "") {
            if(strtotime(date("Y/m/d")) < strtotime($contract->start_date))
            {
                $where_data = array('id' => $id, 'tenant_id' => $tenant_id);
                $terminate = new Terminate;
                $terminate->unit_id    = $contract->unit_id;
                $terminate->step       = '3';
                $terminate->booking_id = $id;
                $terminate->tenant_id  = $contract->tenant_id;
                $terminate->pde_id     = $contract->pde_id;
                $terminate->po_id      = $contract->po_id;
                $terminate->pm_id      = $contract->pm_id;
                $terminate->notice     = 'BeforeTenancy';
                $terminate->StatusForPMPO = '0';
                $terminate->status     = '0';
                $terminate->save();

                $booking_data = array(
                    'status' => '8',
                    // 'StatusForPMPO' => '1',
                    'terminate_id' => $terminate->id,
                );
                $booking = Booking::where(['id' => $id])->update($booking_data);
                // toastr()->success('Terminate Successfully!');
                // return back();
            }
        }
        if($request->isMethod('post'))
        {
            $postData = input::all();
            if($postData['step'] == 4)
            {
                $where_data = array('id' => $postData['terminate_id'] );
                if($postData['pay_dues'] == 'adjust')
                {
                    $amount = $postData['dues_amount'];
                    $transaction = new Transactions();
                    $transaction->related_to = 'PayDues';
                    $transaction->tenant_id = $tenant_id;
                    $transaction->amount = $amount;
                    $transaction->payment_by = 'Wallet';
                    $transaction->booking_id = $id;
                    $transaction->terminate_id = $terminate->id;
                    $transaction->save();
                    $transaction_id = $transaction->id;

                    // $user = User::find($tenant_id);
                    // $user->wallet_amount -= $postData['dues_amount'];
                    // $user->save();

                    // $unit = PropertiesUnit::find($contract->unit_id);
                    $contract->deposit_amount -= $postData['dues_amount'];
                    $contract->save();

                    $terminate_data = array(
                        'step'       => '4',
                        'pay_dues'   => $postData['pay_dues'],
                        'status'     => '7',
                        'transaction_id'   => $transaction->id,
                        'payment_method'   => '',
                    );
                    $deposit = $contract->deposit_amount;
                    if($deposit <= 0 )
                    {
                        $terminate_data['StatusForPMPO'] = 1;
                    }
                    $terminate = Terminate::where($where_data)->update($terminate_data);

                    return Response()->json(array(
                        'success' => true,
                        'terminate_id' => $postData['terminate_id'],
                        'tenant_id'  => $tenant_id,
                        'contract_id'     => $id,
                        'wallet_amount'     => $contract->deposit_amount,
                    ));
                    
                }
                else if($postData['pay_dues'] == 'payment')
                {
                    if ($request->hasFile('receipt')) {
                        $image = $request->file('receipt');
                        $receipt_name = 'receipt'.time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('images/bank_receipt');
                        $image->move($destinationPath, $receipt_name);
                    }

                    $amount = ($contract->unit->rent * 3);
                    $transaction = new Transactions();
                    $transaction->related_to = 'PayDues';
                    $transaction->tenant_id = $tenant_id;
                    $transaction->bank_receipt = $receipt_name;
                    $transaction->amount = $amount;
                    $transaction->payment_by = 'Bank Transfer';
                    $transaction->booking_id = $id;
                    $transaction->terminate_id = $terminate->id;
                    $transaction->save();
                    $transaction_id = $transaction->id;

                    // $user = User::find($tenant_id);
                    // $user->wallet_amount -= $postData['dues_amount'];
                    // $user->save();

                    // $unit = PropertiesUnit::find($contract->unit_id);
                    $contract->deposit_amount -= $postData['dues_amount'];
                    $contract->save();

                    $terminate_data = array(
                        'step'       => '4',
                        'pay_dues'   => $postData['pay_dues'],
                        'payment_method'   => 'bank',
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

                    return Response()->json(array(
                        'success' => true,
                        'terminate_id' => $postData['terminate_id'],
                        'tenant_id'  => $tenant_id,
                        'contract_id'     => $id,
                        'wallet_amount'     => $contract->deposit_amount,
                    ));
                    
                }
                
                return Response()->json(array(
                    'success' => true,
                    'terminate_id' => $postData['terminate_id'],
                    'tenant_id'  => $tenant_id,
                    'contract_id'     => $id,
                ));
            }
            if($postData['step'] == 5)
            {
                $where_data = array('id' => $postData['terminate_id'] );
                if($postData['refund'] == 'bank')
                {
                    $rules = array(
                        'refund'            => 'required',
                        'bank_name'         => 'required',
                        'ada_number'        => 'required',
                        'account_number'    => 'required',
                        'routing_number'    =>'required',
                    );
                    $message = array(
                        'refund.required'          => "Please select method to get refund",
                        'notice.required'          => 'Please select notice type',
                        'bank_name.required'         => 'Please enter bank name',
                        'ada_number.required'        => 'Please enter ADA number',
                        'account_number.required'    => 'Please enter account number',
                        'routing_number.required'    =>'Please enter routing number',
                    );
                    $validator = Validator::make($postData, $rules, $message);
                    if ($validator->fails())
                    {
                        return Response()->json(array(
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray(),
                        )); // 400 being the HTTP code for an invalid request.
                    }
                    else
                    {
                        $bank_where_data=array('user_id'=>$tenant_id,'user_type'=>$user->user_role);
                        $bank_data = array(
                            'user_id'           =>  $tenant_id,
                            'user_type'         =>  $user->user_role,
                            'bank_name'         =>  $postData['bank_name'],
                            'ada_number'        =>  $postData['ada_number'],
                            'account_number'    =>  $postData['account_number'],
                            'routing_number'    =>  $postData['routing_number'],
                            'booking_id'        =>  $id,
                            'terminate_id'      =>  $postData['terminate_id'],
                            // 'paypal_email'      =>  '',
                        );

                        $bank = UserBankAccount::updateOrCreate($bank_where_data, $bank_data);
                        
                        $terminate_data = array(
                            'step'       => '5',
                            'status'     => '8',
                            'claim_method'   => $postData['refund'],
                            'refund_status'   => 'pending',
                            'StatusForPMPO'   => '1',
                        );
                        $terminate = Terminate::where($where_data)->update($terminate_data);

                        return Response()->json(array(
                            'success' => true,
                            'terminate_id' => $postData['terminate_id'],
                            'tenant_id'  => $tenant_id,
                            'contract_id'     => $id,
                        ));
                    }
                }
                else if($postData['refund'] == 'paypal')
                {
                    $rules = array(
                        'refund'            => 'required',
                        'paypal_email'      => 'required|email',
                    );
                    $message = array(
                        'refund.required'          => "Please select method to get refund",
                        'paypal_email.required'     => 'Please enter paypal email',
                        'paypal_email.email'        => 'Please enter a valid email'
                        
                    );
                    $validator = Validator::make($postData, $rules, $message);
                    if ($validator->fails())
                    {
                        return Response()->json(array(
                            'success' => false,
                            'errors' => $validator->getMessageBag()->toArray(),
                        )); // 400 being the HTTP code for an invalid request.
                    }
                    else
                    {
                        $bank_where_data=array('user_id'=>$tenant_id,'user_type'=>$user->user_role);
                        $bank_data = array(
                            'user_id'           =>  $tenant_id,
                            'user_type'         =>  $user->user_role,
                            'paypal_email'      =>  $postData['paypal_email'],
                            'booking_id'        =>  $id,
                            'terminate_id'      =>  $postData['terminate_id'],
                            // 'bank_name'         =>  '',
                            // 'ada_number'        =>  '',
                            // 'account_number'    =>  '',
                            // 'routing_number'    =>  ''
                        );

                        $bank = UserBankAccount::updateOrCreate($bank_where_data, $bank_data);
                        
                        $terminate_data = array(
                            'step'       => '5',
                            'status'     => '8',
                            'claim_method'   => $postData['refund'],
                            'refund_status'   => 'pending',
                            'StatusForPMPO'   => '1', 
                        );
                        $terminate = Terminate::where($where_data)->update($terminate_data);

                        return Response()->json(array(
                            'success' => true,
                            'terminate_id' => $postData['terminate_id'],
                            'tenant_id'  => $tenant_id,
                            'contract_id'     => $id,
                        ));
                    }
                }
            }
        }
        return view('tenant.TerminateBT_contract',compact('contract','terminate','id','document','user','account_info'));
    }

    public function pay_dues(Request $request, $id)
    {
        $payment_for = 'pay_dues'; 
        $tenant_id  = Auth::user()->id;
        $user       = Auth::user();
        $contract   = Booking::find($id);
        $terminate  = Terminate::where(['booking_id' => $id, 'tenant_id' => $tenant_id])->first();
        return view('contracts.check-out',compact('contract','terminate','id','payment_for','user'));
    }
    public function give_rating(Request $request)
    {
        if($request->isMethod('post'))
        {
            $tenant_id  = Auth::user()->id;
            $user       = Auth::user();
            $postData = Input::all();
            $contract   = Booking::find($postData['booking_id']);

            $rating = new Rating;
            $rating->contract_id = $postData['booking_id'];
            $rating->unit_id     = $contract->unit_id;
            $rating->rating      = $postData['input-1'];
            $rating->given_by    = $tenant_id;
            if($user->user_role == 1)
            {
                $rating->given_to    = $contract->po_id;
            }
            else
            {
                $rating->given_to    = $contract->tenant_id;
            }
            $rating->save();
            toastr()->success('You gave rating Successfully!');
            return back();
        }
    }
    public function bank_payment(Request $request, $id)
    {
        $tenant_id = Auth::user()->id;
        $user = Auth::user();
        $contract = Booking::find($id);
        $terminate = Terminate::where(['booking_id' => $id, 'tenant_id' => $tenant_id])->first();
        $document = Documents::where(['contract_id' => $id, 'related_to' =>'ExitPDReport', 'uploaded_by' => $contract->pde_id])->first();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $where_data = array('id' => $terminate->id );
            $terminate_data = array(
                'step'       => '4',
                'pay_dues'   => $postData['pay_dues'],
                'payment_method'   => 'bank',
                'payment_status'   => 'pending',
                'status'     => '5',
            );
            $terminate_update = Terminate::where($where_data)->update($terminate_data);
        }
        toastr()->success('You choose bank transfer mode. Please upload receipt!');
        $url = ($terminate->notice == 'BeforeTenancy') ? 'TerminateBT-Contract' : 'terminate-contract' ;
        return Redirect($url.'/'.$id);
    }
    public function update_terminate_status(Request $request, $id)
    {
        // $tenant_id = Auth::user()->id;
        // $user = Auth::user();
        $contract = Booking::find($id);
        $terminate = Terminate::where(['booking_id' => $id, 'tenant_id' => $contract->tenant_id])->first();
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            // Helper::pr($postData);
            // die('ffffff');
            $where_data = array('id' => $terminate->id );
            if($postData['refund_amount'] > 0)
            {

                $unit = PropertiesUnit::find($contract->unit_id);
                // $unit->deposit -= $postData['refund_amount'];
                $unit->booking_status = 0;
                $unit->save();

                $contract->deposit_amount -= $postData['refund_amount'];
                $contract->status = '9';
                $contract->current_status = '1';
                $contract->save();

                $terminate_data = array(
                    'step'       => '5',
                    'status'     => '10',
                    'StatusForPMPO'   => '2',
                    'refund_status'   => 'paid',
                );
                $terminate = Terminate::where($where_data)->update($terminate_data);
            }
            else
            {
                $unit = PropertiesUnit::find($contract->unit_id);
                $unit->booking_status = 0;
                $unit->save();

                $contract->status = '9';
                $contract->current_status = '1';
                $contract->save();

                $terminate_data = array(
                    'step'       => '5',
                    'status'     => '10',
                    'StatusForPMPO'   => '2',
                    'refund_status'   => 'paid',
                );
                $terminate = Terminate::where($where_data)->update($terminate_data);
            }
        }
        toastr()->success('You paid refund Successfully!');
        return Redirect('contract-details/'.$id);
    }  

    public function dues_damages($id){
        $unit = PropertiesUnit::find($id);
        $property = DB::table('properties')->where('id', $unit->building_id)->first();
        $electricMeters = Meters::where('unit_id', $id)->where('meter_type', 'electric_meter')->get();
        $waterMeters = Meters::where('unit_id', $id)->where('meter_type', 'water_meter')->get();
        $gasMeters = Meters::where('unit_id', $id)->where('meter_type', 'gas_meter')->get();
        return view('meters.dues-damages')->with([
            'unit'=>$unit,
            'electricMeters'=>$electricMeters,
            'waterMeters'=>$waterMeters,
            'gasMeters'=>$gasMeters,
            'property'=>$property
        ]);
    } 
    //Create Contract View page
    public function createContractView(){
        $units = PropertiesUnit::where('user_id', \Auth::user()->id)->get();
        $tenants = DB::table('users')->where('user_role', self::Tenant)->get();
        return view('contracts.create-contract')->with([
            'units' => $units,
            'tenants' => $tenants,
        ]); 
    }

    //List of Contract for PO
    public function ContractList(){
        $unitArray = [];
        $units = PropertiesUnit::select('id')->where('user_id', \Auth::user()->id)->get();
        foreach ($units as $key => $value) {
            $unitArray[] =  $value->id; 
        }
        $bookings = DB::table('unit_booking')
            ->join('property_units', 'property_units.id', '=', 'unit_booking.unit_id')
            ->select('unit_booking.*', 'property_units.unit_name')
            ->whereIn('unit_booking.unit_id',$unitArray)
            ->orderBy('id', 'desc')
            ->paginate(5);
        //$bookings = Booking::whereIn('unit_id',$unitArray)->orderBy('start_date', 'desc')->paginate(5);
        return view('contracts.Contract-list')->with([
            'bookings' => $bookings,
        ]); 
    }

    //For Contract Detail Page
    public function contractDetails(Request $request, $id){
        $contract = Booking::find($id);
        $refunds = Refund::where(['contract_id' => $id])->get();
        $transactions = Transactions::where([ 'booking_id' => $id ])->orderBy('created_at','desc')->get();
        $tickets = Tickets::where([ 'booking_id' => $contract->id ])->orderBy('created_at','desc')->orderBy('id', 'desc')->get(); 
        $documents = Documents::where(['unit_id' =>  $contract->unit_id, 'contract_id' => $id ])->get();
        $account_info = UserBankAccount::where(['user_id'=>$contract->tenant_id,'user_type'=>1])->first();
        $terminate = Terminate::find( $contract->terminate_id );
        $unit = PropertiesUnit::find( $contract->unit_id );
        $tenant = User::find( $contract->tenant_id );
        $meterReadings = MeterReadings::where('unit_id', $contract->unit_id)->orderBy('id', 'desc')->paginate(5);
        $tenant_ids = Sub_Tenant::where('booking_id', $contract->id)->pluck('tenant_id')->toArray();
        $tenant_list = User::where('user_role','1')->whereNotIn('id',$tenant_ids)->get();
        $sub_tenants = Sub_Tenant::where('booking_id',$contract->id)->get();
        $guarantor = Guarantor::find( $contract->guarantor_id );
        $propertyManager = User::find( $contract->pm_id );
        $propertyOwner = User::find( $unit->user_id );
        $propertyLegalAdvisor = User::find( $unit->property_legal_advisor_id );
        return view('contracts.contract-details')->with([
            'contract' => $contract,
            'unit' => $unit,
            'tenant' => $tenant,
            'tenant_list' => $tenant_list,
            'propertyManager' => $propertyManager,
            'propertyOwner' => $propertyOwner,
            'propertyLegalAdvisor' => $propertyLegalAdvisor,
            'transactions' => $transactions,
            'documents' => $documents,
            'tickets' => $tickets,
            'terminate' => $terminate,
            'account_info' => $account_info,
            'guarantor' => $guarantor,
            'refunds' => $refunds,
            'sub_tenants' => $sub_tenants,
            'meterReadings' => $meterReadings,
        ]); 
    } 

    public function downloadExcel($id, $type)
    {
        $data = Transactions::select('created_at','related_to','amount','payment_by')->where([ 'booking_id' => $id ])->orderBy('created_at','desc')->get()->toArray();
        if(!empty($data) && is_array($data) )
        {
            foreach ($data as $key => $value) {
                $Transactions[] = array(
                    'Date' => Helper::Date($value['created_at']),
                    'Related to' => ucfirst($value['related_to']),
                    'Amount'     => Helper::CURRENCYSYMBAL." ".$value['amount'],
                    'Payment Method' => ucfirst($value['payment_by'])
                );
            }
        }
        return Excel::create('transactions', function($excel) use ($Transactions) {
            $excel->sheet('mySheet', function($sheet) use ($Transactions)
            {
                $sheet->fromArray($Transactions);
            });
        })->download($type);
    }

    public function Contract_cancelBy_tenant(Request $request, $id)
    {
        $contract = Booking::find($id);
        $update = Booking::where(['id'=>$id])->update(['status' => 7,'current_status'=> 1]);

        $unit = PropertiesUnit::find( $contract->unit_id );
        $unit->booking_status = 0;
        $unit->save();
        toastr()->success('Contract canceled Successfully!');
        return back();
    }

    public function raise_ticket(Request $request, $id)
    {
        if($request->isMethod('post'))
        { 
            $user = Auth::user();
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
            $tenant_details = User::find($user->id)->toArray();
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
            return Redirect('/contract-details/'.$id);
        }
    }

    public function update_ticket_status(Request $request)
    {
        $postData = Input::all();
        $update_data = array(
            'status' =>  $postData['status']
        );
        $update = Tickets::where(['id'=>$postData['id']])->update($update_data);
        echo json_encode(array('response'=>$update));
        die;
    }

    //Create contract Post function
    public function createContract(Request $request){
        $request->validate([
            //step 1
            'user_id' => ['required'],
            'Unit_id' => ['required'],
            'contract_type' => ['required'],
            'contract_communication_language' => ['required'],
            //step 2
            'tenant_id' => ['required'],
            //step 3
            'description_expert_id' => ['required'],
            //step 4
            'signature_date' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            //step 5
            'rent' => ['required'],
            'cost_provision' => ['required'],
            'fixed_charges' => ['required'],
            'property_tax' => ['required'],
            'deposit_amount' => ['required'],
            'contract_time' => ['required'],

        ]);
        // $contract = new Contracts;
        // $contract->user_id = $request->input('user_id');
        // $contract->Unit_id = $request->input('Unit_id');
        // $contract->contract_type = $request->input('contract_type');
        // $contract->contract_communication_language = $request->input('contract_communication_language');
        // $contract->tenent_id = $request->input('tenant_id');
        // $contract->description_expert_id = $request->input('description_expert_id');
        // $contract->signature_date = $request->input('signature_date');
        // $contract->starting_date = $request->input('start_date');
        // $contract->end_date = $request->input('end_date');
        // $contract->rent = $request->input('rent');
        // $contract->cost_provision = $request->input('cost_provision');
        // $contract->fixed_charges = $request->input('fixed_charges');
        // $contract->property_tax = $request->input('property_tax');
        // $contract->deposit_amount = $request->input('deposit_amount');
        // $contract->contract_time = $request->input('contract_time');
        //$contract->save();

        $total_amount = $request->input('rent') + $request->input('cost_provision') + $request->input('fixed_charges') + $request->input('property_tax') + $request->input('deposit_amount');
        $unit = PropertiesUnit::where(['id' => $request->input('Unit_id') ])->first();
        $Booking = new Booking;
        $Booking->unit_id = $request->input('Unit_id');
        $Booking->tenant_id = $request->input('tenant_id');
        $Booking->guarantor_id = $request->input('user_id');
        $Booking->pde_id = $unit->description_expert_id;
        $Booking->vo_id = $unit->property_visit_organizer_id;
        $Booking->pm_id = $unit->property_manager_id;
        $Booking->contract_type = $request->input('contract_type');
        $Booking->signature_date = $request->input('signature_date');
        $Booking->start_date = $request->input('start_date');
        $Booking->end_date = $request->input('end_date');
        $Booking->total_amount = $total_amount;
        $Booking->payment_method = $request->input('payment_method');
        $Booking->status = 'draft';
        $Booking->payment_status = 'pending';
        $Booking->contract_communication_language = $request->input('contract_communication_language');
        $Booking->rent = $request->input('rent');
        $Booking->cost_provision = $request->input('cost_provision');
        $Booking->fixed_charges = $request->input('fixed_charges');
        $Booking->property_tax = $request->input('property_tax');
        $Booking->deposit_amount = $request->input('deposit_amount');
        $Booking->contract_time = $request->input('contract_time');
        $Booking->save();

        if($request->input('payment_method') == 'paypal'){
            $bookingInfo = [  'id'=>$Booking->id ];
            $request->session()->put('bookingInfo', $bookingInfo);
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();
            $item_1->setName('Contract ID:1') ->setCurrency('USD') ->setQuantity(1) ->setPrice($total_amount); 

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD') ->setTotal($total_amount);

            $transaction = new Transaction();
            $transaction->setAmount($amount) ->setItemList($item_list) ->setDescription('Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('payment.contract.status')) ->setCancelUrl(URL::route('payment.contract.status'));

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
                    return redirect('/purchasemembership');
                } else {
                    \Session::put('error','Some error occur, sorry for inconvenient');
                    return redirect('/purchasemembership');
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
        } else {
            $unit = PropertiesUnit::find( $Booking->unit_id );
            $tenant = User::find( $Booking->tenant_id );
            $pm = User::find( $Booking->pm_id );
            $pm_name      = $pm->name." ".$pm->last_name;
            $pm_email     = $pm->email;
            $pm_data = array(
                'name'      => $tenant->name." ".$tenant->last_name,
               // "email"     => 'malkeetvisionvivante@gmail.com',
                "unit_name" => $unit->unit_name,
                "description" => $unit->description,
                "price"  => $Booking->total_amount,
                "payment_method" => $Booking->payment_method,
                "contract_status" => 'draft',
            );
            Mail::send('emails.contract_confirmation', $pm_data, function($message) use ($pm_name, $pm_email) {
                $message->to($pm_email, $pm_name)
                        ->subject('Contract Confirmation');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });
            toastr()->success('Contract Created Successfully!');
            return back();
        }
    }


    public function getPaymentStatus(Request $request){
        $payment_id = Session::get('paypal_payment_id');
        $postData = Input::all();
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            toastr()->error('Something Went Wrong!');
            return redirect('/create-contract');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 

            //Change Booking Status
            $bookingInfo = $request->session()->get('bookingInfo');
            $transactions = $result->getTransactions();
            $Booking = Booking::find($bookingInfo['id']);
            $Booking->payment_status = "paid";
            $Booking->save();

            //Add Transaction
            $transaction = new Transactions();
            $transaction->paypal_id = $postData['paymentId'];
            $transaction->paypal_PayerID = $postData['PayerID'];
            $transaction->paypal_status = 'paid';
            $transaction->contract_id = $bookingInfo['id'];
            $transaction->save();


            $unit = PropertiesUnit::find( $Booking->unit_id );
            $tenant = User::find( $Booking->tenant_id );
            $pm = User::find( $Booking->pm_id );
            //Add Transaction
            $transaction = new Transactions();
            $transaction->paypal_id = $postData['paymentId'];
            $transaction->paypal_PayerID = $postData['PayerID'];
            $transaction->paypal_status = 'paid';
            $transaction->contract_id = $bookingInfo['id'];
            $transaction->save();
            $pm_name      = $pm->name." ".$pm->last_name;
            $pm_email     = $pm->email;
            $pm_data = array(
                'name'      => $tenant->name." ".$tenant->last_name,
               // "email"     => 'malkeetvisionvivante@gmail.com',
                "unit_name" => $unit->unit_name,
                "description" => $unit->description,
                "price"  => $Booking->total_amount,
                "payment_method" => $Booking->payment_method,
                "contract_status" => 'draft',
            );
            Mail::send('emails.contract_confirmation', $pm_data, function($message) use ($pm_name, $pm_email) {
                $message->to($pm_email, $pm_name)
                        ->subject('Contract Confirmation');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });

            toastr()->success('Contract Create Successfully!');
            return redirect('/create-contract');
        } else {
            toastr()->success('Something Went Wrong!');
            return redirect('/create-contract');
        }
    }

    //Ajax email varification
    public function verifyEmail(Request $request){
        $users = User::where(['email' => $request->input('email') ])->first();
        if(!empty($users) && $users ) {
            return response()->json(['message'=>'Allready Exist!','status' => 'true']);
        } else {
            return response()->json(['message'=>'available','status' => 'false']);
        }
    }

    //Ajax Contract data
    public function contractExtertData(Request $request){
        $user = User::where(['id' => $request->expert_id ])->first();
        $unit = PropertiesUnit::where(['id' => $request->unit_id ])->first();
        return response()->json(
            ['id'=>$user->id,
            'name' => $user->name." ".$user->last_name,
            'rent' => $unit->rent,
            'deposit_amount' => $unit->deposit,
            'cost_provision' => $unit->cost_provision,
            ]);
    }

    // Create contract User
    public function contractUser(Request $request){
        $data = $request->all('data');
        parse_str($data['data'], $data);
        $users = User::where(['email' => $data['email'] ])->first();
        if(empty($users)){
            $password = rand();
            $user = new User;
            $user->name = $data['name'];
            $user->last_name = $data['last_name'];
            $user->gender = $data['gender'];
            $user->email = $data['email'];
            $user->phone_no = $data['phone_number'];
            $user->tenant_address = $data['address'];
            $user->password = Hash::make($password);
            $user->tenant_type = 'person';
            $user->user_role     = "1";
            $user->save();
            $tenant_id = $user->id;
            /************************/
            $to_name = $data['name']." ".$data['last_name'];
            $to_email = $data['email'];
            $data1 = array(
                'name'=>$data['name']." ".$data['last_name'],
                "email" => $data['email'],
                "password" => $password,
            );
                
            Mail::send('emails.welcome', $data1, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('Welcome Email from Reasy Properties');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });
            return response()->json(['status'=>'true','id' => $user->id, 'name' => ($data['name']." ".$data['last_name']) ]);
        } else {
            return response()->json(['status'=>'false']);
        }
    }

    public function AddTenant_to_contract(Request $request){
        $data = $request->all('data');
        $postData = input::all();
        parse_str($data['data'], $data);
        if(isset($data['choose_guarantor']) && $data['selected_tenant'] == '' && $data['choose_guarantor'] == 'yes')
        {
            $users = User::where(['email' => $data['email'] ])->first();
            if(empty($users)){
                $password = rand();
                $user = new User;
                $user->name = $data['name'];
                $user->last_name = $data['last_name'];
                $user->gender = $data['gender'];
                $user->email = $data['email'];
                $user->phone_no = $data['phone_number'];
                $user->tenant_address = $data['address'];
                $user->password = Hash::make($password);
                $user->tenant_type = 'person';
                $user->user_role     = "1";
                $user->save();
                $tenant_id = $user->id;
                /************************/
                $to_name = $data['name']." ".$data['last_name'];
                $to_email = $data['email'];
                $data1 = array(
                    'name'=>$data['name']." ".$data['last_name'],
                    "email" => $data['email'],
                    "password" => $password,
                );
                    
                Mail::send('emails.welcome', $data1, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                            ->subject('Welcome Email from Reasy Properties');
                    $message->from('amitpunjvision@gmail.com','Reasy Property');
                });

                // $subTenant = new Sub_Tenant;
                // $subTenant->unit_id = $data['unit_id'];
                // $subTenant->booking_id = $data['booking_id'];
                // $subTenant->tenant_id = $tenant_id;
                // $subTenant->save();
                return response()->json(['status'=>'true','id' => $user->id, 'name' => ($data['name']." ".$data['last_name']),'email' => $user->email]);
            } else {
                return response()->json(['status'=>'false']);
            }
        }
        elseif(isset($data['choose_guarantor']) && $data['selected_tenant'] != '' && $data['choose_guarantor'] == 'no')
        {
            $subTenant = new Sub_Tenant;
            $subTenant->unit_id = $data['unit_id'];
            $subTenant->booking_id = $data['booking_id'];
            $subTenant->tenant_id = $data['selected_tenant'];
            $subTenant->save();

            return response()->json(['status'=>'true','id' => $data['selected_tenant'], 'name' => '' ]);
        }
    }

    //Create contract company
    public function contractCompany(Request $request){
        $data = $request->all('data');
        parse_str($data['data'], $data);
        $users = User::where(['email' => $data['email'] ])->first();
        if(empty($users)){
            $password = rand();
            $user = new User;
            $user->company_name = $data['company_name'];
            $user->company_phone = $data['company_phone_no'];
            $user->company_email = $data['company_email'];

            $user->name = $data['name'];
            $user->last_name = $data['last_name'];
            $user->gender = $data['gender'];
            $user->email = $data['email'];
            $user->phone_no = $data['phone_number'];
            $user->tenant_address = $data['address'];
            $user->password = Hash::make($password);
            $user->tenant_type = 'company';
            $user->user_role     = "1";
            $user->save();
            $tenant_id = $user->id;
            /************************/
            $to_name = $data['name']." ".$data['last_name'];
            $to_email = $data['email'];
            $data1 = array(
                'name'=>$data['name']." ".$data['last_name'],
                "email" => $data['email'],
                "password" => $password,
            );
                
            Mail::send('emails.welcome', $data1, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('Welcome Email from Reasy Properties');
                $message->from('amitpunjvision@gmail.com','Reasy Property');
            });
            return response()->json(['status'=>'true','id' => $user->id, 'name' => ($data['name']." ".$data['last_name']) ]);
        } else {
            return response()->json(['status'=>'false']);
        }
    }

    //PO PM Ticket Listing Page
    public function ticket_list(Request $request) {
        $units = null;
        $unitIds = [];
        if(Auth::user()->user_role == 2) {
            $units = PropertiesUnit::select('id')->where('user_id',Auth::user()->id)->get();
        }
        if(Auth::user()->user_role ==3) {
            $units = PropertiesUnit::select('id')->where('property_manager_id',Auth::user()->id)->get();
        }
        //Tickets::where()->get();
        if($units){
            foreach ($units as $key => $value) {
                $unitIds[] = $value->id;
            }
        }
        $tickets = Tickets::whereIn('unit_id', array_unique($unitIds) )->paginate(5);
        return view('tickets.ticket_list')->with([
            'units' => $units,
            'tickets' => $tickets,
        ]); 
    }
}
