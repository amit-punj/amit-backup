<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest')->except('logout');
    }

     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
   
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect('/');
            }else{
                $password = rand();
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_role' => 1,
                    'password' => Hash::make($password),
                    'verified' => "1",
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'google_id'=> $user->id
                ]);

                Auth::login($newUser);
                return redirect('/');
            }  
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
