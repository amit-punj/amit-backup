@extends('admin.layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                    Tours Password List
                       <!--  <span class="float-right">
                            <a href="{{url('admin/tours/create')}}">
                                <button class="btn btn-success">Add New</button>
                            </a>
                        </span> -->
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->

                    <div class="clearfix"></div>
                    @if(count($tours))
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>#</th>
                                <th>Tour Name</th>
                                <th>Tour Owner</th>
                                <th>Current Password</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($tours as $tour)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$tour->tour_name}}</td>
                                        <td>{{$tour->name}}</td>
                                        <td>{{$tour->current_password}}</td>
                                        <td>
                                            <a href='{{ url("admin/tours/{$tour->tour_id}/password_list") }}' title="Update Password" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p>No Tour found here !</p>
                    @endif

                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>

@endsection
