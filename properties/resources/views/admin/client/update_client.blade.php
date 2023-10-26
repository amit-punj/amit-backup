@extends('admin.layouts.app')
@section('content')

<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB --> 


<div class="page-content-wrap">
<div class="clearfix"></div>
<!-- START WIDGETS -->                    
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Update Client</div>
            <div class="panel-body">
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
            <form id="form_submit" action='{{url("admin/client/{$slider_detail->id}/update")}}' class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="fname" class="col-md-2 required">First Name</label>
                    <div class="col-md-10">
                        <input type="text" name="fname" class="form-control" value="{{$slider_detail->fname }}" placeholder="First Name"/>
                        @if ($errors->has('fname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-md-2 required">Last Name</label>
                    <div class="col-md-10">
                        <input type="text" name="lname" class="form-control" value="{{ $slider_detail->lname }}" placeholder="Last Name"/>
                        @if ($errors->has('lname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-2 required">Email</label>
                    <div class="col-md-10">
                        <input type="text" name="email" class="form-control" value="{{ $slider_detail->email }}" placeholder="Email"/>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="col-md-2 required">Mobile No</label>
                    <div class="col-md-10">
                        <input type="text" name="mobile" class="form-control" value="{{ $slider_detail->mobile }}" placeholder="Mobile No"/>
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block" id="btnsub">Update Client</button>
                    </div>
                    <div class="col-md-offset-2 col-md-5">
                        <a href="#" style="margin-left: -53%; background-color: black !important;" class="btn btn-info btn-block">Cancel</a>
                    </div>
                </div>
                </form>
         
        </div>
        </div>
    </div>
</div>
<!-- END WIDGETS -->                    
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnsub").click(function(){
            $("#form_submit").submit();
        });
    });
</script>
@endsection
