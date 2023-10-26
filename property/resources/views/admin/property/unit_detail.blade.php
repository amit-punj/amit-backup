@extends('adminlayouts.app')
@section('content')
 <main class="app-content">
      <div class="app-title"><h3>Unit Detail</h3>
       </div>
       <div class="container main">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        <div class="row">
            <div class="col-sm-7">
                <?php $url = '/images/property_banners/540X380/'.$data->cover_image; ?>
                <section class="slider">
                    <div id="slider" class="flexslider">
                        <ul class="slides">
                            <li>
                                <a class="fancybox" href="{{ url($url) }}"  data-fancybox-group="gallery"><img src="{{ url($url) }}" style="width: 473px;" alt="" /></a>
                            </li>
                            @if(count($images) > 0)
                                @foreach($images as $key=>$image)
                                    @if($image != "")
                                    <li>
                                        <a class="fancybox property_images" href="{{ url('/images/property_images/540X380/'.$image) }}"  data-fancybox-group="gallery"><img src="{{ url('/images/property_images/540X380/'.$image) }}" alt="" /></a>
                                    </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                        <div class="nav-slider">
                            <a href="javascript::void()" class="btn flex-prev"><span><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>
                            <a href="javascript::void()" class="btn flex-next"><span><i class="fa fa-chevron-right"></i></span></a>
                        </div>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides"> 
                            <li>
                                <img src="{{ url($url) }}" style="width:100%; height: 130px;" />
                            </li>
                            @if(count($images) > 0)
                                @foreach($images as $key=>$image)
                                    @if($image != "")
                                    <li>
                                        <img src="{{ url('/images/property_images/210X130/'.$image) }}" style="width:100%; height: 130px;" />
                                    </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                        <div class="nav-carousel">
                            <a href="javascript::void()" class="btn flex-prev"><span><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>
                            <a href="javascript::void()" class="btn flex-next"><span><i class="fa fa-chevron-right"></i></span></a>
                        </div>
                    </div>
                </section>
            </div>
            <div  class="col-sm-5">
                <div class="property_info">
                    <div class="title">{{$data->unit_name}}</div>
                    <div class="property_info_body">
                        <div class="location"><span>Address:</span>{{$data->address}}<a href="https://maps.google.com/maps?q={{$data->latitude}},{{$data->longitude}}" target="_blank"><span class="glyphicon glyphicon-map-marker"></span></a></div>
                        <div class="extra_info">
                            <div class="rent_info"><span>Size(Sq Ft) :</span>{{$data->area}}</div>
                            <div class="rent_info"><span>Cost Provision :</span> ${{$data->cost_provision}}</div>
                            <div class="rent_info"><span>Rent :</span> ${{$data->rent}}</div>
                            <div class="rent_info"><span>Deposit :</span> ${{$data->deposit}}</div>
                        </div>
                        <div class="extra_info section">
                            <div class="facility_title">Details</div>
                            <div class="facility_info"><span>Number of Bedrooms :</span> {{$data->bedrooms}}</div>
                            <div class="facility_info"><span>Kitchen :</span> {{ ucfirst($data->kitchen)}}</div>
                            <div class="facility_info"><span>Toilet :</span> {{ ucfirst($data->toilet)}}</div>
                            <div class="facility_info"><span>Garden :</span> {{ ucfirst($data->garden)}}</div>
                            <div class="facility_info"><span>Basement :</span> {{ ucfirst($data->basement)}}</div>
                            <div class="facility_info"><span>Parking :</span> {{ ucfirst($data->parking)}}</div>
                            <div class="facility_info"><span>Wheelchair Accessible :</span> {{ ucfirst($data->wheelchair)}}</div>
                        </div>
                        <div class="extra_info section">
                        @if(isset($data->amenities))
                            <div class="amenities_title">Amenities/Facilities</div>
                            <div class="amenities_info">
                            <?php $explode = explode(',', $data->amenities); ?>
                            @if(count($amenities) > 0)
                                @foreach($amenities as $key => $amenity )
                                    @if(in_array($amenity->id, $explode) )
                                        <?php  $abc[] =  $amenity->amenities_name; ?>
                                    @endif 
                                @endforeach
                                {{ implode(',', $abc) }}
                            @endif
                            </div>
                        @endif
                        </div>
                    </div>     
                </div>
                @if((Auth::guest() || Auth::user()->user_role == 1) && $data->booking_status == 0)
                    <div class="property-action"> 
                        <div class="row">
                            <div class="col-md-4">
                                <button data-toggle="modal" data-target="#book_visit">Book Visit</button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ url('/book-property/'.$data->id) }}"><button data-toggle="modal">Book Now</button></a>
                                <!-- <button data-toggle="modal" data-target="#book_unit">Book Property Now</button> -->
                            </div>
                            <div class="col-md-4">
                                <button data-toggle="modal" data-target="#send-message">Send E-mail</button>
                                <!-- <a href="{{ url('/send-message/'.$data->id) }}" target="_blank"><button data-toggle="modal" data-target="#updateModel">Send Message</button></a> -->
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="btn"><a class="btn active1" data-toggle="tab" href="#menu_description" id="des">Description</a></li>
                    <!-- <li><a data-toggle="tab" href="#menu_assign_unit">Assign Unit</a></li> -->
                    <li><a class="btn" data-toggle="tab" href="#menu_tenant" id="pre">Preferred Tenant</a></li>
                    <!-- <li><a data-toggle="tab" href="#menu_meters">Meters</a></li> -->
                    <li><a class="btn" data-toggle="tab" href="#menu_rules" id="rul">Rules</a></li>
                    <li><a class="btn" data-toggle="tab" href="#menu_contracts" id="cont">Contracts</a></li>
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="tab-content">
                    <div id="menu_description" class="tab-pane fade in active show">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="content">
                                    {{$data->description}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="menu_tenant" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- <div class="unit-title">Preferred Tenant</div> -->
                                <div class="unit"><span>Preferred Gender : </span> {{ucfirst($data->preferred_gender)}} </div>
                                <div class="unit"><span>Minimum Age : </span> {{$data->min_age}} </div>
                                <div class="unit"><span>Maximum Age : </span> {{$data->max_age}} </div>
                                <div class="unit"><span>Tenant Type : </span> {{ucfirst($data->tenant_type)}} </div>
                                <div class="unit"><span>Couples Allowed : </span> {{ucfirst($data->couples_allowed)}} </div>
                            </div>
                        </div>
                    </div>
                    <div id="menu_rules" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="unit"><span>Registration Possible : </span> {{ucfirst($data->registration_possible)}} </div>
                                <div class="unit"><span>Cleaning Common Eoom Incl : </span> {{ucfirst($data->cleaning_commonc_room_incl)}} </div>
                                <div class="unit"><span>Cleaning Private Room Incl : </span> {{ucfirst($data->cleaning_private_room_incl)}} </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="unit"><span>Animal allowed : </span> {{ucfirst($data->animal_allowed)}}</div>
                                <div class="unit"><span>Play Musical Instrument : </span> {{ucfirst($data->play_musical_instrument)}}</div>
                                <div class="unit"><span>Smoking Allowed : </span> {{ucfirst($data->smoking_allowed)}}</div>
                            </div>
                        </div>
                    </div>
                    <div id="menu_contracts" class="tab-pane fade">
                        <div class="row"> 
                            @if(count($contracts) > 0)
                                @foreach($contracts as $key => $contract)
                                    <!-- {!! \Helper::pr($contract); !!} -->
                                    @php( $tenent = \App\User::find($contract->tenent_id) )  
                                    <!-- {!! \Helper::pr($tenent); !!} -->
                                    <div class="col-sm-4">
                                        <div class="unit-body">
                                            <div class="unit-delete"><a href="{{ url('/contract-details/'.$contract->id) }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                            <div class="unit"><span>Status : </span> Running </div>
                                            <div class="unit"><span>Unit Name : </span>  {{substr($data->unit_name,1,20)}} </div>
                                            <div class="unit"><span>Contract With(Tenent) : </span> <a href="{{url('tenant-details/'.$tenent->id)}}"></a>{{ucfirst($tenent->name)}} </div>
                                            <div class="unit"><span>Contract Type : </span> {{ ucfirst($contract->contract_type)}} </div>
                                            <div class="unit"><span>Starting Date : </span>  {!! \Helper::Date($contract->starting_date); !!}</div>
                                            <div class="unit"><span>End Date : </span>  {!! \Helper::Date($contract->end_date); !!}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No Contract List</p>
                            @endif
                        </div> 
                    </div>
                </div>
            </div>
        </div>   
    </div>


    <div class="modal fade" id="book_visit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/create-visit') }}" id="visit_booking">
                    @csrf
                    <input id="property_id" type="hidden" class="form-control" name="property_id" value="{{$data->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Book Visit</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Visitor Name') }}</label>
                            <div class="col-md-9">
                                @if (Auth::guest())  
                                    <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
                                @else
                                    <input id="name" type="text" class="form-control" readonly="" name="name" value="{{ Auth::user()->name}}" placeholder="jhon">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                @if (Auth::guest())  
                                    <input id="email" type="email" class="form-control" name="email" value="" placeholder="jhon@gmail.com" status="false">
                                @else
                                    <input id="email" type="email" class="form-control" <?php echo $readonly = ($VerifyEmail == 1) ? 'readonly' : '' ; ?> name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
                                @endif
                                <span id="email_varification_message"></span>
                            </div>
                            <div class="col-md-3">
                                <span id="email_confirmation_message" style="color: green;"><?php echo $readonly = ($VerifyEmail == 1) ? 'Verified!' : '' ; ?></span>
                            </div>
                        </div> 
                        <div class="form-group row" id="Email_confirmation">
                            <label for="email_token" class="col-md-3 col-form-label text-md-right">{{ __('Enter Token') }}</label>
                            <div class="col-md-6">
                                <input id="email_token" type="text" class="form-control"  name="email_token" value="" status="false">
                            </div>
                            <div class="col-md-3">
                                <span id="email_token_confirmation_message"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            @if (Auth::guest())  
                                <div class="col-md-4">
                                    <input id="phone_number" type="text" class="form-control"  name="phone_number" value="" placeholder="+911234567890" status="false">
                                    <span id="phone_number_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <span id="send_otp" class="">Send OTP</span>
                                </div>
                                <div class="col-md-3">
                                    <span id="confirmation_message"></span>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <input id="phone_number" <?php echo $readonly = (Auth::user()->phone_verify == 1) ? 'readonly' : '' ; ?> type="text" class="form-control" name="phone_number" value="{{ Auth::user()->phone_no}}" status="true">
                                    <span id="phone_number_error"></span>
                                </div>
                                @if(Auth::user()->phone_verify != 1)
                                    <div class="col-md-2">
                                        <span id="send_otp" class="">Send OTP</span>
                                    </div>
                                    <div class="col-md-3">
                                        <span id="confirmation_message"></span>
                                    </div>
                                @else
                                <div class="col-md-3">
                                {{ session()->put('phone_verify', '1')}}
                                    <span style="color:green" id="confirmation_message">Verified!</span>
                                </div>
                                @endif
                            @endif
                        </div> 
                        @if (Auth::guest() || Auth::user()->phone_verify != 1)
                            <div class="form-group row">
                                <label for="enter_otp" class="col-md-3 col-form-label text-md-right">{{ __('Enter OTP') }}</label>
                                <div class="col-md-4">
                                    <input id="enter_otp" type="text" class="form-control"  name="enter_otp" value="" placeholder="Enter OTP">
                                </div>
                                <div class="col-md-3">
                                    <span id="otp_confirmation_message"></span>
                                </div>
                            </div>
                        @else
                            <input id="enter_otp" type="hidden" class="form-control"  name="enter_otp" value="1" placeholder="Enter OTP">
                        @endif
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('DateTime') }}</label>
                            <div class="col-md-9">
                                <div class="input-group date form_datetime"  data-date-format="dd MM, yyyy - HH:ii p" data-link-field="dtp_input1">
                                    <input class="form-control" size="16" name="time" type="text" value="" readonly >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control"  name="title" value="" placeholder="Enter Title">
                            </div>                           
                        </div> 
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" placeholder="Description"></textarea> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="send-message" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/send-message/'.$data->id) }}" id="send_message_form">
                    @csrf
                    <input id="property_id" type="hidden" class="form-control" name="property_id" value="{{$data->id}}">
                    <input type="hidden" name="new_user" value="" id="new_user">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Send E-mail</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-9">
                                @if (Auth::guest())  
                                    <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
                                @else
                                    <input id="name" type="text" class="form-control" readonly="" name="name" value="{{ Auth::user()->name}}" placeholder="jhon">
                                @endif
                               <!--  <input class="form-control" name="name" type="text" value="" placeholder="Name"> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                @if (Auth::guest())  
                                    <input id="m_email" type="email" class="form-control"  name="email" value="" placeholder="jhon@gmail.com" status="false">
                                @else
                                    <input id="m_email" type="email" class="form-control" <?php echo $readonly = ($VerifyEmail == 1) ? 'readonly' : '' ; ?> name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
                                @endif
                                <span id="m_email_varification_message"></span>
                            </div>
                            <div class="col-md-3">
                                <span id="m_email_confirmation_message" style="color: green;"><?php echo $readonly = ($VerifyEmail == 1) ? 'Verified!' : '' ; ?></span>
                            </div>
                        </div> 
                        <div class="form-group row" id="m_Email_confirmation">
                            <label for="email_token" class="col-md-3 col-form-label text-md-right">{{ __('Enter Token') }}</label>
                            <div class="col-md-6">
                                <input id="m_email_token" type="text" class="form-control"  name="email_token" value="" status="false">
                            </div>
                            <div class="col-md-3">
                                <span id="m_email_token_confirmation_message"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            @if (Auth::guest())  
                                <div class="col-md-4">
                                    <input id="m_phone_number" type="text" class="form-control" name="phone_number" value="" placeholder="+911234567890" status="false">
                                    <span id="m_phone_number_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <span id="m_send_otp" class="">Send OTP</span>
                                </div>
                                <div class="col-md-3">
                                    <span id="m_confirmation_message"></span>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <input id="m_phone_number" <?php echo $readonly = (Auth::user()->phone_verify == 1) ? 'readonly' : '' ; ?> type="text" class="form-control" name="phone_number" value="{{ Auth::user()->phone_no}}" placeholder="+911234567890" status="true">
                                    <span id="m_phone_number_error"></span>
                                </div>
                                @if(Auth::user()->phone_verify != 1)
                                    <div class="col-md-2">
                                        <span id="m_send_otp" class="">Send OTP</span>   
                                    </div>
                                    <div class="col-md-3">
                                        <span id="confirmation_message"></span>
                                    </div>
                                @else
                                <div class="col-md-3">
                                    {{ session()->put('phone_verify', '1')}}
                                    <span style="color:green" id="m_confirmation_message">Verified!</span>
                                </div>
                                @endif
                            @endif
                        </div>
                        @if (Auth::guest() || Auth::user()->phone_verify != 1) 
                        <div class="form-group row">
                            <label for="enter_otp" class="col-md-3 col-form-label text-md-right">{{ __('Enter OTP') }}</label>
                            <div class="col-md-4">
                                <input id="m_enter_otp" type="text" class="form-control"  name="enter_otp" value="" placeholder="Enter OTP">
                            </div>
                            <div class="col-md-3">
                                <span id="m_otp_confirmation_message"></span>
                            </div>
                        </div> 
                        @else
                            <input id="m_enter_otp" type="hidden" class="form-control"  name="enter_otp" value="1" placeholder="Enter OTP">
                        @endif
                        <div class="form-group row" id="m_email_section" style="display: none;">
                            <label for="email" class="col-md-3 col-form-label text-md-right"></label>
                            <div class="col-md-9" id="m_email_section1" >
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="m_confirmation_code" name="confirmation_code" placeholder="Enter Token">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn-success form-control" id="m_verify_email">Verify Email</button>
                                </div>
                                <span class="help-block" id="m_email_verify_error" style="display: none;">
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rent" class="col-md-3 col-form-label text-md-right">{{ __('Message') }}</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="message" placeholder="Message"></textarea> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="m_submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="book_unit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="book_unit_form">
                    @csrf
                    <input id="property_id" type="hidden" class="form-control" name="property_id" value="19">
                    <input type="hidden" name="new_user" value="" id="new_user">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Book Property</h3>
                    </div>
                    <div id="step1">
	                    <div class="modal-body">
	                    	<div class="step-title">Tenant details</div>
	                    	<div class="form-group row">
	                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Tenant Type') }}</label>
	                            <div class="col-md-9">
		                            <div class="tenant_type_main">
		                                <input id="tenant_type1" type="radio" class="form-control"  name="tenant_type" value="person" checked> Person
		                                <input id="tenant_type2" type="radio" class="form-control"  name="tenant_type" value="company" > Company
		                            </div>
	                            </div>
	                        </div>
	                        <div class="company_body" style="display: none">
		                        <div class="form-group row">
		                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Company Name') }}</label>
		                            <div class="col-md-9">
		                                <input id="company_name" type="text" class="form-control"  name="email" value="" placeholder="Vision Vivante">
		                            </div>
		                        </div>
		                        <div class="form-group row">
		                            <label for="company_email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
		                            <div class="col-md-9">
		                                    <input id="company_email" type="email" class="form-control"  name="company_email" value="" placeholder="vision@gmail.com">
		                            </div>
		                        </div>
		                        <div class="form-group row">
		                            <label for="company_phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
		                            <div class="col-md-9">
		                                <input id="company_phone_number" type="text" class="form-control"  name="company_phone_number" value="" placeholder="+917777777777">
		                            </div>
		                        </div>
		                    </div>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
	                            <div class="col-md-4">
	                                @if (Auth::guest())  
	                                    <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
	                                @else
	                                    <input id="name" type="text" class="form-control"  name="name" value="{{ Auth::user()->name}}" placeholder="Firstname">
	                                @endif
	                            </div>
	                             <div class="col-md-4">
	                                @if (Auth::guest())  
	                                    <input id="last_name" type="text" class="form-control"  name="last_name" value="" placeholder="jhon">
	                                @else
	                                    <input id="last_name" type="text" class="form-control"  name="last_name" value="{{ Auth::user()->last_name}}" placeholder="Lastname">
	                                @endif
	                               <!--  <input class="form-control" name="name" type="text" value="" placeholder="Name"> -->
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
	                            <div class="col-md-6">
	                                @if (Auth::guest())  
	                                    <input id="m_email" type="email" class="form-control"  name="email" value="" placeholder="jhon@gmail.com" status="false">
	                                @else
	                                    <input id="m_email" type="email" class="form-control"  name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
	                                @endif
	                                <span id="m_email_varification_message"></span>
	                            </div>
	                            <div class="col-md-3">
	                                <span id="m_email_confirmation_message"></span>
	                            </div>
	                        </div> 
	                        <div class="form-group row" id="m_Email_confirmation">
	                            <label for="email_token" class="col-md-3 col-form-label text-md-right">{{ __('Enter Token') }}</label>
	                            <div class="col-md-6">
	                                <input id="m_email_token" type="text" class="form-control"  name="email_token" value="" status="false">
	                            </div>
	                            <div class="col-md-3">
	                                <span id="m_email_token_confirmation_message"></span>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
	                            <div class="col-md-4">
	                                <input id="m_phone_number" type="text" class="form-control"  name="phone_number" value="" placeholder="+911234567890" status="false">
	                                <span id="m_phone_number_error"></span>
	                            </div>
	                            <div class="col-md-2">
	                                <span id="m_send_otp" class="">Send OTP</span>
	                            </div>
	                            <div class="col-md-3">
	                                <span id="m_confirmation_message"></span>
	                            </div>
	                        </div> 
	                        <div class="form-group row">
	                            <label for="enter_otp" class="col-md-3 col-form-label text-md-right">{{ __('Enter OTP') }}</label>
	                            <div class="col-md-4">
	                                <input id="m_enter_otp" type="text" class="form-control"  name="enter_otp" value="" placeholder="Enter OTP">
	                            </div>
	                            <div class="col-md-3">
	                                <span id="m_otp_confirmation_message"></span>
	                            </div>
	                        </div> 
	                        <div class="form-group row" id="m_email_section" style="display: none;"> 
	                            <label for="email" class="col-md-3 col-form-label text-md-right"></label>
	                            <div class="col-md-9" id="m_email_section1" >
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" id="m_confirmation_code" name="confirmation_code" placeholder="Enter Token">
	                                </div>
	                                <div class="col-md-4">
	                                    <button type="button" class="btn-success form-control" id="m_verify_email">Verify Email</button>
	                                </div>
	                                <span class="help-block" id="m_email_verify_error" style="display: none;">
	                                </span>
	                            </div> 
	                        </div>
	                        <div class="form-group row">
	                            <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('address') }}</label>
	                            <div class="col-md-9">
	                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="photo" class="col-md-3 col-form-label text-md-right">{{ __('Photo') }}</label>
	                            <div class="col-md-9">
	                                <input type="file" class="form-control" id="address" name="photo" >
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="photo_id_proof" class="col-md-3 col-form-label text-md-right">{{ __('Photo ID Proof') }}</label>
	                            <div class="col-md-9">
	                                <input type="file" class="form-control" id="photo_id_proof" name="photo_id_proof" >
	                            </div>
	                        </div>
                            <div class="form-group row">
                                <label for="e_signature" class="col-md-3 col-form-label text-md-right">{{ __('E-Signature') }}</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" id="e_signature" name="e_signature" >
                                </div>
                            </div>
	                        <div class="modal-footer">
	                            <button type="button" class="btn btn-success" id="next1">Next</button>
	                        </div>
	                    </div>
	                </div>
                    <div id="step2" style="display: none">
                        <div class="modal-body">
                            <div class="step-title">Guarantor details</div>
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-4">
                                    @if (Auth::guest())  
                                        <input id="name" type="text" class="form-control"  name="name" value="" placeholder="jhon">
                                    @else
                                        <input id="name" type="text" class="form-control"  name="name" value="{{ Auth::user()->name}}" placeholder="Firstname">
                                    @endif
                                </div>
                                 <div class="col-md-4">
                                    @if (Auth::guest())  
                                        <input id="last_name" type="text" class="form-control"  name="last_name" value="" placeholder="jhon">
                                    @else
                                        <input id="last_name" type="text" class="form-control"  name="last_name" value="{{ Auth::user()->last_name}}" placeholder="Lastname">
                                    @endif
                                   <!--  <input class="form-control" name="name" type="text" value="" placeholder="Name"> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    @if (Auth::guest())  
                                        <input id="m_email" type="email" class="form-control"  name="email" value="" placeholder="jhon@gmail.com" status="false">
                                    @else
                                        <input id="m_email" type="email" class="form-control"  name="email" value="{{ Auth::user()->email}}" placeholder="jhon@gmail.com" status="true">
                                    @endif
                                    <span id="m_email_varification_message"></span>
                                </div>
                                <div class="col-md-3">
                                    <span id="m_email_confirmation_message"></span>
                                </div>
                            </div> 
                            <div class="form-group row" id="m_Email_confirmation">
                                <label for="email_token" class="col-md-3 col-form-label text-md-right">{{ __('Enter Token') }}</label>
                                <div class="col-md-6">
                                    <input id="m_email_token" type="text" class="form-control"  name="email_token" value="" status="false">
                                </div>
                                <div class="col-md-3">
                                    <span id="m_email_token_confirmation_message"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                <div class="col-md-4">
                                    <input id="m_phone_number" type="text" class="form-control"  name="phone_number" value="" placeholder="+911234567890" status="false">
                                    <span id="m_phone_number_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <span id="m_send_otp" class="">Send OTP</span>
                                </div>
                                <div class="col-md-3">
                                    <span id="m_confirmation_message"></span>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="enter_otp" class="col-md-3 col-form-label text-md-right">{{ __('Enter OTP') }}</label>
                                <div class="col-md-4">
                                    <input id="m_enter_otp" type="text" class="form-control"  name="enter_otp" value="" placeholder="Enter OTP">
                                </div>
                                <div class="col-md-3">
                                    <span id="m_otp_confirmation_message"></span>
                                </div>
                            </div> 
                            <div class="form-group row" id="m_email_section" style="display: none;"> 
                                <label for="email" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-9" id="m_email_section1" >
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="m_confirmation_code" name="confirmation_code" placeholder="Enter Token">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn-success form-control" id="m_verify_email">Verify Email</button>
                                    </div>
                                    <span class="help-block" id="m_email_verify_error" style="display: none;">
                                    </span>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('address') }}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-md-3 col-form-label text-md-right">{{ __('Photo') }}</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" id="address" name="photo" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo_id_proof" class="col-md-3 col-form-label text-md-right">{{ __('Photo ID Proof') }}</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" id="photo_id_proof" name="photo_id_proof" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="back_step1">Back</button>
                                <button type="button" class="btn btn-success" id="next2">Next</button>
                            </div>
                        </div>
                    </div>
                    <div id="step3" style="display: none">
	                    <div class="modal-body">
	                    	<div class="step-title">Contract details</div>
	                        <div class="form-group row">
		                        <label for="contract_type" class="col-md-3 col-form-label text-md-right">Contract Type</label>
		                        <div class="col-md-9">
		                            <select id="contract_type" type="text" class="form-control green" name="contract_type" value="" aria-invalid="false"> 
		                                    <option value="Commercial">Commercial</option>                    
		                                    <option value="Residential">Residential</option>                    
		                            </select>
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="contract_type" class="col-md-3 col-form-label text-md-right">Starting Date</label>
		                        <div class="col-md-9">
		                            <input type="date" class="form-control" id="starting_date" name="starting_date" placeholder="Starting Date">
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="contract_type" class="col-md-3 col-form-label text-md-right">End Date</label>
		                        <div class="col-md-9">
		                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date">
		                        </div>
		                    </div>
	                        <div class="modal-footer">
	                        	<button type="button" class="btn btn-success" id="back_step2">Back</button>
                                <button type="button" class="btn btn-success" id="next3">Next</button>
	                        </div>
	                    </div>
                	</div>
                	<div id="step4" style="display: none">
	                    <div class="modal-body">
	                    	<div class="step-title">Payment details</div>
		                    <div class="form-group row">
		                        <label for="rent" class="col-md-3 col-form-label text-md-right">Rent</label>
		                        <div class="col-md-9">
		                            $2000
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Cost Provision</label>
		                        <div class="col-md-9">
		                            $1000
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Deposit</label>
		                        <div class="col-md-9">
		                            $20000
		                        </div>
		                    </div>
		                    <div class="form-group row">
		                        <label for="deposit" class="col-md-3 col-form-label text-md-right">Total Ammount</label>
		                        <div class="col-md-9">
		                            $23000
		                        </div>
		                    </div>
	                        <div class="modal-footer">
	                        	<button type="button" class="btn btn-success" id="back_step3">Back</button>
                                <button type="button" class="btn btn-success" id="next4">Next</button>
	                        </div>
	                    </div>
                	</div>
                	<div id="step5" style="display: none">
	                    <div class="modal-body">
	                    	<div class="step-title">Make Payment</div>
		                    <div class="row">
		                    	<div class="col-sm-12">
		                    		<div class="make_payment">
		                    			<button type="button" class="btn btn-primary">
                                	   		Pay $23000 with <img src="http://122.160.138.253:8080/property/public/images/Paypal-button.png">
                                		</button> or
                                		<button type="button" class="btn btn-primary">
                                	   		Pay $23000 using <img src="http://122.160.138.253:8080/property/public/images/bank-transfer.png">
                                		</button>
		                    		</div>
		                    	</div>
		                    </div>
	                        <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="back_step4">Back</button>
                                <!-- <button type="button" class="btn btn-success" id="next5">Next</button>
	                        	<button type="button" class="btn btn-success" id="back_step3">Back</button> -->
	                            <!-- <button type="submit" class="btn btn-success" id="next4">Next</button> -->
	                        </div>
	                    </div>
                	</div>
                </form>
            </div>
        </div>
    </div>
