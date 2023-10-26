@section('title','Payments')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Payments'])
    <div class="container bootom-space">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                        {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
                @endif
                <?php
                    $time = strtotime(date('Y/m/d'));
                    $final = date("Y-m-d", strtotime("+1 month", $time));
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-hover table-striped table-bordered"> 
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Amount : </span></td>
                                    <td>{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{  $user->wallet_amount }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Upcoming payment due date : </span></td>
                                    <td><p>{!! \Helper::Date($final); !!}</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-exclamation-triangle fa-3x"></i>
                            <div class="info">
                                <h4>Due Amount</h4>
                                <p><b style="color:red">{{ App\Helpers\Helper::CURRENCYSYMBAL}} 5500</b></b></p>
                                <p>{!! \Helper::Date($final); !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="float-right">
                            <a class="btn btn-success" data-toggle="modal" data-target="#book_unit">Add Money</a>
                            <!-- <a class="btn btn-success" href="{{url('add-money') }}">Add Money</a> -->
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="Building-Units">Pending Payments</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if(count($pendingPayments) > 0 ) 
                    <div  class="user-info-table">
                        <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                            <thead>
                                <tr>
                                    <td >S.No</td>
                                    <td >Date</td>
                                    <td >Related to</td>
                                    <td >Status</td>
                                    <td >Amount</td>
                                    <td >Action</td>
                                </tr> 
                            </thead>   
                            <tbody >  
                            @foreach($pendingPayments as $key =>$pendingPayment)         
                                <tr>
                                    <td >{{ $loop->index + 1 }}</td>
                                    @if(isset($pendingPayment->date))
                                        <td >{!! \Helper::Date($pendingPayment->date); !!}</td>
                                    @elseif(isset($pendingPayment->reading_date))
                                        <td >{!! \Helper::Date($pendingPayment->reading_date); !!}</td>
                                    @else
                                        <td>--</td>
                                    @endif

                                    @if(isset($pendingPayment->rent_status))
                                        <td >Unit Rent</td>
                                    @elseif(isset($pendingPayment->status))
                                        <td >Meter Bill</td>
                                    @else
                                        <td>--</td>
                                    @endif

                                    @if(isset($pendingPayment->rent_status))
                                        <td >{{ $pendingPayment->rent_status }}</td>
                                    @elseif(isset($pendingPayment->status))
                                        <td >{{ $pendingPayment->status }}</td>
                                    @else
                                        <td>--</td>
                                    @endif

                                    @if(isset($pendingPayment->total_amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $pendingPayment->total_amount }}</td>
                                    @elseif(isset($pendingPayment->amount))
                                        <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $pendingPayment->amount }}</td>
                                    @else
                                        <td>--</td>
                                    @endif

                                    @if(isset($pendingPayment->rent_status))
                                        <td>
                                        @if($pendingPayment->total_amount != 0)
                                            <a class="btn btn-success" href="{{ url('/payunit-rent/'.$pendingPayment->id) }}">Pay</a>
                                        @else
                                            --
                                        @endif
                                        </td>
                                    @elseif(isset($pendingPayment->status))
                                        <td>
                                        @if($pendingPayment->amount != 0)
                                            <a class="btn btn-success" href="{{ url('/paymeter-bill/'.$pendingPayment->id) }}">Pay</a>
                                        @else
                                            --
                                        @endif
                                        </td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    
                                </tr>  
                            @endforeach               
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No Pending payments found!</p>
                @endif
            </div>
        </div>
         <div class="row">
            <div class="col-sm-6">
                <div class="Building-Units">Payment History</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if(count($transactions) > 0 ) 
                    <div  class="user-info-table">
                        <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                            <thead>
                                <tr>
                                    <td >S.No</td>
                                    <td >Date</td>
                                    <td >Related to</td>
                                    <td >Payment Method</td>
                                    <td >Amount</td>
                                    <!-- <td >Manually/Automatically</td> -->
                                    <!-- <td >Action</td> -->
                                </tr> 
                            </thead>   
                            <tbody >  
                            @foreach($transactions as $key =>$transaction)         
                                <tr>
                                    <td >{{ ++$key }}</td>
                                    <td >{!! \Helper::Date($transaction->created_at); !!}</td>
                                    <td >
                                        @if($transaction->related_to == 'AddMoney')
                                            @if($transaction->payment_by == 'Paypal')
                                                <span>Added to Wallet from Paypal</span>
                                            @else($transaction->payment_by == 'Stripe')
                                                <span>Added to Wallet from Stripe</span>
                                            @endif
                                        @elseif($transaction->related_to == 'PayDues')
                                            <span>Pay dues by {{$transaction->payment_by}}</span>
                                        @elseif($transaction->related_to == 'meter bill')
                                            <span>Meter Bill</span>
                                        @elseif($transaction->related_to == 'rent')
                                            <span>Unit Rent</span>
                                        @endif
                                    </td>
                                    <td >{{ $transaction->payment_by }}</td>
                                    <td >{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $transaction->amount }}</td>
                                    <!-- <td >Manually</td> -->
                                    <!-- <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td> -->
                                </tr>  
                                <!-- <tr>
                                    <td >2</td>
                                    <td > 07 September, 2019 - 10:35 am</td>
                                    <td >Paid for Water Bill <a href="{{ url('contract-details/2') }}">Contrat Classic</a></td>
                                    <td >Debit</td>
                                    <td >$1200</td>
                                </tr>  
                                <tr>
                                    <td >3</td>
                                    <td > 07 September, 2019 - 10:35 am</td>
                                    <td >Paid for Rent <a href="{{ url('contract-details/2') }}">Contrat Classic</a></td>
                                    <td >Debit</td>
                                    <td >$1200</td>
                                </tr>  
                                <tr>
                                    <td >4</td>
                                    <td > 07 September, 2019 - 10:35 am</td>
                                    <td >Added to Wallet from Paypal</td>
                                    <td >Credit</td>
                                    <td >$12000</td>
                                </tr> --> 
                            @endforeach               
                            </tbody>
                        </table>
                    </div>
                    {{$transactions->links()}}
                @else
                    <p>No payment transactions found!</p>
                @endif
            </div>
        </div>
    </div> 
    <div class="modal fade" id="book_unit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="{{ url('add-money') }}" method="POST"  id="add_money_form">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Add Money</h3>
                    </div>
                      <div class="modal-body">
                        <div class="row make_payment">
                            <label for="email_token" class="col-md-2 col-form-label text-md-right">{{ __('Amount') }}</label>
                            <div class="col-md-8">
                                <input id="amount" placeholder="Amount" type="number" class="form-control" min="1" name="amount" value="">
                            </div>
                            <div class="col-md-1">
                            </div>
                        </div>
                        <!-- <div class="row">
                          <div class="col-sm-12">
                            <div class="make_payment">
                              <button type="button" class="btn btn-primary">
                                        Pay $23000 with <img src="http://122.160.138.253:8080/property/public/images/Paypal-button.png">
                                    </button> or
                                    <button type="button" class="btn btn-primary">
                                        Pay $23000 using <img src="http://122.160.138.253:8080/property/public/images/bank-transfer.png">
                                    </button>
                            </div>
                          </div>
                        </div> -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="">Proceed to Add</button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
    <style type="text/css">
        .make_payment img {width: 100px; height: 35px; }
        .make_payment {margin: 0 auto; text-align: center; padding: 15px 0 30px; }
        .float-right { float: right; }
        .Building-Units {   font-size: 28px;margin-top: 20px;}
        .unit-body {border: 2px solid #f28401; padding: 15px; border-radius: 5px; height: 80px; }
        .widget-small {display: -webkit-box; display: -ms-flexbox; display: flex; border-radius: 4px; color: #FFF; margin-bottom: 30px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); }
        .widget-small .icon {display: -webkit-box; display: -ms-flexbox; display: flex; min-width: 50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; padding: 20px; background-color: rgba(0, 0, 0, 0.2); border-radius: 4px 0 0 4px; font-size: 2.5rem; }
        .widget-small.danger {background-color: #dc3545; }
      .widget-small.danger.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
      .widget-small.danger.coloured-icon .icon {background-color: #dc3545; color: #fff; }
      .widget-small .info h4 {text-transform: uppercase; margin: 0; margin-bottom: 5px; font-weight: 400; font-size: 1.1rem; }
      .widget-small .info p {margin: 0; font-size: 16px; }
      .widget-small .info {    padding: 7px 10px; }
    </style>
    <script type="text/javascript">
        jQuery('#add_money_form').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                amount:{
                    required:true,
                    number:true
                }
            }      
        });
    </script>
@endsection