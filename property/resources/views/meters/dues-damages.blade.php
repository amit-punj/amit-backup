@section('title','Dues & Damage')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Dues & Damage'])
<?php 
$role = Auth::user()->user_role; 
$meterPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'meter_permission');
?>
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
                        <div class="top-nevigation">
                            @include('dashboard.topnevigation')
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="add-unit-main">
                            @if($role == 2 )
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Meter <span class="glyphicon glyphicon-plus"></span></button>
                            @elseif($role == 3)
                                @if($meterPermission !=0 && $meterPermission !=1)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Meter <span class="glyphicon glyphicon-plus"></span></button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <form autocomplete="off" action="" method="POST" enctype="multipart/form-data" id="terminate_form2">
                        @csrf
                        <div class="well"> 
                            <input type="hidden" name="terminate_id" id="a_terminate_id" value=""> 
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Tenant Name') }}</label>
                                <div class="col-md-9">
                                    @if (Auth::guest())  
                                        <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
                                    @else
                                        <input id="name" type="text" class="form-control" readonly="" name="name" value="{{ Auth::user()->name}}" placeholder="jhon">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Tenant Email') }}</label>
                                <div class="col-md-9">
                                    @if (Auth::guest())  
                                        <input id="email" type="email" class="form-control"  name="email" value="" placeholder="jhon@gmail.com" status="false">
                                    @else
                                        <input id="email" type="email" class="form-control" readonly="" name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
                                    @endif
                                    <span id="email_varification_message"></span>
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>                                               
            </div>
        </div>
    </div> 
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/create-meter') }}" id="create_meter" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Meter</h3>
                    </div>
                    <div class="modal-body">
                         <div class="form-group row">
                            <label for="meter_type" class="col-md-4 col-form-label text-md-right">{{ __('Meter Type') }}</label>
                            <div class="col-md-6">
                                <select id="meter_type" type="text" class="form-control" name="meter_type" value="">
                                    <option value="electric_meter">Electricity Meter</option>
                                    <option value="water_meter">Water Meter</option>
                                    <option value="gas_meter">Gas Meter</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Per Unit Price') }}</label>
                            <div class="col-md-6">
                                <input id="unit_price" type="text" class="form-control" name="unit_price" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ean_number" class="col-md-4 col-form-label text-md-right">{{ __('EAN Number') }}</label>
                            <div class="col-md-6">
                                <input id="ean_number" type="text" class="form-control" name="ean_number" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meter_number" class="col-md-4 col-form-label text-md-right">{{ __('Meter Number') }}</label>
                            <div class="col-md-6">
                                <input id="meter_number" type="text" class="form-control" name="meter_number" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-success">Add Meter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>   
        jQuery('#create_meter').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                unit_id:{
                    required:true,
                },
                meter_type:{
                    required:true
                },
                unit_price:{
                    required:true,
                    number:true
                },
                ean_number:{
                    required:true
                }, 
                meter_number:{
                    required:true
                }
            }      
        }); 
        jQuery(document).ready(function(){
            jQuery('a.delete').click(function(e){
                e.preventDefault();
               var href      = jQuery(this).attr('href');
               var result = confirm("Want to Delete meter?");
               if (result) {
                   window.location = href;
               }
            }); 
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
        .unit-delete span {color: #000000bd; position: relative; float: right; }
        .building-body{border: 1px solid #f28401; padding: 15px; margin: 15px 0;}
        .building-title {font-size: 33px; font-weight: normal; text-align: center; }
        .not_found {margin-bottom: 50px; }
        </style>
@endsection