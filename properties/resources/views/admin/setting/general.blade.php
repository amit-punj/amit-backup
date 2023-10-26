@extends('admin.layouts.app')

@section('content')

<div id="edit_profile">
	<ul class="breadcrumb">
	  <li><a href="#">Home</a></li>                    
	  <li class="active">General Setting</li>
	</ul>
	<div class="page-content-wrap">

		<div class="row">
		  <div class="col-md-12">
		    <h2>General</h2>
		    @if(Session::has('flash_message_error'))    
		        <div class="alert alert-danger alert-block">
		            <button type="button" class="close" data-dismiss="alert">×</button> 
		                <strong>{!! session('flash_message_error') !!}</strong>
		        </div>
		    @endif 
		    @if(Session::has('flash_message_success'))    
		        <div class="alert alert-success alert-block">
		            <button type="button" class="close" data-dismiss="alert">×</button> 
		                <strong>{!! session('flash_message_success') !!}</strong>
		        </div>
		    @endif 
		  </div>
		</div>

		<div class="content-main-edit">
			<div class="row well">
				<div class="col-md-12">
			        
					<ul class="nav nav-tabs" id="myTab" style="margin-top: 0;">
						<li class="active" ><a data-toggle="tab" href="#site">Site Detail</a></li>
						<li><a data-toggle="tab" href="#admin">Admin Address</a></li>
						<li><a data-toggle="tab" href="#smtp">SMTP Details</a></li>
						<li><a data-toggle="tab" href="#contactus">Contact Us</a></li>
					</ul>
					<div class="tab-content">
					    <div id="site" class="tab-pane active">
							<form class="form-horizontal" method="post" action="{{ url('/admin/general') }}" name="basic_validate" id="site-form" novalidate="novalidate" enctype="multipart/form-data">{{ csrf_field() }}
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Site Title</label>
					                <div class="col-sm-10">
					                	<input type="text" name="site_title" class="form-control" id="site_title" value="{{ (!empty($getData))?$getData->title:'' }}">
					                	@if ($errors->has('site_title'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('site_title') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            @if(!empty($getData))
					            	@if($getData->logo)
							            <div class="form-group row">
							                <label class="col-sm-2 control-label">Uploaded Logo Image</label>
							                <div class="col-sm-10">
							                	<img width="200" src="{{ url('').'/images/'.$getData->logo }}">
							                </div>
							            </div>
							        @endif    
					            @endif
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Site Logo</label>
					                <div class="col-sm-10">
					                	<input type="file" name="file_image" id="file_image" class="form-control">
					                	@if ($errors->has('file_image'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('file_image') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            @if(!empty($getData))
					            	@if($getData->site_video)
							            <div class="form-group row">
							                <label class="col-sm-2 control-label">Uploaded Site Video</label>
							                <div class="col-sm-10">
							                	<video width="320" height="240" controls autoplay>
												  <source src="{{ asset('video/'.$getData->site_video) }}" type="video/mp4">
												</video>
							                </div>
							            </div>
							        @endif    
					            @endif
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Site Video</label>
					                <div class="col-sm-10">
					                	<input type="file" name="site_video" id="site_video" class="form-control">
					                	@if ($errors->has('site_video'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('site_video') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Instagram Link</label>
					                <div class="col-sm-10">
					                	<input type="text" name="instagram" class="form-control" id="instagram" value="{{ (!empty($getData))?$getData->instagram:'' }}">
					                	@if ($errors->has('instagram'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('instagram') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Twitter Link</label>
					                <div class="col-sm-10">
					                	<input type="text" name="twitter" class="form-control" id="twitter" value="{{ (!empty($getData))?$getData->twitter:'' }}">
					                	@if ($errors->has('twitter'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('twitter') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Facebook Link</label>
					                <div class="col-sm-10">
					                	<input type="text" name="facebook" class="form-control" id="facebook" value="{{ (!empty($getData))?$getData->facebook:'' }}">
					                	@if ($errors->has('facebook'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('facebook') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>

					            <div class="form-actions pull-right">
					              <input type="submit" value="Save" id="siteSave" name="siteSave" class="btn btn-success">
					            </div>
					        </form>
					    </div>
					    <div id="admin" class="tab-pane">
					    	<form class="form-horizontal" method="post" action="{{ url('/admin/general') }}#admin" name="basic_validate" id="admin-form" novalidate="novalidate">{{ csrf_field() }}
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Email</label>
					                <div class="col-sm-10">
					                	<input type="email" name="admin_email" class="form-control" id="admin_email" value="{{ (!empty($getData))?$getData->admin_email:'' }}">
					                	@if ($errors->has('admin_email'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('admin_email') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Address Line 1</label>
					                <div class="col-sm-10">
					                	<textarea class="form-control" name="address_line1" id="address_line1">{{ (!empty($getData))?$getData->address_line_1:'' }}</textarea>
					                	@if ($errors->has('address_line1'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('address_line1') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Address Line 2</label>
					                <div class="col-sm-10">
					                	<textarea class="form-control" name="address_line2" id="address_line2">{{ (!empty($getData))?$getData->address_line_2:'' }}</textarea>
					                	@if ($errors->has('address_line2'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('address_line2') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					           <!--  <div class="form-group row">
					                <label class="col-sm-2 control-label">City</label>
					                <div class="col-sm-10">
					                	<input type="text" name="city" class="form-control" id="city" value="{{ (!empty($getData))?$getData->city:'' }}">
					                	@if ($errors->has('city'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('city') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Country</label>
					                <div class="col-sm-10">
					                	<input type="text" name="country" class="form-control" id="country" value="{{ (!empty($getData))?$getData->country:'' }}">
					                	@if ($errors->has('country'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('country') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">State</label>
					                <div class="col-sm-10">
					                	<input type="text" name="state" class="form-control" id="state" value="{{ (!empty($getData))?$getData->state:'' }}">
					                	@if ($errors->has('state'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('state') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div> -->
					            <div class="form-group row">
					                <label class="col-sm-2 control-label title">Select Country:</label>
					                <div class="col-sm-10">
						                @if($countries)
							                <select class="form-control" id="country" name="country">
							                	<option value="" selected="selected">Select</option>
							                	@foreach($countries as $count)
							                		<option value="{{  $count->id }}" {{ ($getData->country == $count->id)?'selected':'' }}>{{  $count->name }}</option>
							                	@endforeach
							                </select>
						               	@endif
						               	@if ($errors->has('country'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('country') }}</strong>
				                            </span>
				                        @endif
				                    </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label title">Select State:</label>
					                <div class="col-sm-10">
						                <select name="state" data-selected="{{ (!empty($getData))?$getData->state:'' }}" id="state" class="form-control">
						                </select>
						                @if ($errors->has('state'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('state') }}</strong>
				                            </span>
					                    @endif
					                </div>
					            </div>
					         
					            <div class="form-group row">
					                <label class="col-sm-2 control-label title">Select City:</label>
					                <div class="col-sm-10">
						                <select name="city" id="city" data-selected="{{ (!empty($getData))?$getData->city:'' }}" class="form-control">
						                </select>
						                @if ($errors->has('city'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('city') }}</strong>
				                            </span>
				                        @endif
				                    </div>
					            </div>

					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Postcode/Zipcode</label>
					                <div class="col-sm-10">
					                	<input type="text" name="postcode" class="form-control" id="postcode" value="{{ (!empty($getData))?$getData->postcode:'' }}">
					                	@if ($errors->has('postcode'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('postcode') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>

					            <div class="form-actions pull-right">
					              <input type="submit" value="Save" id="adminSave" name="adminSave" class="btn btn-success">
					            </div>
					        </form>
					    </div>
					    <div id="smtp" class="tab-pane">
					   		<form class="form-horizontal" method="post" action="{{ url('/admin/general') }}#smtp" name="basic_validate" id="smtp-form" novalidate="novalidate">{{ csrf_field() }}
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">SMTP Host</label>
					                <div class="col-sm-10">
					                	<input type="text" name="smtp_host" class="form-control" id="smtp_host" value="{{ (!empty($getData))?$getData->smtp_host:'' }}">
					                	@if ($errors->has('smtp_host'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('smtp_host') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">SMTP Port</label>
					                <div class="col-sm-10">
					                	<input type="text" name="smtp_port" class="form-control" id="smtp_port" value="{{ (!empty($getData))?$getData->smtp_port:'' }}">
					                	@if ($errors->has('smtp_port'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('smtp_port') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">SMTP Protocol</label>
					                <div class="col-sm-10">
					                	<select name="smtp_protocol" id="smtp_protocol" class="form-control">
						                    <option 
						                  		@if(!empty($getData))
						                  			{{ ($getData->smtp_protocol == 'ON')?'selected="selected"':'' }}
						                  		@endif
						                  		value="ON">ON </option>
						                    <option 
						                    	@if(!empty($getData))
						                  			{{ ($getData->smtp_protocol == 'OFF')?'selected="selected"':'' }}
						                  		@endif
						                  		value="OFF">OFF </option>
						                </select>
					                	@if ($errors->has('smtp_protocol'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('smtp_protocol') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">SMTP Username</label>
					                <div class="col-sm-10">
					                	<input type="text" name="smtp_username" class="form-control" id="smtp_username" value="{{ (!empty($getData))?$getData->smtp_username:'' }}">
					                	@if ($errors->has('smtp_username'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('smtp_username') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">SMTP Password</label>
					                <div class="col-sm-10">
					                	<input type="text" name="smtp_password" class="form-control" id="smtp_password" value="{{ (!empty($getData))?$getData->smtp_password:'' }}">
					                	@if ($errors->has('smtp_password'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('smtp_password') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            
					            <div class="form-actions pull-right">
					              <input type="submit" value="Save" name="smtpSave" id="smtpSave" class="btn btn-success">
					            </div>
					        </form>
					    </div>
					    <div id="contactus" class="tab-pane">
					    	<form class="form-horizontal" method="post" action="{{ url('/admin/general') }}#contactus" name="basic_validate" id="smtp-form" novalidate="novalidate">{{ csrf_field() }}
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Facebook App ID</label>
					                <div class="col-sm-10">
					                	<input type="text" name="fb_app_id" class="form-control" id="fb_app_id" value="{{ (!empty($getData))?$getData->fb_appID:'' }}">
					                	@if ($errors->has('fb_app_id'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('fb_app_id') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Facebook Secret Key</label>
					                <div class="col-sm-10">
					                	<input type="text" name="fb_secret_key" class="form-control" id="fb_secret_key" value="{{ (!empty($getData))?$getData->fd_secretKey:'' }}">
					                	@if ($errors->has('fb_secret_key'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('fb_secret_key') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Stripe App ID</label>
					                <div class="col-sm-10">
					                	<input type="text" name="st_app_id" class="form-control" id="st_app_id" value="{{ (!empty($getData))?$getData->stripe_appID:'' }}">
					                	@if ($errors->has('st_app_id'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('st_app_id') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Stripe Secret Key</label>
					                <div class="col-sm-10">
					                	<input type="text" name="st_secret_key" class="form-control" id="st_secret_key" value="{{ (!empty($getData))?$getData->stripe_secretKey:'' }}">
					                	@if ($errors->has('st_secret_key'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('st_secret_key') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            <div class="form-group row">
					                <label class="col-sm-2 control-label">Email</label>
					                <div class="col-sm-10">
					                	<input type="text" name="email" class="form-control" id="email" value="{{ (!empty($getData))?$getData->email:'' }}">
					                	@if ($errors->has('email'))
				                            <span class="help-inline">
				                                <strong>{{ $errors->first('email') }}</strong>
				                            </span>
				                        @endif
					                </div>
					            </div>
					            
					            <div class="form-actions pull-right">
					              <input type="submit" value="Save" id="socialSave" name="socialSave" class="btn btn-success">
					            </div>
					        </form>
					    </div>
				    </div>

		    	</div>
		  	</div>
		</div> 

	</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">

	$('#myTab a').click(function(e) {
	  e.preventDefault();
	  $(this).tab('show');
	});

	// store the currently selected tab in the hash value
	$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
	  var id = $(e.target).attr("href").substr(1);
	  window.location.hash = id;
	});

	// on load of the page: switch to the currently selected tab
	var hash = window.location.hash;
	$('#myTab a[href="' + hash + '"]').tab('show');

</script>
<script type="text/javascript">
	$(document).ready(function(){
		var countryID = $('#country').val();   
		if(countryID)
		{
			$.ajax({
	           type:"GET",
	           url:"{{url('api/save_setting')}}",
	           success:function(res){               
	            	if(res['state'] != '')
	            	{
	            		var state_id = $('#state').attr('data-selected');
	            		$.ajax({
				           type:"GET",
				           url:"{{url('api/get-state-list')}}?country_id="+countryID,
				           success:function(res){               
				            if(res){
				                $("#state").empty();
				                $("#state").append('<option>Select</option>');
				                $.each(res,function(key,value){
				                	if(key == state_id)
				                	{
				                		$("#state").append('<option value="'+key+'" selected="selected">'+value+'</option>');
				                	}
				                	else
				                	{
				                		$("#state").append('<option value="'+key+'">'+value+'</option>');
				                	}
				                });
				           
				            }else{
				               $("#state").empty();
				            }
				           }
				        });
	            	}
	            	if(res['city'] != '')
	            	{
	            		var city_id = $('#city').attr('data-selected');
	    		        $.ajax({
				           type:"GET",
				           url:"{{url('api/get-city-list')}}?state_id="+res['state'],
				           success:function(res){               
				            if(res){
				                $("#city").empty();
				                $.each(res,function(key,value){
				                	if(key == city_id)
				                	{
				                		$("#city").append('<option value="'+key+'" selected="selected">'+value+'</option>');
				                	}
				                	else
				                	{
				                		$("#city").append('<option value="'+key+'">'+value+'</option>');
				                	}
				                });
				           
				            }else{
				               $("#city").empty();
				            }
				           }
				        });
	            	}
	           }
	        });
		}
	});


    $('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-state-list')}}?country_id="+countryID,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-city-list')}}?state_id="+stateID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
</script>

@endsection

