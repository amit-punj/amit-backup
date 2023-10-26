@extends('layouts.main')
@section('content')
<style type="text/css">

.note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
.despflex{
  display: flex;
  margin-left: -5%;
}
.page-link {
    color: green;
    background-color: #fff;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green !important;
    border-color: unset;
}
@media screen and (max-width: 420px){
	    td{
	    	font-size: 12px;
	    }
	    th{
	    	font-size: 14px;
	    }
}
</style>
<div class="container">
	<div class="row m-0">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>
		<div class="col-md-9 setmd">
		   @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @elseif(Session::has('flash_message_error'))
            <div class="alert alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
				 <div class="note"><p style="font-size: 22px;">  My  <span style="color: #41ac1b">  Client  </span> List </p>
		         </div>

<div class="row">
	<div class="col-md-12">
	@if(count($slider_list))
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Client name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
		     	<tbody>
						<?php $i= 1; ?>
						@foreach($slider_list as $slider)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$slider->fname}}</td>
								@if($slider->email !="")
								<td>{{$slider->email}}</td>
								@else
                                  <td>Not found !!</td>
								@endif
								<td class="despflex">
								 <a href='{{url("agent/view/client/$slider->id")}}' class="btn btn-default btn-xs" style="font-size: 17px; color: green;" ><i class="fas fa-eye"></i></a>
									<a href="{{ url('agent/client/'.$slider->id.'/edit_agent')}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green;" ><i class="fa fa-pencil-square"></i></a>
									<a href='{{ url("agent/client/{$slider->id}/delete") }}' onclick="return confirm('Are you sure to delete this Property?')"  class=" btn btn-default btn-xs" style="font-size: 17px; color: green;" title="delete"><i class="fas fa-minus-circle"></i></a>
	                          		
	                          	</td>
							</tr>
						@endforeach
					@else
						<p style="padding: 10px;">No Client found here.</p>
					@endif
				</tbody>
			</table>
				{!! $slider_list->render() !!}
		</div>
		</div>
	</div>
</div>


@endsection