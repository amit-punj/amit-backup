@extends('admin.layouts.app')
@section('content')


<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<div class="page-content-wrap">

<!-- START WIDGETS -->                    
<div class="row">
	<div class="col-md-12">
		<h2>Buyer List <!-- <a href="{{url('admin/users/create')}}"><button>Add New</button></a> --></h2>

		@if(Session::has('flash_message_error'))
			<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{!! session('flash_message_error') !!}</strong>
			</div>
		@endif

		@if(Session::has('flash_message_success'))
			<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{!! session('flash_message_success') !!}</strong>
			</div>
		@endif

		@if(Session::has('flash_message_delete'))
			<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{!! session('flash_message_delete') !!}</strong>
			</div>
		@endif

	</div>
</div>
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Property Type</th>
						<th>Price</th>
						<th>Rooms</th>
						<th>Location</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
		     	<tbody>
			     	@if(count($property_list))
						<?php $i= 1; ?>
						@foreach($property_list as $property)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$property->title}}</td>
								<td>{{$property->property_type}}</td>
								<td>${{$property->min_price}} - {{$property->max_price}}</td>
								<td>{{$property->min_room}} - {{$property->max_room}}</td>
								<td>{{$property->city_name}}</td>
								<td>{{$property->created_at}}</td>
								<td>
									<a href='{{ url("admin/view/requirement/{$property->id}") }}'  class=" btn btn-info" title="View Requirement"> <i class="fas fa-eye"></i></a>
									<a style=" background-color: #33414d; border-style: none; color: white;" href='{{url("viewuser/{$property->userid}")}}'  class=" btn btn-info" title="View User"> <i class="fas fa-eye"></i></a>
								
									<!-- <a href='{{ url("admin/property/{$property->id}/update") }}' title="edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></i></a>
	                          		<a href='{{ url("deleteproperty/{$property->id}")}}' onclick="return confirm('Are you sure to delete this property?')"  class=" btn btn-danger" title="delete"><i class="fas fa-minus-circle"></i></a> -->
	                          	</td>
							</tr>
						@endforeach
					@else
						<p>No Requirement found here.</p>
					@endif
				</tbody>
			</table>
			{!! $property_list->render() !!}
		</div>
	</div>
</div>
						
			  
@endsection