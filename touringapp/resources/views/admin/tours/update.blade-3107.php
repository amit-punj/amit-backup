@extends('admin.layouts.main')

@section('content')
<style type="text/css">
    div#cke_1_contents {
        height: 100px !important;
    }
</style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold ">
                        Update Tour
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form action='{{ url("admin/tours/{$tour->id}/update") }}'   class="form-horizontal" method="post" role="form" id="update_form" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tour_name" class="col-md-2">Tour Name</label>
                        <div class="col-md-10">
                            <input type="text" name="tour_name" id="tour_name" class="form-control" value="{{ old('tour_name',$tour->tour_name ) }}"  placeholder="Tour Name"/>
                            @if ($errors->has('fname'))
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
                             <?php  foreach ($users as $key => $user) 
                                {  ?>
                                    <option value="{{$user->id}}" {{ ($tour->tour_owner == $user->id)?'selected':''}}>{{ $user->name }}</option>
                            <?php   } ?>
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
                            <input type="text" id="center_lattitude" value="{{ old('center_lattitude',$tour->center_lattitude ) }}" name="center_lattitude" class="form-control"  placeholder="Center Lattitude"/>
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
                            <input type="text" id="center_longitude" value="{{ old('center_longitude',$tour->center_longitude ) }}" name="center_longitude" class="form-control"  placeholder="Center Longitude"/>
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
                            <input type="text" id="top" value="{{ old('top',$tour->top ) }}" name="top" class="form-control"  placeholder="Top"/>
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
                            <input type="text" id="right"  value="{{ old('right',$tour->right ) }}" name="right" class="form-control"  placeholder="Right"/>
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
                            <input type="text" id="bottom" value="{{ old('bottom',$tour->bottom ) }}" name="bottom" class="form-control"  placeholder="Bottom"/>
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
                            <input type="text" id="left" value="{{ old('left',$tour->left ) }}" name="left" class="form-control"  placeholder="Left"/>
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
                                <option value="13" {{ ($tour->minimum_zoom == 13 )?'selected':''}} >13</option>
                                <option value="14" {{ ($tour->minimum_zoom == 14 )?'selected':''}} >14</option>
                                <option value="15" {{ ($tour->minimum_zoom == 15 )?'selected':''}} >15</option>
                                <option value="16" {{ ($tour->minimum_zoom == 16 )?'selected':''}} >16</option>
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
                                <option value="13" {{ ($tour->maximum_zoom == 13 )?'selected':''}} >13</option>
                                <option value="14" {{ ($tour->maximum_zoom == 14 )?'selected':''}} >14</option>
                                <option value="15" {{ ($tour->maximum_zoom == 15 )?'selected':''}} >15</option>
                                <option value="16" {{ ($tour->maximum_zoom == 16 )?'selected':''}} >16</option>
                            </select>
                            @if ($errors->has('maximum_zoom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('maximum_zoom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group" id="variations_div">
                        <label for="variations" class="col-md-2">Variations List</label> 
                        <label><a href='{{ url("admin/tours/{$tour->id}/add_variation") }}'>Add new variation</a></label>
                        <div class="col-md-12" id="main_div" style="display: flex; margin-bottom: 5px;">
                            @if(count($variation_details))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>#</th>
                                            <th>Variation Name</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($variation_details as $variation)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$variation->variation_name}}</td>
                                                    <td>{{$variation->created_at}}</td>
                                                    <td>
                                                        <a href='{{ url("admin/tours/{$variation->id}/edit_variation") }}' title="Edit" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                                        <a href='{{ url("admin/tours/{$variation->id}/delete_variation") }}' onclick="return confirm('Are you sure to delete this Variation?')" title="Delete" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No Variation found here !</p>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group" id="poi_div">
                        <label for="poi" class="col-md-2">POI List</label>
                         @if(count($variation_details))
                            <label><a href='{{ url("admin/tours/{$tour->id}/add_poi") }}'>Add new poi</a></label>
                         @endif
                        <div class="col-md-12" id="main_div" style="display: flex; margin-bottom: 5px;">
                            <?php $p=0; ?>
                            @if(count($poi_details))
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Poi Name</th>
                                        <th>Poi Type</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        @foreach($poi_details as $poi)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$poi->poi_name}}</td>
                                                <td>{{$poi->content_type}}</td>
                                                <td>{{$poi->created_at}}</td>
                                                <td>
                                                    <a href='{{ url("admin/tours/{$poi->id}/edit_poi") }}' title="Edit" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href='{{ url("admin/tours/{$poi->id}/delete_poi") }}' onclick="return confirm('Are you sure to delete this Poi?')" title="Delete" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            @else
                                <p>No Poi found here !</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password"  class="form-control" id="set_password">
                                <option value="" >{{ __('Set Password') }}</option>
                                <option value="constant" {{ ($tour->set_password == 'constant')?'selected':''}}>{{ __('Constant') }}</option>
                                <option value="temporary" {{ ($tour->set_password == 'temporary')?'selected':''}} >{{ __('Temporary')  }}</option> 
                            </select>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-10" id="password_div">
                        <?php if($tour->set_password == 'constant') {?>
                            <input type="text" name="password" id="password" class="form-control" value="{{ $tour->current_password}}" placeholder="Password"/>
                        <?php } elseif ($tour->set_password == 'temporary') { ?>
                            <select type="text" name="password_type" class="form-control" id="password_type">
                                <option value="month" {{ ($tour->password_type == 'month')?'selected':''}}>{{ __("Month") }}</option>';
                                <option value="week" {{ ($tour->password_type == 'week')?'selected':''}}>{{ __("Week")  }}</option> ';
                                <option value="day" {{ ($tour->password_type == 'day')?'selected':''}}>{{ __("Day")  }}</option> ';
                                <!-- <option value="timezone" {{ ($tour->password_type == 'timezone')?'selected':''}}>{{ __("TimeZone")  }}</option> '; -->
                            </select>
                            <input type="text" name="password" id="password" class="form-control" value="{{ $tour->current_password}}" placeholder="Password"/>
                        <?php } ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="tour_control" class="col-md-2 required">Tour Control</label>
                        <div class="col-md-10">
                            <select type="text" name="tour_control" class="form-control" id="tour_control">
                                <option value="yes" {{ ($tour->tour_control == 'yes')?'selected':''}} >{{ __('Yes') }}</option>
                                <option value="no" {{ ($tour->tour_control == 'no')?'selected':''}} >{{ __('No') }}</option> 
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
                            <button class="btn btn-info btn-block" type="submit" id="craete_idValid">Update</button>
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

