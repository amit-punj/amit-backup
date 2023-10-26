@extends('layouts.main')
@section('content')
<style type="text/css">
.btn{
    border:none;
}
.help-block{
    color: red;
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
.set_img{
        height: 108px;
    margin-top: 2%;
    margin: 2%;
}
@media screen and (max-width: 420px){
    form{
        padding: 17px;
    }
#flex_btn{
    display: unset !important;
}
.btn{
    margin: 5px;
}
.set_img{
        width: 100%;
    }
}
</style>
<div class="container">
  <div class="row m-0">
    <div class="col-md-3 setmd">
      @include('dashboard.dashboard-sidebar')
    </div>
    <div class="col-md-9 setmd">
    @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
    <div class="note"><p style="font-size: 22px;"> Update <span style="color: #41ac1b">Client </span></p>
    </div>
    @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @elseif(Session::has('flash_message_error'))
            <div class="alert alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
        <div class="form-content">    
            <form id="form_submit" action="{{url('agent/client/'.$slider_detail->id.'/edit_agent')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="fname" class="col-md-12 required">First Name *</label>
                    <div class="col-md-10">
                        <input type="text" name="fname" class="form-control" value="{{$slider_detail->fname }}" placeholder="First Name" required="" />
                        @if ($errors->has('fname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-md-12 required">Last Name *</label>
                    <div class="col-md-10">
                        <input type="text" name="lname" class="form-control" value="{{ $slider_detail->lname }}" placeholder="Last Name" required=""/>
                        @if ($errors->has('lname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-12 required">Email </label>
                    <div class="col-md-10">
                        <input type="email" name="email" class="form-control" value="{{ $slider_detail->email }}" placeholder="Email" />
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="col-md-12 required">Mobile No</label>
                    <div class="col-md-10">
                        <input type="number" name="mobile" class="form-control" value="{{ $slider_detail->mobile }}" placeholder="Mobile No"/>
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group" id="flex_btn" style="display: flex;">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block" id="btnsub" style="background-color: green;">Update Client</button>
                    </div>
                    <div class="col-md-offset-2 col-md-5">
                        <a href="#" style="background-color: #0e2a60 !important;" class="btn btn-info btn-block">Cancel</a>
                    </div>
                </div>
                </form>
            </div>    
  </div>
</div>
</div> 
@endsection   