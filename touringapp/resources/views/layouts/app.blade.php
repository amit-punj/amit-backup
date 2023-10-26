<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        <div id="app">
            @include('layouts.partials.nav')
            <main class="py-4 maincontent-app">
                @yield('content')
            </main>
            @include('layouts.partials.footer')
            @include('layouts.partials.footer-scripts')
            @yield('scripts')
        </div>
    </body>
</html>
