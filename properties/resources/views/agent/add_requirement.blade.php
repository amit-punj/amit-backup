@extends('layouts.main')
@section('content')
<style type="text/css">

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


 /*Requirment css   */
 label{
    font-size: 12px;
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
.form-content
{
    padding: 5%;
    border: 1px solid #ced4da;
    margin-bottom: 2%;
}
.form-control{
    /*border-radius:1.5rem;*/
}
.btnSubmit
{
    border:none;
    border-radius:1.5rem;
    padding: 1%;
    cursor: pointer;
    background: #4fad26;
    color: #fff;
}
h4.ng-binding {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 30px 0 0 24px;
}

.makeSelect select{
    width: 100%;
    border-left-color: #41ac1b;
    border-left-width: thick;
     background-color: #f3f3f3;
    border-radius: unset;
    padding: 3px 15px 5px 0;
    margin-top: 7px;
    font-size: 15px;
    /*background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAICAYAAAAm06XyAAAACXBIW…cAbBpBgBHkcXy2QIUwNOLUjGYAAzaNeDUjGcCATSMIAAQYANc9Yqz+zI3fAAAAAElFTkSuQmCC);*/
    background-position: center right;
    background-repeat: no-repeat;
    cursor: pointer;
}
.property .makeSelect {
    border-bottom: solid 1px #ccc;
    width: 100%;
}
.property .cInput .input  {
    border: none;
    margin-top: 9px;
    border-bottom: solid 1px #ccc;
    width: 100%;
    color: #666;
    font-size: 15px;
    padding: 0 10px 5px 0;
    box-sizing: border-box;
    margin: 0;
    font-size: 100%;
}
.property .cInput .input:focus {
    border-color: #3498db;
}
.cInput .label  {
    height: 23px;
}
.makeSelect .label  {
    height: 19px;
}
.radioOptions label {
    margin-right: 1%;
    display: inline-block;
}
.radioOptions label input {
    /*margin: 10px 8px 10px 0;*/
    margin-right: 10px;
    background-color: #fff;
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
    height: 16px;
    position: relative;
    width: 16px;
    -webkit-appearance: none;
    border: 1px solid #ccd1d9;
}
.radioOptions input[type=radio]:checked:after {
    background:  #41ac1b;
    content: '';
    display: block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    margin: 4px 0 0 4px;
}
.rooms ul li {
    width: 24%;
    display: inline-block;
    list-style-type: none;
}
.rooms input[type=checkbox] {
    background-color: #fff;
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
    height: 16px;
    position: relative;
    width: 16px;
    -webkit-appearance: none;
    border: 1px solid #ccd1d9;
    border-radius: 0;
}
.rooms input[type=checkbox]:checked:after {
    content: '';
    border-style: solid;
    position: absolute;
    left: auto;
    display: inline-block;
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
    width: 12px;
    top: 1px;
    right: 0;
    height: 5px;
    color: #41ac1b;
    border-width: 2px 2px 0 0;
}
:active, :focus, :visited, a:hover {
    outline: 0;
}
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
.font{
    font-size: 12px;
}
input.form-control {
    border-left-color: #4fad26;
    border-left-width: thick;
    background-color: #f3f3f3;
    border-radius: unset;
   
}
.slider {
    opacity: unset;
}
.form-content {
    background-color: white;
    border-style: none;
}
div#main {
    background-color: #f3f3f3;
}
.property{
   /* padding: 50px;*/
}
.card-body{
    padding: 0;
}
.footer {
 margin-top: unset;
}
.size_amen{
    width: 30%;
}
@media screen and (max-width: 824px)
{
    .size_amen{
    width: 45%;
}
}
@media screen and (max-width: 420px)
{
    .maxchar{
        font-size: 12px;
    }
    .amenities p{
        font-size: 12px !important;
    }
    .note p{
        font-size: 17px !important;
    }
}
@media screen and (max-width: 375px)
{
    .size_amen{
    width: 100%;
}
}
</style>
<div class="container">
    <div class="row m-0">
        <div class="col-md-3 setmd">
            @include('dashboard.dashboard-sidebar')
        </div>
        <div class="col-md-9 setmd">
            <div class="property">
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
    <div class="form">
     <div class="note"><p style="font-size: 22px;">Add <span style="color: #41ac1b"> Your </span> Buyer Requirements</p>
    </div>
    </div>
        <div class="form-content ">
            <form id="form_submit" action="{{url('agent/store/requirement')}}" method="post">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Title <span class="maxchar">(Max characters length 20)</span>*
                                    @if ($errors->has('title'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('title') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input type="text" name="title" id="text" maxlength="20" placeholder="Title" value="{{old('title')}}" class="form-control" required=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Clients 
                                    @if ($errors->has('client'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('client') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <select name="client" id="client" class="form-control">
                                        <option value="0">Select Client</option>
                                        @if(count($clients))
                                            @foreach($clients as $key => $client)
                                                <option value="{{ $client->id }}">{{ $client->fname }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">Type* 
                                   @if ($errors->has('purpose'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('purpose') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose" checked="" class="" value="buy">Buy
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose" class="" value="rent">Rent
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">1031 exchange property*
                                    @if ($errors->has('exchange_property'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('exchange_property') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="exchange" class="" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="exchange" checked="" class="" value="no">No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">Pre approved* 
                                   @if ($errors->has('pre_approved'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('pre_approved') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="pre_approved" class="" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="pre_approved" checked="" class="" value="no">No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">Investment buyer*
                                    @if ($errors->has('investment_buyer'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('investment_buyer') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="investment_buyer" class="" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="investment_buyer" checked="" class="" value="no">No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">Min price* 
                                    </div>
                                    <input type="text" name="min_price" max="100000000" id="min_price" placeholder="Min price" value="{{old('min_price')}}"  class="form-control" style="" required="" >
                                    @if(Session::has('flash_message_error'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{!! session('flash_message_error') !!} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">Max price*
                                    </div>
                                    <input type="text" name="max_price" id="max_price" placeholder="Max price" value="{{old('max_price')}}"  class="form-control" style="" required="" >
                                    @if(Session::has('flash_message_error'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{!! session('flash_message_error') !!} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">Property Type* 
                                    @if ($errors->has('property_type'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('property_type') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="property_type" class="" checked="" value="residential">Residential
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" value="commercial">Commercial
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" value="industrial">Industrial
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" value="land">Land
                                    </label>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">All Cash*
                                    @if ($errors->has('all_cash'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('all_cash') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" checked="" name="all_cash" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="all_cash" value="no">No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Min-Bedrooms
                                            <span class="error">*</span>
                                        </div>
                                        <input type="number" name="min_room" min="1" max="50" placeholder="Min-Bedrooms" value="{{old('min_room')}}"  class="form-control" style="" required="" >
                                    </div>
                                    @if ($errors->has('min_room'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('min_room') }} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Max-Bedrooms
                                        <span class="error">*</span>
                                    </div>
                                    <input type="number" name="max_room" min="1" max="50" placeholder="Max-Bedrooms" value="{{old('max_room')}}"  class="form-control" style="" required="" >
                                </div>
                                @if ($errors->has('max_room'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('max_room') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Min-Bathrooms
                                            <span class="error"></span>
                                        </div>
                                        <input type="number" name="min_bathroom" min="1" max="50" placeholder="Min-Bathrooms" value="{{old('min_bathroom')}}"  class="form-control" style="">
                                    </div>
                                    @if ($errors->has('min_bathroom'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('min_bathroom') }} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Max-Bathrooms
                                        <span class="error"></span>
                                    </div>
                                    <input type="number" name="max_bathroom" min="1" max="50" placeholder="Max-Bathrooms" value="{{old('max_bathroom')}}"  class="form-control" style="">
                                </div>
                                @if ($errors->has('max_bathroom'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('max_bathroom') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-group">
                                <div class="rooms" id="Additional_RoomsID">
                                @if ($errors->has('amenties'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('amenties') }} </strong>
                                        </span>
                                    @endif
                                    <div class="card-body"><div class="amenities"><p style="font-size: 15px;font-weight: 550;margin-left: 1%;">Amenities/Facilities available </p>
                             @foreach ($amenities as $key => $value)
                                <div class="form-check form-check-inline size_amen">
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
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-group">
                                <div class="rooms">
                                @if ($errors->has('building_features'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('building_features') }} </strong>
                                        </span>
                                    @endif
                                    <div class="card-body"><div class="amenities"><p style="font-size: 15px;font-weight: 550;margin-left: 1%;">Building features </p>
                             @foreach ($building as  $building_features)
                                <div class="form-check form-check-inline size_amen">
                                <input class="form-check-input" name="building_features[]" type="checkbox"  value="{{$building_features->id}}">
                                <label class="form-check-label">{{$building_features->feature_name}}</label>
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
                            </div>
                        </div>
                    </div>
                    <!-- <h3>Location</h3> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> City* 
                                   @if ($errors->has('city_name'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('city_name') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                <input name="latitude"  id="latitude_buyer" type="hidden" value="{{old('latitude')}}">   
                                <input name="longitude"  id="longitude_buyer" type="hidden" value="{{old('longitude')}}">
                                    <input type="text" id="autocomplete" name="city_name" placeholder="City name" value="{{old('city_name')}}" class="form-control" style="" required=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Neighborhood* 
                                   @if ($errors->has('local_area'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('local_area') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input type="text" name="local_area" placeholder="Neighborhood"  class="form-control" value="{{old('local_area')}}" style="" required=""> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                               <div class="col-md-12">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Description:
                                     <span class="error">*</span>
                                    </div>
                                    <textarea class="form-control" name="discription" cols="4" rows="4" style="border-radius: unset; border-left-color: #41ac1b !important;border-left-width: thick !important; background-color: #f3f3f3!important;" placeholder="Description">{{old('discription')}}</textarea>
                                </div>
                            </div>        
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Status*
                                        </div>
                                    <select class="form-control" name="status" required="">
                                        <option value="active">Active</option>
                                        <option value="passive">Passive</option>
                                        <option value="off the market">Off the market</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('status') }} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <input type="submit"  class="btnSubmit search_" value="Next" style="margin-top: 3%; width: 50%;">
                        </div>
                    </div>       
                </div>

            </form>
        </div>
     </div> 
     </div>
         <!-- ///end div    -->
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('#min_price').maskMoney();
    $('#max_price').maskMoney();
</script>
<script>
var placeSearch, autocomplete;

function initAutocomplete(){
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
  
  document.getElementById("latitude_buyer").value = lat;
  document.getElementById("longitude_buyer").value = lng;
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
    </script>
    <script type="text/javascript">
    $(document).on('change','#autocomplete',function(e){
       e.preventDefault;
         $("#latitude_buyer").val('');
         $("#longitude_buyer").val('');
   });
        $('#form_submit').submit(function() {
        var lat =  $("#latitude_buyer").val();
        var lng =  $("#longitude_buyer").val();
        if (lat != '' && lng != '') {
            return true;
        }else{
          alert('Please Select city from dropdown');
          return false;
        }
    });
        document.getElementById("autocomplete").value = localStorage.getItem("city_name_req");
        document.getElementById("longitude_buyer").value = localStorage.getItem("longitude_req");
        document.getElementById("latitude_buyer").value = localStorage.getItem("latitude_req");
       
    </script>
@endsection