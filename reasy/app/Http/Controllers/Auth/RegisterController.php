<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */ 
    protected $redirectTo = '/email-verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
        ], [
            'password.regex' => 'Your password must be atleast 8 characters long, 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::put('email',$data['email']);
        return User::create([
           // 'name' => $data['name'],
            'email' => $data['email'],
            //'last_name' => $data['last_name'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        return view('auth/passwords/create-password')->with(['user'=>$user]);
        // return redirect('/login')->with('status', $status);
    }
    public function update_password(Request $request)
    {
        if($request->isMethod('post'))
        {
            $postData = input::all();
            
            $rules = array(
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            );
            $validator = Validator::make($postData, $rules);
            if ($validator->fails())
            {
                return back()->withInput()->withErrors($validator);
            }
            else
            {
                $user = User::where(['id' => $postData['id'] ])->first();
                if( !empty($user) && $user != "" )
                {
                    $user->password  = Hash::make($postData['password']);
                    $user->save();
                }
                toastr()->success('You updated your password. You can now login.');
                return redirect('/login');
            }
        }
    }

    public function show1(Request $request)
    {
        $email = Session::get('email');
        $user = User::where('email','=',$email)->first();
        if ($user->hasVerifiedEmail()) {
            $this->guard()->login($user);
            return redirect('/home');
        }
        return view('auth.email-verify');
    }

    protected function guard()
    {
        return Auth::guard();
    }

}
