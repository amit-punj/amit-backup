@extends('layouts.main')
@section('content')
<style type="text/css">
input::placeholder {
    overflow: visible;
}
input,
input::-webkit-input-placeholder {
    font-size: 15px;
    line-height: 3;
}
.productbox {
    background-color:#ffffff;
  padding:10px;
  margin-bottom:10px;
  -webkit-box-shadow: 0 8px 6px -6px  #999;
     -moz-box-shadow: 0 8px 6px -6px  #999;
          box-shadow: 0 8px 6px -6px #999;
          max-width: 25%;
          margin: 3px;
}
.despflex{
  display: flex;
  margin-left: -5%;
}
.table td, .table th {
    font-size: 12px;
  }
  .requirement{
    margin-top: 3%;
  }
  .reqprop{
    font-size: 22px;
  }
td{
 width: 20%;
}
.table-text{
 color: #fff;
}
a.list-group-item {
    color: #fff;
}
.note
{text-align: center;height: 80px;background-color:  #0f2b61;color: #fff;font-weight: bold;line-height: 80px;}
	.color-orange{
		color: #b0b1b0;
	}
	.f13 {
		padding-right: 0;
    font-size: 13px !important;
}
.viewbtn{
     border-radius: 20px; width: 100%; background-color: #b0b1b0;
    }
    .editbtn{
    	border-radius: 20px; width: 100%; background-color: green; color: white;
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
    .widget .widget-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 20px;
    text-transform: uppercase;
}
.btn.btn-default {
    background-color: transparent !important;
    color: unset !important;
    border-color: unset !important;
    border-bottom-color: unset !important;
    border-style: none;
}
/*sectio css*/
.small-box {
  position: relative;
  display: block;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  margin-bottom: 15px;
}
.small-box > .inner {
  padding: 10px;
}
.small-box > .small-box-footer {
  position: relative;
  text-align: center;
  padding: 3px 0;
  color: #fff;
  color: rgba(255, 255, 255, 0.8);
  display: block;
  z-index: 10;
  background: rgba(0, 0, 0, 0.1);
  text-decoration: none;
}
.small-box > .small-box-footer:hover {
  color: #fff;
  background: rgba(0, 0, 0, 0.15);
}
.small-box h3 {
  font-size: 38px;
  font-weight: bold;
  margin: 0 0 10px 0;
  white-space: nowrap;
  padding: 0;
}
.small-box p {
  font-size: 15px;
}
.small-box p > small {
  display: block;
  color: #f9f9f9;
  font-size: 13px;
  margin-top: 5px;
}
.small-box h3,
.small-box p {
  z-index: 5px;
}
.small-box .icon {
  position: absolute;
  top: auto;
  bottom: 5px;
  right: 5px;
  z-index: 0;
  font-size: 90px;
  color: rgba(0, 0, 0, 0.15);
}
.small-box:hover {
  text-decoration: none;
  color: #f9f9f9;
}
.small-box:hover .icon {
  animation-name: tansformAnimation;
  animation-duration: .5s;
  animation-iteration-count: 1;
  animation-timing-function: ease;
  animation-fill-mode: forwards;
  -webkit-animation-name: tansformAnimation;
  -webkit-animation-duration: .5s;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-timing-function: ease;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-name: tansformAnimation;
  -moz-animation-duration: .5s;
  -moz-animation-iteration-count: 1;
  -moz-animation-timing-function: ease;
  -moz-animation-fill-mode: forwards;
}
.bg-red,
.bg-yellow,
.bg-aqua,
.bg-blue,
.bg-light-blue,
.bg-green,
.bg-navy,
.bg-teal,
.bg-olive,
.bg-lime,
.bg-orange,
.bg-fuchsia,
.bg-purple,
.bg-maroon,
.bg-black {
  color: #f9f9f9 !important;
}
.bg-gray {
  background-color: #eaeaec !important;
}
.bg-black {
  background-color: #222222 !important;
}
.bg-red {
  background-color: #f56954 !important;
}
.bg-yellow {
  background-color: #f39c12 !important;
}
.bg-aqua {
  background-color: #00c0ef !important;
}
.bg-blue {
  background-color: #0073b7 !important;
}
.bg-light-blue {
  background-color: #3c8dbc !important;
}
.bg-green {
  background-color: #00a65a !important;
}
.bg-navy {
  background-color: #001f3f !important;
}
.abcd{

    font-size: 13px;
  }
   .search-bar{
    color: white; background-color: #0e2a60; display: flex; min-height: 100px;
  }

@media screen and (max-width: 823px){
 .search-bar{
  display: unset;
  padding: 20px;
}
 input#searchbtndashboard {
    width: 277px;
}
input#autocomplete {
    width: 277px;
}
.abcd {
    width: 277px;
  }
}
@media screen and (max-width: 770px){
}
@media screen and (max-width: 768px){
}
@media screen and (max-width: 767px)
{
  input#searchbtndashboard {
    width: 100%;
}
input#autocomplete {
    width: 100%;
}
.abcd {
    width: 100%;
  }
}
@media screen and (max-width: 640px){
 .search-bar{
  display: unset;
  padding: 20px;
  width: 100%;
}

}
@media screen and (max-width: 568px){
  }
  @media screen and (max-width: 320px){
 
.search-bar{
  display: unset;
}
  }
