@extends('layouts.main')
@section('content')
<style type="text/css">
label{
    font-size: 12px;
}
	.note
}
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
    border-radius:1.5rem;
}
.btnSubmit
{
    border:none;
    border-radius:1.5rem;
    padding: 1%;
    width: 20%;
    cursor: pointer;
    background: green;
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
    border: none;
    background-color: #fff;
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
    /*width: 33%;*/
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
    background: #59cdb5;
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
    color: #59cdb5;
    border-width: 2px 2px 0 0;
}
:active, :focus, :visited, a:hover {
    outline: 0;
}
.dz-image {
    width: 20%;
}

</style>
<div class="container property">
            <div class="form">
                <h4 ng-bind="pageConfig.labels.headingLabel" class="ng-binding">Give us some information about the configuration of the property</h4>
                <!-- {{$amenities}} -->
                <div class="form-content ">
                @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
                <form id="form_submit" action="{{url('agent/add/property')}}" method="post">
                  @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Title: 
                                      @if ($errors->has('title'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('title') }} </strong>
                                        </span>
                                        @endif
                                    </div>
                                    <input type="text" name="title" id="title" id="text" placeholder="" value="" class="input" style=""> 
                                </div>
                            </div>
                        </div>
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
                                        <input type="radio" name="purpose" class="" value="buy">Buy
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Price: 
                                      @if ($errors->has('price'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('price') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input type="number" name="price" placeholder=""  class="input" style=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="label">Exchange Property 
                                     @if ($errors->has('exchange'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('exchange') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="exchange" value="yes">Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="exchange" value="no">No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label">Property Type: 
                                         @if ($errors->has('property_type'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('property_type') }} </strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="property_type" value="residential">Residential
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
                                <div class="label">All Cash 
                                    @if ($errors->has('all_cash'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('all_cash') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="radioOptions" style="width: 100%;margin-top: 7px;">
                                    <label class="radio-inline">
                                        <input type="radio" class="" name="all_cash" value="yes">Yes
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
                                        <div class="label">BedRooms: 
                                             @if ($errors->has('rooms'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('rooms') }} </strong>
                                        </span>
                                    @endif
                                        </div>
                                        <select class="test" name="rooms" >
                                            <option value="" label="Select" selected="selected">Select</option>
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
                                    <div class="label">BathRooms: 
                                        <span class="error">*</span>
                                    </div>
                                    <select class="test" name="bathroom">
                                        <option value="" label="Select" selected="selected">Select</option>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Size(sqmt): 
                                     <span class="error">*</span>
                                    </div>
                                    <input type="text" name="size" placeholder=""  class="input" style=""> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="rooms" id="Additional_RoomsID">
                                @if ($errors->has('amenties'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('amenties') }} </strong>
                                        </span>
                                    @endif
                                    <div class="card-body"><div class="amenities"><p style="font-size: 16px;font-weight: 550;margin-left: 1%;">Amenities/Facilities available * </p>
                             @if(count($amenities))
                             @foreach ($amenities as $key => $value)
                                <div class="form-check form-check-inline col-md-4 col-6">
                                <input class="form-check-input" name="amenities[]" type="checkbox"  value="{{$value->id}}">
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
                    <h3>Location</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> City: 
                                     <span class="error">*</span>
                                    </div>
                                    <input type="text" name="city_name" id="text" placeholder="" value="" class="input" style=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Locality / Project: 
                                     <span class="error">*</span>
                                    </div>
                                    <input type="text" name="local_area" placeholder=""  class="input" style=""> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="cInput">
                                    <div class="label"> Discription: 
                                     <span class="error">*</span>
                                    </div>
                                    <textarea class="input" name="discription" style=""></textarea>
                                    <!-- <input type="password" id="text" placeholder="" value="" class="input" style="">  -->
                                </div>
                            </div>        
                        </div>
                    </div>
                    </form>
                        <div class="row">
                                <div class="col-md-12">
                                 <form action="{{url('file-upload1')}}"
                                  class="dropzone" name="file"
                                  id="my-awesome-dropzone" style="border: 1px solid #ccc; min-height:  200px;">
                                  @csrf </form>
                                </div>
                        </div>
                          <input type="submit" class="btnSubmit" id="btnsub" value="Add Property" style="margin-top: 5%; width: 33%;"> 
                      </div>
                    </div>
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
            success : function(file, response) {
               // console.log(file);
               console.log(response);
               debugger;
           }
       });
    
</script>
@endsection