@extends('layouts.map')
@section('content')
<div class="container-fluid">
    <div class="poi-data">
    @if (count($poi_details) > 0)
        <h3>Please make your choice: </h3>
        <ul>
            @foreach($poi_details as $key => $poi)
                <input type="hidden" name="lat[{{$key}}]" id="lat_{{$key}}" value="{{ $poi->lat}}">
                <input type="hidden" name="long[{{$key}}]" id="long_{{$key}}" value="{{ $poi->long}}">
                <input type="hidden" name="content_type[{{$key}}]" id="content_type_{{$key}}" value="{{ $poi->content_type}}">
                <input type="hidden" name="icon_type[{{$key}}]" id="icon_type_{{$key}}" value="{{ $poi->icon_type}}">
                <input type="hidden" name="poi_name[{{$key}}]" id="poi_name_{{$key}}" value="{{ $poi->poi_name}}">
                <input type="hidden" name="content[{{$key}}]" id="content_{{$key}}" value="{{ $poi->content}}">
                <input type="hidden" name="image[{{$key}}]" id="image_{{$key}}" value="{{ $poi->image}}">
                @if($poi->content_type == 'image')
                    <a data-magnify="gallery" data-caption="{{ $poi->poi_name }}" href='{{ asset("images/$poi->image") }}'>
                        <li class="openModel" data-ids="{{$key}}" id="{{$poi->id}}'">{{ $poi->poi_name }}</li>
                    </a>
                @else
                    <a href="JavaScript:Void(0);"><li class="openModel" data-ids="{{$key}}" id="{{$poi->id}}'">{{ $poi->poi_name }}</li></a>
                @endif
            @endforeach
        </ul>
    @else
        <h3>No Poi with this tour: </h3>
    @endif
    </div>
    <div id="map"></div>
    <div class="container return-button">
        <p class="float-right">
            <a href="{{ url('/') }}"><button type="button" class="btn btn-lg btn-primary btn-rounded">Return</button></a>
        </p>
    </div>
</div>
<div class="modal fade myModal" role="dialog">
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

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <!--Content-->
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
      <!--Body-->
      <div class="modal-body mb-0 p-0">
        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
          
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
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
$(document).ready(function(){
     $('.openModel').each(function (index) {
            var row_id      = $(this).data('ids');
            setTimeout(function()
            {
                add_map(row_id);
            },300);
        });
});

$(document).on('click','.openModel',function(){
    var row_id      = $(this).data('ids');
    var poi_name        = $('#poi_name_'+row_id).val();
    var content_type    = $('#content_type_'+row_id).val();
    var content         = $('#content_'+row_id).val();
    var image1         = $("#image_"+row_id).val();

    var image ;
    var model_content = '';
    if(content_type == 'text'){
        $('.myModal').modal('toggle');
        var html = "";
        // html = "<div class='content'>" +
        //            content +
        //         "</div>"
        html = content;
        $('.myModal .modal-body').html(html);
    }
    // else if (content_type == 'image'){
    //     $('#modal1').modal('toggle');
    //     image = '{{ asset('images/') }}/'+image1;
    //     model_content = '';
    //       model_content  =  "<img src='"+image+"' width='100%' height='100%' alt=''>" ;
    //       $('head').append('<style>.embed-responsive-16by9:before{padding-top: 0;}</style>');
    //       $('#modal1  .embed-responsive').html(model_content);  
    //      imgs();    
    // }
    else if (content_type == 'video') {
        $('#modal1').modal('toggle');
        image = '{{ asset('public/videos/') }}/'+image1;
        model_content = '';
        model_content = "<iframe class='embed-responsive-item' src='"+image+"'  allowfullscreen></iframe>";
        $('head').append('<style>.embed-responsive-16by9:before{padding-top: 56.25%;}</style>');
        console.log(model_content);
        $('#modal1  .embed-responsive').html(model_content);
    }
});

var locations = [];
var map,
    marker,
    infowindow;
    var red_icon =  '{{ asset('images/mylocation.png') }}';
    var poi_icon =  "";
    var image =  "";
    add_map();

function add_map(row_id)
{
    var icon    = $("#icon_type_"+row_id).val();
    var image1  = $("#image_"+row_id).val();
    var content_type    = $('#content_type_'+row_id).val();
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

    if(content_type == 'text'){
        // image = '{{ asset('images/') }}/'+image1;
    }
    else if (content_type == 'image'){
        image = '{{ asset('images/') }}/'+image1;
    }
    else if (content_type == 'video') {
        image = '{{ asset('public/videos/') }}/'+image1;
    }
    map = '';
    marker,
    infowindow;
    var markers = {};
    
    // var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    // var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;
    var myOptions = {
        zoom: 7,
        center: new google.maps.LatLng(30.7333, 76.7794),
        mapTypeId: 'roadmap'
    };
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    map.setOptions({ minZoom: 5, maxZoom: 9 });

    var poi_name        = $('#poi_name_'+row_id).val();
    var lat  = $("#lat_"+row_id).val();
    var long = $("#long_"+row_id).val();
    add_location(poi_name, lat,long,poi_icon);
    set_current_location();
}
function set_current_location() {
      // console.log(map);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
            
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': latlng}, function(results, status) {
                console.log(results[0].formatted_address);
            });
            add_location('My location', 
                        position.coords.latitude, 
                        position.coords.longitude,'m');
            set_markers(new google.maps.LatLngBounds(), map);
        }, function error(err) {
            console.log('error: ' + err.message);
            set_markers(new google.maps.LatLngBounds(), map);            
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function addInfoWindow(marker, message) {
            var infoWindow = new google.maps.InfoWindow({
                content: message
            });

            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.open(map, marker);
            });
        }

function set_markers(bounds, map) {
    var marker = '';
    for (var i = 0; i < locations.length; i++) {

        var html = "<iframe class='embed-responsive-item' src='http://localhost/amit_data/touringapp/public/videos/file_example_MP4_480_1_5MG.mp4'  allowfullscreen></iframe></span>" ;

        // var html = "<a data-magnify='gallery' data-caption='' href='http://localhost/amit_data/touringapp/images/9A1B7DE0%20(1).jpg'>" +
        //             " <li class='openModel' data-ids='' id=''>"+locations[i][0]+"</li>"+
        //            " </a>";

        // console.log(locations[i][0] , locations[i][1], locations[i][2], locations[i][3]);
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon :   locations[i][0] === 'My location' ?  red_icon  : locations[i][3],
            
        });
        bounds.extend(marker.position);
        addInfoWindow(marker, html);
    }
    map.fitBounds(bounds);
}
function add_location(description, lastitude, longtitude,poi_icon) {
    // console.log(description, lastitude, longtitude,poi_icon);
    locations.push([description, lastitude, longtitude, poi_icon]);

}
</script>
@endsection