@media screen and (min-width: 1100px)
{
.abcd {
    margin-top: 18px;
}
input#autocomplete {
    margin-top: 18px;
}
input#searchbtndashboard{
  margin-top: 18px;
} 
}

    </style> 
<div class="container">
	<div class="row m-0">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>
		<div class="col-md-9 setmd">
			        <div class="note">
			           <p style="font-size: 22px;">Dashboard<span style="color: #41ac1b"></span></p>
                    </div>
                  <section class="content" style="padding: 30px;">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        @if(isset($total_requirement))
                                        {{ $total_requirement }}
                                        @else
                                        0
                                        @endif
                                    </h3>
                                    <p>
                                        Total Buyers
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-search-dollar"></i>
                                </div>
                                <a href="{{url('agent/requirement/list')}}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       @if(isset( $total_properties))
                                        {{  $total_properties }}
                                        @else
                                        0
                                        @endif
                                    </h3>
                                    <p>
                                        Total Properties
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <a href="{{url('myproperty/list')}}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                  </section>
                  <h2>Search</h2>
                  <hr style="border: 1px solid #37a65a;">
                    <div class="container" >
                      <form  action="{{url('agent/search_req')}}" method="get">
                        <div class="row margintop">
                                <div class="col-sm-1"></div>
                                          @csrf
                                         <div class="col-sm-12 col-md-10 col-xs-12 text-center search-bar">
                                              <div class="col-md-3 col-sm-12 col-xs-12 margintop">
                                                <select name="search_by" class="form-control abcd">
                                                 <option value="property">Property</option>
                                                  <option value="requirement">Buyers</option>
                                                </select>
                                              </div>
                                              <div class="col-md-5 col-sm-12 col-xs-12 margintop">
                                                <input name="latitude"  id="latitude_dashboard" type="hidden">   
                                                <input name="longitude"  id="longitude_dashboard" type="hidden">
                                                <input id="autocomplete" name="search" class="form-control autocomplete" placeholder="Enter address for Search" type="text"/>
                                              </div>
                                              <div class="col-md-4 col-sm-12 col-xs-12 margintop">
                                                <input type="submit" id="searchbtndashboard" name="button" class="btn btn-success form-control search_">
                                              </div>
                                         </div>
                                     <div class="col-sm-1"></div>
                        </div>
                      </form>
                    </div>
            <div class="requirement">      
                  <span class="reqprop">My Buyers</span>
                  <hr style="border: 1px solid #37a65a;">
                  @if(count($list))
                 <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Client</th>
                    <th scope="col">Price</th>
                    <th scope="col">Neighborhood</th>
                    <th scope="col">Views</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $number=0; $i=01111; $p= 108; ?>
                  @foreach($list as $key => $lists)
                  <?php $number++; $i++; $p++; ?>
                  <tr>
                    <th scope="row">{{ $number }}</th>
                    <td>{{ $lists->title }}</td>
                    @if($lists->client_name != "")
                    <td> {{ Str::ucfirst($lists->client_name) }} </td>
                    @else
                     <td>Not Found!!</td>
                    @endif
                    <td>$ {{ number_format($lists->min_price,2)}} - {{ number_format($lists->max_price,2) }} </td>
                    <td> {{$lists->local_area}} </td>
                    <td> {{$lists->count}} </td>
                    <td class="despflex">
                          <button  data-toggle="collapse" data-target="#demo{{ $i }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 17px;"></i>
                          </button>
                          <button data-toggle="collapse" data-target="#demo{{ $p }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-link" style="font-size: 17px; color: green;"></i></button>
                          <a href="{{ url('myview/require/'.$lists->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green !important;" href="#"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="12" class="hiddenRow">
                      <div class="accordian-body collapse" id="demo{{ $i }}"> 
                          <table class="table table-dark table-responsive">
                              <thead>
                                <tr>
                                  <th>Address</th>
                                  <th>Property Type</th>
                                  <th>Type</th>
                                  <th>exchange</th>
                                  <th>All Cash</th>
                                  <th>Bathroom</th>
                                  <th>Rooms</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{$lists->city_name}}</td>
                                  <td> {{ Str::ucfirst($lists->property_type) }} </td>
                                  <td>{{ Str::ucfirst($lists->purpose) }}</td>
                                  <td>{{$lists->exchange}}</td>
                                  <td>{{ Str::ucfirst($lists->all_cash)}}</td>
                                  <td>{{$lists->min_bathroom}} - {{ $lists->max_bathroom }}</td>
                                  <td>{{$lists->min_room}} - {{$lists->max_room}}</td>
                                </tr>
                            </tbody>
                          </table>
                      </div>
                    </td>
                  </tr>

        <!-- Related properties -->
             <tr>
            <td colspan="11" class="hiddenRow 1"><div class="accordian-body collapse 1" id="demo{{ $p }}"> 
              <table class="table table-striped table-dark table-responsive">
                      <thead>
                        <tr><th>Related Properties</th><th></th><th></th><th></th></tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                </table>
                    <div class="row text-center bg-color color-gray p-3">
                      @if(count($match[$lists->id]))
                        <?php $limit = 0;  ?>
                        @foreach($match[$lists->id] as $matches)
                          <?php 
                            if($limit == 4){ break; }
                          ?>
                          <div class="col-md-3 column productbox">
                              <div class="producttitle">{{ Str::substr($matches->title,0,5)}}</div>
                              <div class="productprice"><div class="pull-right"><a href="{{url('property/detail/pub/'.$matches->id)}}" class="btn btn-success btn-sm" role="button">See</a></div><div class="pricetext"> ${{ number_format($matches->price,2)}} </div>
                              </div>
                          </div>
                          <?php $limit++; ?>
                        @endforeach
                      @else 
                      <p> No related property found! </p>
                      @endif
                    </div>
              </div>
              </td>
             </tr>
             @endforeach
           </tbody>
         </table>
        @else
       <p style="padding: 10px;">
       No Buyer found!!!
       </p>
      @endif
    </div>   
