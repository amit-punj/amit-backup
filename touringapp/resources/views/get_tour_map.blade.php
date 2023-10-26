@extends('layouts.map')
@section('content')
<script>
    var locations = [];
    function add_location(description, lastitude, longtitude,poi_icon,row_id) {
        locations.push([description, lastitude, longtitude, poi_icon,row_id]);
    }
</script>
<div class="container-fluid">
    <div class="poi-data" style="display: none;">
    @if (count($poi_details) > 0)
        <h3>Please make your choice: </h3>
        <ul >
            @foreach($poi_details as $key => $poi)
                <input type="hidden" name="lat[{{$key}}]" id="lat_{{$key}}" value="{{ $poi->lat}}">
                <input type="hidden" name="long[{{$key}}]" id="long_{{$key}}" value="{{ $poi->long}}">
                <input type="hidden" name="content_type[{{$key}}]" id="content_type_{{$key}}" value="{{ $poi->content_type}}">
                <input type="hidden" name="icon_type[{{$key}}]" id="icon_type_{{$key}}" value="{{ $poi->icon_type}}">
                <input type="hidden" name="poi_name[{{$key}}]" id="poi_name_{{$key}}" value="{{ $poi->poi_name}}">
                <input type="hidden" name="content[{{$key}}]" id="content_{{$key}}" value="{{ $poi->contentData}}">
                <input type="hidden" name="image[{{$key}}]" id="image_{{$key}}" value="{{ $poi->imageData}}">
                @if($poi->content_type == 'image')
                    <a data-magnify="gallery" target="_blank" data-caption="{{ $poi->poi_name }}" href='{{ asset("images/$poi->imageData") }}'>
                        <li class="openModel" data-ids="{{$key}}"  id="ImageClick_{{$key}}">{{ $poi->poi_name }}</li>
                    </a>
                @else
                    <a href="JavaScript:Void(0);"><li class="openModel" data-ids="{{$key}}" id="{{$poi->id}}'">{{ $poi->poi_name }}</li></a>
                @endif

                <script>
                    var icon    = '{{ $poi->icon_type}}';
                    if(icon == 'icon1'){
                        poi_icon =  '{{ asset('images/map1.png') }}';
                    }
                    else if(icon == 'icon2'){
                        poi_icon =  '{{ asset('images/map2.png') }}';
                    }
                    else if(icon == 'icon3'){
                        poi_icon =  '{{ asset('images/map3.png') }}';
                    }
                    else if(icon == 'icon4'){
                        poi_icon =  '{{ asset('images/map4.png') }}';
                    }
                    add_location('{{ $poi->poi_name}}', '{{ $poi->lat}}','{{ $poi->long}}',poi_icon,'{{$key}}');
                </script>
                @if($poi->default_poi == 1)
                    <script type="text/javascript">
                        var content_type = '{{ $poi->content_type}}';
                        if(content_type == 'video')
                            {
                                var data = '<?php echo $poi->imageData; ?>';  
                                setTimeout(function(){
                                    opendefaultvideo('modalVM',data);                            
                                },500)
                                // $('#modalVM').modal('toggle');
                                // $('#modalVM  .embed-responsive').html(message);
                            }
                            else if(content_type == 'text'){
                                var data = '<?php echo $poi->contentData; ?>';                     
                                setTimeout(function(){
                                    opendefaultmodal('myModal',data);                            
                                },500)
                            }
                            else if(content_type == 'image'){
                                setTimeout(function(){
                                    opendefaultimage('{{$key}}');                            
                                },500)
                                 // $('#ImageClick_'+row_id).click();
                            }
                           
                        
                        
                    </script>
                @endif

            @endforeach
        </ul>
    @else
        <h3>No Poi with this tour: </h3>
    @endif
    </div>
    <input type="hidden" name="current_address" id="current_address"> 
    <div id="map"></div>
    <div class="container return-button">
        <p class="float-right">
            <a href="{{ url('/') }}"><button type="button" class="btn btn-lg btn-primary btn-rounded">Return</button></a>
        </p>
    </div>
</div>
<div class="modal fade myModal" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            </div>       
        </div>
    </div>
