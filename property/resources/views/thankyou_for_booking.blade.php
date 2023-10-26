@section('title','Thank You For Booking')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Thank You For Booking'])
<div class="container">
  	<div class="row">
  		<div class="col-md-12">
  			<div class="thank-you-class">
  				<h1 class="display-3">Thank You For Booking!</h1>
  				<p>We will email you an Booking confirmation with details.</p>
  			</div>
  			<div class="thank-you-home">
  				<p class="lead">
				    <a class="btn btn-primary btn-sm" href="{{ url('/') }}" role="button">Continue to homepage</a>
				 </p>
  			</div>
  		</div>
	</div>
</div>
</div>
<style type="text/css">
	.thank-you-class {text-align: center; }
	.thank-you-home {text-align: center; margin: 20px 0 70px; }
	span.breadcrumbs {visibility: hidden; }
</style>
@endsection