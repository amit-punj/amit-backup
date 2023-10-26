@section('title','List Of Tasks')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List Of Tasks'])
<?php 
$role = Auth::user()->user_role;
?>
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
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">List Of Hold Rents</h3>
                            @if(count($holdRents) > 0 )
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Payment Day</th>
                                        <th>Payment For</th>
                                        <th>Amount</th>
                                        <th >Status</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($holdRents as $holdRent)
                                    <?php
                                        $transactionPermission = App\Helpers\Helper::accessPermissionWithUnitId($holdRent->unit_id,Auth::user()->user_role,'transactio_permission');
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="{{ url('propertydetails/'.$holdRent->unit_id) }}">
                                                {!! \Helper::unit_name($holdRent->unit_id); !!}
                                            </a>
                                        </td>
                                         
                                        @if(isset($holdRent->date))
                                        <td >{!! \Helper::Date($holdRent->date); !!}</td>
                                        @else
                                        <td>--</td>
                                        @endif


                                        @if(isset($holdRent->rent_status))
                                        <td >Unit Rent</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($holdRent->total_amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $holdRent->total_amount }}</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($holdRent->rent_status))
                                        <td >{{ $holdRent->rent_status }}</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(($transactionPermission == 1) ||  ($transactionPermission == 2) )
                                        <td><button onclick='confirnRent("{{ url('rent-confirmed/'.$holdRent->id) }}")' class="btn btn-success">confirm</button></td>
                                        @else
                                        <td> Not Permission</td>
                                        @endif
                                    </tr>
                                    @endforeach                  
                                </tbody>
                            </table>
                            @else
		                    	<div class="not_found">Not Found Any Record</div>
		                    @endif
                        </div>
                        {{ $holdRents->links() }}
                    </div>
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">List Of Hold Bills</h3>
                            @if(count($holdReadings) > 0 )
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Payment Day</th>
                                        <th>Payment For</th>
                                        <th>Amount</th>
                                        <th >Status</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($holdReadings as $holdReading)
                                    <?php
                                        $transactionPermission = App\Helpers\Helper::accessPermissionWithUnitId($holdReading->unit_id,Auth::user()->user_role,'transactio_permission');
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="{{ url('propertydetails/'.$holdReading->unit_id) }}">
                                                {!! \Helper::unit_name($holdReading->unit_id); !!}
                                            </a>
                                        </td>
                                         
                                       	@if(isset($holdReading->reading_date))
                                        <td >{!! \Helper::Date($holdReading->reading_date); !!}</td>
                                        @else
                                        <td>--</td>
                                        @endif


                                        @if(isset($holdReading->status))
                                        <td >Meter Bill</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($holdReading->amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $holdReading->amount }}</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($holdReading->status))
                                        <td >{{ $holdReading->status }}</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(($transactionPermission == 1) ||  ($transactionPermission == 2) )
                                        <td><button onclick='confirnBill("{{ url('bill-confirmed/'.$holdReading->id) }}")' class="btn btn-success">confirm</button></td>
                                        @else
                                        <td> Not Permission</td>
                                        @endif
                                    </tr>
                                    @endforeach                  
                                </tbody>
                            </table>
                            @else
		                    	<div class="not_found">Not Found Any Record</div>
		                    @endif
                        </div>
                        {{ $holdReadings->links() }}
                    </div>
                </div>                                        
            </div>
        </div>
    </div>
    <script type="text/javascript">
    	function confirnBill(url) {
    		if(confirm('Please have an assurance Bill is Paid By Tenant')){
    			window.location.href = url;
    		}
    	}
    	function confirnRent(url) {
    		if(confirm('Please have an assurance Rent is Paid By Tenant')){
    			window.location.href = url;
    		}
    	}
    </script> 
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