@section('title','Contract Terminate') 
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Contract Terminate'])
    <div class="container main">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        <div class="row">
            <div  class="col-sm-12">
                <div class="div" id="myWizard">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 20.00%;">
                            Step 1 of 6
                        </div>
                    </div>
                    <div class="navbar">
                        <div class="navbar-inner">
                            <ul class="nav nav-pills nav-wizard">
                                <?php 
                                // $wallet_amount = $user->wallet_amount + $contract->unit->deposit  ;
                                $wallet_amount = $contract->unit->deposit  ;
                                ?>
                                <?php 
                                 $step = (isset($terminate->step)) ? ++$terminate->step : 4; ?>
                                <?php $status = (isset($terminate->status)) ? $terminate->status: ''; ?>
                                <?php $total_due_amount = ($contract->unit->rent * 3 );  
                                    // $total_due_amount = 0; 
                                    // $wallet_amount = 0;
                                ?>   
                                <?php 
                                    $step = ($step == 4 && $total_due_amount <= 0 ) ? 5 : $step ; 
                                    $step = ($step == 5 && $wallet_amount <=0 ) ? 6 : $step ; 
                                    
                                    $step = ($step == 5 && $status == 5) ? 4 : (($step == 5 && $status == 8) ? 6 : ( ($step == 5 && $status == 7)? ( ($wallet_amount > 0) ? $step : 6) : $step ) );
                                    // $step = ($step == 5 && $status == 7 ) ? ( ($wallet_amount > 0)?$step:'' ) : ($status == 8) ? $step : 4 ;
                                    // $step = ($step == 5 && $wallet_amount > 0 ) ? $step : 6 ; 
                                ?>
                                <li class="{{ ( $step == 1 )? 'active' : 'disabled'}} step1">
                                    <a class="hidden-xs" href="#step1" data-toggle="tab" data-step="1">1. Notice Period</a>
                                    <a class="visible-xs" href="#step1" data-toggle="tab" data-step="1">1.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class=" {{ ( $step == 2 )? 'active' : 'disabled'}} step2">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step2" data-toggle="tab" data-step="2">2. Appointment</a>
                                    <a class="visible-xs" href="#step2" data-toggle="tab" data-step="2">2.</a>
                                    <div class="nav-arrow"></div>
                                </li>

                                <li class="{{ ( $step == 3 )? 'active' : 'disabled'}} step3">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step3" data-toggle="tab" data-step="3">3. Report Sign</a>
                                    <a class="visible-xs" href="#step3" data-toggle="tab" data-step="3">3.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="{{ ( $step == 4 )? 'active' : 'disabled'}} step4">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step4" data-toggle="tab" data-step="4">4. Clear Dues</a>
                                    <a class="visible-xs" href="#step4" data-toggle="tab" data-step="4">4.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="{{ ( $step == 5 )? 'active' : 'disabled'}} step5">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step5" data-toggle="tab" data-step="5">5. Claim Refund</a>
                                    <a class="visible-xs" href="#step5" data-toggle="tab" data-step="5">5.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="{{ ( $step == 6 )? 'active' : 'disabled'}} step6">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#step6" data-toggle="tab" data-step="6">6. Refund Status</a>
                                    <a class="visible-xs" href="#step6" data-toggle="tab" data-step="6">6.</a>
                                    <!-- <div class="nav-arrow"></div> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ ( $step == 1 )? 'in active' : ''}}" id="step1">
                            
                        </div>
                        <div class="tab-pane fade {{ ( $step == 2 )? 'in active' : ''}}" id="step2">
                            
                        </div>
                        <div class="tab-pane fade {{ ( $step == 3 )? 'in active' : ''}}" id="step3">
                            
                        </div>
                        <div class="tab-pane fade {{ ( $step == 4 )? 'in active' : ''}}" id="step4">
                            <form autocomplete="off" action="{{ url('terminate-contract/'.$id) }}" method="POST" enctype="multipart/form-data" id="terminate_form4">
                                @csrf
                                <h3>Amount Dues</h3>
                                <div class="well">
                                    <input type="hidden" name="terminate_id" id="c_terminate_id" value="@if(isset($terminate->id)){{$terminate->id}}@endif"> 
                                    <input type="hidden" name="dues_amount" id="dues_amount" value="{{  ($contract->unit->rent * 3) }}"> 
                                    <div class="form-group row">
                                        <label for="rent" class="col-md-3 col-form-label text-md-right">Pending Rent</label>
                                        <div class="col-md-9">
                                            {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ (isset($contract->unit->rent)) ? ($contract->unit->rent * 3) : '0'}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Utility Dues</label>
                                        <div class="col-md-9">
                                           {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ (isset($contract->dues)) ? $contract->dues : '0'}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Damage Cost</label>
                                        <div class="col-md-9">
                                           {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ (isset($contract->damage)) ? $contract->damage : '0'}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Total Amount Dues</label>
                                        <div class="col-md-9">
                                           {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ ($contract->unit->rent * 3) + $contract->damage + $contract->dues }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Total Deposit Amount</label>
                                        <div class="col-md-9">
                                           {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$wallet_amount }}
                                        </div>
                                    </div>
                                    @if($step == 4 && $status == 0)
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-3 col-form-label text-md-right">Pay Dues</label>
                                            <div class="col-md-9" id="pay_dues" style='display: flex;'>
                                                <?php $pay_dues = (isset($terminate->pay_dues)) ? $terminate->pay_dues: ''; ?>
                                                @if($wallet_amount  > $total_due_amount)
                                                    <input type="radio" id="pay_dues1" name="pay_dues" {{ ($pay_dues == 'adjust' || $pay_dues == '') ? 'checked' : '' }} value="adjust"> Adjust from Deposit
                                                    <input type="radio" id="pay_dues2" name="pay_dues" {{ ($pay_dues == 'payment') ? 'checked' : '' }}  value="payment"> Make Payment
                                                @else
                                                    <input type="radio" id="pay_dues2" name="pay_dues" checked=""  value="payment"> Make Payment
                                                @endif
                                            </div>
                                        </div>
                                        @if($wallet_amount  > $total_due_amount)
                                        <div class="row" id="make_payment" style="display: none">
                                        @else
                                            <div class="row" id="make_payment">
                                        @endif
                                            <label for="deposit" class="col-md-3 col-form-label text-md-right"></label>
                                            <div class="col-sm-9">
                                                <div class="make_payment">
                                                    <a class="btn btn-primary" href="{{url('pay-dues/'.$id)}}">Pay Now</a>
                                                </div> 
                                                <label id="pay_by-error" class="red" for="pay_by"></label>
                                                <div class="make_payment" style="display: none;">
                                                    <input style="display: none;" type="radio" id="pay_buy1" name="pay_by" value="paypal"> 
                                                    <input style="display: none;" type="radio" id="pay_buy2" name="pay_by" value="bank">
                                                    <button type="button" class="btn btn-primary">
                                                        Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $total_due_amount }} with <img src="http://122.160.138.253:8080/property/public/images/Paypal-button.png">
                                                    </button> or
                                                    <button type="button" name="bank" data-amount="{{ $total_due_amount }}" data-account="56769576567567" data-router="123456789" data-aba="ABA NO 454545" data-bank="Bank of America" data-unit="{{$contract->unit->unit_name}}" data-tenant="{{Auth::user()->name}}" class="btn btn-primary payment bank_details" value="bank">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $total_due_amount }} using <img src="{{ url('images/bank-transfer.png') }}">
                                                    </button> 
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($step == 4 && $status == 5)
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                               <p><strong>Note:</strong> Please upload receipt which you get from bank after payment.</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="pay_dues" id="pay_dues" value="payment">
                                            <label for="deposit" class="col-md-3 col-form-label text-md-right">Upload Bank Receipt</label>
                                            <div class="col-sm-9">
                                                <div class="make_payment">
                                                    <input type="file" id="receipt" name="receipt">
                                                </div> 
                                            </div>
                                        </div>
                                    @endif
                                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                                          <div class="btn-group btn-group-lg" role="group" aria-label="">
                                          </div>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-primary btn-lg btn-block next4" name="step" value="4" step="4">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade {{ ( $step == 5 )? 'in active' : ''}}" id="step5">
                            <form autocomplete="off" action="{{ url('terminate-contract/'.$id) }}" method="POST" enctype="multipart/form-data" id="terminate_form5">
                                @csrf
                                <h3>Claim Refund</h3>
                                <div class="well">
                                    <input type="hidden" name="terminate_id" id="r_terminate_id" value="@if(isset($terminate->id)){{$terminate->id}}@endif"> 
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Pending Deposit Amount</label>
                                        <div class="col-sm-9">
                                           <span id="pending_wallet_amount">{{$wallet_amount}}</span>
                                            <span class="r_errors" id="r_error_refund"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Choose Method for Refund</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="refund" id="refund">
                                                <option value="">Select Mode</option>
                                                <option value="paypal">Paypal</option>
                                                <!-- <option value="stripe">Stripe</option> -->
                                                <option value="bank">Bank Transfer</option>
                                            </select>
                                            <span class="r_errors" id="r_error_refund"></span>
                                        </div>
                                    </div>
                                    <div class="bank-body" id="bank_body" style="display: none;">
                                        <div class="form-group row">
                                            <label for="bank_name" class="col-md-3 col-form-label text-md-right">{{ __('Bank Name') }}</label>
                                            <div class="col-md-9">
                                                @if(isset($account_info->bank_name) )
                                                <input id="bank_name" type="text" class="form-control"  name="bank_name" value="{{ $account_info->bank_name }}" placeholder="Bank Name">
                                                @else
                                                <input id="bank_name" type="text" class="form-control"  name="bank_name" value="" placeholder="Bank Name">
                                                @endif
                                                <span class="r_errors" id="r_error_bank_name"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ada_number" class="col-md-3 col-form-label text-md-right">{{ __('ADA Number') }}</label>
                                            <div class="col-md-9">
                                                @if(isset($account_info->ada_number) )
                                                <input id="ada_number" type="text" class="form-control"  name="ada_number" value="{{ $account_info->ada_number }}" placeholder="ADA Number">
                                                @else
                                                <input id="ada_number" type="text" class="form-control"  name="ada_number" value="" placeholder="ADA Number">
                                                @endif
                                                <span class="r_errors" id="r_error_ada_number"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_number" class="col-md-3 col-form-label text-md-right">{{ __('Account Number') }}</label>
                                            <div class="col-md-9">
                                                @if(isset($account_info->account_number) )
                                                <input id="account_number" type="text" class="form-control"  name="account_number" value="{{ $account_info->account_number }}" placeholder="Account Number">
                                                @else
                                                <input id="account_number" type="text" class="form-control"  name="account_number" value="" placeholder="Account Number">
                                                @endif
                                                <span class="r_errors" id="r_error_account_number"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="routing_number" class="col-md-3 col-form-label text-md-right">{{ __('Routing Number') }}</label>
                                            <div class="col-md-9">
                                                @if(isset($account_info->routing_number) )
                                                <input id="routing_number" type="text" class="form-control"  name="routing_number" value="{{ $account_info->routing_number }}" placeholder="Routing Number">
                                                @else
                                                <input id="routing_number" type="text" class="form-control"  name="routing_number" value="" placeholder="Routing Number">
                                                @endif
                                                <span class="r_errors" id="r_error_routing_number"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paypal-body" id="paypal_body" style="display: none;">
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-3 col-form-label text-md-right">Paypal Email ID</label>
                                            <div class="col-sm-9">
                                                @if(isset($account_info->bank_name) )
                                                <input class="form-control" type="text" name="paypal_email" id="paypal_email" value="{{$account_info->paypal_email}}">
                                                @else
                                                <input class="form-control" type="text" name="paypal_email" id="paypal_email">
                                                @endif
                                                <span class="r_errors" id="r_error_paypal_email"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stripe-body" id="stripe_body" style="display: none;">
                                        <div class="form-group row">
                                            <label for="deposit" class="col-md-3 col-form-label text-md-right">Choose Method for Refund</label>
                                            <div class="col-sm-9">
                                                <select class="form-control " name="t_department" id="t_department">
                                                <option value="">Select Mode</option>
                                                <option value="pm">Paypal</option>
                                                <option value="pm">Bank Transfer</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-justified" role="group" 
                                        aria-label="">
                                          <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                                          </div>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                                            <button class="btn btn-primary btn-lg btn-block next5" name="step" value="5" step="5">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade {{ ( $step == 6 )? 'in active' : ''}}" id="step6">
                            <h3>Refund Status</h3>
                            <div class="well">
                                <div class="form-group row">
                                    <label for="deposit" class="col-md-3 col-form-label text-md-right">Refund Status</label>
                                    <div class="col-md-9" id="pay_dues" style='display: flex;'>
                                        <span>{{ (isset($terminate->refund_status)) ? ucfirst($terminate->refund_status) : 'Pending'}}</span>
                                    </div>
                                </div>
                                <div class="btn-group btn-group-justified" role="group" aria-label="">
                                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                                        <button class="btn btn-default back" type="button">Back</button>
                                    </div>
                                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                                        <!-- <button class="btn btn-success" id="submit" type="submit">Create Unit</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="bank_details" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Bank Details</h3>
            </div>
            <div class="modal-body termsToPrint">
                <table>
                    <tbody>
                        <tr>
                            <th colspan="2" id="unit"></th>
                            <!-- <th id="tenant"></th> -->
                        </tr>
                        <tr>
                            <td>Paid amount:</td>
                            <td><p id="amount"></p></td>
                        </tr>
                        <tr>
                            <td>Bank Name:</td>
                            <td><p id="bank"></p></td>
                        </tr>
                        <tr>
                            <td>ABA number:</td>
                            <td><p id="aba"></p></td>
                        </tr>
                        <tr>
                            <td>Account number:</td>
                            <td><p id="account"></p></td>
                        </tr><tr>
                            <td>Routing code:</td>
                            <td><p id="router"></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <!-- <button class="btn btn-info" onclick="window.print();">Print</button> -->
                        <button class="btn btn-info" id="printOut">Print</button>
                    </div>
                    <!-- <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-success" id="bank_payment_done">Book</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(function(){
            $('#printOut').click(function(e){
                e.preventDefault();
                var w = window.open();
                // var printOne = $('.contentToPrint').html();
                var printTwo = $('.termsToPrint').html();
                w.document.write('<html><head><title>Bank Details</title></head><body><h1>Bank Details</h1><hr />' + printTwo) + '</body></html>';
                w.window.print();
                w.document.close();
                return false;
            });
        });
    </script>
    <script type="text/javascript">
        var date = new Date();
        var end_date = new Date(' @if( isset($terminate->notice_period_date)) {{$terminate->notice_period_date}} @endif');
        var date_format = '{!! \Helper::DateTimeFormat() !!}';
        $('.form_datetime').datetimepicker({
            format: date_format,
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            startDate: date,
            endDate: end_date
        });

        $('.back').click(function(){
            var id = $(this).parents('.tab-pane').attr("id");
            if(id == 'step5') {     
                var total_due_amount = '{{ $total_due_amount }}';
                if(total_due_amount <= 0){
                    var prevId = $(this).parents('.tab-pane').prev().prev().attr("id");
                } 
                else {
                    var prevId = $(this).parents('.tab-pane').prev().attr("id");
                }
            }
            else if(id == 'step6') { 
                var wallet_amount = '{{ $wallet_amount }}';
                var total_due_amount = '{{ $total_due_amount }}';
                if(wallet_amount <= 0 && total_due_amount <= 0){
                    var prevId = $(this).parents('.tab-pane').prev().prev().prev().attr("id");
                } 
                else if(wallet_amount > 0 ){
                    var prevId = $(this).parents('.tab-pane').prev().attr("id");
                }
                else if(total_due_amount > 0 ){
                    var prevId = $(this).parents('.tab-pane').prev().prev().attr("id");
                } 
                else {
                    var prevId = $(this).parents('.tab-pane').prev().prev().attr("id");
                }
            }
            else{
                var prevId = $(this).parents('.tab-pane').prev().attr("id");
            }
            $('[href="#'+prevId+'"]').tab('show');
            return false;
        });
        var step = '{{$step}}';
        var percent = (parseInt(step) / 6) * 100;
        $('.progress-bar').css({width: percent + '%'});
        $('.progress-bar').text("Step " + step + " of 6");

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          //update progress
          var step = $(e.target).data('step');
          var percent = (parseInt(step) / 6) * 100;
          $('.progress-bar').css({width: percent + '%'});
          $('.progress-bar').text("Step " + step + " of 6");
          //e.relatedTarget // previous tab
        });
        $('.first').click(function(){
            $('#myWizard a:first').tab('show')
        });
        jQuery('#pay_dues input').click(function(){
            if($('#pay_dues2').is(':checked')) { 
                jQuery('#make_payment').show();
            } else {
                jQuery('#make_payment').hide();
            }
        });
        jQuery('#refund').change(function(){
            var val = jQuery(this).val();
            if(val == 'paypal') { 
                jQuery('#paypal_body').show();
                jQuery('#bank_body').hide();
                jQuery('#stripe_body').hide();
            }
            else if(val == 'stripe') { 
                jQuery('#stripe_body').show();
                jQuery('#paypal_body').hide();
                jQuery('#bank_body').hide();
            } else if(val == 'bank') {
                jQuery('#bank_body').show();
                jQuery('#stripe_body').hide();
                jQuery('#paypal_body').hide();
            }
        });
        jQuery('.bank_details').click(function(){
            var amount      = $(this).data('amount');
            var account     = $(this).data('account');
            var router      = $(this).data('router');
            var aba         = $(this).data('aba');
            var bank        = $(this).data('bank');
            var unit        = $(this).data('unit');
            var tenant        = $(this).data('tenant');
            $('#bank_details').modal('show');
            $("#bank_details #amount").text( amount );
            $("#bank_details #router").text( router );
            $("#bank_details #account").text( account );
            $("#bank_details #aba").text( aba );
            $("#bank_details #bank").text( bank );            
            $("#bank_details #unit").text( 'References: {'+unit+'}  {'+tenant+'}' );            
            // $("#bank_details #tenant").text( '{'+tenant+'}' );            
        });
        $(".next4").click(function(){
            var thisa = $(this);
            var total_due_amount = '{{ $total_due_amount }}';
            var wallet_amount = '{{ $wallet_amount }}';
            $('.errors').text('');
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0} kb');
            $("#terminate_form4").validate({
                errorClass:"red",
                validClass:"green",
                ignore: "",
                rules:{                  
                    pay_by: { 
                        required: '#pay_dues2[value="payment"]:checked'
                    },
                    receipt: {
                        required:true,
                    }
                },
                messages: {
                    pay_by: {
                      required: "Please do payment first to proceed further by clicking on Pay Now!",
                    },
                    receipt: {
                      required: "Please upload receipt!",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type:'POST',
                        url: '{{ url('TerminateBT-Contract/'.$id) }}',
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            console.log(response);
                            if(response.success == false)
                            {
                                var errors = response.errors;
                                $.each( errors, function( key, value ) {
                                    $('#f_error_'+key).show();
                                    $('#f_error_receipt').show();
                                    $('#f_error_'+key).css({'color': 'red','font-size': '13px','font-weight': '700'});
                                    $('#f_error_'+key).text(value);
                                });
                            }
                            else if(response.success == true)
                            {
                                jQuery('ul.nav.nav-pills.nav-wizard li.step4').removeClass('disabled');
                                if(response.wallet_amount > 0)
                                {
                                    var nextId = thisa.parents('.tab-pane').next().attr("id");
                                    $('#pending_wallet_amount').text(response.wallet_amount);
                                }
                                else
                                {
                                    var nextId = thisa.parents('.tab-pane').next().next().attr("id");
                                }
                                $('[href="#' + nextId + '"]').tab('show');
                                $('#r_terminate_id').val(response.terminate_id);
                            }
                        }
                    });
                    return false;
                }
            })
        });
        $(".next5").click(function(){
            var thisa = $(this);
            // jQuery('ul.nav.nav-pills.nav-wizard li.step1').removeClass('disabled');
            // var nextId = thisa.parents('.tab-pane').next().attr("id");
            // $('[href="#' + nextId + '"]').tab('show');

            // return false;
            $('.errors').text('');
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0} kb');
            $("#terminate_form5").validate({
                errorClass:"red",
                validClass:"green",
                ignore: "",
                rules:{   
                    refund: {
                        required:true,
                    },               
                    bank_name: { 
                        // required: '#refund[value="paypal"]:checked'
                        required: function (el) {
                            return $(el).closest('form').find('#refund').val() == 'bank';
                        }
                    },
                    ada_number: {
                        required: function (el) {
                            return $(el).closest('form').find('#refund').val() == 'bank';
                        }
                    },
                    account_number: {
                        required: function (el) {
                            return $(el).closest('form').find('#refund').val() == 'bank';
                        }
                    },
                    routing_number: {
                        required: function (el) {
                            return $(el).closest('form').find('#refund').val() == 'bank';
                        }
                    },
                    paypal_email: {
                        required: function (el) {
                            return $(el).closest('form').find('#refund').val() == 'paypal';
                        },
                        email:true
                    }
                },
                messages: {
                    refund: {
                      required: "Please select method to get refund",
                    },
                    bank_name: { 
                        required: 'Please enter bank name',
                    },
                    ada_number: {
                         required: 'Please enter ADA number'
                    },
                    account_number: {
                        required: 'Please enter account number'
                    },
                    routing_number: {
                        required: 'Please enter routing number'
                    },
                    paypal_email: {
                        required: 'Please enter paypal email',
                        email: 'Please enter a valid email'
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type:'POST',
                        url: '{{ url('TerminateBT-Contract/'.$id) }}',
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            console.log(response);
                            if(response.success == false)
                            {
                                var errors = response.errors;
                                $.each( errors, function( key, value ) {
                                    $('#r_error_'+key).show();
                                    $('#r_error_receipt').show();
                                    $('#r_error_'+key).css({'color': 'red','font-size': '13px','font-weight': '700'});
                                    $('#r_error_'+key).text(value);
                                });
                            }
                            else if(response.success == true)
                            {
                                jQuery('ul.nav.nav-pills.nav-wizard li.step1').removeClass('disabled');
                                var nextId = thisa.parents('.tab-pane').next().attr("id");
                                $('[href="#' + nextId + '"]').tab('show');
                                $('#r_terminate_id').val(response.terminate_id);
                            }
                        }
                    });
                    return false;
                }
            })
        });
    </script>
    <style type="text/css">
        div#add_vendors span ,div#add_vendors_data span,div#add_new_building span, div#add_new_meter span{border: 1px solid #ccc; padding: 5px; margin: 0 5px; }
        span.term_error_message {display: block; color: red; }
        li.disabled {pointer-events: none; } 
        .make_payment img {width: 100px; height: 35px; }
        .make_payment {padding: 20px 0; }
        .tenant_type_main input {width: 15px; display: inline-block; height: 14px; box-shadow: none; }
        span#send_otp, span#m_send_otp {background-color: #DDDDDD; padding: 8px 4px; font-size: 13px; border-radius: 3px; position: absolute; cursor: pointer; }
        span#m_phone_number_error {color: red; }
        .float-right { float: right; }
        input[type=radio] {  margin: 0px 0 0 20px;}
        .termsToPrint tr td, th {width: 20%;}
    </style>
@endsection