@extends('layouts.main')
@section('content')
<style type="text/css">
  input{
    margin-top:2%;
  }
  input.form-control {
    border-left-color: green;
    border-left-width: thick;
    /*background-color: #f3f3f3;*/
    background-color: white;
   
}
form.form-signin {
    /*background-color: white;*/
    background-color:#f3f3f3; 
}
.font-weight-normal {
    font-weight: bold !important;
}
label{
    display: unset;
}
.two{
    display: flex;
}
.fieldsize{
    width: 49%;
}
.space{
    margin-left: 2%;
}
.backimg{
    background-image: url('../images/default/newbeg.jpeg');
    background-size: cover;
}
#logreg-forms {
    width: 412px;
    padding: 10vh auto;
    background-color: #f3f3f3;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.footer{
    margin: 0px  auto;
}
input.form-control.fieldsize {
    font-size: 14px !important;
}

@media screen and (min-width: 1024px) {
#logreg-forms {
    width: 609px !important;
}
#logreg-forms form {
    max-width: 609px;
}
}
@media screen and (max-width: 499px)
{
    #logreg-forms {
    width: 400px;
}
.two{
    display: unset;
}
.fieldsize{
    width: 100%;
}
.space{
    margin-left: unset;
}
}
@media screen and (max-width: 414px)
{
    #logreg-forms {
    width: 300px !important;
}
}
@media screen and (max-width: 375px)
{
   #logreg-forms {
    width: 270px !important;
} 
}
@media screen and (max-width: 320px)
{
    #logreg-forms{
    width: 225px !important;
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
            <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong class="mleft">{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
 @if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong class="mleft">{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
                    <form class="form-signin" action="{{url('agent/signup')}}" method="post">
                      @csrf
                              <h3 class="h3 mb-3 font-weight-normal" style="text-align: center">AgentsConnect Registration</h3>
                              <h6 class="text-center">After entering your information and clicking “Register” you will see the membership options</h6>
                              @if($errors->has('email'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                            <span class="help-block">
                                            <strong class="mleft">{{ $errors->first('email') }}</strong>
                                           </span>
                                        </div>
                                    @endif
                                     @if($errors->has('password'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                            <span class="help-block">
                                            <strong class="mleft">{{ $errors->first('password') }}</strong>
                                           </span>
                                        </div>
                                    @endif
                                <div class="two">
                                         <input type="text" name="fname" class="form-control fieldsize" placeholder="First Name*" value="{{ old('fname')}}" autofocus="" required="">
                                         @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong ">{{ $errors->first('fname') }}</strong>
                                                        </span>
                                                    @endif
                                          <input type="text"  name="lname" class="form-control fieldsize space" placeholder="Last Name*" value="{{ old('lname')}}" autofocus="" required="">
                                         @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong class="mleft">{{ $errors->first('lname') }}</strong>
                                                        </span>
                                                    @endif
                                </div>
                            <div class="two">
                                <input type="email" id="inputEmail" name="email" class="form-control fieldsize" placeholder="Comapany Email*" value="{{ old('email')}}" autofocus="" required="">
                                <input type="password" id="inputPassword" name="password" class="form-control fieldsize space" placeholder="Password*" required="">  
                            </div>               
                            <div class="two">
                                <input type="text" name="state_licence_id" class="form-control fieldsize" placeholder="State Licence ID*" value="{{ old('state_licence_id')}}" autofocus="" required="">
                                @if ($errors->has('state_licence_id'))
                                                <span class="help-block">
                                                    <strong class="mleft">{{ $errors->first('state_licence_id') }}</strong>
                                                </span>
                                            @endif
                                <input type="text"  name="realestate_firm" class="form-control fieldsize space" placeholder="Real Estate Firm*" value="{{ old('realestate_firm')}}" autofocus="" required="">
                                @if ($errors->has('realestate_firm'))
                                                <span class="help-block">
                                                    <strong class="mleft">{{ $errors->first('realestate_firm') }}</strong>
                                                </span>
                                            @endif
                            </div>  

                            <div class="two">
                                <input type="text"  name="city_name" class="form-control fieldsize" placeholder="City Name*" value="{{ old('city_name')}}" autofocus="" required="">
                                @if ($errors->has('city_name'))
                                                <span class="help-block">
                                                    <strong class="mleft">{{ $errors->first('city_name') }}</strong>
                                                </span>
                                            @endif
                                <input type="text" name="state" class="form-control fieldsize space" placeholder="State*" value="{{ old('state')}}" autofocus="" required="">
                                @if ($errors->has('state'))
                                                <span class="help-block">
                                                    <strong class="mleft">{{ $errors->first('state') }}</strong>
                                                </span>
                                            @endif                
                            </div>
                            <div class="two">
                                    <input type="text"  name="zipcode" class="form-control fieldsize" placeholder="Zipcode" value="{{ old('zipcode')}}" autofocus="" >
                                        @if ($errors->has('zipcode'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('zipcode') }}</strong>
                                                        </span>
                                                    @endif
                                    <input type="text" class="form-control fieldsize space" placeholder="USA" disabled="">    
                            </div> 
                                <!-- <input type="text" style="font-size: 14px;"  name="agent_profile_url" class="form-control" placeholder="Agent profile URL" value="{{old('agent_profile_url')}}" >    -->
                                @if ($errors->has('agent_profile_url'))
                                    <span class="help-block">
                                        <strong class="mleft">{{ $errors->first('agenturl') }}</strong>
                                    </span>
                                @endif
                           
                                    <label>
                                    <input type="checkbox" checked="" name="remember" style="margin-top: 9px; margin-right: 8px;" required=""><a href="{{url('/page/terms-condition')}}" target="_blank" style="font-size: 12px; display: unset;">I agree with the term and condition</a>
                                    </label>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6 text-center"><button class="btn btn-primary btn-block" style="background-color: green; border-style: none; border-radius: 20px;  margin-top: 5%; " type="submit">Register</button></div>
                                <div class="col-md-3"></div>
                             </div>
                    </form>      
    </div>
 </div>
</div>
@endsection