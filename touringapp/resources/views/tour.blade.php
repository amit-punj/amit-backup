@extends('layouts.home')

@section('content')
<section class="jumbotron text-center homebg" style="margin-bottom: 0;height: 100vh; background-image: url('{{ asset('images/background.jpg') }}'); position: relative;">
    <div class="container">
    <p><img src="{{ asset('images/logo.png') }}" width="150" height="150" alt=""></p>
    <div class="row justify-content-center">
        <div class="col-m1d-8">
            <div class="card">
            <?php 
            $tour_id = $tour_details[0]->id;
            ?>
                    @if (count($variation_details) > 0)
                <div class="card-header">Please make your choice: </div>
                <div class="card-body">
                    @foreach($variation_details as $variation)
                        <a href='{{ url("home/get_poi/{$tour_id}/{$variation->id}") }}'><button type="button" class="btn btn-lg btn-primary variation" data-id="{{ $variation->id }}">{{ $variation->variation_name }}</button></a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container about-button">
        <p class="">
            <a href="{{ url('https://www.heyhello.be/touringapp') }}">About the Touringapp</a>
        </p>
</div>
    
</section>

@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".variation1").click(function(){
            $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var var_id = $(this).data('id');
            $.ajax({
               type:'POST',
               url:'{{ url("home/get_poi") }}',
               data:{id:var_id},
               success:function(data){
                if(data.status == 'success')
                {
                    $.each(data["data"], function(k, v) {
                        // console.log(v);
                        var html = '';
                        html +=' <input type="hidden" name="lat['+k+']" id="lat_'+k+'" value="'+v.lat+'">';
                        html +=' <input type="hidden" name="long['+k+']" id="long_'+k+'" value="'+v.long+'">';
                        html +=' <input type="hidden" name="content_type_['+k+']" id="content_type_'+k+'" value="'+v.content_type+'">';
                        html +=' <input type="hidden" name="icon_type['+k+']" id="icon_type_'+k+'" value="'+v.icon_type+'">';
                        html +=' <input type="hidden" name="poi_name['+k+']" id="poi_name_'+k+'" value="'+v.poi_name+'">';
                        html +=' <input type="hidden" name="content['+k+']" id="content_'+k+'" value="'+v.content+'">';
                        html +=' <input type="hidden" name="image['+k+']" id="image_'+k+'" value="'+v.image+'">';
                        html +=  '<li class="openModel" data-ids="'+k+'" id="'+v.id+'">'+v.poi_name+'</li>';
                        // html +='<div class="modal fade" id="myModal_'+k+'" role="dialog">';
                        // html +='    <div class="modal-dialog">';
                        // html +='        <div class="modal-content" style="width: 900px;">';
                        // html +='            <div id="map_'+k+'" style="height: 450px; width: 900px;"></div>';
                        // html +='            <div class="modal-footer">';
                        // html +='              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                        // html +='            </div>';
                        // html +='        </div>';
                        // html +='    </div>';
                        // html +='</div>';
                        
                        $(".poi-data").find('ul').find('p').remove();
                        $(".poi-data").find('ul').append(html);

                    });
                }
                else
                {
                    $(".poi-data").find('ul').html('<p>'+data.message+'</p>');
                }
               }
            });            
        });

        $(document).on('click','.openModel1',function(){
            // $('#location_line_id').val($(this).data('ids'));
            $('.myModal').modal('toggle');
            var row_id = $(this).data('ids');
            var modal = "";
            modal +='<div class="modal-header">';
            modal +='      <button type="button" class="close" data-dismiss="modal">&times;</button>';
            modal +='</div>        ';
            modal +='<div id="map" style="height: 450px; width: 900px;"></div>';
            modal +='<div class="modal-footer">';
            modal +='  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            modal +='  <a class="navbar-brand" href="{{ url('/') }}"><button type="button" class="btn btn-default">Return</button></a>';
            modal +='</div>';

            $('.myModal .modal-content').html(modal);
            setTimeout(function(){
                add_map(row_id);    
            })
            
        });
    });
</script>
<script type="text/javascript">
var locations = [];
var map,
    marker,
    infowindow;
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    var poi_icon =  "";
    var image =  "";

