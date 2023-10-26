<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        <div id="map_lay">
            <main class="maincontent-app">
                @yield('content')
            </main>
            <!-- @include('layouts.partials.footer') -->
            @include('layouts.partials.footer-scripts')
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?language=en&libraries=geometry&key=AIzaSyBqfifWC_FXLjDQo4j8rXkTJjHU35VWSlI">
</script>
            @yield('scripts')
        </div>
    </body>
</html>
