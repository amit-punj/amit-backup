@extends('layouts.main')
@section('content')
<style type="text/css">
	.btn-primary
	{
		background-color: #41ac1c;
		border-color: unset;
		border-radius: 20px;
	}
   .row.justify-content-center {
    padding: 50px;
}
div#main {background-color: #f3f3f3;}
</style>
<style type="text/css">

a.list-group-item {
    color: #fff;
}
input.form-control {
    border-left-color: green;
    border-left-width: thick;
    /*background-color: #f3f3f3;*/
    background-color: white;
   
}
    .color-orange{
        color: #b0b1b0;
    }
    .f13 {
        padding-right: 0;
    font-size: 13px !important;
}
.viewbtn{
     border-radius: 20px; width: 100%; background-color: #b0b1b0;
    }
    .editbtn{
        border-radius: 20px; width: 100%; background-color: green; color: white;
    }
.mg{
    margin-top: 2%;
}
.card-title{
    font-size: 29px;
    font-weight: bold;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: green;
}
.page-link {
    color: #37a745;
    }
    .descrip{
        height: 40px;
    }
    .rmt{
        margin-top: 4%;
    }
    .note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
   /* background-color: #4fad26;*/
    font-weight: bold;
    line-height: 80px;
}
div#main {
   background-color: #f3f3f3;
}



.property .cInput .input  {
    border: none;
    margin-top: 9px;
    border-bottom: solid 1px #ccc;
    width: 100%;
    color: #666;
    font-size: 15px;
    padding: 0 10px 5px 0;
    box-sizing: border-box;
    margin: 0;
    font-size: 100%;
}
.property .cInput .input:focus {
    border-color: #3498db;
}
.cInput .label  {
    height: 23px;
}
.form-content{
    padding: 50px;
    background-color: white;
}
@media screen and (max-width: 823px){
    label.col-md-4.col-form-label.text-md-right{
        font-size: 13px !important;
}
}
@media screen and (max-width: 420px){
    input.btnSubmit.btn.btn-success{
        width: 100% !important;
    }
    label.col-md-4.col-form-label {
    font-size: 12px;
}
}
</style>
<div class="container">
    <div class="row m-0">
        <div class="col-md-3 setmd">
            @include('dashboard.dashboard-sidebar')
        </div>
        <div class="col-md-9 setmd">
            <div class="property">
                @if(Session::has('flash_message_error'))    
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif 
                @if(Session::has('flash_message_success'))    
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif 
                <div class="form">
                    <div class="note"><p style="font-size: 22px;">Change <span style="color: #41ac1b"> Password </span></p>
                    </div>
                </div>
                <div class="form-content" style="justify-content: center;">
                     <form method="POST" action="{{ url('agent/change-password') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-sm-12 col-xs-12 col-form-label">{{ __('Current Password *') }}</label>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="password" type="password" class="form-control" name="password" required >
                                @if ($errors->has('password'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('password') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_password" class="col-md-12 col-sm-12 col-xs-12 col-form-label">{{ __('New Password *') }}</label>

                            <div class="col-md-12">
                                <input id="new_password" type="password" class="form-control" name="new_password">
                                @if ($errors->has('new_password'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('new_password') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-12 col-sm-12 col-xs-12 col-form-label ">{{ __('Confirm Password *') }}</label>

                            <div class="col-md-12">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password">
                                @if ($errors->has('confirm_password'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('confirm_password') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-8">
                                <input type="submit" class="btnSubmit btn btn-success" value="{{ __('Change Password') }}" style="margin-top: 3%; width: 100%;">
                            </div>
                        </div>   
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection