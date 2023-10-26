@section('title','Ticket List')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Ticket List'])
    <div class="container">
        <div id="tickets" class="tab-pane ">
            <div class="row">
                <div class="col-sm-6">
                    <div class="Building-Units">List of Tickets</div>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-12">
                    @if(count($tickets) > 0 )
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                <thead>
                                    <tr>
                                        <td >Title</td>
                                        <td >Description</td>
                                        <td >Department</td>
                                        <td >Status</td>
                                        <td >Action</td>
                                    </tr> 
                                </thead>   
                                <tbody > 
                                    @foreach($tickets as $key => $ticket)        
                                    <tr>
                                        <td >{{$ticket->title}}</td>
                                        <td >{{substr($ticket->description,0,40)}}</td>
                                        <td >{{ ucfirst($ticket->department)}}</td>
                                        <td >{{ucfirst($ticket->status) }}</td>
                                        <td >
                                            <a href="{{url('ticket-view/'.$ticket->id)}}"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a>
                                            @if(Auth::user()->user_role == 2)
                                                @if($ticket->status == 'pending')
                                                    <button data-id="{{$ticket->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
                                                @endif
                                            @elseif(Auth::user()->user_role == 3)
                                                <?php
                                                    $poId = App\PropertiesUnit::find($ticket->unit_id);
                                                    $ticketPermission = App\Helpers\Helper::accessPermission($poId->user_id,Auth::user()->user_role,'tickets_permission');
                                                ?>
                                                @if($ticket->status == 'pending')
                                                    @if($ticketPermission != 0)
                                                    <button data-id="{{$ticket->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $tickets->links() }}
                    @else
                    <p>No tickets</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .Building-Units { font-size: 24px; padding-bottom: 15px; }
    </style>
    <script type="text/javascript">
        jQuery('.ticket_close').click(function(){
            var self = this;
            var id      = $(this).data('id');
            var status  = jQuery(this).data('status');
            var thisa   = $(this);
            var result  = "";
            if(status == 'closed'){
                var result = confirm("Want to close the ticket?");
            }
            if (!result) {
                return false;
            }
            $.ajax({
                url: "{{url('update-ticket-status')}}",
                type: "post",
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id':id,
                    'status':status
                },
                success : function(data) { 
                    var myJSON = JSON.parse(data); 
                    $(self).hide();
                    toastr.success('Ticket Closed Successfully!');
                    setTimeout(function(){ location.reload(); }, 2000);
                },
            });
        });
    </script>
@endsection