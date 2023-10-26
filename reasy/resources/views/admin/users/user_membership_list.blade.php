@extends('adminlayouts.app')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> List of User Membership</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="#">Users Memberships</a></li>
        </ul>
      </div>
       @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
      @endif
      @if(session()->has('flash_message_delete'))
          <div class="alert alert-danger">
              {{ session()->get('flash_message_delete') }}
          </div>
      @endif
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="list_cms_pages">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Plan Name</th>
                    <th>Amount</th>
                    <th>Payment Time</th>
                    <th>End Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($membership_data as $key => $user)                  
                    <tr>
                     <td>{{ $user->user_membership->id}}</td>
                      <td>{{ $user->user_membership->name}}</td>
                      <td>{{ $user->user_membership->email}}</td>
                      <td>{{ $user->plan->title}}</td>
                      <td>{{ $user->total_amount}}  {{ $user->currency}}</td>
                      <td>{{ $user->payment_time}}</td>
                      <td>{{ $user->membership_end_at}}</td>
                      <td><a href="{{ url('delete/membership/user/'.$user->id)}}" class="btn btn-danger">delete</a></td>
                  @endforeach                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <style type="text/css">div#list_cms_pages_filter {display: none; }</style>
    </main>

@endsection