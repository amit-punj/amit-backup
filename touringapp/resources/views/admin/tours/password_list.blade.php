@extends('admin.layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Password List
                        <span class="float-right">
                            <!-- <a href='{{ url("admin/tours") }}'>Back To Tour List</a> -->
                            <a href='{{ url("admin/tours/{$tour->id}/add_password") }}'>
                                <button class="btn btn-success">Add New</button>
                            </a>
                        </span>
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                <div class="clearfix"></div>
                    @if(count($password_details))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <th>#</th>
                                    <th>Tour Name</th>
                                    <th>Password Type</th>
                                    <th>Password Duration</th>
                                    <th>Current password</th>
                                    <th>Password</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($password_details as $variation)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$tour->tour_name}}</td>
                                            <td>{{ ucfirst($variation->set_password) }}</td>
                                            <td>{{ ucfirst($variation->password_type) }}</td>
                                            <td>{{$variation->current_password}}</td>
                                            <td>{{$variation->password}}</td>
                                            <td>{{$variation->created_at}}</td>
                                            <td>
                                                <a href='{{ url("admin/tours/{$variation->id}/edit_password") }}' title="Edit" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href='{{ url("admin/tours/{$variation->id}/delete_password") }}' onclick="return confirm('Are you sure to delete this Password?')" title="Delete" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No Password found for this Tour!</p>
                    @endif
                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>
@endsection



