@extends('admin.layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Create Variation
                        <span class="float-right">
                            <a href='{{ url("admin/tours") }}'>Back To Tour List</a>
                        </span>
                    </h6>
                </div>
                
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form  action='{{ url("admin/tours/{$tour->id}/add_variation") }}' class="form-horizontal" method="post" role="form" id="create_formmcc" enctype="multipart/form-data" >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="tour_name" class="col-md-2">Variation Name</label>
                            <div class="col-md-10">
                                <input type="hidden" id="tour_id" name="tour_id" class="form-control" value="{{$tour->id}}" />
                                <input type="hidden" id="url" name="url" class="form-control" value="{{url()->previous()}}" />
                                <input type="text" id="variation_name" name="variation_name" class="form-control"  placeholder="Variation Name"/>
                                @if ($errors->has('variation_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('variation_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5">
                                <button class="btn btn-info btn-block" type="submit" id="craete_idValid">Create</button>
                            </div>
                           <!--  <div class="col-md-6">
                               <a href="{{ url('admin/users') }}"><button type="button" class="btn btn-primary btn-block">Cancel</button></a>
                            </div> -->
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <!-- @if(count($variation_details))
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
                    @endif -->
                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>
@endsection



