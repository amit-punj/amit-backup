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
		<span style="font-size: 25px;">Client List <!-- <a href="{{url('admin/users/create')}}"><button>Add New</button></a> --></span>

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
	@if(count($slider_list))
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Mobile No</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
		     	<tbody>
						<?php $i= 1; ?>
						@foreach($slider_list as $slider)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$slider->fname}}</td>
								<td>{{ $slider->lname }}</td>
								<td>{{$slider->email}}</td>
								<td>{{$slider->mobile}}</td>
								<td>{{$slider->created_at}}</td>
								<td>
									<a href='{{ url("admin/client/{$slider->id}/view")}}'  class=" btn btn-info" title="View"> <i class="fas fa-eye"></i></a>
								
									<a href='{{ url("admin/client/{$slider->id}/update") }}' title="Edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></i></a>
	                          		<a href='{{ url("admin/client/{$slider->id}/delete")}}' onclick="return confirm('Are you sure to delete this Client?')"  class=" btn btn-danger" title="Delete"><i class="fas fa-minus-circle"></i></a>
	                          	</td>
							</tr>
						@endforeach
					@else
						<p>No Client found here.</p>
					@endif
				</tbody>
			</table>
				{!! $slider_list->render() !!}
		</div>
	</div>
</div>
						
			  
@endsection