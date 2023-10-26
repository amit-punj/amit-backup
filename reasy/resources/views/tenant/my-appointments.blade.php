@section('title','Appointments')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Appointments'])
<style type="text/css">
    .text-left {
        text-align: left;
    }
    .glyphicon-edit {
        color: #f48400 !important;
    }
    .glyphicon {font-size: 15px; font-weight: bold !important; }
    .table tbody tr th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        padding: .75rem;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,.05);
    }
    .f17 {
        font-size: 17px !important;
    }
    .f15 {
        font-size: 15px !important;
    }
</style>
    <div class="container">
        <div class="col-sm-6 col-sm-12 top-nevigation">
            <ul class="nav nav-tabs" style="margin-left: -6px;">
                <li class="active"><a data-toggle="tab" href="#book_appointment">Future</a></li>
                <li><a data-toggle="tab" href="#assigned_appointment">Archive</a></li>
            </ul>
        </div>
        <div class="col-sm-6">
            @if(Auth::user()->user_role == 1 )
                <div class="add-unit-main">
                    <a href="{{url('book-appointment')}}" target="_blank" style="float: right;" class="btn btn-success">Book Appointment <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-12 top-nevigation">
                    <div class="tab-content">
                        <div id="book_appointment" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-sm-12">      
                                    @if(count($futures) > 0 ) 
                                        <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr class="text-center f17">
                                                        <th class="text-left"> Unit Name</th>
                                                        <th class="text-left"> Appointment Time </th>
                                                        <th class="text-left"> Appointment With </th>
                                                        <th class="text-left"> Appointment Title </th>
                                                        <th class="text-left">Appointment Type </th>
                                                        <th class="text-left"> Appointment Status </th>
                                                       <!--  <th class="text-left"> Action </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($futures as $key =>$future)    
                                                    <tr class="f15 clickable" data-toggle="collapse" id="{{$future->id}}" data-target=".{{$future->id}}" >
                                                        <td class="f500">
                                                            <a target="_blank" href="{{ url('propertydetails/'.$future->unit_id) }} ">
                                                            <?php echo $retVal = (isset($future->unit->unit_name) ) ? substr($future->unit->unit_name, 0, 20)."..."  : 'no unit' ; ?> </a>
                                                        </td>
                                                        <td>{!! \Helper::DateTime($future->time); !!}</td>
                                                        <td>
                                                        @if(Auth::user()->id == $future->created_by)
                                                            <!-- <a href="{{url('tenant-details/'.$future->assigned->id)}}"></a> -->
                                                            {{$future->assigned->name}}
                                                        @else
                                                            <!-- <a href="{{url('tenant-details/'.$future->create->id)}}"></a>  -->
                                                            {{$future->create->name}}
                                                        @endif
                                                        </td>
                                                        <td >{{$future->title}}</td>
                                                        <td >{{$future->appointment_type}}</td>
                                                        <td >
                                                        @if(Auth::user()->user_role == 1 )
                                                            @if($future->appointment_status == 0)
                                                                <span >Waiting for Confirmation!</span>
                                                            @elseif($future->appointment_status == 1)
                                                                <span >Accepted!</span>
                                                            @elseif($future->appointment_status == 2)
                                                                <span >Rejected!</span>
                                                            @elseif($future->appointment_status == 3)
                                                                <!-- <span >Assigned Another Dates!</span><br> -->
                                                                <a class="btn-success hide-btn_{{$future->id}} btn assigned_action" data-id="{{$future->id}}" data-dates="{{$future->assign_dates}}" data-name="{{$future->assigned->name}}" data-email="{{$future->assigned->email}}" data-phone_no="{{$future->assigned->phone_no}}" id="accept_appointment">Choose other dates</a>
                                                                <!-- <a class="btn-danger hide-btn_{{$future->id}} btn reject_appointment" data-id="{{$future->id}}" data-dates="{{$future->assign_dates}}" id="reject_appointment">Reject</a> -->
                                                                <a style="display: none;" class="user_view" id="vo_{{$future->id}}" data-name="{{$future->assigned->name}}" data-email="{{$future->assigned->email}}" data-phone_no="{{$future->assigned->phone_no}}" ><span title="View Visit Organizer" class="glyphicon glyphicon-eye-open"></span></a>
                                                            @elseif($future->appointment_status == 4)
                                                                <span >Rejected by Tenant!</span>
                                                            @elseif($future->appointment_status == 7)
                                                                <span >Canceled!</span>
                                                            @endif
                                                        @elseif(Auth::user()->user_role == 6 || Auth::user()->user_role == 4 || Auth::user()->user_role == 2)
                                                            @php ($disable = ($future->appointment_status != 0) ? 'disabled' : ''  )
                                                            <select name="booking_action" {{ $disable }} data-id="{{$future->id}}" id="booking_action" class="booking_action">
                                                                <option value="0" <?php echo $readonly = ($future->appointment_status == 0) ? 'selected' : '' ; ?> >Pending</option>   
                                                                <option value="1" <?php echo $readonly = ($future->appointment_status == 1) ? 'selected' : '' ; ?> >Accepted</option>   
                                                                <option value="2" <?php echo $readonly = ($future->appointment_status == 2) ? 'selected' : '' ; ?> >Rejected</option>
                                                                @if(Auth::user()->user_role == 6 || Auth::user()->user_role == 4 || Auth::user()->user_role == 2)
                                                                <option value="3" <?php echo $readonly = ($future->appointment_status == 3) ? 'selected' : '' ; ?> >Assign Another Dates</option>
                                                                @endif
                                                                @if($future->appointment_status == 4)
                                                                    <option value="4" <?php echo $readonly = ($future->appointment_status == 4) ? 'selected' : '' ; ?> >Rejected by tenant!</option>
                                                                @endif
                                                                @if($future->appointment_status == 7)
                                                                    <option value="4" <?php echo $readonly = ($future->appointment_status == 7) ? 'selected' : '' ; ?> >Canceled!</option>
                                                                @endif
                                                            </select>
                                                        @endif
                                                        <a class="view_appointment1" href="{{url('appointment-view/'.$future->id)}}" ><span title="View Appointment" class="glyphicon glyphicon-eye-open"></span></a>
                                                        <!-- <a class="view_appointment" data-title="{{$future->title}}" data-des="{{$future->description}}" ><span title="View Appointment" class="glyphicon glyphicon-eye-open"></span></a> -->
                                                        @if(Auth::user()->user_role == 1 && $future->appointment_status == 4 )
                                                            <a class="user_view" id="vo_{{$future->id}}" data-name="{{$future->assigned->name}}" data-email="{{$future->assigned->email}}" data-phone_no="{{$future->assigned->phone_no}}" ><span title="View Visit Organizer" class="glyphicon glyphicon-eye-open"></span></a>
                                                        @endif
                                                        @if(Auth::user()->user_role == 4 || Auth::user()->user_role == 2)
                                                            @if($future->appointment_type == 'Exit' )
                                                                <a download href="{{url('document/'.$future->document['doc_name']) }}">Download entry PD report!</a>
                                                            @endif
                                                        @endif
                                                        @if(Auth::user()->user_role == 4 || Auth::user()->user_role == 6 || Auth::user()->user_role == 2)
                                                            <?php   $reply_time = date('Y/m/d', strtotime($future->created_at. ' +1 day') );
                                                                    $reply_time = strtotime($reply_time);?>
                                                            <?php $current_time = strtotime(date("Y-m-d")); ?>
                                                            @if($current_time < $reply_time && $future->reply_status == 0)
                                                              <a data-id="{{$future->id}}" class="btn btn-success reply">Reply</a>
                                                            @elseif($future->reply_status == 1)
                                                              <a data-id="{{$future->id}}" data-message="{{$future->message->message}}" class="btn view_reply">View Reply</a>
                                                            @elseif($future->reply_status == 2)
                                                              <span>Didn't reply</span>
                                                            @endif
                                                        @elseif(Auth::user()->user_role == 1 )
                                                            @if($future->reply_status == 1)
                                                              <a data-id="{{$future->id}}" data-message="{{$future->message->message}}" class="btn view_reply">View Reply</a>
                                                            @endif
                                                        @endif
                                                        @if($future->appointment_status == 1)
                                                            <a data-id="{{$future->id}}" class="btn btn-success cancel_appointment">Cancel</a>
                                                        @elseif($future->appointment_status == 7)
                                                            <a data-id="{{$future->id}}" data-reason="{{$future->reason->reason}}" class="btn view_cancal_appointment">View Cancel reason</a>
                                                        @endif
                                                        </td>
                                                    </tr> 
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                    <p>No Appointment!</p>
                                    @endif  
                                </div>        
                            </div>      
                        </div>
                        <div id="assigned_appointment" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-12">                                              
                                    @if(count($archives) > 0 ) 
                                        <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr class="text-center f17">
                                                        <th class="text-left"> Unit Name</th>
                                                        <th class="text-left"> Appointment Time </th>
                                                        <th class="text-left"> Appointment With </th>
                                                        <th class="text-left"> Appointment Title </th>
                                                        <th class="text-left">Appointment Type </th>
                                                        <th class="text-left"> Appointment Status </th>
                                                       <!--  <th class="text-left"> Action </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($archives as $key =>$archive)    
                                                    <tr class="f15 clickable" data-toggle="collapse" id="{{$archive->id}}" data-target=".{{$archive->id}}">
                                                        <td class="f500">
                                                            <a target="_blank" href="{{ url('propertydetails/'.$archive->unit_id) }} ">
                                                            <?php echo $retVal = (isset($archive->unit->unit_name) ) ? substr($archive->unit->unit_name, 0, 20)."..." : 'no unit' ; ?> </a>
                                                        </td>
                                                        <td>{!! \Helper::DateTime($archive->time); !!}</td>
                                                        <td>
                                                            @if(Auth::user()->id == $archive->created_by)   
                                                                @if(isset($archive->assigned->name))
                                                                <!-- <a href="{{url('tenant-details/'.$archive->assigned->id)}}"></a> -->
                                                                {{$archive->assigned->name}}
                                                                @endif
                                                            @else
                                                                @if(isset($archive->create->name))
                                                                <!-- <a href="{{url('tenant-details/'.$archive->create->id)}}"></a> -->
                                                                {{$archive->create->name}}
                                                                @endif 
                                                            @endif
                                                        </td>
                                                        <td >{{$archive->title}}</td>
                                                        <td >{{$archive->appointment_type}}</td>
                                                        <td >
                                                            @if(Auth::user()->user_role == 1 )
                                                                @if($archive->appointment_status == 0)
                                                                    <span >Waiting for Confirmation!</span>
                                                                @elseif($archive->appointment_status == 1)
                                                                    <span >Accepted!</span>
                                                                @elseif($archive->appointment_status == 2)
                                                                    <span >Rejected!</span>
                                                                @elseif($archive->appointment_status == 3)
                                                                    <span >Assigned Another Dates!</span>
                                                                    <!-- <a class="btn-success btn assigned_action" data-id="{{$archive->id}}" data-dates="{{$archive->assign_dates}}" id="accept_appointment">Accept</a>
                                                                    <a class="btn-danger btn reject_appointment" data-id="{{$archive->id}}" data-dates="{{$archive->assign_dates}}" id="reject_appointment">Reject</a> -->
                                                                @elseif($archive->appointment_status == 4)
                                                                    <span >Rejected by Tenant!</span>
                                                                @endif
                                                            @elseif(Auth::user()->user_role == 6 || Auth::user()->user_role == 4 || Auth::user()->user_role == 2)
                                                                <select name="booking_action" data-id="{{$archive->id}}" disabled="" id="booking_action" class="booking_action">
                                                                    <option value="0" <?php echo $readonly = ($archive->appointment_status == 0) ? 'selected' : '' ; ?> >Pending</option>   
                                                                    <option value="1" <?php echo $readonly = ($archive->appointment_status == 1) ? 'selected' : '' ; ?> >Accepted</option>   
                                                                    <option value="2" <?php echo $readonly = ($archive->appointment_status == 2) ? 'selected' : '' ; ?> >Rejected</option>
                                                                @if(Auth::user()->user_role == 6 || Auth::user()->user_role == 4 || Auth::user()->user_role == 2)
                                                                    <option value="3" <?php echo $readonly = ($archive->appointment_status == 3) ? 'selected' : '' ; ?> >Assign Another Dates</option>
                                                                @endif
                                                                @if($archive->appointment_status == 4)
                                                                    <option value="4" <?php echo $readonly = ($archive->appointment_status == 4) ? 'selected' : '' ; ?> >Rejected by tenant!</option>
                                                                @endif
                                                                </select>
                                                            @endif
                                                            <a class="view_appointment1" href="{{url('appointment-view/'.$archive->id)}}" ><span title="View Appointment" class="glyphicon glyphicon-eye-open"></span></a>
                                                            <!-- <a class="view_appointment" data-title="{{$archive->title}}" data-des="{{$archive->description}}" ><span title="View Appointment" class="glyphicon glyphicon-eye-open"></span></a> -->
                                                            @if(Auth::user()->user_role == 1 && $archive->appointment_status == 4 )
                                                                <a class="user_view" data-name="{{$archive->assigned->name}}" data-email="{{$archive->assigned->email}}" data-phone_no="{{$archive->assigned->phone_no}}" ><span title="View Visitor" class="glyphicon glyphicon-eye-open"></span></a>
                                                            @endif
                                                            @if(Auth::user()->user_role == 4 || Auth::user()->user_role == 2)
                                                                @if(($archive->appointment_type == 'Entry' || $archive->appointment_type == 'Exit') && isset($archive->contract) && ($archive->contract->status == '3' || $archive->contract->status == '8' ) && $archive->appointment_status != 0 )
                                                                    <a href="javascript:void(0);" class="upload_PD" data-type="{{$archive->appointment_type}}" data-id="{{$archive->contract_id}}">Upload PD report!</a>
                                                                @endif
                                                            @endif
                                                            @if(Auth::user()->user_role == 4 || Auth::user()->user_role == 2)
                                                                @if($archive->appointment_type == 'Exit' )
                                                                    <a download href="{{url('document/'.$archive->document['doc_name']) }}">Download entry PD report!</a>
                                                                @endif
                                                            @endif
                                                            @if(Auth::user()->user_role == 4 || Auth::user()->user_role == 6 || Auth::user()->user_role == 2)
                                                                <?php   $reply_time = date('Y/m/d', strtotime($archive->created_at. ' +1 day') );
                                                                    $reply_time = strtotime($reply_time);?>
                                                                    <?php $current_time = strtotime(date("Y-m-d")); ?>
                                                                @if($current_time < $reply_time && $archive->reply_status == 0)
                                                                  {{-- <a data-id="{{$archive->id}}" class="btn btn-success reply">Reply</a> --}}
                                                                @elseif($archive->reply_status == 1)
                                                                  <a data-id="{{$archive->id}}" data-message="{{$archive->message->message}}" class="btn view_reply">View Reply</a>
                                                                @elseif($archive->reply_status == 2)
                                                                  <span>Didn't reply</span>
                                                                @endif
                                                            @elseif(Auth::user()->user_role == 1 )
                                                                @if($archive->reply_status == 1)
                                                                  <a data-id="{{$archive->id}}" data-message="{{$archive->message->message}}" class="btn view_reply">View Reply</a>
                                                                @endif
                                                            @endif
                                                            @if($archive->appointment_status == 7)
                                                                <span>Canceled</span>
                                                                <a data-id="{{$archive->id}}" data-reason="{{$archive->reason->reason}}" class="btn view_cancal_appointment">View Cancel reason</a>
                                                            @endif
                                                        </td>
                                                    </tr> 
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                    <p>No Appointment!</p>
                                    @endif     
                                </div>        
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" id="visit_add_remark">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Add Remark</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Appointment Status *') }}</label>
                            <div class="col-md-6">
                                <select name="status" id="status" required="" class="form-control @error('status') is-invalid @enderror status">
                                    <!-- <option value="">Select Status</option> -->
                                    <option value="unit">Upcoming</option>
                                    <option value="building">Completed</option>
                                    <option value="cancel">Cancel</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                         <button type="submit" id="b_create" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="UploadDoc" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" id="add_custom_building">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Upload Document</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="a_status" class="col-md-4 col-form-label text-md-right">{{ __('Appointment Status *') }}</label>
                            <div class="col-md-6">
                                <select name="a_status" id="a_status" class="form-control a_status @error('a_status') is-invalid @enderror">
                                    <!-- <option value="">Select Status</option> -->
                                    <option value="upcoming">Upcoming</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancel">Cancel</option>
                                </select>
                                @error('a_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                         <div class="form-group row">
                            <label for="doc_type" class="col-md-4 col-form-label text-md-right">{{ __('Document Type') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('doc_type') is-invalid @enderror" name="doc_type" id="doc_type">
                                    <option value="">Select</option>
                                    <option value="pm">Property Manager</option>
                                    <option value="mr">Meter Reading</option>
                                    <option value="pde">Property Description Expert</option>
                                    <option value="lad">Legal Advisor</option>
                                </select>
                                @error('doc_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="meter_div" style="display: none;">
                            <label for="meter_type" class="col-md-4 col-form-label text-md-right">{{ __('Meter Type') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="meter_type" id="meter_type">
                                    <option value="">Select</option>
                                    <option value="water">Water</option>
                                    <option value="internent">Ineternet</option>
                                    <option value="electricity">Electricity</option>
                                    <option value="gas">Gas</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Document Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="doc_name" id="doc_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Document') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="doc" id="doc">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('remark') is-invalid @enderror remark" name="remark" id="remark" rows="5" cols="50" placeholder="Add Remark">{{ old('remark','Add Remarks') }}</textarea>
                                @error('remark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignAnotherDate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="reschedule_appointment" action="{{url('reschedule-appointment')}}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Assign Another 3 Dates</h3>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="appointment_id" id="appointment_id" value=""/>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime1') }}</label>
                            <div class="col-md-9
                            ">
                               <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" name="time1" type="text" value="{{old('time1')}}" readonly >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                @if ($errors->has('time1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime2') }}</label>
                            <div class="col-md-9
                            ">
                               <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" name="time2" type="text" value="{{old('time2')}}" readonly >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                @if ($errors->has('time2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime3') }}</label>
                            <div class="col-md-9
                            ">
                               <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" name="time3" type="text" value="{{old('time3')}}" readonly >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                @if ($errors->has('time3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="check_assigned_date" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="update_appointment" action="{{url('update-appointment')}}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Select any date</h3>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="appointment_id" class="appointment_id" id="appointment_id" value=""/>
                        <input type="hidden" name="action" class="action" id="action" value="1"/>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('1st Appointment') }}</label>
                            <div class="col-md-9">
                               <!-- <input type="hidden" name="time1" id="time1" class=" time1" value=""> -->
                               <span id="span_time1"></span> 
                               <input type="checkbox" name="check_time[]" id="time1" class="time1" value="0">
                                <!-- @if ($errors->has('check_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('check_time') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('2nd Appointment') }}</label>
                            <div class="col-md-9">
                               <!-- <input type="hidden" name="time2" id="time2" class=" time2" value=""> -->
                               <span id="span_time2"></span> 
                               <input type="checkbox" name="check_time[]" id="time2" class="time2" value="0"> 
                                <!-- @if ($errors->has('check_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('check_time') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('3rd  Appointment') }}</label>
                            <div class="col-md-9">
                               <!-- <input type="hidden" name="time3" id="time3" class=" time3" value=""> -->
                               <span id="span_time3"></span> 
                               <input type="checkbox" name="check_time[]" id="time3" class=" time3" value="0"> 
                                <!-- @if ($errors->has('check_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('check_time') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9">
                                <p><strong>Note:</strong>If none of the mentioned Dates are possible.Please contact directly to make an appointment. <a href="javascript:void(0)" class="user_view" id="user_click_here" >click here</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="accept" class="btn btn-success">Accept</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="appointment_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Appointment Details</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-9">
                           <p id="appointment_title"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-9">
                            <p id="appointment_des"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view_reply_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Reply Details</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Message') }}</label>
                        <div class="col-md-9">
                           <p id="message"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view_cancal_appointment_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Reply Details</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Reason') }}</label>
                        <div class="col-md-9">
                           <p id="reason"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="user_view_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Visit Organiser Details</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-9">
                           <p id="user_view_name"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-9">
                            <p id="user_view_email"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                        <div class="col-md-9">
                            <p id="user_view_phone"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upload_PD_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('upload-document') }}" enctype="multipart/form-data" id="upload_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Upload Report</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <input type="hidden" name="appointment_type" id="appointment_type" value="">
                        <div class="form-group row">
                            <div class="col-md-12">
                               <p><strong>Note:</strong> Please upload Place Description Document which signed by tenant and also add the meter readings.</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Upload Report') }}</label>
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
    <div class="modal fade" id="upload_exit_PD_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" method="POST" action="{{ url('upload-exit-document') }}" enctype="multipart/form-data" id="upload_exit_receipt_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Upload Report</h3>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id" value="">
                        <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                        <input type="hidden" name="appointment_type" id="appointment_type" value="">
                        <div class="form-group row">
                            <div class="col-md-12">
                               <p><strong>Note:</strong> Please upload Place Description Document which signed by tenant and also add the meter readings.</p>
                            </div>
                        </div>
                        <div class="meter_list">
                            
                        </div>
                        <div class="form-group row">
                            <label for="dues" class="col-md-3 col-form-label text-md-right">{{ __('Dues') }}</label>
                            <div class="col-md-6">
                               <input id="dues" type="text" class="form-control" name="dues" value="">
                            </div>
                            @error('dues')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="damage" class="col-md-3 col-form-label text-md-right">{{ __('Damage') }}</label>
                            <div class="col-md-6">
                               <input id="damage" type="text" class="form-control" name="damage" value="">
                            </div>
                            @error('damage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-md-3 col-form-label text-md-right">{{ __('Amount') }}</label>
                            <div class="col-md-6">
                               <input id="amount" type="text" class="form-control" name="amount" value="">
                            </div>
                            @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Upload Report') }}</label>
                            <div class="col-md-6">
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
    <form method="POST" id="reject_update_appointment" action="{{url('update-appointment')}}">
        @csrf
        <input type="hidden" name="appointment_id" class="appointment_id" id="appointment_id1" value=""/>
        <input type="hidden" name="action" class="action" id="action" value="2"/>
    </form>
<div class="modal fade" id="reply_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="visit_add_remark" action="{{url('send-message')}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Reply</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message *') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('message') is-invalid @enderror remark" name="message" required="" rows="5" cols="50" placeholder="Message">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="cancel_appointment_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="visit_add_remark" action="{{url('cancel-appointment')}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Cancel Appointment</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Reason *') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('reason') is-invalid @enderror remark" name="reason" required="" rows="5" cols="50" placeholder="Reason">{{ old('message','') }}</textarea>
                            @error('reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $reason }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Okay</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
  jQuery('.reply').click(function(){
        var id      = $(this).data('id');
        $('#reply_modal').modal('show');
        $("#reply_modal #id").val(id);
    });
  jQuery('.cancel_appointment').click(function(){
        var id      = $(this).data('id');
        $('#cancel_appointment_modal').modal('show');
        $("#cancel_appointment_modal #id").val(id);
    });
</script>
    <script type="text/javascript">
    var date = new Date();
    var date_format = '{!! \Helper::DateTimeFormat() !!}';
    $('.form_datetime').datetimepicker({
        format: date_format, 
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate: date
    });
    jQuery('.upload_PD').click(function(){
        var id      = $(this).data('id');
        var type      = $(this).data('type');
        if(type == 'Exit')
        {
            var url = "{{url('/get-meter_list')}}"+"/"+id;
            $('#upload_exit_PD_modal .meter_list').load(url,function(result){
                $('#upload_exit_PD_modal').modal('show');
                $("#upload_exit_PD_modal #booking_id").val(id);
                $("#upload_exit_PD_modal #appointment_type").val(type);
            });
            // $('#upload_exit_PD_modal').modal('show');
        }
        else
        {
            $('#upload_PD_modal').modal('show');
            $("#upload_PD_modal #booking_id").val(id);
        }
    });
    jQuery('#dues').blur(function(){
        var dues = jQuery('#dues').val(); 
        var damage = jQuery('#damage').val();
        if (dues == '') 
            {  dues = 0 ; } 
        if (damage == '') 
            {  damage = 0; } 
        var amount = parseInt(damage) + parseInt(dues);
        jQuery('#amount').val(amount);
    });
    jQuery('#damage').blur(function(){
        var dues = jQuery('#dues').val(); 
        var damage = jQuery('#damage').val();
        if (dues == '') 
            {  dues = 0 ; } 
        if (damage == '') 
            {  damage = 0; } 
        var amount = parseInt(damage) + parseInt(dues);
        jQuery('#amount').val(amount);
    });
        jQuery('#visit_add_remark').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                status:{
                    required:true,
                },
                remark:{
                    required:true,
                }
            }      
        });
        jQuery('#add_custom_building').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                a_status:{
                    required:true,
                },
                doc_name:{
                    required:true,
                },
                doc:{
                    required: function(element){
                        if($("#a_status").val() == 'upcoming'){
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                remark:{
                    required:true,
                }
            }      
        });
        jQuery('#reschedule_appointment').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                'time1':"required",
                'time2':"required",
                'time3':"required",
            } ,
            messages: {
                "time1": "Please select Date and Time",
                "time2": "Please select Date and Time",
                "time3": "Please select Date and Time",
            }    
        });
        jQuery('#update_appointment').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                'check_time[]':"required",
            } ,
            messages: {
                "check_time[]": "Please select atleast One!",
            }    
        });
        $("input:checkbox").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
        jQuery('.assigned_action').click(function()
        {
            var id      = $(this).data('id');
            var dates   = $(this).data('dates');
            var array = dates.split(',');
            $('#check_assigned_date').modal('show');

            $("#check_assigned_date .appointment_id").val( id );
            $("#check_assigned_date .time1").val( array[0] );
            $("#check_assigned_date #span_time1").text( array[0] );
            $("#check_assigned_date .time2").val( array[1] );
            $("#check_assigned_date #span_time2").text( array[1] );
            $("#check_assigned_date .time3").val( array[2] );
            $("#check_assigned_date #span_time3").text( array[2] );

            var name      = $(this).data('name');
            var email      = $(this).data('email');
            var phone      = $(this).data('phone_no');

            $("#check_assigned_date #user_click_here").attr( 'data-name', name );
            $("#check_assigned_date #user_click_here").attr( 'data-email', email );
            $("#check_assigned_date #user_click_here").attr( 'data-phone_no', phone );

            return false;
        });
        jQuery('.reject_appointment').click(function(){
            var id      = $(this).data('id');
            var result = confirm("Want to reject the appointment?");
            if (result) {
                $.ajax(
                {
                    url: "{{url('update-appointment')}}",
                    type: "post",
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'appointment_id':id,
                        'action':2,
                    },
                    success : function(data) { 
                      console.log(data);  
                      $('.hide-btn_'+id).hide();                           
                      $('#vo_'+id).show();                           
                      $('#vo_'+id).click();                           
                    },
                    error : function(data) {
                    }
                });

                // jQuery('#appointment_id1').val(id);
                // document.getElementById("reject_update_appointment").submit();
            }
        }); 
        jQuery('.view_appointment').click(function(){
            var title      = $(this).data('title');
            var des      = $(this).data('des');
            $('#appointment_modal').modal('show');
            $("#appointment_modal #appointment_title").text( title );
            $("#appointment_modal #appointment_des").text( des );
            
        });
        jQuery('.view_reply').click(function(){
            var message      = $(this).data('message');
            $('#view_reply_modal').modal('show');
            $("#view_reply_modal #message").text( message );
            
        });
        jQuery('.view_cancal_appointment').click(function(){
            var reason      = $(this).data('reason');
            $('#view_cancal_appointment_modal').modal('show');
            $("#view_cancal_appointment_modal #reason").text( reason );
            
        });
        jQuery('.user_view').click(function(){
            var name      = $(this).data('name');
            var email      = $(this).data('email');
            var phone      = $(this).data('phone_no');
            $('#user_view_modal').modal('show');
            $("#user_view_modal #user_view_name").text( name );
            $("#user_view_modal #user_view_email").text( email );
            $("#user_view_modal #user_view_phone").text( phone );
            
        });
        $('#upload').click(function(){
            jQuery(".loader_div").show();
        });

        jQuery('.booking_action').change(function(){
            var id      = $(this).data('id');
            var status  = jQuery(this).val()
            var thisa   = $(this);
            var result  = "";

            if(jQuery(this).val() == 1){
                var result = confirm("Want to accept the appointment?");
            }
            else if(jQuery(this).val() == 2){
                var result = confirm("Want to reject the appointment?");
            }
            else if(jQuery(this).val() == 3){
                $('#assignAnotherDate').modal('show');
                $("#assignAnotherDate #appointment_id").val( id );
                return false;
            }
            if (!result) {
                return false;
            }
             jQuery(".loader_div").show();
            $.ajax(
            {
                url: "{{url('update-status')}}",
                type: "post",
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id':id,
                    'status':status
                },
                success : function(data) { 
                  var myJSON = JSON.parse(data); 
                  thisa.attr('disabled', 'disabled');
                  jQuery(".loader_div").hide();
                  location.reload();
                  console.log(myJSON);                             
                },
                error : function(data) {
                }
            });
        });
    </script>
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
</script>
    <script type="text/javascript">
            jQuery('#add_unit_custom').validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    property_id:{
                        required:true,
                    },
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
            $("#upload_receipt_form").validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    receipt: {
                      required: true,
                      // accept: "image/*|docx|rtf|doc|pdf",
                      // filesize: 20000,
                      extension: "docx|doc|pdf|jpeg|png|jpg"
                    }
                },
                messages: {
                    receipt: {
                      required: "Please upload receipt",
                      // accept: "The Receipt must be a file of type: jpeg, png, jpg, doc, pdf.",
                      extension: "The Receipt must be a file of type: jpeg, png, jpg, docx, doc, pdf.",
                      filesize: "The Receipt may not be greater than 4MB",
                    }
                },
            });
            jQuery('#upload_exit_receipt_form').validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    receipt:{
                        required: true,
                        // accept: "image/*|docx|rtf|doc|pdf",
                        // filesize: 20000,
                        extension: "docx|doc|pdf|jpeg|png|jpg"
                    },
                    damage:{
                        required:true,
                        number:true
                    },
                    dues:{
                        required:true,
                        number:true
                    },
                    amount:{
                        required:true,
                        number:true
                    }
                }                  
            });

            // $( "#upload_exit_receipt_form" ).submit(function( event ) {

            //     event.preventDefault();
            //     var inputs = $( this ).serializeArray();
            //     console.log(inputs[0]);
            //     // jQuery.each( $('.reading'), function( i, val ) {
            //     //     console.log(i);
            //     //     console.log(val);
                 
            //     //   // Will stop running after "three"
            //     // });
                

            //     // $('.reading').each(function() {
            //     //     var values[this.name] = $(this).val();
            //     //     console.log($(this));
            //     // });
            //     return false;
            //     alert( "Handler for .submit() called." );
            // });
    </script>
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .Building-title {font-size: 24px; }
        .ui-datepicker {margin: 0 auto; }
    </style>
<script type="text/javascript">
    $('#doc_type').change(function(){
        var val = $(this).val();
        if(val == 'mr')
        {
            $('#meter_div').show();
        }
        else{
            $('#meter_div').hide();
        }
    });
</script>
@endsection