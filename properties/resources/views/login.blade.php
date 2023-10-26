@extends('layouts.main')
@section('content')
<style type="text/css">
  input{
    margin-top: 5%;
  }
  input.form-control {
    border-left-color: green;
    border-left-width: thick;
    /*background-color: #f3f3f3;*/
    background-color: white;  
}
input.form-control.fieldsize {
    font-size: 14px !important;
}
.font-weight-normal {
    font-weight: bolder !important;
}
.backimg{
    background-image: url('../images/default/newbeg.jpeg');
    background-size: cover;
}
.footer{
    margin: 0px  auto;
}
.wrapper input[type="text"] {
    position: relative; 
}
#logreg-forms a {
margin-top: -4%;
}

input { font-family: 'FontAwesome'; } /* This is for the placeholder */

.wrapper:before {
    font-family: 'FontAwesome';
    color:red;
    position: relative;
    left: -10px;
    content: "\f007";
}
@media screen and (max-width: 393px){
    #logreg-forms {
    width: 300px;
}}
@media screen and (max-width: 375px){
     #logreg-forms {
    width: 275px;
}
}
@media screen and (max-width: 360px){
    #logreg-forms {
    width: 260px;
}
}
@media screen and (max-width: 320px){
    #logreg-forms {
    width: 225px;
}
}
@media screen and (min-width: 1024px)
{
.backimg {
    min-height: 627px;
}
</style>
<div class="backimg">
<div class="container" style="padding: 50px;">
         <div id="logreg-forms" style="margin: 0px auto;">
           @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
                @if(Session::has('flash_message_reg'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_reg') !!}</strong>
                    </div>
                @endif
            @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif
                <form class="form-signin" action="{{url('agent/login')}}" method="post">
                @csrf
                    <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
                    <p style="text-align:center">   </p>
                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="&#61447; User Email"  value="{{ old('email') }}"  autofocus="" required="">
                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="&#61475; Password" required="">
                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    <div class="row">            
                            <div class="col-md-6 col-sm-6 col-xs-6"> <label>
                                    <input type="checkbox" name="remember" id="remember" value="1" style="margin-top: 9px; margin-right: 8px;" ><span style="font-size: 12px; ">Keep me signed in</span>
                                    </label></div>
                            <div class="col-md-2 col-sm-2 col-xs-2"></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                            <button style="border-style: none; border-radius: 20px;  max-width: 108px;" class="btn btn-success btn-block" type="submit">SIGN IN</button>
                            </div>
                    </div>
                     @if (Route::has('password.request'))
                       <a style="font-size: 14px; float: left;" class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('Forgot Your Password?') }}
                          </a>
                    @endif 
                    <!-- <p>Don't have an account!</p>  -->
                    </form>
                    <hr>
                    
            </div>
        </div> 
        </div>   
@endsection
