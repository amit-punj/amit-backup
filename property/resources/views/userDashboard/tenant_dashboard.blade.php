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
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Deposit</h4>
                                <p><b>{{ App\Helpers\Helper::CURRENCYSYMBAL. $depositAmount}}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                            <div class="info">
                                <h4>Contracts Status</h4>
                                <p><b>Active</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-exclamation-triangle fa-3x"></i>
                            <div class="info">
                                <h4>Due Amount</h4>
                                <p><b style="color:red">$5500</b></b></p>
                                <p>Date: {{ App\Helpers\Helper::Date( date('Y/m/d', strtotime("+1 months", strtotime(date("Y-m-d H:m:s"))))) }}</p>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    @if(count($PendingRequests) > 0)
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Booking Requests</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th >Unit name</th>
                                        <th >Step</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($PendingRequests as $contract)
                                    <tr>
                                        <td> <a href="{{url('propertydetails/'.$contract->unit_id)}}">    {{ substr($contract->unit['unit_name'],0,20) }}</a></td>
                                        <td >{{$contract->step}}</td>
                                        <td ><a class="btn btn-success" href="{{url('book-property/'.$contract->unit_id)}}">Procceed</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    @if(count($appointments) > 0)
                      <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Appointments</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Appointment With</th>
                                        <th>Appointment Type</th>
                                        <th>Time</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        @if($appointment->unit['unit_name'])
                                            <td><a href="{{ url('propertydetails/'.$appointment->unit_id) }}">{{ $appointment->unit['unit_name'] }} </a></td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        @if($appointment->pde_id)
                                            <td>Property Description Expert</td>
                                        @elseif($appointment->vo_id)
                                            <td>Visit Organiser</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        <td>{{ $appointment->appointment_type }}</td>
                                        <td>{{ $appointment->time }}</td>
                                        <td>
                                            @if($appointment->appointment_status == 0)
                                                <span >Waiting for Confirmation!</span>
                                            @elseif($appointment->appointment_status == 1)
                                                <span >Accepted!</span>
                                            @elseif($appointment->appointment_status == 2)
                                                <span >Rejected!</span>
                                            @elseif($appointment->appointment_status == 3)
                                                <span >Assigned Another Dates!</span><br>
                                            @elseif($appointment->appointment_status == 4)
                                                <span >Rejected by Tenant!</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    @if(count($transactions) > 0)
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Payment History</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td >S.No</td>
                                        <td >Date</td>
                                        <td >Related to</td>
                                        <td >Payment Method</td>
                                        <td >Amount</td>
                                    </tr> 
                                </thead>
                                <tbody>
                                    @foreach($transactions as $key =>$transaction)         
                                        <tr>
                                            <td >{{ ++$key }}</td>
                                            <td >{!! \Helper::Date($transaction->created_at); !!}</td>
                                            <td >
                                                @if($transaction->related_to == 'AddMoney')
                                                    @if($transaction->payment_by == 'Paypal')
                                                        <span>Added to Wallet from Paypal</span>
                                                    @else($transaction->payment_by == 'Stripe')
                                                        <span>Added to Wallet from Stripe</span>
                                                    @endif
                                                @elseif($transaction->related_to == 'PayDues')
                                                    <span>Pay dues by {{ucfirst($transaction->payment_by)}}</span>
                                                @elseif($transaction->related_to == 'meter bill')
                                                    <span>Meter Bill</span>
                                                @elseif($transaction->related_to == 'rent')
                                                    <span>Unit Rent</span>
                                                @endif
                                            </td>
                                            <td >{{ ucfirst($transaction->payment_by) }}</td>
                                            <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}}{{ $transaction->amount }}</td>
                                        </tr>  
                                    @endforeach                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div> 
    <script type="text/javascript">
        $( document ).ready(function() {
            var ids = "{{ (isset($_GET['id'])) ? $_GET['id'] : 'nostring' }}";
            var abc = "{{$contracts}}";
            if(ids == 'nostring')
            {
                if (abc > 0) 
                {
                    alert('You have pending appointments for booking!');
                }
            }
        });
    </script>
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