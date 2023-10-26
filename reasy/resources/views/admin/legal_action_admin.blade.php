<div class="float-right">
    <ul class="nav nav-tabs" role="tablist">
        <li class="dropdown active">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action<b class="caret"></b></a>
            <ul class="dropdown-menu ml-75">
                @if(Auth::user()->user_role == 0 )
                    @if($contract->status == 3)
                        <li><a href="{{url('book-appointment/'.$contract->id.'?type=Entry')}}" target="_blank" style="float: right;" class="btn btn-success">Entry Appointment</a>
                        <!-- <a class="btn btn-success" data-toggle="modal" data-target="#book_visit">Entry Appointment</a>  -->
                        </li>
                    @elseif($contract->status == 6)
                        <!-- <li><a href="{{url('book-appointment/'.$contract->id.'?type=Exit')}}" target="_blank" style="float: right;" class="btn btn-success">Exit Appointment</a> -->

                        <!-- above link is completed dont delete it -->

                       <!--  <li><a class="btn btn-success" data-toggle="modal" data-target="#claimRefund">Claim Refund</a></li> -->
                        <!-- <a class="btn btn-success" data-toggle="modal" data-target="#book_visit">Exit Appointment</a></li> -->
                        <li><a class="btn btn-success" data-toggle="modal" data-target="#extend">Extand</a></li>
                        <li>
                            @if(strtotime(date("Y/m/d")) < strtotime($contract->start_date))
                                <?php $terminate_url = 'TerminateBT-Contract/'.$contract->id; ?>
                                <a onclick="return confirm('You have to pay an amount equal to rent of 3 months if you terminate contract.');" href="{{ url('TerminateBT-Contract/'.$contract->id) }}" class="btn-success btn befor-tenancy">Terminate</a>
                            @else
                                <?php $terminate_url = 'terminate-contract/'.$contract->id; ?>
                                <a target="_blank" href="{{ url('terminate-contract/'.$contract->id) }}" class="btn-success btn">Terminate</a>
                            @endif
                        </li>
                    @elseif($contract->status == 8 && isset($terminate->notice) && $terminate->notice == "BeforeTenancy")
                        <li><a class="btn btn-success" data-id="{{$contract->id}}">Termination send</a></li>
                    @elseif($contract->status == 8 && isset($terminate->notice) && ($terminate->notice == 'Yes' || $terminate->notice == 'No') )
                        <li><a target="_blank" href="{{ url('terminate-contract/'.$contract->id) }}" class="btn-success btn">On Notice Period</a></li>
                    @elseif($contract->payment_method == 'bank' && $contract->payment_status == 'pending')
                        <li><a class="btn btn-success upload_receipt" data-id="{{$contract->id}}">Receipt Upload</a></li>
                    @elseif($contract->status == 9 && $terminate->StatusForPMPO == 2 && $terminate->status == 10)
                        <li><a class="btn btn-success">Passed</a></li>
                    @endif
                @elseif(Auth::user()->user_role == 0 || Auth::user()->user_role == 0)
                    @if($contract->status == 0 && $contract->payment_status == 'paid')
                        <li><a class="btn btn-success booking_action" data-id="{{$contract->id}}" data-status="3">Accept</a></li>
                        <li><a class="btn btn-success booking_action" data-id="{{$contract->id}}" data-status="4">Reject</a></li>
                    @elseif($contract->status == 6)
                        <li><a class="btn btn-success" data-toggle="modal" data-target="#extend">Extand</a></li>
                        <li><a target="_blank" href="{{ url('terminate-contract/2') }}" class="btn-success btn">Terminate</a></li>
                    @elseif($contract->status == 8 && $terminate->StatusForPMPO == 0)
                        <li><a class="btn btn-success">Wait to update status</a></li>
                    @elseif($contract->status == 8 && $terminate->StatusForPMPO == 1)
                        <li><a class="btn btn-success" data-toggle="modal" data-target="#terminate_refund">Update status</a></li>
                    @elseif($contract->status == 9 && $terminate->StatusForPMPO == 2 && $terminate->status == 10)
                        <li><a class="btn btn-success">Passed</a></li>
                    @endif
                <!-- @elseif(Auth::user()->user_role == 4)
                    @if($contract->status == 0 && $contract->payment_status == 'paid')
                         <li><a class="btn btn-success upload_receipt" data-id="{{$contract->id}}">Upload Report</a></li>
                    @endif -->
                @endif




                <!-- @if(Auth::user()->user_role == 1)
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#claimRefund">Claim Refund</a></li>
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#book_visit">Entry Appointment</a></li>
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#book_visit">Exit Appointment</a></li>
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#extend">Extand</a></li>
                    <li><a target="_blank" href="{{ url('terminate-contract/2') }}" class="btn-success btn">Terminate</a></li>
                @elseif(Auth::user()->user_role == 1 && $contract->payment_status == 'pending' && $contract->payment_method == 'bank')
                    <li><a class="btn btn-success upload_receipt" data-id="{{$contract->id}}">Receipt Upload</a></li>
                @elseif(Auth::user()->user_role == 1 && $contract->payment_status == 'paid' && $contract->status != 'draft')
                    <li><a class="btn btn-success">Waiting for confirmation!</a></li>
                @elseif(Auth::user()->user_role == 3 && $contract->payment_status == 'paid' && $contract->status == 'draft')
                    <li><a class="btn btn-success booking_action" data-id="{{$contract->id}}" data-status="accepted">Accept</a></li>
                    <li><a class="btn btn-success booking_action" data-id="{{$contract->id}}" data-status="rejected">Reject</a></li>
                @elseif(Auth::user()->user_role == 3 && $contract->payment_status == 'paid')
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#claimRefund">Claim Refund</a></li>
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#book_visit">Entry Appointment</a></li>
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#book_visit">Exit Appointment</a></li>
                    <li><a class="btn btn-success" data-toggle="modal" data-target="#extend">Extand</a></li>
                    <li><a target="_blank" href="{{ url('terminate-contract/2') }}" class="btn-success btn">Terminate</a></li>
                @endif -->
            </ul>
        </li>
    </ul>
