 @extends('adminlayouts.app')
@section('content')
 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Edit Profile</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <!-- <li class="breadcrumb-item">Forms</li> -->
          <li class="breadcrumb-item"><a href="{{url('admin/edit-profile')}}">Edit Profile</a></li>
        </ul>
      </div>
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

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <!-- <h3 class="tile-title">Vertical Form</h3> -->
            <div class="tile-body">
              <form method="post" action="{{url('admin/edit-profile')}}" id="create_user" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input class="form-control" type="text" placeholder="Enter Name" name="name" value="{{ Auth::user()->name }}">
                    @if ($errors->has('name'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('name') }} </strong>
                       </span>
                    @endif
                </div>
                 <div class="form-group">
                  <label class="control-label">Phone Number</label>
                  <input class="form-control" type="number" min="10" placeholder="Phone Number" name="phone_no" value="{{ old('phone_no',Auth::user()->phone_no) }}">
                    @if ($errors->has('phone_no'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('phone_no') }} </strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input class="form-control" type="text" placeholder="Enter Email" name="email" value="{{ old('email',Auth::user()->email) }}">
                    @if($errors->has('email'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('email') }} </strong>
                       </span>
                    @endif
                </div>
                 <div class="form-group">
                  <label class="control-label">Profile Pic</label>
                  <input class="form-control" type="file" accept="images/*" name="image" onchange="readURL(this);">
                    <?php 
		                   	$profile =Auth::user()->image;
	                        if(is_null($profile))
	                        {
	                            $profile = "images/dummy-user.png"; 
	                        }
                          else{
                            $profile = 'images/'.Auth::user()->image;
                          }
		                ?>
                         <img style="" height="100" width="100" id="blah" src='{{ asset("{$profile}") }}' alt="your image" />
                    @if ($errors->has('image'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('image') }} </strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Old Password</label>
                  <input class="form-control" type="password" placeholder="Old Password" name="old_password" >
                    @if ($errors->has('old_password'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('old_password') }} </strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                  <label class="control-label">New Password</label>
                  <input class="form-control" type="password" placeholder="New Password" name="new_password" >
                    @if ($errors->has('new_password'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('new_password') }} </strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Confirm Password</label>
                  <input class="form-control" type="password" placeholder="Confirm Password" name="cpassword" >
                    @if ($errors->has('cpassword'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('cpassword') }} </strong>
                       </span>
                    @endif
                </div>
                 <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
              </div>
              </form>
            </div>
           
          </div>
        </div>
        <div class="clearix"></div>
      </div> 
  </main>
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