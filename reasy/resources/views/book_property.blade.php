@section('title','Book Property') 
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Book Property'])
    <div class="container main">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        <div class="row">
            <div  class="col-sm-12">
                <div class="div" id="myWizard">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 20.00%;">
                            Step 1 of 4
                        </div>
                    </div>
                    <?php $step = (isset($booking_details->step)) ? ++$booking_details->step : 1; 
                          $step = ($step == 5) ? 4 : $step;
                    ?>
                    <div class="navbar">
                        <div class="navbar-inner">
                            <ul class="nav nav-pills nav-wizard">
                                <li class="step1 {{ ( $step == 1 )? 'active $step' : 'disabled'}}">
                                    <a class="hidden-xs" href="#step1" data-toggle="tab" data-step="1">1. Tenant Details</a>
                                    <a class="visible-xs" href="#step1" data-toggle="tab" data-step="1">1.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="step2 {{ ( $step == 2 )? 'active' : 'disabled'}}">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step2" data-toggle="tab" data-step="2">2. Guarantor Details</a>
                                    <a class="visible-xs" href="#step2" data-toggle="tab" data-step="2">2.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="step3 {{ ( $step == 3 )? 'active' : 'disabled'}}">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step3" data-toggle="tab" data-step="3">3. Contract Period</a>
                                    <a class="visible-xs" href="#step3" data-toggle="tab" data-step="3">3.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="step4 {{$step}} {{ ( $step == 4 )? 'active' : 'disabled'}}">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step4" data-toggle="tab" data-step="4">4. Payment Details</a>
                                    <a class="visible-xs" href="#step4" data-toggle="tab" data-step="4">4.</a>
                                    <!-- <div class="nav-arrow"></div> -->
                                </li>
                                <!-- <li class="step5 {{ ( $step == 5 )? 'active' : 'disabled'}}">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step5" data-toggle="tab" data-step="5">5. Make Payment</a>
                                    <a class="visible-xs" href="#step5" data-toggle="tab" data-step="5">5.</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ ( $step == 1 )? 'in active' : ''}}" id="step1">
                            <form autocomplete="off" method="POST" action="{{ url('book-property/'.$id) }}" enctype="multipart/form-data" id="create_propert_form">
                                @csrf
                                <h3>Tenant Details</h3>
                                <div class="well">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Tenant Type') }}</label>
                                        <div class="col-md-9">
                                            <div class="tenant_type_main">
                                                @if (Auth::guest()) 
                                                    Person <input id="tenant_type1" type="radio" class="form-control"  name="tenant_type" value="person" checked >
                                                    Company <input id="tenant_type2" type="radio" class="form-control"  name="tenant_type" value="company" >
                                                @else
                                                    Person <input id="tenant_type1" type="radio" class="form-control"  name="tenant_type" value="person" <?php echo $retVal = ($user->tenant_type == 'person') ? 'checked' : '' ; ?> > 
                                                    Company <input id="tenant_type2" type="radio" class="form-control"  name="tenant_type" value="company" <?php echo $retVal = ($user->tenant_type == 'company') ? 'checked' : '' ; ?> >
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($user->id) && $user->tenant_type == 'company')
                                        <div class="company_body">
                                    @else
                                        <div class="company_body" style="display: none">
                                    @endif
                                        <div class="form-group row">
                                            <label for="company_name" class="col-md-3 col-form-label text-md-right">{{ __('Company Name') }}</label>
                                            <div class="col-md-8">
                                                @if (Auth::guest())  
                                                    <input id="company_name" type="text" class="form-control"  name="company_name" value="" placeholder="Vision Vivante">
                                                @else
                                                    <input id="company_name" type="text" class="form-control"  name="company_name" value="{{ $user->company_name }}" placeholder="Vision Vivante">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="company_name" class="col-md-3 col-form-label text-md-right">{{ __('Company Address') }}</label>
                                            <input name="u_latitude" id="u_latitude" type="hidden" value="">
                                            <input name="u_longitude" id="u_longitude" type="hidden" value="">
                                            <div class="col-md-8">
                                                @if (Auth::guest())  
                                                    <input type="text" class="form-control" id="u_autocomplete" name="company_address" placeholder="Enter Company Address">
                                                @else
                                                    <input type="text" class="form-control" id="u_autocomplete" name="company_address" placeholder="Enter Company Address" value="{{ Auth::user()->company_address}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="company_email" class="col-md-3 col-form-label text-md-right">{{ __('Company Email') }}</label>
                                            <div class="col-md-8">
                                                @if (Auth::guest())  
                                                    <input id="company_email" type="email" class="form-control"  name="company_email" value="" placeholder="vision@gmail.com">
                                                @else
                                                    <input id="company_email" type="email" class="form-control"  name="company_email" value="{{ $user->company_email }}" placeholder="vision@gmail.com">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="company_phone" class="col-md-3 col-form-label text-md-right">{{ __('Company Phone Number') }}</label>
                                            <div class="col-md-8">
                                                @if (Auth::guest())  
                                                    <input id="company_phone" type="text" class="form-control"  name="company_phone" value="" placeholder="+917777777777">
                                                @else
                                                    <input id="company_phone" type="text" class="form-control"  name="company_phone" value="{{ $user->company_phone }}" placeholder="+917777777777">
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="vat_nr" class="col-md-3 col-form-label text-md-right">{{ __('Vat Number') }}</label>
                                            <div class="col-md-8">
                                                @if (Auth::guest())
                                                    <input id="vat_nr" type="text" class="form-control"  name="vat_nr" value="" placeholder="Vat No">
                                                @else
                                                    <input id="vat_nr" type="text" class="form-control"  name="vat_nr" value="{{ $user->vat_nr }}" placeholder="Vat No">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                        <div class="col-md-6">
                                            @if (isset(Auth::user()->name) && Auth::user()->name != '')  
                                                <input id="name" type="text" class="form-control" readonly="" name="name" value="{{ Auth::user()->name}}" placeholder="jhon">
                                            @else
                                                <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
                                            @endif
                                            <span class="errors" id="error_name"></span>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#updateModel">Add Tenant <span class="glyphicon glyphicon-plus"></span></button>
                                        </div> -->
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Select multiple tenant') }}</label>
                                        <div class="col-md-6">
                                            <select class="form-control selected-tenant" name="selected_tenant[]" multiple="multiple" id="selected_tenant">
                                                <option value="">Select Tenant</option>
                                                @if(count($tenant_list) > 0)
                                                @foreach($tenant_list as $key => $value)
                                                    <option value="{{$value->id}}" {{ (in_array($value->id, $tenant_ids)) ? "selected" : ''}}>{{$value->name." ".$value->name." ( ".$value->email." ) " }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Want a Multiple Tenant') }}</label>
                                        <div class="col-md-9">
                                            <div class="tenant_type_main multiple_tenant_main">
                                                <input id="multiple_tenant_yes" type="radio" class="form-control"  name="multiple_tenant" value="yes"> Yes
                                                <input id="multiple_tenant_no" type="radio" class="form-control"  name="multiple_tenant" value="no" checked=""> No
                                            </div>
                                        </div>
                                    </div>
                                    <div id="multiple_tenant_div" style="display: none;">
                                        <div class="form-group row">
                                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Co-tenant 1') }}</label>
                                            <div class="col-md-6">
                                                <input id="co_tenant_1" type="text" class="form-control" name="co_tenant_1" value="" placeholder="Enter Co-tenant 1 email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Co-tenant 2') }}</label>
                                            <div class="col-md-6">
                                                <input id="co_tenant_2" type="text" class="form-control" name="co_tenant_2" value="" placeholder="Enter Co-tenant 2 email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Co-tenant 3') }}</label>
                                            <div class="col-md-6">
                                                <input id="co_tenant_3" type="text" class="form-control" name="co_tenant_3" value="" placeholder="Enter Co-tenant 3 email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                        <div class="col-md-6">
                                            @if (Auth::guest())  
                                                <input id="email" type="email" class="form-control" name="email" value="" placeholder="jhon@gmail.com" status="false">
                                            @else
                                                <input id="email" type="email" class="form-control" <?php echo $readonly = ($VerifyEmail == 1) ? 'readonly' : '' ; ?> name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
                                            @endif
                                            <span id="email_varification_message"></span>
                                            <span class="errors" id="error_email"></span>
                                        @error('email')
                                                <span class="invalid-feedback"  role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <span id="email_confirmation_message" style="color: green;"><?php echo $readonly = ($VerifyEmail == 1) ? 'Verified!' : '' ; ?></span>
                                        </div>
                                    </div> 
                                    <div class="form-group row" id="Email_confirmation" style="display: none;">
                                        <label for="email_token" class="col-md-3 col-form-label text-md-right">{{ __('Enter Token') }}</label>
                                        <div class="col-md-6">
                                            <input id="email_token" type="text" class="form-control"  name="email_token" value="" status="false">
                                        </div>
                                        <div class="col-md-3">
                                            <span id="email_token_confirmation_message"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                        @if (Auth::guest())  
                                            <div class="col-md-4">
                                                <input id="phone_number" type="text" class="form-control"  name="phone_number" value="" placeholder="+911234567890" status="false">
                                                <span id="phone_number_error"></span>
                                                <span class="errors" id="error_phone_number"></span>
                                                @error('phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <span id="send_otp" class="">Send Verification Code</span>
                                            </div>
                                            <div class="col-md-3">
                                                <span id="confirmation_message"></span>
                                            </div>
                                        @else
                                            <div class="col-md-4">
                                                <input id="phone_number" <?php echo $readonly = (Auth::user()->phone_verify == 1) ? 'readonly' : '' ; ?> type="text" class="form-control" name="phone_number" value="{{ Auth::user()->phone_no}}" status="true">
                                                <span id="phone_number_error"></span>
                                            </div>
                                            @if(Auth::user()->phone_verify != 1)
                                                <div class="col-md-2">
                                                    <span id="send_otp" class="">Verification Code</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <span id="confirmation_message"></span>
                                                </div>
                                            @else
                                            <div class="col-md-3">
                                            {{ session()->put('phone_verify', '1')}}
                                                <span style="color:green" id="confirmation_message">Verified!</span>
                                            </div>
                                            @endif
                                        @endif
                                    </div> 
                                    @if (Auth::guest() || Auth::user()->phone_verify != 1)
                                        <div class="form-group row">
                                            <label for="enter_otp" class="col-md-3 col-form-label text-md-right">{{ __('Enter Verification Code') }}</label>
                                            <div class="col-md-4">
                                                <input id="enter_otp" type="text" class="form-control"  name="enter_otp" value="" placeholder="Enter Verification Code">
                                            </div>
                                            <div class="col-md-3">
                                                <span id="otp_confirmation_message"></span>
                                            </div>
                                        </div>
                                    @else
                                        <input id="enter_otp" type="hidden" class="form-control"  name="enter_otp" value="1" placeholder="Enter Verification Code">
                                    @endif
                                    <div class="form-group row">
                                        <label for="tenant_address" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
                                        <input name="latitude" id="latitude" type="hidden" value="">
                                        <input name="longitude" id="longitude" type="hidden" value="">
                                        <div class="col-md-6">
                                            @if (Auth::guest())  
                                                <input type="text" class="form-control" id="autocomplete" name="tenant_address" placeholder="Enter Address">
                                            @else
                                                <input type="text" class="form-control" id="autocomplete" name="tenant_address" placeholder="Enter Address" value="{{ Auth::user()->tenant_address}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tenant_photo" class="col-md-3 col-form-label text-md-right">{{ __('Profile Photo') }}</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" id="tenant_photo" name="tenant_photo" >
                                            <span class="errors" id="error_tenant_photo"></span>
                                            @error('tenant_photo')
                                                    <span class="invalid-feedback"  role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tenant_photo_id_proof" class="col-md-3 col-form-label text-md-right">{{ __('Photo ID Proof') }}</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" id="tenant_photo_id_proof" name="tenant_photo_id_proof" >
                                            <span class="errors" id="error_tenant_photo_id_proof"></span>
                                            @error('tenant_photo_id_proof')
                                                    <span class="invalid-feedback"  role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(isset($user->id) && $user->tenant_type == 'person')
                                        <div class="form-group row tenant_body" >
                                    @else
                                        <div class="form-group row tenant_body" style="display: none">
                                    @endif
                                        <label for="tenant_pay_slip" class="col-md-3 col-form-label text-md-right">{{ __('Pay slip') }}</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" id="tenant_pay_slip" name="tenant_pay_slip" >
                                            <span class="errors" id="error_tenant_pay_slip"></span>
                                            @error('tenant_pay_slip')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                   <!--  <div class="form-group row">
                                        <label for="tenant_photo_esignature" class="col-md-3 col-form-label text-md-right">{{ __('E-Signature') }}</label>
                                        <div class="col-md-4">
                                            <a href="javascript::void()" data-toggle="modal" data-target="#upload_signature">Upload E-Signature</a>
                                            <br>
                                            <input type="hidden" class="form-control" 
                                            id="tenant_photo_esignature" name="tenant_photo_esignature" >
                                            <span class="errors" id="error_tenant_photo_esignature"></span>
                                            @error('tenant_photo_esignature')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                        <div class="col-md-5">
                                            <img style="display: none;" id="image_name" class="sign-preview" src="">
                                        </div>                                       
                                    </div> -->
                                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                                          <div class="btn-group btn-group-lg" role="group" aria-label="">
                                          </div>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-primary btn-lg btn-block next1" name="step" value="1" step="1">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ ( $step == 2 )? 'in active' : ''}}" id="step2">
                            <form autocomplete="off" method="POST" action="{{ url('book-property/'.$id) }}" enctype="multipart/form-data" id="create_propert_form2">
                            @csrf
                            <input type="hidden" name="tenant_id" id="g_tenant_id" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
                                <?php 
                                    $choose_guarantor = (isset($unit->choose_guarantor)) ? $unit->choose_guarantor : 'yes' ;
                                ?>
                                <h3> Guarantor Details</h3>
                                <div class="well">  
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Want a Guarantor') }}</label>
                                        <div class="col-md-9">
                                            <div class="tenant_type_main choose_guarantor_main">
                                                @if($choose_guarantor == 'yes') 
                                                    <input id="choose_guarantor_yes" type="radio" class="form-control"  name="choose_guarantor" value="yes" checked=""> Yes
                                                @elseif($choose_guarantor == 'no') 
                                                    <input id="choose_guarantor_no" type="radio" class="form-control"  name="choose_guarantor" value="no" checked=""> No
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                        <div class="col-md-6">
                                            @if(isset($guarantor) && !empty($guarantor)) 
                                                <input id="g_name" type="text" class="form-control disabled"  name="name" value="{{$guarantor->name}}" placeholder="Guarantor Name">
                                            @else
                                                <input id="name" type="text" class="form-control disabled"  name="name" value="" placeholder="Guarantor Name">
                                            @endif
                                            <span class="g_errors" id="g_error_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                        <div class="col-md-6">
                                            @if(isset($guarantor) && !empty($guarantor))  
                                                <input id="g_email" type="text" class="form-control disabled" name="email" value="{{$guarantor->email}}" placeholder="jhon@gmail.com" status="false">
                                            @else
                                                <input id="g_email" type="text" class="form-control disabled"  name="email" value="" placeholder="guarantor@gmail.com" status="true">
                                            @endif
                                            <span class="g_errors" id="g_error_email"></span>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="phone_no" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                        <div class="col-md-6">
                                            @if(isset($guarantor) && !empty($guarantor)) 
                                                <input id="phone_no" type="text" class="form-control disabled"  name="phone_no" value="{{$guarantor->phone_no}}" placeholder="+911234567890" status="false">
                                                <span id="m_phone_number_error"></span>
                                            @else
                                                <input id="phone_no" type="text" class="form-control disabled"  name="phone_no" value="" placeholder="+911234567890" status="false">
                                                <span id="m_phone_number_error"></span>
                                            @endif
                                            <span class="g_errors" id="g_error_phone_no"></span>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
                                        <div class="col-md-6">
                                            <input name="b_latitude" id="b_latitude" type="hidden" value="">
                                            <input name="b_longitude" id="b_longitude" type="hidden" value="">
                                            @if(isset($guarantor) && !empty($guarantor)) 
                                                <input type="text" class="form-control disabled" value="{{$guarantor->address}}" id="b_autocomplete" name="address" placeholder="Enter Address">
                                            @else
                                                <input type="text" class="form-control disabled" id="address" name="address" placeholder="Enter Guarantor Address">
                                            @endif
                                            <span class="g_errors" id="g_error_address"></span>
                                        </div>
                                    </div>
                                   <!--  <div class="form-group row">
                                        <label for="photo" class="col-md-3 col-form-label text-md-right">{{ __('Photo') }}</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control disabled" id="photo" name="photo" >
                                            <span class="g_errors" id="g_error_photo"></span>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="photo_id_proof" class="col-md-3 col-form-label text-md-right">{{ __('Photo ID Proof') }}</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control disabled" id="photo_id_proof" name="photo_id_proof" >
                                            <span class="g_errors" id="g_error_photo_id_proof"></span>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                                          <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                          </div>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-primary btn-lg btn-block next2" name="step" value="2" step="2">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ ( $step == 3 )? 'in active' : ''}}" id="step3">
                            <form autocomplete="off" method="POST" action="{{ url('book-property/'.$id) }}" enctype="multipart/form-data" id="create_propert_form3">
                                @csrf
                                <input type="hidden" name="tenant_id" id="c_tenant_id" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
                                <h3>Contract Period</h3>
                                <div class="well">
                                    <div class="form-group row">
                                        <label for="contract_type" class="col-md-3 col-form-label text-md-right">Purpose</label>
                                        <div class="col-md-8">
                                            <!-- <select id="contract_type" type="text" class="form-control green" name="contract_type" value="" aria-invalid="false"> 
                                                <option value="Commercial">Commercial</option>       
                                                <option value="Residential">Residential</option>
                                            </select> -->
                                            <input type="text" class="form-control" id="contract_type" name="contract_type" placeholder="Write purpose of using" value="{{ (isset($booking_details->contract_type)) ? $booking_details->contract_type : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="start_date" class="col-md-3 col-form-label text-md-right">Starting Date</label>
                                        <div class="col-md-8">
                                            @if(isset($booking_details) && !empty($booking_details)) 
                                                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="{!! \Helper::Date(date('Y/m/d')) !!}" value="{{$booking_details->start_date}}">
                                            @else
                                                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="{!! \Helper::Date(date('Y/m/d')) !!}" value="">
                                            @endif                                            
                                            <span class="c_errors" id="c_error_start_date"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="end_date" class="col-md-3 col-form-label text-md-right">End Date</label>
                                        <div class="col-md-8">
                                            @if(isset($booking_details) && !empty($booking_details)) 
                                                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="{!! \Helper::Date(date('Y/m/d')) !!}" value="{{$booking_details->start_date}}">
                                            @else
                                                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="{!! \Helper::Date(date('Y/m/d')) !!}">
                                            @endif 
                                                <span class="c_errors" id="c_error_end_date"></span>
                                            
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label for="tenant_photo_esignature" class="col-md-3 col-form-label text-md-right">{{ __('E-Signature') }}</label>
                                        <div class="col-md-4">
                                            <a href="javascript::void()" data-toggle="modal" data-target="#upload_signature">Upload E-Signature</a>
                                            <br>
                                            <input type="hidden" class="form-control" 
                                            id="tenant_photo_esignature" name="tenant_photo_esignature" >
                                            <span class="c_errors" id="c_error_tenant_photo_esignature"></span>
                                            @error('tenant_photo_esignature')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                        <div class="col-md-5">
                                            <img style="display: none;" id="image_name" class="sign-preview" src="">
                                        </div>                                       
                                    </div>

                                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                        
                                          </div>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-primary btn-lg btn-block next3" step="3" name="step" value="3">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ ( $step == 4 )? 'in active' : ''}}" id="step4">
                            <form autocomplete="off" method="POST" action="{{ url('book-property/'.$id) }}" enctype="multipart/form-data" id="create_propert_form4">
                            @csrf
                                <input type="hidden" name="tenant_id" id="p_tenant_id" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
                                <input type="hidden" name="total_amount" id="total_amount" value="{{ $unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit}}">
                                <h3>Payment details</h3>
                                <div class="well">
                                    <div class="form-group row">
                                        <label for="rent" class="col-md-3 col-form-label text-md-right">Rent</label>
                                        <div class="col-md-9">
                                            {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $unit->rent }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Cost Provision</label>
                                        <div class="col-md-9">
                                            {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$unit->cost_provision }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Other monthly fees</label>
                                        <div class="col-md-9">
                                           {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $unit->tax + $unit->fix_price }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Deposit</label>
                                        <div class="col-md-9">
                                            {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$unit->deposit }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Total Amount</label>
                                        <div class="col-md-9">
                                            {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit }}
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                        </div>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-success btn-lg btn-block next4" name="step" step="4" value="4">Book</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- <div class="tab-pane fade {{ ( $step == 5 )? 'in active' : ''}}" id="step5">
                            <form autocomplete="off" onsubmit="return confirm('Please have an assurance from Property manager to Accept the Booking, if he rejected we will deduct PayPal refund fees');" method="POST" action="{{ url('property-payment') }}" enctype="multipart/form-data" id="create_propert_form5">
                                @csrf
                                <input type="hidden" name="tenant_id" id="f_tenant_id" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
                                <input type="hidden" name="unit_id" id="unit_id" value="{{ $id }}">
                                <h3>Make Payment</h3>
                                <div class="well">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="make_payment">
                                                <button name="paypal" class="btn btn-primary payment paypal_popup" value="paypal">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit }} with <img src="{{ url('/images/Paypal-button.png') }}">
                                                </button> or
                                                <button type="button" name="bank" data-amount="{{  $unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit }}" data-account="56769576567567" data-router="123456789" data-aba="ABA NO 454545" data-bank="Bank of America" data-unit="{{$unit->unit_name}}" data-tenant="{{(isset($user) && !empty($user)) ? $user->name : ''}}" class="btn btn-primary payment bank_details" value="bank">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit }} using <img src="{{ url('images/bank-transfer.png') }}">
                                                </button> 
                                                @if(($unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit) < 999999.99)
                                                or
                                                <button type="button" id="credit_card_custom" name="credit_card" class="btn btn-primary payment credit-card" value="bank">Pay  {{ App\Helpers\Helper::CURRENCYSYMBAL.($unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit) }} using <img src="{{ url('images/payment_cards.png') }}">
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-default back" type="button">Back</button>
                                        </div>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('stripe.post') }}" method="POST" id="stripe_form_custom">
                                @csrf
                                <input type="hidden" name="tenant_id" id="f_tenant_id_stripe" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
                                <input type="hidden" name="unit_id" id="unit_id" value="{{ $id }}">
                                <input type="hidden" name="amount" id="unit_amount" value="{{ 100*($unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit) }}">
                              <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-amount="{{ 100*($unit->rent + $unit->cost_provision + $unit->tax + $unit->fix_price + $unit->deposit) }}" 
                                data-name="Reasy Payment"
                                data-description="Widget"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto"
                                data-currency="EUR">
                              </script>
                            </form>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="bank_details" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Bank Details</h3>
            </div>
            <div class="modal-body termsToPrint">
                <table>
                    <tbody>
                        <tr>
                            <th id="unit"></th>
                            <th id="tenant"></th>
                        </tr>
                        <tr>
                            <td>Paid amount:</td>
                            <td><p id="amount"></p></td>
                        </tr>
                        <tr>
                            <td>Bank Name:</td>
                            <td><p id="bank"></p></td>
                        </tr>
                        <tr>
                            <td>ABA number:</td>
                            <td><p id="aba"></p></td>
                        </tr>
                        <tr>
                            <td>Account number:</td>
                            <td><p id="account"></p></td>
                        </tr><tr>
                            <td>Routing code:</td>
                            <td><p id="router"></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <!-- <button class="btn btn-info" onclick="window.print();">Print</button> -->
                        <button class="btn btn-info" id="printOut">Print</button>
                    </div>
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-success" id="bank_payment_done">Book</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="upload_signature" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Put signature below</h3>
            </div>
            <div class="modal-body termsToPrint">
                <div id="signArea" >
                    <div class="sig sigWrapper" style="height:auto;">
                        <div class="typed"></div>
                        <form method="POST" action="">
                            <canvas class="sign-pad" id="sign-pad" width="508" height="100"></canvas>
                            <button id="removeSignature" type="button">Clear</button>
                            <button type="button" id="btnSaveSign" disabled="">Save Signature</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
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
                </ul>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="create_tenant_form">
                    @csrf
                    <input id="unit_id" type="hidden" class="form-control" name="unit_id" value="">
                    <input id="booking_id" type="hidden" class="form-control" name="booking_id" value="">
                    <div style="display: none;" class="form-group row gender_class">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Want new tenant') }}</label>
                        <div class="col-md-6 choose_guarantor_main">
                            Yes <input id="choose_guarantor_yes" type="radio" class="form-control" checked="" name="choose_guarantor" value="yes"> 
                            No <input id="choose_guarantor_no" type="radio" class="form-control"  name="choose_guarantor" value="no" >
                        </div>
                    </div>
                    <div style="display: none;" class="form-group row" id="select_tenant">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Select Tenant') }}</label>
                        <div class="col-md-6">
                            <select class="" name="selected_tenant" id="selected_tenant">
                                <option value="">Select Tenant</option>
                                @if(count($tenant_list) > 0)
                                @foreach($tenant_list as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name." ".$value->name."(".$value->email.")" }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="new_tenant" id="new_tenant">
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
                            <label for="t_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="t_email" type="text" class="form-control" name="email" value="" data="false">
                                <span style="color: red;" id='email_error'></span>
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
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" id="create_tenant_button"class="btn btn-success">Create Tenant</button>
                        </div>
                    </div>
                </form>
            </div>          
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="credit_card_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Enter credit card details</h3>
            </div>
            <div class="modal-body termsToPrint">
                <div id="paymentSection">
                    <form method="post" id="paymentForm">
                        <h4>Item: <?php echo @$itemName; ?></h4>
                        <h4>Payable amount: $<?php echo @$payableAmount.' '.@$currency; ?></h4>
                        <input type="hidden" name="credit" id="credit" value="card">
                        <input type="hidden" name="unit_id" id="unit_id" value="{{ $id }}">
                        <input type="hidden" name="tenant_id" id="f_tenant_id" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
                        @csrf
                        <ul>
                            <li>
                                <label>Card number</label>
                                <input type="text" placeholder="1234 5678 9012 3456" maxlength="20" id="card_number" name="card_number">
                            </li>
                            <li class="vertical">
                                <ul>
                                    <li>
                                        <label>Expiry month</label>
                                        <input type="text" placeholder="MM" maxlength="5" id="expiry_month" name="expiry_month">
                                    </li>
                                    <li>
                                        <label>Expiry year</label>
                                        <input type="text" placeholder="YYYY" maxlength="5" id="expiry_year" name="expiry_year">
                                    </li>
                                    <li>
                                        <label>CVV</label>
                                        <input type="text" placeholder="123" maxlength="3" id="cvv" name="cvv">
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <label>Name on card</label>
                                <input type="text" placeholder="John Doe" id="name_on_card" name="name_on_card">
                            </li>
                            <li>
                                <input type="hidden" name="card_type" id="card_type" value=""/>
                                <input type="button" name="card_submit" id="cardSubmitBtn" value="Proceed" class="payment-btn" disabled="true" >
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">

                        <button class="btn btn-info" id="printOut">Print</button>
                    </div>
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-success" id="bank_payment_done">Book</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
        <!-- content to be printed here -->
