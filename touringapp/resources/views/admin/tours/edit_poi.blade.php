@extends('admin.layouts.main')

@section('content')
<style type="text/css">
    div#cke_editor {
    margin-bottom: 10px;
}
.ui-selectmenu-button.ui-button {
    width: 53em;
}
</style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Create Poi
                        <span class="float-right">
                            <a href='{{ url("admin/tours") }}'>Back To Tour List</a>
                        </span>
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form  action='{{ url("admin/tours/{$poi_details->id}/edit_poi") }}' class="form-horizontal" method="post" role="form" id="create_formmcc" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <input type="hidden" id="tour_id" name="tour_id" class="form-control" value="{{$tour->id}}" />
                        <input type="hidden" id="url" name="url" class="form-control" value="{{url()->previous()}}" />
                        <div class="form-group">
                            <label for="tour_name" class="col-md-2">Poi Name</label>
                            <div class="col-md-10">
                                <input type="text" id="poi_name" name="poi_name" class="form-control"  placeholder="Poi Name" value="{{$poi_details->poi_name}}" />
                                @if ($errors->has('poi_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('poi_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tour_name" class="col-md-2">Select Icon</label>
                            <div class="col-md-10">
                                <select type="text" name="icon_type" id="icon_type" class="form-control icon_type" >
                                    <option value="icon1" {{ ($poi_details->icon_type == 'icon1')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d1.png') }}');" >Icon 1</option>
                                    <option value="icon2" {{ ($poi_details->icon_type == 'icon2')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d2.png') }}');" >Icon 2</option> 
                                    <option value="icon3" {{ ($poi_details->icon_type == 'icon3')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d3.png') }}');" >Icon 3</option> 
                                    <option value="icon4" {{ ($poi_details->icon_type == 'icon4')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d4.png') }}');" >Icon 4</option> 
                                </select>
                                @if ($errors->has('icon_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('icon_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="tour_name" class="col-md-2">Make Default Poi</label>
                            <div class="col-md-10">
                                <select type="text" name="default_poi" id="default_poi" class="form-control default_poi" >
                                    <option value="0" {{ ($poi_details->default_poi == '0')?'selected':''}} >No</option>
                                    <option value="1" {{ ($poi_details->default_poi == '1')?'selected':''}} >Yes</option> 
                                </select>
                                @if ($errors->has('default_poi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('default_poi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="tour_name" class="col-md-2">Poi Type</label>
                            <div class="col-md-10">
                                <select type="text" onchange="javascript:select_content()" name="content_type" id="content_type" class="form-control" >
                                    <option value="text" {{ ($poi_details->content_type == 'text')?'selected':''}} >{{ __('Text') }}</option>
                                    <option value="image" {{ ($poi_details->content_type == 'image')?'selected':''}} >{{ __('Image') }}</option> 
                                    <option value="video" {{ ($poi_details->content_type == 'video')?'selected':''}} >{{ __('Video') }}</option> 
                                </select>
                                @if ($errors->has('content_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="variation_data" id="variation_data">
                            <?php  foreach ($variation_details as $key => $variation) 
                                    { ?>
                                        <span class="variation_list" id="variation_list_{{$variation->id}}" data-id="{{$variation->id}}" data-name="{{ $variation->variation_name }}" ></span>
                            <?php   } ?>
                        </div>

                        @if(count($variation_details))
                            @foreach($variation_details as $variation)
                                <div class="row flex" id="poi_div" style="margin-bottom: 15px;">
                                    <div class="col-md-2">
                                        <input type="hidden" name="variation_id[]" id="variation_id" value="{{$variation->id}}">
                                        <input type="hidden" name="content_id[]" id="content_id" value="{{$variation->content_id}}">
                                        <span>{{$variation->variation_name}}</span>
                                    </div>
                                    <div class="col-md-8 content" id="content_{{$variation->id}}">
                                        @if($poi_details->content_type == 'text')
                                            <textarea class="editor" name="editor_{{$variation->id}}" id="editor_{{$variation->id}}">{{$variation->content}} </textarea>
                                        @elseif($poi_details->content_type == 'image')
                                            <img src="{{ asset('images/'.$variation->image) }}" width="50" height="50" alt="">
                                            <input type="file" name="pic_{{$variation->id}}[]" id="pic_{{$variation->id}}" >
                                        @elseif($poi_details->content_type == 'video')
                                            <textarea id="video_{{$variation->id}}" name="video_{{$variation->id}}" class="form-control"  placeholder="Enter Vimeo embed code"></textarea>
                                            <!-- <iframe src="https://player.vimeo.com/video/319551659" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe> -->
                                            <?php echo $variation->image; ?>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <div class="col-md-11">
                            <input type="hidden" name="lat" id="lat" value="{{$poi_details->lat}}">
                            <input type="hidden" name="long" id="long" value="{{$poi_details->long}}">
                                <div id="map" style="height: 400px; margin-top: 10px;"></div>
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
            <!-- END WIDGETS -->
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script type="text/javascript">
    $('.variation_list').each(function (index) {
            var id      = $( this ).attr('data-id');
            var name    = $( this ).attr('data-name');
            CKEDITOR.replace( 'editor_'+id+'' );
        });

    function select_content()
    {
        var val = jQuery("#content_type").val();
        $('.variation_list').each(function (index) {
            var id      = $( this ).attr('data-id');
            var name    = $( this ).attr('data-name');
            if(val == 'text')
            {
                html='<textarea class="editor" name="editor_'+id+'" id="editor_'+id+'"></textarea>';
                $("#content_"+id+"").html(html);
                CKEDITOR.replace('editor_'+id+'');
            }
            else if(val == 'image')
            {
                html='<input type="file" name="pic_'+id+'[]" id="pic_'+id+'" >';
                $("#content_"+id+"").html(html);
            }
            else if(val == 'video')
            {
                html='<textarea name="video_'+id+'" class="form-control" id="video_'+id+'" placeholder="Enter Vimeo embed code"></textarea>';
                $("#content_"+id+"").html(html);
            }
        });
    }
</script>
<script type="text/javascript">
function add_map()
{
    north = '{{$tour->top}}';
    south = '{{$tour->bottom}}';
    east =  '{{$tour->right}}';
    west =  '{{$tour->left}}' ;   

    var minimum_zoom = '{{$tour->minimum_zoom}}';
    var maximum_zoom = '{{$tour->maximum_zoom}}';

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

    var getMarkerUniqueId= function(lat, lng) {
        return lat + '_' + lng;
    };

    var getLatLng = function(lat, lng) {
        return new google.maps.LatLng(lat, lng);
    };

    var zoom_level = {
        minZoom: parseFloat(minimum_zoom), 
        maxZoom: parseFloat(maximum_zoom),
    }

    var center_latLong = {
        lat: parseFloat(center_lattitude), 
        lng: parseFloat(center_longitude),
    };
    var boundries = {
        north: parseFloat(north) ,
        south: parseFloat(south) ,
        west: parseFloat(west) ,
        east: parseFloat(east) ,
      };
    console.log(center_latLong);
    console.log(boundries);

    var markers = {};
    var marker;

    var infowindow;
    var map;
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;
    var locations = "";
    var myOptions = {
        zoom: 13,
        center: center_latLong,
        restriction: {
            latLngBounds: boundries,
            strictBounds: false,
          },
        streetViewControl: false,
        disableDefaultUI: true,
        mapTypeId: 'roadmap'
    };
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    map.setOptions(zoom_level);

    var flag=0;
    map.addListener('click', function(e) {
        if(flag)
            marker.setMap(null);
        else
            var lat = e.latLng.lat(); // lat of clicked point
            var lng = e.latLng.lng(); // lng of clicked point
            $("#lat").val(e.latLng.lat());
            $("#long").val(e.latLng.lng());

        flag=1;
        marker = new google.maps.Marker({
            position: e.latLng,
            map: map});
    });

    var i ; var confirmed = 0;
        var lat = $('#lat').val();
        var long = $('#long').val();
        flag=1;
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, long),
            map: map,
        });
}
</script>
<script type="text/javascript">
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
</script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', add_map);
</script>
@endsection



