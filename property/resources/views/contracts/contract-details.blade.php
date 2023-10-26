@section('title','Contract Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Contract Details'])
<?php
$role = Auth::user()->user_role; 
$contractPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'contract_permission');
$transactioPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'transactio_permission');
$documentsPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'documents_permission');
$ticketsPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'tickets_permission');
?>
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
                    <div class="col-sm-6">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="unit" ><span>Contract Type : </span></th>
                                <th>{{ucfirst($contract->contract_type) }}</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Status : ?></span></td>
                                    <td>
                                        @if(Auth::user()->user_role == 1 )
                                            @if($contract->status == 0 )
                                                <span>Draft (Pending for confirmation)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                <span>Draft(Pending bank receipt)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'stripe' && $contract->payment_status == 'hold')
                                                <span>Draft(Pending for confirmation)</span>
                                            @elseif($contract->status == 3)
                                                <span>Booked</span>
                                            @elseif($contract->status == 4)
                                                <span>Draft (Booking request canceled by PM)</span>
                                            @elseif($contract->status == 6)
                                                <span>Active</span>
                                            @elseif($contract->status == 7)
                                                <span>Draft (Canceled by tenant)</span>
                                            @elseif($contract->status == 8)
                                                <span>Termination request send</span>
                                            @elseif($contract->status == 9)
                                                <span>Passed</span> 
                                            @elseif($contract->status == 10)
                                                <span>Draft (Unable to upload receipt)</span>
                                            @endif
                                        @elseif(Auth::user()->user_role == 2 || Auth::user()->user_role == 3 || Auth::user()->user_role == 4 || Auth::user()->user_role == 5)
                                            @if($contract->status == 0 && $contract->payment_status == 'paid')
                                                <span>Draft (Pending for confirmation)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                <span>Draft (Pending bank receipt)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'stripe' && $contract->payment_status == 'hold')
                                                <span>Draft(Pending for confirmation)</span>
                                            @elseif($contract->status == 3)
                                                <span>Booked</span>
                                            @elseif($contract->status == 4)
                                                <span>Draft (Booking canceled by PM)</span>
                                            @elseif($contract->status == 6)
                                                <span>Active</span>
                                            @elseif($contract->status == 7)
                                                <span>Draft (Canceled by tenant)</span>
                                            @elseif($contract->status == 8)
                                                <span>Termination request send</span>
                                            @elseif($contract->status == 9)
                                                <span>Passed</span>
                                            @elseif($contract->status == 10)
                                                <span>Draft (Unable to upload receipt)</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Contract With : </span></td>
                                    <td>
                                        <a href="{{ url('tenant-details/'.$tenant->id) }}">{{ $tenant->name." ".$tenant->last_name }}</a>
                                        @if(count($sub_tenants) > 0)
                                            @foreach($sub_tenants as $key => $value)
                                            ,<a href="{{ url('tenant-details/'.$value->tenant_id) }}">{{$value->user->name." ".$value->user->last_name}}</a>  
                                            @endforeach
                                        @endif
                                        @if(Auth::user()->user_role == 2 || Auth::user()->user_role == 3)
                                        <!-- <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#updateModel">Add Tenant <span class="glyphicon glyphicon-plus"></span></button> -->
                                        @endif
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td class="unit" ><span>Owner Name : </span></td>
                                    <td><a href="{{ url('tenant-details/'.$propertyOwner->id) }}">{{ $propertyOwner->name." ".$propertyOwner->last_name }}</a></td>
                                </tr> -->
                                <tr>
                                    <td class="unit" ><span>Guarantor Name : </span></td>
                                    <td><a href="{{ url('guarantor-details/'.$guarantor->id) }}">{{ $guarantor->name }}</a></td>
                                </tr>
                                @if($role == 2 || $role == 3 || $role == 4 || $role == 6)
                                <tr>
                                    <td class="unit" ><span>Legal Advisor : </span></td>
                                    <td><a href="{{ url('tenant-details/'.$propertyLegalAdvisor->id) }}">{{ $propertyLegalAdvisor->name." ".$propertyLegalAdvisor->last_name }}</a></td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="unit" ><span>Deposit Amount: </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->deposit_amount }}   ({{ ucfirst($contract->payment_status) }})</td>
                                </tr>
                                <!-- <tr>
                                    <td class="unit" ><span>Deposit : </span></td>
                                    <td>{{ ucfirst($contract->payment_status) }}</td>
                                </tr> --> 
                                @if( $contract->payment_method == 'bank' )
                                <tr>
                                    <td class="unit" ><span>Bank Account : </span></td>
                                    <td>HDFC, Sector 5, Panchkula, Haryana 134109</td>
                                </tr>
                                @elseif($contract->payment_method == 'paypal')
                                <tr>
                                    <td class="unit" ><span>Payment Method : </span></td>
                                    <td>
                                        {{ucfirst($contract->payment_method)}}
                                    </td>
                                </tr>
                                @elseif($contract->payment_method == 'stripe')
                                <tr>
                                    <td class="unit" ><span>Payment Method : </span></td>
                                    <td> Credit or Debit Card </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="unit" ><span>Contract Period : </span></td>
                                    <td>{{ App\Helpers\Helper::Date($contract->start_date) }} to {{ App\Helpers\Helper::Date($contract->end_date) }} </td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Next Payment : </span></td>
                                    <td>{{ App\Helpers\Helper::Date( date('Y/m/d', strtotime("+1 months", strtotime($contract->start_date)))) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <div class="widget-small {{ ($contract->payment_status == 'pending' || $contract->payment_status == 'hold') ? 'danger' : 'success' }} coloured-icon">
                            <i class="icon fa fa-{{ ($contract->payment_status == 'pending' || $contract->payment_status == 'hold') ? 'exclamation-triangle danger' : 'check success' }} fa-3x"></i>
                            <div class="info" >
                                <h4>Amount</h4>
                                <p><b>{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$contract->total_amount }}</b></b></p>
                                <p>Payment Method: 
                                    @if( $contract->payment_method == 'bank' )
                                        Bank
                                    @elseif($contract->payment_method == 'paypal')
                                       {{ucfirst($contract->payment_method)}}
                                    @elseif($contract->payment_method == 'stripe')
                                        Credit or Debit Card
                                    @endif
                                </p>
                                <p>Payment Status: {{ ucfirst($contract->payment_status) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @if($role == 2 || $role == 1)
                            @include('dashboard.legal-action-popup')
                        @elseif($role == 3 && (($contractPermission == 1) || ($contractPermission == 2)))
                            @include('dashboard.legal-action-popup')
                        @endif
                    </div>
                </div> 

                <div class="row">
                    <div class="col-sm-6">
                        <h3>Unit Details:</h3>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="unit"><span>Unit Name :</span></th>
                                <th><a href="{{ url('propertydetails/'.$unit->id) }}">{{ $unit->unit_name }}</a></th>
                            </thead>
                            <tbody>
                                @if(!empty($unit->building_id))
                                <tr>
                                    <td class="unit" ><span>Building Name : </span></td>
                                    <td>{{ (isset($unit->building->unit_name)) ? $unit->building->unit_name : "No Building" }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="unit" ><span>Unit Address : </span></td>
                                    <td>{{ $unit->address }}</td>
                                </tr>
                                <!-- <tr>
                                    <td class="unit" ><span>Unit Type : </span></td>
                                    <td>{{ucfirst($unit->u_type)." (".ucfirst($unit->unit_category).")" }}</td>
                                </tr> -->
                                <tr>
                                    <td class="unit" ><span>Unit Size({{$unit->area_in}}) : </span></td>
                                    <td>{{ $unit->area }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Unit Rent : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $contract->rent }}</td>
                                </tr> 
                                <tr>
                                    <td class="unit" ><span>Fixed Charges : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->fixed_charges + $contract->property_tax }} </td>
                                </tr>
                                <!-- <tr>
                                    <td class="unit" ><span>Deposit : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->deposit_amount }} </td>
                                </tr> -->
                                <tr>
                                    <td class="unit" ><span>Cost Provision : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->cost_provision }} </td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Total Amount per Month : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->rent + $contract->fixed_charges + $contract->property_tax + $contract->cost_provision}} </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                  <!--   <div class="col-sm-6">
                        <h3>Guarantor Details</h3>
                        <table class="table table-hover table-striped table-bordered">
                        @if(isset($contract->choose_guarantor) && $contract->choose_guarantor == 'yes' )
                            <thead>
                                <th class="unit"><span>Name :</span></th>
                                <th>{{ $guarantor->name }}</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Email : </span></td>
                                    <td>{{ $guarantor->email }}</a></td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Phone No : </span></td>
                                    <td>{{ $guarantor->phone_no }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Address : </span></td>
                                    <td>{{ $guarantor->address }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Photo : </span></td>
                                    <td><img src="{{ url('images/guarantor/'.$guarantor->photo) }}" width="80" height="60"> </td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Photo Id Proof : </span></td>
                                    <td><img src="{{ url('images/guarantor/'.$guarantor->photo_id_proof) }}" width="80" height="60"> </td>
                                </tr> 
                            </tbody>
                        @else
                            <thead>
                                <th class="unit" colspan="2"><span>Don't have Guarantor</span></th>
                            </thead>
                        @endif
                        </table>
                    </div>  -->
                </div>  
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="Building-Units">Management</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" style="margin-left: -6px;" role="tablist">
                            <!-- <li class="dropdown">
                                <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">Refunds <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a data-toggle="tab" href="#clearDues">Dues</a></li>
                                    <li><a data-toggle="tab" href="#refundStatus">Refund Status</a></li>
                                </ul>
                            </li> -->
                            <li class="active"><a data-toggle="tab" href="#tickets">Repairs</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">Others <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a data-toggle="tab" href="#communication">Communication</a></li> -->
                                    <li ><a data-toggle="tab" href="#transaction">Payments</a></li>
                                    <li><a data-toggle="tab" id="doc" href="#document">Documents</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="communication" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Communication</div>
                                    </div>
                                </div> 
                                <div class="row" style="margin-left: 0px;">
                                    <div class="col-md-3">
                                        @include('dashboard.sidebar')
                                    </div>
                                    <div class="col-md-9">
                                        <div class="chat-container">
                                          <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" style="width:100%;">
                                          <p>Hello. How are you today?</p>
                                          <span class="time-right">11:00</span>
                                        </div>
                                        <div class="chat-container darker">
                                          <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" class="right" style="width:100%;">
                                          <p>Hey! I'm fine. Thanks for asking!</p>
                                          <span class="time-left">11:01</span>
                                        </div>
                                        <div class="chat-container">
                                          <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" style="width:100%;">
                                          <p>Sweet! So, what do you wanna do today?</p>
                                          <span class="time-right">11:02</span>
                                        </div>
                                        <div class="chat-container darker">
                                          <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" class="right" style="width:100%;">
                                          <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                                          <span class="time-left">11:05</span>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div id="transaction" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Payments</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="add-unit-main" >
                                            <a style="float: right; margin-bottom: 10px;" href="{{url('downloadExcel/'.$contract->id.'/xls')}}" class="btn btn-success">Export</a>
                                        </div>
                                    </div>
                                    @if(Auth::user()->user_role == 1)
                                    @endif
                                </div> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if(count($transactions) > 0 )
                                            <div class="user-info-table">
                                                <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                                    <thead>
                                                        <tr>
                                                            <td >Date</td>
                                                            <td >Related to</td>
                                                            <!-- <td >Description</td> -->
                                                            <td >Amount</td>
                                                            <td >Payment Method</td>
                                                            @if($role == 2)
                                                                <!-- <td >Action</td> -->
                                                            @elseif( $role == 3 && $transactioPermission == 2  )
                                                                <!-- <td >Action</td> -->
                                                            @endif
                                                        </tr> 
                                                    </thead>   
                                                    <tbody >  
                                                        @foreach($transactions as $key => $transaction)        
                                                            <tr>
                                                                <td > {!! \Helper::Date($transaction->created_at); !!}</td>
                                                                <td >{{ $transaction->related_to }}</td>
                                                                <!-- <td >{{ $transaction->description }}</td> -->
                                                                <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$transaction->amount }}</td>
                                                                <td > 
                                                                @if($transaction->payment_by == 'Stripe') 
                                                                    Credit or Debit Card
                                                                @else
                                                                    {{ ucfirst($transaction->payment_by)}}
                                                                @endif
                                                                </td>
                                                                <!-- <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td> -->
                                                                @if($role == 2)
                                                                    <!-- <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td> -->
                                                                @elseif( $role == 3 && $transactioPermission == 2  )
                                                                    <!-- <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td> -->
                                                                @endif
                                                            </tr> 
                                                        @endforeach 
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="document" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Documents</div>
                                    </div>
                                    @if(Auth::user()->user_role == 2)
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Doc <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @elseif(Auth::user()->user_role == 3 && ($documentsPermission == 2))
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Doc <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div> 

                                @include('dashboard.contract-documents')
                            </div>
                            <div id="clearDues" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Dues</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table table-hover table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="unit"><span>Water Bill :</span></td>
                                                <td>{{ App\Helpers\Helper::CURRENCYSYMBAL}} 20</td>
                                            </tr>
                                            <tr>
                                                <td class="unit" ><span>Electricity Bill : </span></td>
                                                <td>{{ App\Helpers\Helper::CURRENCYSYMBAL}} 100</td>
                                            </tr>
                                            <tr>
                                                <td class="unit" ><span>Internet Bill : </span></td>
                                                <td>{{ App\Helpers\Helper::CURRENCYSYMBAL}} 5</td>
                                            </tr>
                                            <tr>
                                                <td class="unit" ><span>Miscellaneous : </span></td>
                                                <td>{{ App\Helpers\Helper::CURRENCYSYMBAL}} 50</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                                 
                            </div>
                            <div id="refundStatus" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Refund Status</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if(count($refunds) > 0 )
                                        <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                                <thead>
                                                    <tr>
                                                        <td >Payment Mode</td>
                                                        <td >Payment Amount</td>
                                                        <td >Related to</td>
                                                        <td >Date</td>
                                                        <td >Status</td>
                                                    </tr> 
                                                </thead>   
                                                <tbody >
                                                    @foreach($refunds as $key => $refund)         
                                                    <tr>
                                                        <td >{{ucfirst($refund->method)}}</td>
                                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$refund->refund_amount}}</td>
                                                        <td >{{$refund->related_to}}</td>
                                                        <td >{{ App\Helpers\Helper::Date($refund->time)}}</td>
                                                        <td >{{$refund->status}}</td>
                                                        <!-- <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td> -->
                                                    </tr>
                                                    @endforeach 
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                            <p>No refund</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="tickets" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">List of Repairs</div>
                                    </div>
                                    @if($contract->status == 6)
                                    @if(Auth::user()->user_role == 1)
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                            <button style="float: right;margin-bottom: 10px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#TicketModal">Ask Repair <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if(count($tickets) > 0 )
                                        <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                                <thead>
                                                    <tr>
                                                        <td >Title</td>
                                                        <td >Description</td>
                                                        <td >Department</td>
                                                        <td >Status</td>
                                                        <td >Action</td>
                                                    </tr> 
                                                </thead>   
                                                <tbody > 
                                                    @foreach($tickets as $key => $ticket)        
                                                    <tr>
                                                        <td >{{$ticket->title}}</td>
                                                        <td >{{substr($ticket->description,0,40)}}</td>
                                                        <td >{{ ucfirst($ticket->department)}}</td>
                                                        <td >{{ucfirst($ticket->status) }}</td>
                                                        <td >
                                                            <a href="{{url('ticket-view/'.$ticket->id)}}"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a>
                                                            @if(Auth::user()->user_role == 2 || Auth::user()->user_role == 1)
                                                                @if($ticket->status == 'pending')
                                                                    <button data-id="{{$ticket->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
                                                                @endif
                                                           @elseif(Auth::user()->user_role == 3 && ($ticketsPermission != 0 ))
                                                                @if($ticket->status == 'pending')
                                                                    <button data-id="{{$ticket->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr> 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <p>No Repairs</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div> 
    <div class="modal fade" id="TicketModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('raise-ticket/'.$contract->id)}}" id="raise_ticket">
                    @csrf
                    <input type="hidden" name="unit_id" value="{{$contract->unit_id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Ask Repair</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="t_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="t_title" id="t_title" class="form-control @error('t_title') is-invalid @enderror">
                                @error('t_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('t_description') is-invalid @enderror" cols="50" rows="5" name="t_description" id="t_description"></textarea>
                                @error('t_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Related Department') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('t_department') is-invalid @enderror" name="t_department" id="t_department">
                                    <option value="">Select Department</option>
                                    <option value="pm">Property Manager</option>
                                    <option value="gq">General Question</option>
                                    <option value="electricity">Electricity</option>
                                    <option value="heating">Heating</option>
                                    <option value="internet">Internet</option>
                                    <option value="keys">Keys</option>
                                    <option value="plumbing">Plumbing</option>
                                    <option value="insurance">Insurance</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('t_department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Ask</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="updateModel2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{-- url('/update-unit') --}}" id="create_unit_form">
                    @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Create Unit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Unit Name') }}</label>
                        <div class="col-md-6">
                            <input id="update_unit_name" type="text" class="form-control" name="unit_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rent') }}</label>
                        <div class="col-md-6">
                            <input id="update_rent" type="text" class="form-control" name="rent" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Deposit') }}</label>
                        <div class="col-md-6">
                            <input id="update_deposit" type="text" class="form-control" name="deposit" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-12 col-form-label text-md-right">{{ __('Amenities/Facilities available') }}</label>
                        
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Create Unit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h3 class="modal-title">Create Tenant</h3> -->
                    <ul class="nav nav-pills nav-justified">
                        <li id="create_tenant" class="active"><a href="#">Create Tenant</a></li>
                    </ul>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="create_tenant_form">
                        @csrf
                        <input id="unit_id" type="hidden" class="form-control" name="unit_id" value="{{$contract->unit_id}}">
                        <input id="booking_id" type="hidden" class="form-control" name="booking_id" value="{{$contract->id}}">
                        <div class="form-group row gender_class">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Want new tenant') }}</label>
                            <div class="col-md-6 choose_guarantor_main">
                                Yes <input id="choose_guarantor_yes" type="radio" class="form-control"  name="choose_guarantor" value="yes"> 
                                No <input id="choose_guarantor_no" type="radio" class="form-control"  name="choose_guarantor" value="no" checked="">
                            </div>
                        </div>
                        <div class="form-group row" id="select_tenant">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Select Tenant') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="selected_tenant" id="selected_tenant">
                                    <option value="">Select</option>
                                    @if(count($tenant_list) > 0)
                                    @foreach($tenant_list as $key => $value)
                                        <option value="{{$value->id}}">{{$value->email}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="new_tenant" id="new_tenant" style="display: none;">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="">
                                </div>
                            </div>
                            <div class="form-group row gender_class">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    Male<input id="gender" type="radio" class="form-control" name="gender" value="male" checked>
                                    Female<input id="gender1" type="radio" class="form-control" name="gender" value="female">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="t_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input id="t_email" type="text" class="form-control" name="email" value="" data="false">
                                    <!-- <span style="color: red;" id='email_error'></span> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>
                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="submit" id="create_tenant_button"class="btn btn-success">Create Tenant</button>
                            </div>
                        </div>
                    </form>
                </div>          
            </div>
        </div>
    </div>
<script type="text/javascript">
        var date = new Date();
        $('.form_datetime').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            startDate: date
        });
        jQuery('#create_unit_form').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                unit_name:{
                    required:true,
                },
                rent:{
                    required:true,
                    number:true
                },
                deposit:{
                    required:true,
                    number:true
                },
            }      
        });
        jQuery('#raise_ticket').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                t_title:{
                    required:true,
                },
                t_description:{
                    required:true,
                },
                t_department:{
                    required:true,
                },
            }      
        });

        jQuery('.ticket_close').click(function(){
            var id      = $(this).data('id');
            var status  = jQuery(this).data('status');
            var thisa   = $(this);
            var result  = "";
            if(status == 'closed'){
                var result = confirm("Want to close the ticket?");
            }
            if (!result) {
                return false;
            }
            $.ajax(
            {
                url: "{{url('update-ticket-status')}}",
                type: "post",
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id':id,
                    'status':status
                },
                success : function(data) { 
                  var myJSON = JSON.parse(data); 
                  location.reload();
                },
                error : function(data) {
                }
            });
        });
        $("#doc").click(function(){
            $("#menu_description").addClass("active");
        });
