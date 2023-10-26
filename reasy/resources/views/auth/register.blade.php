@section('title','Create Account')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Create Account'])
<div class="container register-page">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Create your Account') }}</div>
                <div class="row social_login">
                    <div class="col-sm-6">
                        <button class="btn btn-fb mat-raised-button">
                            <span class="mat-button-wrapper"><img src="{{ url('images/fb.png') }}"> Continue with Facebook </span>
                            <div class="mat-button-ripple mat-ripple"></div>
                            <div class="mat-button-focus-overlay"></div>
                        </button> 
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ url('auth/google') }}"><button class="btn btn-google float-sm-right mat-raised-button">
                            <span class="mat-button-wrapper"><img src="{{ url('images/google.png') }}"> Continue with Google + </span>
                            <div class="mat-button-ripple mat-ripple"></div>
                            <div class="mat-button-focus-overlay"></div>
                        </button></a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="register_form">
                        @csrf

                        <!-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       <!--  <div class="form-group row">
                            <label for="user_role" class="col-md-4 col-form-label text-md-right">{{ __('Choose your role') }}</label>

                            <div class="col-md-6">
                                <select name="user_role" class="form-control @error('user_role') is-invalid @enderror" value="{{ old('user_role') }}" required autocomplete="user_role">
                                    <option value="">Choose role</option>
                                    <option value="1">Tenant</option>
                                    <option value="2"> Property Owner</option>
                                    <option value="3">Real Estate Agent</option>
                                    <option value="4">Regional Agent</option>
                                </select>

                                @error('user_role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" pwcheck="pwcheck" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- <div class="form-group row mb-0"> -->
                        <div class="form-group row submit">
                            <!-- <div class="col-md-6 offset-md-4"> -->
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<script type="text/javascript">
    jQuery('#register_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{
            email:{
                required:true,
                email:true,
            },
            // name:{
            //     required:true,
            // },
            // last_name:{
            //     required:true,
            // },
            password:{
                required:true,
                minlength: 8,
            },
            password_confirmation:{
                required:true,
                minlength: 8,
                equalTo : "#password"
            },
        }      
    });

    jQuery.validator.addMethod("pwcheck", 
        function(value) {
           // return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
           //     && /[a-z]/.test(value) // has a lowercase letter
           //     && /\d/.test(value) // has a digit

            var re = /(?=.*\d)(?=.*[%^()@$!%*?&])(?=.*[a-z])(?=.*[A-Z]).{8,}/;
            return re.test(value);
        },
        "Your password must be atleast 8 characters long, 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.");

    jQuery.validator.addMethod("passwordCheck",
        function(value, element, param) {
            if (this.optional(element)) {
                return true;
            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value)) {
                return false;
            } 
            return true;
        },
        "Your password must be atleast 8 characters long, 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.");
</script>
<style type="text/css">
    .row.social_login {text-align: center; margin-bottom: 20px;}
    .row.social_login img {width: 20px; }
    button.btn.btn-fb.mat-raised-button {background: #4d70a8; color: #fff;     float: right;}
    button.btn.btn-google.float-sm-right.mat-raised-button {background: #dd4b39; color: #fff;     float: left;}
    button.btn.btn-google.float-sm-right.mat-raised-button img {width: 22px; } 
    label#password-error { text-align: left;}
</style>
@endsection
