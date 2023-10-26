@extends('layouts.main')
@section('content')
<style type="text/css">

a.list-group-item {
    color: #fff;
}
	.f13 {
		padding-right: 0;
    font-size: 13px !important;
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
div#main {
   background-color: #f3f3f3;
}
.mg{
	margin-left: -32%;
}
.sumbit-button {
	border-style: none; width: 100%; background-color: #5fb43a; color: white; margin-top: 2%;
}
.preview-back {
	border-style: none;  width: 100%; color: white; background-color: #0e2a60;margin-top: 2%;
}
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
    border-radius: 50px !important;
}
@media screen and (max-width: 569px){
	.mg{
		margin-top: 2%;
		margin-left: 0px;
	}
	button.btn.sumbit-button{
		margin-top: 3%;
	}
	.note p{
		font-size: 19px !important;
	}
}
</style>
<div class="container">
	<div class="row m-0">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>
		<div class="col-md-9 setmd">
@if($store !="")

     <table class="table table-responsive user-view-table m-0">
			<tbody>
			<?php $amenity = ""; 
			if(isset($store['amenity'])) {
				$amenity = $store['amenity'];
				// echo $amenity;
				// die('ff');
			}
			$building = "";
			if(isset($store['building']))
			{
				$building = $store['building'];
			}
			?>
			<div class="note"><p style="font-size: 22px;">Preview<span style="color: #41ac1b"> Requirement</span></p>
                  </div>
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
						<td>Property type:</td>
						<td>{{ $store['property_type'] }}</td>
					</tr>
					<tr>
						<td>All cash :</td>
						<td>{{ $store['all_cash'] }}</td>
					</tr>
					<tr>
						<td>Pre approved:</td>
						<td>{{ $store['pre_approved'] }}</td>
					</tr>
					<tr>
						<td>Investment buyer:</td>
						<td>{{ $store['investment_buyer'] }}</td>
					</tr>


					<tr>
						<td>Price:</td>
						<td>{{ $store['min_price'] }} to {{$store['max_price']}}</td>
					</tr>

					<tr>
						<td>Type:</td>
						<td>{{ $store['purpose'] }}</td>
					</tr>
					<tr>
						<td> rooms:</td>
						<td>{{ $store['min_room'] }} to {{$store['max_room']}}</td>
					</tr>
					<tr>
						<td>1031 exchange :</td>
						<td>{{ $store['exchange'] }}</td>
					</tr>
					<tr>
						<td> bathroom :</td>
						<td>{{ $store['min_bathroom'] }} - {{$store['max_bathroom']}}</td>
					</tr>
					<tr>
						<td>Description :</td>
						<td>{{ $store['discription'] }}</td>
					</tr>
					<tr>
					@if($amenities !="")
					<td>Amenities :</td>
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
						?>
						</td>
						</tr>
						<tr>
							<td>Status :</td>
							<td>{{ $store['status'] }}</td>
						</tr>
						@endif
			
					<td>Building features :</td>
						<td>
						<?php
							if(isset($store['building_features']))
							{
								foreach ($building_features as  $building_featuress) {
									if(in_array($building_featuress->id, $store['building_features']))
									{
										$xyz[]=  $building_featuress->feature_name;
									}
								}
								echo implode(',', $xyz);
							}
						?>
						</td>
						</tr>
				
						<tr>
							<td>Status :</td>
							<td>{{ $store['status'] }}</td>
						</tr>
	
		</tbody>
		</table>
		<hr>
		<div class="row">
		   <div class="col-md-6 col-sm-6 col-xs-6">
		        <button style="" name="return" class="btn preview-back" onClick="javascript: window.history.back(-1)";>back</button>
            </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
		<form action="{{url('agent/requirement/save')}}" method="post">
		 @csrf
		 <input type="hidden" name="title" value="{{ $store['title']}}">
		 <input type="hidden" name="client" value="{{ $store['client']}}">
		<input name="latitude"  id="latitude" type="hidden" value="{{ $store['latitude']}}">
	<input name="longitude"  id="longitude" type="hidden" value="{{ $store['longitude']}}">
		  <input type="hidden" name="city_name" value="{{ $store['city_name']}}">
		  <input type="hidden" name="pre_approved" value="{{ $store['pre_approved']}}">
		  <input type="hidden" name="investment_buyer" value="{{ $store['investment_buyer']}}">
		  <input type="hidden" name="status" value="{{ $store['status']}}">
		   <input type="hidden" name="local_area" value="{{ $store['local_area']}}">
		    <input type="hidden" name="discription" value="{{ $store['discription']}}">
		     <input type="hidden" name="min_room" value="{{ $store['min_room']}}">
		      <input type="hidden" name="max_room" value="{{ $store['max_room']}}">
		      <input type="hidden" name="min_bathroom" value="{{ $store['min_bathroom']}}">
		       <input type="hidden" name="max_bathroom" value="{{ $store['max_bathroom']}}">
		       <input type="hidden" name="min_price" value="{{ $store['min_price']}}">
		         <input type="hidden" name="max_price" value="{{ $store['max_price']}}">
		         <input type="hidden" name="building_features" value="{{ $building }}">
		        <input type="hidden" name="amenities" value="{{ $amenity}}">
		          <input type="hidden" name="exchange" value="{{ $store['exchange']}}">
		           <input type="hidden" name="property_type" value="{{ $store['property_type']}}">
		            <input type="hidden" name="purpose" value="{{ $store['purpose']}}">
		             <input type="hidden" name="all_cash" value="{{ $store['all_cash']}}">
		              <button style="" class="btn sumbit-button" type="submit">Save</button>
		        </form> 
		        </div>
                     </div>
        
          
         </div>                  
    @endif              
   </div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    window.onload = function(){
     var long = '{{ $store['longitude'] }}';
     var lat = '{{ $store['latitude'] }}';
     var city = '{{ $store['city_name'] }}';
     // alert(long+"/"+lat+"-"+city);
	localStorage.setItem("city_name_req",city);
	localStorage.setItem("longitude_req",long);
	localStorage.setItem("latitude_req",lat);
}	
</script>
@endsection
