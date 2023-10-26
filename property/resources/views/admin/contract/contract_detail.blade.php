@extends('adminlayouts.app')
@section('content')
<?php
$role = Auth::user()->user_role; 
$contractPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'contract_permission');
$transactioPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'transactio_permission');
$documentsPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'documents_permission');
$ticketsPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'tickets_permission');
?>
<main class="app-content">
    <div class="app-title"><h3>Contract List</h3>
    </div>
    <div class="container bootom-space">
      <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="unit" ><span>Contract Type : </span></th>
                                <th>{{ucfirst($contract->contract_type) }}</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Status : </span></td>
                                    <td>
                                        @if(Auth::user()->user_role == 0 )
                                            @if($contract->status == 0 )
                                                <span>Draft (Pending for confirmation)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                <span>Draft(Pending bank receipt)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'stripe' && $contract->payment_status == 'hold')
                                                <span>Draft(Pending for confirmation)</span>
                                            @elseif($contract->status == 3)
                                                <span>Draft (Booking confirmed)</span>
                                            @elseif($contract->status == 4)
                                                <span>Draft (Booking request canceled by PM)</span>
                                            @elseif($contract->status == 6)
                                                <span>Running</span>
                                            @elseif($contract->status == 7)
                                                <span>Draft (Canceled by tenant)</span>
                                            @elseif($contract->status == 8)
                                                <span>Termination request send</span>
                                            @elseif($contract->status == 9)
                                                <span>Passed</span> 
                                            @elseif($contract->status == 10)
                                                <span>Draft (Unable to upload receipt)</span>
                                            @endif
                                        @elseif(Auth::user()->user_role == 0 || Auth::user()->user_role == 3)
                                            @if($contract->status == 0 && $contract->payment_status == 'paid')
                                                <span>Draft (Pending for confirmation)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                                                <span>Draft (Pending bank receipt)</span>
                                            @elseif($contract->status == 0 && $contract->payment_method == 'stripe' && $contract->payment_status == 'hold')
                                                <span>Draft(Pending for confirmation)</span>
                                            @elseif($contract->status == 3)
                                                <span>Draft (Booking confirmed)</span>
                                            @elseif($contract->status == 4)
                                                <span>Draft (Booking canceled by PM)</span>
                                            @elseif($contract->status == 6)
                                                <span>Running</span>
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
                                    <td><a href="{{ url('tanent-detail-admin/'.$tenant->id) }}">{{ $tenant->name." ".$tenant->last_name }}</a></td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Owner Name : </span></td>
                                    <td><a href="{{ url('tanent-detail-admin/'.$propertyOwner->id) }}">{{ $propertyOwner->name." ".$propertyOwner->last_name }}</a></td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Legal Advisor : </span></td>
                                    <td><a href="{{ url('tanent-detail-admin/'.$propertyLegalAdvisor->id) }}">{{ $propertyLegalAdvisor->name." ".$propertyLegalAdvisor->last_name }}</a></td>
                                </tr>
                                
                                <tr>
                                    <td class="unit" ><span>Payment Status : </span></td>
                                    <td>{{ ucfirst($contract->payment_status) }}</td>
                                </tr> 
                                @if( $contract->payment_method == 'bank' )
                                <tr>
                                    <td class="unit" ><span>Bank Account : </span></td>
                                    <td>HDFC, Sector 5, Panchkula, Haryana 134109</td>
                                </tr>
                                @elseif($contract->payment_method == 'paypal' || $contract->payment_method == 'stripe')
                                <tr>
                                    <td class="unit" ><span>Payment Method : </span></td>
                                    <td>{{ucfirst($contract->payment_method)}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="unit" ><span>Key Dates : </span></td>
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
                                <p>Payment Method: {{ ucfirst($contract->payment_method) }}</p>
                                <p>Payment Status: {{ ucfirst($contract->payment_status) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @if($role == 2 || $role == 0)
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
                                <th><a href="{{ url('view_unit-admin/'.$unit->id) }}">{{ $unit->unit_name }}</a></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Unit Address : </span></td>
                                    <td>{{ $unit->address }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Unit Type : </span></td>
                                    <td>{{ucfirst($unit->u_type)." (".ucfirst($unit->unit_category).")" }}</td>
                                </tr>
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
                                <tr>
                                    <td class="unit" ><span>Deposit : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->deposit_amount }} </td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Cost Provision : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->cost_provision }} </td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Total Amount : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{ $contract->total_amount}} </td>
                                </tr> 
                                <tr>
                                    <td class="unit" ><span>Number of Bedrooms : </span></td>
                                    <td> {{ $unit->bedrooms }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
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
                               <!--  <tr>
                                    <td class="unit" ><span>Photo : </span></td>
                                    <td><img src="{{ url('images/guarantor/'.$guarantor->photo) }}" width="80" height="60"> </td>
                                </tr> -->
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
                    </div> 
                </div>  
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="Building-Units">Management</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" style="margin-left: -6px;" role="tablist">
                            <li class="dropdown active manage" id="manage">
                                <a class="dropdown-toggle btn" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">Management <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="active"><a data-toggle="tab" href="#communication">Communication</a></li>
                                    <li><a data-toggle="tab" href="#transaction">Payments</a></li>
                                    <li><a data-toggle="tab" id="doc" href="#document">Documents</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" id="refund_id">
                                <a class="dropdown-toggle btn" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">Refunds <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a data-toggle="tab" href="#clearDues">Dues</a></li>
                                    <li><a data-toggle="tab" href="#refundStatus">Refund Status</a></li>
                                </ul>
                            </li>
                            <li id="ticket_id"><a class="btn" data-toggle="tab" href="#tickets">Tickets</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="communication" class="tab-pane fade in active">
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
                                </div> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if(count($transactions) > 0 )
                                            <div  class="user-info-table">
                                                <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                                    <thead>
                                                        <tr>
                                                            <td >Date</td>
                                                            <td >Related to</td>
                                                            <!-- <td >Description</td> -->
                                                            <td >Amount</td>
                                                            <td >Payment Method</td>
                                                          
                                                                <!-- <td >Action</td> -->
                                                           
                                                           
                                                        </tr> 
                                                    </thead>   
                                                    <tbody >  
                                                        @foreach($transactions as $key => $transaction)        
                                                            <tr>
                                                                <td > {!! \Helper::Date($transaction->created_at); !!}</td>
                                                                <td >{{ $transaction->related_to }}</td>
                                                                <!-- <td >{{ $transaction->description }}</td> -->
                                                                <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$transaction->amount }}</td>
                                                                <td >{{ ucfirst($transaction->payment_by)}}</td>
                                                                <!-- <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td> -->
                                                          
                                                                  <!--   <td ><a href="#">delete</a></td> -->
                                                              
                                                                
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
                                    @elseif(Auth::user()->user_role == 2 && ($documentsPermission == 2))
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Doc <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div> 

                                @include('admin.contract_doc')
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
                                        <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                                <thead>
                                                    <tr>
                                                        <td >Payment Mode</td>
                                                        <td >Payment Ampount</td>
                                                        <td >Status</td>
                                                        <td >Action</td>
                                                    </tr> 
                                                </thead>   
                                                <tbody >         
                                                    <tr>
                                                        <td >Paypal</td>
                                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}}  50</td>
                                                        <td >Pending</td>
                                                        <td ><a href="#">delete</a></td>
                                                    </tr> 
                                                    <tr>
                                                        <td >Bank Transfer</td>
                                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}}  700</td>
                                                        <td >Done</td>
                                                        <td ><a href="#">delete</a></td>
                                                    </tr> 
                                                    <tr>
                                                        <td >Paypal</td>
                                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}}  100</td>
                                                        <td >Pending</td>
                                                        <td ><a href="#">delete</a></td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tickets" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">List of Tickets</div>
                                    </div>
                                    @if(Auth::user()->user_role == 0)
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#TicketModal">Raise Ticket <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
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
                                                                @if(Auth::user()->user_role == 0)
                                                                    @if($ticket->status == 'pending')
                                                                        <button data-id="{{$ticket->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
                                                                    @endif
                                                                    @if($ticket->status == 'closed')
                                                                        <button class="btn btn-danger">Closed</button>
                                                                    @endif

                                                                 @endif   
                                                              
                                                            </td>
                                                        </tr> 
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                        <p>No tickets</p>
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
                <form method="post" action="{{url('admin-raise-ticket/'.$contract->id)}}" id="raise_ticket">
                    @csrf
                    <input type="hidden" name="unit_id" value="{{$contract->unit_id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Raise Ticket</h3>
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
                         <button type="submit" id="b_create" class="btn btn-success">Raise</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="updateModel" role="dialog">
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
</main>    
    <script type="text/javascript">
        // var date = new Date();
        // $('.form_datetime').datetimepicker({
        //     weekStart: 1,
        //     todayBtn:  1,
        //     autoclose: 1,
        //     todayHighlight: 1,
        //     startView: 2,
        //     forceParse: 0,
        //     showMeridian: 1,
        //     startDate: date
        // });
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

        $("#manage").click(function(){
          $(".active").removeClass("active");
          $(".manage").addClass("active");
        });
        $("#refund_id").click(function()
            {
                $(".active").removeClass("active");
                $("#refund_id").addClass("active");
            }
            );
        $("#ticket_id").click(function(){
           $('.active').removeClass("active");
           $("#ticket_id").addClass("active");
        });
       $("#pro_man").click(function(){
          $(".active2").removeClass("active2");
          $("#pro_man").addClass("active2");
       });
       $("#pro_des_exp").click(function(){
           $(".active2").removeClass("active2");
           $("#pro_des_exp").addClass("active2");
       });
       $("#leg_adv").click(function(){
           $(".active2").removeClass("active2");
           $("#leg_adv").addClass("active2");
       });
       $("#wat_met").click(function(){
            $(".active2").removeClass("active2");
            $("#wat_met").addClass("active2");
       });
       $("#ele_met").click(function(){
             $(".active2").removeClass("active2");
             $("#ele_met").addClass("active2");
       });

    </script>
    <style type="text/css">
    .info{
        background-color: white;
        color: black;
    }
    i.icon.fa.fa-check.success.fa-3x {
        background-color: green;
    }
    .active2{
            background-color: #f28201 !important;
            color: white !important;
        }
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
        ul.nav.nav-tabs li {padding: 6px 5px; }
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
        ul.dropdown-menu.show{
            padding: 20px;
        }
        .dropdown .active a.dropdown-toggle { background-color: #f28302;}
        .float-right { float: right; }
        .open>.ml-75 {margin-left: -75%;}
        .widget-small {display: -webkit-box; display: -ms-flexbox; display: flex; border-radius: 4px; color: #FFF; margin-bottom: 30px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); }
        .widget-small .icon {display: -webkit-box; display: -ms-flexbox; display: flex; min-width: 50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; padding: 20px; background-color: rgba(0, 0, 0, 0.2); border-radius: 4px 0 0 4px; font-size: 2.5rem; }
        .widget-small.danger {background-color: #dc3545; }
        .widget-small.danger.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
        .widget-small.danger.coloured-icon .icon { background-color: #dc3545;color: #fff;}

      .icon.fa.fa-exclamation-triangle.fa-3x.success {background-color: #5cb85c;color: #fff;}
      .icon.fa.fa-exclamation-triangle.fa-3x.danger {background-color: #dc3545;color: #fff;}


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
@endsection