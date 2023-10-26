@extends('admin.layouts.app')
@section('content')
<head>

<style>
.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 15px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  background: #4CAF50;
  cursor: pointer;
}
</style>
</head>
<div class="page-content-wrap">
<div class="clearfix"></div>
<!-- START WIDGETS -->                    
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Add New Requirement</div>
            @if(Session::has('flash_message_success'))
			<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{!! session('flash_message_success') !!}</strong>
			</div>
		@endif
            <div class="panel-body">

            <form id="form_submit" action="{{url('store/requirement/admin')}}" class="form-horizontal" method="post" >
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="username" class="col-md-2 required">Title</label>
                    <div class="col-md-10">
                        <input type="text" name="title" maxlength="20" class="form-control" value="{{ old('title') }}" placeholder="Title"/>
                         @if ($errors->has('title'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                  <div class="form-group">
                    <label for="min_price" class="col-md-2">Minimum price $</label>
                    <div class="col-md-3">
                        <input type="text" name="min_price" id="min_price" value="{{old('min_price')}}"  class="form-control" style="" placeholder="Min Price" required> 
                        @if ($errors->has('min_price'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('min_price') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                     <label for="max_price" class="col-md-2" style="margin-left: 5%;">Maximum price $</label>
                    <div class="col-md-3">
                        <input type="text" name="max_price" id="max_price" value="{{old('max_price')}}"  class="form-control" style="" placeholder="Maximum Price" required> 
                        @if ($errors->has('max_price'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('max_price') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                </div>
               
                 <div class="form-group">
                    <label for="property_type" class="col-md-2 required">Property Type</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="property_type" checked="" value="residential">Residential 
					 <div style="margin-left: 2%; margin-right: 2%;"> <input type="radio" name="property_type" value="commercial">Commercial</div>
					  <input type="radio" name="property_type" value="industrial">Industrial
					  <div style="margin-left: 2%;"><input type="radio" name="property_type" value="land">Land</div>
                    </div>
                     @if ($errors->has('property_type'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('property_type') }}</strong>
                            </span>
                        @endif
                </div>
                </div>
                  <div class="form-group">
                    <label for="purpose" class="col-md-2 required">Type</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="purpose" checked="" value="buy">Buy 
					 <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="purpose" value="rent">Rent</div>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="exchange" class="col-md-2 required">1031 exchange property</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="exchange" value="yes">Yes 
					 <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="exchange" value="no" checked="">No</div>
					 
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="exchange" class="col-md-2 required">Pre Approved</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="pre_approved" value="yes">Yes 
           <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="pre_approved" value="no" checked="">No</div>
           
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="exchange" class="col-md-2 required">Investment buyer</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="investment_buyer" value="yes">Yes 
           <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="investment_buyer" value="no" checked="">No</div>
           
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="all_cash" class="col-md-2 required">All Cash</label>
                    <div class="col-md-10">
                        <div style="margin-right: 2%; display: -webkit-box;">
                          <input type="radio" name="all_cash" value="yes">Yes 
					                 <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" checked="" name="all_cash" value="no">No</div>
    					 
                            </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="min_room" class="col-md-2">Minimum Rooms</label>
                    <div class="col-md-3">
                        <input  type="text" name="min_room" id="min_room" value="{{old('min_room')}}"  class="form-control" style="" placeholder="Min Rooms" required> 
                        @if ($errors->has('min_room'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('min_room') }}</strong>
                            </span>
                        @endif
                    </div>
                     <div class="form-group">
                     <label for="max_room" class="col-md-2" style="margin-left: 5%;">Maximum Rooms</label>
                    <div class="col-md-3">
                        <input type="text" name="max_room" id="max_room" value="{{old('max_room')}}"  class="form-control" style="" placeholder="Maximum Rooms" required> 
                        @if ($errors->has('max_room'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('max_room') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="min_bathroom" class="col-md-2">Minimum Bath_Rooms</label>
                    <div class="col-md-3">
                        <input type="text" name="min_bathroom" id="min_bathroom" value="{{old('min_bathroom')}}"  class="form-control" style="" placeholder="Min bathrooms" required> 
                        @if ($errors->has('min_bathroom'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('min_bathroom') }}</strong>
                            </span>
                        @endif
                    </div>
                     <div class="form-group">
                     <label for="max_room" class="col-md-2" style="margin-left: 5%;">Maximum Bath_Rooms</label>
                    <div class="col-md-3">
                        <input type="text" name="max_bathroom" id="max_bathroom" value="{{old('max_bathroom')}}"  class="form-control" style="" placeholder="Maximum bathrooms" required> 
                        @if ($errors->has('max_bathroom'))
                            <span class="help-block" style="color: red;">max_bathroom
                                <strong>{{ $errors->first('max_bathroom') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="location" class="col-md-2 required">User</label>
                    <div class="col-md-10">
                        <select class="form-control" name="userid" onChange="getsta(this.value);">
                          <option value="">Select User</option>
                          @if(isset($user))
                           @foreach($user as $users)
                                <option class="getclient" value="{{ $users->id }}">{{ $users->fname}} @if(isset($users->lname))@endif</option>
                           @endforeach
                          @endif
                        </select>
                          @if ($errors->has('user_id'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                  <label for="location" class="col-md-2 required">client</label>
                  <div class="col-md-10">
                  <select name="client_id" class="form-control" id="clients">

                  </select>
                  </div>
                </div>
                <div class="form-group row">
                 <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Amenities/Facilities available : </p>
                             @foreach ($amenities as $key => $value)
                <div class="form-check form-check-inline col-md-4 col-6">
                <input class="form-check-input" name="amenities[]" type="checkbox"  value="{{$value->id}}">
                <label class="form-check-label">{{$value->amenities_name}}</label>
                </div>
                @endforeach
					      @if ($errors->has('amenities'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('amenities') }}</strong>
                            </span>
                        @endif
					   </div>
					   </div>
					   </div>
             <div class="form-group row">
                            <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Building features : </p>
                             @foreach ($building_features as  $value1)
                        <div class="form-check form-check-inline col-md-4 col-6">
                        <input class="form-check-input" name="building_features[]" type="checkbox"  value="{{$value1->id}}">
                        <label class="form-check-label">{{$value1->feature_name}}</label>
                        </div>
                    @endforeach
                          @if ($errors->has('building_features'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('building_features') }}</strong>
                            </span>
                        @endif
                       </div>
                       </div>
                       </div> 
					   <h3>Location</h3>
					      <div class="form-group">
                    <label for="location" class="col-md-2 required">City</label>
                      <input name="latitude"  id="latitude" type="hidden">   
                      <input name="longitude"  id="longitude" type="hidden">
                    <div class="col-md-10">
                        <!-- <input type="text" name="city_name" class="form-control" value="{{ old('city_name') }}" placeholder="City Name"/> -->
                        <input id="autocomplete" name="city_name" class="form-control" placeholder="City Name"
                                     type="text"/>
                          @if ($errors->has('city_name'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('city_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="location" class="col-md-2 required">Neighborhood</label>
                    <div class="col-md-10">
                        <input type="text" name="local_area" id="local_area" class="form-control" value="{{ old('local_area') }}" placeholder="Neighborhood"/>
                        @if ($errors->has('local_area'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('local_area') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
					   <div class="form-group">
			      <label for="comment" class="col-md-2">Description:</label>
			      <div class="col-md-10">
			      <textarea class="form-control" rows="5" name="discription" placeholder="write about your dream property">{{ old('discription') }}</textarea>
			      </div>
            </div>
            <div class="form-group">
               <label for="comment" class="col-md-2">Status</label>
               <div class="col-md-10">
                  <select class="form-control" name="status" required="">
                      <option value="active">Active</option>
                      <option value="passive">Passive</option>
                      <option value="off the market">Off the market</option>
                  </select>
               </div>
            </div>
                       <div class="form-group" style="display: flex;">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block search_" id="craete_idValid">Add Requirement</button>
                    </div>
                     <div class="col-md-offset-2 col-md-5">
                        <a href="#" style="margin-left: -53%; background-color: black !important;" class="btn btn-info btn-block">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
 <script src="{{ url('/js/maskMoney.js') }}"></script>
<script>

$('#min_price').maskMoney();
$('#max_price').maskMoney();
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
  
  document.getElementById("latitude").value = lat;
  document.getElementById("longitude").value = lng;
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
  </script>
  <script type="text/javascript">
  $(document).on('click','.search_',function(e){
        e.preventDefault;
        var validSearch = localStorage.getItem('search');
        var lat =  $("#latitude").val();
        var lng =  $("#longitude").val();
        console.log(lat,lng);
        if (lat != '' && lng != '') {
            $("#form_submit").submit();
        }else{
          alert('Please Select city from dropdown');
          // $('#search_eroor').text('Please select dropdown address');
          // $("#mainSearch").prop('disabled', true);
          return false;
        }
    });
</script>
<script type="text/javascript">
 function getsta(val) {
  $.ajax({
  type: "POST",
  url: "{{ url('user/getclient')}}",
  data:{
        "_token": "{{ csrf_token() }}",
        'userid':val,
      },
  success: function(data){
    console.log(data.client);
      var html = "";
      if(data.client !=""){
        html +='<option value="">Select Client</option>';
      $.each(data.client, function(k, v) {
        html +='<option value="'+v.id+'">'+v.fname+'</option>';
      });
      console.log(html);
         $('#clients').html(html);
       }
       else{
        html +='<option value="">No client</option>';
        $('#clients').html(html);
       }
    }
  });
}
</script>
@endsection

