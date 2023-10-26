@extends('layouts.main')
@section('content')
<style type="text/css">
.connect-button {
    display: -webkit-box;
    margin-left: 2%;
}
.despflex{
  display: flex;
  margin-left: -6px;
}
.page-link:focus {
  box-shadow: unset !important;
}
.bordernn{
  border-radius: unset !important;
}
button.btn.btn-default.btn-xs.accordion-toggle{
  border: unset !important;
}
a.btn.btn-default.btn-xs{
  border: unset !important;
}
.btn{
  position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    border: 1px solid #dee2e6;
    color: green;
}
.btn:hover {
    color: #212529;
    text-decoration: none;
}
ul.pagination{
  justify-content: center;
}
.active .btn{
  background-color: #278001 !important;
  color: #fff !important;
}
.btn-InActive {
    background: transparent !important;
    color: green !important;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: green;
}
.page-link {
    color: #37a745;
    }
    .small-box-footer {
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    z-index: 10;
    margin-right: 3%;
    color: green;
    margin-top: -2%;
    font-size: 20px;
    float: right;
}
div#main {
    background-color: #f3f3f3;
}
th{
	width: 1%;
}
.border-none.table td{
	border-top: none !important;
} 
.note
{
  text-align: center;height: 80px;background-color:  #0f2b61;color: #fff;font-weight: bold;line-height: 80px;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: auto;
  font-family: arial;
  margin-top: 5%;
}
.title {
  font-size: 22px;
}
.backbtn{
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
.margin-item{
	padding: 0 10px 10px 10px;
}

.main {background-color: #f3f3f3;}
.name{
  font-size: 21px;
	padding: 10px;
}
.text-item{
	font-size: 16px;

}
.text_child{
	font-size: 15px;

}
.dummy-user{
	    width: 50%;
    height: 161px;
}
.small-box-footer{
  margin-top: -3%;
  float: right;
}
.btn-InActive{
  width: 100%;
}
.btn.mx-1{
width: 100%;
}
.hov:hover { 
  background-color: green !important;
  color: white !important;
}
.connect{
  color: white;
  margin-left: 4%;
}
.btns:hover{
  color: white !important;
}
.btns{
  color: white;
}
@media screen and (max-width: 1024px){
.col-md-5.user-info{
	margin-left: 3%;
}
}
@media screen and (max-width: 823px){
	.profile_pic{
    margin-top: 11px;
		height: 130px;
		width: 130px;
	}
  .text_child{
    font-size: 12px;
  }
  .text-item{
    font-size: 14px;
  }
	.dummy-user{
		width: 43%;
		height: 85px;
		float: right;
	}
}
@media screen and (max-width: 769px){
	.text-item{
		font-size: 14px;
	}
	.text_child{
		font-size: 12px;
	}
	.firm_logo{
		height: 130px !important;
		width: 130px !important;
	}
}
@media only screen and (max-width: 736px){
	.profile_pic{
		margin-top: 11px !important;
	}
	
table.border-none.table.table-responsive {
    margin-left: 9% !important;
}
.dummy-user{
  height: 130px !important;
  width: 130px !important;
}
}
@media screen and (max-width: 640px){
  table.border-none.table.table-responsive {
    margin-left: 0 !important;
}
.profile_pic{
    margin-top: 0 !important;
  }
	.name{
		font-size: 21px;
	}
	.text_child{
		font-size: 12px;
	}
	.text-item{
		font-size: 14px;
	}
	.profile_pic{
		height: 100px;
		width: 100px;
		margin-top: 14px;
	}
	.dummy-user{
		width: 47%;
		height: 73px;
	}
}
@media screen and (max-width: 568px){
	.profile_pic{
		width: 100%;
		height: 150px;
		margin-top: 0;
	}
	.border-none.table td{
		width: 1%;
	}
	.dummy-user{
		float: unset;
		width: 20%;
    height: 73px;
	
	}
	.col-md-5.user-info{
	margin-left: 0;
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
   <div class="note"><p style="font-size: 22px;">Agent<span style="color: #41ac1b"> Profile </span></p>
   </div>
	<div class="card">
   <span style="display: flex;" class="name">{{ $user->fname}} @if(isset($user->lname)){{ $user->lname}} @endif
<div class="connect-button">
                 
                  <form action="{{ url('user-connect-agent')}}" method="post">
                  @csrf 
                  <input type="hidden" name="agent_id" value="{{ $user->id }}">
                  @if(Auth::user()->id != $user->id) 
                  @if(!empty($agent_connect))
                  @if($agent_connect['confirm'] == 1)
                  <a href="{{ url('chat-users/'.$user->id)}}" class="btn btns btn-success"> Message</a>
                  @endif
                  @if($agent_connect['confirm'] == 0)
                  @if($agent_connect['agent_id'] == Auth::user()->id)
                  <a href="{{ url('confirm/request/in/page/'.$agent_connect['id'])}}" class="btn btns btn-primary" name="confirm_request" value="confirm">Confirm Request</a>
                  @else
                  <div style="display: flex;">
                  <button class="btn btns btn-primary" name="cancel_request" value="cancel">Cancel Request</button><span class="btn btns btn-success"><i class="fas fa-check"></i></span>
                  <input type="hidden" name="request_id" value="{{ $agent_connect['id']}}">
                  </div>
                  @endif
                  @endif
                  @else
                  <button class="btn btns btn-success">Connect <i class="fas fa-user-plus"></i></button>
                  @endif
                  @endif    
                  </form>  
                  </div>


   </span>


        <div class="row margin-item" style="display: flex;">
         <!--   <div style="display: inline-flex;"> -->
                <div class="col-md-2 col-sm-2 col-xs-12"> 
                @if(isset($user->profile_pic))
                <img class="profile_pic" src="{{ asset('images/'.$user->profile_pic)}}" height="121" width="121">
                @else
                <img src="{{ asset('images/default/dummy-user.png')}}" height="121" width="121" style="margin-top: 3%;">
                @endif
                </div>
                <div class="col-md-5 col-sm-8 col-xs-6  user-info">
                <table class="border-none table table-responsive">
                <tbody>
            <tr>          
           	 	<td class="text-item"><i class="fas fa-envelope-open"></i> Email </td>
           	 	<td class="text_child">{{ $user->email }}</td>
           	 </tr>
           	 @if(isset($user->public_view))
              @if($user->public_view == 'yes')
            <tr>
             <td class="text-item"><i class="fas fa-mobile-alt"></i>
              Phone_Number </td>
              <td class="text_child">{{ $user->phone_no }}</td>
            </tr>
            @endif
          @endif
          <tr>
          	<td class="text-item">Firm Profile </td>
          	<td class="text_child"><a style="color: green;" href="#"> {{ $user->realestate_firm}} </a></td>
          </tr>
          <tr>
          	<td class="text-item">City </td>
          	<td class="text_child"> {{$user->city_name}}</td>
          </tr>
           	 </tbody>
           </table>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6 two_col" style="">
         @if(isset($user->firm_logo))
        	<img class="firm_logo" src="{{ asset('images/'.$user->firm_logo)}}" style="width: 39%; height: 133px;">
        	@else
        	<img src="{{ asset('images/default/dummy-user.png')}}" class="dummy-user">
         @endif
        </div>
        <hr>
        <div class="col-md-12" style="margin-top: 3%;">
         <div class="">
                <p style="font-size: 22px;">Property<span style="color: #41ac1b"> Listing </span>
                </p>
        </div>
    
			           <div id="tag_container">
                      @include('property_listing_table')
                 </div>            


        <div style="margin-top: 3%;"><p style="font-size: 22px;"><span style="color: #41ac1b"> Buyers  </span>Listing </p>
        </div>
        @if(count($list))
            <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Neighborhood</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="tag_table">
                  <?php $number=0; $i=01111; $p= 108; ?>
                  @foreach($list as $key => $lists)
                  <?php $number++; $i++; $p++; ?>
                  <tr>
                    <th scope="row">{{ $number }}</th>
                    <td>{{ $lists->title }}</td>
                    <td> {{ number_format($lists->min_price,2)}} - {{ number_format($lists->max_price,2) }} </td>
                    <td> {{$lists->local_area}} </td>
                    <td class="despflex">
                          <button  data-toggle="collapse" data-target="#demo{{ $i }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 17px;"></i>
                          </button>
                          <a href="{{ url('requirement/detail/pub/'.$lists->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green !important;" href="#"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="12" class="hiddenRow">
                      <div class="accordian-body collapse" id="demo{{ $i }}"> 
                          <table class="table table-dark table-responsive">
                              <thead>
                                <tr>
                                  <th>Address</th>
                                  <th>Property Type</th>
                                  <th>Type</th>
                                  <th>exchange</th>
                                  <th>All Cash</th>
                                  <th>Bathroom</th>
                                  <th>Rooms</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{$lists->city_name}}</td>
                                  <td> {{ Str::ucfirst($lists->property_type) }} </td>
                                  <td>{{ Str::ucfirst($lists->purpose) }}</td>
                                  <td>{{$lists->exchange}}</td>
                                  <td>{{ Str::ucfirst($lists->all_cash)}}</td>
                                  <td>{{$lists->min_bathroom}} - {{ $lists->max_bathroom }}</td>
                                  <td>{{$lists->min_room}} - {{$lists->max_room}}</td>
                                </tr>
                            </tbody>
                          </table>
                      </div>
                    </td>
                  </tr>

        <!-- Related properties -->
        
    @endforeach
  </tbody>
</table>
 <div class="row" style="justify-content: center;">
                  <ul class="pagination">
                      <!-- LINK FIRST AND PREV -->
                      <?php
                      // $limit = 6 ; // Amount of data per page  
                      // To determine what data will be displayed in the table in the database
                      $limit_start = ( $page - 1 ) * $limit;    
                       $link_prev = ($page > 1)? $page - 1 : 1;
                      ?>
                    <li><a id="pre" style="border-radius: 7px 0px 0px 7px;" data-page="<?php echo $link_prev; ?>" class="page-link btn-InActive mx-1 hloo hov" href="JavaScript:void(0);">  &#8249;</a></li>
                     
                      <!-- LINK NUMBER -->
                      <?php
                      $jumlah_page = $total_pages; 
                      $jumlah_number = 3; 
                      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; 
                      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; 
                      
                      for($i = $start_number; $i <= $end_number; $i++){
                        $link_active = ($page == $i)? ' class="active"' : '';
                        $btn_active = ($page == $i)? '' : 'btn-InActive';
                      ?>
                        <li <?php echo $link_active; ?>><a data-page="<?php echo $i; ?>" class="btn mx-1 bordernn <?php echo $btn_active; ?> hloo" href="JavaScript:void(0);"><?php echo $i; ?></a></li>
                      <?php
                      }
                      ?>
                      <?php
                      if($page == $jumlah_page){ 
                      ?>
                      <?php
                      }else{
                        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                      ?>
                       <li><a style="border-radius: 0px 7px 7px 0px;" id="next" class="page-link btn-InActive mx-1 hloo hov" data-page="<?php echo $link_next; ?>" href="JavaScript:void(0);"> &#8250;</a></li>
                        
                      <?php
                      }
                      ?>
                  </ul>
                </div>
                

            @else
                No Requirement found here !
            @endif
        </div>
		</div>		
@endsection
@section('scripts')
<script type="text/javascript">

  $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $(document).on('click','.hloo',function(){
   var page =  $(this).attr('data-page');
   page = parseInt(page);
   console.log(page);
    $.ajax({
       type:'POST',
       url:"{{ url('profile/pagination')}}",
       data:{
               "_token": "{{ csrf_token() }}",
               page: page,
               id: '{{ $user->id}}',
            },
       success:function(data) {
             $("#tag_table").empty().html(data);
             var total = '{{ $total_pages}}'; 
             $('a[data-page!='+page+']').parent().removeClass("active");
             $('a[data-page='+page+']').parent().addClass("active");
             var pre = document.getElementById("pre");
             var next = document.getElementById("next");
              next = page + 1;
              pre = page  - 1;
             var tot = parseInt(total) +1;
             if(pre <= 1)
              {
                pre = 1;
              }
             if(next >= tot)
             {
              next = parseInt(tot) -1;
             }
             $("#next").attr('data-page',next);
             $("#pre").attr('data-page',pre);
             // alert(page+ '//'+next+'///'+pre);
       }
    });

  });
});
</script>
@endsection