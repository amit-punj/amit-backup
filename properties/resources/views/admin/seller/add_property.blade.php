@extends('admin.layouts.app')
@section('content')

<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB --> 


<div class="page-content-wrap">
<div class="clearfix"></div>
<!-- START WIDGETS -->                    
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Add Property</div>
            <div class="panel-body">
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
            <form id="form_submit" action="{{url('admin/add/property')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username" class="col-md-2 required">Title</label>
                    <div class="col-md-10">
                        <input type="text" name="title"  maxlength="20" class="form-control" value="{{ old('title') }}" placeholder="Title"/>
                        @if ($errors->has('title'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-2 required">Address</label>
                    <div class="col-md-10">
                        <input type="text" name="address" class="form-control" value="{{ old('title') }}" placeholder="Address"/>
                        @if ($errors->has('address'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="cross_streets" class="col-md-2">Cross streets</label>
                    <div class="col-md-10">
                        <input type="text" name="cross_streets" class="form-control"  placeholder="Cross streets" value="{{ old('email') }}" />
                        @if ($errors->has('cross_streets'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('cross_streets') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="flname" class="col-md-2">Price $</label>
                    <div class="col-md-10">
                        <input type="text" name="price" id="price" value="{{old('price')}}"  class="form-control" style="" placeholder="PRICE USD $" required> 
                        @if ($errors->has('price'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="property_type" class="col-md-2 required">Property Type</label>
                    <div class="col-md-10">
                        <div style="margin-right: 2%; display: -webkit-box;">
                            <input type="radio" name="property_type" value="residential" checked="">Residential 
        					 <div style="margin-left: 2%; margin-right: 2%;"> 
                                <input type="radio" name="property_type" value="commercial">Commercial
                             </div>
        					<input type="radio" name="property_type" value="industrial">Industrial
    					    <div style="margin-left: 2%;">
                                <input type="radio" name="property_type" value="land">Land
                            </div>
                        </div>
                         @if ($errors->has('property_type'))
                                <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('property_type') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="purpose" class="col-md-2 required">Purpose</label>
                    <div class="col-md-10">
                        <div style="margin-right: 2%; display: -webkit-box;">
                          <input type="radio" name="purpose" value="whisper_listing" checked="">Whisper Listing 
                         <div style="margin-left: 2%; margin-right: 2%;">
                         <input type="radio" name="purpose" value="active_listing">Active Listing</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-md-2 required">Type</label>
                    <div class="col-md-10">
                        <div style="margin-right: 2%; display: -webkit-box;">
                          <input type="radio" name="type" value="sell" checked="">sell 
    					 <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="type" value="rent">Rent</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exchange" class="col-md-2 required">1031 Exchange Property</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="exchange" value="yes">Yes 
					 <div style="margin-left: 2%; margin-right: 2%;">
                     <input type="radio" name="exchange" value="no" checked="">No</div>
					 
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="all_cash" class="col-md-2 required">All Cash</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="all_cash" value="yes">Yes 
					 <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="all_cash" checked="" value="no">No</div>
					 
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <label for="bedroom" class="col-md-2">Bedrooms:</label>
                    <div class="col-md-10">
                        <input type="number" name="rooms" min="1" max="50" value="{{old('bedroom')}}" class="form-control"  placeholder="Number of Bedrooms"/>
                        @if ($errors->has('bedroom'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('bedroom') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="bathroom" class="col-md-2">Bathrooms:</label>
                    <div class="col-md-10">
                        <input type="number" min="1" max="50" name="bathroom" value="{{old('bedroom')}}" class="form-control"  placeholder="Number of Bathrooms"/>
                        @if ($errors->has('bedroom'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('bedroom') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="half_bathroom" class="col-md-2">Half Bathrooms:</label>
                    <div class="col-md-10">
                        <input type="number" min="1" max="20" name="half_bathroom" value="{{old('half_bathroom')}}" class="form-control"  placeholder="Number of Half Bathrooms"/>
                        @if ($errors->has('half_bathroom'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('half_bathroom') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="monthly_maintenance" class="col-md-2">Monthly Maintenance/Common Charges $:</label>
                    <div class="col-md-10">
                        <input type="number" min="1" name="monthly_maintenance" value="{{old('monthly_maintenance')}}" class="form-control"  placeholder="Monthly Maintenance/Common Charges"/>
                        @if ($errors->has('monthly_maintenance'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('monthly_maintenance') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                 <div class="form-group">
                    <label for="monthly_tax" class="col-md-2">Monthly Taxes $:</label>
                    <div class="col-md-10">
                        <input type="number" min="1" name="monthly_tax" value="{{old('monthly_tax')}}" class="form-control"  placeholder="Monthly Taxes"/>
                        @if ($errors->has('monthly_tax'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('monthly_tax') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                	<div class="form-group row">
                            <label for="size" class="col-md-2">Size(sqmt)</label>
                         <div class="col-md-10">
                          <input type="number" name="size" value="{{old('size')}}" class="form-control" step="10"  placeholder="Size in sq-mt"/>
                            @if ($errors->has('size'))
                                <span class="help-block" style="color: red;">
                                <strong> {{ $errors->first('size') }} </strong>
                                 </span>
                            @endif
                         </div> 
                          </div> 
                          <div class="form-group row">
                            <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">  Apartment amenities : </p>
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
					<div class="form-group">
                    <label for="location" class="col-md-2 required">City</label>
                     <input name="latitude"  id="latitude" type="hidden">   
                      <input name="longitude"  id="longitude" type="hidden">
                    <div class="col-md-10">
                        <input id="autocomplete" type="text" name="city_name" class="form-control" value="{{ old('city_name') }}" placeholder="City Name"/>
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
                        <input type="text" name="local_area" class="form-control" value="{{ old('local_area') }}" placeholder="local Area"/>
                        @if ($errors->has('local_area'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('local_area') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="location" class="col-md-2 required">Zipcode</label>
                    <div class="col-md-10">
                        <input type="text" name="zipcode" class="form-control" value="{{ old('zipcode') }}" placeholder="Zipcode"/>
                        @if ($errors->has('zipcode'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('zipcode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="location" class="col-md-2 required">Status</label>
                    <div class="col-md-10">
                        <select class="form-control" name="status">
                                        <option  value="active">Active</option>
                                        <option  value="passive">Passive</option>
                                        <option  value="off the market">Off the market</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('status') }} </strong>
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
                <!--  <div class="form-group">
                    <label class="col-md-2">Display Picture</label>
                    <div class="col-md-10">
                        <input type="file" name="cover_pic" id="profile_pic" class="form-control">
                        @if ($errors->has('profile_image'))
                            <span class="help-inline" style="color: red;">
                                <strong>{{ $errors->first('profile_pic') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> -->
                 <div class="form-group">
                    <label for="location" class="col-md-2 required">User</label>
                    <div class="col-md-10">
                        <select class="form-control" name="userid" onChange="getsta(this.value);">
                          <option value="">Select User</option>
                          @if(isset($users))
                           @foreach($users as $user)
                                <option class="getclient" value="{{ $user->id }}">{{ $user->fname}} @if(isset($users->lname))@endif</option>
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
                            <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Exposures : </p>
                        <div class="form-check form-check-inline col-md-2 col-2">
                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="east">
                        <label class="form-check-label">East</label>
                        </div>
                        <div class="form-check form-check-inline col-md-2 col-2">
                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="west">
                        <label class="form-check-label">West</label>
                        </div>
                        <div class="form-check form-check-inline col-md-2 col-2">
                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="south">
                        <label class="form-check-label">South</label>
                        </div>
                        <div class="form-check form-check-inline col-md-2 col-2">
                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="north">
                        <label class="form-check-label">North</label>
                        </div>
                          @if ($errors->has('exposures'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('exposures') }}</strong>
                            </span>
                        @endif
                       </div>
                       </div>
                       </div> 
               
                </form>

                <div class="form-group row" style="margin-top: 5%;">
                 <label class="col-md-2">Gellary Images</label>
                  <div class="col-md-10">
                <form action="{{url('file-upload')}}"
				      class="dropzone" name="file"
				      id="my-awesome-dropzone">
				      @csrf </form>
				      </div>
				    </div>

                    <div class="form-group" style="display: flex;">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block" id="btnsub">Add Property</button>
                    </div>
                     <div class="col-md-offset-2 col-md-5">
                        <a href="#" style="margin-left: -53%; background-color: black !important;" class="btn btn-info btn-block">Cancel</a>
                    </div>
                </div>
         
        </div>
        </div>
    </div>
</div>
<!-- END WIDGETS -->                    
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btnsub").click(function(){
            $("#form_submit").submit();
        });
    });
    jQuery(".dropzone").dropzone({
            contentType: "application/json",
            dataType: "json",
            acceptedFiles: 'image/*',
            success : function(file, response) {
               // console.log(file);
               console.log(response);
               debugger;
           }
       });
</script>
 <script src="{{ url('/js/maskMoney.js') }}"></script>
<script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.user_id').select2();
    });
</script>
 <script>
$('#price').maskMoney();
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
        $("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
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
