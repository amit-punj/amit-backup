@extends('admin.layouts.app')
@section('content')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB --> 

<div class="page-content-wrap">

<!-- START WIDGETS -->                    
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">update user</div>
                  @if(Session::has('flash_message'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>{!! session('flash_message') !!}</strong>
                        </div>
                    @endif
            <div class="panel-body">
             
            <form  action='{{ url("updateuser/{$user->id}")}}' class="form-horizontal" method="post" role="form" id="create_formm1" enctype="multipart/form-data">
                {{ csrf_field() }}

               
                <div class="form-group">
                    <label for="fname" class="col-md-2">First Name</label>
                    <div class="col-md-10">
                        <input type="text" name="fname" class="form-control"  placeholder="First Name" value="{{ old('fname',$user->fname ) }}"/>
                        @if ($errors->has('fname'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('fname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="flname" class="col-md-2">Last Name</label>
                    <div class="col-md-10">
                        <input type="text" name="lname" class="form-control"  placeholder="Last Name" value="{{ old('lname',$user->lname ) }}"/>
                        @if ($errors->has('lname'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

               <div class="form-group">
                    <label for="email" class="col-md-2 required">Email</label>
                    <div class="col-md-10">
                        <input type="text" name="email" class="form-control" value="{{ old('email',$user->email ) }}" placeholder="Email"/>
                        @if ($errors->has('email'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="Telephone" class="col-md-2">Telephone</label>
                    <div class="col-md-10">
                        <input type="text" name="telephone" class="form-control"  placeholder="Telephone" value="{{ old('phone_no',$user->telephone) }}"/>
                        @if ($errors->has('phone_no'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('phone_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="Mobile" class="col-md-2">Mobile</label>
                    <div class="col-md-10">
                        <input type="text" name="phone_no" class="form-control"  placeholder="Mobile No" value="{{ old('mobile_no',$user->phone_no ) }}"/>
                        @if ($errors->has('mobile_no'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('phone_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="col-md-2">Address</label>
                    <div class="col-md-10">
                        <input type="text" name="address" class="form-control"  placeholder="Address" value="{{ old('address',$user->address ) }}"/>
                        @if ($errors->has('address'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="Zipcode" class="col-md-2">Zipcode</label>
                    <div class="col-md-10">
                        <input type="text" name="zipcode" class="form-control"  placeholder="Zipcode" value="{{ old('zipcode',$user->zipcode ) }}"/>
                        @if ($errors->has('zipcode'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('zipcode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="agent_profile_url" class="col-md-2">Agents Profile URL</label>
                    <div class="col-md-10">
                        <input type="text" name="agent_profile_url" class="form-control"  placeholder="Agents Profile URL" value="{{ old('agent_profile_url',$user->agent_profile_url ) }}"/>
                        @if ($errors->has('agent_profile_url'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('agent_profile_url') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="state_licence_id" class="col-md-2">State Licence ID</label>
                    <div class="col-md-10">
                        <input type="text" name="state_licence_id" class="form-control"  placeholder="State Licence ID" value="{{ old('state_licence_id',$user->state_licence_id ) }}"/>
                        @if ($errors->has('state_licence_id'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('state_licence_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="realestate_firm" class="col-md-2">Real Estate Firm</label>
                    <div class="col-md-10">
                        <input type="text" name="realestate_firm" class="form-control"  placeholder="Real Estate Firm" value="{{ old('realestate_firm',$user->realestate_firm ) }}"/>
                        @if ($errors->has('realestate_firm'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('realestate_firm') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
               
                  <div class="form-group">
                    <label for="Role" class="col-md-2">Choose Role</label>
                    <div class="col-md-10">
                        <select type="text" name="role" class="form-control" id="create_role">
                            <option value="3" <?php if($user->role == 3 ) echo "selected"; ?> >Agent</option>
                            <option value="2" <?php if($user->role == 2 ) echo "selected"; ?> >Office Admin</option>
                        </select>
                        @if ($errors->has('role'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="new_password" class="form-control" id="new_password">
                      @if ($errors->has('new_password'))
                        <span class="help-inline">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                      @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                      @if ($errors->has('confirm_password'))
                        <span class="help-inline">
                            <strong>{{ $errors->first('confirm_password') }}</strong>
                        </span>
                      @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">Profile Image</label>
                    <div class="col-md-10">
                        <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/*">
                        @if ($errors->has('profile_pic'))
                            <span class="help-inline" style="color: red;">
                                <strong>{{ $errors->first('profile_pic') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block">Update</button>
                    </div>
                    <div class="col-md-5">
                        <a href="{{ url('allusers') }}"><button type="button" class="btn btn-primary btn-block">Cancel</button></a>
                    </div>
                </div>
            </form>
            </div>
            </div>
            </div>
            </div>
@endsection