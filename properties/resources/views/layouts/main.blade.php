<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		@include('layouts.partials.head')
	<body>
		@include('layouts.partials.header')
		<div id="main">
			<main class="">
				@yield('content')
			</main>
			@include('layouts.partials.footer')
			@include('layouts.partials.footer-scripts')
			@yield('scripts')
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARGpUdzBWKnyufzqzh6sS2jlB91Grx9Ys&libraries=places&callback=initAutocomplete"></script>
		</div>
	</body>
</html>