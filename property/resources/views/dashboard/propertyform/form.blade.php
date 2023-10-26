<?php
$role = Auth::user()->user_role; 
if(\Request::is('create-property')){
    $meterPermission = App\Helpers\Helper::accessPermission(Auth::user()->id,Auth::user()->user_role,'meter_permission');
} else {
    $meterPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'meter_permission');
}
?>
<div class="div" id="myWizard"> 
    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 14.30%;"> 
            Step 1 of 7
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav nav-pills nav-wizard"> 
                <li class="active step1">
                    <a class="hidden-xs" href="#step1" data-toggle="tab" data-step="1">1. Property Type</a>
                    <a class="visible-xs" href="#step1" data-toggle="tab" data-step="1">1.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="disabled step2">
                    <div class="nav-wedge"></div> 
                    <a class="hidden-xs" href="#step2" data-toggle="tab" data-step="2">2. Basic Details</a>
                    <a class="visible-xs" href="#step2" data-toggle="tab" data-step="2">2.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class=" step3">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs" href="#step3" data-toggle="tab" data-step="3">3. Unit Details</a>
                    <a class="visible-xs" href="#step3" data-toggle="tab" data-step="3">3.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="disabled step4">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs" href="#step4" data-toggle="tab" data-step="4">4. Tenant</a>
                    <a class="visible-xs" href="#step4" data-toggle="tab" data-step="4">4.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="step5">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs create_build_class" href="#step5" data-toggle="tab" data-step="5">5. Assign Unit</a>
                    <a class="visible-xs" href="#step5" data-toggle="tab" data-step="5">5.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="disabled step6">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs" href="#step6" data-toggle="tab" data-step="6">6. Rules</a>
                    <a class="visible-xs" href="#step6" data-toggle="tab" data-step="6">6.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="disabled step7">
                    <div class="nav-wedge"></div>
                    <a class="hidden-xs" href="#step7" data-toggle="tab" data-step="7">7. Images</a>
                    <a class="visible-xs" href="#step7" data-toggle="tab" data-step="7">7.</a>
                </li>
            </ul>
        </div>
    </div>
    @if (\Request::is('edit-unit/*'))
    <form autocomplete="off" method="POST" action="{{ url('/update-unit/'.$unit->id) }}" enctype="multipart/form-data" id="create_propert_form">
    @elseif (\Request::is('edit-building/*'))
    <form autocomplete="off" method="POST" action="{{ url('/update-building/'.$property->id) }}" enctype="multipart/form-data" id="create_propert_form">
    @else
    <form autocomplete="off" method="POST" action="{{ url('/create-property') }}" enctype="multipart/form-data" id="create_propert_form"> 
    @endif

        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="tab-content">


            <div class="tab-pane fade in active" id="step1">
                <h3>Property Type</h3>
                <div class="well">
                    <div class="form-group row">
                        <label for="p_type" class="col-md-4 col-form-label text-md-right required">{{ __('Property Type') }}</label>
                        <div class="col-md-6">
                            <select name="p_type" id="p_type" class="form-control">
                                <!-- <option value="">Select Property Type</option> -->
                                @if ((\Request::is('create-property')) && isset($_GET['building']))
                                <option value="unit">Unit</option>
                                @elseif(\Request::is('create-property'))
                                <option value="unit">Unit</option>
                                <option value="building">Building</option>
                                @elseif (\Request::is('edit-unit/*'))
                                <option value="unit">Unit</option>
                                @elseif (\Request::is('edit-building/*'))
                                <option value="building">Building</option>
                                @endif
                            </select>
                            @error('p_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                          <div class="btn-group btn-group-lg" role="group" aria-label="">
                          </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-primary btn-lg btn-block next" step="1" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="step2">
                <h3>Basic Details</h3>
                <div class="well">  
                    <div class="form-group row">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right unit_name_lavel required">{{ __('Unit Name') }}</label>
                        <div class="col-md-6">
                            <input id="unit_name" type="text" class="form-control @error('unit_name') is-invalid @enderror" name="unit_name" value="" >

                            @error('unit_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row for_area">
                        <label for="area" class="col-md-4 col-form-label text-md-right required">{{ __('Size') }}</label>

                        <div class="col-md-4">
                            <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value=""  >
                             @error('area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="col-md-2">
                            <select id="area_in" class="form-control @error('u_type') is-invalid @enderror" name="area_in" value="" required>
                                <option value="square feet">Square Feet</option>
                                <option value="square meter">Square Meter</option>
                                <!-- <option value="industrial">Industrial</option> -->
                            </select>
                            @error('area_in')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right required">{{ __('Description') }}</label>
                        <div class="col-md-6">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"  ></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right required">{{ __('Address') }}</label>
                        <input name="latitude" id="latitude" type="hidden" value="">
                        <input name="longitude" id="longitude" type="hidden" value="">
                        <div class="col-md-6">
                            <input id="autocomplete" type="text" class="form-control @error('address') is-invalid @enderror autocomplete" name="address" value="" autocomplete="false">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                          <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                        
                          </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-primary btn-lg btn-block next" step="2" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="step3">
                <h3>Unit Details</h3>
                <div class="well">
                    <div class="form-group row">
                        <label for="po_esignature" id="esignature_custom" class="col-md-4 col-form-label text-md-right required">{{ __('E-Signature') }}</label>
                        <div class="col-md-4">
                            <a href="javascript::void()" data-toggle="modal" data-target="#upload_signature">Upload E-Signature</a>
                            <br>
                            <input type="hidden" class="form-control" id="po_esignature" name="po_esignature" value="" >
                            <span class="c_errors" id="c_po_esignature"></span>

                            @error('po_esignature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="col-md-4">
                            <img style="display: none;" id="image_name" class="sign-preview" src="">
                        </div>                                       
                    </div>
                    <div class="form-group row">
                        <label for="u_type" class="col-md-4 col-form-label text-md-right required">{{ __('Unit Type') }}</label>
                        <div class="col-md-6">
                            <select id="u_type" class="form-control @error('u_type') is-invalid @enderror" name="u_type" value="" required>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                                <!-- <option value="industrial">Industrial</option> -->
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row unit_category_residential">
                        <label for="unit_category_residential" class="col-md-4 col-form-label text-md-right required">{{ __('Unit Category') }}</label>
                        <div class="col-md-6">
                            <select id="unit_category_residential" class="form-control @error('u_type') is-invalid @enderror" name="unit_category_residential" value="" required>
                                <option value="apartment">Apartment</option>
                                <option value="studio">Studio</option>
                                <option value="room">Room</option>
                                <option value="house">House</option>
                                <option value="parking">Parking</option>
                            </select>
                            @error('unit_category_residential')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row unit_category_commercial">
                        <label for="unit_category_commercial" class="col-md-4 col-form-label text-md-right required">{{ __('unit Category') }}</label>
                        <div class="col-md-6">
                            <select id="unit_category_commercial" class="form-control @error('u_type') is-invalid @enderror" name="unit_category_commercial" value="" required>
                                <option value="industrial">Industrial</option>
                                <option value="retail">Retail</option>
                                <option value="office">Office</option>
                                <option value="warehouse">Warehouse</option>
                            </select>
                            @error('unit_category_commercial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if(count($properties) > 0)
                    <div class="form-group row">
                        <label for="building_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Building') }}</label>
                        <div class="col-md-6">
                            <select id="building_id" class="form-control @error('building_id') is-invalid @enderror" name="building_id" value="" >
                                <option value="">Select</option>
                                @foreach ($properties as $property1)
                                    <option value="{{ $property1->id }}">{{ $property1->unit_name }}</option>
                                @endforeach
                            </select>  
                            <input type="hidden" name="new_building" id="new_building" value="">
                            <div id="add_new_building"></div>                                      
                            @error('building_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- <div>
                            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add New <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div> -->
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="meter_id" class="col-md-4 col-form-label text-md-right">{{ __('Meters') }}</label>
                        <div class="col-md-6">
                            <!-- <select id="meter_id" class="form-control @error('meter_id') is-invalid @enderror" name="meter_id" value=""
                            >
                                <option value="">Select</option>
                                <option value="">Meter 1</option>
                                <option value="" selected>Meter 2</option>
                            </select>   -->
                            <span id="meter_id">Not Added</span>
                             <input type="hidden" name="new_meter" id="new_meter" value="">
                             <input type="hidden" name="meter_remove" id="meter_remove" value="">
                            <div id="add_new_meter"></div>                                        
                            @error('meter_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div>
                            @if($role == 2)
                                <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#meterModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            @elseif($role == 3)
                                @if($meterPermission !=0 && $meterPermission !=1)
                                <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#meterModal">Add New <span class="glyphicon glyphicon-plus"></span>
                                </button>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right required">{{ __('Rent('.App\Helpers\Helper::CURRENCYSYMBAL.')') }}</label>
                        <div class="col-md-6">
                            <input id="rent" type="text" class="form-control @error('rent') is-invalid @enderror" name="rent" value=""  >

                            @error('rent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cost_provision" class="col-md-4 col-form-label text-md-right required">{{ __('Cost Provision('.App\Helpers\Helper::CURRENCYSYMBAL.')') }}</label>
                        <div class="col-md-6">
                            <input id="cost_provision" type="text" class="form-control @error('cost_provision') is-invalid @enderror" name="cost_provision" value=""  >

                            @error('cost_provision')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="fixed_price" class="col-md-4 col-form-label text-md-right required">
                        {{ __('Monthly Fees('.App\Helpers\Helper::CURRENCYSYMBAL.')') }}
                        </label>
                        <div class="col-md-6">
                            <input id="fixed_price" type="text" class="form-control @error('fixed_price') is-invalid @enderror" name="fixed_price" value=""  >

                            @error('fixed_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tax" class="col-md-4 col-form-label text-md-right required">{{ __('Tax('.App\Helpers\Helper::CURRENCYSYMBAL.')') }}</label>
                        <div class="col-md-6">
                            <input id="tax" type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" value=""  >

                            @error('tax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-4 col-form-label text-md-right required">{{ __('Deposit('.App\Helpers\Helper::CURRENCYSYMBAL.')') }}</label>
                        <div class="col-md-6">
                            <input id="deposit" type="text" class="form-control @error('deposit') is-invalid @enderror" name="deposit" >

                            @error('deposit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_amount" class="col-md-4 col-form-label text-md-right required">{{ __('Total Amount('.App\Helpers\Helper::CURRENCYSYMBAL.')') }}</label>
                        <div class="col-md-6">
                            <input readonly id="total_amount" type="text" readonly class="form-control @error('total_amount') is-invalid @enderror" name="total_amount" value="0"  >

                            @error('total_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-4 col-form-label text-md-right required">{{ __('Number of Bedrooms') }}</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('deposit') is-invalid @enderror" name="bedrooms" id="bedrooms" placeholder="Number of Bedrooms" value="" min="1" max="9">
                            @error('deposit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Want a Guarantor') }}</label>
                        <?php 
                            $choose_guarantor = (isset($unit->choose_guarantor)) ? $unit->choose_guarantor : 'yes' ;
                        ?>
                        <div class="col-md-6">
                            <input type="radio" name="choose_guarantor" value="yes" <?php echo $retVal = ($choose_guarantor ) ? 'checked' : '' ; ?> > Yes
                            <input type="radio" name="choose_guarantor" value="no" <?php echo $retVal = ($choose_guarantor == 'no') ? 'checked' : '' ; ?> > No
                            @error('choose_guarantor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bed_funished" class="col-md-4 col-form-label text-md-right required">{{ __('Bedroom Furnished ') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="bed_funished" value="yes"> Yes
                            <input type="radio" name="bed_funished" value="no" checked> No
                            @error('bed_funished')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bed_lock" class="col-md-4 col-form-label text-md-right">{{ __('Lock on Bedroom') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="bed_lock" value="yes" checked> Yes
                            <input type="radio" name="bed_lock" value="no"> No
                            @error('bed_lock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kitchen" class="col-md-4 col-form-label text-md-right required">{{ __('Kitchen') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="kitchen" value="no"> No
                            <input type="radio" name="kitchen" value="shared"> Shared
                            <input type="radio" name="kitchen" value="private" checked> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="toilet" class="col-md-4 col-form-label text-md-right required">{{ __('Toilet') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="toilet" value="no"> No
                            <input type="radio" name="toilet" value="shared"> Shared
                            <input type="radio" name="toilet" value="private" checked> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="living_room" class="col-md-4 col-form-label text-md-right">{{ __('Living Room') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="living_room" value="no checked"> No
                            <input type="radio" name="living_room" value="shared" checked> Shared
                            <input type="radio" name="living_room" value="private"> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="balcony_terrace" class="col-md-4 col-form-label text-md-right">{{ __('Balcony/Terrace') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="balcony_terrace" value="no"> No
                            <input type="radio" name="balcony_terrace" value="shared" checked> Shared
                            <input type="radio" name="balcony_terrace" value="private"> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="garden" class="col-md-4 col-form-label text-md-right">{{ __('Garden') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="garden" value="no"> No
                            <input type="radio" name="garden" value="shared" checked> Shared
                            <input type="radio" name="garden" value="private"> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="basement" class="col-md-4 col-form-label text-md-right">{{ __('Basement') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="basement" value="no"> No
                            <input type="radio" name="basement" value="shared" checked> Shared
                            <input type="radio" name="basement" value="private"> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="parking" class="col-md-4 col-form-label text-md-right">{{ __('Parking') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="parking" value="no"> No
                            <input type="radio" name="parking" value="shared"> Shared
                            <input type="radio" name="parking" value="private" checked> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wheelchair" class="col-md-4 col-form-label text-md-right">{{ __('Wheelchair Accessible') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="wheelchair" value="no" checked> No
                            <input type="radio" name="wheelchair" value="shared"> Shared
                            <input type="radio" name="wheelchair" value="private"> Private
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="allergy_friendly" class="col-md-4 col-form-label text-md-right">{{ __('Allergy friendly') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="allergy_friendly" value="no"> No
                            <input type="radio" name="allergy_friendly" value="shared"> Shared
                            <input type="radio" name="allergy_friendly" value="private" checked> Private
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-12 col-form-label text-md-right">{{ __('Amenities/Facilities available') }}</label>
                        <div class="col-md-12">
                            @if (\Request::is('edit-unit/*'))
                            @foreach ($amenities as $amenity)  
                                <div class="col-md-4">

                                    @if(in_array($amenity->id, explode(",",$unit->amenities)) )
                                    <input class="form-control amenities-input" name="amenities[]" type="checkbox" value="{{$amenity->id}}" checked="true">
                                    @else 
                                    <input class="form-control amenities-input" name="amenities[]" type="checkbox" value="{{$amenity->id}}">
                                    @endif
                                    <label class="col-form-label">{{$amenity->amenities_name}}</label>
                                </div>
                             @endforeach
                             @else
                             @foreach ($amenities as $amenity)  
                                <div class="col-md-4">
                                    <input class="form-control amenities-input" name="amenities[]" type="checkbox" value="{{$amenity->id}}">
                                    <label class="col-form-label">{{$amenity->amenities_name}}</label>
                                </div>
                             @endforeach
                             @endif
                        </div>
                        <div class="amanity-error"></div>
                    </div>
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                        
                          </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-primary btn-lg btn-block next" step="3" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="step4">
                <h3>Preferred Tenant</h3>
                <div class="well">
                    <div class="form-group row">
                        <label for="preferred_gender" class="col-md-4 col-form-label text-md-right">{{ __('Preferred Gender') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="preferred_gender" value="male"> Male
                            <input type="radio" name="preferred_gender" value="female" checked> Female
                            <input type="radio" name="preferred_gender" value="no preference"> No Preference
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="min_age" class="col-md-4 col-form-label text-md-right required">{{ __('Minimum Age') }}</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="min_age" id="min_age" value="">
                         </div>
                    </div>
                    <div class="form-group row">
                        <label for="max_age" class="col-md-4 col-form-label text-md-right required">{{ __('Maximum Age') }}</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="max_age" id="max_age" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tenant_type" class="col-md-4 col-form-label text-md-right">{{ __('Tenant Type') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="tenant_type" checked="" value="any"> Any
                            <input type="radio" name="tenant_type" value="student"> Students Only
                            <input type="radio" name="tenant_type" value="working"> Working professionals only
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="couples_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Couples Allowed?') }}</label>
                       <div class="col-md-6">
                            <input type="radio" name="couples_allowed" value="no"> No
                            <input type="radio" name="couples_allowed" value="yes" checked> Yes
                        </div>
                    </div>
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                          <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                        
                          </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-primary btn-lg btn-block next" step="4" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="step5">
                <h3 class="create_build_class_body">Assign Unit</h3>
                <div class="well">
                    <div class="form-group row for_property_manager">
                        <label for="property_manager_id" class="col-md-4 col-form-label text-md-right">{{ __('Property Manager') }}</label>
                        <div class="col-md-6">
                            <select id="property_manager_id" type="text" class="form-control" name="property_manager_id" value="">
                                <option value="{{ Auth::user()->id }}">Select Property Manager</option>
                                @foreach ($PropertyManagers as $PropertyManager)  
                                    <option value="{{$PropertyManager->id}}">{{$PropertyManager->name." ".$PropertyManager->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                           <!--  <button style="float: right;" data-id="3" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#permissionModal">Permissions <span class="glyphicon glyphicon-plus"></span>
                            </button> -->
                            <!-- <button style="float: right;" data-id="3" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                            </button> -->
                        </div>
                    </div>
                    <div class="form-group row for_property_description_expert">
                        <label for="property_description_experts_id" class="col-md-4 col-form-label text-md-right">{{ __('Property Description Experts') }}</label>
                        <div class="col-md-6">
                            <select id="property_description_experts_id" type="text" class="form-control" name="property_description_experts_id" value="">
                                <option value="">Select Property Description Experts</option>
                                @foreach ($PropertyDescriptionExperts as $PropertyDescriptionExpert)  
                                    <option value="{{$PropertyDescriptionExpert->id}}">{{$PropertyDescriptionExpert->name." ".$PropertyDescriptionExpert->last_name }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <!-- <div>
                            <button style="float: right;" data-id="4" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div> -->
                    </div>
                    <div class="form-group row for_property_legal_advisor">
                        <label for="property_legal_advisor_id" class="col-md-4 col-form-label text-md-right">{{ __('Legal Advisor') }}</label>
                        <div class="col-md-6">
                            <select id="property_legal_advisor_id" type="text" class="form-control" name="property_legal_advisor_id" value="">
                                <option value="">Select Legal Advisor</option>
                                @foreach ($LegalAdvisors as $LegalAdvisor)  
                                    <option value="{{$LegalAdvisor->id}}">{{$LegalAdvisor->name." ".$LegalAdvisor->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div>
                            <button style="float: right;" type="button" data-id="5" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div> -->
                    </div>
                    <div class="form-group row for_property_visit_organizer">
                        <label for="property_visit_organizer_id" class="col-md-4 col-form-label text-md-right">{{ __('Visit Organizer') }}</label>
                        <div class="col-md-6">
                            <select id="property_visit_organizer_id" type="text" class="form-control" name="property_visit_organizer_id" value="">
                                <option value="">Select Visit Organizer</option>
                                @foreach ($VisitOrganizers as $VisitOrganizer)  
                                    <option value="{{$VisitOrganizer->id}}">{{$VisitOrganizer->name." ".$VisitOrganizer->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                       <!--  <div>
                            <button style="float: right;" data-id="6" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#assignModal">Add New <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div> -->
                    </div>
                    <div class="form-group row">
                        <label for="vandor_data" class="col-md-4 col-form-label text-md-right">{{ __('Vendors') }}</label>
                       <div class="col-md-6">
                            <input type="hidden" name="vandor_data" value="" id="vandor_data">
                            <input type="hidden" name="vandor_remove" value="" id="vandor_remove">
                           <div id="add_vendors">
                               <span>Not Added</span>
                           </div>
                           <div id="add_vendors_data">
                           </div>
                        </div>
                       <div>
                            <button style="float: right;" data-id="6" type="button" class="btn btn-success open-assignModal" data-toggle="modal" data-target="#addVendorModel">Add New <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                    </div>
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                        </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-primary btn-lg btn-block next" step="5" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="step6">
                <h3>Rules</h3>
                <div class="well">
                    <div class="form-group row">
                        <label for="registration_possible" class="col-md-4 col-form-label text-md-right">{{ __('Registration Possible') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="registration_possible" value="no"> No
                            <input type="radio" name="registration_possible" value="yes" checked> Yes
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cleaning_commonc_room_incl" class="col-md-4 col-form-label text-md-right">{{ __('Cleaning Common Room Incl.') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="cleaning_commonc_room_incl" value="no" checked> No
                            <input type="radio" name="cleaning_commonc_room_incl" value="yes"> Yes
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cleaning_private_room_incl" class="col-md-4 col-form-label text-md-right">{{ __('Cleaning Private Room Incl.') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="cleaning_private_room_incl" value="no"> No
                            <input type="radio" name="cleaning_private_room_incl" value="yes" checked> Yes
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="animal_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Animal Allowed') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="animal_allowed" value="no"> No
                            <input type="radio" name="animal_allowed" value="yes" checked> Yes
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="play_musical_instrument" class="col-md-4 col-form-label text-md-right">{{ __('Play Musical Instrument') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="play_musical_instrument" value="no" checked> No
                            <input type="radio" name="play_musical_instrument" value="yes"> Yes
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="smoking_allowed" class="col-md-4 col-form-label text-md-right">{{ __('Smoking Allowed') }}</label>
                        <div class="col-md-6">
                            <input type="radio" name="smoking_allowed" value="no" checked> No
                            <input type="radio" name="smoking_allowed" value="yes"> Yes
                        </div>
                    </div>
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                        </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-primary btn-lg btn-block next" step="6" type="button">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="step7">
                <h3>Upload Images</h3>
                <div class="well">
                    <div class="form-group row">
                        <label for="banner_image" class="col-md-4 col-form-label text-md-right required">{{ __('Select Banner') }}</label>

                        <div class="col-md-6">
                            <input  type="hidden" name="cover_image" id="banner_image">
                            <input id="banner_image_drop" type="file" class="form-control @error('banner_image') is-invalid @enderror" value=""  name="banner_image_drop" accept="image/*">

                            @error('banner_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div id="uploaded_banner_image"></div>
                        </div>                                                
                    </div>
                    <!-- </form> -->
                    <div class="form-group row">
                        <label for="images" class="col-md-4 col-form-label text-md-right required">{{ __('Property Images') }}</label>
                        <div class="col-md-6">
                            <input  type="hidden" name="images" id="images">
                            <input id="property_images" type="file" class="form-control @error('images') is-invalid @enderror" value=""  name="property_images" multiple accept="image/*">

                            @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div id="uploaded_product_images"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="term_conditions" class="col-md-4 col-form-label text-md-right required">{{ __('Permissions') }}</label>
                        <div class="col-md-8">
                            <input class="c309" id="term_conditions" type="checkbox" data-indeterminate="false" value="">
                            <span class="">I agree with the 
                                <a href="#" class="" target="_blank">Reasy terms & conditions </a>
                            </span>
                            <span class="term_error_message" style="display: none">Please accept term and condition's</span>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Property Images') }}</label>
                        <div class="col-md-6">
                           <form action="#" class="dropzone" name="file" id="my-awesome-dropzone" style="border: 1px solid #ccc; min-height:  200px;">
                          @csrf </form>
                            <div id="uploaded_product_images"></div>
                        </div>
                    </div>  -->
                    <div class="btn-group btn-group-justified" role="group" aria-label="">
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button class="btn btn-default back" type="button">Back</button>
                        </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            @if (\Request::is('edit-unit/*'))
                            <button class="btn btn-success" id="submit" type="submit">Update Unit</button>
                            @elseif (\Request::is('edit-building/*'))
                            <button class="btn btn-success" id="submit" type="submit">Update Building</button>
                            @else 
                             <button class="btn btn-success create_class" id="submit" type="submit">Create Unit</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </form>        
</div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="#" id="add_custom_building">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Create Building</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <input name="b_latitude" id="b_latitude" type="hidden" value="">
                            <input name="b_longitude" id="b_longitude" type="hidden" value="">
                            <div class="col-md-6">
                                <input id="b_autocomplete" type="text" class="form-control @error('b_address') is-invalid @enderror autocomplete" name="b_address" value="{{ old('b_address') }}" autocomplete="false" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_name" class="col-md-4 col-form-label text-md-right">{{ __('Building  Name') }}</label>
                            <div class="col-md-6">
                                <input id="b_name" type="text" class="form-control" name="b_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_size" class="col-md-4 col-form-label text-md-right">{{ __('Size') }}</label>
                            <div class="col-md-6">
                                <input id="b_size" type="text" class="form-control" name="b_size" value="">
                            </div>
                        </div>
                                            
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Create Building</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="permissionModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="add_unit_custom">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Permissions</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Unit Permissions') }}</label>
                            <div class="col-md-6" style="display: flex;">
                                <input type="radio" name="unit_permission" value="read"> Read
                                <input type="radio" name="unit_permission" value="write"> Write
                                <input type="radio" name="unit_permission" value="full"> Full Access
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Contract Permissions') }}</label>
                            <div class="col-md-6" style="display: flex;">
                                <input type="radio" name="contract_permission" value="read"> Read
                                <input type="radio" name="contract_permission" value="write"> Write
                                <input type="radio" name="contract_permission" value="full"> Full Access
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Meter Permissions') }}</label>
                            <div class="col-md-6" style="display: flex;">
                                <input type="radio" name="meter_permission" value="read"> Read
                                <input type="radio" name="meter_permission" value="write"> Write
                                <input type="radio" name="meter_permission" value="full"> Full Access
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" id="p_create" class="btn btn-success">Done Permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="add_unit_custom">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Create Property Manager</h3>
                    </div>
                    <div class="modal-body">
                    <input name="assign_to" id="assign_to" type="hidden" value="">
                        <div class="form-group row">
                            <label for="u_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <input name="u_latitude" id="u_latitude" type="hidden" value="">
                            <input name="u_longitude" id="u_longitude" type="hidden" value="">
                            <div class="col-md-6">
                                <input id="u_autocomplete" type="text" class="form-control @error('u_address') is-invalid @enderror autocomplete" name="address" value="{{ old('u_address') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="u_name" type="text" class="form-control" name="u_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="u_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="u_email" type="text" class="form-control" name="u_email" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" id="u_create" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addVendorModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="add_Vendor_form" action="">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Add New Vendor</h3>
                    </div>
                    <div class="modal-body">
                    <input name="assign_to" id="assign_to" type="hidden" value="">
                        <div class="form-group row">
                           <label for="vendor_type" class="col-md-4 col-form-label text-md-right">{{ __('Select Type') }}</label>
                            <div class="col-md-6">
                                <select id="vendor_type" class="form-control" name="vendor_type" value="">
                                        <option value="Locksmith">Locksmith</option>
                                        <option value="Plumber">Plumber</option>
                                        <option value="Electrician">Electrician</option>
                                        <option value="Building Manager">Building Manager</option>
                                        <option value="Heating">Heating</option>
                                        <option value="Internet">Internet</option>
                                        <option value="Insurance">Insurance</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vendor_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="vendor_name" type="text" class="form-control" name="vendor_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vendor_phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>
                            <div class="col-md-6">
                                <input id="vendor_phone_no" type="text" class="form-control" name="vendor_phone_no" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vendor_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="vendor_email" type="email" class="form-control" name="vendor_email" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="vendor_submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="meterModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="create_meter" action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Create Meter</h3>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group row">
                        <label for="m_name" class="col-md-4 col-form-label text-md-right">Meter Name</label>
                        <div class="col-md-6">
                            <input id="m_name" type="text" class="form-control" name="m_name" value="">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="meter_type" class="col-md-4 col-form-label text-md-right">Meter Type</label>
                        <div class="col-md-6">
                            <select id="meter_type" type="text" class="form-control" name="meter_type" value="">
                                <option value="electric_meter">Electricity Meter</option>
                                <option value="water_meter">Water Meter</option>
                                <option value="gas_meter">Gas Meter</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="unit_price" class="col-md-4 col-form-label text-md-right">Per Unit Price</label>
                        <div class="col-md-6">
                            <input id="unit_price" type="text" class="form-control" name="unit_price" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ean_number" class="col-md-4 col-form-label text-md-right">EAN Number</label>
                        <div class="col-md-6">
                            <input id="ean_number" type="text" class="form-control" name="ean_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_number" class="col-md-4 col-form-label text-md-right">Meter Number</label>
                        <div class="col-md-6">
                            <input id="meter_number" type="text" class="form-control" name="meter_number" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_number" class="col-md-4 col-form-label text-md-right">Consumption (%)</label>
                        <div class="col-md-6">
                            <input id="consumption" type="text" class="form-control" name="consumption" value="">
                        </div>
                    </div>
             <!--        <div class="form-group row">
                        <div class="col-md-12">
                            <h4>Add Reading</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meter_doc" class="col-md-4 col-form-label text-md-right">Upload Doc (pdf,xls)</label>
                        <div class="col-md-6">
                            <input id="meter_doc" type="file" class="form-control" name="meter_doc" value="" multiple="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date_of_reading" class="col-md-4 col-form-label text-md-right">Date of Reading</label>
                        <div class="col-md-6">
                            <input id="date_of_reading" type="text" class="form-control" name="date_of_reading" value=""> 
                            <div class="input-group date form_datetime" data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" name="date_of_reading" type="text" value="" readonly="">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reading_value" class="col-md-4 col-form-label text-md-right">Reading Value</label>
                        <div class="col-md-6">
                            <input id="reading_value" type="text" class="form-control" name="reading_value" value="">
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                     <button type="submit" id="m_create" class="btn btn-success">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<div class="modal fade" id="upload_signature" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Put signature below</h3>
            </div>
            <div class="modal-body termsToPrint">
                <div id="signArea" >
                    <div class="sig sigWrapper" style="height:auto;">
                        <div class="typed"></div>
                        <form method="POST" action="">
                            <canvas class="sign-pad" id="sign-pad" width="508" height="100"></canvas>
                            <button id="removeSignature" type="button">Clear</button>
                            <button type="button" id="btnSaveSign" disabled="">Save Signature</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button id="removeSignature">Reset</button>
                        <button type="button" id="btnSaveSign">Save Signature test</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#signArea').signaturePad({
            drawOnly:true, 
            drawBezierCurves:true, 
            lineTop:90,
            clear : '#removeSignature',
            onDraw: (e)=>{ document.getElementById("btnSaveSign").disabled = false;} 
        });
    });
    $("#removeSignature").click(function(e){
        document.getElementById("btnSaveSign").disabled = true;
    });

    // jQuery(document).ready(function($){
    //     var canvas = document.getElementById("sign-pad");
    //     var signaturePad = new SignaturePad(canvas);
        
    //     $('#removeSignature').on('click', function(){
    //         signaturePad.clear();
    //     });
        
    // });
    
    $("#btnSaveSign").click(function(e){
        html2canvas([document.getElementById('sign-pad')], {
            onrendered: function (canvas) {
                var canvas_img_data = canvas.toDataURL('image/png');
                var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
                //ajax call to save image inside folder
                $.ajax({
                    url: "{{ url('upload-signature') }}",
                    data: {
                        _token:'<?php echo csrf_token() ?>',
                        img_data:img_data 
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                       var img = "{{url('images/users')}}";
                       $('#image_name').show();
                       $('#image_name').attr('src', img+'/'+response.image_name);
                       $('#po_esignature').val(response.image_name);
                       $('#upload_signature').modal('hide');
                    }
                });
            }
        });
    });
</script> 
<script>
    jQuery(document).ready(function(){
        jQuery('#rent, #cost_provision, #fixed_price, #tax, #deposit').blur(function(){
            var total = parseFloat(jQuery('#rent').val()) + parseFloat(jQuery('#cost_provision').val()) + parseFloat(jQuery('#fixed_price').val()) +parseFloat(jQuery('#tax').val()) +parseFloat(jQuery('#deposit').val());
            if(parseFloat(total) >=0 ){
                jQuery('#total_amount').val(parseFloat(total));
            }
        });
        jQuery('#add_Vendor_form').submit(function(event){
            event.preventDefault();
            if(jQuery('#add_Vendor_form').valid()) {
                var data = JSON.stringify(jQuery('#add_Vendor_form').serializeArray());
                var data1 = jQuery('#add_Vendor_form').serializeArray();
                jQuery('#add_vendors').hide();
                jQuery('#add_vendors_data').show();
                var htmldata = jQuery('#add_vendors_data').html();
                jQuery('#add_vendors_data').html(htmldata+'<span>'+data1[2].value+' : '+data1[3].value+'<span class="delete_vander_for_create" data='+data+","+'>X</span></span>');
                //console.log(data);
                var old_data = jQuery('#vandor_data').val();
                jQuery('#vandor_data').val(old_data.concat(data+','));
                console.log(jQuery('#vandor_data').val());
                jQuery('#add_Vendor_form').each(function(){
                    this.reset();
                });
                jQuery('form#add_Vendor_form .close').trigger('click');
            }
        });
        jQuery('#property_images').change(function(){
            var file_data = $('#property_images').prop('files');   
            //console.log(file_data);
            //var images = [];
            Object.keys(file_data).forEach(function(key) {
                var form_data = new FormData();                  
                form_data.append('file', file_data[key]);
                form_data.append('image_for', 'property_images');
                form_data.append('_token', '<?php echo csrf_token() ?>');
                //alert(form_data);
                jQuery.ajax({
                    url: "{{ url('/property-images') }}",
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                        jQuery('#uploaded_product_images').append('<img src="{{ url("/images/property_images/210X130")}}/'+data.target_file+'" width="100px">');
                        var imagesData = jQuery('#images').val();
                        imagesData = imagesData+data.target_file+",";
                        jQuery('#images').val(imagesData);
                    }
                });
            });
        });
        jQuery('#banner_image_drop').change(function(){
            var file_data = $('#banner_image_drop').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('image_for', 'banner');
            form_data.append('_token', '<?php echo csrf_token() ?>');
            //alert(form_data);
            jQuery.ajax({
                url: "{{ url('/property-images') }}",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    jQuery('#uploaded_banner_image').html('<img src="{{ url("/images/property_banners/260X225")}}/'+data.target_file+'" width="100px">');
                    jQuery('#banner_image').val(data.target_file);
                }
            });
        });
    });
    // jQuery('#step2 button.btn.btn-primary.btn-lg.btn-block.next').click(function(event){
    //     var validator = $( "#create_propert_form" ).validate();
    //     validator.element( "#title" );
    //     validator.element( "#description" );
    //     alert(validator.element( "#autocomplete" ));
    //     $(this).off('click');
    // });
    jQuery('#add_custom_building').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            address:{
                required:true,
            },
            b_name:{
                required:true,
            },
            b_size:{
                required:true,
                number:true
            }
        }
    });
    jQuery('#create_meter').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            m_name:{
                required:true,
            },
            unit_price:{
                required:true,
                number:true
            },
            ean_number:{
                required:true,
                alphanumeric: true
            },
            meter_number:{
                required:true,
                alphanumeric: true
            },
            consumption:{
                required:true,
                number:true,
                min:1,
                max:100
            },
        }
    });
    jQuery('#create_propert_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            unit_name:{
                required:true,
            },
            address:{
                required:true,
            },
            area:{
                required:true,
                number:true,
                min: 0,
            },
            description:{
                required:true,
            },
            u_type:{
                required:true,
            },
            // po_esignature:{
            //     required:true,
            // },
            rent:{
                required:true,
                number:true,
                min: 0,
            }, 
            fixed_price:{
                required:true,
                number:true,
                min: 0,
            },
            tax:{
                required:true,
                number:true,
                min: 0,
            },
            cost_provision:{
                required:true,
                number:true,
                min: 0,
            },
            deposit:{
                required:true,
                number:true,
                min: 0,
            },
            bedrooms:{
                required:true,
                number:true
            },
            // building_id:{
            //     required:true,
            // },
            max_age: {
                required: true,
                min: 9,
                max: 70,
                noDecimal: true,
                greatedThenMinage: true,
            },
            min_age: {
                required: true,
                min: 9,
                max: 70,
                noDecimal: true
            },
            property_visit_organizer_id:{
                required: true,
            },
            property_legal_advisor_id:{
                required:true,
            },
            property_description_experts_id:{
                required:true,
            },
            @if (\Request::is('create-property'))
            banner_image_drop:{
                required:true,
            },
            property_images:{
                required:true,
            },
            @endif
        }      
    });
    
    jQuery.validator.addMethod("noDecimal", function(value, element) {
        return !(value % 1);
    }, "No decimal numbers"); 
    jQuery.validator.addMethod("greatedThenMinage", function(value, element) {
        if(value < jQuery('#min_age').val()){
            return false;
        } else {
            return true;
        }
    }, "should be greater then Minimum Age.");

    jQuery('#add_Vendor_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            vendor_name:{
                required:true,
            },
            vendor_phone_no:{
                required:true,
                number:true
            },
            vendor_email:{
                required:true,
                email:true
            }
        }      
    });
    jQuery(document).on('click','#add_new_meter .delete_meter_from_create',function(){
            var remove_data = jQuery('#new_meter').val();
            jQuery('#new_meter').val(remove_data.replace(jQuery(this).attr('data'), '') );
            jQuery(this).parent( "span" ).hide();
            // if(jQuery('#new_meter').val() == ''){
            //     jQuery('span#meter_id').show();
            // }
        });
    jQuery(document).on('click','#add_vendors_data .delete_vander_for_create',function(){
            var remove_data = jQuery('#vandor_data').val();
            jQuery('#vandor_data').val(remove_data.replace(jQuery(this).attr('data'), '') );
            jQuery(this).parent( "span" ).hide();
            // if(jQuery('#new_meter').val() == ''){
            //     jQuery('span#meter_id').show();
            // }
        });
</script>
<script type="text/javascript">
    $("#submit").click(function(){

        var validator = $( "#create_propert_form" ).validate();
        if(validator.element( "#unit_name" ) && validator.element( "#area" ) && validator.element( "#description" ) && validator.element( "#autocomplete" ) ) {
                //return true;
        } else {
            $('[href="#step2"]').tab('show');
            return false;
        }
        if(validator.element( "#u_type" ) && validator.element( "#rent" ) && validator.element( "#cost_provision" ) && validator.element( "#deposit" ) && validator.element( "#bedrooms" )){
                //return true;
        } else {
            $('[href="#step3"]').tab('show');
            return false;
        }
        if(validator.element( "#min_age" ) && validator.element( "#max_age" )){
            //return true;
        } else {
            $('[href="#step4"]').tab('show');
            return false;
        }


        if($('#term_conditions').prop("checked") == true){
            $('.term_error_message').hide();
        } else {
            $('[href="#step7"]').tab('show');
            $('.term_error_message').show();
            return false;
        }



        $("#create_propert_form").submit();
    });
    var date = new Date();
    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate: date
    });
    $('#b_create').click(function(){
        // jQuery('#add_new_building').html();
        // jQuery('#new_building').val();
        event.preventDefault();
            if(jQuery('#add_custom_building').valid()) {
                var data = JSON.stringify(jQuery('#add_custom_building').serializeArray());
                var data1 = jQuery('#add_custom_building').serializeArray();
                jQuery('select#building_id').hide();
                jQuery('#add_new_building').show();
                //var htmldata = jQuery('#add_vendors_data').html();
                jQuery('#add_new_building').html('<span>Building Name : '+data1[4].value+'</span>');
                //console.log(data);
                //var old_data = jQuery('#vandor_data').val();
                jQuery('#new_building').val(data);
                console.log(jQuery('#new_building').val());
                jQuery('#add_custom_building').each(function(){
                    this.reset();
                });
                jQuery('form#add_custom_building .close').trigger('click');
            }


        // var b_name = $('#b_name').val();
        // var html = '<option value="'+b_name+'">'+b_name+'</option>'; 
        // $('#building_id').append(html);
        // $('#myModal').modal('hide');
        // $('#assignModal').find('form').trigger('reset');
    });
    $('#p_create').click(function(){
        var p_name = $('#p_name').val();
        $('#permissionModal').modal('hide');
        // $('#permissionModal').find('form').trigger('reset');
    });
    $('#u_type').change(function(){
        if($('#u_type').val() == 'residential'){
            $('.unit_category_residential').show();
            $('.unit_category_commercial').hide();
        } else {
            $('.unit_category_residential').hide();
            $('.unit_category_commercial').show();
        }
    });
    $('#m_create').click(function(){
        event.preventDefault();
            if(jQuery('#create_meter').valid()) {
                var data = JSON.stringify(jQuery('#create_meter').serializeArray());
                var data1 = jQuery('#create_meter').serializeArray();
                jQuery('#meter_id').hide();
                jQuery('#add_new_meter').show();
                var htmldata = jQuery('#add_new_meter').html();
                jQuery('#add_new_meter').html(htmldata+'<span>Meter Type: '+(data1[0].value).replace("_", " ")+', EAN : '+data1[2].value+'<span class="delete_meter_from_create" data='+data+","+'>X</span></span>');
                console.log((data1[0].value));
                var type = (data1[0].value);
                $("#meter_type option[value*="+type+"]").prop('disabled',true);
                var old_data = jQuery('#new_meter').val();
                jQuery('#new_meter').val(old_data.concat(data+','));
                console.log(jQuery('#new_building').val());
                jQuery('#create_meter').each(function(){
                    this.reset();
                });
                jQuery('form#create_meter .close').trigger('click');
            }
        // var m_name = $('#m_name').val();
        // var html = '<option value="'+m_name+'">'+m_name+'</option>'; 
        // $('#meter_id').append(html);
        // $('#meterModal').modal('hide');
        // $('#meterModal').find('form').trigger('reset');
    });
    // $('#u_create').click(function(){
    //     var u_name = $('#u_name').val();
    //     var assign_to = $('#assign_to').val();
    //     var html = '<option value="'+u_name+'">'+u_name+'</option>'; 
    //     if(assign_to == 3)
    //      {
    //         $('#property_id').append(html);
    //      }
    //      else if(assign_to == 4)
    //      {
    //         $('#property_description_experts_id').append(html);
    //      }
    //      else if(assign_to == 5)
    //      {
    //         $('#property_legal_advisor_id').append(html);
    //      }
    //      else if(assign_to == 6)
    //      {
    //         $('#property_visit_organizer_id').append(html);
    //      }
    //     $('#assignModal').modal('hide');
    //     $('#assignModal').find('form').trigger('reset');
    // });
    $(document).on("click", ".open-assignModal", function () {
         var assign_to = $(this).data('id');
         $(".modal-body #assign_to").val( assign_to );
         if(assign_to == 3)
         {
            $('#assignModal .modal-title').text('Create Property Manager');
            var html = '<option value="'+b_name+'">'+b_name+'</option>'; 
            $('#building_id').append(html);
            $('#myModal').modal('hide');
         }
         else if(assign_to == 4)
         {
            $('#assignModal .modal-title').text('Create Property Description Experts');
         }
         else if(assign_to == 5)
         {
            $('#assignModal .modal-title').text('Create Legal Advisor');
         }
         else if(assign_to == 6)
         {
            $('#assignModal .modal-title').text('Create Visit Organizer');
         }
         // As pointed out in comments, 
         // it is unnecessary to have to manually call the modal.
         // $('#addBookDialog').modal('show');
    });
    $('#p_type').change(function(){
        var type = $('#p_type').val();
        if(type == 'unit'){
            $('[href="#step3"]').css('pointerEvents',"auto");
            $('[href="#step4"]').css('pointerEvents',"auto");
            // $('[href="#step3"]').css('cursor',"pointer");
        }
        else{
            $('[href="#step3"]').css('pointerEvents',"none");
            $('[href="#step4"]').css('pointerEvents',"none");
            // $('[href="#step3"]').css('cursor',"default");
        }
    });
</script>
<script type="text/javascript">
    $('.next').click(function(){

        if($(this).attr('step') == 1){
            if( $('#p_type').val()== 'building' ){
                $('.unit_name_lavel').text('Building Name');
                $('.create_class').text('Create Building');
                $('.create_build_class').text('5. Assign Building');
                $('.create_build_class_body').text('Assign Building');
                $('.for_area, .for_property_manager, .for_property_legal_advisor, .for_property_visit_organizer, .for_property_description_expert').hide();
            } else {
                $('.unit_name_lavel').text('Unit Name'); 
                $('.for_area, .for_property_manager, .for_property_legal_advisor, .for_property_visit_organizer, .for_property_description_expert').show();
                $('.create_class').text('Create Unit');
                $('.create_build_class').text('5. Assign Unit');
                $('.create_build_class_body').text('Assign Unit');
            }
        }
        if($(this).attr('step') == 2){
            var validator = $( "#create_propert_form" ).validate();
            validator.element( "#unit_name" );
            validator.element( "#area" );
            validator.element( "#description" );
            validator.element( "#autocomplete" );
            if(validator.element( "#unit_name" ) && validator.element( "#area" ) && validator.element( "#description" ) && validator.element( "#autocomplete" ) ) {
                jQuery('ul.nav.nav-pills.nav-wizard li.step2').removeClass('disabled');
            } else {
                return false;
            }
        }

        if($(this).attr('step') == 3){
            if(jQuery('#po_esignature').val() == ''){
                var posign = false;
               jQuery('#c_po_esignature').text('This Field is Required');
            } else {
                var posign = true;
                jQuery('#c_po_esignature').text('');
            }
            if(jQuery(".amenities-input:checked").val() == undefined){
                var amanityVal = false;
                jQuery('.amanity-error').text('Please select Any Amenities/Facilities');
            } else {
                var amanityVal = true;
                jQuery('.amanity-error').text('');
            }
            var validator = $( "#create_propert_form" ).validate();
            validator.element( "#u_type" );
            validator.element( "#po_esignature" );
            validator.element( "#rent" );
            validator.element( "#cost_provision" );
            validator.element( "#deposit" );
            validator.element( "#fixed_price" );
            validator.element( "#tax" );
            validator.element( "#bedrooms" );
            if(posign && validator.element( "#u_type" ) && validator.element( "#rent" ) && validator.element( "#cost_provision" ) && validator.element( "#deposit" ) && validator.element( "#bedrooms" ) && validator.element( "#fixed_price" ) && validator.element( "#tax" ) && amanityVal){
                jQuery('ul.nav.nav-pills.nav-wizard li.step3').removeClass('disabled');
            } else {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#esignature_custom").offset().top
                }, 2000);
                return false;
            }
        }

        if($(this).attr('step') == 4){
            var validator = $( "#create_propert_form" ).validate();
            validator.element( "#min_age" );
            validator.element( "#max_age" );
            if(validator.element( "#min_age" ) && validator.element( "#max_age" )){
                jQuery('ul.nav.nav-pills.nav-wizard li.step4').removeClass('disabled');
            } else {
                return false;
            }
        }
        if($(this).attr('step') == 5){
            var validator = $( "#create_propert_form" ).validate();
            validator.element( "#property_description_experts_id" );
            validator.element( "#property_legal_advisor_id" );
            validator.element( "#property_visit_organizer_id" );
            if(validator.element( "#property_description_experts_id" ) && validator.element("#property_legal_advisor_id" ) && validator.element("#property_visit_organizer_id") ){
                jQuery('ul.nav.nav-pills.nav-wizard li.step5').removeClass('disabled');
            } else {
                return false;
            }
                
        }

        if($(this).attr('step') == 6){
            // if($('#term_conditions').prop("checked") == true){
            //     $('.term_error_message').hide();
            //     jQuery('ul.nav.nav-pills.nav-wizard li.step6').removeClass('disabled');
            // } else {
            //     $('.term_error_message').show();
            //     return false;
            // }
        }

        var type = $('#p_type').val();
        if(type == 'unit'){
            var nextId = $(this).parents('.tab-pane').next().attr("id");
        }
        else{
            var id = $(this).parents('.tab-pane').attr("id");
            if(id == 'step2') {     
                var nextId = $(this).parents('.tab-pane').next().next().next().attr("id");  
            } else if(id == 'step5') {     
                var nextId = $(this).parents('.tab-pane').next().next().attr("id");  
            } else {
                var nextId = $(this).parents('.tab-pane').next().attr("id");
            }
        }
        $('[href="#' + nextId + '"]').tab('show');
        return false;
    });
    $('.back').click(function(){
        var type = $('#p_type').val();
        if(type == 'unit'){
            var prevId = $(this).parents('.tab-pane').prev().attr("id");
        }
        else{
            var id = $(this).parents('.tab-pane').attr("id");
            if(id == 'step7') {     
                var prevId = $(this).parents('.tab-pane').prev().prev().attr("id");
            } else if(id == 'step5') {     
                var prevId = $(this).parents('.tab-pane').prev().prev().prev().attr("id");
            } else {
                var prevId = $(this).parents('.tab-pane').prev().attr("id");
            }
        }
        $('[href="#'+prevId+'"]').tab('show');
        return false;
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      //update progress
      var step = $(e.target).data('step');
      var percent = (parseInt(step) / 7) * 100;
      $('.progress-bar').css({width: percent + '%'});
      $('.progress-bar').text("Step " + step + " of 7");
      //e.relatedTarget // previous tab
    });
    $('.first').click(function(){
      $('#myWizard a:first').tab('show')
    });
</script>
@if (isset($_GET['building']))
    <script type="text/javascript">
        jQuery(document).ready(function(){
           jQuery('#building_id').val("{{ $_GET['building'] }}");
        });
    </script>
@endif
@if (\Request::is('edit-unit/*'))
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#unit_name').val('{{$unit->unit_name}}');
        jQuery('#area').val('{{$unit->area}}');
        jQuery('#area_in').val('{{$unit->area_in}}');
        jQuery('#description').val('{{$unit->description}}');
        jQuery('#latitude').val('{{$unit->latitude}}');
        jQuery('#longitude').val('{{$unit->longitude}}');
        jQuery('#autocomplete').val('{{$unit->address}}');
        jQuery("#u_type").val('{{$unit->u_type}}').trigger('change');
        jQuery("#unit_category_residential").val('{{$unit->unit_category}}').trigger('change');
        jQuery("#unit_category_commercial").val('{{$unit->unit_category}}').trigger('change');
        jQuery("#building_id").val('{{$unit->building_id}}');
        jQuery("#rent").val('{{$unit->rent}}');
        jQuery("#cost_provision").val('{{$unit->cost_provision}}');
        jQuery("#deposit").val('{{$unit->deposit}}');
        jQuery("#fixed_price").val('{{$unit->fix_price}}');
        jQuery("#total_amount").val('{{$unit->total_amount}}');
        jQuery("#po_esignature").val('{{$unit->po_esignature}}');

        @if($unit->po_esignature)
            jQuery('#image_name').attr('src','{{ url("/images/users/".$unit->po_esignature) }}').show();
        @endif

        jQuery("#tax").val('{{$unit->tax}}');
        jQuery("#bedrooms").val('{{$unit->bedrooms}}');
        jQuery("#min_age").val('{{$unit->min_age}}');
        jQuery("#max_age").val('{{$unit->max_age}}');
        jQuery("#property_manager_id").val('{{$unit->property_manager_id}}');
        jQuery("#property_description_experts_id").val('{{$unit->property_description_experts_id}}');
        jQuery("#property_legal_advisor_id").val('{{$unit->property_legal_advisor_id}}');
        jQuery("#property_visit_organizer_id").val('{{$unit->property_visit_organizer_id}}');

        jQuery("input[name='bed_funished'][value='{{$unit->bed_funished}}']").prop('checked', true);
        jQuery("input[name='bed_lock'][value='{{$unit->bed_lock}}']").prop('checked', true);
        jQuery("input[name='kitchen'][value='{{$unit->kitchen}}']").prop('checked', true);
        jQuery("input[name='toilet'][value='{{$unit->toilet}}']").prop('checked', true);
        jQuery("input[name='living_room'][value='{{$unit->living_room}}']").prop('checked', true);
        jQuery("input[name='balcony_terrace'][value='{{$unit->balcony_terrace}}']").prop('checked', true);
        jQuery("input[name='garden'][value='{{$unit->garden}}']").prop('checked', true);
        jQuery("input[name='basement'][value='{{$unit->basement}}']").prop('checked', true);
        jQuery("input[name='parking'][value='{{$unit->parking}}']").prop('checked', true);
        jQuery("input[name='wheelchair'][value='{{$unit->wheelchair}}']").prop('checked', true);
        jQuery("input[name='allergy_friendly'][value='{{$unit->allergy_friendly}}']").prop('checked', true);
        jQuery("input[name='preferred_gender'][value='{{$unit->preferred_gender}}']").prop('checked', true);
        jQuery("input[name='tenant_type'][value='{{$unit->tenant_type}}']").prop('checked', true);
        jQuery("input[name='couples_allowed'][value='{{$unit->couples_allowed}}']").prop('checked', true);
        jQuery("input[name='registration_possible'][value='{{$unit->registration_possible}}']").prop('checked', true);
        jQuery("input[name='cleaning_commonc_room_incl'][value='{{$unit->cleaning_commonc_room_incl}}']").prop('checked', true);
        jQuery("input[name='cleaning_private_room_incl'][value='{{$unit->cleaning_private_room_incl}}']").prop('checked', true);
        jQuery("input[name='animal_allowed'][value='{{$unit->animal_allowed}}']").prop('checked', true);
        jQuery("input[name='play_musical_instrument'][value='{{$unit->play_musical_instrument}}']").prop('checked', true);
        jQuery("input[name='smoking_allowed'][value='{{$unit->smoking_allowed}}']").prop('checked', true);
        jQuery("input[name='smoking_allowed'][value='{{$unit->smoking_allowed}}']").prop('checked', true);

        jQuery("#term_conditions").prop('checked', true);

        jQuery('#banner_image').val('{{$unit->cover_image}}');
        jQuery('#uploaded_banner_image').html('<img src="{{ url("/images/property_banners/260X225/".$unit->cover_image) }}" width="100px">');
        jQuery('#images').val('{{$unit->images}}');
        var images = '{{$unit->images}}';
        var imagesArray = images.split(",");
        imagesArray.forEach(function(element) {
            if(element != ''){
                jQuery('#uploaded_product_images').append('<span><span class="close" data="'+element+'">X</span><img src="{{ url("/images/property_images/210X130")}}/'+element+'" width="100px"></span>');
            }
        });
        @if(count($unitVendors)>0)
            jQuery('#add_vendors').hide();
            @foreach ($unitVendors as $vendors)
                var htmldata = jQuery('#add_vendors_data').html();
                jQuery('#add_vendors_data').html(htmldata+'<span>{{ $vendors->vendor_type }} : {{ $vendors->name }}<span class="delete_vander" data="{{ $vendors->id }}">X</span></span>');
            @endforeach
        @endif
        jQuery('#uploaded_product_images .close').click(function(){
            var images = jQuery('#images').val();
            var res = images.replace(jQuery(this).attr('data')+',', '');
            jQuery('#images').val(res);
            jQuery(this).parent( "span" ).hide();
        });
        jQuery('#add_vendors_data .delete_vander').click(function(){
            var remove_data = jQuery('#vandor_remove').val();
            jQuery('#vandor_remove').val(remove_data+jQuery(this).attr('data')+',');
            jQuery(this).parent( "span" ).hide();
        });

        @if(count($meters)>0)
            jQuery('#meter_id').hide();
            @foreach ($meters as $meter)
                var htmldata = jQuery('#add_new_meter').html();
                @if($role == 2)
                jQuery('#add_new_meter').html(htmldata+'<span>Meter Type: {{ str_replace("_"," ",$meter->meter_type) }},EAN : {{ $meter->ean_number }}<span class="delete_meter" data="{{ $meter->id }}">X</span></span>');
                @elseif($role == 3)
                    @if($meterPermission ==0)
                    jQuery('#add_new_meter').html(htmldata+'<span>Meter Type: {{ str_replace("_"," ",$meter->meter_type) }},EAN : {{ $meter->ean_number }}</span>');
                    @else
                    jQuery('#add_new_meter').html(htmldata+'<span>Meter Type: {{ str_replace("_"," ",$meter->meter_type) }},EAN : {{ $meter->ean_number }}<span class="delete_meter" data="{{ $meter->id }}">X</span></span>');
                    @endif
                @endif
            @endforeach
        @endif
        jQuery('#add_new_meter .delete_meter').click(function(){
            var remove_data = jQuery('#meter_remove').val();
            jQuery('#meter_remove').val(remove_data+jQuery(this).attr('data')+',');
            jQuery(this).parent( "span" ).hide();
        });
    });
</script>
@endif

@if (\Request::is('edit-building/*'))
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#unit_name').val('{{$property->unit_name}}');
        jQuery('#area').val('{{$property->area}}');
        //alert('{{$property->description}}');
        jQuery('#description').val('{{$property->description}}');
        jQuery('#latitude').val('{{$property->latitude}}');
        jQuery('#longitude').val('{{$property->longitude}}');
        jQuery('#autocomplete').val('{{$property->address}}');

        jQuery("#property_manager_id").val('{{$property->property_manager_id}}');
        jQuery("#property_description_experts_id").val('{{$property->property_description_experts_id}}');
        jQuery("#property_legal_advisor_id").val('{{$property->property_legal_advisor_id}}');
        jQuery("#property_visit_organizer_id").val('{{$property->property_visit_organizer_id}}');

        jQuery("input[name='registration_possible'][value='{{$property->registration_possible}}']").prop('checked', true);
        jQuery("input[name='cleaning_commonc_room_incl'][value='{{$property->cleaning_commonc_room_incl}}']").prop('checked', true);
        jQuery("input[name='cleaning_private_room_incl'][value='{{$property->cleaning_private_room_incl}}']").prop('checked', true);
        jQuery("input[name='animal_allowed'][value='{{$property->animal_allowed}}']").prop('checked', true);
        jQuery("input[name='play_musical_instrument'][value='{{$property->play_musical_instrument}}']").prop('checked', true);
        jQuery("input[name='smoking_allowed'][value='{{$property->smoking_allowed}}']").prop('checked', true);
        jQuery("input[name='smoking_allowed'][value='{{$property->smoking_allowed}}']").prop('checked', true);

        jQuery("#term_conditions").prop('checked', true);
        
        jQuery('#banner_image').val('{{$property->cover_image}}');
        jQuery('#uploaded_banner_image').html('<img src="{{ url("/images/property_banners/260X225/".$property->cover_image) }}" width="100px">');
        jQuery('#images').val('{{$property->images}}');
        var images = '{{$property->images}}';
        var imagesArray = images.split(",");
        imagesArray.forEach(function(element) {
            if(element != ''){
                jQuery('#uploaded_product_images').append('<span><span class="close" data="'+element+'">X</span><img src="{{ url("/images/property_images/210X130")}}/'+element+'" width="100px"></span>');
            }
        });
        @if(count($buildingVendors)>0)
            jQuery('#add_vendors').hide();
            @foreach ($buildingVendors as $vendors)
                //alert('{{ $vendors->vendor_type }}');
                var htmldata = jQuery('#add_vendors_data').html();
                jQuery('#add_vendors_data').html(htmldata+'<span>{{ $vendors->vendor_type }} : {{ $vendors->name }}<span class="delete_vander" data="{{ $vendors->id }}">X</span></span>');
            @endforeach
        @endif
        jQuery('#uploaded_product_images .close').click(function(){
            var images = jQuery('#images').val();
            var res = images.replace(jQuery(this).attr('data')+',', '');
            jQuery('#images').val(res);
            jQuery(this).parent( "span" ).hide();
        });
        jQuery('#add_vendors_data .delete_vander').click(function(){
            var remove_data = jQuery('#vandor_remove').val();
            jQuery('#vandor_remove').val(remove_data+jQuery(this).attr('data')+',');
            jQuery(this).parent( "span" ).hide();
        });



    });
</script>
@endif

<style type="text/css">
    canvas#sign-pad {border: 1px solid; width: 100%; }
    .sigWrapper { border: 0 !important; }
    span#c_po_esignature {color: red; }
    div#add_vendors span ,div#add_vendors_data span,div#add_new_building span, div#add_new_meter span{border: 1px solid #ccc; padding: 5px; margin: 5px; display: inline-block; }
    span.term_error_message {display: block; color: red; }
    li.disabled {pointer-events: none; } 
    label.required::after {content: '*'; color: red; padding: 5px; }
    input#term_conditions {width: 20px !important; }
    .error-message {color: #fff !important; background-color: red; margin: 5px 0; padding: 3px 15px; }
    .pac-container {z-index: 10000 !important;   }
    span#meter_id {border: 1px solid #ccc; padding: 5px; margin: 0 5px; }
    div#uploaded_product_images > span {position: relative; }
    div#uploaded_product_images .close {position: absolute; right: 6px; color: #fff; background-color: #000; font-size: 20px; }
    div#add_vendors_data span.delete_vander {cursor: pointer; background-color: #fff; }
    div#add_new_meter span.delete_meter {cursor: pointer; background-color: #fff; }
    .unit_category_commercial {display: none; }
    .sign-preview {
            width: 150px;
            height: 50px;
            border: solid 1px #CFCFCF;
            margin: 10px 5px;
        }
    @media only screen and (max-width: 767px) {
        div#add_vendors span, div#add_vendors_data span, div#add_new_building span, div#add_new_meter span {border: 1px solid #ccc; padding: 5px; margin: 5px 5px; display: inline-block; }
    }
    .amanity-error { margin-left: 3%; color: red; }
</style>