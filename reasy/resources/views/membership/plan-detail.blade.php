@section('title','Plan Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Plan Details'])
    <div class="container profile-page">
        <div class="row">
            <div class="col-sm-12">
                <div class="plan_body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="plan_detail">{{ $planDetail->title}}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="plan_price">{{ App\Helpers\Helper::CURRENCYSYMBAL.$planDetail->price}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="title">Features</div>
                            <div class="plan_feature">{!! $planDetail->features !!}</div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="plan_register">
                                <a href="{{ url('/register-membership/'.$planDetail->id) }}">Register Membership</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title">Description</div>
                            <div class="plan_description">{!! $planDetail->description !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .plan_detail { font-size: 30px;}
        .plan_price {text-align: right; font-size: 24px; }
        .title {font-size: 24px; margin-top: 20px; }
        .plan_feature li:before {content: '✔'; color: #ff8500; padding-right: 5px; }
        .plan_feature li {list-style: none; }
        .plan_feature {padding-top: 15px; }
        .plan_register a {text-decoration: none; padding: 6px 26px; width: 140px; font-size: 16px; background-color: #3AB02B; color: #fff; border-radius: 5px; border: 0; }
        .plan_register {text-align: right; margin-top: 70px; }
        .plan_description { text-align: justify; }
    </style>
@endsection