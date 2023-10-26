@section('title','Contracts')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Contracts'])
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
                    <div class="col-sm-12">
                        <!-- <div class="tenent-title">List Of Booking Requests</div> -->
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                        <!-- <div class="tenent-title">List All Tenants</div> -->
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <a class="btn btn-success" target="_blank" href="{{ url('/create-contract')}}">Create New Contract <span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            @if(count($bookings)  > 0 )
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <!-- <td >S.No</td> -->
                                        <td >Unit Name</td>
                                        <td >Contract</td>
                                        <td >Amount</td> 
                                        <td >Payment Status</td> 
                                        <td >Starting date</td>
                                        <td >End Date</td>
                                        <td >Action</td>
                                    </tr>      
                                    @foreach($bookings as $booking)        
                                    <tr>
                                        <!-- <td >{{-- $loop->index+1 --}}</td> -->
                                        <td > <a href="{{ url('propertydetails/'.$booking->unit_id) }}">{{$booking->unit_name}} </a></td>
                                        <td > <a href="{{ url('contract-details/'.$booking->id) }}">{{ $booking->contract_type }}</a></td>
                                        <td >{{App\Helpers\Helper::CURRENCYSYMBAL.$booking->total_amount}}</td>
                                        <td >{{$booking->payment_status}}</td>
                                        <td >{{$booking->start_date}}</td>
                                        <td >{{$booking->end_date}}</td>
                                        <td ><a href="{{ url('contract-details/'.$booking->id) }}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="not_found">Not Found any Contract</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        {{ $bookings->links() }}
                    </div>
                </div>                                        
            </div>
        </div>
    </div> 
    <style type="text/css">
        .not_found {padding: 20px; font-size: 15px; }
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span { font-weight: bold;  }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; margin-bottom: 20px;}
        .unit-delete span {color: #000000bd; position: relative; float: right; }
        .tenent-title {font-size: 24px; }
        </style>
@endsection