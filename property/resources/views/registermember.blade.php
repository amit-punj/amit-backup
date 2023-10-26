@extends('layouts.app')

@section('content')
@include('layouts.banner')
<div class="container register-membership">
    <div class="row justify-content-center membership-plans">
        @foreach($plans as $plan) 
            @if ($plan->status == 1)                   
                <div class="col-md-4">
                    <div class="plans-main">
                        <div class="plans-body">
                            <div class="plans-title">{{ $plan->title }}</div>
                            <div class="plans-price">USD<span>{{ $plan->price }}</span></div>
                            <div class="plans-discription">{{ $plan->short_description }}</div>
                        </div>
                        <div class="plans-footer">
                            {!! $plan->description !!}
                            <button data="{{ $plan->id }}">Select</button>
                        </div>
                    </div>
                </div>
            @endif 
        @endforeach  
    </div>
    <div class="row justify-content-center membership-form">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Create Propery Manager Account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/paypal') }}" id="register_membership_form">
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                        @if ($plan->status == 1)                   
                                            <option value="{{ $plan->id }}">{{ $plan->title }}</option>
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
                                <button type="submit" class="btn btn-primary">
                                    Pay with <img src="{{url('images/Paypal-button.png')}}">
                                </button>
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
    .register-membership .form-group.row.submit button {background-color: white; border: 2px solid #f48400;     color: inherit; }
    .register-membership .form-group.row.submit button img {width: 120px; }
    .form-group.row.submit button { width: auto; }
    .plans-body {background-color: #ff8500; text-align: center; padding: 15px; color: #fff; }
    .plans-title {font-size: 20px; }
    .plans-main {border: 1px solid #ff8500; border-radius: 5px; }
    .plans-footer {text-align: center; }
    .plans-footer li {list-style: none; padding: 5px 0; text-align: center; border-bottom: 1px solid #ff850085; }
    .plans-footer ul {margin: 0; padding: 0; }
    .plans-footer button {text-decoration: none; padding: 6px 26px; width: 140px; font-size: 16px; background-color: #3AB02B; color: #fff; border-radius: 5px; border: 0; margin: 15px 0; }
    .plans-price span {font-size: 50px; }
    .membership-form {display: none; }
    .membership-plans {margin-bottom: 50px; }
     select#choose_membership {pointer-events: none; }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.membership-plans .plans-footer button').click(function(){
           $('.membership-plans').fadeOut('3000');
           $('.membership-form').fadeIn('3000');
           $('#choose_membership').val($(this).attr('data'));
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
    