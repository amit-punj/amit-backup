@extends('admin.layout.base')

@section('title', 'Update Service Type ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.service.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.service.Update_Vehicle')</h5>

            <form class="form-horizontal" action="{{route('admin.service.update', $service->id )}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">@lang('admin.service.Service_Name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $service->name }}" name="name" required id="name" placeholder="Service Name">
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="provider_name" class="col-xs-2 col-form-label">@lang('admin.service.Provider_Name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $service->provider_name }}" name="provider_name" required id="provider_name" placeholder="Provider Name">
                    </div>
                </div> -->

                <div class="form-group row">
                    
                    <label for="image" class="col-xs-2 col-form-label">@lang('admin.picture')</label>
                    <div class="col-xs-10">
                        @if(isset($service->image))
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{img( $service->image) }}">
                        @endif
                        <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="calculator" class="col-xs-2 col-form-label">@lang('admin.service.Pricing_Logic')</label>
                    <div class="col-xs-10">
                        <select class="form-control" id="calculator" name="calculator">
                            <option value="MIN" @if($service->calculator =='MIN') selected @endif>@lang('servicetypes.MIN')</option>
                            <option value="HOUR" @if($service->calculator =='HOUR') selected @endif>@lang('servicetypes.HOUR')</option>
                            <option value="DISTANCE" @if($service->calculator =='DISTANCE') selected @endif>@lang('servicetypes.DISTANCE')</option>
                            <option value="DISTANCEMIN" @if($service->calculator =='DISTANCEMIN') selected @endif>@lang('servicetypes.DISTANCEMIN')</option>
                            <option value="DISTANCEHOUR" @if($service->calculator =='DISTANCEHOUR') selected @endif>@lang('servicetypes.DISTANCEHOUR')</option>
                        </select>
                    </div>
                </div>
                
                 <!-- Set Hour Price -->
                @if($service->calculator =='DISTANCEHOUR')
                <div class="form-group row" id="hour_price" >
                @else
                <div class="form-group row" id="hour_price" style="display: none;" >
                @endif
                    <label for="fixed" class="col-xs-2 col-form-label">@lang('admin.service.hourly_Price') ({{ currency('') }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->hour }}" name="hour" required id="hourly_price" placeholder="Set Hour Price">
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="fixed" class="col-xs-2 col-form-label">@lang('admin.service.Base_Price') ({{ currency('') }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->fixed }}" name="fixed" required id="fixed" placeholder="Base Price">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="distance" class="col-xs-2 col-form-label">@lang('admin.service.Base_Distance') ({{ distance('') }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->distance }}" name="distance" required id="distance" placeholder="Base Distance">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="minute" class="col-xs-2 col-form-label">@lang('admin.service.unit_time') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->minute }}" name="minute" required id="minute" placeholder="Unit Time Pricing">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-xs-2 col-form-label">@lang('admin.service.unit') ({{ distance() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->price }}" name="price" required id="price" placeholder="Unit Distance Price">
                    </div>
                </div>

                <!-- Night Charges -->
                <div class="form-group row">
                    <label for="night_charges" class="col-xs-2 col-form-label">@lang('admin.service.night_charges') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->night_charges }}" name="night_charges" required id="night_charges" placeholder="Night Charges">
                    </div>
                </div>

                <!-- Airport Charges -->
                <div class="form-group row">
                    <label for="airport_charges" class="col-xs-2 col-form-label">@lang('admin.service.airport_charges') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->airport_charges }}" name="airport_charges" required id="airport_charges" placeholder="Airport Charges">
                    </div>
                </div>

                <!-- Cancellation Fee -->
                <div class="form-group row">
                    <label for="cancellation_fee" class="col-xs-2 col-form-label">@lang('admin.service.cancellation_fee') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->cancellation_fee }}" name="cancellation_fee" required id="cancellation_fee" placeholder="Cancellation Fee">
                    </div>
                </div>

                <!-- Platform Usage Fee/Commission -->
                <div class="form-group row">
                    <label for="platform_fee" class="col-xs-2 col-form-label">@lang('admin.service.platform_fee') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $service->platform_fee }}" name="platform_fee" required id="platform_fee" placeholder="Platform Usage Fee/Commission">
                    </div>
                </div>

                <!-- Surge Applicable -->
                <div class="form-group row">
                    <label for="surge" class="col-xs-2 col-form-label">@lang('admin.service.surge') </label>
                    <div class="col-xs-10">
                       <input type="radio" name="surge" id="surge_y" value="1" {{($service->surge == 1) ? "Checked" : ''}} />Yes
                        <input type="radio" name="surge" id="surge_n" class="ml-5" value="0" {{($service->surge == 0) ? "Checked" : ''}} />No
                    </div>
                </div>

                <div class="form-group row">
                    <label for="capacity" class="col-xs-2 col-form-label">@lang('admin.service.Seat_Capacity')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" min="0" max="9" value="{{ $service->capacity }}" name="capacity" required id="capacity" placeholder="Seat Capacity">
                    </div>
                </div>

                
                <div class="form-group row">
                    <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                        <button type="submit" class="btn btn-primary btn-block">@lang('admin.service.Update_Service_Type')</button>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <a href="{{route('admin.service.index')}}" class="btn btn-danger btn-block">@lang('admin.cancel')</a>
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