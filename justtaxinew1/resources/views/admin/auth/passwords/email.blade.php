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
    
        <style>
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
        .login-form {
    background-color: #fff;
    padding: 65px 35px;
    box-shadow: 20px 20px 50px rgba(0,0,0,0.07);
    border-radius:10px;
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
                    <div class="col-md-5 p-0">
                        <div class="login-form">
                        @if(Session::has('flash_message_error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif
                    <div class="text-center"><img src="{{url('main/assets/img/logo.png')}}" alt="logo" class="img-fluid mb-5"/></div>
                        <h2 class="text-center mb-5">@lang('admin.auth.reset_password')</h2>     
                            <form role="form" method="POST" action="{{ url('/admin/password/email') }}" >
                                {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="email" name="email" value="{{ old('email') }}" required="true" class="form-control" id="email" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <button type="submit" class="btn btn-success btn-lg w-100">@lang('admin.auth.send_password_reset_link')</button>
                                    </div>
                                </form>
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
                    @endif -->
                    <!-- <div class="alert alert-error alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>fdfd</strong>
                        </div> -->
                    <!-- <div class="login-title"><strong>@lang('admin.auth.reset_password')</strong></div>
                   
                    <form class="form-material mb-1" role="form" method="POST" action="{{ url('/admin/password/email') }}" >
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" value="{{ old('email') }}" required="true" class="form-control" id="email" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="px-2 form-group mb-0">
                            <button type="submit" class="btn btn-info btn-block text-uppercase">@lang('admin.auth.send_password_reset_link')</button>
                        </div>
                    </form>
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