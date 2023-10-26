@section('title','Meter Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Meter Details'])
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
                        <div class="Building-title">Meter Details</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <a class="btn btn-success" href="{{ url('list-meters/19') }}">Back</a>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_reading">Add Reading  <span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                            <div class="unit"><span>Unit Name : </span> test Unit</div>
                            <div class="unit"><span>Meter Type : </span> Electric Meter</div>
                            <div class="unit"><span>Per Unit Price : </span> 6 </div> 
                            <div class="unit"><span>EAN Number : </span> 65778 </div>
                            <div class="unit"><span>Meter Number : </span> 5435 </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Building-Units">Meter Readings</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >S.No</td>
                                        <td >Date</td>
                                        <td >Last Reading</td>
                                        <td >Per unit Price</td>
                                        <td >Total Amount</td>
                                        <td >Status</td>
                                        <td >Document's</td>
                                    </tr>              
                                    <tr>
                                        <td >1</td>
                                        <td > 07 September, 2019 - 10:35 am</td>
                                        <td >5642</td>
                                        <td >8</td>
                                        <td >$1200</td>
                                        <td >Pending</td>
                                        <td >
                                            <div class="documemt_action">
                                                <a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span title="Download" class="glyphicon glyphicon-download-alt"></span></a>
                                            </div>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td >2</td>
                                        <td > 03 September, 2019 - 10:35 am</td>
                                        <td >5642</td>
                                        <td >8</td>
                                        <td >$1200</td>
                                        <td >Pending</td>
                                        <td >
                                            <div class="documemt_action">
                                                <a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span title="Download" class="glyphicon glyphicon-download-alt"></span></a>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td >3</td>
                                        <td > 08 September, 2019 - 10:35 am</td>
                                        <td >5642</td>
                                        <td >8</td>
                                        <td >$1200</td>
                                        <td >Pending</td>
                                        <td >
                                            <div class="documemt_action">
                                                <a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>
                                                <a href="#"><span title="Download" class="glyphicon glyphicon-download-alt"></span></a>
                                            </div>
                                        </td>
                                    </tr>                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                                      
            </div>
        </div>
    </div> 
    <div class="modal fade" id="add_reading" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{-- url('/update-unit') --}}" id="add_reading_form">
                    @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Add Reading</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Reading') }}</label>
                        <div class="col-md-6">
                           <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" name="time" type="text" value="" readonly="">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_reading" class="col-md-4 col-form-label text-md-right">{{ __('Last Reading') }}</label>
                        <div class="col-md-6">
                            <input id="last_reading" type="text" class="form-control" name="last_reading" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_reading" class="col-md-4 col-form-label text-md-right">{{ __('Current Reading') }}</label>
                        <div class="col-md-6">
                            <input id="current_reading" type="text" class="form-control" name="current_reading" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="per_unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Per unit Price') }}</label>
                        <div class="col-md-6">
                            <input id="per_unit_price" type="text" class="form-control" name="per_unit_price" value="8" disabled="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                        <div class="col-md-6">
                            <input id="amount" type="text" class="form-control" name="amount" value="8390" disabled="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                        <div class="col-md-6">
                            <select name="status" id="status" class="form-control green" aria-invalid="false">
                                <option value="unit">Pending</option>
                                <option value="building">Confirm</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Add Reading</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery('#add_reading_form').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                date:{
                    required:true,
                },
                last_reading:{
                    required:true,
                    number:true
                },
                current_reading:{
                    required:true,
                    number:true
                },
                amount:{
                    required:true,
                    number:true
                },
                status:{
                    required:true,
                },
            }      
        });
        $('.form_datetime').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
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
        .add-unit-main {text-align: right; margin-top: 0px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: center; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
    </style>
@endsection