@section('title','Membership Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Membership Details'])
    <div class="container profile-page">
        <div class="row">
            <div class="col-sm-6">
                <div class="tenent-title">List All Membership</div>
            </div>
            @if($diffInDays < 0)
                <div class="col-sm-3">
                    <div class="widget-small danger coloured-icon"><i class="icon fa fa-building fa-3x"></i>
                        <div class="info">
                            <h4>Membership End At</h4>
                            <p><b>{{ date(\Helper::DateFormat(), strtotime($membershipEndDate)) }}</b></p>
                            <p style="color: red;font-size: 12px;"><b>All Properties are disabled</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="add-unit-main">
                        <button type="button" data="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Renew Membership</button>
                    </div>
                </div>
            @elseif($diffInDays < 30)
                <div class="col-sm-3">
                    <div class="widget-small danger coloured-icon"><i class="icon fa fa-building fa-3x"></i>
                        <div class="info">
                            <h4>Membership End At</h4>
                            <p><b>{{ Carbon\Carbon::parse($membershipEndDate)->format('Y/m/d') }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="add-unit-main">
                        <button type="button" data="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Renew Membership</button>
                    </div>
                </div>
            @else
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-building fa-3x"></i>
                        <div class="info">
                            <h4>Membership End At</h4>
                            <p><b>{{ Carbon\Carbon::parse($membershipEndDate)->format('Y/m/d') }}</b></p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="profile-page-title">My Membership Details</div> -->                 
                <div  class="table-responsive">
                    <table  class="table table-hover table-striped table-bordered">
                        <thead >
                            <th >SN</th>
                            <th  class="text-left">Plan Title</th>
                            <th  class="text-left">Payment Status</th>
                            <th  class="text-left">Paid Amount</th>
                            <th  class="text-left">Payer Email</th>
                            <th  class="text-left">Time Duration</th>
                           <!--  <th  class="text-left">Renew Membership</th> -->                                
                        </thead>
                        <tbody >
                            @php
                                $count = 0
                            @endphp
                            @foreach($membership_data as $data)
                                <tr>
                                    @php
                                        $count = $count + 1;
                                    @endphp
                                    <td class="text-left">{{ $count }}</td>
                                    <td class="text-left">{{ $data->title }}</td>
                                    <td class="text-left">{{ $data->status }}</td>
                                    <td class="text-left">{{ App\Helpers\Helper::CURRENCYSYMBAL.$data->total_amount }}</td>
                                     <td class="text-left">{{ $data->payment_email }}</td>
                                    <!-- <td class="text-left">{{ date(\Helper::DateFormat(), strtotime($data->payment_time)).' To '.date(\Helper::DateFormat(), strtotime($data->membership_end_at)) }} </td> -->
                                    <td class="text-left">
                                        {{ 
                                            Carbon\Carbon::parse($data->payment_time)->format('Y/m/d').' To '.Carbon\Carbon::parse($data->membership_end_at)->format('Y/m/d')
                                        }} 
                                    </td>
                                    <!-- <td class="text-left"><button type="button" data="{{$data->plan_id}}" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Renew Membership</button></td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 


    <!--------  Pop Up Html  ------>
    <div class="container">
         <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Renew Membership</h4>
                    </div>
                    <div class="modal-body">
                        <div class="model-step-first">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus animi atque sapiente dolores optio nihil quod, nulla hic, alias assumenda delectus facilis, rem ut velit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam obcaecati hic eveniet itaque, explicabo at iste dolor quod nulla aliquam? Debitis aliquam quas suscipit vel explicabo voluptatibus repellat ipsa recusandae. Corrupti eaque, ab voluptates ipsam iusto, et reprehenderit odit ipsa, doloremque provident aliquam blanditiis. Provident voluptate libero omnis sed mollitia!</p>
                        </div>
                        <div class="model-step-second">
                            <h2>Select Plans</h2>
                            <div class="row">
                            @foreach($plans as $plan)
                                <div class="col-md-4">
                                    <div class="plan-body">
                                        <div class="plans-title">{{ $plan->title }}</div>
                                        <div class="plans-price">USD<span>{{ $plan->price }}</span></div>
                                        <button data="{{ $plan->id }}">Select</button>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="model-step-three">
                            <a class="btn btn-primary" id="plan_id" href="{{ url('/upgrade-membership-checkout') }}">Proceed To checkout</a>
                            <!-- <form method="post" action="{{ url('/upgrade-membership') }}">
                                @csrf
                                <input name="plan_id" id="plan_id" class="" value="{{ old('plan_id') }}"  type="hidden">
                                <button type="submit" class="btn btn-primary">
                                    Pay with <img src="{{url('images/Paypal-button.png')}}">
                                </button>
                            </form> -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="proceed_to_back_step1">Back</button>
                        <button type="button" class="btn btn-success" id="proceed_to_back_step2">Back</button>
                        <button type="button" class="btn btn-success" id="proceed_to_pay">Proceed to pay</button>
                    </div>
                </div>
            </div>
         </div>
    </div>
    <style type="text/css">
        .renew-membership {text-align: right; }
        .model-step-second, .model-step-three,#proceed_to_back_step1, #proceed_to_back_step2{display: none; }
        div#myModal img {width: 100px; margin: 0 auto; }
        .model-step-second {text-align: center; padding: 20px 0; }
        .add-unit-main, .tenent-title { padding: 15px 0; }
        .add-unit-main {text-align: right; }
        .tenent-title {font-size: 24px; }
        #proceed_to_back{ display: none; }
        .plans-title {padding: 5px; }
        .plan-body button {text-decoration: none; padding: 6px 26px; width: auto; font-size: 16px; background-color: #3AB02B; color: #fff; border-radius: 5px; border: 0; margin: 15px 0; }
        .plan-body {border: 1px solid #ff8500; border-radius: 5px;padding: 20px 0; }
        .model-step-three {  text-align: center;  }
        .widget-small.primary.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a;display: flex;
            border-radius: 4px; }
        .widget-small.primary.coloured-icon .icon {background-color: #009688; color: #fff; }
        .widget-small.danger.coloured-icon .icon {background-color: #dc3545; color: #fff; }
        .widget-small.danger.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
        .widget-small .icon {display: -webkit-box; display: -ms-flexbox; display: flex; min-width: 50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; padding: 20px; background-color: rgba(0, 0, 0, 0.2); border-radius: 4px 0 0 4px; font-size: 2.5rem; }
        .widget-small .info {-webkit-box-flex: 1; -ms-flex: 1; flex: 1; padding: 0 20px; -ms-flex-item-align: center; align-self: center; }
        .widget-small.danger.coloured-icon .icon {background-color: #dc3545; color: #fff; }
        .widget-small .info h4 {text-transform: uppercase; margin: 0; margin-bottom: 5px; font-weight: 400; font-size: 1.1rem; }
        .widget-small .info p {margin: 0; font-size: 16px; }
        .widget-small {display: -webkit-box; display: -ms-flexbox; display: flex; border-radius: 4px; color: #FFF; margin-bottom: 30px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            // $('td.text-left button').click(function(){
            //     $('#plan_id').val($(this).attr('data'));
            // });
            $('#proceed_to_pay').click(function(){
                $('.model-step-second,#proceed_to_back_step1').show();
                $('.model-step-first, #proceed_to_pay').hide();
            });
            $('#proceed_to_back_step1').click(function(){
                $('.model-step-second,#proceed_to_back_step1').hide();
                $('.model-step-first, #proceed_to_pay').show();
            });
            $('.plan-body button').click(function(){
                $('#plan_id').attr('href',"{{ url('/upgrade-membership-checkout').'/' }}"+$(this).attr('data'));
                $('.model-step-second,#proceed_to_back_step1').hide();
                $('.model-step-three, #proceed_to_back_step2').show();
            });
            $('#proceed_to_back_step2').click(function(){
                $('.model-step-second,#proceed_to_back_step1').show();
                $('.model-step-three, #proceed_to_back_step2').hide();
            });
        });
    </script>
@endsection