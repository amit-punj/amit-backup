@extends('admin.layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Create Tour
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form  action="{{ url('admin/tours/create') }}" class="form-horizontal" method="post" role="form" id="create_formmcc" enctype="multipart/form-data" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tour_name" class="col-md-2">Tour Name</label>
                        <div class="col-md-10">
                            <input type="text" id="tour_name" name="tour_name" class="form-control"  placeholder="Tour Name"/>
                            @if ($errors->has('tour_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tour_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tour_owner" class="col-md-2">Tour Owner</label>
                        <div class="col-md-10">
                            <select type="text" name="tour_owner" id="tour_owner" class="form-control" >
                             @if(Auth::user()->role == 1)
                             <?php  foreach ($users as $key => $user) 
                                { ?>
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                            <?php   } ?>
                            @else
                            <?php $id = Auth::user()->id; ?>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                            @endif
                            </select>
                            @if ($errors->has('tour_owner'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tour_owner') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="center_lattitude" class="col-md-2">Center Lattitude</label>
                        <div class="col-md-10">
                            <input type="text" id="center_lattitude" name="center_lattitude" class="form-control"  placeholder="Center Lattitude"/>
                            @if ($errors->has('center_lattitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('center_lattitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="center_longitude" class="col-md-2">Center Longitude</label>
                        <div class="col-md-10">
                            <input type="text" id="center_longitude" name="center_longitude" class="form-control"  placeholder="Center Longitude"/>
                            @if ($errors->has('center_longitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('center_longitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="top" class="col-md-2">Top</label>
                        <div class="col-md-10">
                            <input type="text" id="top" name="top" class="form-control"  placeholder="Top"/>
                            @if ($errors->has('top'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('top') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="right" class="col-md-2">Right</label>
                        <div class="col-md-10">
                            <input type="text" id="right" name="right" class="form-control"  placeholder="Right"/>
                            @if ($errors->has('right'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('right') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bottom" class="col-md-2">Bottom</label>
                        <div class="col-md-10">
                            <input type="text" id="bottom" name="bottom" class="form-control"  placeholder="Bottom"/>
                            @if ($errors->has('bottom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bottom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="left" class="col-md-2">Left</label>
                        <div class="col-md-10">
                            <input type="text" id="left" name="left" class="form-control"  placeholder="Left"/>
                            @if ($errors->has('left'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('left') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="minimum_zoom" class="col-md-2">Minimum Zoom</label>
                        <div class="col-md-10">
                            <select type="text" name="minimum_zoom" id="minimum_zoom" class="form-control" >
                                <option value="13" selected="">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                            </select>
                            @if ($errors->has('minimum_zoom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('minimum_zoom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="maximum_zoom" class="col-md-2">Maximum Zoom</label>
                        <div class="col-md-10">
                            <select type="text" name="maximum_zoom" id="maximum_zoom" class="form-control" >
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16" selected="">16</option>
                            </select>
                            @if ($errors->has('maximum_zoom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('maximum_zoom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group" id="variations_div">
                        <label for="variations" class="col-md-2">Variations <button type="button" onclick="javascript:addRow()" class="btn btn-primary btn-bg ">Add New <i class="fa fa-plus" style="color:black"></i></button></label>                   
                    </div>
                    <div class="col-md-12" id="message" style="display: none;color: red;"></div>
                    <div class="variation_data" id="variation_data">
                    </div>
                    <div class="form-group" id="poi_div">
                        <label for="poi" class="col-md-2">POI's <button type="button" onclick="javascript:AddPoi()" class="btn btn-primary btn-bg">Add New <i class="fa fa-plus" style="color:black"></i></button></label>
                        <input type="hidden" name="location_line_id" id="location_line_id">
                    </div>
                    <div class="col-md-12" id="poi_message" style="display: none;color: red;"></div>
                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password" class="form-control" id="set_password">
                                <option value="" >{{ __('Set Password') }}</option>
                                <option value="constant" @if(old("tour_control") == "constant") selected="selected" @endif >{{ __('Constant') }}</option>
                                <option value="temporary" @if(old("tour_control") == "temporary") selected="selected" @endif >{{ __('Temporary')  }}</option> 
                            </select>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-10" id="password_div" style="display: none;">
                            <select type="text" name="password_type" class="form-control" id="password_type">';
                                <option value="month" >{{ __("Month") }}</option>
                                <option value="week" >{{ __("Week")  }}</option> 
                                <option value="day" >{{ __("Day")  }}</option> 
                                <!-- <option value="timezone" >{{ __("TimeZone")  }}</option> -->
                            </select>
                            <input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="tour_control" class="col-md-2 required">Tour Control</label>
                        <div class="col-md-10">
                            <select type="text" name="tour_control" class="form-control" id="tour_control">
                                <option value="yes" @if(old("tour_control") == "yes") selected="selected" @endif >{{ __('Yes') }}</option>
                                <option value="no" @if(old("tour_control") == "no") selected="selected" @endif >{{ __('No')  }}</option> 
                            </select>
                            @if ($errors->has('tour_control'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tour_control') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
                            <button class="btn btn-info btn-block" type="submit" id="craete_idValid">Create</button>
                        </div>
                       <!--  <div class="col-md-6">
                           <a href="{{ url('admin/users') }}"><button type="button" class="btn btn-primary btn-block">Cancel</button></a>
                        </div> -->
                    </div>

                </form>

                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>
  <!-- Modal -->
  <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 900px;">
            <div id="map" style="height: 450px; width: 900px;"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div> -->

@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script type="text/javascript">
var north;
var south;
var east;
var west;
var center_lattitude;
var center_longitude;
var minimum_zoom;
var maximum_zoom;   
    function updateVariations()
    {   
        var html= '';
        $('.variation_list').each(function (index) {
            var id      = $( this ).attr('data-id');
            var name    = $( this ).attr('data-name');
            // alert(id+'===='+name);
            html += '<option value="'+id+'" >'+name+'</option>';
        });
        $('.variation_type').html(html);
    }

    function add_new(ids)
    {
        var variation_name = $("#variations_"+ids+"").val();
        if(variation_name != "")
        {            
            $("#add"+ids+"").css("pointer-events", "none");
            html = '<span class="variation_list" id="variation_list_'+ids+'" data-id="'+ids+'" data-name="'+variation_name+'" ></span>';
            $("#variation_data").append(html);
            $("#message").text('Variation Add Successfully');
            $("#message").css("display",'flex');
            updateVariations();
        }
        else if(variation_name == "")
        {
            $("#message").text('Variation Name cannot be empty');
            $("#message").css("display",'flex');
        }
    }

var add_row= 0;
function addRow()
    {
        html='';
        html+=' <div class="col-md-12" id="main_div_'+add_row+'" style="display: flex; margin-bottom: 5px;">';
        html += '<input type="hidden" name="variation_id['+add_row+']" id="variation_id_'+add_row+'" value="">'; 
        html+='     <div class="col-md-6" id="">'; 
        html += '    <input type="text" name="variations['+add_row+']" id="variations_'+add_row+'" class="form-control variations_name"  placeholder="Variation Name"/>';  
        html += '   </div>';
        // html +='    <div class="col-md-4">';
        // html +='        <select type="text" name="language['+add_row+']" class="form-control" id="language_'+add_row+'">';
        // html +='            <option value="english" >{{ __('English') }}</option>';
        // html +='            <option value="dutch" >{{ __('Dutch') }}</option>';
        // html +='            <option value="french" >{{ __('French') }}</option>'; 
        // html +='        </select>';
        // html +='    </div>';
        html +='    <div class="col-md-2">';
        html +='       <a href="javascript:void(0)" id="add'+add_row+'" onclick="javascript:add_new('+add_row+')" class=" btn btn-success"><i class="fa fa-save" aria-hidden="true"></i></a>';
        // html +='       <a href="javascript:void(0)" onclick="javascript:EditRow('+add_row+')"class=" btn btn-primary"><i class="fa fa-edit"></i></a>';
        html +='       <a href="javascript:void(0)" onclick="javascript:RemoveRow('+add_row+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>'; 
        html +='    </div>';
        html +=' </div>';
        html +=' <div class="col-md-12" id="message_'+add_row+'" style="display: none;color: red;"></div>';
            
        $("#variations_div").append(html);
         add_row++;
    }
$(document).ready(function(){
    $("#set_password").change(function(){
        var val = $(this).val();
        if(val != "")
        {
            if(val == "constant")
            {
                html = '<input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>';
            }
            else if(val == "temporary")
            {
                html = '';
                html +='  <select type="text" name="password_type" class="form-control" id="password_type">';
                html +='      <option value="month" >{{ __("Month") }}</option>';
                html +='      <option value="week" >{{ __("Week")  }}</option> ';
                html +='      <option value="day" >{{ __("Day")  }}</option> ';
                // html +='      <option value="timezone" >{{ __("TimeZone")  }}</option> ';
                html +='  </select>';
                html +=   '<input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>';
            }
            $("#password_div").html(html);
            $("#password_div").show();
        }
        else
        {
            $("#password_div").css('display', 'none');
        }
    });
    
});
    var image1 = "'{{ asset('images/d1.png') }}'";
    var image2 = "'{{ asset('images/d2.png') }}'";
    var image3 = "'{{ asset('images/d3.png') }}'";
    var image4 = "'{{ asset('images/d4.png') }}'";
    var add_poi=<?php echo $p = "0";?>;
    function AddPoi()
    {
        north = $('#top').val() ;
        south = $('#bottom').val() ;
        east =  $('#right').val();
        west =  $('#left').val();   

        // center_lattitude =  $('#center_lattitude').val();   
        // center_longitude =  $('#center_longitude').val();   
        if(north === "" || south === "" || east === "" || west === "" )
        {
            $("#poi_message").text("Please add Top, Right, Bottom and Left first");
            $("#poi_message").css("display",'flex');
            return false;
        }
        else
        {
            if(north > south){
                center_lattitude = north - south;
                center_lattitude = center_lattitude / 2;
                center_lattitude = parseFloat(parseFloat(center_lattitude) + parseFloat(south));
                center_lattitude = center_lattitude.toFixed(6);
            }
            else{
                center_lattitude = south - north;
                center_lattitude = center_lattitude / 2;
                center_lattitude = parseFloat(parseFloat(center_lattitude) + parseFloat(north));
                center_lattitude = center_lattitude.toFixed(6);
            }

            if(east > west)
            {
                center_longitude = east - west;
                center_longitude = center_longitude / 2;
                center_longitude = parseFloat(parseFloat(center_longitude) + parseFloat(west));
                center_longitude = center_longitude.toFixed(6);
            }
            else
            {
                center_longitude = west - east;
                center_longitude = center_longitude / 2;
                center_longitude = parseFloat(parseFloat(center_longitude) + parseFloat(east));
                center_longitude = center_longitude.toFixed(6);
            }
            $("#poi_message").text('');
            $("#poi_message").css("display",'none');
        }

        html= '';
        html +='        <div class="row" id="poi_div_'+add_poi+'">';
        html +='                <div class="col-md-12" id="main_poi_'+add_poi+'" style="display: flex;margin-bottom:5px;">';
        html +='                    <div class="col-md-3">';
        html +='        <select type="text"  name="variation_type['+add_poi+']" id="variation_type_'+add_poi+'" class="form-control variation_type" >';
        // html +='            <option value="english" >{{ __('English') }}</option>';
        // html +='            <option value="dutch" >{{ __('Dutch') }}</option>';
        // html +='            <option value="french" >{{ __('French') }}</option>'; 
        html +='        </select>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">';
        html +='                        <input type="text" name="poi_name['+add_poi+']" id="poi_name_'+add_poi+'"    value="" class="form-control poi_name"  placeholder="POI (points of interest)"/>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">';
        html +='                            <input type="hidden" name="lat['+add_poi+']" id="lat_'+add_poi+'" value="">';
        html +='                            <input type="hidden" name="long['+add_poi+']" id="long_'+add_poi+'" value="">';
        html +='                            <button type="button" data-location="'+add_poi+'" class="openModel btn btn-info"  >Set Location</button>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">';
        html +='           <select type="text" name="icon_type['+add_poi+']" id="icon_type_'+add_poi+'" class="form-control icon_type" >';
        html +='              <option value="icon1" data-class="avatar" data-style= "background-image: url('+image1+');">icon 1</option>';
        html +='              <option value="icon2" data-class="avatar" data-style= "background-image: url('+image2+');">icon 2</option>'; 
        html +='              <option value="icon3" data-class="avatar" data-style= "background-image: url('+image3+');">icon 3</option>'; 
        html +='              <option value="icon4" data-class="avatar" data-style= "background-image: url('+image4+');">icon 4</option>'; 
        html +='           </select>';
        html +='                    </div>';
        html +='                </div>';
        html +='                <div class="col-md-12" id="main_poi_'+add_poi+'" style="display: flex;">';
        html +='                    <div class="col-md-3">';
        html +='                        <select type="text" onclick="javascript:select_content('+add_poi+')" name="content_type['+add_poi+']" id="content_type_'+add_poi+'" class="form-control" >';
        html +='                            <option value="text" >{{ __("Text") }}</option>';
        html +='                            <option value="image" >{{ __("Image") }}</option>';
        html +='                            <option value="video" >{{ __("Video") }}</option>'; 
        html +='                        </select>';
        html +='                    </div>';
        html +='                    <div class="col-md-7" id="content_'+add_poi+'">';
        html +='                        <textarea name="editor['+add_poi+']" id="editor_'+add_poi+'"></textarea>';
        html +='                    </div>';
        html +='                    <div class="col-md-2">';
        // html +='                        <a href="javascript:void(0)" id="add_p'+add_poi+'" onclick="javascript:addPoi('+add_poi+')" class=" btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i></i></a>';
        html +='                    <a href="javascript:void(0)" onclick="javascript:RemovePoi('+add_poi+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>';
        html +='                    </div>';
        html +='                </div>';
        html +='          </div><br>';



        html +='<div class="modal fade" id="myModal_'+add_poi+'" role="dialog">';
        html +='    <div class="modal-dialog">';
        html +='        <div class="modal-content" style="width: 900px;">';
        html +='            <div id="map_'+add_poi+'" style="height: 450px; width: 900px;"></div>';
        html +='            <div class="modal-footer">';
        html +='              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        html +='            </div>';
        html +='        </div>';
        html +='    </div>';
        html +='</div>';

        $("#poi_div").append(html);



        CKEDITOR.replace( 'editor['+add_poi+']' );
        updateVariations();
        add_image();
        var ss = add_poi;
        setTimeout(function()
        {
            add_map(ss);
        },300);

        add_poi++;
    }

    function RemovePoi(ids)
    {        
        $("#poi_div_"+ids+"").remove();
        $("#poi_message").text("Delete Successfully");
        $("#poi_message").css("display",'flex');
    }

    function select_content(ids)
    {
        var val = jQuery("#content_type_"+ids+"").val();
        if(val == 'text')
        {
            html='<textarea name="editor['+ids+']" id="editor_'+ids+'"></textarea>';
        }
        else
        {
            html='<input type="file" onchange="javascript:image_upload('+ids+')" multiple name="pic['+ids+']" id="pic_'+ids+'" >';
        }
         $("#content_"+ids+"").html(html);
         CKEDITOR.replace( 'editor['+ids+']' );
    }

    function image_upload(ids)
    {
        var content_type    = $("#content_type_"+ids+"").val();
        var files = $('#pic_'+ids+'').prop('files')[0]
        var error = '';
        var name = files.name;
        var extension = name.split('.').pop().toLowerCase();
        if(content_type == "image")
        {
            var array = ['png'];
        }
        else if(content_type == "video")
        {
            var array = ['mp4'];
        }

        if(jQuery.inArray(extension, array) == -1)
        {
            $('#poi_message').text('Not support this format.Only support '+array+'');
            $("#poi_message").css("display",'flex');
        }
        else
        {   
            $("#poi_message").css("display",'none');
        }
    }
    function RemoveRow(ids) 
    {
        // var id = $("#variation_id_"+ids+"").val();
        $('#variation_list_'+ids+'').remove();
        $("#message").text('Variation Delete Successfully');
        $("#message").css("display",'flex');
        updateVariations();
        $("#main_div_"+ids+"").remove();
    }
</script>
<script type="text/javascript">
    $('form#create_formmcc').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
        $('.variations_name').each(function() {
            
            $(this).rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Variation Name is required",
                    }
                });
        });
        //Add validation rule for dynamically generated email fields
        $('.poi_name').each(function() {
            $(this).rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Poi Name is required",
                      }
                });
        });
        $('.variation_type').each(function() {
            $(this).rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add atleast 1 variation",
                      }
                });
        });
        $("#tour_name").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Tour Name is required",
                      }
                });
        $("#set_password").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Set Login password first",
                      }
                });
        $("#password").rules("add", 
                {
                    required: true,
                    remote: {
                        url: '{{ url("admin/tours/unique_password") }}',
                        type: "post",
                        data: {
                                "_token": "{{ csrf_token() }}",
                                password: function() {
                                    return $( "#password" ).val();
                                },
                                'type' : 'create',
                            }
                    },
                    messages: {
                        required: "Password Field is required",
                        remote : "This password is already in use, please choose another one."
                      }
                });
    });
    $("#create_formmcc").validate();
</script>

<script>
  function add_image()
  {
        $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
          _renderItem: function( ul, item ) {
            var li = $( "<li>" ),
              wrapper = $( "<div>", { text: item.label } );
     
            if ( item.disabled ) {
              li.addClass( "ui-state-disabled" );
            }
     
            $( "<span>", {
              style: item.element.attr( "data-style" ),
              "class": "ui-icon " + item.element.attr( "data-class" )
            })
              .appendTo( wrapper );
     
            return li.append( wrapper ).appendTo( ul );
          }
        });

     
      $( ".icon_type" )
      .iconselectmenu()
      .iconselectmenu( "menuWidget")
      .addClass( "ui-menu-icons avatar" );
  }
  </script>
    
<script type="text/javascript">
     $(document).on('click','.openModel',function(){
        $('#location_line_id').val($(this).data('location'));
        $('#myModal_'+$(this).data('location')).modal('toggle');
        // alert($(this).data('location'));
        // add_map($(this).data('location'));
    });
    
function add_map(tt)
{
    

    var minimum_zoom = $('#minimum_zoom').val();
    var maximum_zoom = $('#maximum_zoom').val();
    // console.log(north+"//"+south +"==="+east+"///"+west);
    // alert(north+"//"+south+"==="+east+"///"+west);

    var getMarkerUniqueId= function(lat, lng) {
        return lat + '_' + lng;
    };

    var getLatLng = function(lat, lng) {
        return new google.maps.LatLng(lat, lng);
    };

    var markers = {};

    var zoom_level = {
        minZoom: parseFloat(minimum_zoom), 
        maxZoom: parseFloat(maximum_zoom),
    }
    var center_latLong = {
        lat: parseFloat(center_lattitude), 
        lng: parseFloat(center_longitude)
    };
    console.log(center_latLong);
    var boundries = {
        north: parseFloat(north) ,
        south: parseFloat(south) ,
        west: parseFloat(west) ,
        east: parseFloat(east) ,
      };

    var infowindow;
    var map;
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;
    var locations = "";
    var myOptions = {
        zoom: 13,
        // center: {lat: 51.1956, lng: 4.4188},
        center: center_latLong,
        restriction: {
            latLngBounds: boundries,
            strictBounds: false,
          },
        mapTypeId: 'roadmap'
    };
    map = new google.maps.Map(document.getElementById('map_'+tt), myOptions);
    map.setOptions(zoom_level);

    var addMarker = google.maps.event.addListener(map, 'click', function(e) {
        var location_line_id = $('#location_line_id').val();
        var lat = e.latLng.lat(); // lat of clicked point
        var lng = e.latLng.lng(); // lng of clicked point
        alert(lat+"/"+lng);
        $("#lat_"+location_line_id+"").val(lat);
        $("#long_"+location_line_id+"").val(lng);
        var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
        var marker = new google.maps.Marker({
            position: getLatLng(lat, lng),
            map: map,
            animation: google.maps.Animation.DROP,
            id: 'marker_' + markerId,
            html: "    <div id='info_"+markerId+"'>\n" +
            "        <table class=\"map1\">\n" +
            "            <tr>\n" +
            "                <td><a>Description:</a></td>\n" +
            "                <td><textarea  id='manual_description' placeholder='Description'></textarea></td></tr>\n" +
            "            <tr><td></td><td><input type='button' value='Save' onclick='saveData("+lat+","+lng+")'/></td></tr>\n" +
            "        </table>\n" +
            "    </div>"
        });
        markers[markerId] = marker; // cache marker in markers object
        // bindMarkerEvents(marker); // bind right click event to marker
        // bindMarkerinfo(marker); // bind infowindow with click event to marker
    });

    var bindMarkerinfo = function(marker) {
            google.maps.event.addListener(marker, "click", function (point) {
                var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                var marker = markers[markerId]; // find marker
                infowindow = new google.maps.InfoWindow();
                infowindow.setContent(marker.html);
                infowindow.open(map, marker);
                // removeMarker(marker, markerId); // remove it
            });
        };

        /**
         * Binds right click event to given marker and invokes a callback function that will remove the marker from map.
         * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
         */
        var bindMarkerEvents = function(marker) {
            google.maps.event.addListener(marker, "rightclick", function (point) {
                var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                var marker = markers[markerId]; // find marker
                removeMarker(marker, markerId); // remove it
            });
        };
        var removeMarker = function(marker, markerId) {
            marker.setMap(null); // set markers setMap to null to remove it from map
            delete markers[markerId]; // delete marker instance from markers object
        };
}

</script>
@endsection


