@extends('layouts.app')
@section('content')
@include('layouts.banner')
        <div class="container purchasemembership">
            <div class="row">
                <div class="col-md-3">
                    @include('dashboard.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="profile-page-title">My Profile</div> 
                        @if ($message = Session::get('success'))
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php Session::forget('success');?>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="custom-alerts alert alert-danger fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php Session::forget('error');?>
                        @endif                                                
                    <!-------------->
                    <div class="register-page">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="payment-main">
                                    <div class="payment-main-title">One Month Membership</div>                                
                                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal') !!}" >
                                        {{ csrf_field() }}
                                        <input id="amount" type="hidden" class="form-control" name="membership" value="1M" autofocus>
                                        <button type="submit" class="btn btn-success">Pay $20 with <img src="{{url('images/Paypal-button.png')}}"></button>
                                    </form> 
                                </div>
                            </div>  
                             <div class="col-md-4">
                                <div class="payment-main">
                                    <div class="payment-main-title">One Month Membership</div>                                
                                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal') !!}" >
                                        {{ csrf_field() }}
                                        <input id="amount" type="hidden" class="form-control" name="membership" value="2M" autofocus>
                                        <button type="submit" class="btn btn-success">Pay $35 with <img src="{{url('images/Paypal-button.png')}}"></button>
                                    </form> 
                                </div>
                            </div>                                                
                        </div>
                    </div>
                    <!-------------->
                </div>
            </div>
        </div> 
@endsection