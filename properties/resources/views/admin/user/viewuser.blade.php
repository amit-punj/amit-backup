@extends('admin.layouts.app')
@section('content')
<div class="container" style="margin-top: 7%;">
<div id="buyer_view">
	<div class="persolnal_detai_buyer">
	  	@if($user->profile_pic)
            <img src='{{ asset("images/{$user->profile_pic}") }}' height="100" width="100" class="avatar" style="border-radius: 50%;">
        @else
            <img src='{{ asset("images/dummy-user.png") }}' height="65" width="65" class="avatar">
        @endif
	    <div class="content_buy">
        	<h4 class="font-weight-bold mb-0">{{ $user->name }}
	          	<span class="text-muted font-weight-normal">@ {{ $user->email }}</span>
	        </h4>
	        <div class="text-muted mb-2">ID: 0000{{ $user->id }}</div>
	       
				<a href='{{url("updateuser/{$user->id}")}}' class="btn btn-primary btn-sm">Edit</a>&nbsp;
	        <a href="mailto:{{ $user->email }}" class="btn btn-default btn-sm icon-btn">
	        	<i class="fa fa-envelope"></i>
	        </a>
	        <a href="{{ url('admin/adduser_client/'.$user->id)}}" class="btn btn-success">Add Client</a>
	        <a href="{{ url('user/client/view/'.$user->id)}}" class="btn btn-success">View Clients</a>
	    </div>
    </div>
    <div class="card mb-4">
		<div class="card-body">
			<table class="table user-view-table m-0">
				<tbody>
					<tr>
						<td>Registered:</td>
						<td>{{ $user->created_at }}</td>
					</tr>
					<tr>
						<td>Latest activity:</td>
						<td>{{ $user->updated_at }}</td>
					</tr>
					<tr>
						<td>Verified:</td>
						<td>
							<i class="fa fa-check text-primary"></i>&nbsp; Yes
						</td>
					</tr>
					<tr>
						<td>Role:</td>
						<td>
						@if($user->role == 2)
							Office admin
						@endif
							@if($user->role == 3)
							 Agent
							@endif
							@if($user->role == 4)
								customer
							@endif
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>					

    <div class="card">
		<div class="row no-gutters row-bordered">
			<hr class="border-light m-0">
			<div class="card-body">

            <h2>User Details</h2>
			<table class="table user-view-table m-0">
				<tbody>
					<tr>
						<td>Username:</td>
						<td>{{ $user->name }}</td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td>{{ $user->fname }}</td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td>{{ $user->lname }}</td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td>{{ $user->email }}</td>
					</tr>
					<tr>
						<td>Agents Profile URL:</td>
						<td>{{ $user->agent_profile_url }}</td>
					</tr>
					<tr>
						<td>State Licence ID:</td>
						<td>{{ $user->state_licence_id }}</td>
					</tr>
					<tr>
						<td>Real Estate Firm:</td>
						<td>{{ $user->realestate_firm }}</td>
					</tr>
				</tbody>
			</table>

			<h2>Personal info</h2>
			<table class="table user-view-table m-0">
				<tbody>
					<tr>
						<td>Address:</td>
						<td>{{ $user->address }}</td>
					</tr>
					<tr>
						<td>Zipcode:</td>
						<td>{{ $user->zipcode }}</td>
					</tr>
				</tbody>
			</table>

			<h2>Contact info</h2>
			<table class="table user-view-table m-0">
				<tbody>
					<tr>
						<td>Phone Number:</td>
						<td>{{ $user->telephone }}</td>
					</tr>
					<tr>
						<td>Mobile Number:</td>
						<td>{{ $user->phone_no }}</td>
					</tr>
					
				</tbody>
			</table>	

				@if(!empty($transactions) && $transactions != "")
			<h2>Membership info</h2>
			<table class="table user-view-table m-0">
					<tbody>
						<tr>
							<td>Package Name:</td>
							<td>{{ $transactions->package_name }}</td>
						</tr>
						<tr>
							<td>Package Price $ :</td>
							<td>${{ $transactions->price }}</td>
						</tr>
						<tr>
							<td>Package Status:</td>
							<td> Paid </td>
						</tr>
						<tr>
							<td>Package Last Payment:</td>
							<td>{{ $transactions->last_payment }}</td>
						</tr>
						<tr>
							<td>Package Next Payment:</td>
							<td>{{ $transactions->next_payment }}</td>
						</tr>
					</tbody>
			</table>
				@endif
		</div>
	</div>
</div>
</div>


@endsection
