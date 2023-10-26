@section('title','Ticket Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Ticket Details'])
    <div class="container bootom-space">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                        {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Title : </span></td>
                                    <td>{{$ticket->title}}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Description : </span></td>
                                    <td>{{$ticket->description}}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Department : </span></td>
                                    <td>{{ucfirst($ticket->department)}}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Status : </span></td>
                                    <td>{{ucfirst($ticket->status)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a class="btn btn-success" href="{{ url()->previous() }}">Back</a>
                            @if(Auth::user()->user_role == 2 || Auth::user()->user_role == 3)
                                @if($ticket->status == 'pending')
                                    <button data-id="{{$ticket->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>  
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="Building-Units">Chat</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="communication" class="tab-pane fade in active">
                            <div class="row" style="margin-left: 0px;">
                                <div class="col-md-12">
                                    <div class="chat-container">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" style="width:100%;">
                                      <p>Hello. How are you today?</p>
                                      <span class="time-right">11:00</span>
                                    </div>
                                    <div class="chat-container darker">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" class="right" style="width:100%;">
                                      <p>Hey! I'm fine. Thanks for asking!</p>
                                      <span class="time-left">11:01</span>
                                    </div>
                                    <div class="chat-container">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" style="width:100%;">
                                      <p>Sweet! So, what do you wanna do today?</p>
                                      <span class="time-right">11:02</span>
                                    </div>
                                    <div class="chat-container darker">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" class="right" style="width:100%;">
                                      <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                                      <span class="time-left">11:05</span>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div> 
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span {font-size: 15px; font-weight: bold; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .add-unit-main {text-align: right; margin-top: 20px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: right; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
        .tab-pane {padding: 15px 0; }
        .unit{ width: 30%; }
        .float-right { float: right; }
        .open>.ml-75 {margin-left: -75%;}
    </style>
<style>
    .chat-container {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .chat-container::after {
      content: "";
      clear: both;
      display: table;
    }

    .chat-container img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .chat-container img.right {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }
</style>
<script type="text/javascript">
  jQuery('.ticket_close').click(function(){
      var id      = $(this).data('id');
      var status  = jQuery(this).data('status');
      var thisa   = $(this);
      var result  = "";
      if(status == 'closed'){
          var result = confirm("Want to close the ticket?");
      }
      if (!result) {
          return false;
      }
      $.ajax(
      {
          url: "{{url('update-ticket-status')}}",
          type: "post",
          data: {
              '_token':'<?php echo csrf_token() ?>',
              'id':id,
              'status':status
          },
          success : function(data) { 
            var myJSON = JSON.parse(data); 
            location.reload();
          },
          error : function(data) {
          }
      });
  });
</script>
@endsection