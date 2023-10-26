<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Atlant - Responsive Bootstrap Admin Template</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('admin_asset/css/theme-default.css') }}" rel="stylesheet">
        <!-- EOF CSS INCLUDE -->                                       
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                 @if(Session::has('flash_message_success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                    @endif
                    @if(Session::has('flash_message_error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    <form  action="{{ url('admin') }}" class="form-horizontal" method="post">
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
                        <a href="{{ route('password.request') }}" class="btn btn-link">
                            Forgot Your Password?
                        </a>
                      
                        <div class="col-md-6 col-sm-6 col-xs-6"> <label class="btn-link">
                            <input type="checkbox" name="remember" style="margin-top: 9px; margin-right: 8px;"><span style="font-size: 12px; ">Keep me sign in</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="col-md-6">
                            <button class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                    </form>
                </div>
                
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('admin_asset/js/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_asset/js/plugins/jquery/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin_asset/js/plugins/bootstrap/bootstrap.min.js') }}"></script>

    </body>
</html>