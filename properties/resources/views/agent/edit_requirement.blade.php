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
/*.form-control{
    border-radius:1.5rem;
}*/
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
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
    <div class="form">
     <div class="note"><p style="font-size: 22px;">Edit <span style="color: #41ac1b"> Your </span>Buyer Requirements</p>
    </div>
    </div>
        <div class="form-content ">
            <form id="form_submit"  action="{{url('agent/update-requirement/'.$requirement->id)}}" method="post">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Title* 
                                    @if ($errors->has('title'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('title') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input type="text" name="title"  maxlength="20" id="text" placeholder="" value="{{ $requirement->title}}" class="form-control" required=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Client 
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
                                                <option value="{{ $client->id }}" <?php if($client->id == $requirement->client  ) echo 'selected'; ?>>{{ $client->fname }}</option>
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
                                        <input type="radio" name="purpose" <?php if($requirement->purpose == 'buy') echo "checked"; ?> class="" value="buy">Buy
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose" class="" <?php if($requirement->purpose == 'rent') echo "checked"; ?> value="rent">Rent
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
                                        <input type="radio" name="exchange" class="" <?php if($requirement->exchange == 'yes') echo "checked"; ?> value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="exchange" class="" <?php if($requirement->exchange == 'no') echo "checked"; ?> value="no">No
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
                                        <input type="radio" name="pre_approved" <?php if($requirement->pre_approved == 'yes') echo "checked"; ?> class="" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="pre_approved" <?php if($requirement->pre_approved == 'no') echo "checked"; ?> class="" value="no">No
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
                                        <input type="radio" name="investment_buyer" <?php if($requirement->investment_buyer == 'yes') echo "checked"; ?> class="" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="investment_buyer" <?php if($requirement->investment_buyer == 'no') echo "checked"; ?> class="" value="no">No
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
                                    <input type="text" name="min_price" id="min_price" placeholder="Min price" value="{{ number_format($requirement->min_price,2) }}"  class="form-control" style="" required="" >
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
                                    <input type="text" name="max_price" id="max_price" placeholder="Max price" value="{{ number_format($requirement->max_price,2)}}"  class="form-control" style="" required="" >
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
                                        <input type="radio" name="property_type" class="" <?php if($requirement->property_type== 'residential') echo "checked"; ?> value="residential">Residential
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" <?php if($requirement->property_type== 'commercial') echo "checked"; ?> value="commercial">Commercial
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" <?php if($requirement->property_type== 'industrial') echo "checked"; ?> value="industrial">Industrial
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" <?php if($requirement->property_type== 'land') echo "checked"; ?> value="land">Land
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
                                        <input type="radio" class="" <?php if($requirement->all_cash== 'yes') echo "checked"; ?> name="all_cash" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" <?php if($requirement->all_cash== 'no') echo "checked"; ?> name="all_cash" value="no">No
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
                                        <input type="number" name="min_room" min="1" max="50" placeholder="Min-Bedrooms" value="{{ $requirement->min_room}}"  class="form-control" style="" required="" >
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
                                    <input type="number" name="max_room" min="1" max="50" placeholder="Max-Bedrooms" value="{{ $requirement->max_room }}"  class="form-control" style="" required="" >
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
                                            <span class="error">*</span>
                                        </div>
                                        <input type="number" name="min_bathroom" min="1" max="50" placeholder="Min-Bathrooms" value="{{ $requirement->min_bathroom }}"  class="form-control" style=""  >
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
                                        <span class="error">*</span>
                                    </div>
                                    <input type="number" name="max_bathroom" min="1" max="50" placeholder="Max-Bathrooms" value="{{ $requirement->max_bathroom}}"  class="form-control" style=""  >
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
                                    <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Amenities/Facilities available  </p>
                                    <?php  
                                      $explode = explode(',', $requirement['amenities']);
                                    ?>
                                     @foreach ($amenities as $key => $value)
                                    <div class="form-check form-check-inline size_amen">
                                      <input class="form-check-input" name="amenities[]" <?php if(in_array($value->id, $explode)) echo "checked"; ?> type="checkbox"  value="{{$value->id}}">
                                      <label class="form-check-label" >{{$value->amenities_name}}</label>
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
                                    <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Building features  </p>
                                    <?php  
                                      $explode1 = explode(',', $requirement['building_features']);
                                    ?>
                                     @foreach ($building as  $buildings)
                                    <div class="form-check form-check-inline size_amen">
                                      <input class="form-check-input" name="building_features[]" <?php if(in_array($buildings->id, $explode1)) echo "checked"; ?> type="checkbox"  value="{{$buildings->id}}">
                                      <label class="form-check-label" >{{$buildings->feature_name}}</label>
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
                                     <input name="latitude"  id="latitude_buyer" type="hidden" value="{{ $requirement->latitude }}">   
                                    <input name="longitude"  id="longitude_buyer" type="hidden" value="{{ $requirement->longitude }}">
                                    <input type="text" id="autocomplete" name="city_name" placeholder="" value="{{ $requirement->city_name }}" class="form-control" style="" required=""> 
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
                                    <input type="text" name="local_area" placeholder=""  class="form-control" value="{{ $requirement->local_area }}" style="" required=""> 
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="cInput">
                                        <div class="label"> Description*
                                            </div>
                                        <textarea class="form-control" name="discription" cols="5" rows="5" style="border-radius: unset; border-left-color: #41ac1b !important;border-left-width: thick !important; background-color: #f3f3f3!important;"> {{ $requirement->discription }}
                                        </textarea>
                                        @if ($errors->has('discription'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('discription') }} </strong>
                                            </span>
                                        @endif
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
                                        <select class="form-control" name="status">
                                            <option <?php if($requirement->status == 'active') echo "selected"; ?> value="active">Active</option>
                                            <option <?php if($requirement->status == 'passive') echo "selected"; ?> value="passive">Passive</option>
                                            <option <?php if($requirement->status == 'off the market') echo "selected"; ?> value="off the market">Off the market</option>
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
                                <input type="submit" class="btnSubmit search_" value="Next" style="margin-top: 3%; width: 50%;">
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
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
var slider1 = document.getElementById("myRange1");
var output1 = document.getElementById("demo1");
output1.innerHTML = slider1.value;

slider1.oninput = function() {
  output1.innerHTML = this.value;
}
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
</script>
@endsection