function add_map(row_id)
{
    var icon    = $("#icon_type_"+row_id).val();
    var image1  = $("#image_"+row_id).val();
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
    image = '{{ asset('images/') }}/'+image1;
    image = '{{ asset('public/videos/') }}/'+image1;

    locations = [];
    map = '';
    marker,
    infowindow;
    // alert(tt+"jjjj");
    // var getMarkerUniqueId= function(lat, lng) {
    //     return lat + '_' + lng;
    // };

    // var getLatLng = function(lat, lng) {
    //     return new google.maps.LatLng(lat, lng);
    // };

    var markers = {};

    
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;

    var myOptions = {
        zoom: 7,
        center: new google.maps.LatLng(30.7333, 76.7794),
        mapTypeId: 'roadmap'
    };
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    map.setOptions({ minZoom: 5, maxZoom: 9 });

    var lat  = $("#lat_"+row_id).val();
    var long = $("#long_"+row_id).val();
    // alert(lat+"///"+long);
    add_location('FR', lat,long);
    set_current_location();
    

        /**
         * Binds right click event to given marker and invokes a callback function that will remove the marker from map.
         * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
         */
       
    

        // var i ; var confirmed = 0;
        // console.log(locations);
        // // for (i = 0; i < locations.length; i++) {
        //     var lat = $('#lat_'+tt).val();
        //     var long = $('#long_'+tt).val();
        //     // alert(lat+"//"+long);
        //     marker = new google.maps.Marker({
        //         position: new google.maps.LatLng(lat, long),
        //         map: map,
        //         // icon :   locations[i][4] === '1' ?  red_icon  : purple_icon,
        //         html: "<div>\n" +
        //         "<table class=\"map1\">\n" +
        //         "<tr>\n" +
        //         "<td><a>Description:</a></td>\n" +
        //         "<td><textarea disabled id='manual_description' placeholder='Description'>"+confirmed+"</textarea></td></tr>\n" +
        //         "</table>\n" +
        //         "</div>"
        //     });

            // google.maps.event.addListener(marker, 'click', (function(marker, i) {
            //     return function() {
            //         infowindow = new google.maps.InfoWindow();
            //         // confirmed =  confirmed === '1' ?  'checked'  :  0;
            //         // $("#confirmed").prop(confirmed,locations[i][4]);
            //         // $("#id").val(locations[i][0]);
            //         // $("#description").val(locations[i][3]);
            //         $("#form").show();
            //         infowindow.setContent(marker.html);
            //         infowindow.open(map, marker);
            //     }
            // })(marker, i));
        // }

        // infoWindow = new google.maps.InfoWindow;

        // if (navigator.geolocation) {
        //   navigator.geolocation.getCurrentPosition(function(position) {
        //     var pos = {
        //       lat: position.coords.latitude,
        //       lng: position.coords.longitude
        //     };

        //     infoWindow.setPosition(pos);
        //     infoWindow.setContent('Location found.');
        //     infoWindow.open(map);
        //     map.setCenter(pos);
        //   }, function() {
        //     handleLocationError(true, infoWindow, map.getCenter());
        //   });
        // } else {
        //   // Browser doesn't support Geolocation
        //   handleLocationError(false, infoWindow, map.getCenter());
        // }

      // function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      //   infoWindow.setPosition(pos);
      //   infoWindow.setContent(browserHasGeolocation ?
      //                         'Error: The Geolocation service failed.' :
      //                         'Error: Your browser doesn\'t support geolocation.');
      //   infoWindow.open(map);
      // }
}
function set_current_location() {
     

    // console.log(map);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            /*
            var pos = new google.maps.LatLng(position.coords.latitude,
                                             position.coords.longitude);
            var myLat = position.coords.latitude;
            var myLong = position.coords.longitude;
            */
            add_location('My location', 
                        position.coords.latitude, 
                        position.coords.longitude);

            set_markers(new google.maps.LatLngBounds(), map);
        }, function error(err) {
            console.log('error: ' + err.message);
            set_markers(new google.maps.LatLngBounds(), map);            
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}
function set_markers(bounds, map) {
    // console.log('#locations: ' + locations.length);
    // console.log(bounds);
    marker = '';
    for (var i = 0; i < locations.length; i++) {
        // console.log(locations[i][0] , locations[i][1], locations[i][2]);
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon :   locations[i][0] === 'My location' ?  red_icon  : poi_icon,
            html: "<div>\n" +
                "<table class=\"map1\">\n" +
                "<tr>\n" +
                "<td><a>Description:</a></td>\n" +
                "<td><textarea disabled id='manual_description' placeholder='Description'>"+locations[i][3]+"</textarea></td>" +
                "<img src='"+image+"' width='50' height='50' alt=''> " +
                "<video width='250' height='200' controls>" +
                "  <source src='"+image+"' type='video/mp4'>" +
                "</video>" +
                "</tr>\n" +
                "</table>\n" +
                "</div>"
        });
        bounds.extend(marker.position);
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow = new google.maps.InfoWindow();
                confirmed =  locations[i][4] === '1' ?  'checked'  :  0;
                $("#confirmed").prop(confirmed,locations[i][4]);
                $("#id").val(locations[i][0]);
                $("#description").val(locations[i][3]);
                $("#form").show();
                infowindow.setContent(marker.html);
                infowindow.open(map, marker);

                // infowindow.setContent(locations[i][0]);
                // infowindow.open(map, marker);
            }
        })(marker, i));
    }
    map.fitBounds(bounds);
}
function add_location(description, lastitude, longtitude) {
    locations.push([description, lastitude, longtitude]);
    // console.log('#locations: ' + locations.length);
    // console.log(locations);  
}
</script>
@endsection