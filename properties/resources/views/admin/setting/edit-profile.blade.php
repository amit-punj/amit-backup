@extends('admin.layouts.app')

@section('content')

<div id="edit_profile">
	<ul class="breadcrumb">
	  <li><a href="#">Home</a></li>                    
	  <li class="active">Edit Profile</li>
	</ul>
	<div class="page-content-wrap">

		<div class="row">
		  <div class="col-md-12">
		    <h2>Profile</h2>
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
		  </div>
		</div>

		<div class="content-main-edit">
			<div class="row well">
				<div class="col-md-12">
		          <form class="form-horizontal" method="post" action="{{ url('/admin/edit-profile') }}" name="basic_validate" id="edit-profile-form" enctype="multipart/form-data" novalidate="novalidate">{{ csrf_field() }}
		              <div class="form-group row">
		                <label class="col-sm-2 control-label">User Name</label>
		                <div class="col-sm-10">
		                  <input type="text" disabled="disabled" name="name" class="form-control" id="name" value="{{ $AdminDetails->name }}">
		                </div>
		              </div>
		              <div class="form-group row">
		                <label class="col-sm-2 control-label">Email</label>
		                <div class="col-sm-10">
		                  <input type="email" name="email" class="form-control" id="email" value="{{ $AdminDetails->email }}">
		                  @if ($errors->has('email'))
		                    <span class="help-inline">
		                        <strong>{{ $errors->first('email') }}</strong>
		                    </span>
		                 @endif
		                </div>
		              </div>
		              <div class="form-group row">
		                <label class="col-sm-2 control-label">Profile Upload </label>
		                <div class="col-sm-10">
		                 <input type="file" name="file" accept="image/*" class="form-control" onchange="readURL(this);">
		                  @if ($errors->has('file'))
		                    <span class="help-inline">
		                        <strong>{{ $errors->first('file') }}</strong>
		                    </span>
		                 @endif
		                </div>
		              </div>
		              <div class="form-group row">
		              <label class="col-sm-2 control-label"></label>
		                <div class="col-md-10">
		                <?php 
		                   	$profile =Auth::user()->profile_pic;
	                        if(is_null($profile))
	                        {
	                            $profile = "default/no-image.jpg"; 
	                        }
		                ?>
                         <img style="" height="100" width="100" id="blah" src='{{ asset("images/{$profile}") }}' alt="your image" />
                        </div>
		              </div>
		              <div class="form-group row">
		                <label class="col-sm-2 control-label">Old Password</label>
		                <div class="col-sm-10">
		                  <input type="password" name="password" class="form-control" id="password">
		                </div>
		              </div>
		              <div class="form-group row">
		                <label class="col-sm-2 control-label">New Password</label>
		                <div class="col-sm-10">
		                  <input type="password" name="new_password" class="form-control" id="new_password">
		                  @if ($errors->has('new_password'))
		                    <span class="help-inline">
		                        <strong>{{ $errors->first('new_password') }}</strong>
		                    </span>
		                  @endif
		                </div>
		              </div>
		              <div class="form-group row">
		                <label class="col-sm-2 control-label">Confirm Password</label>
		                <div class="col-sm-10">
		                  <input type="password" name="confirm_password" class="form-control" id="confirm_password">
		                  @if ($errors->has('confirm_password'))
		                    <span class="help-inline">
		                        <strong>{{ $errors->first('confirm_password') }}</strong>
		                    </span>
		                  @endif
		                </div>
		              </div>

		              <div class="form-actions pull-right">
		              <input type="submit" value="Update" id="profile-update" class="btn btn-success">
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
{ if (input.files && input.files[0]) 
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
</script> 
@endsection