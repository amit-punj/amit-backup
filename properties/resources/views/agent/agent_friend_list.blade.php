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
div#main {
    background-color: #f3f3f3;
}
.btn-danger{
  margin-left: 3%;
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
                 <div class="note"><p style="font-size: 22px;"> My <span style="color: #41ac1b"> Connection </span> List </p>
                 </div> 
      @if(count($data))                  
            <div class="table-responsive">     
              <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                 <tbody>   
              @foreach($data as $datas)
                    @if($datas->user->id != Auth::user()->id) 
                     <tr>
                        <td>
                            <a style="color: green;" href="{{ url('property/user/view/'.$datas->user->id)}}">{{ $datas->user->fname }}  {{ $datas->user->lname }}</a>
                        </td>
                        <td>
                           @if($datas->confirm == 0)
                             Request not confirm
                           @endif
                           @if($datas->confirm == 1)
                             Friends
                           @endif
                        </td>
                        <td> @if(!empty($datas->user->address)) {{ $datas->user->address }} @else Not found!!   @endif</td>
                        <td>
                         <div style="display: flex;">
                          <a href="{{ url('chat-users/'.$datas->user->id)}}" class="btn btn-success">Message</a>
                          <form action="{{ url('unfriend/agent/'.$datas->id) }}" method="post">
                          @csrf
                          <button class="btn btn-danger del" type="submit">Remove</button>
                          </form>
                          </div>
                        </td> 
                     </tr>
                     @elseif($datas->users->id != Auth::user()->id)
                      <tr>
                        <td>
                            <a style="color: green;" href="{{ url('property/user/view/'.$datas->users->id)}}">{{ $datas->users->fname }}  {{ $datas->users->lname }}</a>
                        </td>
                        <td>
                           @if($datas->confirm == 0)
                             Request not confirm
                           @endif
                            @if($datas->confirm == 1)
                              Friends
                           @endif
                        </td>
                        <td>@if(!empty($datas->users->address)) {{ $datas->users->address }} @else Not found!!   @endif</td>
                        <td style="">
                        <div style="display: flex;">
                          <a href="{{ url('chat-users/'.$datas->users->id)}}" class="btn btn-success">Message</a>
                          <form action="{{ url('unfriend/agent/'.$datas->id) }}" method="post">
                          @csrf
                          <button class="btn btn-danger del" type="submit">Remove</button>
                          </form>
                          </div>
                        </td> 
                      </tr>

                     @endif
              @endforeach        
                 </tbody>
              </table>
            </div>
       @else
     <p style="margin-top: 3%;">No Agent found</p>
       @endif       

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
  $(".del").click(function(){
    if (!confirm("Do you want to unfriend this person ??")){
      return false;
    }
  });
});
</script>

@endsection        
