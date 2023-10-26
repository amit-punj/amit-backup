<div class="footer">
   <div class="container">
        <div class="row">
            <div class="footersection">
              <div class="footerheadings">CONTACT US</div>
              <p class="line">_____</p>
              <?php $email = \App\general_setting::pluck('email')->first(); ?>
              <span><i class="fas fa-envelope" style="color: green; "></i>
              <label class="gmail" style="font-size: 12px;"><a href="mailto:{{ $email }}"> {{ $email }} </a></label>
              </span>

              
              <!-- <a href="mailto:someone@example.com?Subject=Hello%20again" target="_top">Send Mail</a> -->
            </div>
            <div class="footersection"><div class="footerheadings">QUICK LINK</div>
                  <p class="line">_____</p>
                 <div class="links">
                      <a href="{{url('/')}}">Home</a><br>
                      <a href="{{url('/page/about-us')}}">About Us</a><br>
                      
                         <!-- <a href="{{url('/page/reviews')}}">Reviews</a><br> -->
                  </div>
            </div>
            <div class="footersection">
              <div class="footerheadings">INFORMATION</div>
                    <p class="line">_____</p>
                  <div class="links">
                       <!-- <a href="{{url('/page/my-account')}}">My  Account</a><br> -->
                        <a href="{{url('/page/terms-condition')}}">Privacy Policy</a><br>
                        <a href="{{url('/page/contact-us')}}">Contact Us</a><br>
                         <!-- <a href="{{url('/page/contact-us')}}">Site Map</a><br> -->
                 	</div>
            </div>
             <div class="footersection">
                   <div class="footerheadings">OUR POLICY</div>
                    <p class="line">_____</p>
                  <div class="links">
                      <a href="{{url('/page/help-page')}}">Help & Contact</a><br>
                      <!-- <a href="{{url('/page/Affilates')}}">Affilates</a><br> -->
                      <a href="{{url('/page/legal-notice')}}">Legal Notice</a>
                  </div>
              </div>
            <div class="footersection">
              	<div class="footerheadings">GET SOCIAL WITH Us</div>
                  <p class="line">_____</p>
                <div class="socialmedialink">  
                    <a href="{{ \App\general_setting::pluck('twitter')->first() }}" target="_blank"><i class="fab fa-twitter agentconnect-color"></i></a>
                   <a href="{{ \App\general_setting::pluck('instagram')->first() }}" target="_blank"><i class="fa fa-instagram agentconnect-color"></i></a>
                </div>
                @if(!isset(Auth::user()->id))
                      <a style="color: green;" href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><span style="font-weight: bold;">Click here to work with one of our agents </span></a>
                @endif      
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <form name="info" action="{{ url('get/enquire')}}" method="post">
                                @csrf
                                <div class="form-group">
                                <label style="float: left;" for="recipient-name" class="col-form-label">Choose:</label>
                                <select name="purpose" class="form-control" required="">
                                <option value="">Choose Purpose</option>
                                <option value="Buy">Buy</option>
                                <option value="Rent">Rent</option>
                                <option value="Sell">Sell</option>
                                </select>
                                </div>
                                <div class="form-group">
                                   <label style="float: left;" class="col-form-label">Name*</label>
                                   <input type="text" name="name" class="form-control" placeholder="Name" required="">
                                </div>
                                <div class="form-group">
                                   <label class="col-form-label">Email*</label>
                                   <input type="email" name="email" class="form-control" placeholder="Email" required="">
                                </div>
                                <div class="form-group">
                                   <label style="float: left;" class="col-form-label">Phone</label>
                                   <input type="number" name="phone" class="form-control" placeholder="Phone" required="">
                                </div>
                                <div class="form-group">
                                <label style="float: left;" for="message-text" class="col-form-label">Please Give us detail of the property*</label>
                                <textarea name="detail" class="form-control" id="message-text" placeholder="Please Give us detail of the property you are looking for or have for sale or rent" required=""></textarea>
                                </div>
                              
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit"  class="btn btn-success">Send message</button>
                              </form>
                                </div>
                                </div>
                                </div>
                                </div>
                          </div>
                         
            </div>
      	</div>
   </div>
   <div class="footerlast-sec text-center"><span>Copyright @2019</span><span class="agentconnect-color"> AgentsConnect </span><span> All right reserved </span></div>
</div>
<script type="text/javascript">
function myFunction(){
  $('.nav-link').removeClass("active");
 $('.list-group-item').removeClass("active");
 $('.client').addClass("active");
}
function myFunction1(){
  $('.client').removeClass("active");
  $('.link1').addClass("active");
  $('.collapse').addClass("show");
  $('#fun1').attr('aria-expanded','true');
}
function buyer(){
   $('.nav-link').removeClass("active");
  $('.list-group-item').removeClass("active");
  $('.buyer').addClass("active");
}
function properties(){
  $('.list-group-item').removeClass("active");
  $('.nav-link').removeClass("active");
  $('.mylisting').addClass("active");
}
function search_list(){
  $('.list-group-item').removeClass("active");
  $('.nav-link').removeClass("active");
  $('.mysearch').addClass("active");
}
$(document).ready(function(){
    $("#serch_property_data_link").click(function(){        
        $("#search_data_form_property").submit(); // Submit the form
    });
});
$(document).ready(function(){
    $("#serch_buyer_data_link").click(function(){        
        $("#search_data_form_buyer").submit(); // Submit the form
    });
});
$(document).on('change','#autocomplete',function(e){
       e.preventDefault;
         $("#latitude").val('');
         $("#longitude").val('');
   });

  $(document).on('click','#mainSearch',function(e){
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
       jQuery('#homepage_mainSearch_form').submit();
   });

   $(document).on('click','#advance_search_button_property',function(e){
       e.preventDefault;
       var lat =  $("#latitude").val();
       var lng =  $("#longitude").val();

       var lat1 =  $("#latitude1").val();
       var lng1 =  $("#longitude1").val();

       var lat2 =  $("#latitude2").val();
       var lng2 =  $("#longitude2").val();
       console.log(lat,lng);
       var search = $("#autocomplete").val();
       var search1 = $("#autocomplete1").val();
       var search2 = $("#autocomplete2").val();
       if(search != "")
       {
         if (lat != '' && lng != '') {
           // jQuery('#mainSearch').submit();
         }else{
           alert('Please select dropdown1 address');
           // $('#search_eroor').text('Please select dropdown address');
           // $("#mainSearch").prop('disabled', true);
           return false;
         }
       }
       if(search1 != "")
       {
         if (lat1 != '' && lng1 != '') {
           // jQuery('#mainSearch').submit();
         }else{
           alert('Please select dropdown2 address');
           // $('#search_eroor').text('Please select dropdown address');
           // $("#mainSearch").prop('disabled', true);
           return false;
         }
       }
       if(search2 != "")
       {
         if (lat2 != '' && lng2 != '') {
           // jQuery('#mainSearch').submit();
         }else{
           alert('Please select dropdown3 address');
           // $('#search_eroor').text('Please select dropdown address');
           // $("#mainSearch").prop('disabled', true);
           return false;
         }
       }
     jQuery('#mainSearch_form').submit();
   });
   $("#clear_req_item").click(function(){
       window.localStorage.removeItem("city_name_req");
       window.localStorage.removeItem("longitude_req");
       window.localStorage.removeItem("latitude_req");
  });
   $("#clear_property_item").click(function(){
       window.localStorage.removeItem("city_name_property");
       window.localStorage.removeItem("longitude_property");
       window.localStorage.removeItem("latitude_property");
  });

</script>