@extends('admin.layouts.app')

@section('content')

<div id="content">
  <div id="content-header">
    <ul class="breadcrumb">
        <li><a href="{{ url('/admin') }}">Home</a></li>                    
        <li class="active">Trasactions</li>
    </ul>
    <div class="page-content-wrap">

    <!-- START WIDGETS -->                    
    <div class="row">
      <div class="col-md-12">
        <h2>View Trasactions</h2>
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
        @if($TrasactionsOne)
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">Trasactions ID:</th>
              <td>{{ $TrasactionsOne->id }}</td>
            </tr>
            <tr>
              <th scope="row">User ID:</th>
              <td>{{ $TrasactionsOne->user_id }}</td>
            </tr>
            <tr>
              <th scope="row">Plan ID:</th>
              <td>{{ $TrasactionsOne->plan_id }}</td>
            </tr>
            <tr>
              <th scope="row">Thirdparty PayID:</th>
              <td>{{ $TrasactionsOne->thirdparty_payid }}</td>
            </tr>
            <tr>
              <th scope="row">Amount Paid:</th>
              <td>{{ $TrasactionsOne->amount_paid }}</td>
            </tr>
            <tr>
              <th scope="row">Payment Status:</th>
              <td>{{ $TrasactionsOne->payment_status }}</td>
            </tr>
            <tr>
              <th scope="row">Plan Start:</th>
              <td>{{ $TrasactionsOne->plan_start }}</td>
            </tr>
            <tr>
              <th scope="row">Plan Expiry:</th>
              <td>{{ $TrasactionsOne->plan_expiry }}</td>
            </tr>
            <tr>
              <th scope="row">Pain With:</th>
              <td>{{ $TrasactionsOne->paid_with }}</td>
            </tr>
          </tbody>
        </table>
        @endif 
      </div>
    </div>
</div>


@endsection