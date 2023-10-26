@section('title','Register Membership')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Register Membership'])
<div class="container register-membership">
    <div class="row justify-content-center membership-form">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Create Propery Owner Account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/membership-checkout') }}" id="register_membership_form">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" data-valid12="false" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div class="email-validate-erorr"></div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="membership" class="col-md-4 col-form-label text-md-right">{{ __('Selected Plan') }}</label>

                            <div class="col-md-6">
                                <select name="plan_id" id="choose_membership" class="form-control @error('plan_id') is-invalid @enderror" value="{{ old('plan_id') }}" required autocomplete="plan_id">
                                    @foreach($plans as $plan) 
                                        @if ($plan->status == 1 && ($plan->id == $selectedPlan->id) ) 
                                            <option value="{{ $plan->id }}" selected>{{ $plan->title }}</option>
                                        @endif 
                                    @endforeach 
                                </select>

                                @error('plan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- <div class="form-group row mb-0"> -->
                        <div class="form-group row submit">
                            <!-- <div class="col-md-6 offset-md-4"> -->
                                <div class="col-md-12">
                                <!-- <button type="submit" class="btn btn-primary">
                                    Pay <span id="selected_plan_price"></span> with <img src="{{url('images/Paypal-button.png')}}">
                                </button>
 -->                                <button type="submit" class="btn btn-primary">
                                    Pay <span id="selected_plan_price">{{ App\Helpers\Helper::CURRENCYSYMBAL.$selectedPlan->price }}</span>
                                </button>
                                <div class="back_button">Back</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<style type="text/css">
    .register-membership .form-group.row.submit button {background-color: white; border: 2px solid #f48400;     color: #fff; }
    .register-membership .form-group.row.submit button img {width: 70px; }
    .form-group.row.submit button { width: auto; }
    .plans-body {background-color: #ff8500; text-align: center; padding: 15px; color: #fff; }
    .plans-title {font-size: 20px; }
    .plans-main {border: 1px solid #ff8500; border-radius: 5px; margin: 15px 0; min-height: 360px; }
    .plans-footer {text-align: center; }
    .plans-footer li {list-style: none; padding: 5px 0; text-align: center; border-bottom: 1px solid #ff850085; }
    .plans-footer ul {margin: 0; padding: 0; }
    .plans-footer a {text-decoration: none; padding: 6px 26px; width: 140px; font-size: 16px; background-color: #3AB02B; color: #fff; border-radius: 5px; border: 0; display: block; margin: 15px auto; }
    .plans-price span {font-size: 50px; }
    /*.membership-form {display: none; }*/
    .membership-plans {margin-bottom: 50px; }
     select#choose_membership {pointer-events: none; }
    .back_button { padding: 8px 0; cursor: pointer; }
    .form-group.row.submit button {font-size: 15px; }
    .email-validate-erorr {color: red; }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.membership-plans .plans-footer button').click(function(){
           $('.membership-plans').fadeOut('3000');
           $('.membership-form').fadeIn('3000');
           $('#choose_membership').val($(this).attr('data'));
           //$('#selected_plan_price').text("{{ App\Helpers\Helper::CURRENCYSYMBAL }}");
        });

        $('.back_button').click(function(){
           $('.membership-plans').fadeIn('3000');
           $('.membership-form').fadeOut('3000');
        });
        $('#email').blur(function(){
            $('#register_membership_form button').prop('disabled','true');
            $.ajax({
                url: "{{ url('/verify-membership-email') }}",
                type: "POST",
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'email':$('#email').val()
                },
                success: function(data){
                   if(data.email){
                        $('#email').attr('data-valid12',false);
                        $('.email-validate-erorr').text(data.email);
                   }
                   if(data.success){
                        $('#email').attr('data-valid12',true);
                        $('.email-validate-erorr').text('');
                        $('#register_membership_form button').prop('disabled',false);
                   }
                }
            });
        });
        $('#register_membership_form').submit(function(){
            if( $('#email').attr('data-valid12') != 'true' ) {
                return false;
            }
        });
    });
    $('#register_membership_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{
            email:{
                required:true,
                email:true,
            },
            name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            password:{
                required:true,
                minlength: 8,
            },
            password_confirmation:{
                required:true,
                minlength: 8,
            },
        }      
    });
</script>
@endsection
    