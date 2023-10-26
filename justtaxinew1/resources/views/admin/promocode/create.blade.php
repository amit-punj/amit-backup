@extends('admin.layout.base')

@section('title', 'Add Promocode ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.promocode.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">@lang('admin.promocode.add_promocode')</h5>

            <form class="form-horizontal" action="{{route('admin.promocode.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
				<div class="form-group row">
					<label for="promo_code" class="col-xs-2 col-form-label">@lang('admin.promocode.promocode')</label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" value="{{ old('promo_code') }}" name="promo_code" required id="promo_code" placeholder="Promocode" style="text-transform: uppercase;">
					</div>
				</div>
				<div class="form-group row">
					<label for="discount" class="col-xs-2 col-form-label">@lang('admin.promocode.discount')</label>
					<div class="col-xs-10">
						<input class="form-control" type="number" min="0" value="{{ old('discount') }}" name="discount" required id="discount" placeholder="Discount">
					</div>
				</div>
				<div class="form-group row">
					<label for="discount" class="col-xs-2 col-form-label">@lang('admin.promocode.discount_type')</label>
					<div class="col-xs-10">
						<select class="form-control" name="discount_type" required id="discount_type">
						<option value="">Select Type</option>
						<option value="percent">In Percentage Mode(%)</option>
						<option value="amount">In Amount Mode</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="expiration" class="col-xs-2 col-form-label">@lang('admin.promocode.expiration')</label>
					<div class="col-xs-10">
						<input class="form-control" type="date" value="{{ old('expiration') }}" name="expiration" required id="expiration" placeholder="Expiration">
					</div>
				</div>
				<div class="form-group row">
                    <label for="applicable_to" class="col-md-2 col-form-label required">@lang('admin.promocode.applicable_to')</label>
                    <div class="col-md-10">
                        <input type="radio" name="applicable_to" id="first_time" value="1" checked=""/> @lang('admin.promocode.first_time')
                        <input type="radio" name="applicable_to" id="all" class="ml-5" value="0"/>  @lang('admin.promocode.all')
                    </div>
                </div>
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">@lang('admin.promocode.add_promocode')</button>
						<a href="{{route('admin.promocode.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$('#discount_type').change(function()
	{
		var val = $(this).val();
		if(val == 'percent')
		{
			if($("#discount").val() >= 100)
			{
				$("#discount").val('');
				alert('You can not take Percentage more than 100')
			}
		}
	});
	$('#discount').keyup(function(){
		if($("#discount").val() >= 100)
		{
			if($('#discount_type').val() == 'percent')
			{
				$("#discount").val('');
				alert('You can not take Percentage more than 100')
			}
		}
	});
</script>
@endsection