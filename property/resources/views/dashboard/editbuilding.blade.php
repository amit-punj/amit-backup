@section('title','Edit Building')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Edit Building'])
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
                    <div class="col-sm-12">
                        <div class="top-nevigation">
                            @include('dashboard.topnevigation')
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        @include('dashboard..propertyform.form')
                    </div>
                </div>                                                   
            </div>
        </div>
    </div> 
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