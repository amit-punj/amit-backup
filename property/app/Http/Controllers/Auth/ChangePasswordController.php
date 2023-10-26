<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Http\Request;;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function changePassword(){
        return view('auth.passwords.change-password');    
    }

    function updatePassword(request $request){
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required','min:6'],
            'confirm_new_password' => ['required','min:6','same:new_password'],
        ]);
        $postData = input::all();
        $user = User::where(['id' => Auth::id() ])->first();
        if( !empty($user) && $user != "" && Hash::check($postData['current_password'], $user->password))        {
            $user->password  = Hash::make($postData['new_password']);
            $user->save();
            toastr()->success('password updated Successfully!');
            return redirect('/profile');
        } else {
            toastr()->error('Current Password Not Match.');
            return redirect()->back();
        }
        
    }
}
