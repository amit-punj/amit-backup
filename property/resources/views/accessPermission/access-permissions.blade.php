@section('title','Access Permissions')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Access Permissions'])
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
                    <div class="col-sm-12 top-nevigation">
                        <ul class="nav nav-tabs" style="margin-left: -6px;">
                            <li class="active"><a data-toggle="tab" href="#pm_tab">Property Manager</a></li>
                            <li><a data-toggle="tab" href="#pde_tsb">Property Description Expert</a></li>
                            <li><a data-toggle="tab" href="#lad_tab">Legal Advisor</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="pm_tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <form id="pm_access_permission" action="{{ url('/access-permission') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_role" value="3">
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Unit Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="unit_permission" value="0"> Read
                                                    <input type="radio" name="unit_permission" value="1"> Write
                                                    <input type="radio" name="unit_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Contract Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="contract_permission" value="0"> Read
                                                    <input type="radio" name="contract_permission" value="1"> Write
                                                    <input type="radio" name="contract_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Meter Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="meter_permission" value="0"> Read
                                                    <input type="radio" name="meter_permission" value="1"> Write
                                                    <input type="radio" name="meter_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Reading Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="reading_permission" value="0"> Read
                                                    <input type="radio" name="reading_permission" value="1"> Write
                                                    <input type="radio" name="reading_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Booking Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="booking_permission" value="0"> Read
                                                    <input type="radio" name="booking_permission" value="1"> Write
                                                    <input type="radio" name="booking_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Transaction Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="transaction_permission" value="0"> Read
                                                    <input type="radio" name="transaction_permission" value="1"> Write
                                                    <input type="radio" name="transaction_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Documents Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="documents_permission" value="0"> Read
                                                    <input type="radio" name="documents_permission" value="1"> Write
                                                    <input type="radio" name="documents_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Tickets Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="tickets_permission" value="0"> Read
                                                    <input type="radio" name="tickets_permission" value="1"> Write
                                                    <input type="radio" name="tickets_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Legal Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="legal_permission" value="0"> Read
                                                    <input type="radio" name="legal_permission" value="1"> Write
                                                    <input type="radio" name="legal_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-md-9 text-center">
                                                    <button type="submit" class="btn btn-success">Save Permissions</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="pde_tsb" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <form id="pde_access_permission" action="{{ url('/access-permission') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_role" value="4">
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Unit Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="unit_permission" value="0"> Read
                                                    <!-- <input type="radio" name="unit_permission" value="1"> Write
                                                    <input type="radio" name="unit_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row" style="display:none">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Contract Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="contract_permission" value="0"> Read
                                                    <input type="radio" name="contract_permission" value="1"> Write
                                                    <input type="radio" name="contract_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Meter Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="meter_permission" value="0"> Read
                                                    <input type="radio" name="meter_permission" value="1"> Write
                                                    <input type="radio" name="meter_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Reading Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="reading_permission" value="0"> Read
                                                    <input type="radio" name="reading_permission" value="1"> Write
                                                    <input type="radio" name="reading_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Booking Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="booking_permission" value="0"> Read
                                                    <input type="radio" name="booking_permission" value="1"> Write
                                                    <input type="radio" name="booking_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row" style="display:none">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Transaction Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="transaction_permission" value="0"> Read
                                                    <input type="radio" name="transaction_permission" value="1"> Write
                                                    <input type="radio" name="transaction_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Documents Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="documents_permission" value="0"> Read
                                                    <input type="radio" name="documents_permission" value="1"> Write
                                                    <input type="radio" name="documents_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row" style="display:none">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Tickets Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="tickets_permission" value="0"> Read
                                                    <input type="radio" name="tickets_permission" value="1"> Write
                                                    <input type="radio" name="tickets_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row" style="display:none">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Legal Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="legal_permission" value="0"> Read
                                                    <input type="radio" name="legal_permission" value="1"> Write
                                                    <input type="radio" name="legal_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-md-9 text-center">
                                                    <button type="submit" class="btn btn-success">Save Permissions</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="lad_tab" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <form id="lad_access_permission" action="{{ url('/access-permission') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_role" value="5">
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Unit Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="unit_permission" value="0"> Read
                                                    <!-- <input type="radio" name="unit_permission" value="1"> Write
                                                    <input type="radio" name="unit_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Contract Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="contract_permission" value="0"> Read
                                                   <!--  <input type="radio" name="contract_permission" value="1"> Write
                                                    <input type="radio" name="contract_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Meter Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="meter_permission" value="0"> Read
                                                    <!-- <input type="radio" name="meter_permission" value="1"> Write
                                                    <input type="radio" name="meter_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Reading Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="reading_permission" value="0"> Read
                                                    <!-- <input type="radio" name="reading_permission" value="1"> Write
                                                    <input type="radio" name="reading_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row" style="display:none">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Booking Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="booking_permission" value="0" checked> Read
                                                    <!-- <input type="radio" name="booking_permission" value="1"> Write
                                                    <input type="radio" name="booking_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Transaction Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="transaction_permission" value="0"> Read
                                                    <!-- <input type="radio" name="transaction_permission" value="1"> Write
                                                    <input type="radio" name="transaction_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Documents Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="documents_permission" value="0"> Read
                                                    <!-- <input type="radio" name="documents_permission" value="1"> Write
                                                    <input type="radio" name="documents_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Tickets Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="tickets_permission" value="0"> Read
                                                    <!-- <input type="radio" name="tickets_permission" value="1"> Write
                                                    <input type="radio" name="tickets_permission" value="2"> Full Access -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Legal Permissions') }}</label>
                                                <div class="col-md-6" style="display: flex;">
                                                    <input type="radio" name="legal_permission" value="0"> Read
                                                    <input type="radio" name="legal_permission" value="1"> Write
                                                    <input type="radio" name="legal_permission" value="2"> Full Access
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-md-9 text-center">
                                                    <button type="submit" class="btn btn-success">Save Permissions</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            @if($pmp)
            jQuery("#pm_tab input[name=unit_permission][value='{{$pmp->unit_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=contract_permission][value='{{$pmp->contract_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=meter_permission][value='{{$pmp->meter_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=reading_permission][value='{{$pmp->reading_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=booking_permission][value='{{$pmp->booking_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=transaction_permission][value='{{$pmp->transactio_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=documents_permission][value='{{$pmp->documents_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=tickets_permission][value='{{$pmp->tickets_permission}}']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=legal_permission][value='{{$pmp->legal_permission}}']").attr('checked', 'checked');
            @else
            jQuery("#pm_tab input[name=unit_permission][value='2']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=contract_permission][value='0']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=meter_permission][value='2']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=reading_permission][value='2']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=booking_permission][value='2']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=transaction_permission][value='0']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=documents_permission][value='2']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=tickets_permission][value='1']").attr('checked', 'checked');
            jQuery("#pm_tab input[name=legal_permission][value='0']").attr('checked', 'checked');
            @endif

            @if($pdep)
            jQuery("#pde_tsb input[name=unit_permission][value='{{$pdep->unit_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=contract_permission][value='{{$pdep->contract_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=meter_permission][value='{{$pdep->meter_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=reading_permission][value='{{$pdep->reading_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=booking_permission][value='{{$pdep->booking_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=transaction_permission][value='{{$pdep->transactio_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=documents_permission][value='{{$pdep->documents_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=tickets_permission][value='{{$pdep->tickets_permission}}']").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=legal_permission][value='{{$pdep->legal_permission}}']").attr('checked', 'checked');
            @else
            jQuery("#pde_tsb input[name=unit_permission][value=0]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=contract_permission][value=0]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=meter_permission][value=0]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=reading_permission][value=0]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=booking_permission][value=0]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=transaction_permission][value=0]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=documents_permission][value=2]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=tickets_permission][value=0]").attr('checked', 'checked');
            jQuery("#pde_tsb input[name=legal_permission][value=0]").attr('checked', 'checked');   
            @endif

            @if($lap)
            jQuery("#lad_tab input[name=unit_permission][value='{{$lap->unit_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=contract_permission][value='{{$lap->contract_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=meter_permission][value='{{$lap->meter_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=reading_permission][value='{{$lap->reading_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=booking_permission][value='{{$lap->booking_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=transaction_permission][value='{{$lap->transactio_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=documents_permission][value='{{$lap->documents_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=tickets_permission][value='{{$lap->tickets_permission}}']").attr('checked', 'checked');
            jQuery("#lad_tab input[name=legal_permission][value='{{$lap->legal_permission}}']").attr('checked', 'checked');
            @else
            jQuery("#lad_tab input[name=unit_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=contract_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=meter_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=reading_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=booking_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=transaction_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=documents_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=tickets_permission][value=0]").attr('checked', 'checked');
            jQuery("#lad_tab input[name=legal_permission][value=2]").attr('checked', 'checked');
            @endif
        });
    </script>
    <style type="text/css">
        .float-right { float: right; }
        input[type=radio] {  margin: 4px 0px 0 30px;}
        .top-nevigation {padding-bottom: 25px; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302 !important; color: #fff; }
        .top-nevigation a {border: 0 !important; }
        .nav-tabs {border-bottom: 0 !important; }
        .tab-content {padding: 20px 0; }
        .tab-pane {border: 1px solid #ccc; padding: 20px 0; }
    </style>
@endsection