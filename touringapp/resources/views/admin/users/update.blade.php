@extends('admin.layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Update User
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form action='{{ url("admin/users/{$user->id}/update") }}'   class="form-horizontal" method="post" role="form" id="create_formmcc" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="fname" class="col-md-2">First Name</label>
                        <div class="col-md-10">
                            <input type="text" name="fname" class="form-control" value="{{ old('fname',$user->fname ) }}"  placeholder="First Name"/>
                            @if ($errors->has('fname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="flname" class="col-md-2">Last Name</label>
                        <div class="col-md-10">
                            <input type="text" name="lname" class="form-control" value="{{ old('lname',$user->lname ) }}"  placeholder="Last Name"/>
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
                            <input type="text" readonly="" name="email" class="form-control" value="{{ old('email', $user->email) }}" placeholder="Email"/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="Role" class="col-md-2">Role</label>
                        <div class="col-md-10">
                            <select type="text" name="role" class="form-control" id="create_role">
                               <option value="1" {{ ($user->role == 1)?'selected':''}} >Admin</option> 
                                 <option value="10" {{ ($user->role == 10)?'selected':''}} >Client</option> 
                            </select>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> -->
                   

                    <div class="form-group">
                        <label for="web_address" class="col-md-2">Company</label>
                        <div class="col-md-10">
                            <select type="text" name="company" class="form-control" id="company">
                                <option value="no" {{ ($user->company == 'no')?'selected':''}}  >No</option> 
                                <option value="yes" {{ ($user->company == 'yes')?'selected':''}}  >Yes</option>
                            </select>
                            @if ($errors->has('company'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="extra_field_show_hide company_details" {{($user->company == 'no')?"style=display:none;":""}}  >
                        <div class="form-group company_details">
                            <label for="web_address" class="col-md-2">Company Name</label>
                            <div class="col-md-10">
                                <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}" id="company_name" class="form-control"  placeholder="Company Name"/>
                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group company_details">
                            <label for="abn_no" class="col-md-2">Company Address</label>
                            <div class="col-md-10">
                                <input type="text" name="company_address" value="{{ old('company_address', $user->company_address) }}" id="company_address" class="form-control"  placeholder="Company Address"/>
                                @if ($errors->has('company_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group company_details" style="margin-bottom: 15px;">
                            <label for="agent_id" class="col-md-2">Comapny VAT</label>
                            <div class="col-md-10">
                                <input type="text" name="company_vat" value="{{ old('company_vat', $user->company_vat) }}" class="form-control"  placeholder="Comapny VAT"/>
                                @if ($errors->has('company_vat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_vat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                    </div>                    
                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="password"/>
                            @if ($errors->has('password'))
                                <span class="help-block">
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
                                <span class="help-block">
                                    <strong>{{ $errors->first('cpassword') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
                            <button class="btn btn-info btn-block" id="craete_idValid">Update</button>
                        </div>
                       <!--  <div class="col-md-6">
                           <a href="{{ url('admin/users') }}"><button type="button" class="btn btn-primary btn-block">Cancel</button></a>
                        </div> -->
                    </div>
                </form>

                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>

@endsection
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#company").change(function(){
            if(jQuery(this).val() == 'yes')
            {
                jQuery('.company_details').show();
            }
            else
            {
                jQuery('.company_details').hide();
            }
        });
    });
</script>
@endsection