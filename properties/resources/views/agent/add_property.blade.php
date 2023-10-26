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
    /*add property design*/
label{
    font-size: 12px;
}
    .note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
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
    width: 20%;
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
     border-left-color: #41ac1b;
    border-left-width: thick;
    background-color: #f3f3f3;
    border-radius: unset;
    width: 100%;
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
/*    width: 33%;*/
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
    background: #41ac1b;
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
.dz-image {
    width: 20%;
}
.text_size_mg_bt{
    font-size: 16px;
    margin-bottom: 1%;
}
 input.form-control {
    border-left-color: #41ac1b;
    border-left-width: thick;
    background-color: #f3f3f3;
    border-radius: unset;
   
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

.form-content {
    background-color: white;
    border-style: none;
}
div#main {
    background-color: #f3f3f3;
}
.property{
  /*  padding: 50px;*/
}
.heading-form{
    font-size: 22px;
}
.footer {
 margin-top: unset;
}
.size_amen{
    width: 30%;
}
.error {
  color: red;
  margin-left: 5px;
}
label.red {
    color: red;
}
 
label.error {
  display: inline;
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
           @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            <div class="form">
     <div class="note"><p style="font-size: 22px;">Add <span style="color: #41ac1b"> Your </span> Property</p>
    </div>
    </div>
                <div class="form-content ">
                <form id="form_submit" name="add_property" action="{{url('agent/preview/property')}}" method="post">
                  @csrf
                  <?php $ameniti = array();
                    $build = array();
                   ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Clients<br>
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
                                @if ($errors->has('client'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('client') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Size(Sq Ft):
                                    </div>
                                    <input id="size" type="number" min="1" name="size" placeholder="Size(Sq Ft)" value="{{old('size')}}"  class="form-control" style="" required>
                                    @if ($errors->has('size'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('size') }} </strong>
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
                                    <div class="label"> Address<br>
                                    </div>
                                    <input type="text" name="address" id="address" id="text" placeholder="Address" value="{{old('address')}}" class="form-control" > 
                                        (Address will be hidden for whisper listing)
                                </div>
                                @if ($errors->has('address'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('address') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">Purpose * 
                                   @if ($errors->has('purpose'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('purpose') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose" class="" checked="" value="whisper_listing">Whisper Listing
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="purpose" class="" value="active_listing">Active Listing
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Title* 
                                      
                                    </div>
                                    <input type="text" name="title" id="title" id="text"  maxlength="20" placeholder="Title" value="{{old('title')}}" class="form-control" style="" required> 
                                </div>
                                @if ($errors->has('title'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('title') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <div class="label">Type* 
                                   @if ($errors->has('type'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('type') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" name="type" class="" checked="" value="buy">Buy
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="type" class="" value="rent">Rent
                                    </label>
                                </div>
                        </div>
                       </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Price: 
                                    
                                    </div>
                                    <input type="text" name="price" placeholder="Price" id="price" value="{{old('price')}}"  class="form-control" style="" required> 
                                </div>
                                @if ($errors->has('price'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('price') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">1031 Exchange Property 
                                    
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="exchange" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" checked="" name="exchange" value="no">No
                                    </label>
                                </div>
                                @if ($errors->has('exchange'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('exchange') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">Property Type* 
                                    
                                    </div>
                                    <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" checked="" value="residential">Residential
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
                                @if ($errors->has('property_type'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('property_type') }} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">All Cash* 
                                    
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" checked="" name="all_cash" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="all_cash" value="no">No
                                    </label>
                                </div>
                                @if ($errors->has('all_cash'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('all_cash') }} </strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Bedrooms 
                                        <span class="error">*</span>
                                    </div>
                                    <input type="number" id="rooms" name="rooms" min="1" max="50" placeholder="Bedrooms" value="{{old('rooms')}}"  class="form-control" style="" required="" >
                                </div>
                                @if ($errors->has('rooms'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('rooms') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">Bathrooms 
                                        <span class="error">*</span>
                                    </div>
                                    <input id="bathroom" type="number" name="bathroom" min="1" max="50" placeholder="Bathrooms" value="{{old('bathroom')}}"  class="form-control" style="" required="" >
                                </div>
                                @if ($errors->has('bathroom'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('bathroom') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Half Bathrooms
                                    </div>
                                    <input type="number" min="1" max="20" name="half_bathroom" placeholder="Half Bathrooms" value="{{old('half_bathroom')}}"  class="form-control" style="">
                                @if ($errors->has('half_bathroom'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('half_bathroom') }} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Cross streets * 
                                    </div>
                                    <input type="text" name="cross_streets" id="cross_streets" id="text" placeholder="Cross streets" value="{{old('cross_streets')}}" class="form-control" style="" required=""> 
                                </div>
                                @if ($errors->has('cross_streets'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('cross_streets') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">Monthly Maintenance/Common Charges
                                        </div>
                                     <input type="number" min="1" name="monthly_maintenance" placeholder="Monthly Maintenance/Common Charges " value="{{old('monthly_maintenance')}}"  class="form-control" > 
                                    @if ($errors->has('monthly_maintenance'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('monthly_maintenance') }} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Monthly Taxes
                                        </div>
                                     <input type="number" min="1" name="monthly_tax" placeholder="Monthly Taxes " value="{{old('monthly_tax')}}"  class="form-control" style=""> 
                                    @if ($errors->has('monthly_tax'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('monthly_tax') }} </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label"> Exposures 
                                </div>
                                <div class="rooms" style="margin-top: 7px;">
                                      <div class="form-check form-check-inline size_amen">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="east">
                                                        <label class="form-check-label">East</label>
                                                    </div>
                                      <div class="form-check form-check-inline size_amen">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="west">
                                                        <label class="form-check-label">West</label>
                                                    </div>
                                      <div class="form-check form-check-inline size_amen">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="south">
                                                        <label class="form-check-label">South</label>
                                                    </div>
                                      <div class="form-check form-check-inline size_amen">
                                                        <input class="form-check-input" name="exposure[]" type="checkbox"  value="north">
                                                        <label class="form-check-label">North</label>
                                                    </div>
                                </div>
                                @if ($errors->has('exposure'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('exposure') }} </strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="rooms" id="Additional_RoomsID">
                                 <div class="label text_size_mg_bt"> Apartment Amenities 
                                    
                                    </div>
                                    @if ($errors->has('amenties'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('amenties') }} </strong>
                                        </span>
                                    @endif
                                    <div class="card-body" style="padding:0;">
                                        <div class="amenities">
                                            <!-- <p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Apartment Amenities:<span class="error"> *</span> 
                                            <?php $ameniti =(old('amenities')) ? old('amenities') : array();?>
                                            </p> -->
                                            @if(count($amenities))
                                                @foreach ($amenities as $key => $value)
                                                    <div class="form-check form-check-inline size_amen">
                                                        <input class="form-check-input" name="amenities[]" type="checkbox"  value="{{$value->id}}" <?php if(in_array($value->id, $ameniti)) echo "checked"; ?>   >
                                                        <label class="form-check-label">{{$value->amenities_name}}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="rooms">
                                    <div class="label text_size_mg_bt"> Building Features 
                                    
                                    </div>
                                    @if(count($building))
                                                @foreach ($building as $buildings)
                                                    <div class="form-check form-check-inline size_amen">
                                                        <input class="form-check-input" name="building_features[]" type="checkbox"  value="{{$buildings->id}}" <?php if(in_array($buildings->id, $build)) echo "checked"; ?>   >
                                                        <label class="form-check-label">{{$buildings->feature_name}}</label>
                                                    </div>
                                                @endforeach
                                            @endif

                                </div>
                                @if ($errors->has('building_features'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('building_features') }} </strong>
                                    </span>
                                @endif
                            
                        </div>
                    </div>
                    </div>    
                    <h3>Location</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">City: 
                                     <span class="error">*</span>
                                    </div>
                                <input name="latitude"  id="latitude_property" type="hidden" value="{{old('latitude')}}">   
                                <input name="longitude"  id="longitude_property" type="hidden" value="{{old('longitude')}}">
                                    <input type="text" class="form-control" name="city_name" id="autocomplete"  placeholder="City" value="{{old('city_name') }}" required=""> 
                                </div>
                                @if ($errors->has('city_name'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('city_name') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Neighborhood: 
                                     <span class="error">*</span>
                                    </div>
                                    <input id="local_area" type="text" name="local_area" placeholder="Neighborhood" value="{{old('local_area')}}"  class="form-control" required=""> 
                                </div>
                                @if ($errors->has('local_area'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('local_area') }} </strong>
                                    </span>
                                @endif
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Status*
                                        </div>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Zipcode<br>
                                    </div>
                                    <input type="number" min="0" name="zipcode" id="zipcode"  placeholder="Zipcode" value="{{old('zipcode')}}" class="form-control"> 
                                </div>
                                @if ($errors->has('zipcode'))
                                    <span class="help-block" style="color: red;">
                                        <strong>{{ $errors->first('zipcode') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>  
                    </form>
                        <div class="row">
                                <div class="col-md-12">
                                 <form action="{{url('file-upload1')}}"
                                  class="dropzone" name="file"
                                  id="my-awesome-dropzone" style="border: 1px solid #ccc; min-height:  200px;">
                                  @csrf 
                                  @if ($errors->has('file'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('file') }} </strong>
                                        </span>
                                    @endif
                                  </form>
                                </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 text-center">
                          <input type="submit" class="btnSubmit search_" id="btnsub" value="Next" style="margin-top: 5%; width: 50%;"> 
                          </div>
                      </div>
                      </div>
                    </div>
            </div>
         <!-- end add property design  -->


        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('#price').maskMoney();
    $(document).ready(function(){
        $("#btnsub").click(function(){
            $("#form_submit").submit();
        });
    });
 jQuery('#form_submit').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
          
        }      
    });
    ////////////
    jQuery(".dropzone").dropzone({
            contentType: "application/json",
            dataType: "json",
            maxFilesize: 5,
            acceptedFiles: 'image/*',
            success : function(file, response) {
               // console.log(file);
               console.log(response);
               debugger;
           }
       });
    
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
  
  document.getElementById("latitude_property").value = lat;
  document.getElementById("longitude_property").value = lng;
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
    </script>
      <script type="text/javascript">
      $(document).on('change','#autocomplete',function(e){
       e.preventDefault;
         $("#latitude_property").val('');
         $("#longitude_property").val('');
   });
    $('#form_submit').submit(function() {
        var lat =  $("#latitude_property").val();
        var lng =  $("#longitude_property").val();
        if (lat != '' && lng != '') {
            return true;
        }else{
          alert('Please Select city from dropdown');
          return false;
        }
    });
        document.getElementById("autocomplete").value = localStorage.getItem("city_name_property");
        document.getElementById("longitude_property").value = localStorage.getItem("longitude_property");
        document.getElementById("latitude_property").value = localStorage.getItem("latitude_property");
        
</script>

@endsection