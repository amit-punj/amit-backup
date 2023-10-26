<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use Mail;
use App\Guarantor;
use App\User;
use App\PropertiesUnit;
use App\Booking;
use App\Transactions;
Use Helper;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Terminate;
use App\TenantInvitation;
use App\Invoice;
   
class StripePaymentController extends Controller
{
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
    public function stripePost(Request $request){
        if($request->stripeToken){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            // echo "<pre>";
            // print_r($request->all());die;
            $currencyType =  helper::currencyType();
            $return = Stripe\Charge::create ([
                        "amount" => $request->get('amount'),
                        "currency" => $currencyType,
                        "source" => $request->stripeToken,
                        "description" => "test payment",
                        'capture' => false,
                    ]);
            if($return->status == 'succeeded'){
                $where_data = array('unit_id' => $request->get('unit_id'), 'tenant_id' => $request->get('tenant_id'), 'current_status' => '0');
                $booking_data = array(
                    'step' =>5, 
                    'status' => '0',
                    'payment_method' => 'stripe',
                    'payment_status' => 'hold',
                );
                $booking = booking::where([
                    'unit_id' => $request->get('unit_id'), 
                    'tenant_id' => $request->get('tenant_id')
                ])->first()->toArray();
                $booking_update = Booking::where($where_data)->update($booking_data);
                $unit_update = PropertiesUnit::where(['id' => $request->get('unit_id')])->update(['booking_status' => 1]);
                $transaction = new Transactions();
                $transaction->related_to = 'rent';
                $transaction->booking_id = $booking['id'];
                $transaction->amount = $request->get('amount')/100;
                $transaction->payment_by = 'Stripe';
                $transaction->stripe_id = $return->id;
                $transaction->save();

                $unit = PropertiesUnit::find($request->get('unit_id'))->toArray();
                $pm_id = $unit['property_manager_id'];
                $pm_details = User::find($pm_id)->toArray();
                $pm_name      = $pm_details['name'];
                $pm_email     = trim($pm_details['email']); 
                $tenant_details = User::find($request->get('tenant_id'))->toArray();
                $tenant_name      = $tenant_details['name'];
                $tenant_email     = trim($tenant_details['email']);

                $TenantInvitation = TenantInvitation::where(['unit_id' => $request->get('unit_id'),'booking_id' =>$booking['id'] ])->get();
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
                $invoice = Helper::generate_invoice($booking['id']);
                $bookingUpdate = Booking::where('id',$booking['id'])->update(['invoice' => $invoice]);
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
            } else {
                toastr()->error('Something Went Wrong!');
                return redirect()->back();
            }
        } else {
            toastr()->error('Payment not Recived!');
            return redirect()->back();
        }
    }

    public function stripe_Pay_Dues(Request $request, $id){
        if($request->stripeToken){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $currencyType =  helper::currencyType();
            // echo $id;
            // print_r($request->all());die;
            $return = Stripe\Charge::create ([
                        "amount" => $request->get('amount'),
                        "currency" => $currencyType,
                        "source" => $request->stripeToken,
                        "description" => "test payment",
                        // 'capture' => false,
                    ]);
            $tenant_id = $request->get('tenant_id');
            // $user = Auth::user();
            $contract = Booking::find($id);
            $terminate = Terminate::where(['booking_id' => $id, 'tenant_id' => $tenant_id])->first();
            
            if($return->status == 'succeeded'){
                
                $transaction = new Transactions();
                $transaction->related_to = 'PayDues';
                $transaction->booking_id = $id;
                $transaction->terminate_id = $terminate->id;
                $transaction->amount = $request->get('amount') / 100;
                $transaction->payment_by = 'Stripe';
                $transaction->stripe_id = $return->id;
                $transaction->save();
                $transaction_id = $transaction->id;
                
                // $user = User::find($tenant_id);
                // $user->wallet_amount -= $postData['dues_amount'];
                // $user->save();

                // $unit = PropertiesUnit::find($contract->unit_id);
                $contract->deposit_amount -= $request->get('amount') / 100;
                $contract->save();

                $where_data = array('id' => $terminate->id );
                $terminate_data = array(
                    'step'       => '4',
                    'pay_dues'   => 'payment',
                    'payment_method'   => 'Stripe',
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
            } else {
                toastr()->error('Something Went Wrong!');
                return redirect()->back();
            }
        } else {
            toastr()->error('Payment not Recived!');
            return redirect()->back();
        }
    }

    public function stripe_add_money(Request $request){
        if($request->stripeToken){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            // echo "<pre>";
            $currencyType =  helper::currencyType();

            // helper::pr($request->all());die;
            $return = Stripe\Charge::create ([
                        "amount" => $request->get('amount'),
                        "currency" => $currencyType,
                        "source" => $request->stripeToken,
                        "description" => "Add money to wallet",
                    ]);
            $tenant_id = $request->get('tenant_id');
            
            if($return->status == 'succeeded'){
                
                $transaction = new Transactions();
                $transaction->related_to = 'AddMoney';
                $transaction->tenant_id = $tenant_id;
                $transaction->amount = $request->get('amount') / 100;
                $transaction->payment_by = 'Stripe';
                $transaction->stripe_id = $return->id;
                $transaction->save();
                    
                $user = User::find($tenant_id);
                $user->wallet_amount += $request->get('amount') / 100;
                $user->save();
                
                toastr()->success('Payment Done!');
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
}


// $retrieve = Stripe\Charge::retrieve('ch_1FWM14ET9w4zgxTQCMNoTull');
// if(!$retrieve->captured){
//     $return = $retrieve->capture();
//     if($return->status == 'succeeded'){
//         echo $return->id;
//         echo "<br>herere";
//     }
// } else {
//     echo "Already Recived Payment";
// }