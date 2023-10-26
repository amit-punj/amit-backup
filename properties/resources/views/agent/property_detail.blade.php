@extends('layouts.main')
@section('content')
<style type="text/css">
td{
width: 100%;
}
th{
  width: 50%;
}
table{
  width: 100%;
}
.btnhide{
  box-shadow: inset 0px 0px 10px rgba(0,0,0,0.9);
}
a.list-group-item {color: #fff;}
.color-orange{color: #b0b1b0;}
.f13 {padding-right: 0;font-size: 13px !important;}
.viewbtn{border-radius: 20px; width: 100%; background-color: #b0b1b0;}
.editbtn{border-radius: 20px; width: 100%; background-color: green; color: white;}
.mg{margin-top: 2%;}
.card-title{font-size: 29px;font-weight: bold;}
.page-item.active .page-link {z-index: 1;color: #fff;background-color: green;border-color: green;}
.page-link {color: #37a745;}
.descrip{height: 40px;}
.rmt{margin-top: 4%;}
.note
{text-align: center;height: 80px;background-color:  #0f2b61;color: #fff;font-weight: bold;line-height: 80px;}
div#main {background-color: #f3f3f3;}
.vl {border-right: 1px solid #b7b7b7;height: 100;}
.title{font-size: 23px;font-weight: bold;}
.price{color: green;font-weight: bold;font-size: 21px;padding: 3px;}
.rooms{font-size: 22px;}
.heading{text-align: center;}
/*.table thead th {font-size: 11px;}*/
.shadow{border:2px solid #fff; background: url(img/tiger.png) no-repeat; box-shadow: 10px 10px 5px #ccc; -moz-box-shadow: 10px 10px 5px #ccc;-webkit-box-shadow: 10px 10px 5px #ccc; -khtml-box-shadow: 10px 10px 5px #ccc;}
.addresspro{color:#868686; }
.mobile_view{
  height: 300px;
}
.descrip{
  font-weight: 500;
  font-size: 22px;
 }
 .amen_heading{
  font-size: 22px; font-weight: 500; margin-bottom: 2%;
 }
img.demo.w3-opacity.w3-hover-opacity-off.shadow {
    height: 70px;
}
img.mySlides.shadow {
}
.plusbutton{
  width: 21%; height: 69px;
}
.exposure{
  font-size: 16px;
}
@media only screen and (max-width: 1024px)
{
  .plusbutton{
    width: 21%;
  }
  .col-xl-4.col-lg-4.col-md-12.col-sm-12 {
    margin-top: 8%;
}

}
@media only screen and (max-width: 768px)
 {
  .plusbutton{
    width: 19%;
  }
  img.demo.w3-opacity.w3-hover-opacity-off.shadow.w3-opacity-off {
    width: 18% !important;
 }
img.demo.w3-opacity.w3-hover-opacity-off.shadow {
  width: 18% !important;
 }
.col-sm-12.amen{
  margin: 0 ! important;
}
}
@media screen and (max-width: 640px){
  .plusbutton{
    width: 18%;
  }
  img.demo.w3-opacity.w3-hover-opacity-off.shadow.w3-opacity-off {
    height: 45px;
    width: 18% !important;
 }
 .descrip{
  font-size: 19px !important;
 }
 .note p{
  font-size: 19px !important;
 }
 .amen_heading{
  font-size: 19px !important;
 }
 .btn.btnhide{
  height: 45px !important;
  font-size: 12px;
 }
 .amen_heading{
  font-size: 22px; font-weight: 300;
 }
 .descrip{
  font-weight: 300;
  font-size: 22px;
 }
img.demo.w3-opacity.w3-hover-opacity-off.shadow {
  height: 45px;
 }
 .addresspro{font-size: 12px; } 
.title{font-size: 19px;}
td{
  font-size: 13px;
}
}
@media screen and (max-width: 414px){
  img.demo.w3-opacity.w3-hover-opacity-off.shadow {
    height: 45px;
}
.price{
  font-size: 18px;
}
}
@media screen and (max-width: 320px){
  .btn.btnhide{
    width: 19% !important;
    font-size: 10px;
  }
}



</style>


<div class="container">
  <div class="row m-0">
         <div class="col-md-3 setmd">
          @include('dashboard.dashboard-sidebar')
         </div>
    <div class="col-md-9 setmd">
    @if(Session::has('flash_message_update'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_update') !!}</strong>
                    </div>
    @endif
        <div class="content" style="background-color: white;">
                             <div class="note"><p style="font-size: 22px;">Property<span style="color: #41ac1b"> Detail </span></p>
                              </div>
          <div class="row" style="padding: 20px;">
                  <div class="col-lg-8 col-md-12 col-sm-12">
                      @if(count($property_images) > 0 )
                          @foreach($property_images as $property_image)
                            <img class="mySlides shadow" src="{{ asset('images/'.$property_image->image_name)}}" style="width:100%; display: none;" height="300" width="500">
                          @endforeach
                      @else
                        <img src="{{asset('images/noimage.jpg')}}" class="shadow" style="width:100%;" height="300" width="500">
                      @endif
                        <div class="col-md-12" style="padding: 0; margin-top: 2%;">
                            <?php $i = 0; $count=0; ?>
                                @if(count($property_images) > 0 )
                                  @foreach ($property_images as $property_image)
                                    <?php $i++; ?>
                                        <?php if($i > 8)
                                         { 
                                          $count++;
                                          ?>
                                           <img id="images_hide" class="images_hide demo ff w3-opacity w3-hover-opacity-off shadow" src="{{asset('images/'.$property_image->image_name)}}" style="width:21%;cursor:pointer; display: none;" onclick="currentDiv({{ $i }})" height="100" width="300">
                                            <?php
                                          } 
                                          else
                                          { 
                                            ?>
                                               <img class="demo w3-opacity w3-hover-opacity-off shadow" src="{{asset('images/'.$property_image->image_name)}}" style="width:21%;cursor:pointer" onclick="currentDiv({{ $i }})" height="100" width="300">
                                       <?php   }
                                             if($i >14)
                                             {
                                              break;
                                             }
                                          ?> 
                                   @endforeach
                                           @if(count($property_images) > 8)
                                             <button class="btn btnhide plusbutton" onclick="show_images(); myFunction()">More {{$count}}+</button>
                                             @endif
                                @else
                                  <img src="{{asset('images/noimage.jpg')}}" style="width:21%;" height="100" width="300" class="shadow">
                                @endif
                        </div>
                  </div>
                                  <div id="space" class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                          <div class="title">
                                          {{$property_list->title}}
                                          </div>
                                          <div class="addresspro">
                                               <i class="fa fa-map-marker" style="color: green;"></i> {{$property_list->city_name}} , {{$property_list->local_area}}
                                             <div class="">
                                             {{ $property_list->address }} , {{ $property_list->zipcode }}
                                             </div>  
                                          </div>
                                          <hr style="border-top: 1px solid #b7b7b7; margin: 0 !important;">
                            
                                            <div class="price">
                                          $ {{ number_format($property_list->price,2) }}
                                            </div>
                                      <table class="table table-striped table-responsive">
                                            <tr>
                                              <td>Purpose</td>
                                              <td>{{ Str::ucfirst($property_list->type) }}</td>
                                            </tr>
                                              <tr>
                                                  <td>
                                                    Exchange
                                                  </td>
                                                    <td>
                                                     {{ Str::ucfirst($property_list->exchange) }} 
                                                     </td>
                                              </tr>
                                              <tr>
                                                <td>Property Type</td>
                                                <td>{{ Str::ucfirst($property_list->property_type) }}</td>
                                              </tr>
                                              <tr>
                                                <td>Size (sqft)</td>
                                                <td>{{$property_list->size}}</td>
                                              </tr>
                                              <tr>
                                                  <td>Bedrooms</td>
                                                  <td>{{$property_list->rooms}}</td>
                                                </tr>
                                                <tr>
                                                  <td>Bathrooms</td>
                                                  <td>{{$property_list->bathroom}}</td>
                                                </tr>
                                                <tr>
                                                  <td>Half Bathrooms</td>
                                                  <td>{{$property_list->half_bathroom}}</td>
                                                </tr>
                                                <tr>
                                                  <td>Cross streets</td>
                                                  <td>{{$property_list->cross_streets}}</td>
                                                </tr>
                                                <tr>
                                                  <td>All Cash</td>
                                                  <td>{{$property_list->all_cash}}</td>
                                                </tr>
                                                @if($property_list->monthly_maintenance !="")
                                                 <tr>
                                                  <td>Monthly maintenance</td>
                                                  <td>{{ number_format($property_list->monthly_maintenance,2)}}</td>
                                                </tr>
                                                @endif
                                                 @if($property_list->monthly_tax !="")
                                                 <tr>
                                                  <td>Monthly Tax</td>
                                                  <td>{{ number_format($property_list->monthly_tax,2)}}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                  <td>Status</td>
                                                  <td>{{$property_list->status}}</td>
                                                </tr>
                                      </table>
                                  </div>
                                  <?php $amen = $property_list['amenities'];?>
                                  @if($amen !="")
                                  <div class="col-md-12 amen" style="margin-top: 0 !important;">
                                    <hr style="border-top: 0.9px solid #b7b7b7;">
                                   
                                    <div class="amen_heading">Apartment Amenities</div>
                                   </div>
                                        <?php  
                                        $explode = explode(',', $property_list['amenities']);
                                         ?>
                                         @foreach ($amenities as $key => $value)
                                              <?php if(in_array($value->id, $explode)){ ?>
                                  <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 " style="display: flex;">
                                       <label style="color: #333;font-size: 14px;">
                                       <i class="fas fa-check-circle" style="color: green;"> </i>  
                                       {{$value->amenities_name}}
                                       </label>
                                  </div>
                                          <?php
                                           } ?>
                                       @endforeach
                               @endif        
                          @if($property_list['building_features'])             
                                  <div class="col-md-12 amen" style="margin-top: 0 !important;">
                                    <hr style="border-top: 0.9px solid #b7b7b7;">
                                    <div class="amen_heading">Building Features</div>
                                   </div>
                                     
                                        <?php  
                                        $explode1 = explode(',', $property_list['building_features']);
                                         ?>
                                         @foreach ($building as  $feature)
                                              <?php if(in_array($feature->id, $explode1)){ ?>
                                  <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 " style="display: flex;">
                                       <label style="color: #333;font-size: 14px;">
                                       <i class="fas fa-check-circle" style="color: green;"> </i>  
                                       {{$feature->feature_name}}
                                       </label>
                                  </div>
                                          <?php
                                           } ?>
                                       @endforeach 

                        @endif                
   
                  </div>
                  <div class="row" style="padding: 20px;">
                          <div class="col-sm-12">
                           <div class="descrip">Description</div>
                          </div>
                          <div class="col-sm-12">
                              <p style="color: #868686;">
                                {{$property_list->discription}}
                                </p> 
                          </div>
                    <?php $exposure = $property_list->exposure ?>
                                  @if($exposure !="")
                               <div class="col-md-6"><h4>Exposure</h4><span class="exposure">{{ $exposure }}</span>
                               </div>
                                @endif
                              
                  </div>
          </div>
      </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
  showDivs(slideIndex = 1);
});

	function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
<script type="text/javascript">
 
function show_images() {
   document.getElementById('images_hide').style.display = "block";

   $(document).ready(function()
   {
      $('.images_hide').css('display','block');
      $('.images_hide').css('display','inline-flex');
      $('.btnhide').css('display','none');

   });
}
function myFunction(x,y,z,a,b){
   var x = window.matchMedia("(max-width: 900px)")
   var a = window.matchMedia("(max-width : 823px)")
   var b = window.matchMedia("(max-width : 768px)")
   var y = window.matchMedia("(max-width : 640px)")
   var z = window.matchMedia("(max-width : 400px)")
if (x.matches) {
    document.getElementById('space').style.margin = "9px 0px 0px 0px";
  }
  if(a.matches){
    document.getElementById('space').style.margin = "7px 0px 0px 0px";
  }
  if(b.matches){
    document.getElementById('space').style.margin = "79px 0px 0px 0px";
  }
  if(y.matches){
    document.getElementById('space').style.margin = "21px 0px 0px 0px";
  }
   if(z.matches){
    document.getElementById('space').style.margin = "16px 0px 0px 0px";
  }
}

</script>
@endsection