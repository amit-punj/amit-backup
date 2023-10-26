@extends('layouts.app')
@section('content')
    <div class="container main">
        <div class="row " style="justify-content: center;">
            <div class="col-md-8" >           
                <form method="post" action="{{ url('/send-message/'.$id) }}" id="update_unit_form">
                    @csrf
                    <input id="property_id" type="hidden" class="form-control" name="property_id" value="{{$id}}">
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-9
                        ">
                            <input class="form-control" name="name" type="text" value="{{old('name')}}" placeholder="Name">
                            @if ($errors->has('name'))
                                <span class="help-block" style="color: red;">
                                    <strong>{{ $errors->first('name') }} </strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_no" class="col-md-3 col-form-label text-md-right">{{ __('Phone') }}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="phone_no" value="{{old('phone_no')}}" id="phone_no" placeholder="Phone">
                            @if ($errors->has('phone_no'))
                                <span class="help-block" style="color: red;">
                                    <strong>{{ $errors->first('phone_no') }} </strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" value="{{old('email')}}" id="email" placeholder="Email" style="margin-bottom: 10px;">
                            <input type="hidden" name="new_user" value="{{old('new_user')}}" id="new_user">
                            @if ($errors->has('email'))
                                <span class="help-block"  style="color: red;">
                                    <strong>{{ $errors->first('email') }} </strong>
                                </span>
                            @endif
                            <span class="help-block" id="email_error" style="display: none;">
                            </span>
                        </div>
                    </div>
                    <div class="form-group row" id="email_section" style="display: none;">
                        <label for="email" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-9" id="email_section1" >
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="confirmation_code" name="confirmation_code" placeholder="Enter Token">
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn-success form-control" id="verify_email">Verify Email</button>
                            </div>
                            <span class="help-block" id="email_verify_error" style="display: none;">
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Message') }}</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="message" placeholder="Message">{{old('message')}}</textarea> 
                        </div>
                    </div>
                    <div class="form-group row" >
                        <div class="g-recaptcha" data-sitekey="AIzaSyDcVNyDwAZjU9iFVCgn9rby4kIdfYVC3Dg"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" disabled="" id="submit">Submit</button>
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
    </style>
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

        $(document).ready(function(){
            $('#email').blur(function()
            {
                var email = $('#email').val();
                if(email != "")
                {
                    $.ajax({
                        type:'POST',
                        url:'{{ url("check-user") }}',
                        data:{
                                "_token": "{{ csrf_token() }}",
                                email: email,
                            },
                        success:function(data) {
                        console.log(data.status);
                            if(data.status == 'error')
                            {
                                $('#email_error').show();
                                $('#email_error').text(data.data);
                                $('#email_error').css("color", "red");
                                $("#email_section").hide();
                                $('#new_user').val('yes');
                            }
                            else if(data.status == 'mail')
                            {
                                $('#email_error').show();
                                $('#email_error').text(data.data);
                                $('#email_error').css("color", "black");
                                $("#email_section").show();
                                $('#new_user').val('yes');
                            }
                            else if(data.status == 'success')
                            {
                                $('#submit').removeAttr('disabled');
                                $('#new_user').val('no');
                            }
                        }
                    });
                }
            });
            $('#verify_email').click(function()
            {
                var confirmation_code = $('#confirmation_code').val();
                var email = $('#email').val();
                if(confirmation_code != "")
                {
                    $.ajax({
                        type:'POST',
                        url:'{{ url("verify-email") }}',
                        data:{
                            "_token": "{{ csrf_token() }}",
                            email: email,
                            confirmation_code: confirmation_code,
                        },
                        success:function(data) {
                            console.log(data.status);
                            $('#email_verify_error').show();
                            $('#email_verify_error').text(data.data);
                            $('#email_verify_error').css("color", "black");
                            if(data.status == 'success')
                            {
                                $('#email').attr('readonly','readonly');
                                $('#submit').removeAttr('disabled');
                            }
                            else
                            {
                                $('#submit').attr('disabled','disabled');
                            }
                       }
                    });
                }
            });
        });

        
    </script>
@endsection