</script>
<script type="text/javascript">
    jQuery('#create_tenant_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            name:{
                required:'#choose_guarantor_yes:checked'
            },
            last_name:{
                required:'#choose_guarantor_yes:checked',
            },
            email:{
                required:'#choose_guarantor_yes:checked',
                email:true,
            },
            phone_number:{
                required:'#choose_guarantor_yes:checked',
                number:true,
            },
            address:{
                required:'#choose_guarantor_yes:checked',
            },
            selected_tenant:{
                required:'#choose_guarantor_no:checked',
            },
        }       
    });
    jQuery('#t_email').blur(function(){
        jQuery('#email_error').remove();
        jQuery.ajax({
            url: "{{ url('/verify-user-email') }}",
            type: "POST",
            data: {'_token':'<?php echo csrf_token() ?>','email':$('#t_email').val()},
            success: function(data){
                if(data.status == 'true'){
                    jQuery('#t_email').after("<span id='email_error'>"+data.message+"</span>");
                    jQuery('#t_email').attr('data','false');
                } else {
                    jQuery('#t_email').attr('data','true');
                    jQuery('#create_tenant_button').attr("disabled", false);
                }
            }
        });
    });
    jQuery('#create_tenant_form').submit(function(e){
        e.preventDefault();
        // if(jQuery('#t_email').attr('data') == 'false'){
        //     // return false;
        // } else {
            // jQuery('#create_tenant_button').attr("disabled", true);
            jQuery.ajax({
                url: "{{ url('/create-contract-tenant') }}",
                type: "POST",  
                data: {'_token':'<?php echo csrf_token() ?>','data':jQuery( "#create_tenant_form" ).serialize()},
                success: function(data){
                    if(data.status == 'true'){
                        toastr.success("Tenant Create Successfully");
                        jQuery('#create_tenant_form input').val('');
                        jQuery('.close').trigger('click');
                        location.reload();
                    } else {
                        // jQuery('#email_error').text('Allready Exist!');
                        jQuery('#t_email').after("<span id='email_error'>Allready Exist!</span>");
                    }
                }
            });
        // }
    });

