<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use App\User;
use App\Extend;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function index(){
    	return view('admin.dashboard');
    }
    public function adminRedirect(){
    	return redirect('/admin/dashboard');
    }
    public function adminLogin(){
    	return view('admin.adminlogin');
    }
    public function postAdminLogin(Request $request){
    	$request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]); 
    	if(	(DB::table('users')->where('email', $request->email)->value('id') != null ) && 
    		(Hash::check($request->password,DB::table('users')->where('email', $request->email)->value('password'))) &&
    		(DB::table('users')->where('email', $request->email)->value('user_role') ==0) )  {
		    	Auth::loginUsingId(DB::table('users')->where('email', $request->email)->value('id'));
		    	return redirect('/admin');
		} else {
			return redirect('/admin-login');
		}
    }
    public function extend_request(Request $request)
    {
        $running_contract = Booking::where('status','=', 6)
                            ->orderBy('id','DESC')->get();
            if($running_contract){
                foreach ($running_contract as $key => $value) {
                    $extend_request_ids[] = $value->id;
                }
            }
            $extend_requests = Extend::whereIn('booking_id', $extend_request_ids)
                            ->orderBy('id','DESC')->get();
             return view('admin.extend.extend',compact('extend_requests'));
    }
    public function edit_profile(Request $request)
    {
         if($request->isMethod('post'))
         {

            $postData = Input::all();
            $rules = array(
                'email' => 'required|string|email|max:255',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg',
                 'name' => 'required',
                 'phone_no' => 'nullable|numeric|min:10',
                'new_password' => 'nullable|string|min:6',
                'cpassword' => 'nullable|min:6|same:new_password'
                 
            );
            $messages = array(
                'cpassword.same' => 'password and confirm password not match'
            );
            $validator = Validator::make($postData, $rules, $messages);

            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }
                $data = User::find(Auth::user()->id);
                $data->name = $request->name;
                if($request->email != Auth::user()->email)
                {
                   $email_test = User::where('email',$request->email)->first();
                   if(!empty($email_test))
                   {
                      return back()->with('flash_message_error','Email Alraedy exist');
                   }
                   else{
                      $data->email = $request->email;
                   }
                }
               
                $data->email = $request->email;
                $data->phone_no = $request->phone_no;
                    if($request->old_password != "" && !empty($request->new_password))
                    {
                        if(Hash::check($request->old_password,Auth::user()->password)) {
                           $data->password = Hash::make($request->new_password);
                        } else{
                            return back()->with('flash_message_error','old password incorrct');
                        }
                    }
                    if($request->file('image') !="")
                   {
                   $image1 = $request->file('image');
                    $file_name = uniqid().'.'.$image1->getClientOriginalExtension();
                   $destinationPath = "images";
                   $image1->move($destinationPath,$file_name);
                   $data->image = $file_name;
                    }
                $data->save();
                return back()->with('flash_message_success','Data updated successfully');    
                    
         }
         else{
            return view('admin.setting.edit_profile');
         }
    }
    
}
