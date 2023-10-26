@section('title','List Of Booking Requests')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List Of Booking Requests'])
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
                    <div class="col-sm-12">
                        @if(count($bookings) > 0 )
                            <div  class="user-info-table">
                                <table  class="table table-hover table-striped table-bordered">
                                    <tbody >
                                        <tr>
                                            <td >Unit name</td>
                                            <td >Tenant name</td>
                                            <td >Amount</td>
                                            <td >Payment method</td> 
                                            <td >Status</td>
                                            <td >Starting date</td>
                                            <td >End date</td>
                                            <td >Booking status</td>
                                        </tr>  
                                        @foreach($bookings as $key => $booking)             
                                            <tr>
                                                <td > 
                                                    <a href="{{url('propertydetails/'.$booking->unit_id)}}">
                                                        {{ substr($booking->unit['unit_name'],0,20) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('tenant-details/'.$booking->tenant_id) }}">
                                                        {{ $booking->user['name'] }}
                                                    </a>
                                                </td>
                                                <td >
                                                    {{ App\Helpers\Helper::CURRENCYSYMBAL.
                                                        ( $booking->unit['rent'] + $booking->unit['cost_provision'] ) 
                                                    }}
                                                </td>
                                                <td >{{ ucfirst($booking->payment_method) }}</td>
                                                @if($booking->status == 0)
                                                    <td >Draft</td>
                                                @elseif($booking->status == 1)
                                                    <td >Pending Payment</td>
                                                @elseif($booking->status == 2)
                                                    <td >Payment Done</td>
                                                @elseif($booking->status == 3)
                                                    <td >Accept</td>
                                                @elseif($booking->status == 4)
                                                    <td >Reject By PM</td>
                                                @elseif($booking->status == 5)
                                                    <td >Expert Done</td>
                                                @elseif($booking->status == 6)
                                                    <td >Complete</td>
                                                @elseif($booking->status == 7)
                                                    <td >Cancel By Tenantt</td>
                                                @elseif($booking->status == 8)
                                                    <td >Terminate</td>
                                                @else
                                                    <td >--</td>
                                                @endif
                                                <td >{!! \Helper::Date($booking->start_date); !!}</td>
                                                <td >{!! \Helper::Date($booking->end_date); !!}</td>
                                                <td >
                                                    <select name="booking_action">
                                                        <option value="accepted">Accepted</option>        
                                                        <option value="rejected">Rejected</option>        
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $bookings->links() }}
                        @else
                            <div class="not_found">Not Found Any Record</div>
                        @endif
                    </div>
                </div>                                        
            </div>
        </div>
    </div> 
    <style type="text/css">
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
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right; }
        
        .tenent-title {font-size: 24px; }
        </style>
@endsection