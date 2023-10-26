@section('title','Edit Bank Account')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Edit Bank Account'])
        <div class="container edit-profile-page">
            <div class="row">
                <div class="col-md-1">
                    {{--@include('dashboard.sidebar') --}}
                </div>
                <div class="col-md-10">
                    <!-- <div class="profile-page-title">Edit Profile</div>    -->                                              
                    <!-------------->
                    <div class="register-page">
                        <div class="row justify-content-center">
                            <!-- <div class="col-md-3"></div> -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">{{ __('Edit your Bank Account') }}</div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ url('/update-bank-account') }}" enctype="multipart/form-data" id="edit_bank_account_form">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="hidden" name="user_role" value="{{ $user->user_role }}">
                                            <div class="form-group row">
                                                <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>
                                                <div class="col-md-6">
                                                    @if($account_info)
                                                    <input id="bank_name" type="text" class="form-control"  name="bank_name" value="{{ $account_info->bank_name }}" placeholder="Bank Name">
                                                    @else
                                                    <input id="bank_name" type="text" class="form-control"  name="bank_name" value="" placeholder="Bank Name">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="ada_number" class="col-md-4 col-form-label text-md-right">{{ __('ADA Number') }}</label>
                                                <div class="col-md-6">
                                                    @if($account_info)
                                                    <input id="ada_number" type="text" class="form-control"  name="ada_number" value="{{ $account_info->ada_number }}" placeholder="ADA Number">
                                                    @else
                                                    <input id="ada_number" type="text" class="form-control"  name="ada_number" value="" placeholder="ADA Number">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>
                                                <div class="col-md-6">
                                                    @if($account_info)
                                                    <input id="account_number" type="text" class="form-control"  name="account_number" value="{{ $account_info->account_number }}" placeholder="Account Number">
                                                    @else
                                                    <input id="account_number" type="text" class="form-control"  name="account_number" value="" placeholder="Account Number">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="routing_number" class="col-md-4 col-form-label text-md-right">{{ __('Routing Number') }}</label>
                                                <div class="col-md-6">
                                                    @if($account_info)
                                                    <input id="routing_number" type="text" class="form-control"  name="routing_number" value="{{ $account_info->routing_number }}" placeholder="Routing Number">
                                                    @else
                                                    <input id="routing_number" type="text" class="form-control"  name="routing_number" value="" placeholder="Routing Number">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="paypal_email" class="col-md-4 col-form-label text-md-right">{{ __('Paypal Email') }}</label>
                                                <div class="col-md-6">
                                                    @if($account_info)
                                                    <input id="paypal_email" type="text" class="form-control"  name="paypal_email" value="{{ $account_info->paypal_email }}" placeholder="Paypal Email">
                                                    @else
                                                    <input id="paypal_email" type="text" class="form-control"  name="paypal_email" value="" placeholder="Paypal Email">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row submit">
                                                    <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------------->
                </div>
            </div>
        </div> 
        <style type="text/css">
            span.invalid-feedback {color: red; font-size: 11px; }
            .gender_class span {width: auto; float: left;     padding-top: 5px; }
            .gender_class input {width: 12%; float: left; height: 20px; display: inline-block; border: 0 !important; box-shadow: none; }
            .user-image img {    width: 120px;    border-radius: 50%;    height: 120px; }
            .card-body {padding: 15px; }
            span#send_otp, span#m_send_otp {background-color: #f48400; padding: 8px 4px; font-size: 13px; border-radius: 3px; position: absolute; cursor: pointer; color: #fff;}
            span#phone_number_error {color: red; }
        </style>
        <script type="text/javascript">
            jQuery('#edit_bank_account_form').validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    bank_name:{
                        required:true,
                    },
                    ada_number:{
                        required:true,
                    },
                    account_number:{
                        required:true,
                    },
                    routing_number:{
                        required:true,
                    }
                }      
            });
        </script>
@endsection