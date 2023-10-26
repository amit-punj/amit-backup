<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\MembershipPayments;
use Illuminate\Support\Facades\Hash;

class UserlistController extends Controller {
    
    public function list(request $request){
        $users = User::orderBy('id','DESC')->get();       
    	return view('admin.users.listusers')->with(['users'=>$users]);
    }

    public function createView(request $request){
        $users = User::all();        
    	return view('admin.users.addusers')->with(['users'=>$users]);
    }

    public function editUser($id){
    	$user = User::find($id);
    	return view('admin.users.editusers')->with(['user'=>$user]);
    }

    public function delete($id){
        $cmspages = new User;
        $cmspages->find($id)->delete();
        return back()->with('message', 'User Deleted Successfully!');
    }

    public function createUser(request $request){
    	$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'user_role' => ['required'],
        ]); 
        User::create([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'user_role' => $request->input('user_role'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('/admin/listusers')->with('message', 'User Created Successfully!');
    }

    public function updateUser(request $request){
    	$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable','min:8'],
            'user_role' => ['required'],
        ]); 
        $user = User::find($request->input('user_id'));
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->user_role = $request->input('user_role');
        if(!empty($request->password))
        {
        $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        return redirect()->back()->with('message', 'User Update Successfully!');
    }
    public function user_search_filter(Request $request)
    {
        if($request->isMethod('post'))
        {
            $role = '';
            if($request->status_search == '')
            {
               $users = User::orderBy('id','DESC')->get();
            }
            elseif($request->status_search == 1)
            {
               $users = User::where('user_role',1)->orderBy('id','DESC')->get();
               $role = 1;
            }
            elseif($request->status_search == 2)
            {
                $users = User::where('user_role',2)->orderBy('id','DESC')->get();
                $role = 2;
            }
            elseif($request->status_search == 3)
            {
                $users = User::where('user_role',3)->orderBy('id','DESC')->get();
                $role = 3;
            }
            elseif($request->status_search == 4)
            {
                $users = User::where('user_role',4)->orderBy('id','DESC')->get();
                 $role = 4;
            }
            elseif($request->status_search == 5)
            {
                $users = User::where('user_role',5)->orderBy('id','DESC')->get();
                $role = 5;
            }
            elseif($request->status_search == 6)
            {
                 $users = User::where('user_role',6)->orderBy('id','DESC')->get();
                 $role = 6;
            }
            return view('admin.users.listusers')->with(['users'=>$users,'role'=>$role]);
        }
        else
        {
              return redirect('admin/listusers');
        }
    }
    public function user_membership_list(Request $request)
    {
        $membership_data = MembershipPayments::orderBy('id','DESC')->where('deleted_at',0)->get();
        return view('admin.users.user_membership_list',compact('membership_data'));
    } 
    public function delete_membership_list($id)
    {
        if($id)
        {
            $membership_data = MembershipPayments::find($id);
            $membership_data->deleted_at = date('Y-m-d H:m:s');
            $membership_data->save();
            return back()->with('flash_message_delete','data deleted');
        }
    }

}
