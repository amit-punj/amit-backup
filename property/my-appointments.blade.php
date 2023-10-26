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
            <div class="add-unit-main">
                <a href="{{url('book-appointment')}}" target="_blank" style="float: right;" class="btn btn-success">Book Appointment <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-12 top-nevigation">
                    <div class="tab-content">
                        <div id="book_appointment" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-sm-12">      
                                    @if(count($booked) > 0 ) 
                                        <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr class="text-center f17">
                                                        <th class="text-left"> Unit Name</th>
                                                        <th class="text-left"> Appointment Time </th>
                                                        <th class="text-left"> Appointment With </th>
                                                        <th class="text-left">Appointment Type </th>
                                                        <th class="text-left"> Appointment Status </th>
                                                       <!--  <th class="text-left"> Action </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($booked as $key =>$book)    
                                                    <tr class="f15">
                                                        <td class="f500">
                                                            <a target="_blank" href="{{ url('propertydetails/'.$book->unit_id) }} ">
                                                            <?php echo $retVal = (isset($book->unit->unit_name) ) ? $book->unit->unit_name : 'no unit' ; ?> </a>
                                                        </td>
                                                        <td>{!! \Helper::DateTime($book->time); !!}</td>
                                                        <td>Property Discription Expert</td>
                                                        <td >Exit</td>
                                                        <td >Accepted</td>
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
                                    <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered">
                                                <tbody >
                                                    <tr class="text-center f17">
                                                        
                                                        <th class="text-left"> Unit Name</th>
                                                        <th class="text-left"> Appointment Time </th>
                                                        <th class="text-left"> Appointment With </th>
                                                        <th class="text-left">Appointment Type </th>
                                                        <th class="text-left"> Appointment Status </th>
                                                       <!--  <th class="text-left"> Action </th> -->
                                                    </tr>
                                                    <tr class="f15">
                                                        <td class="f500">
                                                            <a target="_blank" href="{{ url('propertydetails/22') }} ">Unit Name</a>
                                                        </td>
                                                        <td>20 September, 2019 - 09:50 pm</td>
                                                        <td>Property Discription Expert</td>
                                                        <td >Exit</td>
                                                        <td >Accepted</td>
                                                    </tr>     
                                                    <tr class="f15">
                                                        <td class="f500">
                                                            <a target="_blank" href="{{ url('propertydetails/22') }} ">Unit Name</a>
                                                        </td>
                                                        <td>20 September, 2019 - 09:50 pm</td>
                                                        <td>Legal Advisor</td>
                                                        <td >Entry</td>
                                                        <td >Rejected</td>
                                                    </tr>
                                                    <tr class="f15">
                                                        <td class="f500">
                                                            <a target="_blank" href="{{ url('propertydetails/22') }} ">Unit Name</a>
                                                        </td>
                                                        <td>20 September, 2019 - 09:50 pm</td>
                                                        <td>Visit Organizer</td>
                                                        <td >Exit</td>
                                                        <td >Accepted</td>
                                                    </tr>
                                                    <tr class="f15">
                                                        <td class="f500">
                                                            <a target="_blank" href="{{ url('propertydetails/22') }} ">Unit Name</a>
                                                        </td>
                                                        <td>20 September, 2019 - 09:50 pm</td>
                                                        <td>Visit Organizer</td>
                                                        <td >Entry</td>
                                                        <td >Rejected</td>
                                                    </tr>                   
                                                </tbody>
                                            </table>
                                    </div>    
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