@extends('adminlayouts.app')

@section('content')
<style type="text/css">
  .filter_form{
    margin-left: 3%;
    margin-bottom: 12px;
  }
  .btn-filter
  {
    margin-top: 2%;
    width: 40%;
  }
  .btn-reset
  {
    margin-top: 2%;
    width: 40%;
  }
  select.input-group-text{
    width: 80%;
  }
</style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> List of All Users</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="{{url('/admin/listusers')}}">All Users</a></li>
        </ul>
      </div>
       @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
      @endif
      <div class="row">
         <div class="col-md-6">
        <form class="filter_form" name="filter" action="{{url('filter/user')}}" method="post">
        {{ csrf_field() }}
        <label>Search Filter </label>
        <select name="status_search" class="input-group-text">
          <option value="">--Select Role--</option>
          <option value="1" <?php if(isset($role) && $role == 1) echo "selected"; ?>>Tenant</option>
          <option value="2" <?php if(isset($role) && $role == 2) echo "selected"; ?>>Property owner</option>
          <option value="3" <?php if(isset($role) && $role == 3) echo "selected"; ?>>Property manager</option>
          <option value="4" <?php if(isset($role) && $role == 4) echo "selected"; ?>>Property description expert</option>
          <option value="5" <?php if(isset($role) && $role == 5) echo "selected"; ?>>Legal advisor</option>
          <option value="6" <?php if(isset($role) && $role == 6) echo "selected"; ?>>Visit organizer</option>
          <!-- <option value="4">Customers</option> -->
        </select>
        <input type="submit" class="btn btn-success btn-filter" name="filter" value="Filter">
        <a href="{{ url('admin/listusers') }}">
          <button type="button" class="btn btn-danger btn-reset" name="reset" value="Reset">Reset</button>
        </a>
         </form>
      </div>
      </div>
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="list_cms_pages">
                <thead>
                  <tr>
                    <th>UserId</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>type</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)                     
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->name }} {{ $user->last_name }}</td>
                      <td>{{ $user->email }}</td>
                      @if ($user->user_role == 0)
                         <td>Admin</td>
                      @elseif($user->user_role == 1)
                          <td>Tenant</td>
                      @elseif($user->user_role == 2)
                          <td>Property Owner</td>
                      @elseif($user->user_role == 3)
                          <td>Property Manager</td>
                      @elseif($user->user_role == 4)
                          <td>Property Description Experts</td>
                      @elseif($user->user_role == 5)
                          <td >Legal Advisor</td>
                      @elseif($user->user_role == 6)
                          <td >Visit Organizer</td>
                      @else
                          <td>Not Define</td>
                      @endif
                      <td>{{ $user->created_at }}</td>
                      <td><a href="{{ url('/admin/edituser/'.$user->id) }}">Edit</a> / <a href="{{ url('/admin/deleteuser/'.$user->id) }}">Delete</a></td>
                    </tr>
                  @endforeach                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <style type="text/css">div#list_cms_pages_filter {display: none; }</style>
    </main>
@endsection
@section('scripts')
<script>
//   $('.table').DataTable({
//     order: [ [0, 'desc'] ]
// })

</script>

@endsection