</div>
<script type="text/javascript">
    $(function(){
        $('#printOut').click(function(e){
            e.preventDefault();
            var w = window.open();
            // var printOne = $('.contentToPrint').html();
            var printTwo = $('.termsToPrint').html();
            w.document.write('<html><head><title>Bank Details</title></head><body><h1>Bank Details</h1><hr />' + printTwo) + '</body></html>';
            w.window.print();
            w.document.close();
            return false;
        });
    });
</script>

    <script type="text/javascript">
        var date = new Date();
        date.setDate(date.getDate() + {!! \Helper::ContractStartDate() !!});

        var date_format = '{!! \Helper::DateFormat() !!}';
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

        $('.back').click(function(){
            var prevId = $(this).parents('.tab-pane').prev().attr("id");
            $('[href="#'+prevId+'"]').tab('show');
            return false;
        });

        var step = '{{$step}}';
        var percent = (parseInt(step) / 4) * 100;
        $('.progress-bar').css({width: percent + '%'});
        $('.progress-bar').text("Step " + step + " of 4");

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          //update progress
          var step = $(e.target).data('step');
          var percent = (parseInt(step) / 4) * 100;
          $('.progress-bar').css({width: percent + '%'});
          $('.progress-bar').text("Step " + step + " of 4");
          //e.relatedTarget // previous tab
        });
        $('.first').click(function(){
          $('#myWizard a:first').tab('show')
        });
        jQuery('.tenant_type_main input').click(function(){
            if($('#tenant_type2').is(':checked')) { 
                jQuery('.company_body').show();
                jQuery('.tenant_body').hide();
            } else {
                jQuery('.company_body').hide();
                jQuery('.tenant_body').show();
            }
        });
        if($('#choose_guarantor_no').is(':checked')) { 
            jQuery('.disabled').attr('readonly',true);
        }

        jQuery('.choose_guarantor_main input').click(function(){
            if($('#choose_guarantor_no').is(':checked')) { 
                jQuery('.disabled').attr('readonly',true);
            } else {
                jQuery('.disabled').attr('readonly',false);
            }
        });

        $('#send_otp').click(function(){
            $('#phone_number_error').text('');
            $('#confirmation_message').text('');
            var phoneNumber = $('#phone_number').val();
            phone = phoneNumber.replace(/[^0-9]/g,'');
            if(phoneNumber == ''){                   
                $('#phone_number_error').text('Please enter  number');
            } else if(phone.length == 10){                   
                $('#phone_number_error').text('Please enter number with country code');
            } else if(phoneNumber.length != 12) {
                $('#phone_number_error').text('Please enter a valid number');
            } else if(phone.length != 12 || phone.length > 12){                   
                $('#phone_number_error').text('Please enter a valid number');
            } else {
                $.ajax({
                    url: "{{ url('/send-otp') }}",
                    type: "POST",
                    data: {'_token':'<?php echo csrf_token() ?>','phone_number':phone},
                    success: function(data){
                        $('#confirmation_message').html(data);
                    }
                });
            }
        })
        $('#m_send_otp').click(function(){
            $('#m_phone_number_error').text('');
            $('#m_confirmation_message').text('');
            var phoneNumber = $('#m_phone_number').val();
            phone = phoneNumber.replace(/[^0-9]/g,'');
            if(phoneNumber == ''){                   
                $('#m_phone_number_error').text('Please enter  number');
            } else if(phone.length == 10){                   
                $('#m_phone_number_error').text('Please enter number with country code');
            } else if(phoneNumber.length != 12) {
                $('#m_phone_number_error').text('Please enter a valid number');
            } else if(phone.length != 12 || phone.length > 12){                   
                $('#m_phone_number_error').text('Please enter a valid number');
            } else {
                $.ajax({
                    url: "{{ url('/send-otp') }}",
                    type: "POST",
                    data: {'_token':'<?php echo csrf_token() ?>','phone_number':phone},
                    success: function(data){
                        $('#m_confirmation_message').html(data);
                    }
                });
            }
        })
        $('#enter_otp').blur(function(){
            $.ajax({
                url: "{{ url('/verify-otp') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','opt':$('#enter_otp').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#otp_confirmation_message').html(data.message).css('color','green');
                       $('#phone_number').attr('status','true');
                    }
                    if(data.status == 'false'){
                        $('#phone_number').attr('status','false');
                        $('#otp_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });
        $('#m_enter_otp').blur(function(){
            $.ajax({
                url: "{{ url('/verify-otp') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','opt':$('#m_enter_otp').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#m_otp_confirmation_message').html(data.message).css('color','green');
                       $('#m_phone_number').attr('status','true');
                    }
                    if(data.status == 'false'){
                        $('#m_phone_number').attr('status','false');
                        $('#m_otp_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });
        $('#email').change(function(){
            $('#email_confirmation_message,#email_varification_messag').html('');
            $.ajax({
                url: "{{ url('/verify-visiter-email') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','email':$('#email').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#email_confirmation_message').html(data.message).css('color','green');
                       $('#email').attr('status','true');
                       $('#email_varification_message,#Email_confirmation').hide();
                    }
                    if(data.status == 'sent'){
                        $('#email').attr('status','false');
                        $('#Email_confirmation,#email_varification_message').show();
                        $('#email_varification_message').html(data.message).css('color','red');
                    }
                }
            });
        });
        $('#m_email').blur(function(){
            $('#m_email_confirmation_message,#m_email_varification_messag').html('');
            $.ajax({
                url: "{{ url('/verify-visiter-email') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','email':$('#m_email').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#m_email_confirmation_message').html(data.message).css('color','green');
                       $('#m_email').attr('status','true');
                       $('#m_email_varification_message,#m_Email_confirmation').hide();
                    }
                    if(data.status == 'sent'){
                        $('#m_email').attr('status','false');
                        $('#m_Email_confirmation,#m_email_varification_message').show();
                        $('#m_email_varification_message').html(data.message).css('color','red');
                    }
                }
            });
        });

        $('#email_token').change(function(){
            $('#email_confirmation_message,#email_varification_messag').html('');
            $.ajax({
                url: "{{ url('/verify-email-token') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','email':$('#email').val(),'confirmation_code':$('#email_token').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#email_token_confirmation_message').html(data.message).css('color','green');
                       $('#email').attr('status','true');
                       $('#email_varification_message').hide();
                    }
                    if(data.status == 'false'){
                        $('#email').attr('status','false');
                        $('#Email_confirmation').show();
                        $('#email_token_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });

        $('#m_email_token').change(function(){
            $('#m_email_confirmation_message,#m_email_varification_messag').html('');
            $.ajax({
                url: "{{ url('/verify-email-token') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','email':$('#m_email').val(),'confirmation_code':$('#m_email_token').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#m_email_token_confirmation_message').html(data.message).css('color','green');
                       $('#m_email').attr('status','true');
                       $('#m_email_varification_message').hide();
                    }
                    if(data.status == 'false'){
                        $('#m_email').attr('status','false');
                        $('#m_Email_confirmation').show();
                        $('#m_email_token_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });

        $(".next1").click(function(){
            $('.errors').text('');
            var thisa = $(this);
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0} kb');
            $("#create_propert_form").validate({
                errorClass:"red",
                validClass:"green",
                ignore: "",
                rules:{                  
                    name:{
                        required:true,
                    },
                    email:{
                        required:true,
                        email:true
                    },
                    co_tenant_1:{
                        email:true
                    },
                    co_tenant_2:{
                        email:true
                    },
                    co_tenant_3:{
                        email:true
                    },
                    phone_number:{
                        required:true,
                        number:true
                    },
                    enter_otp:{
                        required:true,
                        number:true
                    },
                    tenant_photo: {
                      required: true,
                      // extension: "jpeg, png, jpg",
                      accept: "image/*",
                    },
                    tenant_photo_id_proof: {
                      required: true,
                      // extension: "jpeg, png, jpg",
                      accept: "image/*",
                    },
                    tenant_pay_slip: {
                      // required: true,
                      // extension: "jpeg, png, jpg",
                      accept: "image/*",
                    }
                    
                },
                messages: {
                    name:{
                        required:"Please enter name",
                    },
                    email:{
                        required: "Please enter email",
                        email: "Please enter valid email",
                    },
                    co_tenant_1:{
                        email: "Please enter valid email",
                    },
                    co_tenant_2:{
                        email: "Please enter valid email",
                    },
                    co_tenant_3:{
                        email: "Please enter valid email",
                    },
                    phone_number:{
                        required: "Please enter phone number",
                        number: "Please enter valid numbers",
                    },
                    enter_otp:{
                        required: "Please enter OTP",
                        number:"Please enter valid numbers",
                    },
                    tenant_photo: {
                      required: "Please upload photo",
                      accept: "The photo must be a file of type: jpeg, png, jpg.",
                    },
                    tenant_photo_id_proof: {
                      required: "Please upload photo id proof",
                      accept: "The photo id proof must be a file of type: jpeg, png, jpg.",
                    },
                    tenant_pay_slip: {
                      // required: "Please upload photo id proof",
                      accept: "The photo id proof must be a file of type: jpeg, png, jpg.",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type:'POST',
                        url: '{{ url('book-property/'.$id) }}',
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            console.log(response);
                            if(response.success == false)
                            {
                                var errors = response.errors;
                                $.each( errors, function( key, value ) {
                                    $('#error_'+key).show();
                                    $('#error_'+key).css({'color': 'red','font-size': '13px','font-weight': '700'});
                                    $('#error_'+key).text(value);
                                });
                            }
                            else if(response.success == true)
                            {
                                jQuery('ul.nav.nav-pills.nav-wizard li.step1').removeClass('disabled');
                                var nextId = thisa.parents('.tab-pane').next().attr("id");
                                $('[href="#' + nextId + '"]').tab('show');
                                $('#g_tenant_id').val(response.tenant_id);
                                // $('[href="#step2"]').tab('show');
                            }
                        }
                    });
                    return false;
                }
            })
        });
        
        $(".next2").click(function(){
            $('.g_errors').text('');
            var thisa = $(this);
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0} kb');
            $("#create_propert_form2").validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    name:{
                        // required:true,
                        required:'#choose_guarantor_yes:checked'
                    },
                    email:{
                        required:'#choose_guarantor_yes:checked',
                        email:true
                    },
                    phone_no:{
                        required:'#choose_guarantor_yes:checked',
                        // number:true
                        phoneUS: true
                    },
                    // photo: {
                    //   required: '#choose_guarantor_yes:checked',
                    //   // extension: "jpeg, png, jpg",
                    //   accept: "image/*",
                    // },
                    photo_id_proof: {
                      required: '#choose_guarantor_yes:checked',
                      // extension: "jpeg, png, jpg",
                      accept: "image/*",
                    }
                },
                messages: {
                    name:{
                        required:"Please enter name",
                    },
                    email:{
                        required: "Please enter email",
                        email: "Please enter valid email",
                    },
                    phone_no:{
                        required: "Please enter phone number",
                        // number: "Please enter valid numbers",
                        phoneUS: "Please enter valid numbers",
                    },
                    // photo: {
                    //   required: "Please upload photo",
                    //   accept: "The photo must be a file of type: jpeg, png, jpg.",
                    // },
                    photo_id_proof: {
                      required: "Please upload photo id proof",
                      accept: "The photo id proof must be a file of type: jpeg, png, jpg.",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type:'POST',
                        url: '{{ url('book-property/'.$id) }}',
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            console.log(response);
                            if(response.success == false)
                            {
                                var errors = response.errors;
                                $.each( errors, function( key, value ) {
                                    $('#g_error_'+key).show();
                                    $('#g_error_'+key).css({'color': 'red','font-size': '13px','font-weight': '700'});
                                    $('#g_error_'+key).text(value);
                                });
                            }
                            else if(response.success == true)
                            {
                                jQuery('ul.nav.nav-pills.nav-wizard li.step2').removeClass('disabled');
                                var nextId = thisa.parents('.tab-pane').next().attr("id");
                                $('[href="#' + nextId + '"]').tab('show');
                                $('#c_tenant_id').val(response.tenant_id);
                                // $('[href="#step2"]').tab('show');
                            }
                        }
                    });
                    return false;
                }
            })
        });

        $(".next3").click(function(){
            $('.c_errors').text('');
            var thisa = $(this);
            $("#create_propert_form3").validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    start_date:{
                        required:true,
                    },
                    end_date:{
                        required:true,
                    },
                    tenant_photo_esignature: {
                      required: true,
                      // extension: "jpeg, png, jpg",
                      // accept: "image/*",
                      // filesize: 20000,
                    },
                    contract_type:{
                        required:true,
                    }
                },
                messages: {
                    start_date:{
                        required:"Please select start date",
                    },
                    end_date:{
                        required: "Please select end date",
                    },
                    contract_type:{
                        required: "Please write purpose",
                    },
                    tenant_photo_esignature: {
                      required: "Please upload E-Signature",
                      // accept: "The E-Signature must be a file of type: jpeg, png, jpg.",
                      // filesize: "The E-Signature may not be greater than 200KB",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type:'POST',
                        url: '{{ url('book-property/'.$id) }}',
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            console.log(response);
                            if(response.success == false)
                            {
                                var errors = response.errors;
                                $.each( errors, function( key, value ) {
                                    $('#c_error_'+key).show();
                                    $('#c_error_'+key).css({'color': 'red','font-size': '13px','font-weight': '700'});
                                    $('#c_error_'+key).text(value);
                                });
                            }
                            else if(response.success == true)
                            {
                                jQuery('ul.nav.nav-pills.nav-wizard li.step3').removeClass('disabled');
                                var nextId = thisa.parents('.tab-pane').next().attr("id");
                                $('[href="#' + nextId + '"]').tab('show');
                                $('#p_tenant_id').val(response.tenant_id);
                                // $('[href="#step2"]').tab('show');
                            }
                        }
                    });
                    return false;
                }
            })
        });

        $(".next4").click(function(){
            $('.p_errors').text('');
            var thisa = $(this);
            $("#create_propert_form4").validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    // total_amount:{
                    //     required:true,
                    // }
                },
                messages: {
                    total_amount:{
                        required:"Please select start date",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type:'POST',
                        url: '{{ url('book-property/'.$id) }}',
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            console.log(response);
                            if(response.success == false)
                            {
                                var errors = response.errors;
                                $.each( errors, function( key, value ) {
                                    $('#c_error_'+key).show();
                                    $('#c_error_'+key).css({'color': 'red','font-size': '13px','font-weight': '700'});
                                    $('#c_error_'+key).text(value);
                                });
                            }
                            else if(response.success == true)
                            {
                                $url = "{{url('buy-property')}}";
                                window.location.href = $url+'/'+response.booking_id;
                                // jQuery('ul.nav.nav-pills.nav-wizard li.step4').removeClass('disabled');
                                // var nextId = thisa.parents('.tab-pane').next().attr("id");
                                // $('[href="#' + nextId + '"]').tab('show');
                                // $('#f_tenant_id, #f_tenant_id_stripe').val(response.tenant_id);
                            }
                        }
                    });
                    return false;
                }
            })
        });

        jQuery('.bank_details').click(function(){
            var amount      = $(this).data('amount');
            var account     = $(this).data('account');
            var router      = $(this).data('router');
            var aba         = $(this).data('aba');
            var bank        = $(this).data('bank');
            var unit        = $(this).data('unit');
            var tenant        = $(this).data('tenant');
            $('#bank_details').modal('show');
            $("#bank_details #amount").text( amount );
            $("#bank_details #router").text( router );
            $("#bank_details #account").text( account );
            $("#bank_details #aba").text( aba );
            $("#bank_details #bank").text( bank );            
            $("#bank_details #unit").text( 'References: '+unit );            
            $("#bank_details #tenant").text( tenant );            
        });

        jQuery('#bank_payment_done').click(function() {
            document.getElementById("create_propert_form5").submit();
        });

    </script>
    <style type="text/css">
        div#add_vendors span ,div#add_vendors_data span,div#add_new_building span, div#add_new_meter span{border: 1px solid #ccc; padding: 5px; margin: 0 5px; }
        span.term_error_message {display: block; color: red; }
        li.disabled {pointer-events: none; } 
        .make_payment img {width: 100px; height: 35px; }
        .make_payment {padding: 20px 0; }
        .tenant_type_main input {width: 15px; display: inline-block; height: 14px; box-shadow: none; }
        span#send_otp, span#m_send_otp {background-color: #DDDDDD; padding: 8px 4px; font-size: 13px; border-radius: 3px; position: absolute; cursor: pointer; }
        span#m_phone_number_error {color: red; }
         .termsToPrint tr td {width: 10%;}
        #btnSaveSign {
            color: #fff;
            background: #f99a0b;
            padding: 5px;
            border: none;
            border-radius: 5px;
            font-size: 20px;
        }
        #signArea{
            width:510px;
        }
        .sign-preview {
            width: 150px;
            height: 50px;
            border: solid 1px #CFCFCF;
            margin: 10px 5px;
        }
        #paymentSection {
            background-color: #f9f9f7;
            border: 1px solid #fff;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            left: 0;
            margin: 0 auto;
            padding: 10px 10px;
            max-width: 320px;
        }
        form {
            float: none;
        }
        #paymentSection h4 {
            color: #2E92CD;
            font-size: 16px;
            font-weight: bold;
        }
        ul, h4 {
            border: 0 none;
            font: inherit;
            margin: 0;
            padding: 0;
            vertical-align: baseline;
        }
        ol, ul {
            list-style: outside none none;
        }
        form input {
            background-color: #fff;
            border: 1px solid #e5e5e5;
            box-sizing: content-box;
            color: #333;
            display: block;
            font-size: 18px;
            height: 32px;
            padding: 0 5px;
            width: 275px;
            outline: none;
        }
        form li {
            margin: 8px 0;
        }
        form label {
            color: #555;
            display: block;
            font-size: 14px;
            font-weight: 400;
        }
        form #card_number {
            background-image: url(../images.png), url(../images.png);
            background-position: 2px -121px, 260px -61px;
            background-repeat: no-repeat;
            background-size: 120px 361px, 120px 361px;
            padding-left: 54px;
            width: 225px;
        }
        form input {
            background-color: #fff;
            border: 1px solid #e5e5e5;
            box-sizing: content-box;
            color: #333;
            display: block;
            font-size: 18px;
            height: 32px;
            padding: 0 5px;
            width: 275px;
            outline: none;
        }
        .vertical {
            overflow: hidden;
        }

        form li {
            margin: 8px 0;
        }
        ul ul, ol ul, ul ol, ol ol {
            margin-bottom: 0;
        }
        ul, h4 {
            border: 0 none;
            font: inherit;
            margin: 0;
            padding: 0;
            vertical-align: baseline;
        }
        ol, ul {
            list-style: outside none none;
        }
        .vertical li {
            float: left;
            width: 95px;
        }
        form label {
            color: #555;
            display: block;
            font-size: 14px;
            font-weight: 400;
        }
        .vertical input {
            width: 68px;
        }
        .payment-btn:disabled {
            opacity: 0.2;
        }

        button[disabled], html input[disabled] {
            cursor: default;
        }
        button, html input[type="button"], input[type="reset"], input[type="submit"] {
            -webkit-appearance: button;
            cursor: pointer;
        }
        .payment-btn {
            width: 100%;
            height: 34px;
            padding: 0;
            font-weight: bold;
            color: white;
            text-align: center;
            cursor: pointer;
            text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.2);
            border: 1px solid;
            border-color: #005fb3;
            background: #0092d1;
            border-radius: 4px;
        }
        button#removeSignature {
            color: #fff;
            background: #c9302c;
            padding: 5px;
            border: none;
            border-radius: 5px;
            font-size: 20px;
        }
      /*  li.step3.disabled.active {
            z-index: 1;
        }
        li.step3.active {
            Z-INDEX: 1;
        }
        li.step4.3.disabled { z-index: 1; }*/
        div#ui-datepicker-div { z-index: 9999999 !important;}
        #stripe_form_custom {display: none; }
    </style>
