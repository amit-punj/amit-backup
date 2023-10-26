@section('title','Create Contract')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Create Contract'])
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
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 16.66%;">
                                Step 1 of 6
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
                                        <div class="nav-arrow"></div>
                                    </li>
                                    <li class="disabled step6">
                                        <div class="nav-wedge"></div>
                                        <a class="hidden-xs" href="#step6" data-toggle="tab" data-step="6">6. Make Payment</a>
                                        <a class="visible-xs" href="#step6" data-toggle="tab" data-step="6">6.</a>
                                        <!-- <div class="nav-arrow"></div> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <form autocomplete="off" method="POST" action="{{ url('/create-contract') }}" enctype="multipart/form-data" id="create_contract_form">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="step1">
                                    <h3>General Info</h3>
                                    <div class="well">
                                        <div class="form-group row">
                                            <label for="Unit_id" class="col-md-4 col-form-label text-md-right required">{{ __('Select Unit') }}</label>
                                            <div class="col-md-6">
                                                <select name="Unit_id" id="Unit_id" class="form-control">
                                                    <option value="">Select Unit</option>
                                                    @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}" data="{{ $unit->property_description_experts_id }}">{{ $unit->unit_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('Unit_id')
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
                                            <label for="contract_type" class="col-md-4 col-form-label text-md-right required">{{ __('Contract Type') }}</label>
                                            <div class="col-md-6">
                                                <select name="contract_type" id="contract_type" class="form-control">
                                                    <option value="">Select Contract</option>
                                                    <option value="commercial">Commercial</option>
                                                    <option value="residential">Residential</option>
                                                    <option value="industrial">Industrial</option>
                                                </select>
                                                @error('contract_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="contract_communication_language" class="col-md-4 col-form-label text-md-right required">{{ __('Communication language') }}</label>
                                            <div class="col-md-6">
                                                <select name="contract_communication_language" id="contract_communication_language" class="form-control">
                                                    <option value="">Select Languange</option>
                                                    <option value="english">English</option>
                                                    <option value="french">French</option>
                                                </select>
                                                @error('contract_communication_language')
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
                                            <label for="tenant_id" class="col-md-4 col-form-label text-md-right required">{{ __('Select Tenant') }}</label>
                                            <div class="col-md-6">
                                                <select name="tenant_id" id="tenant_id" class="form-control">
                                                    <option value="">Select Tenant</option>
                                                    @foreach($tenants as $tenant)
                                                    <option value="{{ $tenant->id }}">{{ $tenant->name." ".$tenant->last_name }}</option>
                                                    @endforeach
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
                                            <label for="description_expert_id" class="col-md-4 col-form-label text-md-right required">{{ __('Select Place Description Expert') }}</label>
                                            <div class="col-md-6">
                                                <select id="description_expert_id" class="form-control @error('u_type') is-invalid @enderror" name="description_expert_id" value="" required>
                                                    <option value="">Select Expert</option>
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
                                            <label for="signature_date" class="col-md-4 col-form-label text-md-right required">{{ __('Signature Date') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" size="16" placeholder="2019/10/07" id="signature_date" name="signature_date" type="text" value="" readonly="">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="start_date" class="col-md-4 col-form-label text-md-right required">{{ __('Start Date') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" id="start_date" size="16" placeholder="2019/10/07" name="start_date" type="text" value="" readonly="">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="end_date" class="col-md-4 col-form-label text-md-right required">{{ __('End Date') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" size="16" id="end_date" placeholder="2020/10/07" name="end_date" type="text" value="" readonly="">
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
                                            <label for="rent" class="col-md-4 col-form-label text-md-right required">{{ __('Rent') }}</label>
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
                                            <label for="cost_provision" class="col-md-4 col-form-label text-md-right required">{{ __('Cost Provision') }}</label>
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
                                            <label for="deposit" class="col-md-4 col-form-label text-md-right required">{{ __('Fixed Charges') }}</label>
                                            <div class="col-md-6">
                                                <input id="fixed_charges" type="text" class="form-control @error('fixed_charges') is-invalid @enderror" name="fixed_charges" value=""  >
                                                @error('fixed_charges')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="property_tax" class="col-md-4 col-form-label text-md-right required">{{ __('Property Tax') }}</label>
                                            <div class="col-md-6">
                                                <input id="property_tax" type="text" class="form-control @error('property_tax') is-invalid @enderror" name="property_tax" value=""  >
                                                @error('property_tax')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deposit_amount" class="col-md-4 col-form-label text-md-right required">{{ __('Deposit Amount') }}</label>
                                            <div class="col-md-6">
                                                <input id="deposit_amount" type="text" class="form-control @error('deposit_amount') is-invalid @enderror" name="deposit_amount" value=""  >
                                                @error('deposit_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="contract_time" class="col-md-4 col-form-label text-md-right required">{{ __('Payment Day') }}</label>
                                            <div class="col-md-6">
                                                <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                                    <input class="form-control" size="16" placeholder="2019/10/07" id="contract_time" name="contract_time" type="text" value="" readonly="">
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
                                        <!-- <div class="form-group row">
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
                                        </div> -->
                                        <div class="btn-group btn-group-justified" role="group" aria-label="">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                            
                                              </div>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                <button class="btn btn-primary btn-lg btn-block next" step="5" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step6">
                                    <h3>Place Description Expert</h3>
                                    <div class="well">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="make_payment">
                                                    <input id="payment_method" name="payment_method" type="hidden" value="">
                                                    <button type="submit" class="btn btn-primary payment_method_button" data="paypal">
                                                        Pay <span class="total_amount">00</span> with <img src="{{ url('images/Paypal-button.png') }}">
                                                    </button> or
                                                    <button type="submit" class="btn btn-primary payment_method_button" data="bank">
                                                        Pay <span class="total_amount">00</span> using <img src="{{ url('images/bank-transfer.png') }}">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="btn-group btn-group-justified" role="group" aria-label="">
                                                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                        <button class="btn btn-default back" type="button">Back</button>
                                                    </div>
                                                    <!-- <div class="btn-group btn-group-lg" role="group" aria-label="">
                                                        <button class="btn btn-success" id="submit" type="submit">Create Contract</button>
                                                    </div> -->
                                                </div>
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
                            <input id="email" type="text" class="form-control" name="email" value="" data="false">
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
                            <button type="submit" id="create_tenant_button"class="btn btn-success">Create Tenant</button>
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
                            <input id="company_email" type="text" class="form-control" name="company_email" value="" data="false">
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
                            <input id="c_email" type="text" class="form-control" name="email" value="">
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
                            <button type="submit" id="create_company_button" class="btn btn-success">Create Company</button>
                        </div>
                    </div>
                </form>

            </div>          
        </div>
    </div>
</div>
<script type="text/javascript">
    var date = new Date();
    var date_format = '{!! \Helper::DateTimeFormat() !!}';
    // jQuery('.form_datetime').datetimepicker({
    //         format: date_format,
    //         weekStart: 1,
    //         todayBtn:  1,
    //         autoclose: 1,
    //         todayHighlight: 1,
    //         startView: 2,
    //         forceParse: 0,
    //         showMeridian: 1,
    //         startDate: new Date()
    // });
    var date_format = 'yy/m/d';
    $('#signature_date, #contract_time').datepicker({
        dateFormat: date_format, 
        minDate: date,
        changeMonth: true,
        changeYear: true,
    });
    $('#start_date').datepicker({
        dateFormat: date_format, 
        minDate: date,
        changeMonth: true,
        changeYear: true,
        onSelect: function(date){
            var selectedDate = new Date(date);
            var msecsInADay = 86400000;
            var endDate = new Date(selectedDate.getTime() + msecsInADay);
            $("#end_date").datepicker( "option", "minDate", endDate );
        }
    });
    $('#end_date').datepicker({
        dateFormat: date_format, 
        minDate: date,
        changeMonth: true,
        changeYear: true,
        onSelect: function(date){
            var selectedDate = new Date(date);
            var msecsInADay = 86400000;
            var startDate = new Date(selectedDate.getTime() - msecsInADay);
            $("#start_date").datepicker( "option", "maxDate", startDate );
        }
    });
    jQuery('#create_contract_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            Unit_id:{
                required:true,
            },
            contract_type:{
                required:true,
            },
            contract_communication_language:{
                required:true,
            },
            tenant_id:{
                required:true,
            },
            description_expert_id:{
                required:true,
            },
            signature_date:{
                required:true,
            }, 
            start_date:{
                required:true,
            },
            end_date:{
                required:true,
            },
            rent:{
                required:true,
                number:true,
            },
            cost_provision:{
                required:true,
                number:true,
            },
            fixed_charges:{
                required:true,
                number:true,
            },
            property_tax:{
                required:true,
                number:true,
            },
            deposit_amount:{
                required:true,
                number:true,
            },
            contract_time:{
                required:true,
            }
        }      
    });

    jQuery('#create_tenant_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            email:{
                required:true,
                email:true,
            },
            phone_number:{
                required:true,
                number:true,
            },
            address:{
                required:true,
            },
        }      
    });

    jQuery('#create_company_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            company_name:{
                required:true,
            },
            company_phone_no:{
                required:true,
                 number:true,
            },
            company_email:{
                required:true,
                email:true,
            },
            name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            email:{
                required:true,
                email:true,
            },
            phone_number:{
                required:true,
                number:true,
            },
            address:{
                required:true,
            },
        }      
    });

    jQuery('.payment_method_button').click(function(){
        jQuery('#payment_method').val(jQuery(this).attr('data'));
    });
    jQuery('#email').blur(function(){
        jQuery('#email_error').remove();
        jQuery.ajax({
            url: "{{ url('/verify-user-email') }}",
            type: "POST",
            data: {'_token':'<?php echo csrf_token() ?>','email':$('#email').val()},
            success: function(data){
                if(data.status == 'true'){
                    jQuery('#email').after("<span id='email_error'>"+data.message+"</span>");
                    jQuery('#email').attr('data','false');
                } else {
                    jQuery('#email').attr('data','true');
                    jQuery('#create_tenant_button').attr("disabled", false);
                }
            }
        });
    });
    jQuery('#c_email').blur(function(){
        jQuery('#email_error_c').remove();
        jQuery.ajax({
            url: "{{ url('/verify-user-email') }}",
            type: "POST",
            data: {'_token':'<?php echo csrf_token() ?>','email':$('#c_email').val()},
            success: function(data){
                if(data.status == 'true'){
                    jQuery('#c_email').after("<span id='email_error_c'>"+data.message+"</span>");

                    jQuery('#c_email').attr('data','false');
                } else {
                    jQuery('#c_email').attr('data','true');
                    jQuery('#create_company_button').attr("disabled", false);
                }
            }
        });
    });
    jQuery('#create_tenant_form').submit(function(e){
        e.preventDefault();
        if(jQuery('#email').attr('data') == 'false'){
            return false;
        } else {
            jQuery('#create_tenant_button').attr("disabled", true);
            jQuery.ajax({
                url: "{{ url('/create-contract-user') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','data':jQuery( "#create_tenant_form" ).serialize()},
                success: function(data){
                    if(data.status == 'true'){
                        jQuery('#tenant_id').append('<option selected value="'+data.id+'">'+data.name+'</option>');
                        jQuery('#create_tenant_form input').val('');
                        jQuery('.close').trigger('click');
                    } else {
                        jQuery('#create_tenant_button').after("<span id='email_error'>Allready Exist!</span>");
                    }
                }
            });
        }
    });
    jQuery('#create_company_form').submit(function(e){
        e.preventDefault();
        if(jQuery('#c_email').attr('data') == 'false'){
            return false;
        } else {
            jQuery('#create_company_button').attr("disabled", true);
            jQuery.ajax({
                url: "{{ url('/create-contract-company') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','data':jQuery( "#create_company_form" ).serialize()},
                success: function(data){
                    if(data.status == 'true'){
                        jQuery('#tenant_id').append('<option selected value="'+data.id+'">'+data.name+'</option>');
                        jQuery('#create_company_form input').val('');
                        jQuery('.close').trigger('click');
                    } else {
                        jQuery('#create_company_button').after("<span id='email_error'>Allready Exist!</span>");
                    }
                }
            });
        }
    });
    // $(document).on("click", ".open-assignModal", function () {
    //      var assign_to = $(this).data('id');
    //      $(".modal-body #assign_to").val( assign_to );
    //      if(assign_to == 3)
    //      {
    //         $('#assignModal .modal-title').text('Create Property Manager');
    //         var html = '<option value="'+b_name+'">'+b_name+'</option>'; 
    //         $('#building_id').append(html);
    //         $('#myModal').modal('hide');
    //      }
    //      else if(assign_to == 4)
    //      {
    //         $('#assignModal .modal-title').text('Create Property Description Experts');
    //      }
    //      else if(assign_to == 5)
    //      {
    //         $('#assignModal .modal-title').text('Create Legal Advisor');
    //      }
    //      else if(assign_to == 6)
    //      {
    //         $('#assignModal .modal-title').text('Create Visit Organizer');
    //      }
    // });
    $('.next').click(function(){

        if($(this).attr('step') == 1){
            var validator = $( "#create_contract_form" ).validate();
            validator.element( "#Unit_id" );
            validator.element( "#contract_type" );
            validator.element( "#contract_communication_language" );
            if(validator.element( "#Unit_id" ) && validator.element( "#contract_type" ) && validator.element( "#contract_communication_language" ) ) {
                jQuery.ajax({
                    url: "{{ url('/get-contract-expert') }}",
                    type: "POST",
                    data: { '_token':'<?php echo csrf_token() ?>',
                            'expert_id':jQuery( "#Unit_id" ).find(':selected').attr('data'),
                            'unit_id':jQuery( "#Unit_id" ).find(':selected').val()
                        },
                    success: function(data){
                        jQuery('#description_expert_id').append('<option selected value="'+data.id+'">'+data.name+'</option>');
                        jQuery('#rent').val(data.rent);
                        jQuery('#cost_provision').val(data.cost_provision);
                        jQuery('#deposit_amount').val(data.deposit_amount);
                    }
                });
                jQuery('ul.nav.nav-pills.nav-wizard li.step2').removeClass('disabled');
            } else {
                return false;
            }
        }
        if($(this).attr('step') == 2){
            var validator = $( "#create_contract_form" ).validate();
            validator.element( "#tenant_id" );
            if( validator.element( "#tenant_id" ) ) {
                jQuery('ul.nav.nav-pills.nav-wizard li.step2').removeClass('disabled');
            } else {
                return false;
            }
        }

        if($(this).attr('step') == 3){
            var validator = $( "#create_contract_form" ).validate();
            validator.element( "#description_expert_id" );
            if( validator.element( "#description_expert_id" ) ) {
                jQuery('ul.nav.nav-pills.nav-wizard li.step3').removeClass('disabled');
            } else {
                return false;
            }
        }

        if($(this).attr('step') == 4){
            var validator = $( "#create_contract_form" ).validate();
            validator.element( "#signature_date" );
            validator.element( "#start_date" );
            validator.element( "#end_date" );
            if( validator.element( "#signature_date" ) && validator.element( "#start_date" ) && validator.element( "#start_date" )) {
                jQuery('ul.nav.nav-pills.nav-wizard li.step4').removeClass('disabled');
            } else {
                return false;
            }
        }
        if($(this).attr('step') == 5){
            var validator = $( "#create_contract_form" ).validate();
            validator.element( "#rent" );
            validator.element( "#cost_provision" );
            validator.element( "#fixed_charges" );
            validator.element( "#property_tax" );
            validator.element( "#deposit_amount" );
            validator.element( "#contract_time" );
            if( validator.element( "#rent" ) && validator.element( "#cost_provision" ) && validator.element( "#fixed_charges" ) && validator.element( "#property_tax" ) && validator.element( "#deposit_amount" ) && validator.element( "#contract_time" )) {
                var currency_symbal = '{{ App\Helpers\Helper::CURRENCYSYMBAL }}';
                var total_amount = parseInt(jQuery('#rent').val()) + parseInt(jQuery('#cost_provision').val()) + parseInt(jQuery('#fixed_charges').val()) + parseInt(jQuery('#property_tax').val()) + parseInt(jQuery('#deposit_amount').val());
                jQuery('.total_amount').text( currency_symbal+total_amount );
                jQuery('ul.nav.nav-pills.nav-wizard li.step5').removeClass('disabled');
            } else {
                return false;
            }
        }

        var nextId = $(this).parents('.tab-pane').next().attr("id");
        $('[href="#' + nextId + '"]').tab('show');
        return false;
    });
    $('.back').click(function(){
        var prevId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href="#'+prevId+'"]').tab('show');
        return false;
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var step = $(e.target).data('step');
      var percent = (parseInt(step) / 6) * 100;
      $('.progress-bar').css({width: percent + '%'});
      $('.progress-bar').text("Step " + step + " of 6");
    });
    $('.first').click(function(){
      $('#myWizard a:first').tab('show')
    });
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
    label.required::after {content: '*'; color: red; padding: 5px; }
    .make_payment img {width: 100px; height: 35px; }
    .make_payment {padding: 20px 0; }
    span#email_error, span#email_error_c {color: red; }
    ul.nav.nav-pills.nav-justified li {background-color: #e49a43 !important; }
    ul.nav.nav-pills.nav-justified li a {color: #fff; }
    ul.nav.nav-pills.nav-justified li a:hover {background-color: #e49a43 !important; }
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {color: #fff; background-color: #f48400 !important; }
</style>
@endsection