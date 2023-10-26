@extends('admin.layouts.app')

@section('content')

<!-- START BREADCRUMB -->
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
                @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
            <div class="panel-heading">Create User</div>
            <div class="panel-body">

            <form  action="{{ url('admin/users/create') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="fname" class="col-md-2">First Name</label>
                    <div class="col-md-10">
                        <input type="text" name="fname" class="form-control"  placeholder="First Name" value="{{ old('fname') }}" />
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
                        <input type="text" name="lname" value="{{ old('lname') }}" class="form-control"  placeholder="Last Name"/>
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
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email"/>
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
                        <input type="text" name="telephone" class="form-control"  placeholder="Telephone" value="{{ old('telephone') }}" />
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
                        <input type="text" name="phone_no" value="{{old('phone_no')}}" class="form-control"  placeholder="Mobile"/>
                        @if ($errors->has('mobile_no'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('mobile_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="col-md-2">Address</label>
                    <div class="col-md-10">
                        <input type="text" name="address" value="{{old('address')}}" class="form-control"  placeholder="Address"/>
                        @if ($errors->has('address'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="Zipcode" class="col-md-2">City Name</label>
                    <div class="col-md-10">
                        <input type="text" name="city_name" value="{{old('city_name')}}" class="form-control"  placeholder="City Name"/>
                        @if ($errors->has('city_name'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('city_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                <div class="form-group">
                    <label for="Zipcode" class="col-md-2">Zipcode</label>
                    <div class="col-md-10">
                        <input type="text" name="zipcode" value="{{old('zipcode')}}" class="form-control"  placeholder="Zipcode"/>
                        @if ($errors->has('zipcode'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('zipcode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="Role" class="col-md-2">Role</label>
                    <div class="col-md-10">
                        <select type="text" name="role" class="form-control" id="create_role">
                            <option value="3" @if(old("role") == "3") selected="selected" @endif >Agent</option> 
                            <option value="2" @if(old("role") == "2") selected="selected" @endif >Office Admin</option>
                        </select>
                        @if ($errors->has('role'))
                            <span class="help-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                 <div class="form-group">
                    <label for="agent_profile_url" class="col-md-2">Agents Profile URL</label>
                    <div class="col-md-10">
                        <input type="text" name="agent_profile_url" class="form-control"  placeholder="Agents Profile URL" value="{{ old('agent_profile_url') }}"/>
                        @if ($errors->has('agent_profile_url'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('agent_profile_url') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                  <label for="Role" class="col-md-2">State Licence ID</label>
                    <div class="col-md-10">
                                <input type="text" name="state_licence_id" class="form-control fieldsize" placeholder="State Licence ID" value="{{ old('state_licence_id')}}" autofocus="" required="">
                                @if ($errors->has('state_licence_id'))
                                                <span class="help-block">
                                                    <strong class="mleft">{{ $errors->first('state_licence_id') }}</strong>
                                                </span>
                                            @endif
                        </div>
                        </div> 
                        <div class="form-group">
                          <label for="Role" class="col-md-2">Realestate Firm</label>
                          <div class="col-md-10">                   
                                <input type="text"  name="realestate_firm" class="form-control fieldsize space" placeholder="Real Estate Firm" value="{{ old('realestate_firm')}}" autofocus="" required="">
                                @if ($errors->has('realestate_firm'))
                                                <span class="help-block">
                                                    <strong class="mleft">{{ $errors->first('realestate_firm') }}</strong>
                                                </span>
                                            @endif
                            </div>
                            </div>
                <div class="form-group">
                    <label for="Password" class="col-md-2 required">Password</label>
                    <div class="col-md-10">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password"/>
                        @if ($errors->has('password'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="ConfirmPassword" class="col-md-2 required">Confirm Password</label>
                    <div class="col-md-10">
                        <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password"/>
                        @if ($errors->has('cpassword'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('cpassword') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-2">Profile Image</label>
                    <div class="col-md-10">
                        <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/*">
                        @if ($errors->has('profile_image'))
                            <span class="help-inline">
                                <strong>{{ $errors->first('profile_pic') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block" id="craete_idValid">Create</button>
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
    
</script>

@endsection