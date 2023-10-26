@section('title','Create Contract')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Create Contract'])
<style type="text/css">
    .c309 {
        top: -3px;
        left: -10px;
        width: 4%;
        cursor: inherit;
        height: 100%;
        margin: 0;
        /* opacity: 0; */
        padding: 0;
        position: absolute; 
    }
</style>
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
                    <div class="div" id="myWizard">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 14.30%;">
                                Step 1 of 5
                            </div>
                        </div>
                        <div class="navbar">
                            <div class="navbar-inner">
                                <ul class="nav nav-pills nav-wizard">
                                    <li class="active step1">
                                        <a class="hidden-xs" href="#step1" data-toggle="tab" data-step="1">1. General Info</a>
                                        <a class="visible-xs" href="#step1" data-toggle="tab" data-step="1">1.</a>
                                        <div class="nav-arrow"></div>
                                    </li>
                                    <li class="disabled step2">
                                        <div class="nav-wedge"></div>
                                        <a class="hidden-xs" href="#step2" data-toggle="tab" data-step="2">2. Tenants</a>
                                        <a class="visible-xs" href="#step2" data-toggle="tab" data-step="2">2.</a>
                                        <div class="nav-arrow"></div>
                                    </li>
                                    <li class="disabled step3">
                                        <div class="nav-wedge"></div>
                                        <a class="hidden-xs" href="#step3" data-toggle="tab" data-step="3">3. Place Description Expert</a>
                                        <a class="visible-xs" href="#step3" data-toggle="tab" data-step="3">3.</a>
                                        <div class="nav-arrow"></div>
                                    </li>
                                    <li class="disabled step4">
                                        <div class="nav-wedge"></div>
                                        <a class="hidden-xs" href="#step4" data-toggle="tab" data-step="4">4. Key Dates</a>
                                        <a class="visible-xs" href="#step4" data-toggle="tab" data-step="4">4.</a>
                                        <div class="nav-arrow"></div>
                                    </li>
                                    <li class="disabled step5">
                                        <div class="nav-wedge"></div>
                                        <a class="hidden-xs" href="#step5" data-toggle="tab" data-step="5">5. Financial Informations</a>
                                        <a class="visible-xs" href="#step5" data-toggle="tab" data-step="5">5.</a>
                                        <!-- <div class="nav-arrow"></div> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <form autocomplete="off" method="POST" action="{{ url('/create-property') }}" enctype="multipart/form-data" id="create_propert_form">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="step1">
                                    <h3>General Info</h3>
                                    <div class="well">
                                        <div class="form-group row">
                                            <label for="p_type" class="col-md-4 col-form-label text-md-right">{{ __('Select Unit *') }}</label>
                                            <div class="col-md-6">
                                                <select name="p_type" id="p_type" class="form-control">
                                                    <option value="">Select Unit</option>
                                                    <option value="unit">Unit1</option>
                                                    <option value="building">Unit2</option>
                                                </select>
                                                @error('p_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="add-unit-main">
                                                    <a class="btn btn-success" target="_blank" href="{{ url('/create-property')}}">Create Unit <span class="glyphicon glyphicon-plus"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="p_type" class="col-md-4 col-form-label text-md-right">{{ __('Contract Type *') }}</label>
                                            <div class="col-md-6">
                                                <select name="p_type" id="p_type" class="form-control">
                                                    <option value="">Select Contract</option>
                                                    <option value="unit">Commercial</option>
                                                    <option value="building">Residential</option>
                                                    <option value="building">Industrial</option>
                                                </select>
                                                @error('p_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="p_type" class="col-md-4 col-form-label text-md-right">{{ __('Communication language *') }}</label>
                                            <div class="col-md-6">
                                                <select name="p_type" id="p_type" class="form-control">
                                                    <option value="">Select Languange</option>
                                                    <option value="unit">English</option>
                                                    <option value="building">French</option>
                                                </select>
                                                @error('p_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> 
                                        <div class="btn-group btn-group-justified" role="group" aria-label="">
                                              <div class="btn-group btn-group-lg" role="group" aria-label="">
                                              </div>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-primary btn-lg btn-block next" step="1" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step2">
                                    <h3>Tenant</h3>
                                    <div class="well">  
                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Select Tenant *') }}</label>
                                            <div class="col-md-6">
                                                <select name="p_type" id="p_type" class="form-control">
                                                    <option value="">Select Tenant</option>
                                                    <option value="unit">Tenent</option>
                                                    <option value="building">Tenent 2</option>
                                                </select>
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="add-unit-main">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModel">Create Tenant <span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-justified" role="group" aria-label="">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                            </div>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-primary btn-lg btn-block next" step="2" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step3">
                                    <h3>Place Description Expert</h3>
                                    <div class="well">
                                        <div class="form-group row">
                                            <label for="u_type" class="col-md-4 col-form-label text-md-right">{{ __('Select Place Description Expert *') }}</label>
                                            <div class="col-md-6">
                                                <select id="u_type" class="form-control @error('u_type') is-invalid @enderror" name="u_type" value="" required>
                                                    <option value="residential">John</option>
                                                    <option value="commercial">Bella</option>
                                                    <option value="industrial">Legal Advisor</option>
                                                </select>
                                                @error('type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> 
                                        <hr>
                                        <div class="btn-group btn-group-justified" role="group" aria-label="">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                            
                                              </div>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-primary btn-lg btn-block next" step="3" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step4">
                                    <h3>Key Dates</h3>
                                    <div class="well">
                                        <div class="form-group row">
                                            <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Signature Date') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" size="16" name="time" type="text" value="" readonly="">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" size="16" name="time" type="text" value="" readonly="">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="max_age" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" size="16" name="time" type="text" value="" readonly="">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-justified" role="group" aria-label="">
                                              <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                            
                                              </div>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-primary btn-lg btn-block next" step="4" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step5">
                                    <h3>Financial Informations</h3>
                                    <div class="well">
                                        <div class="form-group row">
                                            <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rent *') }}</label>
                                            <div class="col-md-6">
                                                <input id="rent" type="text" class="form-control @error('rent') is-invalid @enderror" name="rent" value=""  >

                                                @error('rent')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cost_provision" class="col-md-4 col-form-label text-md-right">{{ __('Cost Provision') }}</label>
                                            <div class="col-md-6">
                                                <input id="cost_provision" type="text" class="form-control @error('cost_provision') is-invalid @enderror" name="cost_provision" value=""  >

                                                @error('cost_provision')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Fixed Charges') }}</label>
                                            <div class="col-md-6">
                                                <input id="deposit" type="text" class="form-control @error('deposit') is-invalid @enderror" name="deposit" value=""  >
                                                @error('deposit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Property Tax') }}</label>
                                            <div class="col-md-6">
                                                <input id="deposit" type="text" class="form-control @error('deposit') is-invalid @enderror" name="deposit" value=""  >
                                                @error('deposit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Deposit Amount') }}</label>
                                            <div class="col-md-6">
                                                <input id="deposit" type="text" class="form-control @error('deposit') is-invalid @enderror" name="deposit" value=""  >
                                                @error('deposit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Payment Day') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" size="16" name="time" type="text" value="" readonly="">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                                @error('deposit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="bank_account">
                                                    <option>Paypal</option>
                                                    <option>Bank Transfer</option>
                                                </select>
                                                @error('deposit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-justified" role="group" aria-label="">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-default back" type="button">Back</button>
                                            </div>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-success" id="submit" type="submit">Create Contract</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>        
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>  
<div class="modal fade" id="updateModel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h3 class="modal-title">Create Tenant</h3> -->
                <ul class="nav nav-pills nav-justified">
                    <li id="create_tenant" class="active"><a href="#">Create Tenant</a></li>
                    <li id="create_company" class=""><a href="#">Create Company</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="create_tenant_form">
                    @csrf
                    <input id="update_unit_id" type="hidden" class="form-control" name="unit_id" value="">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                        <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control" name="last_name" value="">
                        </div>
                    </div>
                    <div class="form-group row gender_class">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                        <div class="col-md-6">
                            Male<input id="gender" type="radio" class="form-control" name="gender" value="male" checked>
                            Female<input id="gender1" type="radio" class="form-control" name="gender" value="female">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>
                        <div class="col-md-6">
                            <input id="phone_number" type="text" class="form-control" name="phone_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Create Tenant</button>
                        </div>
                    </div>
                </form>


                <form method="post" action="" id="create_company_form" style="display: none;">
                    @csrf
                    <input id="update_unit_id" type="hidden" class="form-control" name="unit_id" value="">
                    <div class="form-group row">
                        <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Legal Name') }}</label>
                        <div class="col-md-6">
                            <input id="company_name" type="text" class="form-control" name="company_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>
                        <div class="col-md-6">
                            <input id="company_phone_no" type="text" class="form-control" name="company_phone_no" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_email" class="col-md-4 col-form-label text-md-right">{{ __('Company Email') }}</label>
                        <div class="col-md-6">
                            <input id="company_email" type="text" class="form-control" name="company_email" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_email" class="col-md-12 col-form-label text-md-right">{{ __('Name and details of representative') }}</label>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                        <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control" name="last_name" value="">
                        </div>
                    </div>
                    <div class="form-group row gender_class">
                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                        <div class="col-md-6">
                            Male<input id="gender" type="radio" class="form-control" name="gender" value="male" checked>
                            Female<input id="gender1" type="radio" class="form-control" name="gender" value="female">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>
                        <div class="col-md-6">
                            <input id="phone_number" type="text" class="form-control" name="phone_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Create Company</button>
                        </div>
                    </div>
                </form>

            </div>          
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('#add_Vendor_form').submit(function(event){
            event.preventDefault();
            if(jQuery('#add_Vendor_form').valid()) {
                var data = JSON.stringify(jQuery('#add_Vendor_form').serializeArray());
                var data1 = jQuery('#add_Vendor_form').serializeArray();
                jQuery('#add_vendors').hide();
                jQuery('#add_vendors_data').show();
                var htmldata = jQuery('#add_vendors_data').html();
                jQuery('#add_vendors_data').html(htmldata+'<span>'+data1[2].value+' : '+data1[3].value+'</span>');
                //console.log(data);
                var old_data = jQuery('#vandor_data').val();
                jQuery('#vandor_data').val(old_data.concat(data+','));
                console.log(jQuery('#vandor_data').val());
                jQuery('#add_Vendor_form').each(function(){
                    this.reset();
                });
                jQuery('form#add_Vendor_form .close').trigger('click');
            }
        });
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
        event.preventDefault();
        if(jQuery('#add_custom_building').valid()) {
            var data = JSON.stringify(jQuery('#add_custom_building').serializeArray());
            var data1 = jQuery('#add_custom_building').serializeArray();
            jQuery('select#building_id').hide();
            jQuery('#add_new_building').show();
            //var htmldata = jQuery('#add_vendors_data').html();
            jQuery('#add_new_building').html('<span>Building Name : '+data1[4].value+'</span>');
            //console.log(data);
            //var old_data = jQuery('#vandor_data').val();
            jQuery('#new_building').val(data);
            console.log(jQuery('#new_building').val());
            jQuery('#add_custom_building').each(function(){
                this.reset();
            });
            jQuery('form#add_custom_building .close').trigger('click');
        }
    });
    $('#p_create').click(function(){
        var p_name = $('#p_name').val();
        $('#permissionModal').modal('hide');
        // $('#permissionModal').find('form').trigger('reset');
    });
    $('#m_create').click(function(){
        event.preventDefault();
        if(jQuery('#create_meter').valid()) {
            var data = JSON.stringify(jQuery('#create_meter').serializeArray());
            var data1 = jQuery('#create_meter').serializeArray();
            jQuery('select#meter_id').hide();
            jQuery('#add_new_meter').show();
            var htmldata = jQuery('#add_new_meter').html();
            jQuery('#add_new_meter').html(htmldata+'<span>Name : '+data1[1].value+'</span>');
            //console.log(data);
            var old_data = jQuery('#new_meter').val();
            jQuery('#new_meter').val(old_data.concat(data+','));
            console.log(jQuery('#new_building').val());
            jQuery('#create_meter').each(function(){
                this.reset();
            });
            jQuery('form#create_meter .close').trigger('click');
        }
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
    });
    $('#p_type').change(function(){
        var type = $('#p_type').val();
        if(type == 'unit'){
            $('[href="#step3"]').css('pointerEvents',"auto");
            $('[href="#step4"]').css('pointerEvents',"auto");
            // $('[href="#step3"]').css('cursor',"pointer");
        }
        else{
            $('[href="#step3"]').css('pointerEvents',"none");
            $('[href="#step4"]').css('pointerEvents',"none");
            // $('[href="#step3"]').css('cursor',"default");
        }
    });
