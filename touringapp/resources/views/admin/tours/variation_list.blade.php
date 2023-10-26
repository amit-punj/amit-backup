@extends('admin.layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Variation List
                        <span class="float-right">
                            <a href='{{ url("admin/tours") }}'>Back To Tour List</a>
                            <a href='{{ url("admin/tours/{$tour->id}/add_variation") }}'>
                                <button class="btn btn-success">Add New</button>
                            </a>
                        </span>
                    </h6>
                </div>
                
                <div class="card-body">
                    <!-- START WIDGETS -->
                <div class="clearfix"></div>
                    @if(count($variation_details))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <th>#</th>
                                    <th>Tour Name</th>
                                    <th>Variation Name</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($variation_details as $variation)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$tour->tour_name}}</td>
                                            <td>{{$variation->variation_name}}</td>
                                            <td>{{$variation->created_at}}</td>
                                            <td>
                                                <a href='{{ url("admin/tours/{$variation->id}/edit_variation") }}' title="Edit" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href='{{ url("admin/tours/{$variation->id}/delete_variation") }}' onclick="return confirm('Are you sure to delete this Variation?')" title="Delete" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
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



