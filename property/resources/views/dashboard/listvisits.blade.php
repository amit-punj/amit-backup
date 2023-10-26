@section('title','List of Appointments')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List of Appointments'])
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
        <div class="row">
            <div class="col-sm-6">
                <div class="top-nevigation">
                    @include('dashboard.appointment-top-bar')
                </div>
            </div>
        </div> 
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
                   <!--  <div class="profile-page-title">List Of Visits</div>    -->
                    <div class="col-sm-12">                                              
                        <div  class="user-info-table">
                            @if (count($visits) >= 1)
                                <table  class="table table-hover table-striped table-bordered">
                                    <tbody >
                                        <tr class="text-center f17">
                                            
                                            <th class="text-left"> Unit Name</th>
                                            <th class="text-left"> Appointment Time </th>
                                            <th class="text-left"> Tenant Name </th>
                                            @if (Auth::user()->user_role == 4)
                                                <th class="text-left"> Contract Type </th>
                                                <th class="text-left">Appointment Type </th>
                                            @endif
                                            @if (\Request::is('list-visits'))
                                            <th class="text-left"> Appointment Status </th>
                                            @endif
                                            @if (\Request::is('completed-visits'))
                                                <th class="text-left"> Status </th>
                                                <th class="text-left"> Remarks </th>
                                            @endif
                                            <th class="text-left"> Action </th>
                                        </tr>
                                            @foreach($visits as $key => $visit)  
                                                <tr class="f15">
                                                    
                                                    <td class="f500">
                                                        <a target="_blank" href="{{ url('propertydetails/19') }} ">{{ substr($visit->property_title,0,20)."..." }}</a>
                                                    </td>
                                                    <td >{{ $visit->visit_time }}</td>
                                                    <td >{{ $visit->firstname." ".$visit->lastname }}</td>
                                                    @if (Auth::user()->user_role == 4)
                                                        <td>
                                                            @if (0 == $key % 2)
                                                                <a href="{{url('contract-details/2')}}"> Commercial </a>
                                                            @else 
                                                                <a href="{{url('contract-details/2')}}"> House </a>
                                                            @endif
                                                        </td>
                                                        <td> 
                                                            @if (0 == $key % 2) 
                                                                Entry
                                                            @else 
                                                                Exit
                                                            @endif
                                                        </td>
                                                    @endif
                                                    @if (\Request::is('list-visits'))
                                                    <td >
                                                        <select name="visit_action" id="visit_action" class="visit_action_popup">
                                                            <option value="accepted">Accepted</option>
                                                            <option value="reject">Reject</option>
                                                            <option value="assign_another_date">Assign Another Date</option>
                                                        </select>
                                                    </td>
                                                    @endif
                                                    @if (\Request::is('completed-visits'))
                                                        <td>
                                                            @if (0 == $key % 2) 
                                                                Completed
                                                            @else 
                                                                Cancel
                                                            @endif
                                                        </td>
                                                        <td> Remark Added </td>
                                                    @endif
                                                    <td class="text-center align-middle">
                                                        <a href="{{ url('visit-details/5') }}" class=""><span style="" class="glyphicon glyphicon-eye-open" title="View"></span></a>
                                                        @if (Auth::user()->user_role == 6)
                                                            <a href="javascript::void(0);" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit" title="Add Remarks"></span></a>
                                                        @endif
                                                        @if (Auth::user()->user_role == 4)
                                                            @if (\Request::is('completed-visits'))
                                                                <a href="#" ><span class="glyphicon glyphicon-download-alt" title="Download All Documents"></span></a>
                                                            @endif
                                                            <a data-toggle="modal" data-target="#UploadDoc"><span class="glyphicon glyphicon-edit" title="Upload Document"></span></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach                           
                                    </tbody>
                                </table>
                            @else
                                <div>Not found any Record.</div>
                            @endif
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
                                    <!-- <option value="pm">Property Manager</option> -->
                                    <option value="mr">Meter Reading</option>
                                    <option value="pde">Property Description</option>
                                    <!-- <option value="lad">Legal Advisor</option> -->
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
                <form method="get" id="add_custom_building">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Assign Another 3 Dates</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                           <!--  <label for="rent" class="col-md-2 col-form-label text-md-right">{{ __('Dates') }}</label> -->
                            <div class="col-md-12">
                                <div id="any_days" class="">
                                    <div id="datepicker_not_av"></div>
                                </div>
                                <input type="hidden" name="selecteddates" value="" class="selecteddates" />
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
    <script type="text/javascript">
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
        jQuery('.visit_action_popup').change(function(){
            if(jQuery(this).val() == 'assign_another_date'){
                $('#assignAnotherDate').modal('show');
            }
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
    </script>
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
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