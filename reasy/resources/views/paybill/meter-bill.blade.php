<div class="col-md-8 col-xs-12">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <th class="unit" colspan="2"><span>Meter Bill </span></th>
        </thead>
        <tbody>
            <tr>
                <td class="unit" ><span>Pay for : </span></td>
                <td>Meter Bill</td>
            </tr>
            <tr>
                <td class="unit" ><span>Unit : </span></td>
                <td>{{$readingDetail->unit['unit_name']}}</td>
            </tr>
            <tr>
                <td class="unit" ><span>Meter Type : </span></td>
                <td>{{ ucfirst(str_replace('_', ' ', $readingDetail->meter['meter_type'])) }}</td>
            </tr>
            <tr>
                <td class="unit" ><span>Ean Number : </span></td>
                <td>{{$readingDetail->meter['ean_number']}}</td>
            </tr>
            <tr>
                <td class="unit" ><span>Amount : </span></td>
                <td> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4 col-xs-12">
    <form autocomplete="off" action="{{ url('/bank-paybill') }}" onsubmit="return confirm('Are you sure? You want to Pay bill with paypal');" method="POST" enctype="multipart/form-data" id="create_propert_form5">
        @csrf
        <input type="hidden" name="amount" id="amount" value="{{ $amount }}">
        <input type="hidden" name="payment_method" id="payment_method" value="">
        <input type="hidden" name="reading_id" id="reading_id1" value="{{ $readingDetail->id }}">
        <div class="well">
            <div class="row" id="make_payment">
                <div class="col-md-1"></div>
                <div class="col-sm-11">
                    <div class="make_payment">
                        <?php
                            $bank_name = (isset($contract->PO_account['bank_name']) ) ? $contract->PO_account['bank_name'] : '' ;
                            $ada_number = (isset($contract->PO_account['ada_number']) ) ? $contract->PO_account['ada_number'] : '' ;
                            $account_number = (isset($contract->PO_account['account_number']) ) ? $contract->PO_account['account_number'] : ''  ;
                            $routing_number = (isset($contract->PO_account['routing_number']) ) ? $contract->PO_account['routing_number'] : '' ;
                            $paypal_email = (isset($contract->PO_account['paypal_email']) ) ? $contract->PO_account['paypal_email'] : '' ;
                            $unit_name = (isset($contract->unit['unit_name']) ) ? substr($contract->unit['unit_name'],0,20) : '' ;
                        ?>

                        <button style="margin: 5px;" value="paypal" name="paypal" class="btn btn-primary payment paypal_popup">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }} using <img src="{{ url('images/Paypal-button.png') }}">
                        </button>
                        <div style="text-align: center;">OR</div>
                        @if($rentalDateDayDiff <= '5')
                            @if(!empty($bank_name) && !empty($account_number) && !empty($routing_number) && !empty($ada_number) )
                            @if(Auth::user() && Auth::user()->receipt_failed_count < 2)
                            <button style="margin: 5px;" type="button" name="bank" data-amount="{{$amount}}" data-account="{{$account_number}}" data-router="{{$routing_number}}" data-aba="{{$ada_number}}" data-bank="{{$bank_name}}" data-unit="{{$unit_name}}" data-tenant="{{(isset($user) && !empty($user)) ? $user->name : ''}}" class="btn btn-primary payment bank_details" value="bank">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $amount }} using <img src="{{ url('images/bank-transfer.png') }}"></button> 
                            <div style="text-align: center;">OR</div>
                            @endif
                            @endif
                        @endif
                        @if($amount < 999999.99)
                            <button style="margin: 5px;" type="button" id="credit_card_custom" name="credit_card" class="btn btn-primary payment credit-card" value="bank">Pay  {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $amount }} using <img src="{{ url('images/payment_cards.png') }}"></button>
                        @endif
                    </div>
                </div>
                <div class="col-md-1"></div>    
            </div>
        </div>
    </form>
    <form action="{{ url('/stripe-paymeterbill') }}" method="POST" id="stripe_form_custom">
        @csrf
        <input type="hidden" name="reading_id" id="reading_id" value="{{ $readingDetail->id }}">
        <input type="hidden" name="amount" id="unit_amount" value="{{ 100 * ($amount) }}">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="{{ 100 * ($amount) }}" 
            data-name="Reasy Payment"
            data-description="Add Money"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="{{ App\Helpers\Helper::currencyType() }}">
        </script>
    </form>
</div>
<script type="text/javascript">
    jQuery('.paypal_popup').click(function(){
        jQuery('#payment_method').val('paypal');
    });
    jQuery('.bank_details').click(function(){
        jQuery('#payment_method').val('bank');
    });
</script>
