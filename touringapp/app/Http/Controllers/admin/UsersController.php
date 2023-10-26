<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\admin\Users;
use Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = Users::orderBy('id', 'DESC')->get();

        // echo "<pre>";print_r($users);die;
        //where('role','=','2')->
        return view('admin.users.index',compact('users'));
    }

    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
            $postData = Input::all();
            $rules = array(
                'fname'             => 'required',
                'lname'             => 'required',
                'email'             => 'required|string|email|max:255|unique:users',
                'password'          => 'required|string|min:6',
                'cpassword'         => 'required|string|min:6|same:password'
            );
            $messages = array(
                    'cpassword.same' => 'password and confirm password not match'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return redirect('/admin/users/create')->withInput()->withErrors($validator);
            }else{
                    $postData['password'] = Hash::make($postData['password']);
                    $postData['name'] = $postData['fname'];
                    $postData['role'] = '10';
                    $users = Users::create($postData);
                return redirect('/admin/users')->with('flash_message_success','User created successfully');
            }
        }
        return view('admin.users.create');
    }
    public function update(Request $request, Users $user)
    {
        $user_details = Users::where('id','=',$user->id)->get();
        if($request->isMethod('post'))
        {
            $update_data = array();
            $postData = Input::all();
            $rules = array(
                'fname'             => 'required',
                'lname'             => 'required',
                // 'email'             => 'required|string|email|max:255|unique:users,email,'.$user->id,
            );
            if(!empty($postData['password']) && $postData['password'] != '' )
            {
                $rules['password'] = 'required|string|min:6';
                $rules['cpassword'] = 'required|string|min:6|same:password';
                $update_data['password'] = Hash::make($postData['password']);
            }
            $messages = array(
                'cpassword.same' => 'password and confirm password not match'
            );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return redirect('/admin/users/'.$user->id.'/update')->withInput()->withErrors($validator);
            }else{
                    $update_data['fname']           =  $postData['fname'];
                    $update_data['lname']           =  $postData['lname'];
                    $update_data['name']            = $postData['fname'];
                    $update_data['company']         = $postData['company'];
                    $update_data['company_name']    = $postData['company_name'];
                    $update_data['company_address'] = $postData['company_address'];
                    $update_data['company_vat']     = $postData['company_vat'];
                Users::where(['id'=>$user->id])->update($update_data);
                return redirect('/admin/users')->with('flash_message_success','User updated successfully');
            }
        }
        return view('admin.users.update',compact('user'))->with('user_details',$user_details);
    }
    public function delete(Request $request,Users $user)
    {
        if($user->id != "")
        {
            // File::deleteDirectory(public_path($user->id));
            Users::where(['id'=>$user->id])->delete();
            return back()->with('flash_message_success','User deleted successfully !');
        }
    }
}
