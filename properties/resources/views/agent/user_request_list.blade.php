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
td{
    width: 2%;
}
.btn-success{
    margin-right: 4%;
}
@media screen and (max-width: 533px){
  a.btn.btn-danger{
    margin-top: 2%;
  }
}
@media only screen and (max-width: 766px) and (min-width: 645px){
a.btn.btn-danger{
    margin-top: 0 !important;
  }
}
@media screen and (max-width: 823px){
  a.btn.btn-danger{
    margin-top: 2%;
  }
}
@media screen and (max-width: 475px)
{
  a.btn.btn-success{
    font-size: 12px;
  }
  td{
    font-size: 12px;
  }
  th{
    font-size: 14px;
  }
  a.btn.btn-danger{
    font-size: 12px;
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
                 <div class="note"><p style="font-size: 22px;"> My <span style="color: #41ac1b">Connection Request </span> List </p>
                 </div>
        @if(count($user_list))         
            <div class="table-responsive">     
              <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                 <tbody>   
                @foreach($user_list as $user_lists)
                     <tr>
                        <td><a style="color: green;" href="{{ url('property/user/view/'.$user_lists->user->id)}}"> {{ $user_lists->user->fname }} {{ $user_lists->user->lname }}</a></td>
                        <td>{{ $user_lists->created_at->diffForHumans()}}</td>
                        <td>
                          <a href="{{ url('request/accept/user/'.$user_lists->id)}}" class="btn btn-success" name="accept" value="accept">Accept</a>
                          <a href="{{ url('request/cancel/user/'.$user_lists->id)}}" class="btn btn-danger" name="cancel" value="cancel">Cancel</a>
                        </td>
                     </tr>
                @endforeach       
                 </tbody>
              </table>
            </div>
        @else
      <p style="margin-top: 3%;">  
      No Request found
      </p>
        @endif      

        </div>
    </div>
</div>
@endsection        
