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
            <div class="panel-heading">Add Slider</div>
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
            <form id="form_submit" action="{{url('admin/add/slider')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username" class="col-md-2 required">Title</label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Title"/>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-2 required">Description</label>
                    <div class="col-md-10">
                    <textarea class="form-control" rows="5" name="description" placeholder="Write about your description"></textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="search_bar" class="col-md-2 required">Show Search Bar</label>
                    <div class="col-md-10">
                        <div style="margin-right: 2%; display: -webkit-box;">
                          <input type="radio" name="search_bar" id="search_bar" value="1">Yes 
                         <div style="margin-left: 2%; margin-right: 2%;">
                         <input type="radio" name="search_bar" id="search_bar" value="0" checked="">No</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">Slider Image</label>
                    <div class="col-md-10">
                        <input type="file" name="slider_image" id="slider_image" class="form-control">
                        @if ($errors->has('slider_image'))
                            <span class="help-inline">
                                <strong>{{ $errors->first('slider_image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">Status</label>
                    <div class="col-md-10">
                         <select class="user_id form-control" name="status" id="status">
                            <option value="Active">Active</option>
                            <option value="InActive">InActive</option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="help-inline">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
               
                <div class="form-group" style="display: flex;">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block" id="btnsub">Add Slider</button>
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
