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
		<h2>Testimonial List <!-- <a href="{{url('admin/users/create')}}"><button>Add New</button></a> --></h2>

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
						<th>Testimonial Image</th>
						<th>Name</th>
						<th>Designation</th>
						<th>Testimonial</th>
						<th>Status</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
		     	<tbody>
			     	@if(count($testimonial_list))
						<?php $i= 1; ?>
						@foreach($testimonial_list as $testimonial)
							<tr>
								<td>{{$i++}}</td>
								<td><img src='{{ asset("images/testimonial/{$testimonial->image}") }}' alt="Testimonial" style="width:100px;height: 100px""></td>
								<td>{{$testimonial->name}}</td>
								<td>{{$testimonial->designation}}</td>
								<td>{{$testimonial->testimonial}}</td>
								<td>{{$testimonial->status}}</td>
								<td>{{$testimonial->created_at}}</td>
								<td>
									<a href='{{ url("admin/testimonial/{$testimonial->id}/view")}}'  class=" btn btn-info" title="View"> <i class="fas fa-eye"></i></a>
								
									<a href='{{ url("admin/testimonial/{$testimonial->id}/update") }}' title="Edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></i></a>
	                          		<a href='{{ url("admin/testimonial/{$testimonial->id}/delete")}}' onclick="return confirm('Are you sure to delete this testimonial?')"  class=" btn btn-danger" title="Delete"><i class="fas fa-minus-circle"></i></a>
	                          	</td>
							</tr>
						@endforeach
					@else
						<p>No Property found here.</p>
					@endif
				</tbody>
			</table>
				{!! $testimonial_list->render() !!}
		</div>
	</div>
</div>
						
			  
@endsection