<script>
    $(document).ready(function() {
        $('#signArea').signaturePad({
            drawOnly:true, 
            drawBezierCurves:true,
            lineTop:90,
            clear : '#removeSignature',
            onDraw: (e)=>{ document.getElementById("btnSaveSign").disabled = false; }
        });
    });

    $("#removeSignature").click(function(e){
        document.getElementById("btnSaveSign").disabled = true;
    });
    $("#btnSaveSign").click(function(e){
        html2canvas([document.getElementById('sign-pad')], {
            onrendered: function (canvas) {
                var canvas_img_data = canvas.toDataURL('image/png');
                var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
                //ajax call to save image inside folder
                $.ajax({
                    url: "{{ url('upload-signature') }}",
                    data: {
                        _token:'<?php echo csrf_token() ?>',
                        img_data:img_data 
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                       var img = "{{url('images/users')}}";
                       $('#image_name').show();
                       $('#image_name').attr('src', img+'/'+response.image_name);
                       $('#tenant_photo_esignature').val(response.image_name);
                       $('#upload_signature').modal('hide');
                    }
                });
            }
        });
    });
</script> 

<script type="text/javascript">
function cardFormValidate(){
    var cardValid = 0;
      
    // Card number validation
    $('#card_number').validateCreditCard(function(result) {
        var cardType = (result.card_type == null)?'':result.card_type.name;
        if(cardType == 'Visa'){
            var backPosition = result.valid?'2px -163px, 260px -87px':'2px -163px, 260px -61px';
        }else if(cardType == 'MasterCard'){
            var backPosition = result.valid?'2px -247px, 260px -87px':'2px -247px, 260px -61px';
        }else if(cardType == 'Maestro'){
            var backPosition = result.valid?'2px -289px, 260px -87px':'2px -289px, 260px -61px';
        }else if(cardType == 'Discover'){
            var backPosition = result.valid?'2px -331px, 260px -87px':'2px -331px, 260px -61px';
        }else if(cardType == 'Amex'){
            var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
        }else{
            var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
        }
        $('#card_number').css("background-position", backPosition);
        if(result.valid){
            $("#card_type").val(cardType);
            $("#card_number").removeClass('required');
            cardValid = 1;
        }else{
            $("#card_type").val('');
            $("#card_number").addClass('required');
            cardValid = 0;
        }
    });
      
    // Card details validation
    var cardName = $("#name_on_card").val();
    var expMonth = $("#expiry_month").val();
    var expYear = $("#expiry_year").val();
    var cvv = $("#cvv").val();
    var regName = /^[a-z ,.'-]+$/i;
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    var regCVV = /^[0-9]{3,3}$/;
    if(cardValid == 0){
        $("#card_number").addClass('required');
        $("#card_number").focus();
        return false;
    }else if(!regMonth.test(expMonth)){
        $("#card_number").removeClass('required');
        $("#expiry_month").addClass('required');
        $("#expiry_month").focus();
        return false;
    }else if(!regYear.test(expYear)){
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").addClass('required');
        $("#expiry_year").focus();
        return false;
    }else if(!regCVV.test(cvv)){
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").addClass('required');
        $("#cvv").focus();
        return false;
    }else if(!regName.test(cardName)){
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").addClass('required');
        $("#name_on_card").focus();
        return false;
    }else{
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").removeClass('required');
        $('#cardSubmitBtn').prop('disabled', false);  
        return true;
    }
}

$(document).ready(function(){

    $('#credit_card_custom').click(function(){
        $('#stripe_form_custom button').trigger('click');
    });
    // Initiate validation on input fields
    $('#paymentForm input[type=text]').on('keyup',function(){
        cardFormValidate();
    });
    
    // Submit card form
    $("#cardSubmitBtn").on('click',function(){
        $('.status-msg').remove();
        if(cardFormValidate()){
            var formData = $('#paymentForm').serialize();
            $.ajax({
                type:'POST',
                url:"{{ url('property-payment') }}",
                dataType: "json",
                data:formData,
                beforeSend: function(){
                    $("#cardSubmitBtn").prop('disabled', true);
                    $("#cardSubmitBtn").val('Processing....');
                },
                success:function(data){
                    if(data.status == 1){
                        $('#paymentSection').html('<p class="status-msg success">The transaction was successful. Order ID: <span>'+data.orderID+'</span></p>');
                    }else{
                        $("#cardSubmitBtn").prop('disabled', false);
                        $("#cardSubmitBtn").val('Proceed');
                        $('#paymentSection').prepend('<p class="status-msg error">Transaction has been failed, please try again.</p>');
                    }
                }
            });
        }
    });
});

</script>
<script type="text/javascript">
    jQuery('#create_tenant_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            name:{
                required:'#choose_guarantor_yes:checked'
            },
            last_name:{
                required:'#choose_guarantor_yes:checked',
            },
            email:{
                required:'#choose_guarantor_yes:checked',
                email:true,
            },
            phone_number:{
                required:'#choose_guarantor_yes:checked',
                number:true,
            },
            address:{
                required:'#choose_guarantor_yes:checked',
            },
            // selected_tenant:{
            //     required:'#choose_guarantor_no:checked',
            // },
        }       
    });
    jQuery('#t_email').blur(function(){
        // jQuery('#email_error').remove();
        jQuery.ajax({
            url: "{{ url('/verify-user-email') }}",
            type: "POST",
            data: {'_token':'<?php echo csrf_token() ?>','email':$('#t_email').val()},
            success: function(data){
                if(data.status == 'true'){
                    alert(data.message);
                    // jQuery('#t_email').after("<span id='email_error'>"+data.message+"</span>");
                    jQuery('#email_error').text(data.message);
                    jQuery('#t_email').attr('data','false');
                } else {
                    jQuery('#email_error').text('');
                    jQuery('#t_email').attr('data','true');
                    jQuery('#create_tenant_button').attr("disabled", false);
                }
            }
        });
    });
    jQuery('#create_tenant_form').submit(function(e){
        e.preventDefault();
        // if(jQuery('#t_email').attr('data') == 'false'){
        //     // return false;
        // } else {
            // jQuery('#create_tenant_button').attr("disabled", true);
            jQuery.ajax({
                url: "{{ url('/create-contract-tenant') }}",
                type: "POST",  
                data: {'_token':'<?php echo csrf_token() ?>','data':jQuery( "#create_tenant_form" ).serialize()},
                success: function(data){
                    if(data.status == 'true'){
                        toastr.success("Tenant Create Successfully");
                        jQuery('#create_tenant_form input').val('');
                        jQuery('.close').trigger('click');
                        var count = $(".selected-tenant option").length;
                        count = +count + 1;
                        html = '<li class=""><label for="ms-opt-'+count+'" style="padding-left: 9px;"><input type="checkbox" value="'+data.id+'" title="'+data.name+'" id="ms-opt-'+count+'">'+data.name+'('+data.email+')</label></li>';
                        jQuery(".ms-options-wrap ul").append(html);

                        jQuery('#selected_tenant').append('<option value="'+data.id+'">'+data.name+'('+data.email+')</option>');
                    } else {
                        jQuery('#email_error').text('Allready Exist!');
                        // jQuery('#t_email').after("<span id='email_error'>Allready Exist!</span>");
                    }
                }
            });
        // }
    });

