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
                      <div class="title">Building & Units</div>
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
                    <!-- <div class="col-md-6 col-lg-2">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                            <div class="info">
                                <h4>Contracts</h4>
                                <p><b>10</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                            <div class="info">
                                <h4>Tenants</h4>
                                <p><b>500</b></p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-6 col-lg-2">
                        <a href="{{ url('/list-units?occupied=yes') }}">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Occupied units</h4>
                               <p><b>{{ $occuoideUnits }}</b></p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <a href="{{ url('/list-units?occupied=no') }}">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Unoccupied units</h4>
                                <p><b>{{ $unoccupideUnits }}</b></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <div class="title">Tenants & Contracts</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-2">
                        <a href="{{ url('/my-contract-list?page=1&search=6') }}">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                            <div class="info">
                                <h4>Active Contracts</h4>
                                <p><b>{{ $activeContracts }}</b></p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <a href="{{ url('/list-all-tenants?status=active') }}">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                            <div class="info">
                                <h4>Active Tenants</h4>
                               <p><b>{{ $activeContracts }}</b></p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ url('/my-contract-list?page=1&last=60') }}">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>New Contracts Signed<br>(Last 60 Days)</h4>
                                <p><b>{{ $contractStartLast60Days }}</b></p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ url('/my-contract-list?page=1&end=60') }}">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Contracts Ending <br>(Next 60 Days)</h4>
                                 <p><b>{{ $contractEnd60Days }}</b></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <div class="title">Actions & Payments</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                            <div class="info">
                                <h4>Open Actions</h4>
                                <p><b>60</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-tasks fa-3x"></i>
                            <div class="info">
                                <h4>Closed Actions</h4>
                                <p><b>20</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Tenants With Payment Delays</h4>
                                <p><b>10</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Total Delay Payments</h4>
                                <p><b>EUR15000</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                            <div class="info">
                                <h4>Deposits To Verify & Refunds</h4>
                                <p><b>15</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if(count($lastBookingRequests) > 0 )
                      <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Last Booking Request</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lastBookingRequests as $request)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a href="{{ url('propertydetails/'.$request->unit_id) }}"> 
                                                {{ substr($request->unit['unit_name'],0,20) }} 
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('tenant-details/'.$request->tenant_id) }}">
                                                {{ $request->user['name']." ". $request->user['last_name']}} 
                                            </a>
                                        </td>
                                        <td>{{ $request->status($request->status) }}</td>
                                        <td><a href="{{ url('contract-details/'.$request->id) }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    @if(count($pendingPayments) > 0 )
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Pending Payments</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Payment Day</th>
                                        <th>Payment For</th>
                                        <th>Amount</th>
                                        <td >Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingPayments as $pendingPayment)
                                    <tr>
                                        <td>
                                            <a href="{{ url('propertydetails/'.$pendingPayment->unit_id) }}">
                                                {!! \Helper::unit_name($pendingPayment->unit_id); !!}
                                            </a>
                                        </td>
                                         
                                        @if(isset($pendingPayment->date))
                                        <td >{!! \Helper::Date($pendingPayment->date); !!}</td>
                                        @elseif(isset($pendingPayment->reading_date))
                                        <td >{!! \Helper::Date($pendingPayment->reading_date); !!}</td>
                                        @else
                                        <td>--</td>
                                        @endif


                                        @if(isset($pendingPayment->rent_status))
                                        <td >Unit Rent</td>
                                        @elseif(isset($pendingPayment->status))
                                        <td >Meter Bill</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($pendingPayment->total_amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $pendingPayment->total_amount }}</td>
                                        @elseif(isset($pendingPayment->amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $pendingPayment->amount }}</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($pendingPayment->rent_status))
                                        <td >{{ $pendingPayment->rent_status }}</td>
                                        @elseif(isset($pendingPayment->status))
                                        <td >{{ $pendingPayment->status }}</td>
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
                </div>
                <div class="row">
                    @if(count($terminateRequests) > 0)
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Termination Request</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>U. Name</th>
                                        <th>Tenant</th>
                                        <th>C. Start Date</th>
                                        <th>C. End Date</th>
                                        <th>Termination Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($terminateRequests as $terminateRequest)
                                    <tr>
                                        <td><a href="{{ url('propertydetails/'.$terminateRequest->unit['id']) }}">{{ $terminateRequest->unit['unit_name']}} </a></td>
                                        <td>
                                            <a href="{{ url('tenant-details/'.$terminateRequest->user['id']) }}">
                                                {{ $terminateRequest->user['name']." ".$terminateRequest->user['last_name']}}
                                            </a>
                                        </td>
                                        <td>{{ $terminateRequest->contract['start_date'] }}</td>
                                        <td>{{ $terminateRequest->contract['end_date'] }}</td>
                                        @if($terminateRequest->notice_period_date)
                                        <td>{{ $terminateRequest->notice_period_date }}</td>
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
                    @if(count($extend_requests) > 0)
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Extend Request</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>C. Start Date</th>
                                        <th>C. End Date</th>
                                        <th>Extend Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($extend_requests as $extend_request)
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">{{$extend_request->unit->unit_name}} </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">{{$extend_request->user->name}}</a></td>
                                        <td>{{$extend_request->contract->start_date}}</td>
                                        <td>{{$extend_request->extend_date}}</td>
                                        <td>@if($extend_request->extend_time)
                                                @php 
                                                    $extend_time = $extend_request->extend_time;
                                                    $days = '';
                                                    if($extend_time > 365){
                                                        $number = explode('.',($extend_time / 365));
                                                        $extend_time=$extend_time % 365;
                                                        $days .= $number[0]." Years ";
                                                    }
                                                    if($extend_time > 30){
                                                        $number = explode('.',($extend_time / 30));
                                                        $extend_time=$extend_time % 30;
                                                        $days .= $number[0]." Months ";
                                                    }
                                                    if($extend_time > 0)
                                                    {
                                                        $days .= $extend_time." days";
                                                    }
                                                @endphp
                                                {{$days}}
                                            @else
                                                0 days
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                  </div>
                <div class="row">
                    @if(count($contractNearEnd) > 0)
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Contract Near End</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>End Date</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contractNearEnd as $contract)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                            <a href="{{ url('propertydetails/'.$request->unit_id) }}"> 
                                                {{ $request->unit['unit_name'] }} 
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('tenant-details/'.$request->tenant_id) }}">
                                                {{ $request->user['name']." ". $request->user['last_name']}} 
                                            </a>
                                        </td>
                                        <td>{{ $contract->end_date }}</td>
                                        <td><a href="{{ url('contract-details/'.$contract->id) }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    @endforeach   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    @if(count($tickets) > 0 )
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Tickets</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td>
                                            <a href="{{ url('propertydetails/'.$ticket->unit_id) }}"> 
                                                {{ substr($ticket->unit['unit_name'],0,20) }} 
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('tenant-details/'.$ticket->tenant_id) }}">
                                                {{ $ticket->user['name']." ". $ticket->user['last_name']}} 
                                            </a>
                                        </td>
                                        <td>{{ substr($ticket->title,0,15) }}</td>
                                        <td>{{ ucfirst($ticket->status) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                  </div>
                  <div class="row">
                   <!--  <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Legal Actions</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Tenant</th>
                                        <th>Action By</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ url('propertydetails/22') }}">Unit Name </a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Jhon Alex</a></td>
                                        <td><a href="{{ url('tenant-details/1') }}">Yemi Yemi</a></td>
                                        <td>07 September, 2020</td>
                                        <td>Contract Extensions</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>   -->
                    @if(count($newTenants) >0)
                      <div class="col-md-12">
                        <div class="tile tenant">
                            <h3 class="tile-title">New Tenants</h3>
                            <table class="table table-striped" id="tenant_table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($newTenants as $tenants)
                                    <tr>
                                        @if($tenants->image)
                                        <td><img src="{{ url('images/users/'.$tenants->image) }}" style="width: 50px;"></td>
                                        @else
                                        <td><img src="{{ url('images/users/user-image.png') }}" style="width: 50px;"></td>
                                        @endif
                                        <td>{{ $tenants->user['name']." ".$tenants->user['last_name']}}</td>
                                        <td>{{ $tenants->user['email'] }}</td>
                                        @if($tenants->user['phone_no'] !='')
                                            <td>{{ $tenants->user['phone_no'] }}</td>
                                        @else
                                            <td>--</td>
                                        @endif
                                        <td><a href="{{ url('tenant-details/'.$tenants->user['id']) }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                      </div>
                    @endif
                  </div>
                <div class="row">
                    @if(count($legalActions) > 0)
                        <div class="col-md-12">
                            <div class="tile">
                                <h3 class="tile-title">Legal Action</h3>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Assign By</th>
                                            <th>Assign To</th>
                                            <th>Assign Date</th>
                                            <th>Related To</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($legalActions as $legalAction)
                                        <tr>
                                            <td><a href="{{ url('tenant-details/'.$legalAction->po_id) }}">{{ $legalAction->propertyOwner['name']." ".$legalAction->propertyOwner['name']}} </a></td>
                                            <td><a href="{{ url('tenant-details/'.$legalAction->legal_advisor_id) }}">{{ $legalAction->legalAdvisor['name']." ".$legalAction->legalAdvisor['name']}}</a></td>
                                            <td>{{ Carbon\Carbon::parse($legalAction->create_time)->format('Y/m/d') }}</td>
                                            <td>{{ $legalAction->related_to }}</td>
                                            <td>{{ $legalAction->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if(count($tasks) > 0 )
                    <div class="col-md-12">
                        <div class="tile">
                            <h3 class="tile-title">Tasks</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Name</th>
                                        <th>Payment Day</th>
                                        <th>Payment For</th>
                                        <th>Amount</th>
                                        <td >Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $pendingPayment)
                                    <tr>
                                        <td>
                                            <a href="{{ url('propertydetails/'.$pendingPayment->unit_id) }}">
                                                {!! \Helper::unit_name($pendingPayment->unit_id); !!}
                                            </a>
                                        </td>
                                         
                                        @if(isset($pendingPayment->date))
                                        <td >{!! \Helper::Date($pendingPayment->date); !!}</td>
                                        @elseif(isset($pendingPayment->updated_at))
                                        <td >{!! \Helper::Date($pendingPayment->updated_at); !!}</td>
                                        @else
                                        <td>--</td>
                                        @endif


                                        @if(isset($pendingPayment->rent_status))
                                        <td >Unit Rent</td>
                                        @elseif(isset($pendingPayment->status))
                                        <td >Meter Bill</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($pendingPayment->total_amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $pendingPayment->total_amount }}</td>
                                        @elseif(isset($pendingPayment->amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $pendingPayment->amount }}</td>
                                        @else
                                        <td>--</td>
                                        @endif

                                        @if(isset($pendingPayment->rent_status))
                                        <td >{{ $pendingPayment->rent_status }}</td>
                                        @elseif(isset($pendingPayment->status))
                                        <td >{{ $pendingPayment->status }}</td>
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
      .messanger {display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; -ms-flex-direction: column; flex-direction: column; }
      .messanger .messages {-webkit-box-flex: 1; -ms-flex: 1; flex: 1; margin: 10px 0; padding: 0 10px; max-height: 260px; overflow-y: auto; overflow-x: hidden; }
      .messanger .messages .message {display: -webkit-box; display: -ms-flexbox; display: flex; margin-bottom: 15px; -webkit-box-align: start; -ms-flex-align: start; align-items: flex-start; }
      .messanger .messages .message.me {-webkit-box-orient: horizontal; -webkit-box-direction: reverse; -ms-flex-direction: row-reverse; flex-direction: row-reverse; }
      .messanger .messages .message.me img {margin-right: 0; margin-left: 15px; }
      .messanger .messages .message.me .info {background-color: #f48400; color: #FFF; }
      .messanger .messages .message.me .info:before {display: none; }
      .messanger .messages .message.me .info:after {position: absolute; right: -13px; top: 0; content: ""; width: 0; height: 0; border-style: solid; border-width: 0 16px 16px 0; border-color: transparent #f48400 transparent transparent; -webkit-transform: rotate(270deg); -ms-transform: rotate(270deg); transform: rotate(270deg); }
      .messanger .messages .message img {border-radius: 50%; margin-right: 15px; }
      .messanger .messages .message .info {margin: 0; background-color: #ddd; padding: 5px 10px; border-radius: 3px; position: relative; -ms-flex-item-align: start; align-self: flex-start; }
      .messanger .messages .message .info:before {position: absolute; left: -14px; top: 0; content: ""; width: 0; height: 0; border-style: solid; border-width: 0 16px 16px 0; border-color: transparent #ddd transparent transparent; }
      .messanger .sender {display: -webkit-box; display: -ms-flexbox; display: flex; }
      .messanger .sender input[type="text"] {-webkit-box-flex: 1; -ms-flex: 1; flex: 1; border: 1px solid #a6a9a8; outline: none; padding: 5px 10px; }
      .messanger .sender button {border-radius: 0; }
      table td a {color: black; }
    </style>
@endsection