@extends('layouts.main')
@section('content')
<style type="text/css">
.despflex{
  display: flex;
  margin-left: -5%;
}
.table td, .table th {
    font-size: 12px;
  }
td{
  width: 20%;
}
.padding{
	padding: 20px;
}
a.list-group-item {
    color: #fff;
}

	.color-orange{
		color: #b0b1b0;
	}
	.f13 {
		padding-right: 0;
    font-size: 13px !important;
}

.mg{
	margin-top: 2%;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: green;
}
.page-link {
    color: #37a745;
    }
    .descrip{
    	height: 40px;
    }
    .rmt{
    	margin-top: 4%;
    }
    /*my property list css*/
    .color-orange{
		color: #b0b1b0;
	}
	.f13 {
		padding-right: 0;
    font-size: 13px !important;
   }
.page-link {
    color: #37a745;
    }
    .descrip{
    	height: 40px;
    }
    .rmt{
    	margin-top: 4%;
    }
 .note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
     @media screen and (max-width: 667px){
    	.f13 {
       font-size: 17px !important;
    }
    .rmt{
    	margin-top: 0;
    }
    i{
		font-size: 21px !important;
	}
	.color-orange{
		width: 67%;
	}
	@media screen and (max-width: 420px){
		.color-orange{
			width: 57%;
		}
	}
	@media screen and (max-width: 380px){
		.color-orange{
			width: 60%;
		}
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
         @endif
				 <div class="note"><p style="font-size: 22px;">  My  <span style="color: #41ac1b">  Property  </span> List </p>
		         </div>
	 @if(count($property_list))
			<table class="table table-striped table-responsive">
				                <thead>
				                  <tr>
				                    <th scope="col">#</th>
				                    <th scope="col">Address</th>
				                    <th scope="col">Title</th>
				                    <th scope="col">Client</th>
	                              	<th scope="col">Purpose</th>
				                    <th scope="col">Price</th>
				                    <th scope="col">Views</th>
				                    <th scope="col">Action</th>
				                  </tr>
				                </thead>
                    <tbody>
			                  <?php $i=0; $p= 108; ?>
			                  @foreach($property_list as $key => $properties)
			                  <?php $i++; $p++; ?>
			                  <tr>
			                    <th scope="row">{{ $i }}</th>
			                    <td> {{$properties->city_name}} </td>
			                    <td>{{ $properties->title }}</td>
			                    @if($properties->client_name !="")
			                    <td>{{ $properties->client_name }}</td>
			                    @else
                                  <td>Not Found!!</td>
			                    @endif
                              	<td>
	                              	@if($properties->purpose == 'whisper_listing')
	                              		Whisper Listing
	                              	@else
										Active Listing                          	
	                              	@endif
                              	</td>
			                    <td id="price">${{ number_format($properties->price,2) }}
			                    <!-- <?php $price = $properties->price; echo number_format($price,2); ?> --></td>
			                    <td>{{ $properties->count }}</td>
			                    <td class="despflex"><button data-toggle="collapse" data-target="#demo{{ $i }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 20px;"></i></button>
			                    <a href="{{url('property/detail/'.$properties->id)}}" class="btn btn-default btn-xs" style="font-size: 20px; color: green;" href="#"><i class="fas fa-eye"></i></a>
			                    <a href="{{ url('edit/property/'.$properties->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green;" href="#"><i class="fa fa-pencil-square"></i></a>
                                  <a href='{{ url("delete/property/{$properties->id}") }}' onclick="return confirm('Are you sure to delete this Property?')"  class=" btn btn-default btn-xs" style="font-size: 17px; color: green;" title="delete"><i class="fas fa-minus-circle"></i></a>
			                    </td>
			                  </tr>
			                  <tr>
			                  <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo{{ $i }}"> 
			                    <table class="table table-striped table-dark table-responsive">
			                            <thead>
			                              <tr>
			                              	<th>Local Area</th>
				                    		<th>Property Type</th>
			                              	<th>exchange</th>
			                              	<th>All Cash</th>
			                              	<th>Bathroom</th>
			                              	<th>Rooms</th>
			                              </tr>
			                            </thead>
			                            <tbody>
			                              <tr>
			                              	<td>{{$properties->local_area}}</td>
						                    <td> {{ Str::ucfirst($properties->property_type) }} </td>
			                              	<td>{{$properties->exchange}}</td>
			                              	<td>{{ Str::ucfirst($properties->all_cash)}}</td>
			                              	<td>{{$properties->bathroom}}</td>
			                              	<td> {{$properties->rooms}}</td>
			                              </tr>
			                      </tbody>
			                </table>
              
				              </div>
				              </td>
				        </tr>

        <!-- Related properties -->
				             
    @endforeach
    
  </tbody>
</table>
 {!! $property_list->render() !!}

@else
    <p class="padding">
    No Property found!!!
    </p>
    @endif
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
     $('#price').maskMoney();
</script>

@endsection