</main>
<style type="text/css">
        .active1{
            background-color: #f28201 !important;
            color: white !important;
        }
    	.make_payment img {width: 100px; height: 35px; }
    	.tenant_type_main input {width: 15px; display: inline-block; height: 14px; box-shadow: none; }
    	input#tenant_type2 {margin-left: 15px; }

    	.make_payment {margin: 0 auto; text-align: center; padding: 15px 0 30px; }
    	.modal-title {color: #f28401; }
    	.step-title {text-align: left; font-size: 20px; padding: 10px 0; }
        .property_images img {width: 473px; }
        .property_description .title ,.property_map_view .title {font-size: 20px; font-weight: bold; color: #ff8500;     padding: 10px 0;}
        .property_description-body span {font-size: 16px; font-weight: bold; padding-right: 10px; }
        .property_description-body {margin: 20px 10px; }
        .property_description-body div {padding: 5px 0; }
        .property-action {text-align: center; width: 100%; float: left; margin: 20px 0;}
        .property-action button {text-decoration: none; padding: 10px; width: 100%; font-size: 14px; background-color: #f28401; color: #fff; border-radius: 5px; border: 0; }
        .main { margin-bottom: 10%; }
        .mb-3, .my-3 { margin-bottom: 1rem !important; }
        .mt-3, .my-3 { margin-top: 1rem !important;}
        .f400 { font-weight: 400 !important; }
        .f30 { font-size: 30px !important; }
        .color-gray { color: rgba(0, 0, 0, 0.6) !important; }
        .f500 {    font-weight: 500 !important; }
        .mb-4, .my-4 {    margin-bottom: 1.5rem!important; }
        .f500 {    font-weight: 500 !important; }
        .mt-4, .my-4 {    margin-top: 1.5rem!important;}
        .bg-color {    background-color: #f1f1f1 !important;}
        .row { display: flex;flex-wrap: wrap;margin-right: -15px;margin-left: -15px; }
        .f300 { font-weight: 300 !important;}
        .f15 { font-size: 15px !important; }
        .mb-2, .my-2 { margin-bottom: .5rem!important; }
        .mt-2, .my-2 {   margin-top: .5rem!important; }
        span#send_otp ,span#m_send_otp{background-color: #DDDDDD; padding: 8px 4px; font-size: 13px; border-radius: 3px; position: absolute; cursor: pointer; }
        span#phone_number_error {color: red; }
        #Email_confirmation,#m_Email_confirmation{display:none;}
        .property_description {margin-top: 50px; }
        .property_info .title {font-size: 24px; color: #f28401; }
        .property_info .location {padding: 15px 0; }
        .property_info .location span {font-weight: bold; padding-right: 10px; }
        .extra_info .rent_info span,.extra_info .facility_info span {font-weight: bold; padding-right: 10px; }
        .extra_info {width: 100%; float: left; }
        .extra_info .rent_info ,.extra_info .facility_info{width: 50%; float: left;     padding: 4px 0; }
        .extra_info .facility_title, .extra_info .amenities_title {font-size: 25px; padding-top: 10px; }
        .extra_info .amenities_info {font-weight: bold; padding: 4px 0; }
        .property_map_view iframe {border: 0; }
        .section {border-top: 2px solid #f1f1f1; margin-top: 10px; }
        .location a span {color: #f28401; }


        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span {font-size: 15px; font-weight: bold; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .unit-meter-title {font-size: 24px; margin-top: 15px; }
        .unit-title {font-size: 24px;     margin-top: 25px; }
        .unit span {font-weight: bold; }
        .unit.vendor_list ul li ul li {width: 35%; display: inline-block; padding: 3px 0; }
        .unit.vendor_list ul ul {margin: 15px 0; padding: 0; }
        .unit.vendor_list ul {list-style-type: decimal; }
        .tab-pane {padding: 15px 0; }
        ul.nav.nav-tabs {padding: 30px 0 0; }
        ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
        ul.nav.nav-tabs li {padding: 0 5px; }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
        ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
        .carousel-inner {    height: 350px; }
        .flexslider {margin: 0 }
        .content {width: 100%; word-break: break-all; }
        .flex-next{position: absolute; top: 33%; right: 0; z-index: 999; }
        .flex-prev {position: absolute; top: 33%; left: 0; z-index: 999; }
        @media only screen and (max-width: 767px) {
            ul.nav.nav-tabs li {padding: 15px 5px 0; }
        }
    </style>    
    <script type="text/javascript">
    var date = new Date();
    var date_format = '{!! \Helper::DateTimeFormat() !!}';
    $('.form_datetime').datetimepicker({
        format: date_format, 
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate: date
    });
    $(document).ready(function(){
    	jQuery('#next1').click(function(){
    		jQuery('#step2').show();
    		jQuery('#step1').hide();
    	});
    	jQuery('#back_step1').click(function(){
    		jQuery('#step1').show();
    		jQuery('#step2').hide();
    	});

    	jQuery('#next2').click(function(){
    		jQuery('#step3').show();
    		jQuery('#step2').hide();
    	});
    	jQuery('#back_step2').click(function(){
    		jQuery('#step2').show();
    		jQuery('#step3').hide();
    	});
    	jQuery('#next3').click(function(){
    		jQuery('#step4').show();
    		jQuery('#step3').hide();
    	});
    	jQuery('#back_step3').click(function(){
    		jQuery('#step3').show();
    		jQuery('#step4').hide();
    	});
        jQuery('#next4').click(function(){
            jQuery('#step5').show();
            jQuery('#step4').hide();
        });
        jQuery('#back_step4').click(function(){
            jQuery('#step4').show();
            jQuery('#step5').hide();
        });
    	jQuery('.tenant_type_main input').click(function(){
    		if($('#tenant_type2').is(':checked')) { 
    			jQuery('.company_body').show();
    		} else {
    			jQuery('.company_body').hide();
    		}
    	});

        $('#send_otp').click(function(){
            $('#phone_number_error').text('');
            $('#confirmation_message').text('');
            var phoneNumber = $('#phone_number').val();
            phone = phoneNumber.replace(/[^0-9]/g,'');
            if(phoneNumber == ''){                   
                $('#phone_number_error').text('Please enter  number');
            } else if(phone.length == 10){                   
                $('#phone_number_error').text('Please enter number with country code');
            } else if(phoneNumber.length != 12) {
                $('#phone_number_error').text('Please enter a valid number');
            } else if(phone.length != 12 || phone.length > 12){                   
                $('#phone_number_error').text('Please enter a valid number');
            } else {
                $.ajax({
                    url: "{{ url('/send-otp') }}",
                    type: "POST",
                    data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'phone_number':phone
                    },
                    success: function(data){
                        $('#confirmation_message').html(data);
                    }
                });
            }
        })

        $('#m_send_otp').click(function(){
            $('#m_phone_number_error').text('');
            $('#m_confirmation_message').text('');
            var phoneNumber = $('#m_phone_number').val();
            phone = phoneNumber.replace(/[^0-9]/g,'');
            if(phoneNumber == ''){                   
                $('#m_phone_number_error').text('Please enter  number');
            } else if(phone.length == 10){                   
                $('#m_phone_number_error').text('Please enter number with country code');
            } else if(phoneNumber.length != 12) {
                $('#m_phone_number_error').text('Please enter a valid number');
            } else if(phone.length != 12 || phone.length > 12){                   
                $('#m_phone_number_error').text('Please enter a valid number');
            } else {
                $.ajax({
                    url: "{{ url('/send-otp') }}",
                    type: "POST",
                    data: {'_token':'<?php echo csrf_token() ?>','phone_number':phone},
                    success: function(data){
                        $('#m_confirmation_message').html(data);
                    }
                });
            }
        })
        $('#enter_otp').blur(function(){
            $.ajax({
                url: "{{ url('/verify-otp') }}",
                type: "POST",
                data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'opt':$('#enter_otp').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#otp_confirmation_message').html(data.message).css('color','green');
                       $('#phone_number').attr('status','true');
                    }
                    if(data.status == 'false'){
                        $('#phone_number').attr('status','false');
                        $('#otp_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });
        $('#m_enter_otp').blur(function(){
            $.ajax({
                url: "{{ url('/verify-otp') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','opt':$('#m_enter_otp').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#m_otp_confirmation_message').html(data.message).css('color','green');
                       $('#m_phone_number').attr('status','true');
                    }
                    if(data.status == 'false'){
                        $('#m_phone_number').attr('status','false');
                        $('#m_otp_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });
        $('#email').blur(function(){
            $('#email_confirmation_message,#email_varification_messag').html('');
            var verify = '{{ $VerifyEmail }}';
            if(verify == 1) {
                $('#email_confirmation_message').html('Verified!').css('color','green');
                $('#email').attr('status','true');
                $('#email_varification_message,#Email_confirmation').hide();
                return false;
            }
            else {
                $.ajax({
                    url: "{{ url('/verify-visiter-email') }}",
                    type: "POST",
                    data: {
                            '_token':'<?php echo csrf_token() ?>',
                            'email':$('#email').val()
                            },
                    success: function(data){
                        if(data.status == 'true'){
                           $('#email_confirmation_message').html(data.message).css('color','green');
                           $('#email').attr('status','true');
                           $('#email_varification_message,#Email_confirmation').hide();
                        }
                        if(data.status == 'sent'){
                            $('#email').attr('status','false');
                            $('#Email_confirmation,#email_varification_message').show();
                            $('#email_varification_message').html(data.message).css('color','red');
                        }
                    }
                });
            }
        });
        $('#m_email').blur(function(){
            $('#m_email_confirmation_message,#m_email_varification_messag').html('');
            var verify = '{{ $VerifyEmail }}';
            if(verify == 1) {
                $('#m_email_confirmation_message').html('Verified!').css('color','green');
                $('#m_email').attr('status','true');
                $('#m_email_varification_message,#m_Email_confirmation').hide();
                return false;
            }
            else {
                $.ajax({
                    url: "{{ url('/verify-visiter-email') }}",
                    type: "POST",
                    data: {'_token':'<?php echo csrf_token() ?>','email':$('#m_email').val()},
                    success: function(data){
                        if(data.status == 'true'){
                           $('#m_email_confirmation_message').html(data.message).css('color','green');
                           $('#m_email').attr('status','true');
                           $('#m_email_varification_message,#m_Email_confirmation').hide();
                        }
                        if(data.status == 'sent'){
                            $('#m_email').attr('status','false');
                            $('#m_Email_confirmation,#m_email_varification_message').show();
                            $('#m_email_varification_message').html(data.message).css('color','red');
                        }
                    }
                });
            }
        });

        $('#email_token').blur(function(){
            $('#email_confirmation_message,#email_varification_messag').html('');
            $.ajax({
                url: "{{ url('/verify-email-token') }}",
                type: "POST",
                data: {
                        '_token':'<?php echo csrf_token() ?>',
                        'email':$('#email').val(),
                        'confirmation_code':$('#email_token').val()
                },
                success: function(data){
                    if(data.status == 'true'){
                       $('#email_token_confirmation_message').html(data.message).css('color','green');
                       $('#email').attr('status','true');
                       $('#email_varification_message').hide();
                    }
                    if(data.status == 'false'){
                        $('#email').attr('status','false');
                        $('#Email_confirmation').show();
                        $('#email_token_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });

        $('#m_email_token').blur(function(){
            $('#m_email_confirmation_message,#m_email_varification_messag').html('');
            $.ajax({
                url: "{{ url('/verify-email-token') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','email':$('#m_email').val(),'confirmation_code':$('#m_email_token').val()},
                success: function(data){
                    if(data.status == 'true'){
                       $('#m_email_token_confirmation_message').html(data.message).css('color','green');
                       $('#m_email').attr('status','true');
                       $('#m_email_varification_message').hide();
                    }
                    if(data.status == 'false'){
                        $('#m_email').attr('status','false');
                        $('#m_Email_confirmation').show();
                        $('#m_email_token_confirmation_message').html(data.message).css('color','red');
                    }
                }
            });
        });
    });
    jQuery('#visit_booking').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            name:{
                required:true,
            },
            email:{
                required:true,
                email:true
            },
            phone_number:{
                required:true,
                number:true
            },
            enter_otp:{
                required:true,
                number:true
            },
            time:{
                required:true,
                //number:true
            },
            description:{
                required:true,
            },
            title:{
                required:true,
            }
        },   
    });
    jQuery('#send_message_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            name:{
                required:true,
            },
            email:{
                required:true,
                email:true
            },
            phone_number:{
                required:true,
                number:true
            },
            enter_otp:{
                required:true,
                number:true
            },
            message:{
                required:true
            }
        },   
    });
    jQuery('#visit_booking').submit(function(){
        if( $('#email').attr('status') != 'true' && $('#email').attr('status') != '' && $('#email').val() != ''){
            $('#email_varification_message').html('Email not verified').css('color','red');
            return false;
        }
        if( $('#phone_number').attr('status') != 'true' && $('#phone_number').attr('status') != '' && $('#phone_number').val() != ''){
            $('#otp_confirmation_message').html('Enter valid OTP').css('color','red');
            return false
        }
    });
    jQuery('#send_message_form').submit(function(){
        if( $('#m_email').attr('status') != 'true' && $('#m_email').attr('status') != '' && $('#m_email').val() != ''){

            $('#m_email_varification_message').html('Email not verified').css('color','red');
            return false;
        }
        if( $('#m_phone_number').attr('status') != 'true' && $('#m_phone_number').attr('status') != '' && $('#m_phone_number').val() != ''){
            $('#m_otp_confirmation_message').html('Enter valid OTP').css('color','red');
            return false
        }
    });
    </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        customDirectionNav: $(this).find('.nav-carousel a'),
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        customDirectionNav: $(this).find('.nav-slider a'),
        sync: "#carousel",
        // start: function(slider){
        //   $('body').removeClass('loading');
        // }
      });
    });
    $(document).ready(function() {
        $(".fancybox").fancybox({
            maxWidth    : 700,
            maxHeight   : 800,
            fitToView   : false,
            width       : '70%',
            height      : '70%',
            autoSize    : false,
            closeClick  : false,
            openEffect  : 'none',
            closeEffect : 'none',
            
        });
    });
    
  $("#des").click(function(){
    $(".active1").removeClass("active1");
    $("#des").addClass("active1");  
  });

  $("#pre").click(function(){
    $(".active1").removeClass("active1");
    $("#pre").addClass("active1");  
  });

  $("#rul").click(function(){
    $(".active1").removeClass("active1");
    $("#rul").addClass("active1");  
  });

 $("#cont").click(function(){
    $(".active1").removeClass("active1");
    $("#cont").addClass("active1");  
  });
    
  </script>

@endsection