<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>{{ Setting::get('site_title', 'Tranxit') }}</title>         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" type="image/png" href="{{ Setting::get('site_icon') }}"/>
        <!-- <link rel="icon" href="favicon.ico" type="image/x-icon" /> -->
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('admin_asset/css/theme-default.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- EOF CSS INCLUDE -->  

        <?php $background = asset('main/assets/img/tuktuk_logo.png'); ?>
        <?php $login      = asset('main/assets/img/share-cab.jpg'); ?>
    
        <style>
            .login-logo {
            background: url({{$background}}) top center no-repeat !important;
            background-size: 135px 100px !important;
            width: 100%;
            height: 120px !important;
            float: left;
        }
        a:focus, a:hover {
            color: #fff;
            text-decoration: underline;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        .login-bg{
            width:100%;
            height:100vh;
            background-color:#e8ebf0;
        }
        .login-outer-div {
            top: 50%;
            transform: translateY(-50%);
            position: absolute;
            width: 100%;
        }
        .login-background{
            background:url({{$login}}) no-repeat;
            background-size:cover;
            border-top-left-radius:10px;
            border-bottom-left-radius:10px;
            box-shadow: -20px 20px 50px rgba(0,0,0,0.1);
        }
        .login-form {
            background-color: #fff;
            padding: 65px 35px;
            box-shadow: 20px 20px 50px rgba(0,0,0,0.1);
            border-top-right-radius:10px;
            border-bottom-right-radius:10px;
            border:1px solid #ddd;
        }
        .form-control{
            height:45px;
            border:1px solid #ccc;
        }
        .help-block{
            color:red;
        }
        </style>                                    
    </head>
    <body>
        <div class="login-bg">
            <div class="login-outer-div">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                <div class="row justify-content-center">
                    <div class="col-md-5 p-0 login-background"></div>
                    <div class="col-md-5 p-0">
                        <div class="login-form">
                            @if(Session::has('flash_message_error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{!! session('flash_message_error') !!}</strong>
                                </div>
                            @endif
                            <!-- <div class="alert alert-error alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <strong>fdfd</strong>
                                </div> -->
                            <div class="text-center"><img src="{{url('main/assets/img/logo.png')}}" alt="logo" class="img-fluid mb-5"/></div>
                           
                            <form  action="{{ url('admin/login') }}" class="form-horizontal" method="post">
                                {{ csrf_field() }}
        
                                <div class="form-group">
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email"/>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <!-- <a href="{{ url('/password/reset') }}" class="btn btn-link">
                                        Forgot Your Password?
                                    </a> -->
                                    <!-- <div class="col-md-6">
                                        <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                                    </div> -->
                                        <button class="btn btn-success btn-lg w-100">Log In</button>
                                    </div>
                            </form>
                            <div class="pt-4 text-center">
                                <a class="text-muted font-weight-bold" href="{{ url('/admin/password/reset') }}"><span class="underline">@lang('admin.auth.forgot_your_password')?</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
        <!-- <div class="login-container">
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    @if(Session::has('flash_message_error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    <form  action="{{ url('admin/login') }}" class="form-horizontal" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email"/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control" placeholder="Password"/>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/password/reset') }}" class="btn btn-link">
                                Forgot Your Password?
                            </a> -->
                            <!-- <div class="col-md-6">
                                <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <button class="btn btn-info btn-block">Log In</button>
                            </div>
                        </div>
                    </form>
                    <div class="p-2 text-muted text-center">
                        <a class="text-black" href="{{ url('/admin/password/reset') }}"><span class="underline">@lang('admin.auth.forgot_your_password')?</span></a>
                    </div>
                </div>
                
            </div>
        </div> -->
        <script type="text/javascript" src="{{ asset('admin_asset/js/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_asset/js/plugins/jquery/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_asset/js/plugins/bootstrap/bootstrap.min.js') }}"></script>
@if(Setting::get('demo_mode', 0) == 1)
            <!-- Start of LiveChat (www.livechatinc.com) code -->
            <script type="text/javascript">
                window.__lc = window.__lc || {};
                window.__lc.license = 8256261;
                (function() {
                    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
                    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
                })();
            </script>
            <!-- End of LiveChat code -->
        @endif

    </body>
</html>