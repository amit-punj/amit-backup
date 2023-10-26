<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('layouts.partials.head')
	</head>
	<body>
		<div id="main">
			@include('layouts.partials.header')
			<main class="py-4">
				@yield('content')
			</main>
			@include('layouts.partials.footer')
			@include('layouts.partials.footer-scripts')
			@yield('scripts')
		</div>
	</body>
</html>