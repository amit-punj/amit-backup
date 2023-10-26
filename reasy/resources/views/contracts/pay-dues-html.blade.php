<div class="col-md-8 col-xs-12">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <th class="unit"><span>Unit Name :</span></th>
            <th>{{$contract->unit->unit_name}}</th>
        </thead>
        <tbody>
            <tr>
                <td class="unit" ><span>Pay for : </span></td>
                <td>Amount Dues</td>
            </tr>
            <tr>
                <td class="unit" ><span>Amount : </span></td>
                <td> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{($contract->unit->rent * 3) + $contract->damage + $contract->dues }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4 col-xs-12">
    <form autocomplete="off" action="{{ url('bank-payment/'.$id) }}" onsubmit="return confirm('Are you sure? You want to make payment with paypal');" method="POST" enctype="multipart/form-data" id="create_propert_form5">
        @csrf
        <input type="hidden" name="pay_dues" id="pay_dues" value="payment">
        <input type="hidden" name="payment_method" id="payment_method" value="bank">
        <input type="hidden" name="due_amount" id="due_amount" value="{{ ($contract->unit->rent * 3) + $contract->damage + $contract->dues }}">
        <div class="well">
            <div class="row" id="make_payment">
                <div class="col-md-1"></div>
                <div class="col-sm-11">
                    <div class="make_payment">
                        <button style="margin: 5px;" value="paypal" name="paypal" class="btn btn-primary payment paypal_popup">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  ($contract->unit->rent * 3) + $contract->damage + $contract->dues }} using <img src="http://122.160.138.253:8080/property/public/images/Paypal-button.png"></button>
                        <div style="text-align: center;">OR</div>
                        <button style="margin: 5px;" type="button" name="bank" data-amount="534" data-account="56769576567567" data-router="123456789" data-aba="ABA NO 454545" data-bank="Bank of America" data-unit="fg" data-tenant="{{Auth::user()->name}}" class="btn btn-primary payment bank_details" value="bank">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ ($contract->unit->rent * 3) + $contract->damage + $contract->dues }} using <img src="{{ url('images/bank-transfer.png') }}"></button>
                        <div style="text-align: center;">OR</div> 
                        <button style="margin: 5px;" type="button" id="credit_card_custom" name="credit_card" class="btn btn-primary payment credit-card" value="bank">Pay  {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  ($contract->unit->rent * 3) + $contract->damage + $contract->dues }} using <img src="{{ url('images/payment_cards.png') }}">
                        </button>
                    </div>
                </div>
                <div class="col-md-1"></div>    
            </div>
        </div>
    </form>
    <form action="{{ route('stripe.PayDues', [$id]) }}" method="POST" id="stripe_form_custom">
        @csrf
        <input type="hidden" name="tenant_id" id="f_tenant_id_stripe" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
        <input type="hidden" name="unit_id" id="unit_id" value="{{  $contract->unit_id }}">
        <input type="hidden" name="amount" id="unit_amount" value="{{ 100 * (($contract->unit->rent * 3) + $contract->damage + $contract->dues) }}">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="{{ 100 * (($contract->unit->rent * 3) + $contract->damage + $contract->dues) }}" 
            data-name="Reasy Payment"
            data-description="Widget"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="EUR">
        </script>
    </form>
</div>
<script type="text/javascript">
    $(".paypal_popup").click(function() {
        $(this).closest("form").attr("action", "{{url('property-pay-dues/'.$id)}}");       
    });
</script>