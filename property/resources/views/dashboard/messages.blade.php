@section('title','Messages')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Messages'])
<div class="container">
    <div id="book_appointment" class="">
        <div class="row">
            <div class="col-sm-12">      
                @if(count($emails) > 0 ) 
                    <div  class="user-info-table">
                        <table  class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr class="text-center f17">
                                    <th class="text-left"> Appointment Title</th>
                                    <th class="text-left"> User Name </th>
                                    <th class="text-left"> Appointment Type </th>
                                    <th class="text-left"> Message </th>
                                    <th class="text-left"> Date </th>
                                    @if(Auth::user()->user_role == 4 || Auth::user()->user_role == 6)
                                    <th class="text-left"> Action </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($emails as $key =>$email)    
                                <tr class="f15 clickable" >
                                    <td class="f500">
                                        <a target="_blank" href="{{ url('propertydetails/'.$email->unit_id) }} ">
                                        <?php echo $retVal = (isset($email->appointment->title) ) ? substr($email->appointment->title, 0, 25)."..."  : 'no title' ; ?> </a>
                                    </td>
                                    <td>
                                    @if(Auth::user()->id == $email->send)
                                        <!-- <a href="{{url('tenant-details/'.$email->id)}}"></a> -->
                                        {{$email->assigned->name}}
                                    @else 
                                        <!-- <a href="{{url('tenant-details/'.$email->id)}}"></a>  -->
                                        {{$email->create->name}}
                                    @endif
                                    <td> {{$email->email_type}}</td>
                                    <td> {{$email->message}}
                                    </td>
                                    <td>{!! \Helper::DateTime($email->created_at); !!}</td>
                                    @if(Auth::user()->user_role == 4 || Auth::user()->user_role == 6)
                                    <td>
                                        <?php $reply_time = strtotime($email->time); ?>
                                        <?php $current_time = strtotime(date("Y-m-d H:m:s")); ?>
                                        @if($current_time < $reply_time && $email->status == 0)
                                          <a data-id="{{$email->id}}" class="btn btn-success reply">Reply</a>
                                        @elseif($email->status == 1)
                                          <span>Replied</span>
                                        @elseif($email->status == 2)
                                          <span>Unable to reply</span>
                                        @endif
                                    </td>
                                    @endif
                                </tr> 
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                <p>No Emails!</p>
                @endif  
            </div>        
        </div>      
    </div> 
</div>
<div class="modal fade" id="reply_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="visit_add_remark" action="{{url('send-message')}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Reply</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message *') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('message') is-invalid @enderror remark" name="message" required="" rows="5" cols="50" placeholder="Message">{{ old('message','Message') }}</textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                     <button type="submit" id="b_create" class="btn btn-success">Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
  jQuery('.reply').click(function(){
        var id      = $(this).data('id');
        $('#reply_modal').modal('show');
        $("#reply_modal #id").val(id);
    });
</script>
<style>
    .chat-container {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .chat-container::after {
      content: "";
      clear: both;
      display: table;
    }

    .chat-container img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .chat-container img.right {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }
</style>
@endsection