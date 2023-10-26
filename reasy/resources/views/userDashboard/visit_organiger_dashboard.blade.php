@section('title','Dashboard')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Dashboard'])
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <div class="col-md-6 col-lg-3">
                      <div class="title">General Information</div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-building fa-3x"></i>
                            <div class="info">
                                <h4>Buildings</h4>
                                <p><b>{{ $numberOfBuildings }}</b></p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-6 col-lg-2">
                        <a href="{{ url('/list-units') }}">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Units</h4>
                                <p><b> {{ $numberOfUnits }}</b></p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                            <div class="info">
                                <h4>Tenants</h4>
                                <p><b> {{ $numberOfTenants }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                            <div class="info">
                                <h4>Upcoming Appointments</h4>
                                <p><b>{{ $NumberOfUpcomingAppointments }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-building fa-3x"></i>
                            <div class="info">
                                <h4>Completed Appointments</h4>
                                <p><b>{{ $completedAppointments }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>                 
                <div class="row">
                    @if(count($appointments) > 0)
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Today Appointments</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Appointment Time</th>
                                        <th>Unit Name</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $appointment->time }}</td>
                                        @if($appointment->unit)
                                            <td>{{ $appointment->unit['unit_name'] }}</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        @if($appointment->unit)
                                            <td>{{ $appointment->unit['address'] }}</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    @if(count($upcomingAppointments) > 0)
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Upcoming Appointments</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Appointment Time</th>
                                        <th>Unit Name</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingAppointments as $upcomingAppointment)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $upcomingAppointment->time }}</td>
                                        @if($upcomingAppointment->unit['unit_name'])
                                            <td>{{ $upcomingAppointment->unit['unit_name'] }}</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        @if($upcomingAppointment->unit['address'])
                                            <td>{{ $upcomingAppointment->unit['address'] }}</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                   <!-- <tr>
                                        <td>2</td>
                                        <td>07 August, 2019 - 08:25 am</td>
                                        <td>Jhon Alex</td>
                                        <td>MDC Sec 5, Panchkula, Haryana, India 136118</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>07 August, 2019 - 08:25 am</td>
                                        <td>Jhon Alex</td>
                                        <td>MDC Sec 5, Panchkula, Haryana, India 136118</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>07 August, 2019 - 08:25 am</td>
                                        <td>Jhon Alex</td>
                                        <td>MDC Sec 5, Panchkula, Haryana, India 136118</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>07 August, 2019 - 08:25 am</td>
                                        <td>Jhon Alex</td>
                                        <td>MDC Sec 5, Panchkula, Haryana, India 136118</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>                
            </div>
        </div>
    </div> 
    <style type="text/css">
      .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
      .widget-small {display: -webkit-box; display: -ms-flexbox; display: flex; border-radius: 4px; color: #FFF; margin-bottom: 30px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); }
      .widget-small .icon {display: -webkit-box; display: -ms-flexbox; display: flex; min-width: 50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; padding: 20px; background-color: rgba(0, 0, 0, 0.2); border-radius: 4px 0 0 4px; font-size: 2.5rem; }
      .widget-small .info {-webkit-box-flex: 1; -ms-flex: 1; flex: 1; padding: 0 20px; -ms-flex-item-align: center; align-self: center; }
      .widget-small .info h4 {text-transform: uppercase; margin: 0; margin-bottom: 5px; font-weight: 400; font-size: 1.1rem; }
      .widget-small .info p {margin: 0; font-size: 16px; }
      .widget-small.primary {background-color: #009688; }
      .widget-small.primary.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767;; color: #2a2a2a; }
      .widget-small.primary.coloured-icon .icon {background-color: #009688; color: #fff; }
      .widget-small.info {background-color: #17a2b8; }
      .widget-small.info.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
      .widget-small.info.coloured-icon .icon {background-color: #17a2b8; color: #fff; }
      .widget-small.warning {background-color: #ffc107; }
      .widget-small.warning.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
      .widget-small.warning.coloured-icon .icon {background-color: #ffc107; color: #fff; }
      .widget-small.danger {background-color: #dc3545; }
      .widget-small.danger.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
      .widget-small.danger.coloured-icon .icon {background-color: #dc3545; color: #fff; }
      .title {font-size: 20px; }
      .tile { box-shadow: 2px 2px 4px #756767; padding: 15px; margin-bottom: 15px; border-radius: 3px; }
      .tile.tenant img {border-radius: 50%; }
      .tile.tenant a span {color: black; }
      table#tenant_table td {vertical-align: middle; }
      table td a {color: black; }
    </style>
@endsection