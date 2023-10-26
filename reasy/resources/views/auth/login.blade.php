@section('title','Log In')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Log In'])
<div class="container login-page">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-md-9 col-lg-6">
            @if(session()->has('message'))
                  <div class="alert alert-success">
                      {{ session()->get('message') }}
                  </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Sign in into your Account') }}</div>
                
                <div class="card-body">
                    <div class="row social_login">
                        <div class="col-md-3 col-lg-6">
                            <button class="btn btn-fb mat-raised-button">
                                <span class="mat-button-wrapper"><img src="{{ url('images/fb.png') }}"> Continue with Facebook </span>
                                <div class="mat-button-ripple mat-ripple"></div>
                                <div class="mat-button-focus-overlay"></div>
                            </button> 
                        </div>
                        <div class="col-md-3 col-lg-6">
                            <a href="{{ url('auth/google') }}"><button class="btn btn-google float-sm-right mat-raised-button">
                                <span class="mat-button-wrapper"><img src="{{ url('images/google.png') }}"> Continue with Google + </span>
                                <div class="mat-button-ripple mat-ripple"></div>
                                <div class="mat-button-focus-overlay"></div>
                            </button></a>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}" id="user_login">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-sm-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-sm-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label text-sm-right">{{ __('Password') }}</label>

                            <div class="col-sm-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <div class="col-sm-6 offset-sm-4"> -->
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group row mb-0"> -->
                        <div class="form-group row submit">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-sm-12">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <div class="col-sm-3"></div>
    </div>
</div>
<script type="text/javascript">
    jQuery('#user_login').validate({
          errorClass:"red",
          validClass:"green",
          rules:{
              email:{
                required:true,
                 email:true,
              },
              password:{
                required:true,
              }
          }      
      });
</script>
<style type="text/css">
    .row.social_login {text-align: center;     margin-bottom: 20px;}
    .row.social_login img {width: 20px; }
    button.btn.btn-fb.mat-raised-button {background: #4d70a8; color: #fff;     float: right;}
    button.btn.btn-google.float-sm-right.mat-raised-button {background: #dd4b39; color: #fff;     float: left;}
    button.btn.btn-google.float-sm-right.mat-raised-button img {width: 22px; }
    @media only screen and (max-width: 1024px) {
        button.btn.btn-fb.mat-raised-button {float: none; }
        button.btn.btn-google.float-sm-right.mat-raised-button {float: none; margin-top: 15px; }
    }
</style>
@endsection
