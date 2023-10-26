@section('title','Add Availability')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Add Availability'])
<style type="text/css">
     .top-nevigation {padding-bottom: 25px; }
    .top-nevigation li {border: 0 !important; padding: 0 6px; }
    .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    ul.nav.nav-tabs { border: 0; }
    .pl-0 {padding-left: 0 !important;}
    .btn-default:hover {color: #333; background-color: #ec971f; border-color: #adadad;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 top-nevigation">
            @include('events.calendar-top-navigation')
        </div>
    </div> 
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form method="POST" action="{{url('add-availability')}}" id="add_availability" style="margin-left: 7px !important;">
                @csrf
                <div class="form-group row">
                    <label for="rent" class="col-md-2 col-form-label text-md-right">{{ __('Working Hours') }}</label>
                    <div class="col-md-10" id="available_time">
                        <div class="col-md-4 pl-0"><span>From </span>
                            <input type="text" name="start_time" id="start_time">
                        </div>
                        <div class="col-md-8 pl-0"><span>To </span>
                            <input type="text" name="end_time" id="end_time">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rent" class="col-md-2 col-form-label text-md-right">{{ __('Weekend Days') }}</label>
                    <div class="col-md-10">
                        <div id="week_days" class="">
                            <?php
                                $timestamp = strtotime('next Sunday');
                                $explode = [];
                                if($usersAvailability){
                                    $explode = explode(',', $usersAvailability->days);
                                }
                                $days = '';
                                for ($i = 0; $i < 7; $i++) {
                                    $days = strftime('%A', $timestamp);
                                    $timestamp = strtotime('+1 day', $timestamp);
                                    ?>
                                        <span class="button-checkbox">
                                            <button type="button" class="btn" data-color="warning">{{$days}}</button>
                                            @if(in_array($i, $explode) )
                                            <input value="{{$i}}" type="checkbox" class="hidden" name="days[]" checked />
                                            @else
                                            <input value="{{$i}}" type="checkbox" class="hidden" name="days[]" />
                                            @endif
                                        </span>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>                
                <!-- <div class="form-group row">
                    <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Holidays') }}</label>
                    <div class="col-md-6">
                       <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                            <input class="form-control" size="16" name="time" type="text" value="" readonly >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
                </div>  -->
                <div class="form-group row">
                    <label for="rent" class="col-md-2 col-form-label text-md-right">{{ __('Holidays') }}</label>
                    <div class="col-md-10">
                        <div id="any_days" class="">
                            <div id="datepicker_not_av"></div>
                        </div>
                        @if($usersAvailability)
                        <input type="hidden" name="selecteddates" value="{{$usersAvailability->selecteddates}}" class="selecteddates" />
                        @else
                        <input type="hidden" name="selecteddates" value="" class="selecteddates" />
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-md-4 col-form-label text-md-right"></label>
                    <div class=" col-md-6 btn-group btn-group-lg" >
                        <button class="btn btn-primary btn-lg" type="Submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    // var date = new Date();
    // $('.form_datetime').datetimepicker({
    //     weekStart: 1,
    //     todayBtn:  1,
    //     autoclose: 1,
    //     todayHighlight: 1,
    //     startView: 2,
    //     forceParse: 0,
    //     showMeridian: 1,
    //     startDate: date
    // });
    $('#start_time').timepicker({
        minuteStep: 1,
        secondStep: 5,
        showInputs: true,
        modalBackdrop: true,
        showSeconds: true,
        showMeridian: true,
        @if($usersAvailability)
        defaultTime: '{{$usersAvailability->start_time}}',
        @else
        defaultTime: '9:00:00 AM',
        @endif
    });
    $('#end_time').timepicker({
        minuteStep: 1,
        secondStep: 5,
        showInputs: true,
        modalBackdrop: true,
        showSeconds: true,
        showMeridian: true,
        @if($usersAvailability)
        defaultTime: '{{$usersAvailability->end_time}}',
        @else
        defaultTime: '9:00:00 PM',
        @endif
    });
</script>
<script>
    <?php 
        $dates = '';
        if($usersAvailability){
            $dates = str_replace(",", "','",$usersAvailability->selecteddates);
        }
    ?>
    $( function() {
        var values = [];
        $( "#datepicker_not_av" ).multiDatesPicker({
            changeMonth: true,
            changeYear: true,
            minDate:0,
            @if($dates != '')
            addDates: [ '<?php echo $dates ?>' ],
            @endif
            onSelect: function(selectedDate) {
                var selectVal = $('.selecteddates').val();
                if(selectVal  == ''){
                    var selectValArray = new Array();
                } else {
                    var selectValArray = selectVal.split(",");
                }
                if(selectValArray.indexOf(selectedDate) > 0 ){
                    for( var i = 0; i < selectValArray.length; i++){ 
                       if ( selectValArray[i] === selectedDate) {
                         selectValArray.splice(i, 1); 
                       }
                    }
                } else {
                    selectValArray.push(selectedDate);
                }
                var values = selectValArray;
                var unique = values.filter(function(itm, i, values) {
                    return i == values.indexOf(itm);
                });
                $('.selecteddates').val(unique);
            }
        });
    } );
</script>
<script type="text/javascript">
    $(function () {
        $('.button-checkbox').each(function () {
            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };
            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });
            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');
                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");
                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);
                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }
            // Initialization
            function init() {
                updateDisplay();
                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                }
            }
            init();
        });
    });
</script>
@endsection