</script>
<script type="text/javascript">
    $('.next').click(function(){

        if($(this).attr('step') == 2){
            jQuery('ul.nav.nav-pills.nav-wizard li.step2').removeClass('disabled');
        }

        if($(this).attr('step') == 3){
            jQuery('ul.nav.nav-pills.nav-wizard li.step3').removeClass('disabled');
        }

        if($(this).attr('step') == 4){
            jQuery('ul.nav.nav-pills.nav-wizard li.step4').removeClass('disabled');
        }
        if($(this).attr('step') == 5){
            jQuery('ul.nav.nav-pills.nav-wizard li.step5').removeClass('disabled');
        }

        if($(this).attr('step') == 6){
            jQuery('ul.nav.nav-pills.nav-wizard li.step6').removeClass('disabled');
        }

        // var type = $('#p_type').val();
        // if(type == 'unit'){
        //     var nextId = $(this).parents('.tab-pane').next().attr("id");
        // }
        // else{
        //     var id = $(this).parents('.tab-pane').attr("id");
        //     if(id == 'step2')
        //     {     
        //         var nextId = $(this).parents('.tab-pane').next().next().next().attr("id");  
        //     }
        //     else
        //     {
        //     }
        // }
        var nextId = $(this).parents('.tab-pane').next().attr("id");
        $('[href="#' + nextId + '"]').tab('show');
        return false;
    });
    $('.back').click(function(){
        var type = $('#p_type').val();
        if(type == 'unit'){
            var prevId = $(this).parents('.tab-pane').prev().attr("id");
        }
        else{
            var id = $(this).parents('.tab-pane').attr("id");
            if(id == 'step5')
            {     
                var prevId = $(this).parents('.tab-pane').prev().prev().prev().attr("id");
            }
            else
            {
                var prevId = $(this).parents('.tab-pane').prev().attr("id");
            }
        }
        $('[href="#'+prevId+'"]').tab('show');
        return false;
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      //update progress
      var step = $(e.target).data('step');
      var percent = (parseInt(step) / 5) * 100;
      $('.progress-bar').css({width: percent + '%'});
      $('.progress-bar').text("Step " + step + " of 5");
      //e.relatedTarget // previous tab
    });
    $('.first').click(function(){
      $('#myWizard a:first').tab('show')
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.nav.nav-pills.nav-justified li').click(function(){
            jQuery('ul.nav.nav-pills.nav-justified li').removeClass('active');
            jQuery(this).addClass('active');
        });
        jQuery('#create_tenant').click(function(){ 
            jQuery('#create_tenant_form').show();
            jQuery('#create_company_form').hide();
        });
        jQuery('#create_company').click(function(){ 
             jQuery('#create_company_form').show();
            jQuery('#create_tenant_form').hide();
        });
    });
</script>
<style type="text/css">
    div#add_vendors span ,div#add_vendors_data span,div#add_new_building span, div#add_new_meter span{border: 1px solid #ccc; padding: 5px; margin: 0 5px; }
    span.term_error_message {display: block; color: red; }
    li.disabled {pointer-events: none; } 
    .gender_class input {width: 8%; display: inline-block; height: 17px; border: 0; box-shadow: none; margin: 0 10px; }
</style>
@endsection