</div>

<!--Modal: Name-->
<div class="modal fade" id="modalVM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close video_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
       <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
          <!-- <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/115098447" allowfullscreen></iframe> -->
        </div>

      </div>

      <!--Footer-->
      <!-- <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
      </div>
 -->
    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: Name-->

<!-- <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close video_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      <div class="modal-body mb-0 p-0">
        <div class="embed-responsive1">
          
        </div>
      </div>
    </div>
  </div>
</div> -->

@endsection

@section('scripts')
<script type="text/javascript">
var north;
var south;
var east;
var west;
var minimum_zoom;
var maximum_zoom; 
var center_lattitude;   
var center_longitude; 
var center_latLong;
    function doSomething() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tour_id = '{{ $tour_details->id }}';
        $.ajax({
           type:'POST',
           url:'{{ url("home/check_password") }}',
           data:{tour_id:tour_id},
           success:function(data){
                if(data.status == 'failed')
                {
                    window.location = '{{ url("/") }}';                    
                }
           }
        });
    }
    window.onload = function () {
        doSomething(); //Make sure the function fires as soon as the page is loaded
        setInterval(doSomething, 600000); //Then set it to run again after ten minutes
    }
</script>
<script type="text/javascript">
function opendefaultmodal(el,data){
    jQuery('#'+el).modal('toggle');
    jQuery('#myModal .modal-body').html(data);
}

function opendefaultvideo(el,data){
    $('#modalVM').modal('toggle');
    $('#modalVM  .embed-responsive').html(data);
}
function opendefaultimage(row_id){
    $('#ImageClick_'+row_id).click();
}
var map,
    marker,
    infowindow;
    var red_icon =  '{{ asset('images/mylocation.png') }}';
    var poi_icon =  "";
    var image =  "";

