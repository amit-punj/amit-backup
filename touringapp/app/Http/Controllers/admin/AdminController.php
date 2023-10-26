<?php

namespace App\Http\Controllers\admin;
use App\admin\Tours;
use App\admin\Users;
use App\admin\Variations;
use App\admin\Poi;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
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
        $tour_owner = Auth::user()->id;
        if(Auth::user()->role == '10' )
        {
            $where = array('tour_owner'=>$tour_owner);
            $poi    = count( DB::table('poi')
                        ->select('poi.*')
                        ->join('tours','tours.id','=','poi.tour_id')
                        ->where($where)
                        ->get());
        }
        else
        {
            $where = array();
            $poi    = count(Poi::get());
        }
        $users  = count(Users::get());
        $agents = count(Users::where('role','=','10')->get());
        $tours  = count(Tours::where($where)->get());
        // \DB::enableQueryLog();
        //  $query = \DB::getQueryLog();
        //  print_r($query);
        //  die('fff');
        return view('admin.dashboard', compact('users', 'tours', 'poi', 'agents'));
    }
    public function profile(Request $request)
    {
        $id = Auth::user()->id;
        $user = Users::where('id','=',$id)->first();
        if($request->isMethod('post'))
        {
            $update_data = array();
            $postData = Input::all();
            $rules = array(
                'fname'             => 'required',
                'lname'             => 'required',
            );
            if(!empty($postData['old_password']) && $postData['old_password'] != '' )
            {
                $rules['password'] = 'required|string|min:6';
                $rules['cpassword'] = 'required|string|min:6|same:password';
            }
            $messages = array(
                    'cpassword.same' => 'password and confirm password not match'
                    );
            $validator = Validator::make($postData, $rules, $messages);
            if ($validator->fails()){
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                if(!empty($postData['old_password']) && $postData['old_password'] != '' )
                {
                    $hash = Hash::check($postData['old_password'], $user->password);
                    if($hash)
                    {
                        $update_data['password'] = Hash::make($postData['password']);
                    }
                    else
                    {
                        $error =  '<strong>Warning!</strong> Your old password not match!';
                        return back()->with('flash_message_error',$error);
                    }
                }
                $update_data['fname'] =  $postData['fname'];
                $update_data['lname'] =  $postData['lname'];
                $update_data['name']  = $postData['fname'];

                Users::where(['id'=>$user->id])->update($update_data);
                return back()->with('flash_message_success','User updated successfully');
            }
        }
        return view('admin.profile', compact('user'));
    }
}
