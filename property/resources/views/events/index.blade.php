@section('title','My Calendar')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'My Calendar'])
<style type="text/css">
    .tags {width: 15px;height: 15px;margin-right: 10px;}
    .fc-sat { background-color:#cacaca91; }
    .fc-sun { background-color:#cacaca91; }
    .mr-10 {margin-right: 10px;}
    .mb-20 {margin-bottom: 20px;}
    .top-nevigation {padding-bottom: 25px; }
    .top-nevigation li {border: 0 !important; padding: 0 6px; }
    .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    .float-right { float: right; }
    ul.nav.nav-tabs { border: 0; }
    button.fc-state-default.fc-state-active {
        background: #f28302;
        color: #fff;
        border: 0 !important;
        padding: 10px;
        height: 40px;
    }
    button.fc-state-default {
        padding: 10px;
        height: 40px;
    }
    .mb-20 table tr:hover {
        background-color: unset !important;
    } 
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 top-nevigation">
            @include('events.calendar-top-navigation')
        </div>
        <div class="col-md-11">
            <div class="add-unit-main float-right" style="display:flex;">
                <div class="tags" style="background: #9025548c;"></div><p class="mr-10">Not Available</p>
                <div class="tags" style="background: #f6e588;"></div><p class="mr-10">Holidays</p>
                <div class="tags" style="background: #cacaca91;"></div><p class="mr-10">Weekend</p>
                @if (Route::has('login'))
                    @if(Auth::user()->user_role == 4)
                        <div class="tags" style="background: #349a6e;"></div><p class="mr-10">Entry Appointments</p>
                        <div class="tags" style="background: #82a21c;"></div><p class="mr-10">Exit Appointments</p>
                    @else
                        <div class="tags" style="background: #349a6e;"></div><p>Appointments</p>
                    @endif
                @endif
        </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-10 col-md-offset-1 mb-20">
            {!! $calendar->calendar() !!}
        </div>
    </div>
</div>
{!! $calendar->script() !!}
@endsection