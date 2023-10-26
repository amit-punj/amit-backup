@section('title','Messages')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Messages'])
<style type="text/css">
  .dashboard-sidebar a {
      color: #000;
      text-decoration: none;
  }
  .nav-item.active { background-color:#5cb85c; border-color:#5cb85c; }
  .list-group-item {background-color: unset !important; border: unset !important;}
</style>
<div class="container">
  <div id="book_appointment" class="">
    <div class="row">
      @if(count($emails) > 0)
      <div class="row" style="margin-left: 0px;">
        <div class="col-md-3">
          <?php $role = Auth::user()->user_role;?>
          <div class="dashboard-sidebar">
            <ul class="">
              @if(count($emails) > 0 )
                @php $i = 0 @endphp 
                @foreach($emails as $key =>$email) 
                @if(count($email) > 1 )
                  <li class="nav-item <?php if($unit_id == $key ) echo "active"; ?>">
                    <a onclick="" class="nav-link list-group-item mylisting " href="#navbar-examples_{{$key}}" data-toggle="collapse" role="button1" aria-expanded="true" aria-controls="navbar-examples">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-building"></i>
                        <span class="nav-link-text">{{ (isset($email[0]->unit->unit_name) ) ? substr($email[0]->unit->unit_name, 0, 20)."..."  : '' }}</span>
                        <span style="float: right; margin-right: 5%;"><i class="fa fa-caret-down"></i></span>
                    </a>
                    <div class="collapse" id="navbar-examples_{{$key}}">
                      <ul class="nav nav-sm flex-column">
                        @foreach($email as $unit_key => $unit_val)
                          <li class="nav-item">
                              <a id="clear_property_item" class="nav-link smallersize list-group-item <?php if($unit_id == $key && $unit_val->tenant_id == $tenant_id) echo "active"; ?>" href="{{url('messenger?uid='.$key.'&tid='.$unit_val->tenant_id)}}">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus"></i> {{$unit_val->tenant->name}}
                              </a>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </li>
                @else
                  <li class="nav-item <?php if($unit_id == $key ) echo "active"; ?>">
                    <a class="select_unit" data-id="{{$key}}" id="unit_{{$key}}" href="{{url('messenger?uid='.$key.'&tid='.$email[0]->tenant_id)}}">{{ (isset($email[0]->unit->unit_name) ) ? substr($email[0]->unit->unit_name, 0, 20)."..."  : '' }} </a>
                  </li>
                @endif
                @php $i++ @endphp
                @endforeach
              @else
                <p>No Message!</p>
              @endif
            </ul>
          </div>
          <style type="text/css">
            .dashboard-sidebar li:hover {color: #1a1a1a; border: 0; }
          </style>
        </div>
        <div class="col-md-9" id="chat_body">
            @if(count($email_chat) > 0 ) 
              @foreach($email_chat as $key =>$chat)
                <?php 
                    $tenant_id = $chat->tenant_id;
                    if(Auth::user()->id == $chat->tenant_id){
                      $received = $chat->vo_id; 
                    } else{
                      $received = $chat->tenant_id; 
                    }     
                ?>
                @if($chat->received == Auth::user()->id)
                  <?php 
                      $send_img = (isset($chat->create->image)) ? asset('images/users/'.$chat->create->image) : asset('images/dummy-user.png') ;
                  ?>
                  <div class="chat-container darker">
                    <img src="{{$send_img}}" alt="Avatar" class="left">
                    <p class="text-left">{{$chat->message}}</p>
                    <span class="time-left">{!! \Helper::DateTime($chat->created_at); !!}</span>
                  </div>
                @else
                  <?php 
                      $receive_img = (isset($chat->create->image)) ? asset('images/users/'.$chat->create->image) : asset('images/dummy-user.png') ;
                  ?>
                  <div class="chat-container ">
                    <img src="{{$receive_img}}" alt="Avatar" class="right">
                    <p class="text-right">{{$chat->message}}</p>
                    <span class="time-right">{!! \Helper::DateTime($chat->created_at); !!}</span>
                  </div>
                @endif
              @endforeach
              <div class="chat-container">
                <form action="{{url('email-reply/'.$unit_id)}}" id="ticket_reply" method="post" enctype="multipart/form-data">
                    @csrf         
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <input type="hidden" name="unit_id" value="{{$unit_id}}">
                        <input type="hidden" name="received" value="{{$received}}">
                        <input type="hidden" name="send" value="{{Auth::user()->id}}">
                        <input type="hidden" name="tenant_id" value="{{$tenant_id}}">
                      <span class="input-group-btn">
                        <button type="submit" id="btnchatsend" class="btn btn-success btn-flat">Reply</button>
                      </span>
                    </div>
                    </br>
                    <label id="message-error" style="display: none;" class="red" for="message"></label>
                </form>
              </div>
            @endif
        </div>
      </div> 
      @else
        <p>No Message</p>
      @endif       
    </div>      
  </div> 
</div>
<script type="text/javascript">
    jQuery('.select_unit1').click(function(){
        var id      = $(this).data('id');
        var thisa   = $(this);
        var result  = "";

        jQuery(".loader_div").show();
        $.ajax(
        {
            url: "{{url('get-chat-by-unit')}}",
            type: "post",
            data: {
                '_token':'<?php echo csrf_token() ?>',
                'id':id,
            },
            success : function(data) { 
              var myJSON = JSON.parse(data); 
              thisa.attr('disabled', 'disabled');
              jQuery(".loader_div").hide();
              location.reload();
              console.log(myJSON);                             
            },
            error : function(data) {
            }
        });
    });

    jQuery('#ticket_reply').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            message:{
                required:true,
            },
        }      
    });

</script>
<style>
    .right, .left {
        width: 60px;
        height: 60px;
    }
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
@endsection