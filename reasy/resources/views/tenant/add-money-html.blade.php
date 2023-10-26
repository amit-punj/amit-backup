<div class="col-md-8 col-xs-12">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <th class="unit" colspan="2"><span>Add money </span></th>
        </thead>
        <tbody>
            <tr>
                <td class="unit" ><span>Pay for : </span></td>
                <td>Add money to wallet</td>
            </tr>
            <tr>
                <td class="unit" ><span>Amount : </span></td>
                <td> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4 col-xs-12">
    <form autocomplete="off" action="{{ url('paypal-add-money') }}" onsubmit="return confirm('Are you sure? You want to add money with paypal');" method="POST" enctype="multipart/form-data" id="create_propert_form5">
        @csrf
        <input type="hidden" name="amount" id="amount" value="{{ $amount }}">
        <div class="well">
            <div class="row" id="make_payment">
                <div class="col-md-1"></div>
                <div class="col-sm-11">
                    <div class="make_payment">
                        <button style="margin: 5px;" value="paypal" name="paypal" class="btn btn-primary payment paypal_popup">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }} using <img src="http://122.160.138.253:8080/property/public/images/Paypal-button.png">
                        </button>
                        <div style="text-align: center;">OR</div>
                        <button style="margin: 5px;" type="button" id="credit_card_custom" name="credit_card" class="btn btn-primary payment credit-card" value="bank">Pay  {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $amount }} using <img src="{{ url('images/payment_cards.png') }}">
                        </button>
                    </div>
                </div>
                <div class="col-md-1"></div>    
            </div>
        </div>
    </form>
    <form action="{{ route('stripe.AddMoney') }}" method="POST" id="stripe_form_custom">
        @csrf
        <input type="hidden" name="tenant_id" id="f_tenant_id_stripe" value="{{(isset($user) && !empty($user)) ? $user->id : ''}}">
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