function add_map()
{
	north = '{{$tour_details->top}}';
    south = '{{$tour_details->bottom}}';
    east =  '{{$tour_details->right}}';
    west =  '{{$tour_details->left}}' ;   

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

    var minimum_zoom = '{{$tour_details->minimum_zoom}}';
    var maximum_zoom = '{{$tour_details->maximum_zoom}}';

    map = '';
    marker,
    infowindow;
    var markers = {};

    var zoom_level = {
        minZoom: parseFloat(minimum_zoom), 
        maxZoom: parseFloat(maximum_zoom),
    }

    var boundries = {
        north: parseFloat(north) ,
        south: parseFloat(south) ,
        west: parseFloat(west) ,
        east: parseFloat(east) ,
      };

    center_latLong = {
        lat: parseFloat(center_lattitude), 
        lng: parseFloat(center_longitude),
    };
    console.log(center_latLong);
    console.log(boundries);
    var myOptions = {
        zoom: 13,
        // center: new google.maps.LatLng(30.7333, 76.7794),
        center: {lat: 30.7210926, lng: 76.8305714},
        center: center_latLong,
        mapTypeId: 'roadmap',
        restriction: {
            latLngBounds: boundries,
            strictBounds: false,
          },
        streetViewControl: false,
        disableDefaultUI: true
    };
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    map.setOptions(zoom_level);
    // map.setOptions({ minZoom: 13, maxZoom: 16 });

    set_current_location();
    // set_markers(new google.maps.LatLngBounds(), map);
}
function set_current_location() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

        	var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
          // console.log(latlng);
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': latlng}, function(results, status) {
	                $("#current_address").val(results[0].formatted_address);
            });

        // var location = $('#us3').locationpicker('location');
        // var from = new google.maps.LatLng(center_lattitude, center_longitude);
        // var to = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

        // var distance = google.maps.geometry.spherical.computeDistanceBetween(from, to);
        // distance = distance / 1000;
        // if(distance <= 1000)
        // {
        //     // add_location('my_location', position.coords.latitude, position.coords.longitude,'icon','7878');
        // }
        // console.log(google.maps.geometry.spherical.computeDistanceBetween(from, to));


           var temp_rectangle = new google.maps.Rectangle({
            bounds: new google.maps.LatLngBounds(
            new google.maps.LatLng(south, west),
            new google.maps.LatLng(north, east))
        });
        // if(temp_rectangle.getBounds().contains(new google.maps.LatLng(4.6517, 101.1419)))
        if(temp_rectangle.getBounds().contains(new google.maps.LatLng(position.coords.latitude, position.coords.longitude)))
          {
                add_location('my_location', position.coords.latitude, position.coords.longitude,'icon','7878');
                console.log("Inside");
          }
          else
          {
                console.log("Outside");
          }

          set_markers(new google.maps.LatLngBounds(), map);
        }, function error(err) {
            console.log('error: ' + err.message);
            set_markers(new google.maps.LatLngBounds(), map);            
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function addInfoWindow(marker, message,content_type,row_id) {
            var infoWindow = new google.maps.InfoWindow({
                content: '<div class="vv-map">'+message+'</div>',
                // content: '<div class="embed-responsive embed-responsive-16by9">'+message+'</div>',
            });
            google.maps.event.addListener(marker, 'click', function () {
                if(content_type == 'video')
                {

                    $('#modalVM').modal('toggle');
                    $('#modalVM  .embed-responsive').html(message);
                    // $('#modal1').modal('toggle');
                    // $('#modal1  .modal-body').html(message);
                    // jQuery('#modal1 iframe').attr('height',window.innerHeight);
                    // jQuery('#modal1 iframe').attr('width',window.innerWidth);
                    // infoWindow.open(map, marker);
                }
                else if(content_type == 'text'){
                    $('#myModal').modal('toggle');
                    $('#myModal .modal-body').html(message);
                }
                else if(content_type == 'image'){
                     $('#ImageClick_'+row_id).click();
                }
                else if(content_type == 'my_location')
                {
                    infoWindow.open(map, marker);
                }
            });
        }

function set_markers(bounds, map) {
    var marker = '';
    for (var i = 0; i < locations.length; i++) {
        var row_id = locations[i][4];
        if(row_id != '7878'){
            var poi_name        = $('#poi_name_'+row_id).val();
            var content_type    = $('#content_type_'+row_id).val();
            var content         = $('#content_'+row_id).val();
            var image1          = $("#image_"+row_id).val();

            var image ;
            if(content_type == 'text'){
                var html ="";
                html = content;
            }
            else if (content_type == 'image'){
                var html ="";
                image = '{{ asset('images/') }}/'+image1;
                html = "<a data-magnify='gallery' data-caption='' href='"+image+"'>" +
                    "<img src='"+image+"' width='100%' height='100%' alt=''>"+
                   " </a>";
            }
            else if (content_type == 'video') {
                var html ="";
                // image = '{{ asset('public/videos/') }}/'+image1;
                // html = "<iframe class='embed-responsive-item' src='"+image+"'  allowfullscreen></iframe>";
                // html = '<video class="modal-video" autoplay controls><source src="'+image+'" type="video/mp4"></video>';
                html = image1;
            }
        }
        else if(row_id == '7878')
        {
            var html = "";
            var current = "";
            var content_type = "my_location";
            // html = $("#current_address").val();
            html = "You are here!";
        }
        // console.log(locations[i][0] , locations[i][1], locations[i][2], locations[i][3], locations[i][4]);
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon :   locations[i][4] === '7878' ?  red_icon  : locations[i][3],
            
        });
        bounds.extend(marker.position);
        addInfoWindow(marker, html,content_type,row_id);
    }
    map.fitBounds(bounds);
}

// set_current_location();
google.maps.event.addDomListener(window, 'load', add_map);
$("#map").height(window.innerHeight);

</script>
<script type="text/javascript">
 $(document).ready(function() {
    /*$('.video_close').click(function() {
        $('.modal-video')[0].pause();
    });*/

    $('.video_close').click(function() {
        // $(this).parent().find('iframe')[0].pause();
        $(this).parent().parent().find('iframe').attr("src", $(this).parent().parent().find('iframe').attr("src"));
        // $('.modal-video')[0].pause();
    });

  });
    // $('[data-magnify=gallery]').magnify();
     $('[data-magnify=gallery]').magnify({
      headToolbar: [
        'close'
      ],
      initMaximized: true
    });

</script>

@endsection