@extends('layouts.main')
@section('content')
<style type="text/css">
td{
	width: 33%;
	
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
.viewbtn{
     width: 100%; background-color: #b0b1b0;
     margin-top: 1%;
    }
    .editbtn{
  width: 100%; background-color: green; color: white; margin-top: 1%;
    }
.mg{
	margin-top: 2%;
}
.card-title{
	font-size: 29px;
	font-weight: bold;
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
  /*preview csss  */
.btndesign {
    background-color: #fff;
    border: 2px solid #ffc3aa;
    color: #ef6925;
    background-color: #28A745;;
    top: 0;
    padding: 9px 20px;
        padding-bottom: 9px;
    padding-bottom: 11px;
    color: #fff;
    position: relative;
    font-size: 15px;
    font-weight: 600;
    display: inline-block;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    margin-right: 6px;
    overflow: hidden;
    border: none;
}
.cross{
	position: absolute; margin-top: -9%; margin-left: -9%;
}
.delete {
	background: transparent;
	border-style: unset;
   margin-top: 100%;
    color: red;
    display: none;
    position: absolute;
    margin-left: 100%;
}
.title:hover .delete {
   display:block
}
.note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
   /* background-color: #4fad26;*/
    font-weight: bold;
    line-height: 80px;
}
img{
	padding: 3px;
	margin-top: 2%;
}

@media screen and (max-width: 731px){
	
}
@media screen and (max-width: 575px)
{
	.mgbtn{
		margin-top: 2%;
	}
}
@media screen and (max-width: 569px){
	.mg{
		margin-top: 2%;
		margin-left: 0px;
	}
	.delete{
		margin-top: 32%;
		margin-left: 25%;
	}
}
@media screen and (max-width: 420px){
	.delete{
		margin-top: 26%;
      margin-left: 22%;
	}
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>

		<div class="col-md-9 setmd">
		<div class="note"><p style="font-size: 22px;">Preview <span style="color: #41ac1b"> Your </span> Property</p>
                 </div>
			<table class="table user-view-table table-responsive table-striped">
			<tbody>
			<?php $amenity = ""; 
			if(isset($store['amenity'])) {
				$amenity = $store['amenity'];
				
			}
			$building = "";
			if(isset($store['building']))
			{
				$building = $store['building'];
			}
			?>
    					<tr>
						<td>Title:</td>
						<td>{{ $store['title'] }}</td>
					</tr>
					<tr>
						<td>Client Name:</td>
						<td>{{ $store['client_name'] }}</td>
					</tr>
					<tr>
						<td>City:</td>
						<td>{{ $store['city_name'] }}</td>
					</tr>
					<tr>
						<td>Address:</td>
						<td>{{ $store['address'] }}</td>
					</tr>
					<tr>
						<td>Purpose:</td>
						<?php
						 if($store['purpose'] == "whisper_listing")
						 {
						  $purpose = "Whisper Listing";
						 }
						 if($store['purpose'] == "active_listing")
						 {
						  $purpose = "Active Listing";
						 }
						 ?>
						<td> @if(isset($purpose)) {{ $purpose }}  @endif</td>
					</tr>
					<tr>
						<td>Property type</td>
						<td>{{ Str::ucfirst($store['property_type']) }}</td>
					</tr>
					<tr>
						<td>Price</td>
						<td>{{ $store['price'] }}</td>
					</tr>
					<tr>
						<td>Purpose</td>
						<td>{{ Str::ucfirst($store['type']) }}</td>
					</tr>
					<tr>
						<td> Bedrooms</td>
						<td>{{ $store['rooms'] }} </td>
					</tr>
					<tr>
						<td> Bathroom </td>
						<td>{{ $store['bathroom'] }}</td>
					</tr>
					<tr>
						<td>Half Bathroom </td>
						<td>{{ $store['half_bathroom'] }}</td>
					</tr>
					<tr>
						<td>All cash </td>
						<td>{{ Str::ucfirst($store['all_cash']) }}</td>
					</tr>
					<tr>
						<td>Exchange </td>
						<td>{{ Str::ucfirst($store['exchange']) }}</td>
					</tr>
					<tr>
						<td>Cross streets </td>
						<td>{{ $store['cross_streets'] }}</td>
					</tr>
					<tr>
						<td>size (sq-ft) </td>
						<td>{{ $store['size'] }}</td>
					</tr>
					<tr>
						<td>
							Monthly Maintenance
						</td>
						<td>
							{{ $store['monthly_maintenance']}}
						</td>
					</tr>
					<tr>
						<td>
							Monthly Taxes
						</td>
						<td>
							{{ $store['monthly_tax']}}
						</td>
					</tr>
					@if(isset($store['exposure']))
					<tr>
						<td>exposure</td>
						<td>{{ $store['exposure'] }}</td>
					</tr>
					@endif

					<tr>
						<td>Description </td>
						<td>{{ $store['discription'] }}</td>
					</tr>
					<tr>
						<td>Status </td>
						<td>{{ $store['status'] }}</td>
					</tr>
					<tr>
					
					<td>Apartment Amenities </td>
						<td>
						<?php
							if(isset($store['amenities']))
							{
								foreach ($amenities as $key => $value) {
									if(in_array($value->id, $store['amenities']))
									{
										$abc[]=  $value->amenities_name;
									}
								}
								echo implode(',', $abc);
							}
							else
							{
								echo "No Apartment Amenities choose ";
							}
						?>
						</td>

						</tr>
						<tr>
							<td>Building Features </td>
							<td>
								<?php 
                                 if(isset($store['building_features']))
                                 {
                                if($store['building_features'] !="")
                                {	
                                 	foreach ($building_features as $key => $features) {
                                 		if(in_array($features->id, $store['building_features']))
                                 		{
                                 		$xyz[] = $features->feature_name;
                                     	}
                                 	}
                                 
                                 echo implode(',', $xyz);
                                  }
                                }
                                else
                                {
                                	echo "No Building features choose ";
                                }  
                               
								?>
							</td>
						</tr>
						<tr>
						<table class="table-responsive">
						   <tr>
								<div class="row">
									@if(count($property_images))
									     @if(count($property_images) == '1')
                                           <style type="text/css">
                                           	.delete1{
                                           		margin-top: 44% !important;
											    color: red;
											    display: none;
											    position: absolute;
											    margin-left: 34% !important;
                                           	}
                                           	@media screen and (max-width: 640px){
                                           		.delete1{
                                           			margin-top: 16% !important;
                                           			margin-left: 12% !important;
                                           		}
                                           	}
                                           </style>
									     @endif
										@foreach($property_images as $key => $property_image)
										<td colspan="2" id="rem_{{$property_image->id}}">
											<?php $path = $property_image["image_name"];?>
											<div class="col-md-3 col-sm-6 col-xs-6 title">
		                                        <button class="delete delete1" id="{{$property_image->id}}"><i class="fas fa-trash" style="font-size: 20px;"></i></button>
												<img src="{{ asset('images/'.$path) }}" height="100" width="100" >
											</div>
										</td>
										@endforeach
									@endif
								</div>
							</tr>
						</table>	
						</tr>
		</tbody>
		</table>
		<hr>
		<div class="row">
		    <div class="col-md-6 col-sm-6 col-xs-6">
		           <button style="border-style: none; width: 100%; background-color: #0e2a60; color: white;" name="return" class="btn"  onClick="javascript: window.history.back(-1)";>back</button>
		    </div>
		<div class="col-md-6 col-sm-6 col-xs-6">
		  <form action="{{url('agent/property/save')}}" method="post">
		 @csrf
		 <input type="hidden" name="title" value="{{ $store['title']}}">
		 <input type="hidden" name="client" value="{{ $store['client']}}">
		  <input type="hidden" name="city_name" value="{{ $store['city_name']}}">
		  <input type="hidden" name="address" value="{{ $store['address']}}">
		  <input type="hidden" name="purpose" value="{{ $store['purpose']}}">
		   <input type="hidden" name="latitude" value="{{ $store['latitude']}}">
		    <input type="hidden" name="longitude" value="{{ $store['longitude']}}">
		   <input type="hidden" name="local_area" value="{{ $store['local_area']}}">
		    <input type="hidden" name="discription" value="{{ $store['discription']}}">
		     <input type="hidden" name="rooms" value="{{ $store['rooms']}}">
		      <input type="hidden" name="bathroom" value="{{ $store['bathroom']}}">
		      <input type="hidden" name="half_bathroom" value="{{ $store['half_bathroom']}}">
		      <input type="hidden" name="cross_streets" value="{{ $store['cross_streets']}}">
		       <input type="hidden" name="price" value="{{ $store['price']}}">
		        <input type="hidden" name="size" value="{{ $store['size']}}">
		        <input type="hidden" name="amenities" value="{{ $amenity}}">
		        <input type="hidden" name="building_features" value="{{ $building }}">
		        <input type="hidden" name="zipcode" value="{{ $store['zipcode']}}">
		          <input type="hidden" name="exchange" value="{{ $store['exchange']}}">
		           <input type="hidden" name="property_type" value="{{ $store['property_type']}}">
		           <input type="hidden" name="status" value="{{ $store['status']}}">
		            <input type="hidden" name="type" value="{{ $store['type']}}">
		             <input type="hidden" name="all_cash" value="{{ $store['all_cash']}}">
		             <input type="hidden" name="monthly_maintenance" value="{{ $store['monthly_maintenance']}}">
		             <input type="hidden" name="monthly_tax" value="{{ $store['monthly_tax']}}">
		             <?php 
		             if(isset($store['exposure']) && $store['exposure'] !="")
		             {
		             	?>
		             <input type="hidden" name="exposure" value="{{ $store['exposure'] }}">
		             <?php
		         }
		             ?>
                          
		              <button style="border-style: none; width: 100%; background-color: #5fb43a; color: white;" class="btn mgbtn" type="submit">Save</button>
		            </form>   
		                 </div>
		           </div>
         </div> 
          </div>
          <div class="col-md-6"></div>
		 </div>       
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).on('click','.delete',function(){
		var id = $(this).attr('id');
		if(confirm("are you sure you want to delete this data?"))
		{
	        $.ajax({
	        	url:"{{route('ajaxdata.removedata')}}",
	        	method:"get",
	        	data:{id:id},
	        	success:function(data)
	        	{
	        		$('#rem_' +id).remove();
	        	}
	        })
		}
		else
		{
			return false;
		}
	});
    window.onload = function(){
     var long = '{{ $store['longitude'] }}';
     var lat = '{{ $store['latitude'] }}';
     var city = '{{ $store['city_name'] }}';
     // alert(long+"/"+lat+"-"+city);
	localStorage.setItem("city_name_property",city);
	localStorage.setItem("longitude_property",long);
	localStorage.setItem("latitude_property",lat);
}	
</script>
@endsection