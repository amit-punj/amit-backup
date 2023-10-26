@section('title','List of Meters')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List of Meters'])
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
                    <div class="col-sm-12">
                        <div class="top-nevigation">
                            @include('dashboard.topnevigation')
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="add-unit-main">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Meter <span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                </div>  
                <div class="row">
                	<div class="col-sm-4">
	            	 	<div class="building-body">
	            	 		<div class="row">
	            	 			<div class="col-sm-12">
	                                <div class="building-main">
	                                    <div class="building-title">Electricity Meter</div>
	                                </div>
	                            </div>
	                            <div class="col-sm-12">
		                            <div class="unit-body">
		                                <div class="unit-delete"><a href="{{ url('/delete-meter/') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
		                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
		                                <div class="unit"><span>Enity Name : </span> title </div>
		                                <div class="unit"><span>Unit Name : </span> unit_name </div>
		                                <div class="unit"><span>Meter Type : </span> meter_type </div>
		                                <div class="unit"><span>EAN Number : </span> ean_number </div>
		                                <div class="unit"><span>Meter Number : </span> meter_number </div>
		                              
		                            </div>
		                        </div>
	            	 		</div>
	            	 	</div>
            	 	</div>
            	 	<div class="col-sm-4">
	            	 	<div class="building-body">
	            	 		<div class="row">
	            	 			<div class="col-sm-12">
	                                <div class="building-main">
	                                    <div class="building-title">Water Meter</div>
	                                </div>
	                            </div>
	                            <div class="col-sm-12">
		                            <div class="unit-body">
		                                <div class="unit-delete"><a href="{{ url('/delete-meter/') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
		                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
		                                <div class="unit"><span>Enity Name : </span> title </div>
		                                <div class="unit"><span>Unit Name : </span> unit_name </div>
		                                <div class="unit"><span>Meter Type : </span> meter_type </div>
		                                <div class="unit"><span>EAN Number : </span> ean_number </div>
		                                <div class="unit"><span>Meter Number : </span> meter_number </div>
		                              
		                            </div>
		                        </div>
	            	 		</div>
	            	 	</div>
            	 	</div>
            	 	<div class="col-sm-4">
	            	 	<div class="building-body">
	            	 		<div class="row">
	            	 			<div class="col-sm-12">
	                                <div class="building-main">
	                                    <div class="building-title">Gas Meter</div>
	                                </div>
	                            </div>
	                            <div class="col-sm-12">
		                            <div class="unit-body">
		                                <div class="unit-delete"><a href="{{ url('/delete-meter/') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
		                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
		                                <div class="unit"><span>Enity Name : </span> title </div>
		                                <div class="unit"><span>Unit Name : </span> unit_name </div>
		                                <div class="unit"><span>Meter Type : </span> meter_type </div>
		                                <div class="unit"><span>EAN Number : </span> ean_number </div>
		                                <div class="unit"><span>Meter Number : </span> meter_number </div>
		                              
		                            </div>
		                        </div>
	            	 		</div>
	            	 	</div>
            	 	</div>
                    <!-- {{--@php $count = 0 @endphp       
                    @foreach ($meters as $meter)
                        @php $count++ @endphp
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="unit-delete"><a href="{{ url('/delete-meter/'.$meter->id) }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
                                <div class="unit-delete">
                                    <span  meterid="{{ $meter->id }}" 
                                           entityname="{{ $meter->title }}" 
                                           unitname="{{ $meter->unit_name }}"
                                           metertype="{{ $meter->meter_type }}"
                                           unitprice="{{ $meter->unit_price }}"
                                           eannumber="{{ $meter->ean_number }}"
                                           meternumber="{{ $meter->meter_number }}"
                                           dateofreading="{{ $meter->date_of_reading }}"
                                           readingvalue="{{ $meter-> reading_value }}"
                                           data-toggle="modal" data-target="#updateModel" class="glyphicon glyphicon-edit updateUnitButton">
                                        
                                    </span>
                                </div>
                                <div class="unit"><span>Enity Name : </span> {{$meter->title}} </div>
                                <div class="unit"><span>Unit Name : </span> {{$meter->unit_name}} </div>
                                <div class="unit"><span>Meter Type : </span> {{$meter->meter_type}} </div>
                                <div class="unit"><span>EAN Number : </span> {{$meter->ean_number}} </div>
                                <div class="unit"><span>Meter Number : </span> {{$meter->meter_number}} </div>
                            </div>
                        </div>
                    @endforeach   --}} -->
                </div>                                               
            </div>
        </div>
    </div> 
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/create-meter') }}" id="create_meter" enctype="multipart/form-data">
                    @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Meter</h3>
                </div>
                <div class="modal-body">
                    <!-- {{--<div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Entity') }}</label>
                        <div class="col-md-6">
                            <select id="property_id" type="text" class="form-control" name="property_id" value="">
                                    <option value="{{$property->id}}">{{$property->title}}</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('Select unit') }}</label>
                        <div class="col-md-6">
                            <select id="unit_id" type="text" class="form-control" name="property_unit_id" value="">
                               
                                    <option data="" value="{{$unit->id}}">{{$unit->unit_name}}</option>
                               
                            </select>
                        </div>
                    </div>  --}} -->
                     <div class="form-group row">
                        <label for="meter_type" class="col-md-4 col-form-label text-md-right">{{ __('Meter Type') }}</label>
                        <div class="col-md-6">
                            <select id="meter_type" type="text" class="form-control" name="meter_type" value="">
                                <option value="electric_meter">Electricity Meter</option>
                                <option value="water_meter">Water Meter</option>
                                <option value="water_meter">Water Meter</option>
                                <option value="gas_meter">Gas Meter</option>
                                <option value="ineternet_meter">Ineternet Meter</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Per Unit Price') }}</label>
                        <div class="col-md-6">
                            <input id="unit_price" type="text" class="form-control" name="unit_price" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ean_number" class="col-md-4 col-form-label text-md-right">{{ __('EAN Number') }}</label>
                        <div class="col-md-6">
                            <input id="ean_number" type="text" class="form-control" name="ean_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_number" class="col-md-4 col-form-label text-md-right">{{ __('Meter Number') }}</label>
                        <div class="col-md-6">
                            <input id="meter_number" type="text" class="form-control" name="meter_number" value="">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Add Reading</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_doc" class="col-md-4 col-form-label text-md-right">{{ __('Upload Doc (pdf,xls)') }}</label>
                        <div class="col-md-6">
                            <input id="meter_doc" type="file" class="form-control" name="meter_doc" value="" multiple>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_of_reading" class="col-md-4 col-form-label text-md-right">{{ __('Date of Reading') }}</label>
                        <div class="col-md-6">
                            <input id="date_of_reading" type="text" class="form-control" name="date_of_reading" value=""> 
                            <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" name="date_of_reading" type="text" value="" readonly >
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reading_value" class="col-md-4 col-form-label text-md-right">{{ __('Reading Value') }}</label>
                        <div class="col-md-6">
                            <input id="reading_value" type="text" class="form-control" name="reading_value" value="">
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Add Meter</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/update-meter') }}" id="update_meter" enctype="multipart/form-data">
                    @csrf
                    <input id="meter_id" type="hidden" class="form-control" name="meter_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Update Meter</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Entity') }}</label>
                        <div class="col-md-6">
                            <select id="update_property_id" type="text" class="form-control" name="property_id" value="">
                                <!-- <option data="" value="">Select Entity</option> -->
                                    <option value="{{$property->id}}">{{$property->title}}</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('unit') }}</label>
                        <div class="col-md-6">
                            <select id="update_unit_id" type="text" class="form-control" name="property_unit_id" value="" disabled="true">
                                <!-- <option data="" value="">Select Unit</option> -->
                                    <option  value="{{$unit->id}}">{{$unit->unit_name}}</option>
                            </select>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="meter_type" class="col-md-4 col-form-label text-md-right">{{ __('Meter Type') }}</label>
                        <div class="col-md-6">
                            <select id="update_meter_type" type="text" class="form-control" name="meter_type" value="">
                                <option value="electric_meter">Electricity Meter</option>
                                <option value="water_meter">Water Meter</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Per Unit Price') }}</label>
                        <div class="col-md-6">
                            <input id="update_unit_price" type="text" class="form-control" name="unit_price" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ean_number" class="col-md-4 col-form-label text-md-right">{{ __('EAN Number') }}</label>
                        <div class="col-md-6">
                            <input id="update_ean_number" type="text" class="form-control" name="ean_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_number" class="col-md-4 col-form-label text-md-right">{{ __('Meter Number') }}</label>
                        <div class="col-md-6">
                            <input id="update_meter_number" type="text" class="form-control" name="meter_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Add Reading</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_doc" class="col-md-4 col-form-label text-md-right">{{ __('Upload Doc (pdf,xls)') }}</label>
                        <div class="col-md-6">
                            <input id="update_meter_doc" type="file" class="form-control" name="meter_doc" value="" multiple>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_of_reading" class="col-md-4 col-form-label text-md-right">{{ __('Date of Reading') }}</label>
                        <div class="col-md-6">
                            <!-- <input id="date_of_reading" type="text" class="form-control" name="date_of_reading" value=""> -->
                            <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input id="update_date_of_reading" class="form-control" size="16" name="date_of_reading" type="text" value="" readonly >
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reading_value" class="col-md-4 col-form-label text-md-right">{{ __('Reading Value') }}</label>
                        <div class="col-md-6">
                            <input id="update_reading_value" type="text" class="form-control" name="reading_value" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Edit Meter</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
             $('#property_id').change(function(){
                $('#unit_id ').val('');
                if($('#property_id').val() == ''){
                     $('#unit_id ').prop('disabled', true);
                } else {
                    $('#unit_id ').prop('disabled', false);
                    var entity = $('#property_id option:selected').text();
                    $('#unit_id option').each(function(){
                        if( $(this).attr('data') != ''){
                            if( $(this).attr('data') == entity){
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        }
                    });
                }
             });     
             $('#update_property_id').change(function(){
                $('#update_unit_id ').val('');
                if($('#update_property_id').val() == ''){
                     $('#update_unit_id ').prop('disabled', true);
                } else {
                    $('#update_unit_id ').prop('disabled', false);
                    var entity = $('#update_property_id option:selected').text();
                    $('#update_unit_id option').each(function(){
                        if( $(this).attr('data') != ''){
                            if( $(this).attr('data') == entity){
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        }
                    });
                }
             });
             $('.updateUnitButton').click(function(){
                var self = this;
                $('#update_property_id option').each(function() {
                    if($(this).text() == $(self).attr('entityname')) {
                        $(this).prop("selected", true);
                    }
                });
                $('#update_unit_id option').each(function() {
                    if($(this).text() == $(self).attr('unitname')) {
                        $(this).prop("selected", true);
                    }
                });
                $('#update_unit_id').prop("disabled", false);
                $('#update_meter_type option').each(function() {
                    if($(this).val() == $(self).attr('metertype')) {
                        $(this).prop("selected", true);
                    }
                });
                $('#update_unit_price').val($(this).attr('unitprice'));
                $('#update_ean_number').val($(this).attr('eannumber'));
                $('#update_meter_number').val($(this).attr('meternumber'));
                $('#update_reading_value').val($(this).attr('readingvalue'));
                $('#update_date_of_reading').val($(this).attr('dateofreading'));
                $('#meter_id').val($(this).attr('meterid'));
            });              
        });     
        jQuery('#create_meter').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                property_id:{
                    required:true,
                },
                property_unit_id:{
                    required:true,
                },
                meter_type:{
                    required:true
                },
                unit_price:{
                    required:true,
                    number:true
                },
                ean_number:{
                    required:true
                }, 
                meter_number:{
                    required:true
                },
                meter_doc:{
                    required:true,
                    extension: "xls|pdf"
                },
                date_of_reading:{
                    required:true
                },
                reading_value:{
                    required:true,
                    number:true
                },

            }      
        });
        jQuery('#update_meter').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                property_id:{
                    required:true,
                },
                property_unit_id:{
                    required:true,
                },
                meter_type:{
                    required:true
                },
                unit_price:{
                    required:true,
                    number:true
                },
                ean_number:{
                    required:true
                }, 
                meter_number:{
                    required:true
                },
                meter_doc:{
                    extension: "xls|pdf"
                },
                date_of_reading:{
                    required:true
                },
                reading_value:{
                    required:true,
                    number:true
                },

            }      
        });
        jQuery('.form_datetime').datetimepicker({
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
        .unit-body span {font-size: 15px; font-weight: bold; color: #f28401; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right; }
        .building-body{border: 1px solid #f28401; padding: 15px; margin: 15px 0;}
        .building-title {font-size: 33px; font-weight: normal; text-align: center; }
        </style>
@endsection