<span class="reqprop">My Properties</span>
<hr style="border: 1px solid #37a65a;">
 @if(count($property_list))
			             <table class="table table-striped table-responsive">
				                <thead>
				                  <tr>
				                    <th scope="col">#</th>
				                    <th scope="col">Title</th>
                            <th scope="col">Client</th>
				                    <th scope="col">Price</th>
                            <th scope="col">Neighborhood</th>
				                    <th scope="col">Views</th>
				                    <th scope="col">Action</th>
				                  </tr>
				                </thead>
                    <tbody>
			           
			                  <?php $x=0; ?>
			                  @foreach($property_list as $key => $properties)
			                  <?php $x++; ?>
			                  <tr>
			                    <th scope="row">{{ $x }}</th>
                          <td>{{ $properties->title }}</td>
                          @if(isset($properties->client_name))
			                    <td>{{ $properties->client_name }}</td>
			                   @else
                         <td>Not Found!!</td>
                         @endif
			                    <td>${{ number_format($properties->price,2) }} </td>
                          <td> {{$properties->local_area}} </td>
			                    <td> {{$properties->count}} </td>
			                    <td class="despflex"><button data-toggle="collapse" data-target="#demo{{ $x }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 20px;"></i></button>
			                    <a href="{{url('property/detail/'.$properties->id)}}" class="btn btn-default btn-xs" style="font-size: 20px; color: green !important;" href="#"><i class="fas fa-eye"></i></a>
			                    </td>
			                  </tr>
			                  <tr>
			                  <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo{{ $x }}"> 
			                    <table class="table table-striped table-dark table-responsive">
			                            <thead>
                                    <tr><th> Address </th>
			                              <th scope="col"> Property Type </th>                                      
                                    <th> Purpose </th>
                                    <th> exchange </th>
                                    <th> All Cash </th>
                                    <th> Bathroom </th>
                                    <th> Rooms </th></tr>
			                            </thead>
			                            <tbody class="table-text">
			                              <tr>
                                      <td>{{$properties->city_name}}</td>
                                      <td> {{ Str::ucfirst($properties->property_type) }} </td>
                                     @if($properties->purpose == 'whisper_listing')
                                      <td>Whisper Listing</td>
                                  @else
                                   <td> Active Listing  </td>                          
                                  @endif
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
    @endforeach
  </tbody>
</table>

        <!-- Related properties -->
                     
    
    @else
    <p style="padding: 10px;">
    No property found!!!
    </p>
    @endif
    


		</div>
	</div>
</div>
@endsection
@section('scripts')

<script>
var placeSearch, autocomplete;

function initAutocomplete() {
  
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});
  autocomplete.setFields(['address_component', 'geometry']);
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
 
  var place = autocomplete.getPlace();
  var lat = place.geometry.location.lat();
  var lng = place.geometry.location.lng();
  console.log(place.geometry.location.lat());

  document.getElementById("latitude_dashboard").value = lat;
  document.getElementById("longitude_dashboard").value = lng;
}
</script>
 <script type="text/javascript">
   $(document).on('change','#autocomplete',function(e){
       e.preventDefault;
         $("#latitude_dashboard").val('');
         $("#longitude_dashboard").val('');
   });
        $('#form_submit').submit(function() {
        var lat =  $("#latitude_dashboard").val();
        var lng =  $("#longitude_dashboard").val();
        if (lat != '' && lng != '') {
            return true;
        }else{
          alert('Please Select city from dropdown');
          return false;
        }
    });
</script>
@endsection