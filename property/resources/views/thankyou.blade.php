@section('title','Thank you')
@extends('layouts.app')
@section('content')
<!-- @include('layouts.banner', ['banner_text' => 'Thank you']) -->
<div class="jumbotron text-center">
  <h1 class="display-3">Thank You!</h1>
  	<div class="container">
	  	<div class="row">
	  		<div class="col-md-3"></div>
	  		<div class="col-md-6">
				<table class="table table-hover table-striped table-bordered">
				  	<thead>
				  		<tr>
				  			<th class="text-center" colspan="2">Property Details</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<tr>
				  			<td style="width: 40%">Property Name:</td>
				  			<td>{{$unit_details->unit_name}}</td>
				  		</tr>
				  		<tr>
				  			<td style="width: 40%">Property Description:</td>
				  			<td>{{substr($unit_details->description,0, 100)}}</td>
				  		</tr>
				  	</tbody>
				</table>
			</div>
	  		<div class="col-md-3"></div>
		</div>
		<div class="row">
	  		<div class="col-md-3"></div>
	  		<div class="col-md-6">
				<table class="table table-hover table-striped table-bordered">
				  	<thead>
				  		<tr>
				  			<th class="text-center" colspan="2">Property Expert Details</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<tr>
				  			<td style="width: 40%"> Name:</td>
				  			<td> {{$pde_details->name}}</td>
				  		</tr>
				  		<tr>
				  			<td style="width: 40%">Phone No:</td>
				  			<td>{{$pde_details->phone_no}}</td>
				  		</tr>
				  	</tbody>
				</table>
			</div>
	  		<div class="col-md-3"></div>
		</div>
	</div>
  <p class="lead"><strong>Please check your email</strong> for further instructions and list of documents to bring when coming for meeting with Property Expert.</p>
  <hr>
  <!-- <p>
    Having trouble? <a href="">Contact us</a>
  </p> -->
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="{{ url('/') }}" role="button">Continue to homepage</a>
  </p>
</div>
@endsection