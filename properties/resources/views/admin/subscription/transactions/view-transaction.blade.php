@extends('admin.layouts.app')

@section('content')

<div id="content">
  <div id="content-header">
    <ul class="breadcrumb">
        <li><a href="{{ url('/admin') }}">Home</a></li>                    
        <li class="active">Transaction</li>
    </ul>
    <div class="page-content-wrap">

    <!-- START WIDGETS -->                    
    <div class="row">
      <div class="col-md-12">
        <h2>Listing Transactions</h2>
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
              <th>#</th>
              <th>User Name</th>
              <th>Transaction ID</th>
              <th>Transaction Invoice NO</th>
              <th>Transaction Amount</th>
              <th>Payment Status</th>
              <th>Transaction Start</th>
              <th>Transaction Expiry</th>
              <!-- <th>Actions</th> -->
            </tr>
          </thead>
          <tbody>
            @if(count($Trasactions))
            <?php $i= 1; ?>
              @foreach( $Trasactions as $trans )
              <tr class="gradeX">
                <td>{{ $i++ }}</td>
                <td>{{ $trans->user_name }}</td>
                <td>{{ $trans->subscription_id }}</td>
                <td>{{ $trans->title }}</td>
                <td>${{ $trans->price }} USD</td>
                <td>  @if( $trans->paid == 1 )
                          Paid
                      @else
                          Not Paid
                      @endif
                </td>
                <td>{{ date('d M, Y ', strtotime($trans->last_payment))  }}</td>
                <td>{{ date('d M, Y ', strtotime($trans->next_payment))  }}</td>
               <!--  <td class="center">
                   <a href="{{ url('/admin/view-transaction-one/'. $trans->id ) }}" class="btn btn-primary btn-mini"><i class="fa fa-eye"></i></a> 
                </td> -->
              </tr>
              @endforeach
            @else
              <p>No Transaction found!</p>
            @endif
         </tbody>
        </table>
         {!! $Trasactions->render() !!}
      </div>
    </div>
</div>


@endsection