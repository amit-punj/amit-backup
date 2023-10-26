@extends('layouts.main')
@section('content')
<style type="text/css">
.table td, .table th {
    font-size: 12px;
  }
td{
  width: 20%;
}
a.list-group-item {
    color: #fff;
}

  .color-orange{
    color: #b0b1b0;
  }
  .f13 {
    padding-right: 0;
    font-size: 13px !important;
}

.mg{
  margin-top: 2%;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: green;
}
.page-link {
    color: #37a745;
    }
    .descrip{
      height: 40px;
    }
    .rmt{
      margin-top: 4%;
    }
    /*my property list css*/
    .color-orange{
    color: #b0b1b0;
  }
  .f13 {
    padding-right: 0;
    font-size: 13px !important;
   }
.page-link {
    color: #37a745;
    }
    .descrip{
      height: 40px;
    }
    .rmt{
      margin-top: 4%;
    }
    .note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
     @media screen and (max-width: 667px){
      .f13 {
       font-size: 17px !important;
    }
    .rmt{
      margin-top: 0;
    }
    i{
    font-size: 21px !important;
  }
  .color-orange{
    width: 67%;
  }
  @media screen and (max-width: 420px){
    .color-orange{
      width: 57%;
    }
  }
  @media screen and (max-width: 380px){
    .color-orange{
      width: 60%;
    }
  }
    }
</style>
<div class="container">
  <div class="row m-0">
    <div class="col-md-3 setmd">
      @include('dashboard.dashboard-sidebar')
    </div>
    <div class="col-md-9 setmd">
         <div class="note"><p style="font-size: 22px;">  My  <span style="color: #41ac1b">  Transaction  </span> List </p>
             </div>
@if(count($Trasactions))
      <table class="table table-striped table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>Transaction ID</th>
              <th>Transaction Invoice NO</th>
              <th>Transaction Amount</th>
              <th>Status</th>
              <th>Transaction Start</th>
              <th>Transaction Expiry</th>
              <!-- <th scope="col">Action</th> -->
            </tr>
          </thead>
          <tbody>
                <?php $i=1; ?>
                @foreach($Trasactions as $key => $trans)
                  <tr>
                    <td scope="row">{{ $i++ }}</td>
                      <td>{{ $trans->subscription_id }}</td>
                      <td>{{ $trans->title }}</td>
                      <td>{{ number_format($trans->price,2) }} USD</td>
                      <td>  @if( $trans->paid == 1 )
                                Paid
                            @else
                                Not Paid
                            @endif
                      </td>
                      <td>{{ date('d M, Y ', strtotime($trans->last_payment))  }}</td>
                      <td>{{ date('d M, Y ', strtotime($trans->next_payment))  }}</td>
                    <!-- <td><a href="{{url('property/detail/'.$trans->id)}}" class="btn btn-default btn-xs" style="font-size: 20px; color: green;" href="#"><i class="fas fa-eye"></i></a>
                    </td> -->
                  </tr>
                @endforeach
          </tbody>
      </table>
 {!! $Trasactions->render() !!}
@else
   <p style="padding: 10px;">
   No Transaction found!!!
   </p>
@endif
    </div>
  </div>
</div>
@endsection
