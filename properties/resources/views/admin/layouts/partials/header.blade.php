<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
  integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- drop cdn -->
<!-- <script src="{{ url('/js/dropzone.js') }}"></script> -->
 <!--    <script src="{{ url('/js/dropzone-config.js') }}"></script> -->
   <script type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone-amd-module.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
   <script src="jquery-3.4.1.min.js"></script>
<!-- select to dropdown -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <!--   <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" /> -->
    <link href="{{ asset('admin_asset/css/theme-default.css') }}" rel="stylesheet">
   <!--  <link rel="stylesheet" href="{{ asset('css/backend_css/subscription_form.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/edit-profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/datepicker.css') }}" /> -->
    <style type="text/css">
      span.help-inline {
    color: red;
}
    </style>
</head>
<body>