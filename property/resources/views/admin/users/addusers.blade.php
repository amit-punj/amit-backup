@extends('adminlayouts.app')

@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Add User</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <!-- <li class="breadcrumb-item">Forms</li> -->
          <li class="breadcrumb-item"><a href="{{url('/admin/newuser')}}">Add User</a></li>
        </ul>
      </div>
      @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
      @endif
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <!-- <h3 class="tile-title">Vertical Form</h3> -->
            <div class="tile-body">
              <form method="post" action="{{url('/admin/createnewuser')}}" id="create_user">
                @csrf
                <div class="form-group">
                  <label class="control-label">First Name</label>
                  <input class="form-control" type="text" placeholder="Enter First Name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('name') }} </strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Last Name</label>
                  <input class="form-control" type="text" placeholder="Enter Last Name" name="last_name" value="{{ old('last_name') }}">
                    @if ($errors->has('last_name'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('last_name') }} </strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input class="form-control" type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('email') }} </strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">User Role</label>
                    <select class="form-control" name="user_role">
                      <option value="1">Tenant</option>
                      <option value="2">Property Owner</option>
                      <option value="3">Property Manager</option>
                      <option value="4">Property Description Experts</option>
                      <option value="5">Legal Advisor</option>
                      <option value="6">Visit Organizer</option>
                    </select>
                  </div>
                <div class="form-group">
                  <label class="control-label">Password</label>
                  <input class="form-control" type="text" placeholder="Enter Password" name="password" value="vision@123">
                    @if ($errors->has('password'))
                       <span class="help-block" style="color: red;">
                           <strong>{{ $errors->first('password') }} </strong>
                       </span>
                    @endif
                </div>
                 <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
              </div>
              </form>
            </div>
           
          </div>
        </div>
        <div class="clearix"></div>
      </div> 
    </main>
    <script type="text/javascript">
      jQuery('#create_user').validate({
              errorClass:"red",
              validClass:"green",
              rules:{
                  name:{
                    required:true,
                    minlength:4,
                  },
                  last_name:{
                    required:true,
                    minlength:4,
                  },
                  email:{
                    required:true,
                    email: true,
                  },
                  password:{
                    required:true,
                  }
              }      
          });
    </script>
    <style>.popover-content.note-children-container {display: none; } label.red {color: red; }</style>
@endsection
