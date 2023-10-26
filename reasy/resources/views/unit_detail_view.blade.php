@extends('layouts.app')
@section('content')
<div class="container main">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        <div class="row">
            <div  class="col-sm-6">
                <?php $url = '/images/'.$data->cover_image; ?>
                <!-- <img src="{{ url($url) }}" style="width:100%;"> -->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        // echo "<pre>";
                        //     print_r($images);
                        //     die('hhh');
                         ?>
                        @if(count($images) > 0)
                            @foreach($images as $key=>$image)
                                @if($key == 0)
                                    <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="active"></li>
                                @else
                                    <li data-target="#myCarousel" data-slide-to="{{ $key }}"></li>
                                 @endif
                            @endforeach
                        @endif
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="{{ url($url) }}" style="width:100%;">
                        </div>
                        @if(count($images) > 0)
                            @foreach($images as $key=>$image)
                                <div class="item">
                                    <img src="{{ url('/images/property_images/'.$image) }}" style="width:100%;">
                                </div>
                            @endforeach
                        @endif   
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div> 
                <div class="carousel" style="margin: 10px;">
                    <div class="col-md-4">
                        <img src="{{ url($url) }}" style="width:100%;">
                    </div>
                    @if(count($images) > 0)
                        @foreach($images as $key=>$image)
                            <div class="col-md-4">
                                <img src="{{ url('/images/property_images/'.$image) }}" style="width:100%;">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div  class="col-sm-6">
                <div class="property_description">
                    <div class="title">{{ $units->unit_name}}</div>
                    <div class="property_description-body">
                        <!--<div class="Rent"><span>Rent:</span>USD {{$data->rent}}</div>
                        <div class="deposit"><span>Deposit:</span>USD {{$data->deposite}}</div> -->
                        <div class="location"><span>Address:</span>{{$data->location}}</div>
                    </div>     
                </div>
                <div class="f30 f400 my-3">Rent</div>
                <div class="title">
                     {{$units->rent}}
                </div>
                <div class="f30 f400 my-3">deposit</div>
                <div class="title">
                     {{$units->deposit}}
                </div>

                 <?php 
                 if(isset($units->amenities))
                 {
                 $explode = explode(',', $units->amenities);
                 ?>
                    <div class="row bg-color f15 f300">
                    <div class="col-md-12">
                        <span  class="f30 f400  my-3">Amenities</span>
                    </div>
                                @foreach($amenities as $key => $value)
                                 <?php if(in_array($value->id, $explode)){ ?>
                                  <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 " style="display: flex;">
                                       <label style="color: #333;font-size: 14px;">
                                       <i class="fas fa-check-circle" style="color: green;"> </i>  
                                       {{$value->amenities_name}}
                                       </label>
                                  </div>
                                <?php
                                 } 
                                 ?>
                                @endforeach
                    </div> 
                <?php } ?>     
                <div class="row my-4 property_description">
                    <div class="col-md-12">
                    <div class="f30 f400 my-2">Description </div>
                        <p class="color-gray">This is a nice cool room with a good view close to a shopping center</p>
                    </div>
                    <div class="property-action">  

                        <div class="col-md-3" style="margin: 10px;">
                            <button data-toggle="modal" data-target="#book_visit">Book Visit</button>
                        </div>
                        <div class="col-md-3" style="margin: 10px;">
                            <button data-toggle="modal" data-target="#updateModel">Book Property Now</button>
                        </div>
                        <div class="col-md-3" style="margin: 10px;">
                            <!-- <button data-toggle="modal" data-target="#send-message">Send Message</button> -->
                            <a href="{{ url('/send-message/'.$data->id) }}" target="_blank"><button data-toggle="modal" data-target="#updateModel">Send Message</button></a>
                        </div>
                    </div>
                </div>
            </div>
             <div class="img" style="margin-top: 2%;">
                    	<img src="{{ asset('images/map.png')}}">
                    </div>
        </div>
    </div>

    <div class="modal fade" id="book_visit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/create-visit') }}" id="visit_booking">
                    @csrf
                    <input id="property_id" type="hidden" class="form-control" name="property_id" value="{{$data->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Book Visit</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Visitor Name') }}</label>
                            <div class="col-md-9">
                                @if (Auth::guest())  
                                    <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
                                @else
                                    <input id="name" type="text" class="form-control"  name="name" value="{{ Auth::user()->name}}" placeholder="jhon">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                @if (Auth::guest())  
                                    <input id="email" type="email" class="form-control"  name="email" value="" placeholder="jhon@gmail.com" status="false">
                                @else
                                    <input id="email" type="email" class="form-control"  name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
                                @endif
                                <span id="email_varification_message"></span>
                            </div>
                            <div class="col-md-3">
                                <span id="email_confirmation_message"></span>
                            </div>
                        </div> 
                        <div class="form-group row" id="Email_confirmation">
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
                            <div class="col-md-4">
                                <input id="phone_number" type="text" class="form-control"  name="phone_number" value="" placeholder="+911234567890" status="false">
                                <span id="phone_number_error"></span>
                            </div>
                            <div class="col-md-2">
                                <span id="send_otp" class="">Send OTP</span>
                            </div>
                            <div class="col-md-3">
                                <span id="confirmation_message"></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="enter_otp" class="col-md-3 col-form-label text-md-right">{{ __('Enter OTP') }}</label>
                            <div class="col-md-4">
                                <input id="enter_otp" type="text" class="form-control"  name="enter_otp" value="" placeholder="Enter OTP">
                            </div>
                            <div class="col-md-3">
                                <span id="otp_confirmation_message"></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime') }}</label>
                            <div class="col-md-9
                            ">
                               <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" name="time" type="text" value="" readonly >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control"  name="title" value="" placeholder="Enter Title">
                            </div>
                           
                        </div> 
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" placeholder="Description"></textarea> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="send-message" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/create-visit') }}" id="update_unit_form">
                    @csrf
                    <input id="property_id" type="hidden" class="form-control" name="property_id" value="{{$data->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Book Visit</h3>
                    </div>
                    <div class="modal-body">
                    <!--<div class="form-group row">
                            <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-6">
                                <input id="visit_date" type="date" class="form-control"  value="">
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime') }}</label>
                            <div class="col-md-9
                            ">
                               <div class="input-group date form_datetime" id="form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" name="time" type="text" value="" readonly >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" placeholder="Description"></textarea> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style type="text/css">
        .property_images img {width: 250px; }
        .property_description .title {font-size: 20px; font-weight: bold; color: #ff8500; }
        .property_description-body span {font-size: 16px; font-weight: bold; padding-right: 10px; }
        .property_description-body {margin: 20px 10px; }
        .property_description-body div {padding: 5px 0; }
        .property-action {text-align: center; }
        .property-action button {text-decoration: none; padding: 10px 39px; width: 200px; font-size: 14px; background-color: #f28401; color: #fff; border-radius: 5px; border: 0; }
        .main { margin-bottom: 10%; }
        .mb-3, .my-3 { margin-bottom: 1rem !important; }
        .mt-3, .my-3 { margin-top: 1rem !important;}
        .f400 { font-weight: 400 !important; }
        .f30 { font-size: 30px !important; }
        .color-gray { color: rgba(0, 0, 0, 0.6) !important; }
        .f500 {    font-weight: 500 !important; }
        .mb-4, .my-4 {    margin-bottom: 1.5rem!important; }
        .f500 {    font-weight: 500 !important; }
        .mt-4, .my-4 {    margin-top: 1.5rem!important;}
        .bg-color {    background-color: #f1f1f1 !important;}
        .row { display: flex;flex-wrap: wrap;margin-right: -15px;margin-left: -15px; }
        .f300 { font-weight: 300 !important;}
        .f15 { font-size: 15px !important; }
        .mb-2, .my-2 { margin-bottom: .5rem!important; }
        .mt-2, .my-2 {   margin-top: .5rem!important; }
        span#send_otp {background-color: #DDDDDD; padding: 8px 4px; font-size: 13px; border-radius: 3px; position: absolute; cursor: pointer; }
        span#phone_number_error {color: red; }
        #Email_confirmation{display:none;}
    </style>

@endsection