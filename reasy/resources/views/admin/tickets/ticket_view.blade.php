 @extends('adminlayouts.app')
@section('content')
<?php
$role = Auth::user()->user_role; 
//$contractPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'contract_permission');
?>
<style type="text/css">
    #loading-image{
        margin-left: 37%;
    margin-top: -47%;
    display: none;
    }
</style>
<main class="app-content">
    <div class="app-title"><h3>Ticket View</h3> </div>
<div class="container">
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
                <a class="btn btn-success" href="{{url('admin/ticket/listing')}}">Back</a>
                @if($ticket->status == 'pending')
                    <button data-id="{{$ticket->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
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
        @if(count($ticket_threads) > 0 ) 
            @foreach($ticket_threads as $key => $email)
              @if($email->send == Auth::user()->id)
                <?php 
                    $send_img = (isset($email->create->image)) ? (($email->role == 0) ? asset('images/'.$email->create->image) : asset('images/users/'.$email->create->image) )  : asset('images/dummy-user.png');
                ?>
                <div class="chat-container col-md-12">
                  <img src="{{$send_img}}" alt="Avatar" class="right">
                  <p class="text-right">{{$email->message}}</p>
                  <span class="time-right">{!! \Helper::DateTime($email->created_at); !!}</span>
                  <br>
                  <span class="time-right">Sent By: 
                      <strong>You</strong>
                  </span>
                </div>
              @else
                <?php 
                    $receive_img = (isset($email->create->image)) ? (($email->role == 0) ? asset('images/'.$email->create->image) : asset('images/users/'.$email->create->image) )  : asset('images/dummy-user.png');
                ?>
                <div class="chat-container darker col-md-12">
                  <img src="{{$receive_img}}" alt="Avatar" class="left">
                  <p class="text-left">{{$email->message}}</p>
                  <span class="time-left">{!! \Helper::DateTime($email->created_at); !!}</span>
                  <br>                        
                  <span class="time-left">Sent By: 
                      <strong>
                          @if($email->role == 0)
                            Admin
                          @elseif($email->role == 1)
                            Tenant
                          @elseif($email->role == 2)
                            Property Owner
                          @elseif($email->role == 3)
                            Property Manager
                          @elseif($email->role == 4)
                            Property Experts
                          @elseif($email->role == 5)
                            Legal Advisor
                          @elseif($email->role == 6)
                            Visit Organizer
                          @endif
                      </strong>
                  </span>
                </div>
              @endif
            @endforeach
        @endif
        @if($ticket->status == 'pending')   
            <div class="chat-container col-md-12">
                <form action="{{url('ticket-reply/'.$ticket->id)}}" id="ticket_reply" method="post" enctype="multipart/form-data">
                    @csrf         
                    <div class="input-group">
                        <input type="text" required="" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                        <button type="submit" id="btnchatsend" class="btn btn-success btn-flat">Send</button>
                        </span>
                    </div>
                    </br>
                    <label id="message-error" style="display: none;" class="red" for="message"></label>
                </form>
            </div>
        @endif
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
@endsection