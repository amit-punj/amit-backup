@extends('admin.layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                    Users List
                        <span class="float-right">
                            <a href="{{url('admin/users/create')}}">
                                <button class="btn btn-success">Add New</button>
                            </a>
                        </span>
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->

                    <div class="clearfix"></div>

                    @if(count($users))
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if($user->role == 1)
                                                Admin
                                            @else
                                                Client 
                                            @endif
                                        </td>
                                        <td>{{$user->created_at}}</td>
                                        <td>
                                            <a href='{{ url("admin/users/{$user->id}/update") }}' class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href='{{ url("admin/users/{$user->id}/delete") }}' onclick="return confirm('Are you sure to delete this user?')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p>No users found here !</p>
                    @endif

                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>

@endsection
