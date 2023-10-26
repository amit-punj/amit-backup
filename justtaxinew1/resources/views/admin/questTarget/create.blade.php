@extends('admin.layout.base')

@section('title', 'Add Quest ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.quest.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">@lang('admin.quest.add_quest')</h5>

            <form class="form-horizontal" action="{{route('admin.quest.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
				<div class="form-group row">
					<label for="promo_code" class="col-xs-2 col-form-label">@lang('admin.quest.number_of_trips')</label>
					<div class="col-xs-10">
						<input type="number" min="0" autocomplete="off" name="number_of_trips" id="number_of_trips" class="form-control" required placeholder="Enter Number of Trips Completed" value="{{old('number_of_trips')}}" style="text-transform: uppercase;" />
					</div>
				</div>
				<div class="form-group row">
					<label for="bonus_amount" class="col-xs-2 col-form-label">@lang('admin.quest.bonus_amount')</label>
					<div class="col-xs-10">
						<input type="number" min="0" name="bonus_amount" id="bonus_amount" class="form-control" required placeholder="Enter Bonus Amount" value="{{old('bonus_amount')}}" />
					</div>
				</div>
				<div class="form-group row">
					<label for="time_period" class="col-xs-2 col-form-label">@lang('admin.quest.time_period')</label>
					<div class="col-xs-10">
						<input class="form-control" type="date" value="{{ old('time_period') }}" name="time_period" required id="time_period" placeholder="Expiration">
					</div>
				</div>
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">@lang('admin.quest.add_quest')</button>
						<a href="{{route('admin.quest.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
