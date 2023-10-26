@extends('admin.layouts.app')

@section('content')

<div id="content">
  <div id="content-header">
    <ul class="breadcrumb">
        <li><a href="{{ url('dashboard') }}">Home</a></li>                    
        <li class="active">Subscription</li>
    </ul>
    <div class="page-content-wrap">

    <!-- START WIDGETS -->                    
    <div class="row">
      <div class="col-md-12">
        <h2>Listing Subscription</h2>
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
        <table class="table table-bordered data-table">
          <thead>
            <tr>
              <th>Subscription ID</th>
              <th>Subscription Name</th>
              <th>Subscription Description</th>
              <th>Annual Price</th>
              <th>Monthly Price</th>
              <th>Duration (Months)</th>
              <th>Duration (Days)</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $Subscription as $subscript )
            <tr class="gradeX">
              <td>{{ $subscript->id }}</td>
              <td>{{ $subscript->name }}</td>
              <td>{{ $subscript->description }}</td>
              <td>${{ $subscript->price }}</td>
              <td>${{ $subscript->month_price }}</td>
              <td>{{ $subscript->duration }}</td>
              <td>{{ $subscript->agent }}</td>
              <td class="center">
                <a href="{{ url('/admin/edit-subscription/'. $subscript->id ) }}" class="btn btn-primary btn-mini"><i class="fa fa-edit"></i></a> 
                <a href="{{ url('/admin/delete-subscription/'. $subscript->id ) }}" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure to delete this Subscription?')"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
         </tbody>
        </table>
      </div>
    </div>
</div>


@endsection