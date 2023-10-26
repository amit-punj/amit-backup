<div class="col-md-8 col-xs-12">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <th class="unit" colspan="2"><span>Unit Rent </span></th>
        </thead>
        <tbody>
            <tr>
                <td class="unit" ><span>Pay for : </span></td>
                <td>Unit Rent</td>
            </tr>
            <tr>
                <td class="unit" ><span>Unit : </span></td>
                <td>{{$rentDetail->unit['unit_name']}}</td>
            </tr>
            <tr>
                <td class="unit" ><span>Rent For : </span></td>
                <td>{{$rentDetail->date}}</td>
            </tr>
            <tr>
                <td class="unit" ><span>Amount : </span></td>
                <td> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4 col-xs-12">
    <form autocomplete="off" action="{{ url('/bank-payRent') }}" onsubmit="return confirm('Are you sure? You want to Pay Rent with paypal');" method="POST" enctype="multipart/form-data" id="create_propert_form5">
        @csrf
        <input type="hidden" name="amount" id="amount" value="{{ $amount }}">
        <input type="hidden" name="payment_method" id="payment_method" value="">
        <input type="hidden" name="rent_id" id="rent_id" value="{{ $rentDetail->id }}">
        <div class="well">
            <div class="row" id="make_payment">
                <div class="col-md-1"></div>
                <div class="col-sm-11">
                    <div class="make_payment">
                        <button style="margin: 5px;" value="paypal" name="paypal" class="btn btn-primary payment paypal_popup">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }} using <img src="{{ url('images/Paypal-button.png') }}">
                        </button>
                        <button style="margin: 5px;" type="button" name="bank" data-amount="534" data-account="56769576567567" data-router="123456789" data-aba="ABA NO 454545" data-bank="Bank of America" data-unit="fg" data-tenant="{{Auth::user()->name}}" class="btn btn-primary payment bank_details" value="bank">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }} using <img src="{{ url('images/bank-transfer.png') }}">
                        <button style="margin: 5px;" type="button" id="credit_card_custom" name="credit_card" class="btn btn-primary payment credit-card" value="bank">Pay  {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }} using <img src="{{ url('images/payment_cards.png') }}">
                        </button>
                    </div>
                </div>
                <div class="col-md-1"></div>    
            </div>
        </div>
    </form>
    <form action="{{ url('/stripe-payunitrent') }}" method="POST" id="stripe_form_custom">
        @csrf
        <input type="hidden" name="rent_id" id="rent_id" value="{{ $rentDetail->id }}">
        <input type="hidden" name="amount" id="unit_amount" value="{{ 100 * ($amount) }}">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="{{ 100 * ($amount) }}" 
            data-name="Reasy Payment"
            data-description="meter Bill"
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
