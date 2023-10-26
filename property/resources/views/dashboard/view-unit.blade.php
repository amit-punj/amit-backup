@section('title','Unit Detail')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Unit Detail'])
<?php $role = Auth::user()->user_role; ?>
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
                        <div class="top-nevigation">
                            @include('dashboard.topnevigation')
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if($role != 6)
                            <div class="add-unit-main">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModel">Edit Unit <span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        @endif
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="unit-title">Basic Details</div>
                        <div class="unit"><span>Unit Name : </span> Test Unit </div>
                        <div class="unit"><span>Size(Sq Ft)  : </span> 400 </div>
                        <div class="unit"><span>Description  : </span> There are two ways to think about finding real estate leads. Traditional real estate advertising focuses on outbound leads, which involves targeted prospecting to hone in on qualified leads. There are two ways to think about finding real estate leads. Traditional real estate advertising focuses on outbound leads, which involves targeted prospecting to hone in on qualified leadsThere are two ways to think about finding real estate leads. Traditional real estate advertising focuses on outbound leads, which involves targeted prospecting to hone in on qualified leadsThere are two ways to think about finding real estate leads. Traditional real estate advertising focuses on outbound leads, which involves targeted prospecting to hone in on qualified leadsThere are two ways to think about finding real estate leads. Traditional real estate advertising focuses on outbound leads, which involves targeted prospecting to hone in on qualified leadsThere are two ways to think about finding real estate leads. Traditional real estate advertising focuses on outbound leads, which involves targeted prospecting to hone in on qualified leads.
                        </div>
                        <div class="unit"><span>Address : </span> Daytona Beach, FL, USA </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="unit-title">Unit Details</div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="unit"><span>Unit Type : </span> Residential </div>
                                <div class="unit"><span>Building Name  : </span> Building 1 </div>
                                <div class="unit"><span>Rent  : </span> 5000 </div>
                                <div class="unit"><span>Cost Provision  : </span> 1000 </div>
                                <div class="unit"><span>Deposit  : </span> 20000 </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="unit"><span>Number of Bedrooms : </span> 3 </div>
                                <div class="unit"><span>Bedroom Furnished : </span> Yes </div>
                                <div class="unit"><span>Lock on Bedroom : </span> Yes </div>
                                <div class="unit"><span>Allergy friendly : </span> No </div>
                                <div class="unit"><span>Kitchen : </span> Yes </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="unit"><span>Toilet : </span> Yes </div>
                                <div class="unit"><span>Living Room : </span> Yes </div>
                                <div class="unit"><span>Balcony/Terrace : </span> Yes </div>
                                <div class="unit"><span>Garden : </span> No </div>
                                <div class="unit"><span>Basement : </span> No </div>
                            </div>
                            <div class="col-sm-3">   
                                <div class="unit"><span>Parking : </span> No </div>
                                <div class="unit"><span>Wheelchair Accessible : </span> No </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="unit"><span>Amenities/Facilities available : </span> Wifi, Heating, Chairs, Whiteboard, Bar</div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @if($role != 6)
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="unit-title">Assign Unit</div>
                            <div class="unit"><span>Property Manager : </span> {{$unitPropertyManager->name." ".$unitPropertyManager->last_name}} </div>
                            <div class="unit"><span>Property Description Experts : </span> {{$unitPropertyDescriptionExpert->name." ".$unitPropertyDescriptionExpert->last_name}} </div>
                            <div class="unit"><span>Legal Advisor : </span> {{$unitLegalAdvisor->name." ".$unitLegalAdvisor->last_name}} </div>
                            <div class="unit"><span>Visit Organizer : </span> {{$unitVisitOrganizer->name." ".$unitVisitOrganizer->last_name}} </div>
                            <div class="unit vendor_list"><span>Vendors : </span> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul>
                                            <li>
                                                <ul>
                                                    <li>Name : </li><li>Jhon</li>
                                                    <li>Phone No : </li><li>3434324324</li>
                                                    <li>Email : </li><li>john@gmail.com</li>
                                                    <li>Type : </li><li>Plumber</li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li>Name : </li><li>Jhon</li>
                                                    <li>Phone No : </li><li>3434324324</li>
                                                    <li>Email : </li><li>john@gmail.com</li>
                                                    <li>Type : </li><li>Plumber</li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li>Name : </li><li>Jhon</li>
                                                    <li>Phone No : </li><li>3434324324</li>
                                                    <li>Email : </li><li>john@gmail.com</li>
                                                    <li>Type : </li><li>Plumber</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="unit-title">Preferred Tenant</div>
                            <div class="unit"><span>Preferred Gender : </span> Male </div>
                            <div class="unit"><span>Minimum Age : </span> 22 </div>
                            <div class="unit"><span>Maximum Age : </span> 60 </div>
                            <div class="unit"><span>Tenant Type : </span> Student </div>
                            <div class="unit"><span>Couples Allowed : </span> No </div>
                        </div>
                    </div>
                    <hr> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="unit-meter-title"> List Of Meters</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="unit-delete"><a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
                                <div class="unit"><span>Unit Name : </span> Test Unit </div>
                                <div class="unit"><span>Meter Type : </span> Electric Meter </div>
                                <div class="unit"><span>EAN Number : </span> EN5454345 </div>
                                <div class="unit"><span>Meter Number : </span> 34343432 </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="unit-delete"><a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
                                <div class="unit"><span>Unit Name : </span> Test Unit </div>
                                <div class="unit"><span>Meter Type : </span> Water Meter </div>
                                <div class="unit"><span>EAN Number : </span> EN5454345 </div>
                                <div class="unit"><span>Meter Number : </span> 34343432 </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="unit-delete"><a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
                                <div class="unit"><span>Unit Name : </span> Test Unit </div>
                                <div class="unit"><span>Meter Type : </span> Electric Meter </div>
                                <div class="unit"><span>EAN Number : </span> EN5454345 </div>
                                <div class="unit"><span>Meter Number : </span> 34343432 </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="unit-body">
                                <div class="unit-delete"><a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
                                <div class="unit-delete"><a href="{{ url('/meter-details/1') }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a></div>
                                <div class="unit"><span>Unit Name : </span> Test Unit </div>
                                <div class="unit"><span>Meter Type : </span> Electric Meter </div>
                                <div class="unit"><span>EAN Number : </span> EN5454345 </div>
                                <div class="unit"><span>Meter Number : </span> 34343432 </div>
                            </div>
                        </div>
                    </div>
                    <hr> 
                @endif  
                <div class="row">
                    <div class="col-sm-12">
                    <div class="unit-title">Rules</div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="unit"><span>Registration Possible : </span> Yes </div>
                                <div class="unit"><span>Cleaning Common Eoom Incl : </span> Yes </div>
                                <div class="unit"><span>Cleaning Private Room Incl : </span> Yes </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="unit"><span>Animal allowed : </span> No </div>
                                <div class="unit"><span>Play Musical Instrument : </span> No </div>
                                <div class="unit"><span>Smoking Allowed : </span> No </div>
                            </div>
                        </div>
                    </div>
                </div>                                     
            </div>
        </div>
    </div> 
    <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/update-unit') }}" id="update_unit_form">
                    @csrf
                     <input id="update_unit_id" type="hidden" class="form-control" name="unit_id" value="{{$unit->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Update Unit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Entity') }}</label>
                        <div class="col-md-6">
                            <select id="update_property_id" type="text" class="form-control" name="property_id" value=""> 
                                    <option value="{{$property->id}}">{{$property->title}}</option>                    
                            </select>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Unit Name') }}</label>
                        <div class="col-md-6">
                            <input id="update_unit_name" type="text" class="form-control" name="unit_name" value="{{$unit->unit_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rent') }}</label>
                        <div class="col-md-6">
                            <input id="update_rent" type="text" class="form-control" name="rent" value="{{$unit->rent}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Deposit') }}</label>
                        <div class="col-md-6">
                            <input id="update_deposit" type="text" class="form-control" name="deposit" value="{{$unit->deposit}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-12 col-form-label text-md-right">{{ __('Amenities/Facilities available') }}</label>
                        <div class="col-md-12">
                            @foreach ($amenities as $amenity)  
                                <div class="col-md-6">
                                    @if(in_array($amenity->id,explode(',', $unit->amenities)))  
                                        <input class="form-control amenities-input" name="amenities[]" type="checkbox" value="{{$amenity->id}}" checked>
                                    @else
                                        <input class="form-control amenities-input" name="amenities[]" type="checkbox" value="{{$amenity->id}}">
                                    @endif
                                    <label class="col-form-label">{{$amenity->amenities_name}}</label>
                                </div>
                             @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Property Manager') }}</label>
                        <div class="col-md-6">
                            <select id="property_id" type="text" class="form-control" name="property_manager_id" value="">
                                <option value="">Select Property Manager</option>
                                @foreach ($PropertyManagers as $PropertyManager)
                                    @if( $PropertyManager->id == $unit->property_manager_id)
                                        <option value="{{$PropertyManager->id}}" selected>{{$PropertyManager->name." ".$PropertyManager->last_name }}</option>
                                    @else
                                        <option value="{{$PropertyManager->id}}">{{$PropertyManager->name." ".$PropertyManager->last_name }}</option>
                                    @endif
                                @endforeach
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Property Description Experts') }}</label>
                        <div class="col-md-6">
                            <select id="property_id" type="text" class="form-control" name="property_description_experts_id" value="">
                                <option value="">Select Property Description Experts</option>
                                @foreach ($PropertyDescriptionExperts as $PropertyDescriptionExpert)  
                                    @if( $PropertyDescriptionExpert->id == $unit->property_description_experts_id)
                                        <option value="{{$PropertyDescriptionExpert->id}}" selected>{{$PropertyDescriptionExpert->name." ".$PropertyDescriptionExpert->last_name }}</option>
                                    @else
                                        <option value="{{$PropertyDescriptionExpert->id}}">{{$PropertyDescriptionExpert->name." ".$PropertyDescriptionExpert->last_name }}</option>
                                    @endif
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Legal Advisor') }}</label>
                        <div class="col-md-6">
                            <select id="property_id" type="text" class="form-control" name="property_legal_advisor_id" value="">
                                <option value="">Select Legal Advisor</option>
                                @foreach ($LegalAdvisors as $LegalAdvisor)  
                                     @if( $LegalAdvisor->id == $unit->property_legal_advisor_id)
                                       <option value="{{$LegalAdvisor->id}}" selected>{{$LegalAdvisor->name." ".$LegalAdvisor->last_name}}</option>
                                    @else
                                       <option value="{{$LegalAdvisor->id}}">{{$LegalAdvisor->name." ".$LegalAdvisor->last_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Visit Organizer') }}</label>
                        <div class="col-md-6">
                            <select id="property_id" type="text" class="form-control" name="property_visit_organizer_id" value="">
                                <option value="">Select Visit Organizer</option>
                                @foreach ($VisitOrganizers as $VisitOrganizer)
                                    @if( $VisitOrganizer->id == $unit->property_visit_organizer_id)
                                        <option value="{{$VisitOrganizer->id}}" selected>{{$VisitOrganizer->name." ".$VisitOrganizer->last_name}}</option>
                                    @else
                                        <option value="{{$VisitOrganizer->id}}">{{$VisitOrganizer->name." ".$VisitOrganizer->last_name}}</option>
                                    @endif
                                @endforeach
                               
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Update Unit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
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
            jQuery('#update_unit_form').validate({
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
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .unit-meter-title {font-size: 24px; margin-top: 15px; }
        .unit-title {font-size: 24px;     margin-top: 25px; }
        .unit span {font-weight: bold; }
        .unit.vendor_list ul li ul li {width: 35%; display: inline-block; padding: 3px 0; }
        .unit.vendor_list ul ul {margin: 15px 0; padding: 0; }
        .unit.vendor_list ul {list-style-type: decimal; }
        </style>
@endsection