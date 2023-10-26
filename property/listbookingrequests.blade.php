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
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >S.No</td>
                                        <td >Unit Name</td>
                                        <td >Tenant</td>
                                        <td >Amount</td>
                                        <td >Payment Status</td>
                                        <td >Starting date</td>
                                        <td >End Date</td>
                                        <td >Booking status</td>
                                    </tr>              
                                    <tr>
                                        <td >1</td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/propertydetails/22">Floor 1 </a></td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/tenant-details/1">Jhon Alex</a></td>
                                        <td >$25000</td>
                                        <td >Penddng</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >
                                            <select name="booking_action">
                                                <option value="accepted">Accepted</option>        
                                                <option value="rejected">Rejected</option>        
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >2</td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/propertydetails/22">Floor 1 </a></td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/tenant-details/1">Jhon Alex</a></td>
                                        <td >$25000</td>
                                        <td >Proccesing</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >
                                            <select name="booking_action">
                                                <option value="accepted">Accepted</option>        
                                                <option value="rejected">Rejected</option>        
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >3</td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/propertydetails/22">Floor 17 </a></td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/tenant-details/1">Jhon Alex</a></td>
                                        <td >$20000</td>
                                        <td >Penddng</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >
                                            <select name="booking_action">
                                                <option value="accepted">Accepted</option>        
                                                <option value="rejected">Rejected</option>        
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >4</td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/propertydetails/22">Floor 1 </a></td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/tenant-details/1">Jhon Alex</a></td>
                                        <td >$55000</td>
                                        <td >Penddng</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >
                                            <select name="booking_action">
                                                <option value="accepted">Accepted</option>        
                                                <option value="rejected">Rejected</option>        
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >5</td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/propertydetails/22">Floor 81 </a></td>
                                        <td > <a href="http://122.160.138.253:8080/property/public/tenant-details/1">Jhon Alex</a></td>
                                        <td >$25000</td>
                                        <td >Penddng</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >
                                            <select name="booking_action">
                                                <option value="accepted">Accepted</option>        
                                                <option value="rejected">Rejected</option>        
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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