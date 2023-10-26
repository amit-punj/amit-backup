@extends('admin.layouts.app')
@section('content')
<style type="text/css">
    .help-block{
        color: red;
    }
    .delete {
    background: transparent;
    border-style: unset;
    color: red;
    display: none;
    position: absolute;
    margin-top: 24%;
    margin-left: 24%;
}
.title:hover .delete {
   display:block
}
</style>
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
            <div class="panel-heading">Update Property</div>
            <div class="panel-body">
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
            @if(Session::has('flash_message_update'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_update') !!}</strong>
            </div>
            @endif
            
            
            <form id="form_submit" action='{{url("admin/property/{$property_details->id}/update")}}' class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username" class="col-md-2 required">Title</label>
                    <div class="col-md-10">
                        <input type="text" name="title"  maxlength="20" class="form-control" value="{{ $property_details->title }}" placeholder="Title"/>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-md-2 required">Address</label>
                    <div class="col-md-10">
                        <input type="text" name="address" class="form-control" value="{{ $property_details->address }}" placeholder="Address"/>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                 <div class="form-group">
                    <label for="cross_streets" class="col-md-2">Cross streets</label>
                    <div class="col-md-10">
                        <input type="text" name="cross_streets" class="form-control"  placeholder="Cross streets" value="{{ "$property_details->cross_streets" }}" />
                        @if ($errors->has('cross_streets'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cross_streets') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="flname" class="col-md-2">Price $</label>
                    <div class="col-md-10">
                        <input type="number" id="price" name="price" placeholder="Price" value="{{$property_details->price}}"  class="form-control" style="" required> 
                        @if ($errors->has('price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

              <div class="form-group">
                    <label for="property_type" class="col-md-2 required">Property Type</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                    <input type="radio" name="property_type" <?php if($property_details->property_type == 'residential') echo "checked"; ?> value="residential">Residential 
					 <div style="margin-left: 2%; margin-right: 2%;"> <input type="radio" name="property_type" value="commercial" <?php if($property_details->property_type == 'commercial') echo "checked"; ?>>Commercial</div>
					<input type="radio" name="property_type" value="industrial" <?php if($property_details->property_type == 'industrial') echo "checked"; ?>>Industrial
					  <div style="margin-left: 2%;"><input type="radio" name="property_type" value="land" <?php if($property_details->property_type == 'land') echo "checked"; ?>>Land</div>
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
                          <input type="radio" name="purpose" value="whisper_listing" <?php if($property_details->purpose == 'whisper_listing') echo "checked"; ?>>Whisper Listing 
                         <div style="margin-left: 2%; margin-right: 2%;">
                         <input type="radio" name="purpose" value="active_listing" <?php if($property_details->purpose == 'active_listing') echo "checked"; ?>>Active Listing</div>
                        </div>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="type" class="col-md-2 required">Type</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="type" value="sell" <?php if($property_details->type == 'sell') echo "checked"; ?>>sell 
					  <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="type" value="rent" <?php if($property_details->type == 'rent') echo "checked"; ?>>Rent</div>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="exchange" class="col-md-2 required">1031 Exchange Property</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="exchange" value="yes" <?php if($property_details->exchange == 'yes') echo "checked"; ?>>Yes 
					 <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="exchange" value="no" <?php if($property_details->exchange == 'no') echo "checked"; ?>>No</div>
					 
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="all_cash" class="col-md-2 required">All Cash</label>
                    <div class="col-md-10">
                    <div style="margin-right: 2%; display: -webkit-box;">
                      <input type="radio" name="all_cash" value="yes" <?php if($property_details->all_cash == 'yes') echo "checked"; ?>>Yes 
					 <div style="margin-left: 2%; margin-right: 2%;"><input type="radio" name="all_cash" value="no" <?php if($property_details->exchange == 'no') echo "checked"; ?>>No</div>
					 
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <label for="bedroom" class="col-md-2">Bedrooms:</label>
                    <div class="col-md-10">
                        <input type="number" name="rooms" value="{{ $property_details->rooms }}" class="form-control"  placeholder="Number of Bedrooms"/>
                        @if ($errors->has('bedroom'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bedroom') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="bathroom" class="col-md-2">Bathrooms:</label>
                    <div class="col-md-10">
                        <input type="number" name="bathroom" value="{{ $property_details->bathroom }}" class="form-control"  placeholder="Number of Bathrooms"/>
                        @if ($errors->has('bathroom'))
                            <span class="help-block">
                                <strong>{{ $errors->first('bathroom') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="half_bathroom" class="col-md-2">Half Bathrooms:</label>
                    <div class="col-md-10">
                        <input type="number" min="1" max="20" name="half_bathroom" value="{{ $property_details->half_bathroom }}" class="form-control"  placeholder="Number of Half Bathrooms"/>
                        @if ($errors->has('half_bathroom'))
                            <span class="help-block">
                                <strong>{{ $errors->first('half_bathroom') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                  <div class="form-group">
                    <label for="monthly_maintenance" class="col-md-2">Monthly maintenance/common charges $:</label>
                    <div class="col-md-10">
                        <input type="number" min="1" max="20" name="monthly_maintenance" value="{{ $property_details->monthly_maintenance }}" class="form-control"  placeholder="Monthly maintenance"/>
                        @if ($errors->has('monthly_maintenance'))
                            <span class="help-block">
                                <strong>{{ $errors->first('monthly_maintenance') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                  <div class="form-group">
                    <label for="monthly_tax" class="col-md-2">Monthly tax $:</label>
                    <div class="col-md-10">
                        <input type="number" min="1" max="20" name="monthly_tax" value="{{ $property_details->monthly_tax }}" class="form-control"  placeholder="Monthly Tax"/>
                        @if ($errors->has('monthly_tax'))
                            <span class="help-block">
                                <strong>{{ $errors->first('monthly_tax') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                	<div class="form-group row">
                            <label for="size" class="col-md-2">Size(sqmt)</label>
                         <div class="col-md-10">
                          <input type="number" name="size" value="{{ $property_details->size }}" class="form-control" step="10"  placeholder="Size in sq-mt"/>
                            @if ($errors->has('size'))
                                <span class="help-block">
                                <strong> {{ $errors->first('size') }} </strong>
                                 </span>
                            @endif
                         </div> 
                        </div> 
                          <div class="form-group row">
                            <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Amenities/Facilities available : </p>
                             <?php  
                              $explode = explode(',', $property_details['amenities']);
                               ?>
                             @foreach ($amenities as $key => $value)
		                <div class="form-check form-check-inline col-md-4 col-6">
		                <input class="form-check-input" name="amenities[]" type="checkbox"  value="{{$value->id}}" <?php if(in_array($value->id, $explode)) echo "checked"; ?>>
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
                            <div class="card-body"><div class="building_features"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Building features : </p>
                             <?php  
                              $explode1 = explode(',', $property_details['building_features']);
                               ?>
                             @foreach ($building_features as  $value1)
                        <div class="form-check form-check-inline col-md-4 col-6">
                        <input class="form-check-input" name="building_features[]" type="checkbox"  value="{{$value1->id}}" <?php if(in_array($value1->id, $explode1)) echo "checked"; ?>>
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
                   
                    <div class="col-md-10">
                    <input name="latitude"  id="latitude" type="hidden" value="{{$property_details->latitude }}">   
                    <input name="longitude"  id="longitude" type="hidden" value="{{$property_details->longitude }}">
                    <input type="text" name="city_name" onkeypress="emptylnglat()" id="autocomplete"  placeholder="" value="{{$property_details->city_name }}" class="form-control" style="">
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
                        <input type="text" name="local_area" class="form-control" value="{{ $property_details->local_area }}" placeholder="local Area"/>
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
                        <input type="text" name="zipcode" class="form-control" value="{{ $property_details->zipcode }}" placeholder="Zipcode"/>
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
                                        <option  value="active" <?php if($property_details->status == 'active') echo "selected";?>>Active</option>
                                        <option  value="passive"  <?php if($property_details->status == 'passive') echo "selected";?>>Passive</option>
                                        <option  value="off the market"  <?php if($property_details->status == 'off the market') echo "selected";?>>Off the market</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('status') }} </strong>
                                        </span>
                                    @endif
                    </div>
                </div>  
					   <div class="form-group">
			      <label for="comment" class="col-md-2">Discription:</label>
			      <div class="col-md-10">
			      <textarea class="form-control" rows="5" name="discription" placeholder="write about your dream property">{{ $property_details->discription }}</textarea>
			      </div>
                     </div>       
                    <div class="form-group">
                        <label class="col-md-2">Select User</label>
                        <div class="col-md-10">
                            @if(count($users))
                            <select class="user_id form-control" name="user_id" id="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" <?php echo ($user->id == $property_details->user_id ) ? "selected" : "" ; ?> >{{$user->name}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>   
                </div>
               <div class="form-group row">
                            <div class="card-body"><div class="exposure"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Exposure : </p>
                             <?php  
                              $explode2 = explode(',', $property_details['exposure']);
                               ?>
                         <div class="form-check form-check-inline col-lg-3 col-md-2">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="east" <?php if(in_array('east', $explode2)) echo "checked"; ?>>
                                                        <label class="form-check-label">East</label>
                        </div>
                                      <div class="form-check form-check-inline col-lg-3 col-md-2">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="west" <?php if(in_array('west', $explode2)) echo "checked"; ?>>
                                                        <label class="form-check-label">West</label>
                                                    </div>
                                      <div class="form-check form-check-inline col-lg-3 col-md-2">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="south" <?php if(in_array('south', $explode2)) echo "checked"; ?>>
                                                        <label class="form-check-label">South</label>
                                                    </div>
                                      <div class="form-check form-check-inline col-lg-3 col-md-2">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="north" <?php if(in_array('north', $explode2)) echo "checked"; ?>>
                                                        <label class="form-check-label">North</label>
                                                    </div>
                        
                          @if ($errors->has('exposure'))
                            <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('exposure') }}</strong>
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

                                <div class="row" style="margin-top: 1%; margin-bottom: 3%;">
                                    @if(count($prop_images))
                                       <label class="col-md-2">Property Images</label>
                                        <div class="col-md-10">
                                        @foreach($prop_images as $key => $property_image)
                                            <?php $path = $property_image["image_name"];?>
                                            <div class="col-md-2 col-sm-2 col-xs-2 title" id="rem_{{$property_image->id}}">
                                                <button class="delete" id="{{$property_image->id}}"><i class="fas fa-trash fa-2x"></i></button>
                                                <img src="{{ asset('images/'.$path) }}" height="100" width="100" >
                                            </div>
                                        @endforeach
                                         </div>
                                    @endif

                                </div>

                    <div class="form-group" style="display: flex;">
                    <div class="col-md-offset-2 col-md-5">
                        <button class="btn btn-info btn-block search_" id="btnsub">Update Property</button>
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
        // $("#btnsub").click(function(){
        //     $("#form_submit").submit();
        // });
    });
    jQuery(".dropzone").dropzone({
            contentType: "application/json",
            dataType: "json",
            success : function(file, response) {
               // console.log(file);
               console.log(response);
               debugger;
           }
       });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.user_id').select2();
    });
</script>
<script type="text/javascript">
   $('#price').maskMoney();
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
    function emptylnglat()
    {
     $("#latitude").val('');
     $("#longitude").val('');
    }
</script>
<script type="text/javascript">
    $(document).on('click','.delete',function(){
        var id = $(this).attr('id');
        if(confirm("are you sure you want to delete this data?"))
        {
            $.ajax({
                url:"{{ url('admin/removedata') }}",
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
</script>
@endsection
