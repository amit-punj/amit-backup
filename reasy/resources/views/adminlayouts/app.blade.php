<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    
    <link rel="stylesheet" type="text/css" href="{{url('css/admin.css')}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <script type="text/javascript" src="{{url('js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/jqvalidation.js')}}"></script>
  </head>
  <body class="app sidebar-mini rtl">
    @include('adminlayouts.header') 
    @include('adminlayouts.sidebar') 
    @yield('content')
   <link href="{{url('css/jquery-ui.multidatespicker.css')}}" rel="stylesheet">
  <link href="{{url('css/datepicker.css')}}" rel="stylesheet">
  <script type="text/javascript" src="{{url('js/datepicker.js')}}"></script>
  <script type="text/javascript" src="{{url('js/jquery-ui.multidatespicker.js')}}"></script>
  <script type="text/javascript" src="{{url('js/jquery.flexslider.js')}}"></script>
  <script type="text/javascript" src="{{url('js/numeric-1.2.6.min.js')}}"></script>
  <script type="text/javascript" src="{{url('js/bezier.js')}}"></script>
  <script type="text/javascript" src="{{url('js/jquery.signaturepad.js')}}"></script>
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.6/signature_pad.min.js"></script> -->

  <!-- new links or script -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

      <!-- end new links -->
   <script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
  <!-- slider uppr -->
    <script type="text/javascript" src="{{url('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/main.js')}}"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script type="text/javascript" src="{{url('js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">




<script>
    $(document).ready(function() {
        $('#signArea').signaturePad({
            drawOnly:true, 
            drawBezierCurves:true,
            lineTop:90,
            clear : '#removeSignature',
            onDraw: (e)=>{ document.getElementById("btnSaveSign").disabled = false; }
        });
    });
    $("#removeSignature").click(function(e){
        document.getElementById("btnSaveSign").disabled = true;
    });
   
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

    <script type="text/javascript">
      $(document).ready(function() {
           $('#add_cms_content').summernote({
             height:100,
           });
       });
      // $('#list_cms_pages').DataTable();
      $(document).ready(function() {
          $('#list_cms_pages').DataTable( {
              "order": [[ 0, "desc" ]]
          } );
      } );
    </script>
    <script>
       var placeSearch, autocomplete, b_autocomplete, u_autocomplete;

// function initAutocomplete() {

//     var acInputs = document.getElementsByClassName("autocomplete");

//     for (var i = 0; i < acInputs.length; i++) {

//         var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
//         autocomplete.inputId = acInputs[i].id;

//         google.maps.event.addListener(autocomplete, 'place_changed', function () {
//             // document.getElementById("log").innerHTML = 'You used input with id ' + this.inputId;
//         });
//     }
// }



function initAutocomplete() {
  if(document.getElementById("autocomplete")){
    autocomplete = new google.maps.places.Autocomplete(
    document.getElementById('autocomplete'), {types: ['geocode']});
    autocomplete.setFields(['address_component', 'geometry']);
    autocomplete.addListener('place_changed', fillInAddress);
  }
}

function fillInAddress() {
  var place = autocomplete.getPlace();
  var lat = place.geometry.location.lat();
  var lng = place.geometry.location.lng();
  console.log(place.geometry.location.lat());

  document.getElementById("latitude").value = lat;
  document.getElementById("longitude").value = lng;
}
$(document).ready(function()
{
  if(document.getElementById("b_autocomplete")){
    b_initAutocomplete();
  }
  if(document.getElementById("u_autocomplete")){
    u_initAutocomplete();
  }
});

function b_initAutocomplete() {
    b_autocomplete = new google.maps.places.Autocomplete(
    document.getElementById('b_autocomplete'), {types: ['geocode']});
    b_autocomplete.setFields(['address_component', 'geometry']);
    b_autocomplete.addListener('place_changed', b_fillInAddress);
      //alert(b_autocomplete);
      console.log(b_autocomplete); 
}
function b_fillInAddress() {
  var b_place = b_autocomplete.getPlace();
  var b_lat = b_place.geometry.location.lat();
  var b_lng = b_place.geometry.location.lng();
  console.log(b_place.geometry.location.lat());

  document.getElementById("b_latitude").value = b_lat;
  document.getElementById("b_longitude").value = b_lng;
}

function u_initAutocomplete() {
    u_autocomplete = new google.maps.places.Autocomplete(
    document.getElementById('u_autocomplete'), {types: ['geocode']});
    u_autocomplete.setFields(['address_component', 'geometry']);
    u_autocomplete.addListener('place_changed', u_fillInAddress);
}
function u_fillInAddress() {
  var u_place = u_autocomplete.getPlace();
  var u_lat = u_place.geometry.location.lat();
  var u_lng = u_place.geometry.location.lng();
  console.log(u_place.geometry.location.lat());

  document.getElementById("u_latitude").value = u_lat;
  document.getElementById("u_longitude").value = u_lng;
}
</script>

<script type="text/javascript">
  $(document).on('click','.search_',function(e){
        e.preventDefault;
        var lat =  $("#latitude").val();
        var lng =  $("#longitude").val();
        console.log(lat,lng);
        var search = $("#autocomplete").val();
        if(search != "")
        {
          if (lat != '' && lng != '') {
            jQuery('#mainSearch').submit();
          }else{
            alert('Please select dropdown address');
            // $('#search_eroor').text('Please select dropdown address');
            // $("#mainSearch").prop('disabled', true);
            return false;
          }
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARGpUdzBWKnyufzqzh6sS2jlB91Grx9Ys&libraries=places&callback=initAutocomplete"></script>
  </body>
</html>