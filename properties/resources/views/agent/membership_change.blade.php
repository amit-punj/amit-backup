@extends('layouts.main')
@section('content')
<style type="text/css">
.note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
 p {
    font-size: 14px;
}

.pkg_list {
    /*border-bottom: 2px solid #9c9c9c;*/
    border: 1px solid #595959;
    position: relative;
    float: left;
    max-width: 292px;
    width: 100%;
    cursor: pointer;
    box-sizing: border-box;
    z-index: 5;
    min-height: 180px;
    /*height: 270px;*/
    /*height: 500px;*/
    -moz-box-shadow: 0 5px 10px #9c9c9c;
    -webkit-box-shadow: 0 5px 10px #9c9c9c;
    -ms-box-shadow: 0 5px 10px #9c9c9c;
    box-shadow: 0 5px 10px #9c9c9c;
    margin-bottom: 15px;
    border-radius: 5px;
    color: #666;
}
.pkg_list:hover {
    background-color: #666;
    color: #fff;
}
.btndesign.button.margin-top-15:hover {
    background-color: #fff;
    color: #636363;
}
.pkg_heading {

    /*background: #28a745 none repeat scroll 0 0;*/
    box-sizing: border-box;
    height: 100px;
    /*color: #fff;*/
    float: left;
    font-size: 18px;
    /*padding: 19px 18px;*/
    padding: 40px 18px 20px 18px;
    /*text-transform: uppercase;*/
    width: 100%;
    line-height: 25px;
    text-align: center;

}
.price_heading
{
    box-sizing: border-box;
    float: left;
    font-size: 18px;
    padding: 0px 18px;
    width: 100%;
    line-height: 25px;
    text-align: center;
}
.packInfoDetailOuter {

    width: 100%;
    float: left;
    padding: 10px 18px;
    box-sizing: border-box;
    position: relative;

}
.recommendPacksTitle {
    color: #494d50;
    font-size: 16px;
    width: 100%;
    position: relative;
    line-height: 20px;
    word-break: break-all;
    min-height: 90px;
    margin-bottom: 20px;
    overflow: hidden;
}
.recommendValidity {
    float: left;
    width: 100%;
    padding: 15px 0 10px 0;
    color: #797b7a;
    font-size: 15px;
}
.recRecharge {
    background: #fff;
    border: 1px solid #28A745;
    border-radius: 5px;
    box-sizing: border-box;
    color: #28A745;
    cursor: pointer;
    float: right;
    font-size: 20px;
    line-height: 20px;
    padding: 8px 12px;
    text-align: center;
    width: auto;
    position: absolute;
    bottom: 100px;
    right: 18px;
    font-weight: 600;
}   
.btndesign {
    background-color: #fff;
    border: 2px solid #ffc3aa;
    color: #ef6925;
    background-color: #28A745;;
    top: 0;
    padding: 9px 20px;
        padding-bottom: 9px;
    padding-bottom: 11px;
    color: #fff;
    position: relative;
    font-size: 15px;
    font-weight: 600;
    display: inline-block;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    margin-right: 6px;
    overflow: hidden;
    border: none;
    /*border-radius: 50px !important;*/
}
.price {
    font-size: 40px;
    position: absolute;top: 0;left: 0;
}
.price_main{
    font-size: 14px;position: relative;line-height: 1;display: inline-block;padding-left: 55px;text-align: left;padding-top: 30px;
}
.active_member_pack{
	background: #0e2a60;
	color: white;
	min-height: 300px;
}
.success {background-color: #0e2a60; color: white; padding: 8px; border-radius: .25rem;}
.hide_btn_buy{
	display: none;
}
@media screen and (max-width: 569px){
    .pkg_list {
        margin-top: 5% !important;
        margin-left: 22%;
     }
}
@media screen and (max-width: 420px){
    .pkg_list{
        margin-left: 10%;
    }
}
@media screen and (max-width: 375px){
    .pkg_list{
        margin-left: 8%;
    }
}
@media screen and (max-width: 320px){
    .pkg_list{
        margin: 0;
    }
}
</style>
<div class="container">
	<div class="row m-0">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>
		    <div class="col-md-9 setmd">
		         @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                 @endif
				 <div class="note"><p style="font-size: 22px;"><span style="color: #41ac1b">  Membership  </span> packs </p>
		         </div>
		         <div class="row my-4">
                  <?php if(!empty($response['code'])) { ?>
                <div class="alert alert-<?php echo $response['code']; ?>">
                    <?php echo $response['message']; ?>
                </div>
                <?php } ?>
       
              </div>
 @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong class="mleft">{!! session('flash_message_error') !!}</strong>
    </div>
@endif
    <span class="success">Current Pack </span>
    <hr>
    <div class="row my-4 text-center">
        @if(count($packages))
            @foreach($packages as $key => $package)
                
                <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                    <div class="pkg_list <?php if($package_active !="") if($package_active->id == $package->id) echo "active_member_pack"; ?>">
                        <div class="pkg_heading">
                           <span style="font-weight: bold;"> {{ $package->name}} </span>
                            <?php $user_id = ""; ?>
                        </div>
                        <div class="price_heading">
                            <p><span class="price_main"><span class="price">
                                <sup style="font-size: 17px;">$</sup><sub>{{ $package->month_price}}</sub>
                                </span>USD<br> per month</span>
                            </p>
                            <p><span><sup>$</sup>{{ $package->price}}
                                USD for {{ $package->duration}} @if($package->duration > 1) Months @else
                                Month @endif</span>
                            </p>
                        </div>
                        <div class="packInfoDetailOuter">
                           <!--  <p class="recommendPacksTitle">{{ $package->description}}</p>
                            <p class="recommendValidity">Validity {{ $package->duration}} month<br>Bid Count {{ $package->agent}}</p>
                            <p class="recRecharge">${{ $package->price}} </p> -->
                            <!-- <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form" action='{{url("paypal/{$package->id}/$user_id")}}'> -->
                            <p style="text-align: center;" class="<?php if($package_active !="") if($package->id == $package_active->id) echo "hide_btn_buy"; ?>">           
                                <input type="hidden" name="p_id" value="{{ $package->id}}">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <a href='{{url("paypal/ec-checkout?mode=recurring&p_id=$package->id")}}'><input type="submit" data-pid="{{ $package->id}}" data-name="{{ $package->name}}" data-amt="{{ $package->price}}" data-id="{{ $user_id }}" class="btndesign button margin-top-15" value="Change plan"></a>
                            </p>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
            </div>
    </div>
</div>
@endsection

