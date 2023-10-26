@extends('layouts.main')
@section('content')
<style type="text/css">
.pkg_list {
    border-bottom: 2px solid #9c9c9c;
    position: relative;
    float: left;
    max-width: 292px;
    width: 100%;
    cursor: pointer;
    box-sizing: border-box;
    z-index: 5;
    min-height: 180px;
    -moz-box-shadow: 0 5px 10px #9c9c9c;
    -webkit-box-shadow: 0 5px 10px #9c9c9c;
    -ms-box-shadow: 0 5px 10px #9c9c9c;
    box-shadow: 0 5px 10px #9c9c9c;
    margin-bottom: 15px;
}
.pkg_heading {

    background: #28a745 none repeat scroll 0 0;
    box-sizing: border-box;
    color: #fff;
    float: left;
    font-size: 18px;
    padding: 19px 18px;
    text-transform: uppercase;
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
    border-radius: 50px !important;
}
</style>
<div class="container">
    <div class="row my-4">
        <h3>  {{ $PageDetails->name }}</h3><hr>
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
    <hr>
    <div class="row my-4">
        <?php echo $PageDetails->content; ?>
    </div>
</div>  
@endsection
@section('scripts')
<script type="application/javascript">

</script>

@endsection

