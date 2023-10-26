@extends('admin.layouts.app')
@section('content')
<style type="text/css">
	.input-group-text {
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    margin-bottom: 0;
    padding: .625rem .75rem;
    text-align: center;
    white-space: nowrap;
    color: #adb5bd;
    border: 1px solid #cad1d7;
    border-radius: .375rem;
    background-color: #fff;
}
</style>

<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<div class="page-content-wrap">

<!-- START WIDGETS -->                    
<div class="row">
	<div class="col-md-12">
		<h2>Listing Users <!-- <a href="{{url('admin/users/create')}}"><button>Add New</button></a> --></h2>

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
		  <div class="row">
		     <div class="col-md-6">
			<form name="filter" action="{{url('filter/user')}}" method="get">
				{{ csrf_field() }}
				<label>Status: </label>
				<select name="status_search" class="input-group-text">
					<option value=0>--Select Role--</option>
					<option value="3">Agents</option>
					<option value="2">office Admin</option>
					<!-- <option value="4">Customers</option> -->
				</select>
				<input type="submit" class="btn btn-success " name="filter" value="Filter">
				<a href="{{ url('allusers') }}">
					<button type="button" class="btn btn-danger" name="reset" value="Reset">Reset</button>
				</a>
				</div>
			</form>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						<th>Created Date</th>
						<th>Action</th>
					</thead>
					<tbody>
			          <?php if(isset($user))
			          	{ ?>
							<?php $i=1; ?>
								@foreach($user as $users)
									<tr>
										<td>{{$i++}}</td>
										<td>{{$users->fname}}</td>
										<td>{{$users->email}}</td>
										<td>
											@if($users->role == 2)
												Office Admin
											@elseif($users->role == 3)
												  Agent
											@else
											    Customer
											@endif
										</td>
										<td>{{ $users->created_at }}</td>
										<td>
									 		<a href='{{ url("viewuser/{$users->id}")}}'  class=" btn btn-info" title="view"> <i class="fas fa-eye"></i></a>
											<a href='{{ url("updateuser/{$users->id}") }}' title="edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></i></a>
			                          		<a href='{{ url("deleteuser/{$users->id}")}}' onclick="return confirm('Are you sure to delete this user?')"  class=" btn btn-danger" title="delete"><i class="fas fa-minus-circle"></i></a>
				                   		</td>     
						     		</tr>
								@endforeach
								</tbody>
								</table>
							{!! $user->render() !!}
						<?php
	                    }
						elseif(isset($user2)){
							 $i=1;
						?>
						 <table class="table table-striped">
						 <tbody>
		                        @foreach($user2 as $users2)
		                       		<tr>
										<td>{{$i++}}</td>
										<td>{{$users2->fname}}</td>
										<td>{{$users2->email}}</td>
										<td>
											@if($users2->role == 1)
												Super Admin
											@elseif($users2->role == 2)
												Office Admin
											@elseif($users2->role == 3)
											     Agent
											@else
												Customer
											@endif
										</td>
										<td>{{ $users2->created_at }}</td>
										<td>
												<a href='{{ url("updateuser/{$users2->id}") }}' title="edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></i></a>
											
					                          <a href='{{ url("deleteuser/{$users2->id}")}}' onclick="return confirm('Are you sure to delete this user?')"  class=" btn btn-danger" title="delete"><i class="fas fa-minus-circle"></i></a>
						                         <a href='{{ url("viewuser/{$users2->id}")}}'  class=" btn btn-info" title="view"> <i class="fas fa-eye"></i></a>
										</td>
				     				</tr>
	                          	@endforeach
	                          	</table>
                      		{!! $user2->render() !!}
                      		{{ $user2->appends(request()->query())->links()  }}
						<?php
						}
               				// this section for filter agents display
						elseif(isset($user3))
				  		{
			  			$i=1;
			  			?>
			  			 <table class="table table-striped">
	                          	@foreach($user3 as $users3)
								   	<tr>
										<td>{{$i++}}</td>
										<td>{{$users3->fname}}</td>
										<td>{{$users3->email}}</td>
										<td>
											@if($users3->role == 1)
												Super Admin
											@elseif($users3->role == 2)
												Office Admin
											@elseif($users3->role == 3)
											     Agent
											@else
												Customer
											@endif
										</td>
										<td>{{ $users3->created_at }}</td>
									    <td>
										<a href='{{ url("updateuser/{$users3->id}") }}' title="edit" class=" btn btn-primary"><i class="fas fa-user-edit"></i></i></a>
			                         	<a href='{{ url("deleteuser/{$users3->id}")}}' onclick="return confirm('Are you sure to delete this user?')"  class=" btn btn-danger" title="delete"><i class="fas fa-minus-circle"></i></a>
				                        <a href='{{ url("viewuser/{$users3->id}")}}'  class=" btn btn-info" title="view"> <i class="fas fa-eye"></i></a>
										</td>
							     	</tr>
					      		@endforeach
				       		
					</tbody>
				</table>
				{{ $user3->appends(request()->query())->links()  }}
	                    <?php } ?>
			</div>
		</div>
	</div>
</div>
@endsection