@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script>
var north;
var south;
var east;
var west;
var minimum_zoom;
var maximum_zoom; 
var center_lattitude;   
var center_longitude;  
</script>
<script type="text/javascript">

    var image1 = "'{{ asset('images/d1.png') }}'";
    var image2 = "'{{ asset('images/d2.png') }}'";
    var image3 = "'{{ asset('images/d3.png') }}'";
    var image4 = "'{{ asset('images/d4.png') }}'";

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
            }
            else
            {
                $("#password_div").html('');
            }
        });
    });
</script>

<script type="text/javascript">
    $('#update_form').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
        
        //Add validation rule for dynamically generated email fields
        $("#top").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Lattitude",
                      }
                });
        $("#right").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Longitude",
                      }
                });
        $("#bottom").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Lattitude",
                      }
                });
        $("#left").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Longitude",
                      }
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
                                'type' : 'update',
                                'tour_id': "{{ $tour->id }}"
                            }
                    },
                    messages: {
                        required: "Password Field is required",
                        remote : "This password is already in use, please choose another one."
                      }
                });
    });
    $("#update_form").validate();
</script>

<script>
  $( function() {
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
    });
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
// function add_map(tt)
// {

//     var north = $('#top').val() ;
//     var south = $('#bottom').val() ;
//     var east =  $('#right').val();
//     var west =  $('#left').val();   

//     if(north > south){
//         center_lattitude = north - south;
//         center_lattitude = center_lattitude / 2;
//         center_lattitude = parseFloat(parseFloat(center_lattitude) + parseFloat(south));
//         center_lattitude = center_lattitude.toFixed(6);
//     }
//     else{
//         center_lattitude = south - north;
//         center_lattitude = center_lattitude / 2;
//         center_lattitude = parseFloat(parseFloat(center_lattitude) + parseFloat(north));
//         center_lattitude = center_lattitude.toFixed(6);
//     }

//     if(east > west)
//     {
//         center_longitude = east - west;
//         center_longitude = center_longitude / 2;
//         center_longitude = parseFloat(parseFloat(center_longitude) + parseFloat(west));
//         center_longitude = center_longitude.toFixed(6);
//     }
//     else
//     {
//         center_longitude = west - east;
//         center_longitude = center_longitude / 2;
//         center_longitude = parseFloat(parseFloat(center_longitude) + parseFloat(east));
//         center_longitude = center_longitude.toFixed(6);
//     }
//     // center_lattitude =  $('#center_lattitude').val();   
//     // center_longitude =  $('#center_longitude').val();   
//     var minimum_zoom = $('#minimum_zoom').val();
//     var maximum_zoom = $('#maximum_zoom').val();

//     var getMarkerUniqueId= function(lat, lng) {
//         return lat + '_' + lng;
//     };

//     var getLatLng = function(lat, lng) {
//         return new google.maps.LatLng(lat, lng);
//     };

