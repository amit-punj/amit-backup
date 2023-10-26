@extends('admin.layouts.app')
@section('content')

<h2 style="margin-left: 2%; margin-top: 7%;">Property List</h2>
@if(Session::has('flash_message_delete'))
			<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{!! session('flash_message_delete') !!}</strong>
			</div>
		@endif
@if(isset($customer))
 <div class="row">
 @foreach($customer as $customers)
  <div class="column">
    <div class="card">
    <h4>{{$customers->title}}</h4>      
      <p><b>Property type</b> : {{$customers->property_type}}</p>
       <p><b>Min-price or max</b> : ${{$customers->min_price}} - {{$customers->max_price}}</p>
        <p><b>Room min-max </b> : {{$customers->min_room}}  To  {{$customers->max_room}}</p>
        <div class="row">
        <div class="col-md-5">
        <a style="border-style: none; color: white;" href='{{ url("admin/view/requirement/{$customers->id}") }}' class="btn btn-info">view  Requirement detail</a>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5"><a href='{{url("viewuser/{$customers->userid}")}}' style=" background-color: #33414d; border-style: none; color: white;" class="btn">view customer</a></div>
        </div>
     </div>
    </div>
  @endforeach
  </div>
  @endif
{!! $customer->render() !!}
<style type="text/css">
	
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 33%;
  padding: 0 10px;
  margin-top: 2%;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
</style>
@endsection