</script>
<script type="text/javascript">
    // jQuery('.choose_guarantor_main input').click(function(){
    //     if($('#choose_guarantor_no').is(':checked')) { 
    //         $('#select_tenant').show();
    //         $('#new_tenant').hide();
    //     } else {
    //         $('#new_tenant').show();
    //         $('#select_tenant').hide();
    //     }
    // });

    jQuery('.multiple_tenant_main input').click(function(){
        if($('#multiple_tenant_yes').is(':checked')) { 
            $('#multiple_tenant_div').show();
        } else {
            $('#multiple_tenant_div').hide();
        }
    });

    jQuery(document).ready(function() {
        jQuery('#selected_tenant').multiselect({
            columns: 1,
            placeholder: 'Select Tenant',
            search: true,
            searchOptions: {
                'default': 'Search Tenant'
            },
            showCheckbox: false,
        });
    });
</script>
<style type="text/css">
    .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
    .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
    .unit_number {font-size: 18px; }
    .unit-body span { font-weight: bold;  }
    .unit {padding: 5px 0; }
    .top-nevigation {padding-bottom: 25px; }
    ul.nav.nav-tabs {border: 0; }
    .top-nevigation li {border: 0 !important; padding: 0 6px; }
    .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    .add-unit-main {text-align: right; } 
    .unit-delete span {color: #000000bd; position: relative; float: right; }
    .gender_class input {width: 8%; display: inline-block; height: 17px; border: 0; box-shadow: none; margin: 0 10px; }
    .tenent-title {font-size: 24px; }
    ul.nav.nav-pills.nav-justified li {background-color: bisque; }
    ul.nav.nav-pills.nav-justified a {color: black; }
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {background-color: #f28401;     color: #fff !important;}
    ul.nav.nav-pills.nav-justified {margin-top: 20px; }
    #create_company_form{display: none;}
    .add-unit-main, .tenent-title {padding: 15px 0; }
    .checked { color: orange; }
    .not_found {padding: 20px 0; }
    /*.select2.select2-container.select2-container--default {
        width: 100% !important;
    }*/
</style>
@endsection