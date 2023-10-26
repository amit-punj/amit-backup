@section('title','Check Out') 
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Check Out'])
    <div class="container main">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        <div class="row">
            <div class="row">
                @if($payment_for == 'pay_dues')
                    @include('contracts.pay-dues-html')
                @elseif($payment_for == 'add_money')
                    @include('tenant.add-money-html')
                @elseif($payment_for == 'payMeterBill')
                    @include('paybill.meter-bill')
                @elseif($payment_for == 'payUnitRent')
                    @include('paybill.unit-rent')
                @elseif($payment_for == 'buy_property')
                    @include('contracts.buy-property')
                @elseif($payment_for == 'membershipPlan')
                    @include('membership.membership-checkout')
                @elseif($payment_for == 'upgrade_membership')
                    @include('membership.upgrade_membership-checkout')
                @endif
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
                            <th id="unit"></th>
                            <th id="tenant"></th>
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
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-success" id="bank_payment_done">Pay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(".paypal_popup").click(function() {
            jQuery(".loader_div").show();     
        });
        $("#credit_card_custom").click(function() {
            jQuery(".loader_div").show();     
        }); 
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
        jQuery('.bank_details').click(function(){
            var amount      = $(this).data('amount');
            var account     = $(this).data('account');
            var router      = $(this).data('router');
            var aba         = $(this).data('aba');
            var bank        = $(this).data('bank');
            var unit        = $(this).data('unit');
            var tenant      = $(this).data('tenant');
            $('#bank_details').modal('show');
            $("#bank_details #amount").text( '{{ App\Helpers\Helper::CURRENCYSYMBAL}}'+amount );
            $("#bank_details #router").text( router );
            $("#bank_details #account").text( account );
            $("#bank_details #aba").text( aba );
            $("#bank_details #bank").text( bank );            
            $("#bank_details #unit").text( 'References: '+unit  );            
            $("#bank_details #tenant").text( tenant );            
        });
        jQuery('#bank_payment_done').click(function() {
            jQuery(".loader_div").show();
            document.getElementById("create_propert_form5").submit();
        });

        $(document).ready(function(){

            $('#credit_card_custom').click(function(){
                $('#stripe_form_custom button').trigger('click');
            });
            // Initiate validation on input fields
            $('#paymentForm input[type=text]').on('keyup',function(){
                cardFormValidate();
            });
            
            // Submit card form
            $("#cardSubmitBtn").on('click',function(){
                $('.status-msg').remove();
                if(cardFormValidate()){
                    var formData = $('#paymentForm').serialize();
                    $.ajax({
                        type:'POST',
                        url:"{{ url('property-payment') }}",
                        dataType: "json",
                        data:formData,
                        beforeSend: function(){
                            $("#cardSubmitBtn").prop('disabled', true);
                            $("#cardSubmitBtn").val('Processing....');
                        },
                        success:function(data){
                            if(data.status == 1){
                                $('#paymentSection').html('<p class="status-msg success">The transaction was successful. Order ID: <span>'+data.orderID+'</span></p>');
                            }else{
                                $("#cardSubmitBtn").prop('disabled', false);
                                $("#cardSubmitBtn").val('Proceed');
                                $('#paymentSection').prepend('<p class="status-msg error">Transaction has been failed, please try again.</p>');
                            }
                        }
                    });
                }
            });
        });
       
    </script>
    <style type="text/css">
        div#add_vendors span ,div#add_vendors_data span,div#add_new_building span, div#add_new_meter span{border: 1px solid #ccc; padding: 5px; margin: 0 5px; }
        span.term_error_message {display: block; color: red; }
        li.disabled {pointer-events: none; } 
        .make_payment img {width: 100px; height: 35px; }
        .make_payment {padding: 10px 25px; }
        .tenant_type_main input {width: 15px; display: inline-block; height: 14px; box-shadow: none; }
        span#send_otp, span#m_send_otp {background-color: #DDDDDD; padding: 8px 4px; font-size: 13px; border-radius: 3px; position: absolute; cursor: pointer; }
        span#m_phone_number_error {color: red; }
        .float-right { float: right; }
        input[type=radio] {  margin: 0px 0 0 20px;}
        .termsToPrint tr td, th {width: 20%;}
        #stripe_form_custom {   display: none;}
    </style>
@endsection