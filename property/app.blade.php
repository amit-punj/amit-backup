<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>Reasy - @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="{{url('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
  <link href="{{url('css/bootstrap-timepicker.min.css')}}" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="{{url('css/custom.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="{{url('js/jqvalidation.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{url('js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
 <script type="text/javascript" src="{{url('js/bootstrap-timepicker.min.js')}}" charset="UTF-8"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
  <link href="{{url('css/jquery-ui.multidatespicker.css')}}" rel="stylesheet">
  <link href="{{url('css/datepicker.css')}}" rel="stylesheet">
  <script type="text/javascript" src="{{url('js/datepicker.js')}}"></script>
  <script type="text/javascript" src="{{url('js/jquery-ui.multidatespicker.js')}}"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <style type="text/css">   
    .home-main{ background-image: url("{{ url('/images/banner.jpg') }}");}
    /*.property-main{ background-image: url("{{ url('/images/5.jpeg') }}"); }*/
    .small-banner{ background-image: url("{{ url('/images/small_banner.jpg') }}");  }
    table tr:hover {background-color: #f484008f !important; } 
 </style>
</head>
<body>
  @if(Request::is('/'))
    <div class="home-main">
        @include('layouts.header') 
         @yield('content')
         @include('layouts.footer')  
    </div>
  @else
    @include('layouts.header') 
    @yield('content')
    @include('layouts.footer') 
  @endif
</body>
</html>
