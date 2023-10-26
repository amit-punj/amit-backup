<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;
class userController extends Controller
{
    public function enquire(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$email_data = array(
                    'username' => $request->name,
                    'title'     => 'Property Detail',
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'purpose' => $request->purpose,
                    'detail' => $request->detail
                );
                // echo "<pre>";
                // print_r($email_data);
                // die('jjjjjjj');
               $customer = User::where('role',1)->select('email')->first();
                $customer_email = trim($customer->email);
                $admin_mail = $request->email;
                $customer_name = $request->name;
                $subject = "Property Detail"; 
               try {
                    Mail::send(['html' => 'email/enquire'], $email_data, function ($message) use ($email_data,$customer_email,$admin_mail,$customer_name,$subject){
                                $message->from($admin_mail, 'Agent Connect');
                                $message->to($customer_email,'Agent Connect')->subject($subject);

                    });
                  } catch(Exception $ex){
                            // print_r($ex);
                        }
              return redirect('home')->with('flash_message_enquire','Thanks for your property detail');          

    	}
    }
}
