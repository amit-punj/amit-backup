@section('title','Register Membership')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Register Membership'])
<div class="container register-membership">
    <div class="row justify-content-center membership-plans">
        @foreach($plans as $plan) 
            @if ($plan->status == 1)                   
                <div class="col-md-4">
                    <div class="plans-main">
                        <div class="plans-body">
                            <div class="plans-title">{{ $plan->title }}</div>
                            <div class="plans-price">{{App\Helpers\Helper::CURRENCYSYMBAL}}<span>{{ $plan->price }}</span></div>
                            <div class="plans-discription">{{ substr($plan->short_description,0,80) }}</div>
                        </div>
                        <div class="plans-footer">
                            {!! $plan->features !!}
                            <!-- <button data-price="{{ $plan->price }}" data="{{ $plan->id }}">View Detail</button> -->
                            <a href="{{ url('/plan-detail/'.$plan->id) }}">View Detail</a>
                        </div>
                    </div>
                </div>
            @endif 
        @endforeach  
    </div> 
</div>
<style type="text/css">
    .register-membership .form-group.row.submit button {background-color: white; border: 2px solid #f48400;     color: #fff; }
    .register-membership .form-group.row.submit button img {width: 70px; }
    .form-group.row.submit button { width: auto; }
    .plans-body {background-color: #ff8500; text-align: center; padding: 15px; color: #fff; }
    .plans-title {font-size: 20px; }
    .plans-main {border: 1px solid #ff8500; border-radius: 5px; margin: 15px 0; min-height: 360px; }
    .plans-footer {text-align: center;     padding: 5px 8px;}
    .plans-footer li {list-style: none; padding: 5px 0; text-align: center; border-bottom: 1px solid #ff850085; }
    .plans-footer ul {margin: 0; padding: 0; }
    .plans-footer a {text-decoration: none; padding: 6px 26px; width: 140px; font-size: 16px; background-color: #3AB02B; color: #fff; border-radius: 5px; border: 0; display: block; margin: 15px auto; }
    .plans-price span {font-size: 50px; }
    .membership-form {display: none; }
    .membership-plans {margin-bottom: 50px; }
     select#choose_membership {pointer-events: none; }
    .back_button { padding: 8px 0; cursor: pointer; }
    .form-group.row.submit button {font-size: 15px; }
    .email-validate-erorr {color: red; }
</style>
@endsection
    