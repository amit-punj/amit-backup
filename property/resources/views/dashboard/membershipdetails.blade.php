@section('title','Membership Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Membership Details'])
    <div class="container profile-page">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="profile-page-title">My Membership Details</div> -->                 
                <div  class="table-responsive">
                    <table  class="table table-striped table-hover table-blue text-center">
                        <thead >
                            <th >SN</th>
                            <th  class="text-left">Payment Status</th>
                            <th  class="text-left">Paid Amount</th>
                            <th  class="text-left">Time Duration</th>
                            <th  class="text-left">Renew Membership</th>                                
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
                                    <td class="text-left">{{ $data->status }}</td>
                                    <td class="text-left">USD {{ $data->total_amount }}</td>                  
                                    <td class="text-left">{{ date('F d, Y', strtotime($data->payment_time)).' To '.date('F d, Y', strtotime($data->membership_end_at)) }} </td>
                                    <td class="text-left"><button type="button" data="{{$data->plan_id}}" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Renew Membership</button></td>
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
                        <h4 class="modal-title">New Membership</h4>
                    </div>
                    <div class="modal-body">
                        <div class="model-step-first">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus animi atque sapiente dolores optio nihil quod, nulla hic, alias assumenda delectus facilis, rem ut velit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam obcaecati hic eveniet itaque, explicabo at iste dolor quod nulla aliquam? Debitis aliquam quas suscipit vel explicabo voluptatibus repellat ipsa recusandae. Corrupti eaque, ab voluptates ipsam iusto, et reprehenderit odit ipsa, doloremque provident aliquam blanditiis. Provident voluptate libero omnis sed mollitia!</p>
                        </div>
                        <div class="model-step-second">
                            <form method="post" action="{{ url('/upgrade-membership') }}">
                                @csrf
                                <input name="plan_id" id="plan_id" class="" value="{{ old('plan_id') }}"  type="hidden">
                                <button type="submit" class="btn btn-primary">
                                    Pay with <img src="{{url('images/Paypal-button.png')}}">
                                </button>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="proceed_to_pay">Proceed to pay</button>
                    </div>
                </div>
            </div>
         </div>
    </div>
    <style type="text/css">
        .renew-membership {text-align: right; }
        .model-step-second {display: none; }
        div#myModal img {width: 100px; margin: 0 auto; }
        .model-step-second {text-align: center; padding: 50px; }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('td.text-left button').click(function(){
                $('#plan_id').val($(this).attr('data'));
            });
            $('#proceed_to_pay').click(function(){
                $('.model-step-second').show();
                $('.model-step-first, #proceed_to_pay').hide();
            });
        });
    </script>
@endsection