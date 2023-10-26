@section('title','Book Appointment')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Book Appointment'])


    <div class="container bootom-space">
        <div class="row">
                @include('layouts.flash_message')
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <?php $string = (isset($_GET['type']) ) ? $_GET['type'] : '' ; ?>
                        <?php $url = (isset($id) && $id !="" ) ? 'book-appointment/'.$id.'?type='.$string : 'book-appointment' ; ?>
                        <form id="book_appointment" method="post" action="{{url($url)}}">
                            @csrf
                            <!-- <input id="tenent_id" type="hidden" class="form-control" name="tenent_id" value="{{ $user->id }}"> -->
                            <!-- <input id="pde_id" type="hidden" class="form-control" name="pde_id" value="{{ $user->id }}"> -->
                            <input type="hidden" value="{{$string}}" name="type">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Select Contract') }}</label>
                                <div class="col-md-9">
                                    @if(isset($id) && $id !="" )
                                        <select class="form-control" name="contract_id" id="contract_id">
                                            @if(count($contracts) > 0)
                                                @foreach($contracts as $key => $contract)
                                                    <option data-sDate="{{$contract->start_date}}" value="{{$contract->id}}" {{ (isset($id) && $id == $contract->id) ? 'selected' : '' }} >{{ ucfirst($contract->unit->u_type)}} ({{$contract->unit->unit_name}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @else
                                        <select class="form-control" name="contract_id" id="contract_id">
                                            <option value="">Select Contract</option>
                                            @if(count($contracts) > 0)
                                                @foreach($contracts as $key => $contract)
                                                 @php 
                                                    $days = Helper::AppointmentBeforeContractStartDate();
                                                    $current_date = strtotime(date("Y-m-d"));
                                                    $contract_s_date = strtotime($contract->start_date. ' - '.$days.' days');
                                                @endphp
                                                @if($current_date < $contract_s_date)
                                                    <option data-sDate="{{$contract->start_date}}" value="{{$contract->id}}" >{{ ucfirst($contract->unit->u_type)}} ({{$contract->unit->unit_name}})</option>
                                                @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif
                                    @if ($errors->has('contract_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('contract_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Unit Name') }}</label>
                                <div class="col-md-9">
                                    @if(isset($id) && $id !="" )
                                	    <input id="unit_id" type="hidden" class="form-control" name="unit_id" value="{{ $units->id }}">
                                    	<input id="unit_name" type="text" class="form-control"  name="unit_name" readonly="" placeholder="Unit Name" value="{{ $units->unit_name }}">
                                    @else
                                        <input id="unit_id" type="hidden" class="form-control" name="unit_id" value="">
                                        <input id="unit_name" type="text" class="form-control"  name="unit_name" readonly="" placeholder="Unit Name" value="">
                                    @endif
                                    @if ($errors->has('unit_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('unit_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Tenent Name') }}</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control"  name="name" readonly="" placeholder="jhon" value="{{ $user->name }}">
                                </div>
                            </div> -->
                            <!-- <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Place Description Expert') }}</label>
                                <div class="col-md-9">
                                    <input id="pde_name" type="text" class="form-control"  name="pde_name" readonly="" placeholder="jhon" value="{{ $user->name }}">
                                </div>
                            </div> -->
                            <div class="form-group row" id="AT">
                                <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime') }}</label>
                                <div class="col-md-9
                                ">
                                   <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                        <input class="form-control" size="16" name="time" type="text" value="{{old('time')}}" readonly >
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                    </div>
                                    @if ($errors->has('time'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('time') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-9">
                                    <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Enter Title" required="">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="description" placeholder="Description"></textarea> 
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="rent" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-9 text-center">
                                    <button type="submit" class="btn btn-success">Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <style type="text/css">
      .make_payment img {width: 100px; height: 35px; }
      .make_payment {margin: 0 auto; text-align: center; padding: 15px 0 30px; }
      .float-right { float: right; }
      .help-block { color: red !important; font-size: 13px; }
      .datetimepicker.datetimepicker-dropdown-bottom-right.dropdown-menu { left: 400px !important; }
    </style>

<script type="text/javascript">
    var date = new Date();
    var end_date = new Date(' @if( isset($id)) {{$contracts[0]->start_date}} @endif');
    date.setDate(date.getDate() + {!! \Helper::AppointmentsDate() !!});
    end_date.setDate(end_date.getDate() - {!! \Helper::AppointmenteDate() !!});
    var date_format = '{!! \Helper::DateTimeFormat() !!}';

    // var weekends = ' @if( isset($id)) {{$weekends}} @endif';
    // var weekends = weekends.split(",");
    // var holidays = ' @if( isset($id)) {{$holidays}} @endif';
    // var holidays = holidays.split(",");

    $('.form_datetime').datetimepicker({
        format: date_format, 
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        // daysOfWeekDisabled: weekends,
        // datesDisabled: holidays,
        startDate: date,
        endDate: end_date,
    });



    jQuery('#book_appointment').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            contract_id:{
                required:true,
            },
            title:{
                required:true,
            },
            time:{
                required:true
            }
        }      
    });

    jQuery('#contract_id').change(function(){
        var id = jQuery(this).val();
        var AT_html = $('#AT').html();
        var thisa = $(this);
        var sDate = $('option:selected', this).data('sdate');
        if(id != '' ){
            $.ajax( 
            {
                url: "{{url('getUnitByContract')}}",
                type: "post",
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id':id,
                },
                success : function(data) { 
                    var myJSON = JSON.parse(data); 
                    // console.log(data);                             
                    // console.log(myJSON.response);         
                    if(myJSON.status == 'success')
                    {
                        $('#AT').html(AT_html);
                        var end_date = new Date(sDate);
                        end_date.setDate(end_date.getDate() - {!! \Helper::AppointmenteDate() !!});
                        var date_format = '{!! \Helper::DateTimeFormat() !!}';
                        // var weekends = myJSON.response.weekends;
                        // var weekends = weekends.split(",");
                        // var holidays = myJSON.response.holidays;
                        $('.form_datetime').datetimepicker({
                            format: date_format,
                            weekStart: 1,
                            todayBtn:  1,
                            autoclose: 1,
                            todayHighlight: 1,
                            startView: 2,
                            forceParse: 0,
                            showMeridian: 1,
                            // daysOfWeekDisabled: weekends,
                            // datesDisabled: holidays,
                            startDate: date,
                            endDate: end_date
                        });
                        jQuery('#unit_id').val(myJSON.response.unit_id);
                        jQuery('#unit_name').val(myJSON.response.unit_name);
                    }                    
                },
                error : function(data) {
                }
            });
        }
    })
</script>
@endsection