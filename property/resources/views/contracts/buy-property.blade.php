<div class="col-md-8 col-xs-12">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <th class="unit"><span>Unit Name :</span></th>
            <th>{{$contract->unit->unit_name}}</th>
        </thead>
        <tbody>
            <tr>
                <td class="unit" ><span>Pay for : </span></td>
                <td>Rent Property</td>
            </tr>
            <tr>
                <td class="unit" ><span>Amount : </span></td>
                <td> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $contract->total_amount }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4 col-xs-12">
    <form autocomplete="off" action="{{ url('property-payment') }}" onsubmit="return confirm('Please have an assurance from Property manager to Accept the Booking, if he rejected we will deduct PayPal refund fees');" method="POST" enctype="multipart/form-data" id="create_propert_form5">
        @csrf
        <input type="hidden" name="tenant_id" id="f_tenant_id" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
        <input type="hidden" name="unit_id" id="unit_id" value="{{ $contract->unit_id }}">


        <input type="hidden" name="pay_dues" id="pay_dues" value="payment">
        <input type="hidden" name="payment_method" id="payment_method" value="bank">
        <input type="hidden" name="due_amount" id="due_amount" value="{{ $contract->total_amount }}">
        <div class="well">
            <div class="row" id="make_payment">
                <div class="col-md-1"></div>
                <div class="col-sm-11">
                    <?php
                        $total_amount = (isset($contract->total_amount)) ? $contract->total_amount : '0' ;
                        $bank_name = (isset($contract->PO_account['bank_name']) ) ? $contract->PO_account['bank_name'] : '' ;
                        $ada_number = (isset($contract->PO_account['ada_number']) ) ? $contract->PO_account['ada_number'] : '' ;
                        $account_number = (isset($contract->PO_account['account_number']) ) ? $contract->PO_account['account_number'] : ''  ;
                        $routing_number = (isset($contract->PO_account['routing_number']) ) ? $contract->PO_account['routing_number'] : '' ;
                        $paypal_email = (isset($contract->PO_account['paypal_email']) ) ? $contract->PO_account['paypal_email'] : '' ;
                        $unit_name = (isset($contract->unit['unit_name']) ) ? substr($contract->unit['unit_name'],0,20) : '' ;
                    ?>
                    <div class="make_payment">
                        <button style="margin: 5px;" name="paypal" class="btn btn-primary payment paypal_popup" value="paypal">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $contract->total_amount }} using <img src="{{ url('/images/Paypal-button.png') }}"></button>
                        <div style="text-align: center;">OR</div> 
                        @if(!empty($bank_name) && !empty($account_number) && !empty($routing_number) && !empty($ada_number) )
                        @if(Auth::user() && Auth::user()->receipt_failed_count < 2)
                        <button style="margin: 5px;" type="button" name="bank" data-amount="{{$total_amount}}" data-account="{{$account_number}}" data-router="{{$routing_number}}" data-aba="{{$ada_number}}" data-bank="{{$bank_name}}" data-unit="{{$unit->unit_name}}" data-tenant="{{(isset($user) && !empty($user)) ? $user->name : ''}}" class="btn btn-primary payment bank_details" value="bank">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $contract->total_amount }} using <img src="{{ url('images/bank-transfer.png') }}"></button> 
                        <div style="text-align: center;">OR</div>
                        @endif
                        @endif
                        @if($contract->total_amount < 999999.99)
                            <button style="margin: 5px;" type="button" id="credit_card_custom" name="credit_card" class="btn btn-primary payment credit-card" value="bank">Pay  {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $contract->total_amount }} using <img src="{{ url('images/payment_cards.png') }}"></button>
                        @endif
                    </div>
                </div>
                <div class="col-md-1"></div>    
            </div>
        </div>
    </form>
    <form action="{{ route('stripe.post') }}" method="POST" id="stripe_form_custom">
        @csrf
        <input type="hidden" name="tenant_id" id="f_tenant_id_stripe" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
        <input type="hidden" name="unit_id" id="unit_id" value="{{ $contract->unit_id }}">
        <input type="hidden" name="amount" id="unit_amount" value="{{ 100 * $contract->total_amount }}">
      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="{{ 100 * $contract->total_amount }}" 
        data-name="Reasy Payment"
        data-description="Widget"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="{{App\Helpers\Helper::currencyType()}}">
      </script>
    </form>
</div>
<script type="text/javascript">
    // $(".paypal_popup").click(function() {
    //     $(this).closest("form").attr("action", "{{url('property-pay-dues/'.$id)}}");       
    // });
    
</script>