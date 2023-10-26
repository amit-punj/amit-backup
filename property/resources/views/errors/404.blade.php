@section('title','404 Page') 
@extends('layouts.app')
@section('content')
	<div class="main-body">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="content-title">404</div>
					<div class="content-not-found">Page Not Found</div>
					<div class="content-link"><a href="{{ url('/') }}">Go To Home Page</a></div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		.main-body {min-height: 500px; background-color: #ddd; }
		.content-title {font-size: 250px; text-align: center; }
		.content-not-found {text-align: center; font-size: 35px; }
		.content-link {text-align: center; font-size: 25px; width: 200px; padding: 12px 10px; font-size: 14px; background-color: #ff8500; border-radius: .25rem; margin: 10px auto; font-weight: bold; }
		.content-link a {color: #fff; }
	</style>
@endsection