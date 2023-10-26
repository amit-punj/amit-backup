@extends('admin.layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Update Variation
                         <span style="float: right;"><a href='{{ url("admin/tours") }}'>Back To Tour List</a></span>
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form  action='{{ url("admin/tours/{$variation_details->id}/edit_variation") }}' class="form-horizontal" method="post" role="form" id="create_formmcc" enctype="multipart/form-data" >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="tour_name" class="col-md-2">Variation Name</label>
                            <div class="col-md-10">
                                <input type="hidden" id="tour_id" name="tour_id" class="form-control" value="{{$variation_details->tour_id}}" />
                                <input type="hidden" id="url" name="url" class="form-control" value="{{url()->previous()}}" />
                                <input type="text" id="variation_name" name="variation_name" class="form-control"  placeholder="Variation Name" value="{{$variation_details->variation_name}}" />
                                @if ($errors->has('variation_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('variation_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5">
                                <button class="btn btn-info btn-block" type="submit" id="craete_idValid">Update</button>
                            </div>
                        </div>
                    </form>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>
@endsection



