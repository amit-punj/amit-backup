@section('title','Appointment Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Appointment Details'])
    <div class="container bootom-space">
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
                    <div class="col-sm-8">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="unit" ><span><strong>Tenant Name : </span></strong></td>
                                    <td>{{ $appointmentDetail->tenant['name']." ".$appointmentDetail->tenant['last_name'] }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span><strong>Appointment type : </span></strong></td>
                                    <td>{{ $appointmentDetail->appointment_type }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span><strong>Email : </span></strong></td>
                                    <td>{{ $appointmentDetail->tenant['email'] }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span><strong>Phone No. : </span></strong></td>
                                    <td>{{ $appointmentDetail->tenant['phone_no'] }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span><strong>Address : </span></strong></td>
                                    @if($appointmentDetail->unit['address'])
                                    <td>{{ $appointmentDetail->unit['address'] }}</td>
                                    @else
                                    <td>--</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="unit" ><span><strong>Date : </span></strong></td>
                                    <td>{{ $appointmentDetail->time }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span><strong>Title : </span></strong></td>
                                    <td>{{ $appointmentDetail->title }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span><strong>Description : </span></strong></td>
                                    <td>{{ $appointmentDetail->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-4 float-right">
                        <div class="add-unit-main">
                            <a class="btn btn-success" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                </div>                                     
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-sm-6">
                <div class="Building-Units">Documents</div>
            </div>
            @if(Auth::user()->user_role != 1)
            <div class="col-sm-6">
                <div class="add-unit-main">
                    <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Doc <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
            </div>
            @endif
        </div>  -->
        @if($appointmentDetail->unit['latitude'] && $appointmentDetail->unit['longitude'] )
        <div class="row">
            <div class="col-sm-12"><div class="location_on_map">Location In Map</div></div>
            <div class="col-sm-12">
                <iframe src = "https://maps.google.com/maps?q={{$appointmentDetail->unit['latitude']}},{{$appointmentDetail->unit['longitude']}}&hl=es;z=14&amp;output=embed" width="100%" height="500px"></iframe>
            </div>
        </div>
        @endif
    </div> 

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
        .add-unit-main {text-align: right; margin-top: 20px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .location_on_map {font-size: 24px; text-align: center; padding: 50px 0 20px; }
        .Building-title {font-size: 24px; }
        td.unit { width: 25%;}
        .Building-Units {font-size: 28px; margin-top: 20px;}
    </style>
    
@endsection