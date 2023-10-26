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
		<h2>Property List <!-- <a href="{{url('admin/users/create')}}"><button>Add New</button></a> --></h2>

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
						<th>Slider Image</th>
						<th>Title</th>
						<th>Description</th>
						<th>Search Bar</th>
						<th>Status</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
		     	<tbody>
			     	@if(count($slider_list))
						<?php $i= 1; ?>
						@foreach($slider_list as $slider)
							<tr>
								<td>{{$i++}}</td>
								<td><img src='{{ asset("images/slider/{$slider->slider_image}") }}' alt="Slider" style="width:100px;height: 100px""></td>
								<td>{{$slider->title}}</td>
								<td>{{$slider->description}}</td>
								<td>
									@if($slider->search_bar == 1)
										Yes
									@else
										No
									@endif
								</td>
								<td>{{$slider->status}}</td>
								<td>{{$slider->created_at}}</td>
								<td>
									<a href='{{ url("admin/slider/{$slider->id}/view")}}'  class=" btn btn-info" title="View"> <i class="fas fa-eye"></i></a>
								
									<a href='{{ url("admin/slider/{$slider->id}/update") }}' title="Edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></i></a>
	                          		<a href='{{ url("admin/slider/{$slider->id}/delete")}}' onclick="return confirm('Are you sure to delete this slider?')"  class=" btn btn-danger" title="Delete"><i class="fas fa-minus-circle"></i></a>
	                          	</td>
							</tr>
						@endforeach
					@else
						<p>No Property found here.</p>
					@endif
				</tbody>
			</table>
				{!! $slider_list->render() !!}
		</div>
	</div>
</div>
						
			  
@endsection