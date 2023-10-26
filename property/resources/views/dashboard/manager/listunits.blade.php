@extends('layouts.app')
@section('content')
@include('layouts.banner')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('dashboard.sidebar')
            </div>
            <div class="col-md-9">
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
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="{{url('/list-units')}}">Units</a></li>
                                <!-- <li><a href="{{url('/list-meters')}}">Meters</a></li>
                                <li><a href="{{ url('/list-contracts') }}">Contracts</a></li>
                                <li><a href="{{ url('/list-guarantors') }}">Guarantors</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="add-unit-main">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Unit <span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                </div>  
                <div ><h3>Assigned Unit</h3></div>
                <div class="row">
                    @php $count = 0 @endphp       
                    @foreach ($assignedUnits as $unit)
                        @php $count++ @endphp
                        <div class="col-sm-4">
                            <div class="unit-body">
                            	<div class="unit-delete"><a href="{{ url('/delete-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-trash"></span></a></div>
                            	<div class="unit-delete"><a href="{{ url('/edit-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                            		<!-- <span  unitid="{{ $unit->id }}" 
                            			   entityname="{{ $unit->title }}" 
                            			   unitname="{{ $unit->unit_name }}"
                            			   unitrent="{{ $unit->rent }}"
                            			   unitdeposit="{{ $unit->deposit }}"
                            			   data-toggle="modal" data-target="#updateModel" class="glyphicon glyphicon-edit updateUnitButton">
                            			
                            		</span> -->
                            	</div>
                                <div class="unit_number"> <span>Unit Number :</span> {{ $count }}</div>
                                <div class="unit"><span>Enity Name : </span> {{$unit->title}} </div>
                                <div class="unit"><span>Unit Name : </span> {{$unit->unit_name}} </div>
                                <div class="unit"><span>Rent : </span> {{$unit->rent}} </div>
                                <div class="unit"><span>Deposit : </span> {{$unit->deposit}} </div>
                            </div>
                        </div>
                    @endforeach  
                </div> 
                <div ><h3>Created Unit</h3></div>
                <div class="row">
                    @php $count = 0 @endphp       
                    @foreach ($createdUnits as $unit)
                        @php $count++ @endphp
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="unit-delete"><a href="{{ url('/delete-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-trash"></span></a></div>
                                <div class="unit-delete"><a href="{{ url('/edit-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                    <!-- <span  unitid="{{ $unit->id }}" 
                                           entityname="{{ $unit->title }}" 
                                           unitname="{{ $unit->unit_name }}"
                                           unitrent="{{ $unit->rent }}"
                                           unitdeposit="{{ $unit->deposit }}"
                                           data-toggle="modal" data-target="#updateModel" class="glyphicon glyphicon-edit updateUnitButton">
                                        
                                    </span> -->
                                </div>
                                <div class="unit_number"> <span>Unit Number :</span> {{ $count }}</div>
                                <div class="unit"><span>Enity Name : </span> {{$unit->title}} </div>
                                <div class="unit"><span>Unit Name : </span> {{$unit->unit_name}} </div>
                                <div class="unit"><span>Rent : </span> {{$unit->rent}} </div>
                                <div class="unit"><span>Deposit : </span> {{$unit->deposit}} </div>
                            </div>
                        </div>
                    @endforeach  
                </div>                                                            
            </div>
        </div>
    </div> 
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/create-unit') }}" id="add_unit_custom">
                    @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Unit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Entity') }}</label>
                        <div class="col-md-6">
                            <select id="property_id" type="text" class="form-control" name="property_id" value="">
                                @foreach ($properties as $property)  
                                    <option value="{{$property->id}}">{{$property->title}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Unit Name') }}</label>
                        <div class="col-md-6">
                            <input id="unit_name" type="text" class="form-control" name="unit_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rent') }}</label>
                        <div class="col-md-6">
                            <input id="rent" type="text" class="form-control" name="rent" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Deposit') }}</label>
                        <div class="col-md-6">
                            <input id="deposit" type="text" class="form-control" name="deposit" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Create Unit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
   <!--  <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/update-unit') }}">
                    @csrf
                     <input id="update_unit_id" type="hidden" class="form-control" name="unit_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Update Unit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Entity') }}</label>
                        <div class="col-md-6">
                            <select id="update_property_id" type="text" class="form-control" name="property_id" value="">
                                @foreach ($properties as $property)  
                                    <option value="{{$property->id}}">{{$property->title}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>   
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
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Create Unit</button>
                </div>
                </form>
            </div>
        </div>
    </div> -->
    <script>
        $(document).ready(function(){
            $('.updateUnitButton').click(function(){
            	var self = this;
            	$('#update_property_id option').each(function() {
				    if($(this).text() == $(self).attr('entityname')) {
				        $(this).prop("selected", true);
				    }
				});
            	$('#update_unit_id').val($(this).attr('unitid'));
            	$('#update_unit_name').val($(this).attr('unitname'));
            	$('#update_rent').val($(this).attr('unitrent'));
            	$('#update_deposit').val($(this).attr('unitdeposit'));
            });
        });            
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
        .unit-body span {font-size: 15px; font-weight: bold; color: #f28401; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        </style>
@endsection