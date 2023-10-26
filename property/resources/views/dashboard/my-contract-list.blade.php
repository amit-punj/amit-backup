@section('title','Contracts')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Contracts'])
<div class="container">
    <div class="row">
        <form method="get">
              @csrf       
            <div class="col-md-10 col-12 col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="keyword" class="form-control" placeholder="Filter by Owner Name" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="property_type" id="property_type" class="form-control color-gray">
                                <option value="">Search Filter</option>
                                <option value="building">Running</option>
                                <option value="house">Draft</option>
                                <option value="house">Passed</option>
                                @if(Auth::user()->user_role == 2 ||  Auth::user()->user_role == 3 )
                                    <option value="house">Future</option>
                                    <option value="house">On Notice Period</option>
                                    <option value="house">Payment Received </option>
                                    <option value="house">Small payment Delay </option>
                                    <option value="house">Payment Delay </option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-12 col-sm-12">
                <div>
                    <button type="submit" id="search_" class="btn btn-success btn-block search_">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12 top-nevigation">
            <!-- <ul class="nav nav-tabs" style="margin-left: -6px;">
                    <li class="active"><a data-toggle="tab" href="#current">All</a></li>
                    <li><a data-toggle="tab" href="#running">Running</a></li>
                    <li><a data-toggle="tab" href="#draft">Draft</a></li>
                    <li><a data-toggle="tab" href="#passed">Passed</a></li>
                @if(Auth::user()->user_role == 1 ||  Auth::user()->user_role == 3 )
                    <li><a data-toggle="tab" href="#future">Future</a></li>
                    <li><a data-toggle="tab" href="#notice">On Notice Period</a></li>
                    <li class="dropdown active">
                        <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">Payment Status <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="tab" href="#Payments_Received">Payments Received</a></li>
                            <li><a data-toggle="tab" href="#Small_payment_Delay">Small payment Delay</a></li>
                            <li><a data-toggle="tab" href="#Payment_Delay">Payment Delay</a></li>
                        </ul>
                    </li>
                @endif
            </ul> -->
            <div class="tab-content">
                <div id="current" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(count($contracts) > 0 )
                            <div  class="user-info-table">
                                <table  class="table table-hover table-striped table-bordered">
                                    <tbody >
                                        <tr>
                                            <td >Unit name</td>
                                            <td >Tenant name</td>
                                            <td >Contract</td>
                                            <td >Amount</td> 
                                            <td >Payment method</td> 
                                            <td >Status</td> 
                                            <td >Starting date</td>
                                            <td >End date</td>
                                            <td >Action</td>
                                        </tr> 
                                        @foreach($contracts as $key => $contract) 
                                            <tr> 
                                                <td> <a href="{{url('propertydetails/'.$contract->unit_id)}}">{{ substr($contract->unit['unit_name'],0,20) }}</a></td>
                                                <td>
                                                <!-- <a href="{{ url('tenant-details/'.$contract->tenant_id) }}">{{ $contract->user['name'] }}</a> -->
                                                {{ $contract->user['name'] }}</td>
                                                <td > <a href="{{ url('contract-details/'.$contract->id) }}">{{ucfirst( $contract->contract_type )}}</a></td>
                                                <td >$ {{$contract->unit['rent'] + $contract->unit['cost_provision']}}</td>
                                                <td >{{ ucfirst($contract->payment_method) }} ({{ucfirst($contract->payment_status)}})</td>
                                                <td >{{ ucfirst($contract->status) }}</td>
                                                <td >{!! \Helper::Date($contract->start_date); !!}</td>
                                                <td >{!! \Helper::Date($contract->end_date); !!}</td>
                                                <td ><a href="{{url('contract-details/'.$contract->id)}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a>
                                                @if(Auth::user()->user_role == 1 )
                                                    @if($contract->payment_method == 'bank' && $contract->receipt_status != 'yes')
                                                        <a href="javascript::void();" class="upload_receipt" data-id="{{$contract->id}}">Upload Receipt!</a>
                                                    @elseif($contract->payment_method == 'bank' && $contract->receipt_status == 'yes')
                                                        <span >Receipt Uploaded!</span>
                                                    @endif
                                                @elseif(Auth::user()->user_role == 3 )
                                                    @if( $contract->payment_status == 'paid' && $contract->status == 'draft' )
                                                        <button data-id="{{$contract->id}}" data-status="accepted" class="booking_action btn btn-success">Accept</button>
                                                        <button data-id="{{$contract->id}}" data-status="rejected" class="booking_action btn btn-danger">Reject</button>
                                                    @elseif( $contract->status == 'accepted' && $contract->payment_status = 'paid')
                                                        <span >Accepted!</span>
                                                    @elseif( $contract->status == 'rejected' && $contract->payment_status = 'paid')
                                                        <span >Rejected!</span>
                                                        <!-- <select name="booking_action" {{ $disable }} data-id="{{$contract->id}}" id="booking_action" class="booking_action">
                                                            <option value="">Select</option>        
                                                            <option value="accepted" <?php echo $readonly = ($contract->status == 'accepted') ? 'selected' : '' ; ?> >Accepted</option>        
                                                            <option value="rejected" <?php echo $readonly = ($contract->status == 'rejected') ? 'selected' : '' ; ?> >Rejected</option>        
                                                        </select> -->
                                                    @endif
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach                                        
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <p>No contracts found!</p>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Running </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a>  </div>
                                <div class="unit"><span>Owner Name : </span> <a href="{{ url('tenant-details/1') }}">Amit</a>  </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                <div class="unit-action">
                                    <div class="col-md-4"><a target="_blank" href="{{ url('terminate-contract/1?notice=3') }}" class="btn btn-primary">Notice</a> </div>
                                    <div class="col-md-4"><a target="_blank" href="{{ url('terminate-contract/2') }}" class="btn-danger btn float-right">Terminate</a></div>
                                    @if(Auth::user()->user_role == 1)
                                        <div class="col-md-4"><a data-toggle="modal" data-target="#extend" class="btn-success btn float-right">Extend</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Draft </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a>  </div>
                                <div class="unit"><span>Owner Name : </span> <a href="{{ url('tenant-details/1') }}">Amit</a>  </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                <div class="unit-action">
                                    <div class="col-md-6"><a  onclick="cancelContract()" class="btn btn-danger">Cancel</a> </div>
                                    <div class="col-md-6"><a onclick="CompleteContract()" class="btn-success btn float-right"> Complete</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Passed </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a>  </div>
                                <div class="unit"><span>Owner Name : </span> <a href="{{ url('tenant-details/1') }}">Amit</a>  </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Pending </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                <div class="unit"><span>My Rating : </span> 
                                    <span class="glyphicon glyphicon-star-empty checked"></span>
                                    <span class="glyphicon glyphicon-star-empty checked"></span>
                                    <span class="glyphicon glyphicon-star-empty checked"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </div>
                                <div class="unit"><span>PO Rating : </span>  
                                    <span class="glyphicon glyphicon-star-empty checked"></span>
                                    <span class="glyphicon glyphicon-star-empty checked"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Running </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a>  </div>
                                <div class="unit"><span>Owner Name : </span> <a href="{{ url('tenant-details/1') }}">Amit</a>  </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Pending </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                <div class="unit-action">
                                    <div class="col-md-4"><a href="#" class="btn btn-primary">Notice</a> </div>
                                    <div class="col-md-4"><a href="#" class="btn-danger btn float-right">Terminate</a></div>
                                    @if(Auth::user()->user_role == 1)
                                        <div class="col-md-4"><a href="#" class="btn-success btn float-right">Extend</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div id="running" class="tab-pane fade ">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Running </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Running </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani </a> </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Running </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani </a> </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="draft" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Draft </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a>  </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Draft </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete">
                                    <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                </div>
                                <div class="unit"><span>Status : </span> Draft </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}">Anil Ambani</a> </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Payment Status : </span> Done </div>
                                <div class="unit"><span>Balance in contract : </span> $ 200 </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="passed" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Passed </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Passed </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Passed </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="future" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Future </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Future </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Future </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="notice" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Notice Period </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Notice Period </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                <div class="unit"><span>Status : </span> Notice Period </div>
                                <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                <div class="unit"><span>Contract Type : </span> Commercial </div>
                                <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                <div class="unit"><span>End Date : </span>  2020-07-13</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Payments_Received" class="tab-pane fade ">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete">
                                        <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                    </div>
                                    <div class="unit"><span>Status : </span> Running </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}"></a> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Payment Status : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Passed </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}"></a> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Passed </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Cancel </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                        </div>
                </div>
                <div id="Small_payment_Delay" class="tab-pane fade ">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete">
                                        <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                    </div>
                                    <div class="unit"><span>Status : </span> Running </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}"></a> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Payment Status : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Passed </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}"></a> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Passed </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Cancel </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                        </div>
                </div>
                <div id="Payment_Delay" class="tab-pane fade ">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete">
                                        <a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                    </div>
                                    <div class="unit"><span>Status : </span> Running </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}"></a> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Payment Status : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Passed </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{ url('tenant-details/1') }}"></a> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Passed </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="unit-body">
                                    <div class="text-center"><strong><a class="fs-24" target="_blank" href="{{ url('propertydetails/23')}}">Second flore</a></strong></div>
                                    <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                    <div class="unit"><span>Status : </span> Cancel </div>
                                    <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                    <div class="unit"><span>Contract Type : </span> Commercial </div>
                                    <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                    <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="modal fade" id="extend" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" id="visit_add_remark">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Contract Extenssions</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Select Date') }}</label>
                            <div class="col-md-8">
                                <div id="any_days" class="">
                                    <div id="datepicker_not_av"></div>
                                </div>
                                <input type="hidden" name="selecteddates" value="" class="selecteddates" />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('remark') is-invalid @enderror remark" name="remark" required="" rows="5" cols="50" placeholder="Add Remark">{{ old('remark','Add Remarks') }}</textarea>
                                @error('remark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Extend</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cancel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="visit_add_remark">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Add Remark</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('remark') is-invalid @enderror remark" name="remark" required="" rows="5" cols="50" placeholder="Add Remark">{{ old('remark','Add Remarks') }}</textarea>
                                @error('remark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Extend</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upload_receipt_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('upload-receipt') }}" enctype="multipart/form-data" id="upload_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Upload Bank Receipt</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <div class="form-group row">
                            <div class="col-md-12">
                               <p><strong>Note:</strong> Please upload receipt which you get from bank after payment.</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Upload Receipt') }}</label>
                            <div class="col-md-9">
                               <input type="file" id="receipt" name="receipt">
                            </div>
                            @error('receipt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="upload" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
    .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; height: 380px }
    .unit_number {font-size: 18px; }
    .unit-body span { font-weight: bold;  }
    .unit {padding: 5px 0; }
    .top-nevigation {padding-bottom: 25px; }
    ul.nav.nav-tabs {border: 0; }
    .top-nevigation li {border: 0 !important; padding: 0 6px; }
    /*.top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }*/
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    .add-unit-main {text-align: right; }
    .unit-delete span {color: #000000bd; position: relative; float: right; }
    .Current_Active_Contract {font-size: 24px; text-align: center; }
    .documemt_action {text-align: right; }
    .documemt_action a {color: #000000bd; padding: 0 5px; }
    .contract-alert {background-color: bisque; padding: 9px; margin: 8px; border-radius: 5px; }
    .contract-alert-title {font-size: 24px; }
    ul.nav.nav-tabs {padding: 30px 0 0; }
    ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
    ul.nav.nav-tabs li {padding: 0 5px; }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
    ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
    .fs-24{ font-size: 24px; }
    .unit-action { margin: 20px 0px; }
    .float-right { float: right; }
    .checked { color: orange;}
</style>
<script>
    $( function() {
        var values = [];
        $( "#datepicker_not_av" ).multiDatesPicker({
            changeMonth: true,
            changeYear: true,
            minDate:0,
            onSelect: function(selectedDate) {
                var vindex = values.findIndex(v => v == selectedDate);
                if(vindex != -1){values.splice(vindex,1);}else{
                values.push(selectedDate);
            }
            var unique = values.filter(function(itm, i, values) {
                return i == values.indexOf(itm);
            });
            $('.selecteddates').val(unique);
            }
        });
    } );
    function cancelContract() {
      if (confirm("Want to cancel this!")) {
        $('#cancel').modal('show');
      } 
    }
    function CompleteContract() {
      if (confirm("Want to Complete this!")) {
        $('#cancel').modal('show');
      } 
    }
    jQuery('.upload_receipt').click(function(){
        var id      = $(this).data('id');
        $('#upload_receipt_modal').modal('show');
        $("#upload_receipt_modal #booking_id").val(id);
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} kb');
    $("#upload_receipt_form").validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            receipt: {
              required: true,
              accept: "image/*",
              // filesize: 20000,
            }
        },
        messages: {
            receipt: {
              required: "Please upload receipt",
              accept: "The Receipt must be a file of type: jpeg, png, jpg.",
              filesize: "The Receipt may not be greater than 2MB",
            }
        },
    });
    jQuery('.booking_action').click(function(){
        var id      = $(this).data('id');
        var status  = jQuery(this).data('status');
        var thisa   = $(this);
        var result  = "";
        if(status == 'accepted'){
            var result = confirm("Want to accept the booking?");
        }
        else if(status == 'rejected'){
            var result = confirm("Want to reject the booking?");
        }
        if (!result) {
            return false;
        }
        $.ajax(
        {
            url: "{{url('update-booking-status')}}",
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
</script>
@endsection