@extends('adminlayouts.app')
@section('content')
<main class="app-content">
      <div class="app-title">
          <h1><i class="fa fa-th-list"></i> Unit Managment  </h1>
        </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                        {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <div class="top-nevigation">
                            @include('admin.topnevigation')
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="tab-content">
                        <div id="financials" class="">
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="Building-Units">List of Transactions</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    @if(count($transactions) > 0)
                                    <div  class="user-info-table">
                                        <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                            <thead>
                                                <tr>
                                                    <td >S.No</td>
                                                    <td >Date</td>
                                                    <td >Related to</td>
                                                    <td >Description</td>
                                                    <td >Amount</td>
                                                    <td >Payment Method</td>
                                                    <!-- <td >Action</td> -->
                                                </tr> 
                                            </thead>   
                                            <tbody >
                                                @foreach($transactions as $transaction)
                                                <tr>
                                                    <td >{{ $loop->index + 1 }}</td>
                                                    <td >{{ Carbon\Carbon::parse($transaction->created_at)->format('Y/m/d') }}</td>
                                                    <td >{{ $transaction->related_to }}</td>
                                                    @if($transaction->description)
                                                        <td >{{ $transaction->description }}</td>
                                                    @else
                                                        <td>--</td>
                                                    @endif
                                                    <td >{{  App\Helpers\Helper::CURRENCYSYMBAL.$transaction->amount }}</td>
                                                    <td >{{ $transaction->payment_by }}</td>
                                                    <!-- <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td> -->
                                                </tr> 
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $transactions->links() }}
                                     @else
                                    <div class="not_found">Not Found Any Record Related To Transactions.</div>
                                    @endif
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="Building-Units">Rental Bills</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                @if(count($rentalBills) > 0)
                                <div  class="user-info-table">
                                    <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                        <thead>
                                            <tr>
                                                <td >S.No</td>
                                                <td >Unit Name</td>
                                                <td >Date</td>
                                                <td >Amount</td>
                                                <td >Document</td>
                                                <td >Action</td>
                                            </tr> 
                                        </thead>   
                                        <tbody >
                                            @foreach($rentalBills as $rentalBill)
                                            <tr>
                                                <td >{{ $loop->index + 1 }}</td>
                                                <td ><a target="_blank" href="{{ url('view_unit-admin/'.$rentalBill->unit_id) }}">{{ $rentalBill->unit['unit_name'] }}</a></td>
                                                <td >{{ Carbon\Carbon::parse($rentalBill->reading_date)->format('Y/m/d') }}</td>
                                                <!-- <td >{{ $rentalBill->reading_date }}</td> -->
                                                <td >{{ App\Helpers\Helper::CURRENCYSYMBAL.$rentalBill->amount }}</td>
                                                @if($rentalBill->upload_document)
                                                    <td >{{ $rentalBill->upload_document }}</td>
                                                    <td ><a download href="{{ url('images/meter_reading_document/'.$rentalBill->upload_document) }}"><span title="Delete" class="glyphicon glyphicon-download-alt"></span></a></td>
                                                @else
                                                    <td>--</td>
                                                    <td>--</td>
                                                @endif
                                            </tr>  
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $rentalBills->links() }}
                                @else
                                <div class="not_found">Not Found Any Record Related To Rental Bills.</div>
                                @endif
                            </div>
                        </div> 
                    </div>
                </div>                                    
            </div>
        </div>
    </div>
    </main>
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span {font-size: 15px; font-weight: bold; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .add-unit-main {text-align: right; margin-top: 0px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: center; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
     /*   a span {color: black; }*/
        .tab-pane {padding: 15px 0; }
        ul.nav.nav-tabs {padding: 30px 0 0; }
        ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
        ul.nav.nav-tabs li {padding: 0 5px; }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
        ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
        div#list_of_transacions_length ,div#list_of_transacions_info {width: 50%; float: left; }
        div#list_of_transacions_filter , div#list_of_transacions_paginate{float: right; width: 50%; text-align: right; }
        a#list_of_transacions_previous {padding: 8px; border: 1px solid #ddd; color: black; border-radius: 5px 0 0 5px; }
        a#list_of_transacions_next {padding: 8px; border: 1px solid #ddd; color: black; border-radius: 0 5px 5px 0; }
        a.paginate_button {padding: 8px; border: 1px solid #ddd; color: black; border-top: 1px solid #ddd; border-right: 0; border-left: 0; }
        thead > tr > td {cursor: pointer; }
        .not_found { margin: 25px 0; }
        ul.nav.nav-tabs {
         display: -webkit-box;
        }
    </style>
    <!-- <script type="text/javascript" src="{{url('js/main.js')}}"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>;
    <script type="text/javascript" src="{{url('js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
      $('#list_of_transacions').DataTable();
    </script> -->
@endsection