@extends('layouts.app')

@section('content')
@include('layouts.banner')
<div class="container login-page">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if(session()->has('message'))
                  <div class="alert alert-success">
                      {{ session()->get('message') }}
                  </div>
            @endif
            <div class="card">
                <div class="card-header"><h3>{{ __('Please verify your email')}}</h3> </div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    {{ __('Once you verify your email address,')}} <br>
                    {{ __('You and your team can get started in Reasy.')}}
                    <div class="row" style="padding: 15px;">
                        <div class="col-md-12">
                            <div class="col-md-4"><a target="_blank" href="https://www.gmail.com" class="btn btn-default"><img width="20" height="20" src="{{url('images/gmail.png')}}"> Open Gmail</a></div>
                            <div class="col-md-4"><a target="_blank" href="https://outlook.live.com/owa/" class="btn btn-default"><img width="20" height="20" src="{{url('images/outlook.png')}}"> Open Outlook</a></div>
                            <div class="col-md-4"><a target="_blank" href="https://www.yahoo.com" class="btn btn-default"><img width="20" height="20" src="{{url('images/yahoo.jpeg')}}"> Open Yahoo</a></div>
                        </div>
                    </div>
                    <p>{{ __('Did not receive an email?')}} <a href="{{ route('verification.resend') }}">{{ __('click here') }}</a></p>
                </div>
            </div>
        </div>
         <div class="col-md-3"></div>
    </div>
</div>
<style type="text/css">
    .card-body {padding: 15px;padding-top: 0; text-align: center; }
</style>
@endsection
