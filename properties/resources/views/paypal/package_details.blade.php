@extends('layouts.main')
@section('content')
<style type="text/css">
.column:first-child, .columns:first-child {
    margin-left: 0;
}
.eleven {
    width: 100%;
}
.column, .columns {
    margin-left: 4.4%;
    float: left;
    min-height: 1px;
    position: relative;
}
.listings-container {
    opacity: 1;
    transition: all 0.3s;
}
.listing-title {
    color: #000;
}

.jobdetailsrt {
    background: #eef7fc;
}
span.pridetail {
    font-size: 30px;
    color: #28a745;
    text-transform: none;
    font-size: 30px;
    line-height: 40px;
}
a {
    color: #EB5A1D;
    cursor: pointer;
}
.paypal-button {
    padding: 15px 30px;
    border: 1px solid #FF9933;
    border-radius: 5px;
    background-image: linear-gradient(#fff0a8, #f9b421);
    margin: 0 auto;
    display: block;
    min-width: 138px;
    position: relative;
}
</style>
   <!--  <div class="container">
        @if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>
        @endif

        @if ($message = Session::get('error'))
        <div class="w3-panel w3-red w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
    				class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('error');?>
        @endif

    	<form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
          action="{!! URL::to('paypal') !!}">
    	  <div class="w3-container w3-teal w3-padding-16">Paywith Paypal</div>
    	  {{ csrf_field() }}
    	  <h2 class="w3-text-blue">Payment Form</h2>
    	  <p>Demo PayPal form - Integrating paypal in laravel</p>
    	  <label class="w3-text-blue"><b>Enter Amount</b></label>
    	  <input class="w3-input w3-border" id="amount" type="text" name="amount"></p>
    	  <button class="w3-btn w3-blue">Pay with PayPal</button>
    	</form>
    </div> -->

<div class="container">
    <div class="row">
      <div class="col-md-12 homecontent">

      <div class="">
              <h3 class="headh2 text-center h3-heading">Packages Payment</h3>
              {{$packages}}
            <div class="">
             
              <div class="col-md-12 ">
        
        <!-- Recent Jobs -->
        <div class="findjobstop eleven columns">
        <div class="padding-right">
            <div class="listings-container">
                <div class="listing-title">
                                    
                    <div class="col-lg-4 column jobdetailsrt">
                                <span class="pridetail"> Monthly Package for 10 bids for $40 |  Price : $40 </span>
                                    <div class="display-td">  
        <!-- PayPal Logo -->
        <table cellspacing="0" cellpadding="10" border="0" align="center">
            <tbody><tr>
                <td align="center"></td>
            </tr>
            <tr>
                <td align="center">
                    <a href="" title="How PayPal Works">
                    <img src="https://safetyengagement.com/assets/images/logo-center-solution-graphics.png" alt="PayPal Acceptance Mark" border="0">
                    </a>
                </td>
            </tr>
        </tbody></table>
        <!-- PayPal Logo -->
            <div class="col-md-12">
                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="col-md-6 active">
                                <a href="#tab_default_1" data-toggle="tab">
                                    <img src="https://safetyengagement.com/assets/images/paypal.png " width="100%"></a>
                            </li>
                            <!-- <li class="col-md-6">
                                <a href="#tab_default_2" data-toggle="tab">
                                    <img src="https://safetyengagement.com/assets/images/stripe.png " width="100%"> </a>
                            </li> -->
                        </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_default_1">
                    <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
                      action="{!! URL::to('paypal') !!}">
                    {{ csrf_field() }}
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="surajbansalvision-seller@gmail.com">  
                    <input type="hidden" name="amount" id="amount" value="{{$packages->price}}">
                    <input type="hidden" name="currency_code" id="currency_code" value="USD">
                    <input type="hidden" name="notify_url" value="https://safetyengagement.com/home/notificationPayment">
                    <!-- <input type="hidden" name="pro_pid" value="0" class="stlr_stripe_student_id"> -->
                    <input type="hidden" name="cancel_return" value="{!! URL::to('membership') !!}">
                    <input type="hidden" name="return" value="{!! URL::to('membership') !!}">
                    <input type="hidden" name="rm" value="2">
                    <input type="hidden" name="custom" id="custom" value="{{$packages->id}}">
                    <input type="hidden" name="item_name" id="item_name" value="{{$packages->name}}">
                    <button type="submit" class="paypal-button"><span class="paypal-button-title"> Buy now with </span><span class="paypal-logo"><i>Pay</i><i>Pal</i></span></button>
                    </form>

                </div>
                <div class="tab-pane" id="tab_default_2">
                    <!-- <form action="https://safetyengagement.com/bids/stripe_payment" method="POST" id="paymentFrm" class="stlr_stripe_form form-horizontal">
                        
                        <input type="hidden" name="payment_type" id="item_name" value ="1">

                        <div class="stripe_payment" id='stripe_payment'  >
                            <div class="form-group">
                                    <label class="col-sm-4 control-label">Card Number</label>
                                <div class="col-sm-8">
                                    <input type="text" name="card_num" size="20" autocomplete="off" class="card-number form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-4 control-label">CVC</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cvc" size="4" autocomplete="off" class="card-cvc form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-4 control-label">Expiration (MM/YYYY)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="exp_month" size="2" class="card-expiry-month stlr_expiry_month" maxlength="2"/>
                                    <span> / </span>
                                    <input type="text" name="exp_year" size="4" class="card-expiry-year stlr_expiry_year" maxlength="4"/>
                                </div>
                            </div>
                                <input type="hidden" name="pro_id" value="6" class="stlr_stripe_student_id">
                                <input type="hidden" name="pro_amt" value="40" class="stlr_stripe_student_id">
                                <input type="hidden" name="pro_pid" value="0" class="stlr_stripe_student_id">
                            <div class="payment-errors" style="color: red;"></div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8 stripe-center">
                                    <input type="submit" id="payBtn" value="Submit" class="btn btn-info" />        
                                </div>
                            </div>
                        </div>
                    </form> -->

                    <!-- data-image="https://safetyengagement.com/assets/img/iconsSE.png" // your company Logo -->
                    <script src="https://js.stripe.com/v3/"></script>
                        <form action="https://safetyengagement.com/bids/stripe_payment" method="POST">
                          <script src="https://checkout.stripe.com/checkout.js" class="stripe-button active" data-key="pk_test_RMtAHpIC9JbDxQB4z4JXGPoD00hIRIexbr" your="" publishable="" keys="" data-name="safetyengagement.com" data-description="Package Payment" data-amount="4000">
                          </script><button type="submit" class="stripe-button-el" style="visibility: visible;"><span style="display: block; min-height: 30px;">Pay with Card</span></button>
                          <input type="hidden" name="pro_id" value="6" class="stlr_stripe_student_id">
                                <input type="hidden" name="pro_amt" value="40" class="stlr_stripe_student_id">
                                <input type="hidden" name="pro_pid" value="0" class="stlr_stripe_student_id">
                        </form>
                </div>
            </div>
        </div>
    </div>

                </div>

                   
                                
                            </div>
                    </div><!-- Job Overview -->
      </div>
    </div>
            </div>
        </div>
        


    </div>
        </div>
          </div>
      </div> 
    </div>
</div> 
@endsection
@section('scripts')


@endsection

