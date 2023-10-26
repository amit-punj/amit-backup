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
.dropdown-toggle::after{
    content: unset;
}

.btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle {
    color: #fff;
     background-color: unset; 
     border-color: white; 
}
button.btn.btn-secondary.dropdown-toggle {
    margin-top: 11%;
    color: green;
    border: unset;
    background: transparent;
}
.box-header.with-border{
    display: flex;
}
.acolor{
	color: black;
}
.acolor:hover { 
  color: black;
  text-decoration: unset;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.profile_pic{
    border-radius: 50%;
    width: 40px;
    height: 40px;
}
.box.box-primary {
    border-top-color: #3c8dbc;
}
.box.box-info {
    border-top-color: #00c0ef;
}
.box.box-danger {
    border-top-color: #dd4b39;
}
.box.box-warning {
    border-top-color: #f39c12;
}
.box.box-success {
    border-top-color: #00a65a;
}
.box.box-default {
    border-top-color: #d2d6de;
}
.box.collapsed-box .box-body, .box.collapsed-box .box-footer {
    display: none;
}
.box .nav-stacked>li {
    border-bottom: 1px solid #f4f4f4;
    margin: 0;
}
.box .nav-stacked>li:last-of-type {
    border-bottom: none;
}
.box.height-control .box-body {
    max-height: 300px;
    overflow: auto;
}
.box .border-right {
    border-right: 1px solid #f4f4f4;
}
.box .border-left {
    border-left: 1px solid #f4f4f4;
}
.box.box-solid {
    border-top: 0;
}
.box.box-solid>.box-header .btn.btn-default {
    background: transparent;
}
.box.box-solid>.box-header .btn:hover, .box.box-solid>.box-header a:hover {
    background: rgba(0, 0, 0, 0.1);
}
.box.box-solid.box-default {
    border: 1px solid #d2d6de;
}
.box.box-solid.box-default>.box-header {
    color: #444;
    background: #d2d6de;
    background-color: #d2d6de;
}
.box.box-solid.box-default>.box-header a, .box.box-solid.box-default>.box-header .btn {
    color: #444;
}
.box.box-solid.box-primary {
    border: 1px solid #3c8dbc;
}
.box.box-solid.box-primary>.box-header {
    color: #fff;
    background: #3c8dbc;
    background-color: #3c8dbc;
}
.box.box-solid.box-primary>.box-header a, .box.box-solid.box-primary>.box-header .btn {
    color: #fff;
}
.box.box-solid.box-info {
    border: 1px solid #00c0ef;
}
.box.box-solid.box-info>.box-header {
    color: #fff;
    background: #00c0ef;
    background-color: #00c0ef;
}
.box.box-solid.box-info>.box-header a, .box.box-solid.box-info>.box-header .btn {
    color: #fff;
}
.box.box-solid.box-danger {
    border: 1px solid #dd4b39;
}
.box.box-solid.box-danger>.box-header {
    color: #fff;
    background: #dd4b39;
    background-color: #dd4b39;
}
.box.box-solid.box-danger>.box-header a, .box.box-solid.box-danger>.box-header .btn {
    color: #fff;
}
.box.box-solid.box-warning {
    border: 1px solid #f39c12;
}
.box.box-solid.box-warning>.box-header {
    color: #fff;
    background: #f39c12;
    background-color: #f39c12;
}
.box.box-solid.box-warning>.box-header a, .box.box-solid.box-warning>.box-header .btn {
    color: #fff;
}
.box.box-solid.box-success {
    border: 1px solid #00a65a;
}
.box.box-solid.box-success>.box-header {
    color: #fff;
    background: #00a65a;
    background-color: #00a65a;
}
.box.box-solid.box-success>.box-header a, .box.box-solid.box-success>.box-header .btn {
    color: #fff;
}
.box.box-solid>.box-header>.box-tools .btn {
    border: 0;
    box-shadow: none;
}
.box.box-solid[class*='bg']>.box-header {
    color: #fff;
}
.box .box-group>.box {
    margin-bottom: 5px;
}
.box .knob-label {
    text-align: center;
    color: #333;
    font-weight: 100;
    font-size: 12px;
    margin-bottom: 0.3em;
}
.box>.overlay, .overlay-wrapper>.overlay, .box>.loading-img, .overlay-wrapper>.loading-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%}
.box .overlay, .overlay-wrapper .overlay {
    z-index: 50;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 3px;
}
.box .overlay>.fa, .overlay-wrapper .overlay>.fa {
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -15px;
    margin-top: -15px;
    color: #000;
    font-size: 30px;
}
.box .overlay.dark, .overlay-wrapper .overlay.dark {
    background: rgba(0, 0, 0, 0.5);
}
.box-header:before, .box-body:before, .box-footer:before, .box-header:after, .box-body:after, .box-footer:after {
    content: " ";
    display: table;
}
.box-header:after, .box-body:after, .box-footer:after {
    clear: both;
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}
.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}
.collapsed-box .box-header.with-border {
    border-bottom: none;
}
.box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}
.box-header>.fa, .box-header>.glyphicon, .box-header>.ion {
    margin-right: 5px;
}
.box-header>.box-tools {
    position: absolute;
    right: 10px;
    top: 5px;
}
.box-header>.box-tools [data-toggle="tooltip"] {
    position: relative;
}
.box-header>.box-tools.pull-right .dropdown-menu {
    right: 0;
    left: auto;
}
.btn-box-tool {
    padding: 5px;
    font-size: 12px;
    background: transparent;
    color: #97a0b3;
}
.open .btn-box-tool, .btn-box-tool:hover {
    color: #606c84;
}
.btn-box-tool.btn:active {
    box-shadow: none;
}
.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}
.no-header .box-body {
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.box-body>.table {
    margin-bottom: 0;
}
.box-body .fc {
    margin-top: 5px;
}
.box-body .full-width-chart {
    margin: -19px;
}
.box-body.no-padding .full-width-chart {
    margin: -9px;
}
.box-body .box-pane {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 3px;
}
.box-body .box-pane-right {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 0;
}
.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}
.direct-chat .box-body {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    position: relative;
    overflow-x: hidden;
    padding: 0;
}
.direct-chat.chat-pane-open .direct-chat-contacts {
    -webkit-transform: translate(0,  0);
    -ms-transform: translate(0,  0);
    -o-transform: translate(0,  0);
    transform: translate(0,  0);
}
.direct-chat-messages {
    -webkit-transform: translate(0,  0);
    -ms-transform: translate(0,  0);
    -o-transform: translate(0,  0);
    transform: translate(0,  0);
    padding: 10px;
    height: 300px;
    overflow: auto;
}
.direct-chat-msg, .direct-chat-text {
    display: block;
}
.direct-chat-msg {
    margin-bottom: 10px;
}
.direct-chat-msg:before, .direct-chat-msg:after {
    content: " ";
    display: table;
}
.direct-chat-msg:after {
    clear: both;
}
.direct-chat-messages, .direct-chat-contacts {
    -webkit-transition: -webkit-transform .5s ease-in-out;
    -moz-transition: -moz-transform .5s ease-in-out;
    -o-transition: -o-transform .5s ease-in-out;
    transition: transform .5s ease-in-out;
}
.direct-chat-text {
    border-radius: 5px;
    position: relative;
    padding: 5px 10px;
    background: #d2d6de;
    border: 1px solid #d2d6de;
    margin: 5px 0 0 50px;
    color: #444;
}
.direct-chat-text:after, .direct-chat-text:before {
    position: absolute;
    right: 100%;
    top: 15px;
    border: solid transparent;
    border-right-color: #d2d6de;
    content: ' ';
    height: 0;
    width: 0;
    pointer-events: none;
}
.direct-chat-text:after {
    border-width: 5px;
    margin-top: -5px;
}
.direct-chat-text:before {
    border-width: 6px;
    margin-top: -6px;
}
.right .direct-chat-text {
    margin-right: 14px;
}
.right .direct-chat-text:after, .right .direct-chat-text:before {
    right: auto;
    left: 100%;
    border-right-color: transparent;
    border-left-color: #d2d6de;
}
.direct-chat-img {
    border-radius: 50%;
    float: left;
    width: 40px;
    height: 40px;
}
.right .direct-chat-img {
    float: right;
}
.direct-chat-info {
    display: block;
    margin-bottom: 2px;
    font-size: 12px;
}
.direct-chat-name {
    font-weight: 600;
}
.direct-chat-timestamp {
    color: #999;
}
.direct-chat-contacts-open .direct-chat-contacts {
    -webkit-transform: translate(0,  0);
    -ms-transform: translate(0,  0);
    -o-transform: translate(0,  0);
    transform: translate(0,  0);
}
.direct-chat-contacts {
    -webkit-transform: translate(101%,  0);
    -ms-transform: translate(101%,  0);
    -o-transform: translate(101%,  0);
    transform: translate(101%,  0);
    position: absolute;
    top: 0;
    bottom: 0;
    height: 250px;
    width: 100%;
    background: #222d32;
    color: #fff;
    overflow: auto;
}
.contacts-list>li {
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    padding: 10px;
    margin: 0;
}
.contacts-list>li:before, .contacts-list>li:after {
    content: " ";
    display: table;
}
.contacts-list>li:after {
    clear: both;
}
.contacts-list>li:last-of-type {
    border-bottom: none;
}
.contacts-list-img {
    border-radius: 50%;
    width: 40px;
    float: left;
}
.contacts-list-info {
    margin-left: 45px;
    color: #fff;
}
.contacts-list-name, .contacts-list-status {
    display: block;
}
.contacts-list-name {
    font-weight: 600;
}
.contacts-list-status {
    font-size: 12px;
}
.contacts-list-date {
    color: #aaa;
    font-weight: normal;
}
.contacts-list-msg {
    color: #999;
}
.direct-chat-danger .right>.direct-chat-text {
    background: #dd4b39;
    border-color: #dd4b39;
    color: #fff;
}
.direct-chat-danger .right>.direct-chat-text:after, .direct-chat-danger .right>.direct-chat-text:before {
    border-left-color: #dd4b39;
}
.direct-chat-primary .right>.direct-chat-text {
    background: #3c8dbc;
    border-color: #3c8dbc;
    color: #fff;
}
.direct-chat-primary .right>.direct-chat-text:after, .direct-chat-primary .right>.direct-chat-text:before {
    border-left-color: #3c8dbc;
}
.direct-chat-warning .right>.direct-chat-text {
    background: #f39c12;
    border-color: #f39c12;
    color: #fff;
}
.direct-chat-warning .right>.direct-chat-text:after, .direct-chat-warning .right>.direct-chat-text:before {
    border-left-color: #f39c12;
}
.direct-chat-info .right>.direct-chat-text {
    background: #00c0ef;
    border-color: #00c0ef;
    color: #fff;
}
.direct-chat-info .right>.direct-chat-text:after, .direct-chat-info .right>.direct-chat-text:before {
    border-left-color: #00c0ef;
}
.direct-chat-success .right>.direct-chat-text {
    background: #00a65a;
    border-color: #00a65a;
    color: #fff;
}
.direct-chat-success .right>.direct-chat-text:after, .direct-chat-success .right>.direct-chat-text:before {
    border-left-color: #00a65a;
}
#parentDiv{
    overflow: auto;
}            
#link_id:hover{
    background: #5fb33a;
    color: white;
}
.loader_div{
  position: absolute;
  top: 0;
  bottom: 0%;
  left: 0;
  right: 0%;
  z-index: 99;
  opacity:0.7;
  display:none;
  background: white;
}
.attachment-btn{
    margin-left: 10px;
    margin-right: 10px;
    margin-top: 10px;
    background: transparent;
    border: unset;
}
.inputWrapper {
    height: 32px;
    width: 39px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    /*Using a background color, but you can use a background image to represent a button*/
    background-color: white;
}
.fileInput {
    cursor: pointer;
    height: 100%;
    position:absolute;
    top: 0;
    right: 0;
    z-index: 99;
    /*This makes the button huge. If you want a bigger button, increase the font size*/
    font-size:50px;
    /*Opacity settings for all browsers*/
    opacity: 0;
    -moz-opacity: 0;
    filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0)
}
div#main {
    background-color: #f3f3f3;
}
button.btn.btn-secondary.dropdown-toggle{
    box-shadow: unset !important;
}
.col-md-8.mgtp {
    margin-top: 3%;
}
.loader_img{
    width: 33%;
    margin-left: 30%;
    margin-top: 17%;
}
@media screen and (max-width: 420px)
{
    .loader_img{
        margin-top: 27%;
    }
}
@media screen and (max-width: 360px)
{
    .loader_img{
        margin-top: 50%;
    }
    .dropdown-menu.show{
       transform: translate3d(-81px, 36px, 0px) !important;
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
          @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
         @endif
				<div class="note"><p style="font-size: 22px;">  My  <span style="color: #41ac1b">  Messages</span></p>
		        </div>
    <div class="row bootstrap snippets">
        <div class="col-md-2"></div>
        <div class="col-md-8 mgtp">
                  <!-- DIRECT CHAT SUCCESS -->
                    <div class="box box-success direct-chat direct-chat-success">
                    <div class="box-header with-border">
                    <h3 class="box-title">
                    @if(isset($name))
                    @if(!empty($name))
                    @if(!empty($name->profile_pic))
                    <img class="profile_pic" src="{{ asset('images/'.$name->profile_pic)}}" >
                    @else
                    <img class="profile_pic" src="{{ asset('images/default/dummy-user.png')}}" alt="Message User Image">
                    @endif
                    {{$name->fname}} {{$name->lname}}
                    @else
                    not find
                    @endif
                    @endif</h3>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v" id="dropdownMenuButton"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ url('property/user/view/'.$reciver_id)}}">View Profile</a>
                    <form id="link_form_id" action="{{ url('delele/conversation/user')}}" method="post">
                    @csrf
                    <input type="hidden" name="reciver_id" value="{{ $reciver_id }}">
                @if(isset($delete_button))    
                    @if($delete_button->delete_1 == Auth::user()->id || $delete_button->delete_2 == Auth::user()->id)

                    @else
                    <button type="submit" id="link_id" class="dropdown-item">Delete Conversation</button>
                    @endif
                @endif    
                    </form>
                    </div>
                </div>
                </div>

                    <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" id="scroll_div">
                    @if(count($message))    
                    @foreach($message as $key => $msg)
                    <!-- sender start -->
                    @if(Auth::user()->id == $msg['delete_1'] || Auth::user()->id == $msg['delete_2'])   
                    <?php  continue; 
                    ?>
                    @endif
                    @if($msg->sender_id == Auth::user()->id)
                    <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                    <span class="direct-chat-timestamp pull-left">@if(!empty($msg->created_at)) You {{ $msg->created_at->diffForHumans() }} @endif</span>
                    </div>
                    <div class="direct-chat-text">
                    @if(!empty($msg->file))
                    <a href="{{ asset('images/'.$msg->file)}}" download>
                    <img src="{{asset('images/default/file.png')}}" alt="pdf" width="70" height="70">
                    </a>
                    @endif
                    {{ $msg->message }}
                    </div>
                    </div>
                    @else
             
                    <!-- sender end -->  
                    <!-- reciver satart --> 
                    <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                    <!--    <span class="direct-chat-name pull-left">user name</span> -->
                    <span class="direct-chat-timestamp pull-right">@if(!empty($msg->created_at)) {{ $msg->created_at->diffForHumans() }} @endif</span>
                    </div>
                    @if(isset($name))
                    @if(!empty($name->profile_pic))
                    <img class="direct-chat-img" src="{{ asset('images/'.$name->profile_pic)}}" alt="Message User Image">
                    @else
                    <img class="direct-chat-img" src="{{ asset('images/default/dummy-user.png')}}" alt="Message User Image">
                    @endif
                    @endif   
                    <div class="direct-chat-text">
                    @if(!empty($msg->file))
                    <a href="{{ asset('images/'.$msg->file)}}" download>
                    <img src="{{asset('images/default/file.png')}}" alt="pdf" width="70" height="70">
                    </a>
                    @endif
                    {{ $msg->message }}
                    </div>
                    </div>
                    @endif    
                    <!-- Reciver end -->
                    @endforeach
                    @else
                    New conversation start
                    @endif
                    </div>
                    </div>
                    <div class="box-footer">
                    <div id="loader_div" class="loader_div"><img class="loader_img" src="{{ asset('images/default/loading3.gif')}}"></div>
                    <form action="{{ url('message_save_users')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control" >
                    <input type="hidden" name="reciver_id" value="{{ $reciver_id }}">
                    <input type="hidden" name="sender_name" value="{{ Auth::user()->fname }}">
                    <div class="inputWrapper">
                    <i class="fas fa-paperclip attachment-btn"></i>
                    <input class="fileInput" type="file" name="file"  onchange="readURL(this);" />
                    </div>
                    <span class="input-group-btn">
                    <button type="submit" id="btnchatsend" class="btn btn-success btn-flat">Send</button>
                    </span>
                    </div>
                    <a href="#" style="display: none; margin-top: 20px;"  id="sound" download>
                    <img src="{{asset('images/default/file.png')}}" alt="pdf" width="70" height="70">
                    Your file
                    </a>
                    @if ($errors->has('file'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('file') }} </strong>
                                            </span>
                    @endif
                     @if ($errors->has('message'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('message') }} </strong>
                                            </span>
                      @endif
                    </form>
                    </div>
                    </div>
        </div>
        <div class="col-md-2"></div>
                    </div>
                    </div>
                    <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
</div>
</div>
	</div>
	</div>
</div>	
@endsection	
@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {
   var objDiv = document.getElementById("scroll_div");
    objDiv.scrollTop = objDiv.scrollHeight;
});
$(document).ready(function(){
  $("form").submit(function(){
    jQuery(".loader_div").show();
  });
});

function readURL(input) 
{ if (input.files && input.files[0]) 
{ 
var reader = new FileReader(); 
reader.onload = function (e) 
{ 
$('#sound').attr('src', e.target.result); 
$('#sound').css('display','block');
$('#backend_sound').css('display','none');
} 
reader.readAsDataURL(input.files[0]); 
} 
}
</script>

@endsection        



