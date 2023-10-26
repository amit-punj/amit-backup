<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Events\Verified;
use Session;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        // $user = User::find('161');
        // echo "<pre>";
        // print_r($request->all());
        // die('dfddff');
        // $email = Session::get('email');
        // $user = User::where('email','=',$email)->first();

        $user = User::find($request->route('id'));
        if ($user->markEmailAsVerified())
            event(new Verified($user));
        $this->guard()->login($user);
        return redirect($this->redirectPath())->with('verified', true);
    }

    public function resend(Request $request)
    {
        $email = Session::get('email');
        $user = User::where('email','=',$email)->first();
        // $user = User::find('161');
        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
        $user->sendEmailVerificationNotification();
        // $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', true);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
