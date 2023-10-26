@extends('layouts.main')
@section('content')
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
.form-control {
    height:unset;
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
/*.cInput .label  {
    height: 23px;
}*/
.form-content{
    padding: 5%;
    background-color: white;
}
@media screen and (max-width: 823px){
    input.btnSubmit.btn.btn-success{
        width: 100% !important;
    }
    a.btnSubmit.btn{
        width: 100% !important;
    }
    @media screen and (max-width: 769px){
        input#text {
    font-size: 12px !important;
   }
   .label {
    font-size: 12px !important;
}
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
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
                <div class="form">
                    <div class="note"><p style="font-size: 22px;">Update <span style="color: #41ac1b"> Your </span> Profile</p>
                    </div>
                </div>
                <div class="form-content">
                    <form  action="{{url('agent-profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> First Name* 
                                        @if ($errors->has('fname'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('fname') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="fname" id="text" placeholder="" value="{{ $detail->fname}}" class="form-control" required=""> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Last Name* 
                                        @if ($errors->has('lname'))
                                            <span class="help-block" style="color: red;">
                                                <strong>Last name is required </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="lname" id="text" placeholder="Last Name" value="{{ $detail->lname}}" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Email* 
                                        @if ($errors->has('email'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('email') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="email" id="text" placeholder="" value="{{ $detail->email}}" class="form-control" readonly="" required=""> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> City* 
                                        @if ($errors->has('city_name'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('city_name') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="city_name" id="text" placeholder="" value="{{ $detail->city_name }}" class="form-control" required=""> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Zip Code* 
                                        @if ($errors->has('zipcode'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('zipcode') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="zipcode" id="text" placeholder="" value="{{ $detail->zipcode }}" class="form-control" required=""> 
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> State* 
                                        @if ($errors->has('state'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('state') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="state" id="text" placeholder="State" value="{{ $detail->state }}" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Agents Profile URL 
                                        @if ($errors->has('agent_profile_url'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('agent_profile_url') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="agent_profile_url" id="text" placeholder="Agents Profile URL" value="{{ $detail->agent_profile_url }}" class="form-control" > 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Real Estate Firm* 
                                        @if ($errors->has('realestate_firm'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('realestate_firm') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="realestate_firm" id="text" placeholder="Real Estate Firm" value="{{ $detail->realestate_firm }}" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Cell Phone Number 
                                        @if ($errors->has('phone_no'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('phone_no') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="phone_no" id="text" placeholder="Cell Phone Number" value="{{ $detail->phone_no }}" class="form-control"> 
                                    </div>
                                </div>
                             </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Public View Phone 
                                        @if ($errors->has('public_view'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('public_view') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                            <label class="radio-inline">
                                                <input type="radio" class="" <?php if($detail->public_view == 'yes') echo "checked" ?> name="public_view" value="yes">Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" class="" <?php if(!isset($detail->public_view) || $detail->public_view == 'no' || $detail->public_view == 'NULL') echo "checked" ?> name="public_view" value="no">No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                            <div class="label"> Firm logo 
                                            <input type='file' name="firm" class="form-control" onchange="firmURL(this);" /> 
                                            
                                        </div>
                            

                                    </div>
                                </div>
                            </div>
                                 <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                            <div class="label"> Profile Upload* 
                                            <input type='file' name="file" class="form-control" onchange="readURL(this);" /> 
                                        </div>
                                         @if ($errors->has('file'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('file') }} </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> State Licence ID* 
                                        @if ($errors->has('state_licence_id'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('state_licence_id') }} </strong>
                                            </span>
                                        @endif
                                        </div>
                                        <input type="text" name="state_licence_id" id="text" placeholder="" value="{{ $detail->state_licence_id }}" class="form-control" required="" readonly=""> 
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Country* 
                                        </div>
                                        <input type="text" id="text" placeholder="Country" value="USA" class="form-control" readonly=""> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:40px">
                            <div class="col-md-6">
                            <?php $img = $detail->firm_logo; ?>
                                @if($detail->firm_logo !="")
                                    <img src="{{ asset('images/'.$img)}}" height="100" width="100" style="">
                                @else
                                    <img src="{{ asset('images/default/dummy-user.png')}}" height="100" width="100" style="">
                                @endif
                            </div>
                            <div class="col-md-6">
                             <img style="display: none;" height="100" width="100" id="blah" src="#" alt="your image" />
                            </div>
                        </div>
                        <div class="row text-center" style="margin-top: 25px;">
                            <div class="col-md-6 ">
                                <a class="btnSubmit btn" style="margin-top: 3%; width: 100%;background-color: #0e2960;color: #fff;" href="{{url('agent/change-password')}}">
                                    Change Password
                                </a>
                            </div>
                            <div class="col-md-6 ">
                                <input type="submit" class="btnSubmit btn btn-success" value="Update Profile" style="margin-top: 3%; width: 100%;">
                            </div>
                        </div>         
                
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript"> 
function readURL(input) 
{ 
    if (input.files && input.files[0]) 
    { 
        var reader = new FileReader(); 
        reader.onload = function (e) 
        { 
            $('#blah').attr('src', e.target.result); 
            $('#blah').css('display','block');
        } 
        reader.readAsDataURL(input.files[0]); 
    } 
} 
function firmURL(input) 
{ 
    if (input.files && input.files[0]) 
    { 
        var reader = new FileReader(); 
        reader.onload = function (e) 
        { 
            $('#firm').attr('src', e.target.result); 
            $('#firm').css('display','block');
        } 
        reader.readAsDataURL(input.files[0]); 
    } 
} 
</script> 
@endsection