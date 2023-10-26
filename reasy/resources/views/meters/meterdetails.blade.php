@section('title','Meter Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Meter Details'])
<?php 
$role = Auth::user()->user_role; 
$meterPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'meter_permission');
$readingPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'reading_permission');
$documentPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'documents_permission');
?>
    <div class="container bootom-space">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                        {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <div class="Building-title">Meter Details</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <?php $unit_id = (isset($_GET['uID'])) ? $_GET['uID'] : '' ; ?>
                            <a class="btn btn-success" href="{{ url('list-meters/'.$unit_id) }}">Back</a>
                            @if($role == 2)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateMeter">Update Meter</button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_reading">Add Reading  <span class="glyphicon glyphicon-plus"></span></button>
                            @elseif($role == 3)
                                @if($meterPermission !=0)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateMeter">Update Meter</button>
                                @endif
                                @if($readingPermission !=0)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_reading">Add Reading  <span class="glyphicon glyphicon-plus"></span></button>
                                @endif
                            @elseif($role == 4)
                                @if($meterPermission !=0)
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateMeter">Update Meter</button>
                                @endif
                                @if($readingPermission !=0)
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#PDEadd_reading">Add Reading<span class="glyphicon glyphicon-plus"></span></button>
                                @endif
                            @endif
                            
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                            <div class="unit"><span>Unit Name : </span> {{ $unit->unit_name }}</div>
                            <div class="unit capital"><span>Meter Type : </span> {{ str_replace('_',' ',$meter->meter_type) }}</div>
                            <div class="unit"><span>Per Unit Price : </span> {{ App\Helpers\Helper::CURRENCYSYMBAL.$meter->unit_price }} </div> 
                            <div class="unit"><span>EAN Number : </span> {{ $meter->ean_number }} </div>
                            <div class="unit"><span>Meter Number : </span> {{ $meter->meter_number }} </div>
                            <div class="unit"><span>Consumption : </span> {{ $meter->consumption }}% </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Building-Units">Meter Readings</div>
                    </div>
                </div>
                @if(count($meterReadings) > 0)
                <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >S.No</td>
                                        <td >Date</td>
                                        <td >Last Reading</td>
                                        <td >Current Reading</td>
                                        <td >Per unit Price</td>
                                        <td >Total Amount</td>
                                        <td >Status</td>
                                        <td >Document's</td>
                                    </tr>
                                    @foreach($meterReadings as $Reading)    
                                    <tr>
                                        <td >{{$loop->index+1}}</td>
                                        <td > {{ $Reading->reading_date }}</td>
                                        <td >
                                            @if($Reading->last_reading == '')
                                                No Last Reading
                                            @else
                                                {{ $Reading->last_reading }}
                                            @endif
                                        </td>
                                        <td >{{ $Reading->current_reading }}</td>
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL.$Reading->per_unit_price }}</td>
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL.$Reading->amount }}</td>
                                        <td class="upper_text">{{ $Reading->status }}</td>
                                        @if($Reading->upload_document)
                                        <td >
                                            <div class="documemt_action">
                                                Uploaded    
                                                @if($role == 3)
                                                    @if($documentPermission !=0)
                                                        <a class="delete" href="{{ url('delete-meter-reading/'.$Reading->id) }}"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>
                                                    @endif
                                                @endif
                                                @if($Reading->upload_document != '')
                                                    <a href="{{ url('images/meter_reading_document/').'/'.$Reading->upload_document }}" download><span title="Download Document" class="glyphicon glyphicon-download-alt"></span></a>
                                                @endif   
                                            </div>
                                        </td>
                                        @else
                                        <td>Not Uploaded</td>
                                        @endif
                                    </tr> 
                                    @endforeach  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                {{ $meterReadings->links() }}
                @else
                <div class="row">
                    <div class="col-sm-12">
                        <div class="not_found_reading">Not Found Any Reading</div>
                    </div>
                </div>
                @endif                                      
            </div>
        </div>
    </div>
    @if($role != 4) 
    <div class="modal fade" id="add_reading" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/add-meter-reading/'.$meter->id) }}" id="add_reading_form">
                    @csrf
                    <input id="unit_id" type="hidden"  name="unit_id" value="{{$unit->id}}">
                     <input id="type" type="hidden"  name="type" value="normal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Add Reading</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Reading') }}</label>
                        <div class="col-md-6">
                           <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" name="reading_date" type="text" value="" readonly="">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_reading" class="col-md-4 col-form-label text-md-right">{{ __('Last Reading') }}</label>
                        <div class="col-md-6">
                            <input id="last_reading" type="text" class="form-control" name="last_reading" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_reading" class="col-md-4 col-form-label text-md-right">{{ __('Current Reading') }}</label>
                        <div class="col-md-6">
                            <input id="current_reading" type="text" class="form-control" name="current_reading" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="per_unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Per unit Price') }}</label>
                        <div class="col-md-6">
                            <input id="per_unit_price" type="text" class="form-control" name="per_unit_price" value="{{ $meter->unit_price}}" readonly="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                        <div class="col-md-6">
                            <input id="amount" type="text" class="form-control" name="amount" value="0" readonly="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                        <div class="col-md-6">
                            <select name="status" id="status" class="form-control green" aria-invalid="false">
                                <option value="pending">Pending</option>
                                <option value="confirm">Confirm</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upload_document" class="col-md-4 col-form-label text-md-right">{{ __('Upload Document') }}</label>

                        <div class="col-md-6">
                            <input id="upload_document" type="hidden"  name="upload_document" >
                            <input id="upload_document_drop" type="file" class="form-control @error('upload_image') is-invalid @enderror" value=""  name="upload_document_drop" accept="image/*">

                            @error('banner_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div id="show_upload_document"></div>
                        </div>                                                
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Add Reading</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <div class="modal fade" id="updateMeter" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/update-meter') }}" id="update_meter" enctype="multipart/form-data">
                    @csrf
                    <input id="meter_id" type="hidden" class="form-control" name="meter_id" value="{{ $meter->id }}">
                    <input id="unit_id" type="hidden"  name="unit_id" value="{{$unit->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Update Meter</h3>
                </div>
                <div class="modal-body">
                     <div class="form-group row">
                        <label for="meter_type" class="col-md-4 col-form-label text-md-right">{{ __('Meter Type') }}</label>
                        <div class="col-md-6">
                            <div class="unit capital">{{ str_replace('_',' ',$meter->meter_type) }}</div>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Per Unit Price') }}</label>
                        <div class="col-md-6">
                            <input id="update_unit_price" type="text" class="form-control" name="unit_price" value="{{ $meter->unit_price}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ean_number" class="col-md-4 col-form-label text-md-right">{{ __('EAN Number') }}</label>
                        <div class="col-md-6">
                            <input id="update_ean_number" type="text" class="form-control" name="ean_number" value="{{ $meter->ean_number }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_number" class="col-md-4 col-form-label text-md-right">{{ __('Meter Number') }}</label>
                        <div class="col-md-6">
                            <input id="update_meter_number" type="text" class="form-control" name="meter_number" value="{{ $meter->meter_number }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_number" class="col-md-4 col-form-label text-md-right">Consumption (%)</label>
                        <div class="col-md-6">
                            <input id="consumption" type="text" class="form-control" name="consumption" value="{{ $meter->consumption }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @if($role == 4)
    <div class="modal fade" id="PDEadd_reading" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/add-meter-reading/'.$meter->id) }}" id="PDEadd_reading_form">
                    @csrf
                    <input id="unit_id" type="hidden"  name="unit_id" value="{{$unit->id}}">
                    <input id="type" type="hidden"  name="type" value="entry">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Add Reading</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Reading') }}</label>
                        <div class="col-md-6">
                           <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" name="reading_date" type="text" value="" readonly="">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                   <!--  <div class="form-group row">
                        <label for="last_reading" class="col-md-4 col-form-label text-md-right">{{ __('Last Reading') }}</label>
                        <div class="col-md-6">
                            <input id="last_reading" type="text" class="form-control" name="last_reading" value="">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="current_reading1" class="col-md-4 col-form-label text-md-right">{{ __('Current Reading') }}</label>
                        <div class="col-md-6">
                            <input id="current_reading1" type="text" class="form-control" name="current_reading" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="per_unit_price" class="col-md-4 col-form-label text-md-right">{{ __('Per unit Price') }}</label>
                        <div class="col-md-6">
                            <input id="per_unit_price" type="text" class="form-control" name="per_unit_price" value="{{ $meter->unit_price}}" readonly="true">
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;">
                        <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                        <div class="col-md-6">
                            <input id="amount" type="text" class="form-control" name="amount" value="0" readonly="true">
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                        <div class="col-md-6">
                            <select name="status" id="status" class="form-control green" aria-invalid="false">
                                <option value="pending">Pending</option>
                                <option value="confirm" selected="">Confirm</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upload_document" class="col-md-4 col-form-label text-md-right">{{ __('Upload Document') }}</label>

                        <div class="col-md-6">
                            <input id="upload_document" type="hidden"  name="upload_document" >
                            <input id="upload_document_drop" type="file" class="form-control @error('upload_image') is-invalid @enderror" value=""  name="upload_document_drop" accept="image/*">

                            @error('banner_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div id="show_upload_document"></div>
                        </div>                                                
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Add Reading</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <script type="text/javascript">
        jQuery('#add_reading_form').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                reading_date:{
                    required:true,
                },
                last_reading:{
                    required:true,
                    number:true
                },
                current_reading:{
                    required:true,
                    number:true
                },
                amount:{
                    required:true,
                    number:true
                },
                status:{
                    required:true,
                },
            }      
        });
        jQuery('#PDEadd_reading_form').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                reading_date:{
                    required:true,
                },
                current_reading:{
                    required:true,
                    number:true
                },
                status:{
                    required:true,
                },
            }      
        });
        var date_format = '{!! \Helper::DateTimeFormat() !!}';
        var end = new Date();
        end.setDate(end.getDate() + 1);
        jQuery('.form_datetime').datetimepicker({
            format: date_format,
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            startDate: new Date(),
            endDate: end
        });
        
        jQuery('#current_reading').blur(function(){
            var reading = parseInt(jQuery('#current_reading').val()) - parseInt(jQuery('#last_reading').val());
            var amount = reading * {{ $meter->unit_price}};
            jQuery('#amount').val(amount);
        });
        jQuery('#add_reading_form').submit(function(){
            jQuery('#current_reading_custom_error').remove();
            var validator = jQuery( "#add_reading_form" ).validate();
            validator.element( "#last_reading" );
            validator.element( "#current_reading" );
            if(validator.element( "#last_reading" ) && validator.element( "#current_reading" )){
                //alert(jQuery('#last_reading').val()+jQuery('#current_reading').val());
                if(parseInt(jQuery('#last_reading').val()) > parseInt(jQuery('#current_reading').val())) {
                    jQuery('#current_reading').after('<div id="current_reading_custom_error" class="red">Current reading should be greater then last reading</div>');
                    return false;
                } else {
                    var reading = parseInt(jQuery('#current_reading').val()) - parseInt(jQuery('#last_reading').val());
                    var amount = reading * {{ $meter->unit_price}};
                    jQuery('#amount').val(amount);
                }
            } 

        });

        jQuery('#upload_document_drop').change(function(){
            var file_data = $('#upload_document_drop').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('_token', '<?php echo csrf_token() ?>');
            //alert(form_data);
            jQuery.ajax({
                url: "{{ url('/meter-reading-document') }}",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    jQuery('#show_upload_document').html('<img src="{{ url("/images/meter_reading_document")}}/'+data.target_file+'" width="100px">');
                    jQuery('#upload_document').val(data.target_file);
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.delete').click(function(e){
                e.preventDefault();
               var href      = jQuery(this).attr('href');
               var result = confirm("Want to Delete Reading?");
               if (result) {
                   window.location = href;
               }
            });
        });
        </script>
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span {font-size: 15px; font-weight: bold; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .add-unit-main {text-align: right; margin-top: 0px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: center; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
        .unit.capital {text-transform: capitalize; }
        div#current_reading_custom_error {color: red; }
        td.upper_text {text-transform: capitalize; }
    </style>
@endsection