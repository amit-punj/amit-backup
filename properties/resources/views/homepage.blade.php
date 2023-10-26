@extends('layouts.main')
@section('content')
<style type="text/css">
 .abcd{

    font-size: 13px;
  }
   .search-bar{
    color: white; background-color: #0e2a60; display: flex; min-height: 100px;
  }
@media screen and (max-width: 823px){
 
}
@media screen and (max-width: 770px){
  .search-bar{
  display: unset;
  padding: 20px;
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

</style>
 <div id="demo" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
<!--       <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul> -->

        <!-- The slideshow -->
        <div class="carousel-inner">
         <!--    @if(count($sliders))
                @foreach($sliders as $key=>$slider) -->
                    <div class="carousel-item <?php if($key == 0) echo 'active'; ?>" style="background-image: url('images/slider/{{$sliders[0]->slider_image}}');" >
                       <div class="container">
                       <div class="sliderone-text">AgentsConnect was created for Real Estate Agents</div>
                       </div>
                        <?php if(isset(Auth::user()->role) && Auth::user()->role != 0){ 
                            if(Auth::user()->role == 3)
                            {
                          ?>
                            <div class="text2">
                                to list and search for <span style="color: #37a745;">Buyers</span> and Pocket Listings
                            </div>
                            <div class="text2">
                                from other Real Estate Agents to generate new leads.
                            </div>
                              <div class="container">
                                <form id="homepage_mainSearch_form" action="{{url('agent/search_req')}}" method="get">
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
                                                <input name="latitude"  id="latitude" type="hidden">   
                                                <input name="longitude"  id="longitude" type="hidden">
                                                <input id="autocomplete" name="search" class="form-control autocomplete" placeholder="Enter address for Search" type="text"/>
                                              </div>
                                              <div class="col-md-4 col-sm-12 col-xs-12 margintop">
                                                <input type="submit" id="mainSearch" name="button" class="btn btn-success form-control search_">
                                              </div>
                                         </div>
                                     <div class="col-sm-1"></div>
                                  </div>
                                </form>
                              </div>
                        <?php 
                            }
                      }
                          else{
                         ?>
                       <div class="text2">
                            to list and search for <span style="color: #37a745;">Buyers</span> and Pocket Listings
                        </div>
                        <div class="text2">
                            from other Real Estate Agents to generate new leads.
                        </div>
                        <?php } ?>
                    </div>
             <!--    @endforeach
            @endif -->
        </div>
      
        <!-- Left and right controls -->
         <!--  <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a> -->
</div> 
    <!-- end of slider -->
<div class="container">
      <div class="video">
         <div class="responsive embed-responsive-4by3 text-center" controls>
             <!--  <iframe  class="iframevideo" src="{{ asset('video/'.$site_video[0]->site_video) }}" ></iframe> -->
             <img src="{{asset('images/default/maxresdefault.jpg')}}"  style="width: 80%;">
         </div>
      </div>
</div>
<!-- <div class="container">
  <h4 class="text-center " style="margin-top: 9%;">TESTIMONIALS</h4>
  <div class="row" style="margin-top: 3%;">
        @if(count($testimonials))
            @foreach($testimonials as $testimonial)
                <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                    <div class="img">
                        <img src="{{ asset('images/testimonial/'.$testimonial->image) }}" style="border-radius: 50%;" height="100" width="100">
                    </div>
                    <h5>{{$testimonial->name}}</h5><p style="color: darkgray;">{{$testimonial->designation}} </p>
                    <hr style="width: 25%;">
                    <p style="font-size: 14px; color: darkgray;">{{$testimonial->testimonial}}</p>
                </div>
            @endforeach
        @endif
  </div>
</div> -->
@endsection
@section('scripts')
<script type="text/javascript">
// $('.autoplay').slick({
//   slidesToShow: 5,
//   slidesToScroll: 1,
//   autoplay: true,
//   autoplaySpeed: 2000,
// });
   
</script>
<script>
var placeSearch, autocomplete;

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

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
    </script>
   <!--  <script type="text/javascript">
  $(document).on('click','.search_',function(e){
        e.preventDefault;
        var validSearch = localStorage.getItem('search');
        var lat =  $("#latitude").val();
        var lng =  $("#longitude").val();
        console.log(lat,lng);
        if (lat != '' && lng != '') {
          jQuery('#mainSearch').submit();
        }else{
          alert('Please select dropdown address');
          // $('#search_eroor').text('Please select dropdown address');
          // $("#mainSearch").prop('disabled', true);
          return false;
        }
    });
</script> -->
@endsection