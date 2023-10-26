<div class="col-md-8 col-xs-12">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <th class="unit"><span>Plan :</span></th>
            <th>{{$planDetail->title}}</th>
        </thead>
        <tbody>
            <tr>
                <td class="unit" ><span>Pay for : </span></td>
                <td>Upgrade Membership</td>
            </tr>
            <tr>
                <td class="unit" ><span>Amount : </span></td>
                <td> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $amount }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4 col-xs-12">
    <form method="post" action="{{ url('/upgrade-membership') }}">
        @csrf
        <input name="plan_id" id="plan_id" class="" value="{{ $planDetail->id }}"  type="hidden">
       <div class="well">
            <div class="row" id="make_payment">
                <div class="col-md-1"></div>
                <div class="col-sm-11">
                    <div class="make_payment">
                        <button style="margin: 5px;" type="submit" value="paypal" name="paypal" class="btn btn-primary payment paypal_popup">Pay {{ App\Helpers\Helper::CURRENCYSYMBAL}}{{ $amount }} using <img src="{{ url('/images/Paypal-button.png')}}">
                        </button>
                        <button style="margin: 5px;" type="button" id="credit_card_custom" name="credit_card" class="btn btn-primary payment credit-card" value="bank">Pay  {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $amount }} using <img src="{{ url('images/payment_cards.png') }}">
                        </button>
                    </div>
                </div>
                <div class="col-md-1"></div>    
            </div>
        </div>
    </form>
    <form action="{{ url('/upgrade-membership-stripe') }}" method="POST" id="stripe_form_custom">
        @csrf
       <input type="hidden" name="amount" id="unit_amount" value="{{ 100 * $amount }}">
       <input type="hidden" name="plan_id" id="plan_id" value="{{ $planDetail->id }}">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="{{ 100 * $amount }}" 
            data-name="Reasy Payment"
            data-description="Widget"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="EUR">
        </script>
    </form>
</div>
<script type="text/javascript">
    // $(".paypal_popup").click(function() {
    //     $(this).closest("form").attr("action", "{{ url('paypal') }}");       
    // });
</script>