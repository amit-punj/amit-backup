@extends('admin.layout.base')



@section('title', 'Ticket View')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            @if(Setting::get('demo_mode') == 1)
                <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : No Permission to Edit and Delete.
                </div>
            @endif
            <h5 class="mb-1 col-md-10">
                @lang('admin.include.tickets')
                @if(Setting::get('demo_mode', 0) == 1)
                <span class="pull-right">(*personal information hidden in demo)</span>
                @endif
            </h5>
            <div class="col-md-2" style="text-align: right;">
              <a href="{{ route('admin.user.ticketList', $ticket->issue_raised_by) }}">
                <i class="fa fa-angle-left"></i> Back
              </a>
            </div>

            <table class="table table-striped table-bordered dataTable">
                <thead>
                    <tr>
                        <th style="text-align: center">@lang('admin.tickets.title')</th>
                        <!-- <th>@lang('admin.tickets.description')</th> -->
                        <th style="text-align: center">@lang('admin.tickets.category')</th>
                        <th style="text-align: center">@lang('admin.tickets.raised')</th>
                        <th style="text-align: center">@lang('admin.tickets.status')</th>
                        <th style="text-align: center">@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center">{{ $ticket->title }}</td>
                        <!-- <td>{{ $ticket->description }}</td> -->
                        <td style="text-align: center">{{ $ticket->category }}</td>
                        <td style="text-align: center">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td style="text-align: center">{{ $ticket->status }}</td>
                        <td style="text-align: center">
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                @if($ticket->status == 'open')
                                    <a class="btn btn-danger" href="{{ route('admin.ticket.disapprove', $ticket->id ) }}">Close Ticket</a>
                                @else
                                    <a class="btn btn-success" href="{{ route('admin.ticket.approve', $ticket->id ) }}">Open Ticket</a>
                                @endif
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="5">Ticket Issue Description</th>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-size: 12px">{{$ticket->description}}</td>
                    </tr>
                </tbody>
            </table>
            <!-- Messaging -->
            <div class="container mt-3">
                <h3 class=" text-center">Messaging</h3>
                <div class="messaging" style="width: 1040px;">
                    <div class="inbox_msg">
                        <div class="mesgs">
                            <div class="msg_history">
                                @if(count($messages) > 0)
                                @foreach($messages as $key => $message)
                                    @if($message->sender == Auth::user()->id)
                                        <div class="outgoing_msg">
                                          <div class="sent_msg">
                                            <p>{{$message->reply}}</p>
                                            <span class="time_date"> {{$message->created_at}} </span> </div>
                                        </div>
                                    @else
                                        <div class="incoming_msg">
                                          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                          <div class="received_msg">
                                            <div class="received_withd_msg">
                                              <p>{{$message->reply}}</p>
                                              <span class="time_date"> {{$message->created_at}} </span></div>
                                          </div>
                                        </div>
                                    @endif
                                @endforeach
                                @endif
                            </div>
                            @if($ticket->status == 'open')
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        <form action="{{ route('admin.ticket.store', $ticket->id ) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="text" class="write_msg" placeholder="Type a reply" name="reply" />
                                            <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Messaging -->
        </div>
    </div>
</div>
@endsection