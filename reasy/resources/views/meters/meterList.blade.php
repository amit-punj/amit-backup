    <input type="hidden" name="unit_id" id="unit_id" value="{{$unit_id}}">
<?php foreach ($meters as $key => $value) { ?>
    @if($value->meter_type == 'water_meter')
        @php $meter_name = 'Water' @endphp
    @elseif($value->meter_type == 'gas_meter')
        @php $meter_name = 'Gas' @endphp
    @elseif($value->meter_type == 'electric_meter')
        @php $meter_name = 'Electric' @endphp
    @endif
    <input type="hidden" name="meter_id[]" id="meter_id_{{$key}}" value="{{$value->id}}">
    <input type="hidden" name="per_unit_price[]" id="per_unit_price{{$key}}" value="{{$value->unit_price}}">
    <div class="form-group row">
        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __($meter_name.' meter') }}</label>
        <div class="col-md-6">
           <input id="reading_{{$key}}" type="text" class="form-control reading" name="reading[]" value="">
        </div>
    </div>
<?php } ?>