</div>
<div class="modal fade" id="claimRefund" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="get" id="claimRefund">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Claim Refund</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Related Department') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('t_department') is-invalid @enderror" name="t_department" id="t_department">
                                <option value="">Select Department</option>
                                <option value="pm">Property Manager</option>
                                <option value="gq">General Question</option>
                                <option value="electricity">Electricity</option>
                                <option value="heating">Heating</option>
                                <option value="internet">Internet</option>
                                <option value="keys">Keys</option>
                                <option value="plumbing">Plumbing</option>
                                <option value="insurance">Insurance</option>
                                <option value="other">Other</option>
                            </select>
                            @error('t_department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_title" class="col-md-4 col-form-label text-md-right">{{ __('Payment Ammount') }}</label>
                        <div class="col-md-6">
                            <input type="number" name="t_title" id="t_title" class="form-control @error('t_title') is-invalid @enderror">
                            @error('t_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Payment Mode') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('t_department') is-invalid @enderror" name="t_department" id="t_department">
                                <option value="">Select Mode</option>
                                <option value="pm">Paypal</option>
                                <option value="pm">Bank Transfer</option>
                            </select>
                            @error('t_department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Claim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="book_visit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="visit_booking">
                @csrf
                <input id="property_id" type="hidden" class="form-control" name="property_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Entry/Exit Appointment</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Visitor Name') }}</label>
                        <div class="col-md-9">
                            @if (Auth::guest())  
                                <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
                            @else
                                <input id="name" type="text" class="form-control"  name="name" value="{{ Auth::user()->name}}" placeholder="jhon">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-9">
                            @if (Auth::guest())  
                                <input id="email" type="email" class="form-control"  name="email" value="" placeholder="jhon@gmail.com" status="false">
                            @else
                                <input id="email" type="email" class="form-control"  name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
                            @endif
                            <span id="email_varification_message"></span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                        <div class="col-md-9">
                            <input id="phone_number" type="text" class="form-control"  name="phone_number" value="" placeholder="+911234567890" status="false">
                            <span id="phone_number_error"></span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime') }}</label>
                        <div class="col-md-9
                        ">
                           <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" name="time" type="text" value="" readonly >
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-9">
                            <input id="title" type="text" class="form-control"  name="title" value="" placeholder="Enter Title">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" placeholder="Description"></textarea> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="terminate" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="get" id="visit_add_remark">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Add Remark for Termination</h3>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Appointment Status *') }}</label>
                        <div class="col-md-6">
                            <select name="status" id="status" required="" class="form-control @error('status') is-invalid @enderror status">
                                <option value="unit">Upcoming</option>
                                <option value="building">Completed</option>
                                <option value="cancel">Cancel</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>  -->
                    <div class="form-group row">
                        <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('remark') is-invalid @enderror remark" name="remark" required="" rows="5" cols="50" placeholder="Add Remark">{{ old('remark','Add Remarks') }}</textarea>
                            @error('remark')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Terminate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="terminate_refund" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="tenant_extend_contract" action="{{url('update-terminate-status/'.$contract->id)}}">
                @csrf
                <input type="hidden" name="refund_amount" id="refund_amount" value="{{$unit->deposit}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Update Status</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-10">
                            @if($unit->deposit > 0)
                                <p><strong>Note:</strong>Tenant claimed the refund. Please refund and update the status.</p>
                            @elseif($unit->deposit <= 0)
                                <p><strong>Note:</strong>Please update the status.</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Refund Amount') }}</label>
                        <div class="col-md-6">
                            <span>{{$unit->deposit}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Refund Method') }}</label>
                        <div class="col-md-6">
                            <span>{{(isset($terminate->claim_method) ) ? ucfirst($terminate->claim_method) : '' }}</span>
                        </div>
                    </div>
                    @if(isset($terminate->claim_method) && $terminate->claim_method == 'bank')
                        <div class="bank-body" id="bank_body">
                            <div class="form-group row">
                                <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>
                                <div class="col-md-6">
                                    {{(isset($account_info->bank_name) ) ? $account_info->bank_name : '' }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ada_number" class="col-md-4 col-form-label text-md-right">{{ __('ADA Number') }}</label>
                                <div class="col-md-6">
                                    {{(isset($account_info->ada_number) ) ? $account_info->ada_number : '' }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>
                                <div class="col-md-6">
                                    {{(isset($account_info->account_number) ) ? $account_info->account_number : '' }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="routing_number" class="col-md-4 col-form-label text-md-right">{{ __('Routing Number') }}</label>
                                <div class="col-md-6">
                                    {{(isset($account_info->routing_number) ) ? $account_info->routing_number : '' }}
                                </div>
                            </div>
                        </div>
                    @elseif(isset($terminate->claim_method) && $terminate->claim_method == 'paypal')
                        <div class="paypal-body" id="paypal_body">
                            <div class="form-group row">
                                <label for="deposit" class="col-md-4 col-form-label text-md-right">Paypal Email ID</label>
                                <div class="col-sm-6">
                                    <span>{{(isset($account_info->paypal_email) ) ? $account_info->paypal_email : '' }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="extend" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="tenant_extend_contract" action="{{url('tenant-extend-contract/'.$contract->id)}}">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Add Remark for Extend</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Select Date') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="end_date" name="end_date" placeholder="{!! \Helper::Date(date('Y/m/d')) !!}" value="">
                        </div>
                        <!-- <div class="col-md-8">
                            <div id="any_days" class="">
                                <div id="datepicker_not_av"></div>
                            </div>
                            <input type="hidden" name="selecteddates" value="" class="selecteddates" />
                        </div> -->
                    </div> 
                    <div class="form-group row">
                        <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark *') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="remark" id="remark"  rows="5" cols="50" placeholder="Add Remark"></textarea>
                            @error('remark')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Extend</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="upload_receipt_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form autocomplete="off" method="POST" action="{{ url('upload-receipt') }}" enctype="multipart/form-data" id="upload_receipt_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Upload Bank Receipt</h3>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="">
                    <input type="hidden" name="url" id="url" value="{{url()->current()}}">
                    <div class="form-group row">
                        <div class="col-md-12">
                           <p><strong>Note:</strong> Please upload receipt which you get from bank after payment.</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Upload Receipt') }}</label>
                        <div class="col-md-9">
                           <input type="file" id="receipt" name="receipt">
                        </div>
                        @error('receipt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="upload" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $( function() {
        var values = [];
        $( "#datepicker_not_av" ).multiDatesPicker({
            changeMonth: true,
            changeYear: true,
            minDate:0,
            onSelect: function(selectedDate) {
                var vindex = values.findIndex(v => v == selectedDate);
                if(vindex != -1){values.splice(vindex,1);}else{
                values.push(selectedDate);
            }
            var unique = values.filter(function(itm, i, values) {
                return i == values.indexOf(itm);
            });
            $('.selecteddates').val(unique);
            }
        });
    } );
    var date = '{{ $contract->end_date }}'
    var date_format = '{!! \Helper::DateFormat() !!}';
    $('#end_date').datepicker({
        dateFormat: date_format, 
        minDate: date,
        changeMonth: true,
        changeYear: true,
    });
    jQuery('.upload_receipt').click(function(){
        var id      = $(this).data('id');
        $('#upload_receipt_modal').modal('show');
        $("#upload_receipt_modal #booking_id").val(id);
    });
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} kb');
    $("#upload_receipt_form").validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            receipt: {
              required: true,
              accept: "image/*",
              // filesize: 20000,
            }
        },
        messages: {
            receipt: {
              required: "Please upload receipt",
              accept: "The Receipt must be a file of type: jpeg, png, jpg.",
              filesize: "The Receipt may not be greater than 2MB",
            }
        },
    });
    $("#tenant_extend_contract").validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            end_date: {
              required: true,
            }
        },
        messages: {
            receipt: {
              required: "Please select a date",
            }
        },
    });
    jQuery('.booking_action').click(function(){
        var id      = $(this).data('id');
        var status  = jQuery(this).data('status');
        var thisa   = $(this);
        var result  = "";
        if(status == '3'){
            var result = confirm("Want to accept the booking?");
        }
        else if(status == '4'){
            var result = confirm("Want to reject the booking?");
        }
        if (!result) {
            return false;
        }
        $.ajax(
        {
            url: "{{url('update-booking-status')}}",
            type: "post",
            data: {
                '_token':'<?php echo csrf_token() ?>',
                'id':id,
                'status':status
            },
            success : function(data) { 
              var myJSON = JSON.parse(data); 
              location.reload();
            },
            error : function(data) {
            }
        });
    });
</script>