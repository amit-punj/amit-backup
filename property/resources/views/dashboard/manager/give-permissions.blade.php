@section('title','Permissions')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Permissions'])
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
                    <div class="col-md-3">
                        <div class="dashboard-sidebar">
                            <?php $role = Auth::user()->user_role; ?>
                            <ul>
                                @if($role == 2)
                                  <li><a href="#">Property Manager</a></li>
                                  <li><a href="#">Legal Advisor</a></li>
                                  <li><a href="#">Property Description Experts</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form id="visit_booking">
                            @csrf
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Unit Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="unit_permission" value="read"> Read
                                    <input type="radio" name="unit_permission" value="write"> Write
                                    <input type="radio" name="unit_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Contract Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="contract_permission" value="read"> Read
                                    <input type="radio" name="contract_permission" value="write"> Write
                                    <input type="radio" name="contract_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Meter Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="meter_permission" value="read"> Read
                                    <input type="radio" name="meter_permission" value="write"> Write
                                    <input type="radio" name="meter_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Reading Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="reading_permission" value="read"> Read
                                    <input type="radio" name="reading_permission" value="write"> Write
                                    <input type="radio" name="reading_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Booking Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="booking_permission" value="read"> Read
                                    <input type="radio" name="booking_permission" value="write"> Write
                                    <input type="radio" name="booking_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Transaction Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="transaction_permission" value="read"> Read
                                    <input type="radio" name="transaction_permission" value="write"> Write
                                    <input type="radio" name="transaction_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Documents Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="document_permission" value="read"> Read
                                    <input type="radio" name="document_permission" value="write"> Write
                                    <input type="radio" name="document_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Tickets Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="ticket_permission" value="read"> Read
                                    <input type="radio" name="ticket_permission" value="write"> Write
                                    <input type="radio" name="ticket_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Legal Permissions') }}</label>
                                <div class="col-md-6" style="display: flex;">
                                    <input type="radio" name="legal_permission" value="read"> Read
                                    <input type="radio" name="legal_permission" value="write"> Write
                                    <input type="radio" name="legal_permission" value="full"> Full Access
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-9 text-center">
                                    <button type="submit" class="btn btn-success">Done Permissions</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <style type="text/css">
      .make_payment img {width: 100px; height: 35px; }
      .make_payment {margin: 0 auto; text-align: center; padding: 15px 0 30px; }
      .float-right { float: right; }
      input[type=radio] {  margin: 4px 0px 0 30px;}
    </style>
@endsection