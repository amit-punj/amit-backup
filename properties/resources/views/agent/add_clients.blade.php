@extends('layouts.main')
@section('content')
<style type="text/css">
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
.help-block{
    color: red;
}
div#main {
    background-color: #f3f3f3;
}
span{

}
.btnflex{
    display: flex;
}
.form-content {
    background-color: white;
    border-style: none;
}
input.form-control {
    border-left-color: #4fad26;
    border-left-width: thick;
    background-color: #f3f3f3;
    border-radius: unset;
}
form {
	padding: 50px;
}
strong.ab{
    color: red;
}
@media screen and (max-width: 414px)
{
    form{
        padding: 3px;
        margin-top: 3%;
    }
    .btnflex{
        display: unset;
    }
    .btn{
        margin-top: 3%;
    }
}
</style>
<div class="container">
	<div class="row m-0">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>
		<div class="col-md-9 setmd">
				 <div class="note"><p style="font-size: 22px;">  Add  <span style="color: #41ac1b">  Your  </span> Client </p>
		         </div>
		         <div class="row">
         <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @elseif(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
            @if(Session::has('flash_message_email'))
            <div class="alert alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong class="ab">{!! session('flash_message_email') !!}</strong>
            </div>
            @endif
           <div class="form-content">
            <form id="form_submit" action="{{url('agent/add/client')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                 <div class="col-md-12"><label>First Name *</label></div>
                    <div class="col-md-10">
                        <input type="text" name="fname" class="form-control" value="{{ old('fname') }}" placeholder="First Name" required="" />
                        @if ($errors->has('fname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if(isset($id))
                  <input type="hidden" name="user_id" value="{{ $id }}">
                @endif
                <div class="form-group">
                 <div class="col-md-12"><label>Last Name *</label></div>
                    <div class="col-md-10">
                        <input type="text" name="lname" class="form-control" value="{{ old('lname') }}" placeholder="Last Name" required="" />
                        @if ($errors->has('lname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                 <div class="col-md-12"><label>Email </label></div>
                    <div class="col-md-10">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" />
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                 <div class="col-md-12"><label>Phone </label></div>
                    <div class="col-md-10">
                        <input type="number" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile No"/>
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="col-md-10">
                        <input type="file" name="client_image" id="client_image" class="form-control">
                        @if ($errors->has('client_image'))
                            <span class="help-inline">
                                <strong>{{ $errors->first('client_image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> -->
                <div class="form-group btnflex">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block" style="background-color: green; border:none;" id="btnsub">Add Client</button>
                    </div>
                    <div class="col-md-offset-2 col-md-5">
                        <a href="{{ url('agent-dashboard')}}" style="background-color: #0e2a60 !important; border:none;" class="btn btn-info btn-block">Cancel</a>
                    </div>
                </div>
                </form>
            </div>    
         
        </div>
        </div>
    </div>
		</div>
	</div>         
</div>

@endsection