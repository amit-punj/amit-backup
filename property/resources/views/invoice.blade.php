<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
  #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #ff8500
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #ff8500
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #ff8500
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #ff8500;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

/*.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #ff8500
}*/

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #ff8500;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #ff8500;
    font-size: 1.4em;
    border-top: 1px solid #ff8500
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print">
        <!-- <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr> -->
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <!-- <a target="_blank" href="https://lobianijs.com">
                            <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                            </a> -->
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            {{$data['lessor_name']}}
                        </h2>
                        <div>{{$data['lessor_phone']}}</div>
                        <div>{{$data['lessor_email']}}</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{$data['lessee_name']}}</h2>
                        <div class="address">{{$data['lessee_phone']}}</div>
                        <div class="email">{{$data['lessee_email']}}</div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">{{$data['invoice_no']}}</h1>
                        <div class="date">Date of Invoice: {{$data['invoice_date']}}</div>
                        <div class="date">Payment Method: {{$data['payment_method']}}</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">RENT</th>
                            <th class="text-right">MONTHLY FEE</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="no">01</td>
                            <td class="text-left">
                                <h3>
                                    <a target="_blank" href="{{url('propertydetails/'.$data['unit_id'])}}">
                                        {{$data['unit_name']}}
                                    </a>
                                </h3>
                               {{$data['unit_address']}}
                               <br>
                               Duration: {{$data['start_date']}} to {{$data['end_date']}}
                            </td>
                            <td class="unit">{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['rent']}} </td>
                            <td class="qty">{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['monthly_fee']}}</td>
                            <td class="total">{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['monthly_fee'] + $data['rent']}} </td>
                        </tr>
                        <tr>
                            <td class="no"></td>
                            <td class="text-left">
                                Cost Provision
                            </td>
                            <td class="unit"> </td>
                            <td class="qty"></td>
                            <td class="total">{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['cost_provision']}} </td>
                        </tr>
                        <tr>
                            <td class="no"></td>
                            <td class="text-left">
                                Deposit
                            </td>
                            <td class="unit"></td>
                            <td class="qty"></td>
                            <td class="total">{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['deposit']}} </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['monthly_fee'] + $data['rent'] + $data['cost_provision'] + $data['deposit'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX</td>
                            <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['deposit']}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>{{ App\Helpers\Helper::CURRENCYSYMBAL }} {{$data['total_amount']}}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <!-- <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div> -->
            </main>
            <footer>
                Invoice was created by <a href="{{url('/')}}"><strong>Reasy Property</strong></a> and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
