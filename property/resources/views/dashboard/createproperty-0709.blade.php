@extends('layouts.app')
@section('content')
@include('layouts.banner')
    <div class="container">
<style>
    .tab_title {
            text-align: center;
            margin-bottom: 40px;
        }
    .amenities-input {
        width: 20px;
        display: inline-block;
        height: 20px;
        padding-top: 2px;
    }
    .pac-container {
        background-color: #FFF;
        z-index: 20;
        position: fixed;
        display: inline-block;
        float: left;
    }
    .modal{
        z-index: 20;   
    }
    .modal-backdrop{
        z-index: 10;        
    }​
   
    * {
      box-sizing: border-box;
    }
    body {
      background-color: #f1f1f1;
    }
    #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
    }
    h1 {
      text-align: center;  
    }
    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }
    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }
    /* Hide all steps by default: */
    .tab {
      display: none;
    }
    button {
      background-color: #34a11b;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      font-family: Raleway;
      cursor: pointer;
    }
    button:hover {
      opacity: 0.8;
    }
    #prevBtn {
      background-color: #f28300;
    }
    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;  
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }
    .step.active {
      opacity: 1;
    }
    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #4CAF50;
    }
</style>
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
                <div class="profile-page-title">Create Unit</div>                        
                    <!------------------>
                <div class="create-property-page">
                    <div class="row justify-content-center">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/create-property') }}" enctype="multipart/form-data" id="create_propert_form">
                                    @csrf
                                    <div class="collapse-group">
                                        <div id="general_info" class="collapse in">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <div class="tab">
                                                <h3 class="tab_title"> Property Type </h3>
                                                <div class="form-group row">
                                                    <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Property Type') }}</label>
                                                    <div class="col-md-6">
                                                        <select name="p_type" id="p_type" class="form-control">
                                                            <!-- <option value="">Select Property Type</option> -->
                                                            <option value="unit">Unit</option>
                                                            <option value="building">Building</option>
                                                        </select>
                                                        @error('type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div> 
                                            </div> 
                                            <div class="tab">
                                                <h3 class="tab_title"> Basic Details </h3>
                                                <div class="form-group row">
                                                    <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Unit Type') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required>
                                                            <option value="residential">Residential</option>
                                                            <option value="commercial">Commercial</option>
                                                            <option value="industrial">Industrial</option>
                                                        </select>

                                                        @error('type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>   
                                                <div class="form-group row">
                                                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Unit Name') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', 'Unit Name') }}" >

                                                        @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Size(Sq Ft)') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area','100') }}"  >
                                                        @error('area')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                                    <div class="col-md-6">
                                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"  >{{ old('description','There are two ways to think about finding real estate leads. Traditional real estate advertising focuses on outbound leads, which involves targeted prospecting to hone in on qualified leads.') }}</textarea>

                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                                                    <input name="latitude" id="latitude" type="hidden" value="44">
                                                    <input name="longitude" id="longitude" type="hidden" value="34">
                                                    <div class="col-md-6">
                                                        <input id="autocomplete" type="text" class="form-control @error('address') is-invalid @enderror autocomplete" name="address" value="{{ old('address','Daytona Beach, FL, USA') }}" >

                                                        @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab" id="unit_select">
                                                <h3 class="tab_title"> Building </h3>
                                                <div class="form-group row">
                                                    <label for="building_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Building') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="building_id" class="form-control @error('building_id') is-invalid @enderror" name="building_id" value="{{ old('building_id') }}" required 
                                                        >
                                                            <option value="">Select</option>
                                                            <option value="">Building 1</option>
                                                            <option value="">Building 2</option>
                                                        </select>                                         
                                                        @error('building_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="meter_id" class="col-md-4 col-form-label text-md-right">{{ __('Meters') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="meter_id" class="form-control @error('meter_id') is-invalid @enderror" name="meter_id" value="{{ old('meter_id') }}" required 
                                                        >
                                                            <option value="">Select</option>
                                                            <option value="">Meter 1</option>
                                                            <option value="">Meter 2</option>
                                                        </select>                                         
                                                        @error('meter_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#meterModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rent') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="rent" type="text" class="form-control @error('rent') is-invalid @enderror" name="rent" value="{{ old('rent','1000') }}"  >

                                                        @error('rent')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="deposit" class="col-md-12 col-form-label text-md-right">{{ __('Amenities/Facilities available') }}</label>
                                                    <div class="col-md-12">
                                                        @foreach ($amenities as $amenity)  
                                                            <div class="col-md-4">
                                                                <input class="form-control amenities-input" name="amenities[]" type="checkbox" value="{{$amenity->id}}">
                                                                <label class="col-form-label">{{$amenity->amenities_name}}</label>
                                                            </div>
                                                         @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab">
                                                <h3 class="tab_title"> Assign Unit </h3>
                                                <div class="form-group row">
                                                    <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Property Manager') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="property_id" type="text" class="form-control" name="property_manager_id" value="">
                                                            <option value="">Select Property Manager</option>
                                                            @foreach ($PropertyManagers as $PropertyManager)  
                                                                <option value="{{$PropertyManager->id}}">{{$PropertyManager->name." ".$PropertyManager->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button style="float: right;" data-id="3" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#permissionModal">Permissions <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                        <!-- <button style="float: right;" data-id="3" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                                        </button> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Property Description Experts') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="property_description_experts_id" type="text" class="form-control" name="property_description_experts_id" value="">
                                                            <option value="">Select Property Description Experts</option>
                                                            @foreach ($PropertyDescriptionExperts as $PropertyDescriptionExpert)  
                                                                <option value="{{$PropertyDescriptionExpert->id}}">{{$PropertyDescriptionExpert->name." ".$PropertyDescriptionExpert->last_name }}</option>
                                                            @endforeach 
                                                        </select>
                                                    </div>
                                                    <!-- <div>
                                                        <button style="float: right;" data-id="4" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </div> -->
                                                </div>
                                                <div class="form-group row">
                                                    <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Legal Advisor') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="property_legal_advisor_id" type="text" class="form-control" name="property_legal_advisor_id" value="">
                                                            <option value="">Select Legal Advisor</option>
                                                            @foreach ($LegalAdvisors as $LegalAdvisor)  
                                                                <option value="{{$LegalAdvisor->id}}">{{$LegalAdvisor->name." ".$LegalAdvisor->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- <div>
                                                        <button style="float: right;" type="button" data-id="5" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </div> -->
                                                </div>
                                                <div class="form-group row">
                                                    <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Visit Organizer') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="property_visit_organizer_id" type="text" class="form-control" name="property_visit_organizer_id" value="">
                                                            <option value="">Select Visit Organizer</option>
                                                            @foreach ($VisitOrganizers as $VisitOrganizer)  
                                                                <option value="{{$VisitOrganizer->id}}">{{$VisitOrganizer->name." ".$VisitOrganizer->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                   <!--  <div>
                                                        <button style="float: right;" data-id="6" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="tab">
                                             <h3 class="tab_title"> Images </h3>
                                                <!-- <div class="form-group row">
                                                    <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('type') }}" required>
                                                            <option value="active">Active</option>
                                                            <option value="passive">Passive</option>
                                                            <option value="off the market">Off the market</option>
                                                        </select>
                                                        @error('status')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div> -->
                                                <div class="form-group row">
                                                    <label for="banner_image" class="col-md-4 col-form-label text-md-right">{{ __('Select Banner') }}</label>

                                                    <div class="col-md-6">
                                                        <input  type="hidden" name="cover_image" id="banner_image">
                                                        <input id="banner_image_drop" type="file" class="form-control @error('banner_image') is-invalid @enderror" value="{{ old('banner_image') }}"  name="banner_image_drop" accept="image/*">

                                                        @error('banner_image')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div id="uploaded_banner_image"></div>
                                                    </div>                                                
                                                </div>
                                                <div class="form-group row">
                                                    <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Property Images') }}</label>
                                                    <div class="col-md-6">
                                                        <input  type="hidden" name="images" id="images">
                                                        <input id="property_images_drop" type="file" class="form-control @error('images') is-invalid @enderror" value="{{ old('images') }}"  name="property_images_drop" multiple accept="image/*">

                                                        @error('images')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div id="uploaded_product_images"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row submit">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('create') }}
                                            </button>
                                        </div>
                                    </div> -->
                                    <div style="overflow:auto;">
                                        <div style="float:right;">
                                          <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                          <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                        </div>
                                    </div>
                                    <div style="text-align:center;margin-top:40px;">
                                        <span class="step"></span>
                                        <span class="step"></span>
                                        <span class="step"></span>
                                        <span class="step"></span>
                                        <span class="step"></span>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>
                    <!------------------>
            </div>
        </div>
    </div> 
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="add_unit_custom">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Create Building</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <input name="b_latitude" id="b_latitude" type="hidden" value="">
                            <input name="b_longitude" id="b_longitude" type="hidden" value="">
                            <div class="col-md-6">
                                <input id="b_autocomplete" type="text" class="form-control @error('b_address') is-invalid @enderror autocomplete" name="address" value="{{ old('b_address') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_name" class="col-md-4 col-form-label text-md-right">{{ __('Building  Name') }}</label>
                            <div class="col-md-6">
                                <input id="b_name" type="text" class="form-control" name="b_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_size" class="col-md-4 col-form-label text-md-right">{{ __('Size') }}</label>
                            <div class="col-md-6">
                                <input id="b_size" type="text" class="form-control" name="b_size" value="">
                            </div>
                        </div>
                                            
                    </div>
                    <div class="modal-footer">
                         <button type="button" id="b_create" class="btn btn-success">Create Building</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="permissionModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="add_unit_custom">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Permissions</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Unit Permissions') }}</label>
                            <div class="col-md-6" style="display: flex;">
                                <input type="radio" name="unit_permission" value="read"> Read
                                <input type="radio" name="unit_permission" value="write"> Write
                                <input type="radio" name="unit_permission" value="owner"> Owner
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Contract Permissions') }}</label>
                            <div class="col-md-6" style="display: flex;">
                                <input type="radio" name="contract_permission" value="read"> Read
                                <input type="radio" name="contract_permission" value="write"> Write
                                <input type="radio" name="contract_permission" value="owner"> Owner
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Meter Permissions') }}</label>
                            <div class="col-md-6" style="display: flex;">
                                <input type="radio" name="meter_permission" value="read"> Read
                                <input type="radio" name="meter_permission" value="write"> Write
                                <input type="radio" name="meter_permission" value="owner"> Owner
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" id="p_create" class="btn btn-success">Done Permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="add_unit_custom">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Create Property Manager</h3>
                    </div>
                    <div class="modal-body">
                    <input name="assign_to" id="assign_to" type="hidden" value="">
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <input name="u_latitude" id="u_latitude" type="hidden" value="">
                            <input name="u_longitude" id="u_longitude" type="hidden" value="">
                            <div class="col-md-6">
                                <input id="u_autocomplete" type="text" class="form-control @error('u_address') is-invalid @enderror autocomplete" name="address" value="{{ old('u_address') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="u_name" type="text" class="form-control" name="u_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="u_email" type="text" class="form-control" name="u_email" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" id="u_create" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="meterModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="create_meter">
                    @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Create Meter</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="m_name" class="col-md-4 col-form-label text-md-right">Meter Name</label>
                        <div class="col-md-6">
                            <input id="m_name" type="text" class="form-control" name="m_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_type" class="col-md-4 col-form-label text-md-right">Meter Type</label>
                        <div class="col-md-6">
                            <select id="meter_type" type="text" class="form-control" name="meter_type" value="">
                                <option value="electric_meter">Electricity Meter</option>
                                <option value="water_meter">Water Meter</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="unit_price" class="col-md-4 col-form-label text-md-right">Per Unit Price</label>
                        <div class="col-md-6">
                            <input id="unit_price" type="text" class="form-control" name="unit_price" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ean_number" class="col-md-4 col-form-label text-md-right">EAN Number</label>
                        <div class="col-md-6">
                            <input id="ean_number" type="text" class="form-control" name="ean_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_number" class="col-md-4 col-form-label text-md-right">Meter Number</label>
                        <div class="col-md-6">
                            <input id="meter_number" type="text" class="form-control" name="meter_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Add Reading</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_doc" class="col-md-4 col-form-label text-md-right">Upload Doc (pdf,xls)</label>
                        <div class="col-md-6">
                            <input id="meter_doc" type="file" class="form-control" name="meter_doc" value="" multiple="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_of_reading" class="col-md-4 col-form-label text-md-right">Date of Reading</label>
                        <div class="col-md-6">
                            <!-- <input id="date_of_reading" type="text" class="form-control" name="date_of_reading" value=""> -->
                            <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" name="date_of_reading" type="text" value="" readonly="">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reading_value" class="col-md-4 col-form-label text-md-right">Reading Value</label>
                        <div class="col-md-6">
                            <input id="reading_value" type="text" class="form-control" name="reading_value" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="button" id="m_create" class="btn btn-success">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<style type="text/css">
    .collapse-group span.btn {width: 100%; margin-bottom: 15px; text-align: left; background-color: #f28401; border-color: #f28401; } 
    .collapse-group .btn-info:hover ,.collapse-group .btn-info:focus {color: #0000008f; background-color: #fae4c4; border-color: #fae4c4; }
    span#add_new_meater {background: white; padding: 5px; border-radius: 4px; border: 2px solid #c1b4b4; cursor: pointer; }
    .custom-meater .meter-title {font-size: 20px; color: #ff8500; padding: 15px 0; }
    .custom-meater span.glyphicon.glyphicon-remove {position: relative; top: 50px; left: 95%; }
    .form-group-main {border: 2px solid #c1b4b4; padding: 15px; border-radius: 5px;     margin: 15px 0;}
    div#uploaded_banner_image {margin: 5px 0; }
    div#uploaded_product_images {margin: 5px 0; }
    div#uploaded_product_images img {margin-right: 5px; }
</style>
<script>
    jQuery(document).ready(function(){
        jQuery('#property_images_drop').change(function(){
            var file_data = $('#property_images_drop').prop('files');   
            //console.log(file_data);
            //var images = [];
            Object.keys(file_data).forEach(function(key) {
                var form_data = new FormData();                  
                form_data.append('file', file_data[key]);
                form_data.append('_token', '<?php echo csrf_token() ?>');
                //alert(form_data);
                jQuery.ajax({
                    url: "{{ url('/property-images') }}",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                        jQuery('#uploaded_product_images').append('<img src="{{ url("/images/property_images")}}/'+data.target_file+'" width="100px">');
                        var imagesData = jQuery('#images').val();
                        imagesData = imagesData+data.target_file+",";
                        jQuery('#images').val(imagesData);
                    }
                });
            });
        });
        jQuery('#banner_image_drop').change(function(){
            var file_data = $('#banner_image_drop').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('_token', '<?php echo csrf_token() ?>');
            //alert(form_data);
            jQuery.ajax({
                url: "{{ url('/property-images') }}",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    jQuery('#uploaded_banner_image').html('<img src="{{ url("/images/property_images")}}/'+data.target_file+'" width="100px">');
                    jQuery('#banner_image').val(data.target_file);
                }
            });
        });
    });
    jQuery('#create_propert_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            title:{
                required:true,
            },
            address:{
                required:true,
            },
            area:{
                required:true,
                number:true
            },
            description:{
                required:true,
            },
            banner_image_drop:{
                required:true,
            },
            property_images_drop:{
                required:true,
            },
        }      
    });
</script>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("create_propert_form").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
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
    $('#b_create').click(function(){
        var b_name = $('#b_name').val();
        var html = '<option value="'+b_name+'">'+b_name+'</option>'; 
        $('#building_id').append(html);
        $('#myModal').modal('hide');
        $('#assignModal').find('form').trigger('reset');
    });
    $('#p_create').click(function(){
        var p_name = $('#p_name').val();
        $('#permissionModal').modal('hide');
        // $('#permissionModal').find('form').trigger('reset');
    });
    $('#m_create').click(function(){
        var m_name = $('#m_name').val();
        var html = '<option value="'+m_name+'">'+m_name+'</option>'; 
        $('#meter_id').append(html);
        $('#meterModal').modal('hide');
        $('#meterModal').find('form').trigger('reset');
    });
    $('#u_create').click(function(){
        var u_name = $('#u_name').val();
        var assign_to = $('#assign_to').val();
        var html = '<option value="'+u_name+'">'+u_name+'</option>'; 
        if(assign_to == 3)
         {
            $('#property_id').append(html);
         }
         else if(assign_to == 4)
         {
            $('#property_description_experts_id').append(html);
         }
         else if(assign_to == 5)
         {
            $('#property_legal_advisor_id').append(html);
         }
         else if(assign_to == 6)
         {
            $('#property_visit_organizer_id').append(html);
         }
        $('#assignModal').modal('hide');
        $('#assignModal').find('form').trigger('reset');
    });
    $(document).on("click", ".open-assignModal", function () {
         var assign_to = $(this).data('id');
         $(".modal-body #assign_to").val( assign_to );
         if(assign_to == 3)
         {
            $('#assignModal .modal-title').text('Create Property Manager');
            var html = '<option value="'+b_name+'">'+b_name+'</option>'; 
            $('#building_id').append(html);
            $('#myModal').modal('hide');
         }
         else if(assign_to == 4)
         {
            $('#assignModal .modal-title').text('Create Property Description Experts');
         }
         else if(assign_to == 5)
         {
            $('#assignModal .modal-title').text('Create Legal Advisor');
         }
         else if(assign_to == 6)
         {
            $('#assignModal .modal-title').text('Create Visit Organizer');
         }
         // As pointed out in comments, 
         // it is unnecessary to have to manually call the modal.
         // $('#addBookDialog').modal('show');
    });
    $('#p_type').change(function(){
        var type = $('#p_type').val();
        if(type == 'unit'){
            $('#unit_select').addClass('tab');
        }
        else{
            $('#unit_select').removeClass('tab');
            $('#unit_select').css('display','none');
        }
    });
</script>
@endsection