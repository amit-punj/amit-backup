 @extends('adminlayouts.app')
@section('content')
<?php
$role = Auth::user()->user_role; 
//$contractPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'contract_permission');
?>
<style type="text/css">
    #loading-image{
        margin-left: 37%;
    margin-top: -47%;
    display: none;
    }
</style>
<main class="app-content">
    <div class="app-title"><h3>Tickets List</h3>
    </div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 top-nevigation">
            <div class="tab-content">
                <div id="current" class="">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(count($all_tickets))
                            <div  class="user-info-table">
                                <table  class="table table-hover table-responsive table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th >Unit name</th>
                                            <th >Tanent Name</th>
                                            <th >Title</th>
                                            <th >Description</th>
                                            <th >department</th>
                                            <th >status</th>
                                            <th >Creation Date</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($all_tickets as $key => $tickets)
                                            <tr> 
                                                <td> <a href="{{ url('view_unit-admin/'.$tickets->unit->id)}}">{{ $tickets->unit->unit_name}}</a></td>
                                                <td><a href="{{ url('tanent-detail-admin/'.$tickets->user->id) }}">{{ $tickets->user->name}}</a></td>
                                                <td>{{ $tickets->title}}</td>
                                                <td>{{ $tickets->description}}</td>
                                                <td>{{ $tickets->department }}</td>
                                                <td>{{ $tickets->status}} </td>
                                                <td>{{ $tickets->created_at}}</td>
                                                <td> 
                                                    <a class="btn-info btn" href="{{url('admin/ticket-view/'.$tickets->id)}}">View</a>
                                                    @if($tickets->status == 'pending')
                                                        <button data-id="{{$tickets->id}}" data-status="closed" class="btn-success btn ticket_close">Close</button>
                                                    @endif
                                                    @if($tickets->status == 'closed')
                                                        <button class="btn btn-danger">Closed</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach                                        
                                    </tbody>
                                </table>
                                {{ $all_tickets->links() }}
                            </div>
                           
                            @else
                                <p>No tickets found!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<script type="text/javascript">
    $(".ticket_close").click(function(){

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
            $.ajax(
            {
                url: "{{url('update-ticket-status')}}",
                type: "post",
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id':id,
                    'status':status
                },
                success : function(data) { 
                  var myJSON = JSON.parse(data); 
                  location.reload();
                },
                error : function(data) {
                }
            });
        });

</script>
@endsection