</script>
<script type="text/javascript">
    jQuery('.choose_guarantor_main input').click(function(){
        if($('#choose_guarantor_no').is(':checked')) { 
            $('#select_tenant').show();
            $('#new_tenant').hide();
        } else {
            $('#new_tenant').show();
            $('#select_tenant').hide();
        }
    });
</script>
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
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: right; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
        .tab-pane {padding: 15px 0; }
        /*ul.nav.nav-tabs {padding: 30px 0 0; }*/
        ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
        ul.nav.nav-tabs li {padding: 0 5px; }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
        ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
        ul.nav.nav-tabs .dropdown-menu> li a {font-size: 15px; background-color: #fff; color: inherit; }
        ul.nav.nav-tabs .dropdown-menu>.active> a {
            color: #fff !important;
            text-decoration: none;
            background-color: #337ab7 !important;
            outline: 0;
        }
        .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
            color: #262626 !important;
            text-decoration: none;
            background-color: #f5f5f5 !important;
        }
        dropdown active a.dropdown-toggle { background-color: #f28302;}
        .float-right { float: right; }
        .open>.ml-75 {margin-left: -75%;}
        .widget-small {display: -webkit-box; display: -ms-flexbox; display: flex; border-radius: 4px; margin-bottom: 30px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); }
        .widget-small .icon {display: -webkit-box; display: -ms-flexbox; display: flex; min-width: 50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; padding: 20px; background-color: rgba(0, 0, 0, 0.2); border-radius: 4px 0 0 4px; font-size: 2.5rem; }
        .widget-small.danger {background-color: #dc3545; }
        .widget-small.danger.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
        .widget-small.danger.coloured-icon .icon { background-color: #dc3545;color: #fff;}

      .icon.fa.fa-chack.fa-3x.success {background-color: #5cb85c;color: #fff;}
      .icon.fa.fa-exclamation-triangle.fa-3x.danger {background-color: #dc3545;color: #fff;}
        i.icon.fa.fa-check.success.fa-3x {background-color: #5cb85c;color: #fff;  }

      .widget-small .info h4 {text-transform: uppercase; margin: 0; margin-bottom: 5px; font-weight: 400; font-size: 1.1rem; }
      .widget-small .info p {margin: 0; font-size: 16px; }
      .widget-small .info {    padding: 7px 10px; }
    </style>
<style>
    .chat-container {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .chat-container::after {
      content: "";
      clear: both;
      display: table;
    }

    .chat-container img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .chat-container img.right {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }
</style>
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
    .gender_class input {width: 8%; display: inline-block; height: 17px; border: 0; box-shadow: none; margin: 0 10px; }
    .tenent-title {font-size: 24px; }
    ul.nav.nav-pills.nav-justified li {background-color: bisque; }
    ul.nav.nav-pills.nav-justified a {color: black; }
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {background-color: #f28401;     color: #fff !important;}
    ul.nav.nav-pills.nav-justified {margin-top: 20px; }
    #create_company_form{display: none;}
    .add-unit-main, .tenent-title {padding: 15px 0; }
    .checked { color: orange; }
    .not_found {padding: 20px 0; }
</style>
@endsection