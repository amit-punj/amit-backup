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


  input{
    margin-top:2%;
  }
  input.form-control {
    border-left-color: green;
    border-left-width: thick;
    /*background-color: #f3f3f3;*/
    background-color: white;
   
}
form.form-signin {
    /*background-color: white;*/
    background-color:#f3f3f3; 
}
.font-weight-normal {
    font-weight: bold !important;
}
label{
    display: unset;
}
.two{
    display: flex;
}
.fieldsize{
    width: 49%;
}
.space{
    margin-left: 2%;
}
.backimg{
    background-image: url('../images/default/newbeg.jpeg');
}
#logreg-forms {
    width: 412px;
    padding: 10vh auto;
    background-color: #f3f3f3;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.footer{
    margin: 0px  auto;
}
input.form-control.fieldsize {
    font-size: 14px !important;
}

@media screen and (min-width: 1024px) {
#logreg-forms {
    width: 609px !important;
}
#logreg-forms form {
    max-width: 609px;
}
}
@media screen and (max-width: 499px)
{
    #logreg-forms {
    width: 400px;
}
.two{
    display: unset;
}
.fieldsize{
    width: 100%;
}
.space{
    margin-left: unset;
}
}
@media screen and (max-width: 414px)
{
    #logreg-forms {
    width: 300px !important;
}
}
@media screen and (max-width: 375px)
{
   #logreg-forms {
    width: 270px !important;
} 
}
@media screen and (max-width: 320px)
{
    #logreg-forms{
    width: 225px !important;
} 
}
</style>
<div class="container">
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
    <div class="row my-4">
        <h3>  {{ $PageDetails->name }}</h3><hr>
        <?php if(!empty($response['code'])) { ?>
                <div class="alert alert-<?php echo $response['code']; ?>">
                    <?php echo $response['message']; ?>
                </div>
                <?php } ?>
       
    </div>
    <hr>
    <div class="row my-4">
        <?php echo $PageDetails->content; ?>
    </div>

    <div class="row my-4 justify-content-center">
        <div class="col-md-8 ">
            <form class="form-signin" action="{{url('/page/contact-us')}}" method="post">
                    @csrf
                    <div class="two">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Your Name*" value="{{ old('name')}}" autofocus="" required="">
                    </div>  
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    <div class="two">
                        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email*" value="{{ old('email')}}" autofocus="" required="">
                    </div> 
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    <div class="two" style="margin-top: 2%;">
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" cols="5" placeholder="Content" rows="5" style="border-radius: unset; border-left-color: #41ac1b !important;border-left-width: thick !important; background-color: #f3f3f3!important;"></textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $content }}</strong>
                            </span>
                        @enderror
                    </div>           
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6 text-center"><button class="btn btn-primary btn-block" style="background-color: green; border-style: none; border-radius: 20px;  margin-top: 5%; " type="submit">Register Now</button></div>
                        <div class="col-md-3"></div>
                     </div>
            </form>
        </div> 
    </div>
    
</div> 
@endsection
@section('scripts')

@endsection

