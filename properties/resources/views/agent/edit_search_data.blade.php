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
		 @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
         @endif
				 <div class="note"><p style="font-size: 22px;">  Edit  <span style="color: #41ac1b">  Search  </span> Data </p>
		         </div>
            <!-- edit form -->
           <div class="form-content">
            <form id="form_submit" action="{{url('agent/update/search/'.$data->id)}}" class="form-horizontal" method="post">
                {{ csrf_field() }}
                
                <div class="form-group">
                 <div class="col-md-12"><label>Title *</label></div>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" value="{{ $data->title }}" placeholder="Title" required="" />
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                 <div class="col-md-12"><label>URL *</label></div>
                    <div class="col-md-10">
                        <textarea class="form-control" cols="4" rows="4" readonly="" />{{ $data->url}}</textarea>
                        @if ($errors->has('url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group btnflex">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block" style="background-color: green; border:none;" id="btnsub">Update</button>
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
@endsection