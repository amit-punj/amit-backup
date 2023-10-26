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
.dropdown-menu.dropdown-menu-right.dropdown-menu-arrow.show{
	transform: translate3d(-200px, -11px, 0px) !important;
}
td{
	width: 2%;
}
.acolor{
	color: black;
}
.acolor:hover { 
  color: black;
  text-decoration: unset;
}
div#main {
    background-color: #f3f3f3;
}
img.my-profile-list{
	height: 70px;
	width: 70px;
	border-radius: 50%;
}
.user_name_list{
	font-size: 20px;
}
.city_name_list{
	color: gray;
	font-size: 15px;
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
.loader_img{
    width: 19%;
    margin-left: 41%;
    margin-top: 23%;
}
@media screen and (max-width: 900px)
{
   .col-10.user-msg-list{
    margin-left: 17%;
    margin-top: -13%;
  }
}
@media screen and (max-width: 823px)
{
	.col-10.user-msg-list{
   margin-left: 16%;
    margin-top: -12%;
  }
  img.my-profile-list {
    height: 51px;
    width: 51px;
    border-radius: 50%;
}
}
@media screen and  (max-width: 535px)
{
	.my-profile-list{
		height: 40px!important;
	width: 40px!important;
	}
	.user_name_list{
		font-size: 15px;
	}
	.city_name_list{
		font-size: 9px;
	}
	.col-10.user-msg-list{
    margin-left: 11%;
    margin-top: -8%;
  }
}
@media screen and (max-width: 475px)
{
	.col-10.user-msg-list{
        margin-left: 13%;
    margin-top: -11%;
}
.dropdown-menu.dropdown-menu-right.dropdown-menu-arrow.show{
    font-size: 12px;
    transform: translate3d(-190px, -20px, 0px) !important;
  }
}
@media screen and  (max-width: 420px){
	.user_name_list{
		margin-left: 3%;
	}
	.city_name_list{
		margin-left: 3%;
	}
	 .loader_img{
        margin-top: 27%;
    }
	.col-10.user-msg-list {
    margin-left: 15%;
    margin-top: -11%;
   }
   .my-profile-list {
    height: 31px!important;
    width: 31px!important;
 }
 .dropdown-menu.dropdown-menu-right.dropdown-menu-arrow.show{
   transform: translate3d(-165px, -27px, 0px) !important;
   font-size: 12px;
  }
}
@media screen and (max-width: 360px)
{
    .loader_img{
        margin-top: 33%;
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
				 <div class="note"><p style="font-size: 22px;">  My  <span style="color: #41ac1b">  Messages </span></p>
		         </div>
		    <div class="lists_meaages table-responsive">
		    <div id="loader_div" class="loader_div"><img class="loader_img" src="{{ asset('images/default/loading3.gif')}}"></div>
		@if(count($data))    
		    <ul class="list-group">
		        	<?php $check = array();  ?>
		        	<?php $check2 = array(); ?>	
		        @foreach($data as $datas)
			    @if(Auth::user()->id != $datas->user_id && Auth::user()->id != $datas->reciver_id)
							<?php $check[] = $datas->user_id;  
							if(!in_array($datas->user_id, $check2))
							{
							   if($datas->delete_status != 1)
							   {
							      $show = '';
							 ?>
							        <a href="{{ url('chat-users/'.$datas->sender['id'])}}" class="acolor">
									  <li class="list-group-item list-group-item">
									  	 <div class="row">
					                        <div class="col-2">
							                     @if(!empty($datas->sender['profile_pic']))
							                         <img class="my-profile-list" src="{{ asset('images/'.$datas->sender['profile_pic'])}}">
							                     @else
							                     <img class="my-profile-list" src="{{ asset('images/dummy-user.png')}}">
							                     @endif
							                 </div>
					                        <div class="col-10">
					                          <span class="user_name_list">{{ $datas->sender['fname']}}  {{$datas->sender['lname']}}</span><br>
					                          <span class="city_name_list">
					                          {{ $datas->sender['city_name']}}</span>
					                          <div class="dropdown" style="float: right;">
                                                    <span class="btn btn-sm btn-icon-only text-light border" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v" style="color: black;"></i>
                                                    </span>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                       <form id="link_form_id" action="{{ url('delele/conversation/user')}}" method="post">
                                                            @csrf
                                                        <input type="hidden" name="reciver_id" value="{{ $datas->sender['id'] }}">
                                                        <button type="submit" id="link_id" class="dropdown-item">Delete Conversation</button>
                                                        </form> 
                                                    </div>
                                                </div>
					                         </div>
									  	  
									  	</div>  
									  </li>
									</a>
									
						      <?php 
					          }
                            }
						 ?> 
				@endif
				@if(Auth::user()->id != $datas->reciver_id)
				<?php
				    $check2[] = $datas->reciver_id;
				    if(!in_array($datas->reciver_id, $check))
				    {
			            if($datas->delete_status != 1)
			            {

			               	$show = '';
				      	?>
				               <a href="{{ url('chat-users/'.$datas->reciver['id'])}}" class="acolor">
						  <li class="list-group-item list-group-item">
						  	<div class="row">
		                      <div class="col-2">
		                     @if(!empty($datas->reciver['profile_pic']))
		                         <img class="my-profile-list" src="{{ asset('images/'.$datas->reciver['profile_pic'])}}">
		                     @else
		                     <img class="my-profile-list" src="{{ asset('images/dummy-user.png')}}">
		                     @endif
		                      </div>
		                        <div class="col-10 user-msg-list">
		                          <span class="user_name_list">{{ $datas->reciver['fname']}}  {{$datas->reciver['lname']}}</span><br>
		                            <span class="city_name_list">
		                          {{$datas->reciver['city_name']}}</span>
		                                        <div class="dropdown" style="float: right; margin-top: -4%">
                                                    <span class="btn btn-sm btn-icon-only text-light border" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v" style="color: black;"></i>
                                                    </span>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                
                                                        <form id="link_form_id" action="{{ url('delele/conversation/user')}}" method="post">
                                                            @csrf
                                                        <input type="hidden" name="reciver_id" value="{{ $datas->reciver['id'] }}">
                                                        <button type="submit" id="link_id" class="dropdown-item">Delete Conversation</button>
                                                        </form> 
                                                    </div>
                                                </div>
		                         </div>
		                         
						  	</div>
						  </li>
						       </a>

						<?php 
					   }  
					}
						?> 
				@endif
				@endforeach	 
				  @if(!isset($show))
                     <p style="margin-top: 2%;">No message found !!</p>

				  @endif 
		    </ul>
		@else
		
		<p style="margin-top: 3%">No chat founds!!</p>
		@endif		
		    </div>     
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
  $("form").submit(function(){
    jQuery(".loader_div").show();
  });
});
</script>

@endsection