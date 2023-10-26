@extends('admin.layout.base')

@section('title', 'Add Area ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.areaservice.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.areaservice.Add_Area')</h5>

            <form class="form-horizontal" action="{{route('admin.areaservice.store')}}" method="POST" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label">City Name</label>
                    <input name="latitude" id="latitude" type="hidden" value="{{ old('latitude') }}">
                    <input name="longitude" id="longitude" type="hidden" value="{{ old('longitude') }}">
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="autocomplete" name="name" placeholder="Enter Address" value="{{ old('name') }}">
                        <span class="errors" id="error_name"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit" class="col-md-12 required">Unit Measurement</label>
                    <div class="col-md-10">
                        <select type="text" name="unit" class="form-control" id="unit">
                            <option value="" disabled selected>Select Distance Unit</option>
                            <option value="1">In Kilometers</option>
                            <option value="2">In Miles</option>
                        </select>
                        <span class="errors" id="error_unit"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_type" class="col-md-12 required">Service Type</label>
                    <div class="col-md-10">
                        <input type="radio" name="service" id="service0" value="0" checked="" /> Pick
                        <input type="radio" name="service" id="service1" class="ml-5" value="1"/> Drop
                        <input type="radio" name="service" id="service2" class="ml-5" value="2"/> Pick
                        & Drop
                        <span class="errors" id="error_service"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">@lang('admin.areaservice.Add_Area'
                                )</button>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="{{ route('admin.areaservice.index') }}" class="btn btn-danger btn-block">@lang('admin.cancel')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script>
$(document).ready(function(){
    $("#hour_price").hide();
    $("#calculator").change(function(){
        if($("#calculator").val() == 'DISTANCEHOUR'){
            $("#hour_price").show();
        }
        else{
            $("#hour_price").hide();
        }
    });
});
</script>
@endsection