//     var zoom_level = {
//         minZoom: parseFloat(minimum_zoom), 
//         maxZoom: parseFloat(maximum_zoom),
//     }

//     var center_latLong = {
//         lat: parseFloat(center_lattitude), 
//         lng: parseFloat(center_longitude),
//     };
//  // console.log(center_latLong);
//     var boundries = {
//         north: parseFloat(north) ,
//         south: parseFloat(south) ,
//         west: parseFloat(west) ,
//         east: parseFloat(east) ,
//       };

//     var markers = {};

//     var infowindow;
//     var map;
//     var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
//     var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;
//     var locations = "";
//     var myOptions = {
//         zoom: 13,
//         // center: {lat: 51.1956, lng: 4.4188},
//         center: center_latLong,
//         restriction: {
//             latLngBounds: boundries,
//             strictBounds: false,
//           },
//         mapTypeId: 'roadmap'
//     };
//     map = new google.maps.Map(document.getElementById('map_'+tt), myOptions);
//     map.setOptions(zoom_level);

//     var addMarker = google.maps.event.addListener(map, 'click', function(e) {
//         var location_line_id = $('#location_line_id').val();
//         // alert(location_line_id);
//         var lat = e.latLng.lat(); // lat of clicked point
//         var lng = e.latLng.lng(); // lng of clicked point
//         alert(lat+"/"+lng);
//         $("#lat_"+location_line_id+"").val(lat);
//         $("#long_"+location_line_id+"").val(lng);
//         var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
//         var marker = new google.maps.Marker({
//             position: getLatLng(lat, lng),
//             map: map,
//             animation: google.maps.Animation.DROP,
//             id: 'marker_' + markerId,
//             html: "    <div id='info_"+markerId+"'>\n" +
//             "        <table class=\"map1\">\n" +
//             "            <tr>\n" +
//             "                <td><a>Description:</a></td>\n" +
//             "                <td><textarea  id='manual_description' placeholder='Description'></textarea></td></tr>\n" +
//             "            <tr><td></td><td><input type='button' value='Save' onclick='saveData("+lat+","+lng+")'/></td></tr>\n" +
//             "        </table>\n" +
//             "    </div>"
//         });
//         markers[markerId] = marker; // cache marker in markers object
//         // bindMarkerEvents(marker); // bind right click event to marker
//         // bindMarkerinfo(marker); // bind infowindow with click event to marker
//     });

//     var bindMarkerinfo = function(marker) {
//             google.maps.event.addListener(marker, "click", function (point) {
//                 var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
//                 var marker = markers[markerId]; // find marker
//                 infowindow = new google.maps.InfoWindow();
//                 infowindow.setContent(marker.html);
//                 infowindow.open(map, marker);
//                 // removeMarker(marker, markerId); // remove it
//             });
//         };

//         /**
//          * Binds right click event to given marker and invokes a callback function that will remove the marker from map.
//          * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
//          */
//         var bindMarkerEvents = function(marker) {
//             google.maps.event.addListener(marker, "rightclick", function (point) {
//                 var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
//                 var marker = markers[markerId]; // find marker
//                 removeMarker(marker, markerId); // remove it
//             });
//         };
//         var removeMarker = function(marker, markerId) {
//             marker.setMap(null); // set markers setMap to null to remove it from map
//             delete markers[markerId]; // delete marker instance from markers object
//         };

//         var i ; var confirmed = 0;
//         // console.log(locations);
//         // for (i = 0; i < locations.length; i++) {
//             var lat = $('#lat_'+tt).val();
//             var long = $('#long_'+tt).val();
//             // alert(lat+"//"+long);
//             marker = new google.maps.Marker({
//                 position: new google.maps.LatLng(lat, long),
//                 map: map,
//                 // icon :   locations[i][4] === '1' ?  red_icon  : purple_icon,
//                 html: "<div>\n" +
//                 "<table class=\"map1\">\n" +
//                 "<tr>\n" +
//                 "<td><a>Description:</a></td>\n" +
//                 "<td><textarea disabled id='manual_description' placeholder='Description'>"+confirmed+"</textarea></td></tr>\n" +
//                 "</table>\n" +
//                 "</div>"
//             });

//             google.maps.event.addListener(marker, 'click', (function(marker, i) {
//                 return function() {
//                     infowindow = new google.maps.InfoWindow();
//                     // confirmed =  confirmed === '1' ?  'checked'  :  0;
//                     // $("#confirmed").prop(confirmed,locations[i][4]);
//                     // $("#id").val(locations[i][0]);
//                     // $("#description").val(locations[i][3]);
//                     $("#form").show();
//                     infowindow.setContent(marker.html);
//                     infowindow.open(map, marker);
//                 }
//             })(marker, i));
//         // }
// }

</script>


@endsection