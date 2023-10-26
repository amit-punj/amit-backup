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
  <link rel="stylesheet" href="{{url('css/jquery.signaturepad.css')}}">
  <link rel="shortcut icon" href="{{asset('/images/logo_new.png')}}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="{{url('css/flexslider.css')}}">
  <!-- <link rel="stylesheet" href="{{url('css/jquery.fancybox.css')}}"> -->
  <link rel="stylesheet" type="text/css" href="https://airviewonline.com/assets/css/jquery.fancybox.css?v=2.1.5" media="screen" /> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
  <script type="text/javascript" src="{{url('js/jqvalidation.js')}}"></script>
  <script type="text/javascript" src="{{url('js/creditCardValidator.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{url('js/moment-with-locales.js')}}"></script>
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
  <script type="text/javascript" src="{{url('js/jquery.flexslider.js')}}"></script>
  <script type="text/javascript" src="{{url('js/numeric-1.2.6.min.js')}}"></script>
  <script type="text/javascript" src="{{url('js/bezier.js')}}"></script>
  <script type="text/javascript" src="{{url('js/jquery.signaturepad.js')}}"></script>
  <script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
  <script type="text/javascript" src="{{url('js/json2.min.js')}}"></script>
   <!-- <script type="text/javascript" src="{{url('js/jquery.fancybox.pack.js')}}"></script> -->
  <script type="text/javascript" src="https://airviewonline.com/assets/js/jquery.fancybox.pack.js?v=2.1.5"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://safetyengagement.com/assets/css/jquery.multiselect.css" type="text/css">
<script type="text/javascript" src="https://safetyengagement.com/assets/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="{{url('js/jquery.signaturepad.js')}}"></script>
<script src="{{url('js/recaptcha_api.js')}}"></script>
  @toastr_css
  @toastr_js
<!--   <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"> -->
  <style type="text/css">   
    .home-main{ background-image: url("{{ url('/images/banner.jpg') }}");}
    /*.property-main{ background-image: url("{{ url('/images/5.jpeg') }}"); }*/
    .small-banner{ background-image: url("{{ url('/images/small_banner.jpg') }}");  }
    table tr:hover {background-color: #f484008f !important; } 
 </style>
</head>
<body>
  @if(Request::is('/') || Request::is('home'))
    <div class="home-main">
        @include('layouts.header') 
        @yield('content')
        @include('layouts.footer')  
        @toastr_render
    </div>
  @else
        @include('layouts.header') 
        @yield('content')
        @include('layouts.footer') 
        @toastr_render
  @endif
</body>
</html>
