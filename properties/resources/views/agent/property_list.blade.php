@extends('layouts.main')
@section('content')
<style type="text/css">
:active, :focus, :visited, a:hover {
    outline: 0;
}
.f2{
  vertical-align: text-bottom;
}
.col-md-3.col-12.col-sm-12.py-1{
  background-color: #0e2a60 !important;
}
.b-img {
  background-image: url("/assets/imgs/banner.jpg");
  height: auto;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
.active {
  background-color: #5fb43a;
  color: #fff !important;
}
.btn-InActive {
    background: #0e2a60 !important;
    color: white !important;
}

.rgba {
  background: rgba(0, 0, 0, 0.5);
}
a:hover{
  color: white !important;
}
.t-login {
  font-size: 50px;
  margin: 4% 0%;
  color: white;
  font-weight: 500;
}

::ng-deep mat-card-content {
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  width: 100% !important;
}
.img{background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      width: 100% !important;
      height: 100%;
    }

.bg-color {
  background-color: white !important;
}

button {
  color: white;
  border-radius: 0%;
}
.slide {
  border: 2px solid #ffffff96;
  margin-right: 35px;

  padding: 5px;

  .slick-track {
    width: 100% !important;
  }
}
label {
    display: inline-block;
    margin-right: 11%;
    margin-bottom: .5rem;
}

.overlay {
  background: rgba(255, 133, 0, 1); /* Black see-through */
  transition: 0.5s ease;
  opacity: 0;
  position: absolute;
  width: 100%;
  bottom: 0;
}

.mat-card-content:hover > .overlay {
  opacity: 1;
}
.mat-card-content:hover > .property-info {
  bottom: 45px !important;
}
// new property list
.new-property-list {
  .list-header {
    .row {
      margin: 40px 0;
    }
  }
}
  .property-listing {
    ::ng-deep mat-card-content {
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      height: 225px;
      position: relative;
    }

    .prop-tag {
      position: absolute;
      top: 0;
      right: 0px;
      background-color: white;
    /*  background: rgba(0, 255, 0, 0.4);*/
      padding: 12px 30px;
      font-size: 14px;
      border-bottom-left-radius: 35px;
    }

    .property-info {
      position: absolute;
      bottom: 0px;
      left: 10px;
      background-color: rgba(0, 0, 0, 0.5);
      width: 100%;
      margin-left: -10px;
      padding-left:  5px;
      padding-top: 3px;
      padding-bottom: 3px;

      .badge {
        padding: 6px 10px;
        font-size: 14px;
        background-color: #ff8500;
      }

      .add1 {
        font-size: 16px;
        margin: 2px 0;
      }

      .add2 {
        font-size: 15px;
        margin: 2px 0;
        font-weight: 400;
      }
    }
  }
.text-bold{
  font-weight: bold;
}
.f15 {
    font-size: 15px !important;
    vertical-align: sub;
}

.color-gray {
    color: rgba(0, 0, 0, 0.6) !important;
}
.f25 {
    font-size: 25px !important;
}
.f700 {
    font-weight: 700 !important;
}

.f18 {
    font-size: 18px !important;
}
.color-orange {
    color: #5fb43a;
}
.f300 {
    font-weight: 300 !important;
}

.f13 {
    font-size: 13px !important;
}
svg:not(:root).svg-inline--fa {
    overflow: visible;
}
.f14 {
    font-size: 14px !important;
}
.btn-orange {
    background-color: #5fb43a !important;
    color: #ffffff !important;
}
.bc-black {
    background: green !important;
        color: white;
}
.btn:hover {
    color: #212529;
    text-decoration: none;
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
.btn{
  color: white;
}
@media only screen and (min-width: 1025px) and (max-width: 1280px) {
}

@media only screen and (min-width: 768px) and (max-width: 1024px) {
}

@media only screen and (min-width: 601px) and (max-width: 767px) {
}

@media only screen and (min-width: 481px) and (max-width: 600px) {
}

@media only screen and (min-width: 320px) and (max-width: 480px) {
  .note p{
    font-size: 17px !important
  }
}
@media only screen and (max-width: 375px){
.setsecrol{
  font-size: 10px;
}
}

</style>

<?php
$latitude = (isset($_GET['latitude'] )) ? $_GET['latitude'] : '' ;
$longitude = (isset($_GET['longitude'] )) ? $_GET['longitude'] : '' ;
$city_prefil = (isset($_GET['search'] )) ? $_GET['search'] : '' ;
$min_room = (isset($_GET['min_room'] )) ? $_GET['min_room'] : '' ;
$max_room = (isset($_GET['max_room'] )) ? $_GET['max_room']  : '' ;
$min_bathroom = (isset($_GET['min_bathroom'] )) ? $_GET['min_bathroom']  : '' ;
$max_bathroom = (isset($_GET['max_bathroom'] )) ? $_GET['max_bathroom']  : '' ;
$min_price = (isset($_GET['min_price'] )) ? $_GET['min_price']  : '' ;
$max_price = (isset($_GET['max_price'] )) ? $_GET['max_price']  : '' ;
$all_cash = (isset($_GET['all_cash'] )) ? $_GET['all_cash']  : '' ;
$exchange = (isset($_GET['exchange'] )) ? $_GET['exchange']  : '' ;
$purpose1 = (isset($_GET['purpose1'] )) ? $_GET['purpose1']  : '' ;
$purpose = (isset($_GET['purpose'] )) ? $_GET['purpose']  : '' ;
$zipcode = (isset($_GET['zipcode'] )) ? $_GET['zipcode']  : '' ;
$longitude1 = (isset($_GET['longitude1'] )) ? $_GET['longitude1']  : '' ;
$latitude1 = (isset($_GET['latitude1'] )) ? $_GET['latitude1']  : '' ;
$search1 = (isset($_GET['search1'] )) ? $_GET['search1']  : '' ;
$longitude2 = (isset($_GET['longitude2'] )) ? $_GET['longitude2']  : '' ;
$latitude2 = (isset($_GET['latitude2'] )) ? $_GET['latitude2']  : '' ;
$search2 = (isset($_GET['search2'] )) ? $_GET['search2']  : '' ;


$property_type = (isset($_GET['property_type'] )) ? $_GET['property_type']  : '' ;

?>
<div class="container property">
    <div class="row my-4">
      <div class="col-lg-4 col-md-12 ">
        <div class="row my-4">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="f25 f300 color-gray">
              <i class="fa fa-minus color-orange" aria-hidden="true"></i> Property search
            </div>
            <form id="mainSearch_form" name="myForm" action="{{url('agent/advance_search')}}" method="get">
            @csrf
              <div class="form-group">
                <input name="latitude"  id="latitude" type="hidden" value="{{ $latitude }}">   
                <input name="longitude"  id="longitude" type="hidden" value="{{ $longitude }}">
                <input id="autocomplete" name="search" value="{{ $city_prefil }}" class="form-control autocomplete" placeholder="Enter your address" type="text"/>
              </div>
              <div class="form-group">
                <input name="latitude1"  id="latitude1" type="hidden" value="{{ $latitude1 }}">   
                <input name="longitude1"  id="longitude1" type="hidden" value="{{ $longitude1 }}">
                <input id="autocomplete1" name="search1"  class="form-control autocomplete" value="{{ old('search1',$search1) }}" placeholder="Enter your address" type="text"/>
              </div>
              <div class="form-group">
                <input name="latitude2"  id="latitude2" type="hidden" value="{{ $latitude2 }}">   
                <input name="longitude2"  id="longitude2" type="hidden" value="{{ $longitude2 }}">
                <input id="autocomplete2" name="search2"  class="form-control autocomplete" value="{{ old('search2',$search2)}}" placeholder="Enter your address" type="text"/>
              </div>
             <!--  <div class="form-group">
                <input type="text" class="form-control" placeholder="From">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="When">
              </div> -->
              <div class="form-group">
                <select name="property_type" class="form-control color-gray">
                  <option value="">Property Type</option>
                  <option value="residential" <?php if($property_type == 'residential') echo "checked"; ?>>Residential</option>
                  <option value="commercial" <?php if($property_type == 'commercial') echo "checked"; ?>>Commercial</option>
                  <option value="industrial" <?php if($property_type == 'industrial') echo "checked"; ?>>Industrial</option>
                  <option value="land" <?php if($property_type == 'land') echo "checked"; ?>>Land</option>
                </select>
              </div>
              <div class="form-group">
                <select name="purpose" class="form-control color-gray">
                  <option value="">Purpose</option>
                  <option value="buy">Buy</option>
                  <option value="rent">Rent</option>
                  <!-- <option value="lease">Lease</option> -->
                </select>
              </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="number" name="min_price" id="min_price" class="form-control" value="{{ old('min_price',$min_price)}}" placeholder="Min Price">
              </div>
            </div>
            <div class="col-md-6">  
               <div class="form-group">
                <input type="number" name="max_price" id="max_price" class="form-control" value="{{ old('max_price',$max_price)}}" placeholder="Max Price">
              </div>
            </div>
            <div class="col-md-6">  
              <div class="form-group">
                <input type="number" name="min_bathroom" class="form-control" value="{{ old('min_bathroom',$min_bathroom)}}" placeholder="Min bathroom">
              </div>
            </div>
            <div class="col-md-6">  
               <div class="form-group">
                <input type="number" name="max_bathroom" class="form-control" value="{{ old('max_bathroom',$max_bathroom)}}" placeholder="Max bathroom">
              </div>
            </div>
            <div class="col-md-6">  
              <div class="form-group">
                <input type="number" name="min_room" class="form-control" value="{{old('min_room',$min_room)}}" placeholder="Min Room">
              </div>
            </div>
            <div class="col-md-6">  
               <div class="form-group">
                <input type="number" name="max_room" class="form-control" value="{{ old('max_room',$max_room)}}" placeholder="Max Room">
              </div>
            </div>
            <div class="col-md-12">  
               <div class="form-group">
                <input type="number" name="zipcode" class="form-control" value="{{ old('zipcode',$zipcode)}}" placeholder="Zipcode">
              </div>
            </div> 
          </div>    
              <div class="form-group">
                                <div class="label"><span class="text-bold">1031 Exchange Property</span> 
                                    
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="exchange" value="yes" <?php if($exchange =='yes') echo "checked"; ?>>Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="exchange" value="no" <?php if($exchange == 'no') echo "checked"; ?>>No
                                    </label>
                                </div>
                                @if ($errors->has('exchange'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('exchange') }} </strong>
                                    </span>
                                @endif
              </div>
              <div class="form-group">
                                <div class="label"><span class="text-bold">All Cash </span>
                                    
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="all_cash" value="yes" <?php if($all_cash == 'yes') echo "checked"; ?>>Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="all_cash" value="no" <?php if($all_cash == 'no') echo "checked"; ?>>No
                                    </label>
                                </div>
                                @if ($errors->has('all_cash'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('all_cash') }} </strong>
                                        </span>
                                    @endif
              </div>
              <div class="form-group">
                                <div class="label"><span class="text-bold">Purpose </span> 
                                   @if ($errors->has('purpose'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('purpose') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose1" class="" value="whisper_listing" <?php if($purpose1 == 'whisper_listing') echo "checked"; ?>>Whisper Listing
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose1" class="" value="active_listing" <?php if($purpose1 == 'active_listing') echo "checked"; ?>>Active Listing
                                    </label>
                                </div>
              </div>
              <div class="row">
                <!-- <div class="col-md-6">
                  <button class="btn btn-orange btn-block">More !</button>
                </div> -->
                <div class="col-md-12">
                  <button id="advance_search_button_property" class="btn btn-orange btn-block">Search</button>
              

                  <!-- <input type="submit" name="button" class="btn bc-orange btn-block"> -->
                </div>
              </div>
            </form>
            <form name="search_save" action="{{ url('save/my/search')}}" method="post" style="margin-top: 1%;">
              @csrf
            <button type="button" class="btn btn-orange btn-block" data-toggle="modal" data-target="#savesearch">Save</button>
                  <!-- Modal save search -->
                          <div class="modal fade" id="savesearch" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <div class="row">
                                    <div class="col-12">
                                    <h3>Save</h3>
                                    </div>
                                    </div>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>
                                <div class="modal-body">
                                <div class="row form-group">
                                   <div class="col-12">
                                      <input type="text" class="form-control" name="title" placeholder="Title" required="">
                                      <input type="hidden" name="search_type" value="property">
                                      <input type="hidden" name="url" value="<?php echo url()->full(); ?>">
                                   </div>
                                   <div class="col-5" style="margin-top: 3%;">
                                       <button class="btn btn-orange btn-block">Save</button>
                                   </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                              
                            </div>
                          </div>
              
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-12">
         <div class="row">
          <div class="col-lg-12 col-md-12 f30 f300">
           @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
          @endif
          <div class="note"><p style="font-size: 22px;"> Property <span style="color: #41ac1b"> Search </span> List  </p>
          </div>
          </div>
        </div>

        <hr class="btn-orange">
        <div>
        @if(isset($property_list))
            @if(count($property_list))
                @foreach($property_list as $key => $property)
                  <div class="p-1 ">
                        <!-- this section for List Views -->
                        <div class="row bg-color color-gray p-3">
                          <!-- <div class="col-md-4 col-sm-6 ">
                            <a class="color-gray f15 float-center"> <img class="mb-1"
                                src="http://13.238.209.80/web/Images/6adc5ab1-d249-40aa-80eb-49b7e3dcf1b0.jpg" width="100%" alt="property_image"> 
                            </a>
                          </div> -->
                          <div class="col-md-12 col-sm-12 mb-1">
                            <div class="f25">
                              <sapn class="color-gray f15 float-center">{{$property->title}}
                              </span>
                            </div>
                            <div class="f18 f700"> 
                                {{ number_format($property->price,2) }}$
                                <span class="color-orange"></span>
                                <span class="f13 color-orange f300"></span>
                            </div>
                            <div class="f13 color-gray">
                                 <i class="fa fa-map-marker color-orange  " aria-hidden="true"></i>
                                  {{ $property->city_name}}
                            </div>


                            <div class="row f14 f300">
                              <div class="col-md-4 "><i class="fa fa-area-chart color-orange " aria-hidden="true"></i>
                               {{ $property->size}}
                               </div>
                              <div class="col-md-4"> <i class="fa fa-bed color-orange" aria-hidden="true"></i> 
                                    {{ $property->rooms}}
                              </div>
                              <div class="col-md-4"><i class="fa fa-exchange color-orange" aria-hidden="true"></i>
                               {{  ucfirst($property->exchange)}}
                                </div>
                            </div>
                            <div class="f13 color-gray"><span *ngFor="let item of HouseFacilities"> </span></div>
                            <div class="row btn-orange f14">
                              <div class="col-md-4 col-6 col-sm-6 py-1">
                                <div> <i class="fas fa-chalkboard f25"></i><span class="f2"> {{ $property->property_type}} </span></div>
                              </div>
                              <div class="col-md-4 col-6 col-sm-6 py-1">
                                <div> <i class="fa fa-bath f25" aria-hidden="true"></i>  {{ $property->bathroom}} </div>
                              </div>

                              <div class="col-md-1" style="clip-path: polygon(100% 0, 0 100%, 100% 100%); background: #0f2b61;">
                              </div>

                              <div class="col-md-3 col-12 col-sm-12  py-1" style="background: #202020; text-align: center;">
                                <a href="{{ url('property/detail/pub/'.$property->id)}}" class="color-white f15 float-center"> More Details
                                </a></div>
                            </div>
                          </div>
                        </div>
                  </div>
                @endforeach
                <div class="row" style="justify-content: center; margin-top: 2%;">

                  <ul class="pagination">
                      <!-- LINK FIRST AND PREV -->
                      <?php
                      // $limit = 2 ; // Amount of data per page  
          
                      // To determine what data will be displayed in the table in the database
                      $limit_start = ( $page - 1 ) * $limit ;    
                      if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
                      ?>
                        <li class="disabled active"><a class="btn mx-1 setsecrol" href="#">First</a></li>
                        <li class="disabled"><a class="btn btn-InActive mx-1 setsecrol" href="#">&laquo;</a></li>
                      <?php
                      }else{ // Jika page bukan page ke 1
                        $link_prev = ($page > 1)? $page - 1 : 1;
                      ?>
                        <li><a class="btn btn-InActive mx-1 setsecrol" href="<?php echo url()->full(); ?>&pageno=1">First</a></li>
                        <li><a class="btn btn-InActive mx-1 setsecrol" href="<?php echo url()->full(); ?>&pageno=<?php echo $link_prev; ?>">&laquo;</a></li>
                      <?php
                      }
                      ?>
                      
                      <!-- LINK NUMBER -->
                      <?php
                      $jumlah_page = $total_pages; // Hitung jumlah halamannya
                      $jumlah_number = 1; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
                      
                      for($i = $start_number; $i <= $end_number; $i++){
                        $link_active = ($page == $i)? ' class="active"' : '';
                        $btn_active = ($page == $i)? '' : 'btn-InActive';
                      ?>
                        <li<?php echo $link_active; ?>><a class="btn mx-1 <?php echo $btn_active; ?> setsecrol" href="<?php echo url()->full(); ?>&pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                      <?php
                      }
                      ?>
                      
                      <!-- LINK NEXT AND LAST -->
                      <?php
                      // Jika page sama dengan jumlah page, maka disable link NEXT nya
                      // Artinya page tersebut adalah page terakhir 
                      if($page == $jumlah_page){ // Jika page terakhir
                      ?>
                        <li class="disabled"><a class="btn btn-InActive mx-1 setsecrol" href="#">&raquo;</a></li>
                        <li class="disabled active"><a class="btn mx-1 setsecrol" href="#">Last</a></li>
                      <?php
                      }else{ // Jika Bukan page terakhir
                        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                      ?>
                        <li><a class="btn btn-InActive mx-1 setsecrol" href="<?php echo url()->full(); ?>&pageno=<?php echo $link_next; ?>">&raquo;</a></li>
                        <li><a class="btn btn-InActive mx-1 setsecrol" href="<?php echo url()->full(); ?>&pageno=<?php echo $jumlah_page; ?>">Last</a></li>
                      <?php
                      }
                      ?>
                  </ul>
                </div>
            @else
                No property found here !
            @endif
         @else
            No property found here !
         @endif   
        </div>
      </div>
      
    </div>
</div>  
@endsection

@section('scripts')
<script>
var placeSearch, autocomplete, autocomplete1, autocomplete2;

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component', 'geometry']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  var lat = place.geometry.location.lat();
  var lng = place.geometry.location.lng();
  console.log(place.geometry.location.lat());

  document.getElementById("latitude").value = lat;
  document.getElementById("longitude").value = lng;
}

$(document).ready(function()
{
   initAutocomplete1();
   initAutocomplete2();
});
function initAutocomplete1() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete1 = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete1'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete1.setFields(['address_component', 'geometry']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete1.addListener('place_changed', fillInAddress1);
}
function fillInAddress1() {
  // Get the place details from the autocomplete object.
  var place_1 = autocomplete1.getPlace();
  var lat_1 = place_1.geometry.location.lat();
  var lng_1 = place_1.geometry.location.lng();
  console.log(place_1.geometry.location.lat());

  document.getElementById("latitude1").value = lat_1;
  document.getElementById("longitude1").value = lng_1;
}

function initAutocomplete2() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete2 = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete2'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete2.setFields(['address_component', 'geometry']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete2.addListener('place_changed', fillInAddress2);
}
function fillInAddress2() {
  // Get the place details from the autocomplete object.
  var place_2 = autocomplete2.getPlace();
  var lat_2 = place_2.geometry.location.lat();
  var lng_2 = place_2.geometry.location.lng();
  console.log(place_2.geometry.location.lat());

  document.getElementById("latitude2").value = lat_2;
  document.getElementById("longitude2").value = lng_2;
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
    </script>
    
@endsection