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
</style>
<!-- add requirement page css -->

<style type="text/css">
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
    border-radius:1.5rem;
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
    padding: 50px;
}
.card-body{
    padding: 0;
}
.footer {
 margin-top: unset;
    }
</style>
<div class="container">
	<h5 style="color: #37a745; font-weight: bold;">My Property List</h5>
	<hr style="border: 0.5px solid green;">
	<div class="row m-0">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>
		<div class="col-md-9 setmd">
			<div class="row">
				 <div class="form-content ">
            <form  action="{{url('agent/store/requirement')}}" method="post">
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
                                    <input type="text" name="title" id="text" placeholder="" value="{{old('title')}}" class="form-control" required=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Email* 
                                    @if ($errors->has('email'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('email') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input type="text" name="email" id="text" placeholder="optional" value="{{old('email')}}" class="form-control"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <div class="label">Purpose* 
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
                                      <label class="radio-inline">
                                        <input type="radio" class=""  value="lease">Lease
                                    </label>
                                </div>
                        </div>
                       </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">Exchange Property*
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
                             <div class="cInput">
                             <div class="label">Min price* 
                               @if ($errors->has('min_price'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('min_price') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <label id="demo"></label><label>$</label>
                                <div class="slidecontainer">
                                  <input name="min_price" type="range" min="1" max="100" value="50" class="slider" id="myRange">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                             <div class="cInput">
                             <div class="label">Max price*
                                @if ($errors->has('max_price'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('max_price') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <label id="demo1"></label><label>$</label>
                                <div class="slidecontainer">
                                  <input type="range" name="max_price" min="1" max="10000" value="5000" class="slider slider1" id="myRange1">
                                
                                </div>
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
                                    <div class="makeSelect">
                                        <div class="label">Min-BedRooms* 
                                           @if ($errors->has('min_room'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('min_room') }} </strong>
                                        </span>
                                    @endif
                                        </div>
                                        <select class="test form-control" name="min_room">
                                           <option value="1" label="1">1</option>
                                            <option value="2" label="2">2</option>
                                            <option value="3" label="3">3</option>
                                            <option value="4" label="4">4</option>
                                            <option value="5" label="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="makeSelect">
                                    <div class="label">Max-BedRooms* 
                                       @if ($errors->has('max_room'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('max_room') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <select class="test form-control" name="max_room">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" >5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="9+">9+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="makeSelect">
                                        <div class="label">Min-Bathroom*
                                           @if ($errors->has('min_bathroom'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('min_bathroom') }} </strong>
                                        </span>
                                    @endif
                                        </div>
                                        <select class="test form-control" name="min_bathroom">
                                            <option value="1" label="1">1</option>
                                            <option value="2" label="2">2</option>
                                            <option value="3" label="3">3</option>
                                            <option value="4" label="4">4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="makeSelect">
                                    <div class="label">Max-BathRooms* 
                                       @if ($errors->has('max_bathroom'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('max_bathroom') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <select class="test form-control" name="max_bathroom">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" >5</option>
                                        <option value="6">6</option>
                                        <option value="7">7+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="makeSelect">
                                        <div class="label">Min-Size(SqFt)* 
                                           @if ($errors->has('min_size'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('min_size') }} </strong>
                                        </span>
                                    @endif
                                        </div>
                                        <select class="test form-control" name="min_size">
                                            <option value="" label="Select" selected="selected">Select</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="300">300</option>
                                             <option value="400">400</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="makeSelect">
                                    <div class="label">Max-Size(SqFt)*
                                       @if ($errors->has('max_size'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('max_size') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <select class="test form-control" name="max_size">
                                        <option value="" label="Select" selected="selected">Select</option>
                                          <option value="400">400</option>
                                            <option value="500">500</option>
                                              <option value="1000">1000</option>
                                            <option value="1500">1500</option>
                                              <option value="2000">2000</option>
                                            <option value="3000">3000</option>
                                              <option value="4000">4000</option>
                                            <option value="5000">5000</option>
                                             <option value="100000">10000</option>
                                              <option value="250000">25000</option>
                                               <option value="50000">50000</option>
                                    </select>
                                </div>
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
                                    <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Amenities/Facilities available * </p>
                             @foreach ($amenities as $key => $value)
                <div class="form-check form-check-inline col-md-4 col-lg-3 col-sm-4">
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
                    </div>
                    <h3>Location</h3>
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
                                    <input type="text" id="text" name="city_name" placeholder="" value="{{old('city_name')}}" class="form-control" style="" required=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Locality / Project* 
                                   @if ($errors->has('local_area'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('local_area') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input type="text" name="local_area" placeholder=""  class="form-control" value="{{old('local_area')}}" style="" required=""> 
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="cInput">
                                                <div class="label"> Discription*
                                              @if ($errors->has('discription'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('discription') }} </strong>
                                        </span>
                                    @endif
                                                </div>
                                                <textarea class="form-control" name="discription" cols="5" rows="5" style="border-radius: unset; border-left-color: #41ac1b !important;border-left-width: thick !important; background-color: #f3f3f3!important;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                    <input type="submit" class="btnSubmit" value="Next" style="margin-top: 3%; width: 50%;">
                                    </div>
                        </div>         
                </div>

            </form>
        </div>
	        </div>
		</div>
	</div>
</div>
@endsection