@extends('admin.layout.base')

@section('title', 'Add Vehicle Type ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.service.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.service.Add_Service_Type')</h5>

            <form class="form-horizontal" action="{{route('admin.service.store')}}" method="POST" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-xs-12 col-form-label">@lang('admin.service.Service_Name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ old('name') }}" name="name" required id="name" placeholder="Vehicle Name">
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="provider_name" class="col-xs-12 col-form-label">@lang('admin.service.Provider_Name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ old('provider_name') }}" name="provider_name" required id="provider_name" placeholder="Provider Name">
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="picture" class="col-xs-12 col-form-label">
                    @lang('admin.service.Service_Image')</label>
                    <div class="col-xs-10">
                        <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="picture" aria-describedby="fileHelp">
                    </div>
                </div>

                 <div class="form-group row">
                    <label for="calculator" class="col-xs-12 col-form-label">@lang('admin.service.Pricing_Logic')</label>
                    <div class="col-xs-10">
                        <select class="form-control" id="calculator" name="calculator">
                            <option value="MIN">@lang('servicetypes.MIN')</option>
                            <option value="HOUR">@lang('servicetypes.HOUR')</option>
                            <option value="DISTANCE">@lang('servicetypes.DISTANCE')</option>
                            <option value="DISTANCEMIN">@lang('servicetypes.DISTANCEMIN')</option>
                            <option value="DISTANCEHOUR">@lang('servicetypes.DISTANCEHOUR')</option>
                        </select>
                    </div>
                </div>
 
                <!-- Set Hour Price -->
                <div class="form-group row" id="hour_price" style="display: none;">
                    <label for="fixed" class="col-xs-12 col-form-label">@lang('admin.service.hourly_Price') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('fixed',0) }}" name="hour" id="hourly_price" placeholder="Set Hour Price">
                    </div>
                </div>

                <!-- Base fare -->
                <div class="form-group row">
                    <label for="fixed" class="col-xs-12 col-form-label">@lang('admin.service.Base_Price') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('fixed') }}" name="fixed" required id="fixed" placeholder="Base Price">
                    </div>
                </div>
                <!-- Base distance -->
                <div class="form-group row">
                    <label for="distance" class="col-xs-12 col-form-label">@lang('admin.service.Base_Distance') ({{ distance() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('distance') }}" name="distance" required id="distance" placeholder="Base Distance">
                    </div>
                </div>
                <!-- unit time pricing -->
                <div class="form-group row">
                    <label for="minute" class="col-xs-12 col-form-label">@lang('admin.service.unit_time')</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('minute') }}" name="minute" required id="minute" placeholder="Unit Time Pricing">
                    </div>
                </div>
                <!-- unit distance price -->
                <div class="form-group row">
                    <label for="price" class="col-xs-12 col-form-label">@lang('admin.service.unit')({{ distance() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('price') }}" name="price" required id="price" placeholder="Unit Distance Price">
                    </div>
                </div>
                
                <!-- Night Charges -->
                <div class="form-group row">
                    <label for="night_charges" class="col-xs-12 col-form-label">@lang('admin.service.night_charges') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('night_charges') }}" name="night_charges" required id="night_charges" placeholder="Night Charges">
                    </div>
                </div>

                <!-- Airport Charges -->
                <div class="form-group row">
                    <label for="airport_charges" class="col-xs-12 col-form-label">@lang('admin.service.airport_charges') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('airport_charges') }}" name="airport_charges" required id="airport_charges" placeholder="Airport Charges">
                    </div>
                </div>

                <!-- Cancellation Fee -->
                <div class="form-group row">
                    <label for="cancellation_fee" class="col-xs-12 col-form-label">@lang('admin.service.cancellation_fee') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('cancellation_fee') }}" name="cancellation_fee" required id="cancellation_fee" placeholder="Cancellation Fee">
                    </div>
                </div>

                <!-- Platform Usage Fee/Commission -->
                <div class="form-group row">
                    <label for="platform_fee" class="col-xs-12 col-form-label">@lang('admin.service.platform_fee') ({{ currency() }})</label>
                    <div class="col-xs-10">
                        <input class="form-control two-decimals" step="any" type="number" min="0" value="{{ old('platform_fee') }}" name="platform_fee" required id="platform_fee" placeholder="Platform Usage Fee/Commission">
                    </div>
                </div>

                <!-- Surge Applicable -->
                <div class="form-group row">
                    <label for="surge" class="col-xs-12 col-form-label">@lang('admin.service.surge') </label>
                    <div class="col-xs-10">
                       <input type="radio" name="surge" id="surge_y" value="1" checked="" />Yes
                        <input type="radio" name="surge" id="surge_n" class="ml-5" value="0" />No
                    </div>
                </div>

                <div class="form-group row">
                    <label for="capacity" class="col-xs-12 col-form-label">@lang('admin.service.Seat_Capacity')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" min="0" max="9" value="{{ old('capacity') }}" name="capacity" required id="capacity" placeholder="Capacity">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-xs-12 col-form-label">@lang('admin.service.Description')</label>
                    <div class="col-xs-10">
                        <textarea class="form-control" type="number" name="description" required id="description" placeholder="Description" rows="4">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">@lang('admin.service.Add_Service_Type'
                                )</button>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="{{ route('admin.service.index') }}" class="btn btn-danger btn-block">@lang('admin.cancel')</a>
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

$(".two-decimals").change(function(){
    this.value = parseFloat(this.value).toFixed(2);
});
</script>
@endsection
