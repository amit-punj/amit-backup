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
{
  text-align: center;height: 80px;background-color:  #0f2b61;color: #fff;font-weight: bold;line-height: 80px;
}
div#main {background-color: #f3f3f3;}
.vl {border-right: 1px solid #b7b7b7;height: 100;}
.title{font-size: 23px;font-weight: bold;}
.price{color: green;font-weight: bold;font-size: 21px;padding: 3px;}
.rooms{font-size: 22px;}
.heading{text-align: center;}
/*.table thead th {font-size: 11px;}*/
.shadow{border:2px solid #fff; background: url(img/tiger.png) no-repeat; box-shadow: 10px 10px 5px #ccc; -moz-box-shadow: 10px 10px 5px #ccc;-webkit-box-shadow: 10px 10px 5px #ccc; -khtml-box-shadow: 10px 10px 5px #ccc;}
.addresspro{color:#868686; }
.btnhide{
/*  background-image: url('images/icons/more.svg');*/
  box-shadow: inset 0px 0px 10px rgba(0,0,0,0.9);
/*  opacity: 0.7;*/
}
.active_listing{
  font-size: 14px;
}
.btn{
  background-color: none;
}
.amen_heading{
  font-size: 22px; font-weight: 500;
}
img.mySlides.shadow {
  height: 400px;
  }
  .profile{
    margin-top: 3%;
    font-size: 19px;
  }
  .content-padding
  {
    padding: 20px;
  }
@media only screen and (max-width: 1024px)
{
 

}
@media only screen and (max-width: 823px){
  .pank{
  margin-top: 5%;
}
}
@media only screen and (max-width: 768px)
 {
  .btnhide{
        font-size: 12px;
        width: 23% !important;
    height: 80px !important;
  }
  img.demo.w3-opacity.w3-hover-opacity-off.shadow.w3-opacity-off {
    width: 23% !important; 
 }
img.demo.w3-opacity.w3-hover-opacity-off.shadow {
  width: 23% !important;
 }
}
@media screen and (max-width:640px ){
 img.demo.w3-opacity.w3-hover-opacity-off.shadow {
  height: 55px;
 }
 .amen_heading{
  font-size: 22px; font-weight: 300;
}
 img.mySlides.shadow {
  height: 300px;
  } 
  td{
    font-size: 14px;
  }
  .note p{
    font-size: 19px !important;
  }
    .dec{
  font-size: 21px !important;
}
.title {
  font-size: 19px;
}
  .amen_heading{
  font-size: 19px; font-weight: 300;
}

}
@media screen and (max-width: 533px){
  img.mySlides.shadow {
  height: 275px;
  }
  .btnhide{
    height: 53px !important;
  }
}
@media screen and (max-width: 411px){
  .content-padding
  {
    padding: 10px;
  }
  .container{
    padding: 0;
  }
}
@media screen and (max-width: 320px){
  img.demo.w3-opacity.w3-hover-opacity-off.shadow.w3-opacity-off {
    height: 40px;
}
img.demo.w3-opacity.w3-hover-opacity-off.shadow {
  height: 40px;
}
p{
  font-size: 12px;
}
img.mySlides.shadow{
  height: 170px;
}
.dec{
  font-size: 21px !important;
}
 td{
    font-size: 12px;
  }

}


</style>


<div class="container">
  <div class="row m-0">
    <div class="col-md-12">
      <div class="content" style="background-color: white;">
                             <div class="note"><p style="font-size: 22px;">Property<span style="color: #41ac1b"> Detail </span></p>
                              </div>
          <div class="row content-padding">
                          <div class="col-lg-8 col-md-12 col-sm-12">
                                    @if(count($property_images) > 0 )
                                        @foreach($property_images as $property_image)
                                           <img class="mySlides shadow" src="{{ asset('images/'.$property_image->image_name)}}" style="width:100%; display: none;" >
                                        @endforeach
                                     @else
                              <img src="{{asset('images/noimage.jpg')}}" class="shadow" style="width:100%;" height="300" width="500">
                               @endif
                            <div class="col-md-12" style="padding: 0; margin-top: 2%;">
                                     <?php $i = 0;  $count=0;?>
                                    @if(count($property_images) > 0 )
                                       @foreach ($property_images as $property_image)
                                          <?php $i++;?>
                                         
                                        <?php if($i > 8)
                                         {
                                          $count++; 
                                          ?>
                                           <img id="images_hide" class="images_hide demo ff w3-opacity w3-hover-opacity-off shadow" src="{{asset('images/'.$property_image->image_name)}}" style="width:16%;cursor:pointer; display: none;" onclick="currentDiv({{ $i }})" height="100">
                                            <?php
                                            if($i > 14)
                                            {
                                              break;
                                            }
                                          } 
                                          else
                                          { 
                                            ?>
                                               <img class="demo w3-opacity w3-hover-opacity-off shadow" src="{{asset('images/'.$property_image->image_name)}}" style="width:16%;cursor:pointer" onclick="currentDiv({{ $i }})" height="100" width="300">
                                       <?php   }
                                          ?> 
                                          @endforeach
                                              @if(count($property_images) > 8)
                                             <button class="btn btnhide" onclick="show_images(); myFunction()" style="width: 16%; height: 93px;">More {{ $count }} +</button>
                                             @endif
                                        @else
                                            <img src="{{asset('images/noimage.jpg')}}" style="width:21%;" height="100" width="300" class="shadow">
                                        @endif
                            </div>
                          </div>
                          @if(isset($property_list))  
                                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 pank">
                                          <div class="title">
                                          {{$property_list->title}}
                                          </div>
                                          <div class="addresspro">
                                               <i class="fa fa-map-marker" style="color: green;"></i> {{$property_list->city_name}} , {{$property_list->local_area}} ,{{ $property_list->zipcode }}
                                          </div>
                                          <hr>
                                          <div class="profile">
                                          <table class="table table-striped table-responsive">
                                            <tbody>
                                              <tr>
                                                <td>Posted By</td>
                                                <td><a style="color: green;" href="{{ url('property/user/view/'.$user->id) }}">{{ $user->fname }}</a></td>
                                              </tr>
                                              @if($property_list->purpose == 'active_listing')
                                              <tr>
                                              <td class="active_listing">Address</td>
                                              <td class="active_listing">{{ $property_list->address}}</td>
                                              </tr>
                                              @endif
                                              <tr>
                                                <td>
                                                  Purpose
                                                </td>
                                                <td>
                                                  {{ Str::ucfirst($property_list->type)}}
                                                </td>
                                              </tr>

                                            </tbody>
                                          </table>
                                          </div>
                                          <hr style="border-top: 1px solid #b7b7b7;">
                            
                                            <div class="price">
                                            $ {{ number_format($property_list->price,2) }} USD 
                                            </div>
                                      <table class="table table-striped table-responsive">
                                        <tbody>
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
                                                  <td>{{$property_list->monthly_maintenance}}</td>
                                                </tr>
                                                @endif
                                                 @if($property_list->monthly_tax !="")
                                                 <tr>
                                                  <td>All Tax</td>
                                                  <td>{{$property_list->monthly_tax}}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                  <td>Status</td>
                                                  <td>{{$property_list->status}}</td>
                                                </tr>
                                             </tbody>   
                                      </table>
                                  </div>
                            
                                  <div class="col-md-12 amen">
                                    <hr style="border-top: 0.9px solid #b7b7b7;">
                                   
                                    <div class="amen_heading">Amenities</div>
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
                              <div class="col-md-12 amen">
                                    <hr style="border-top: 0.9px solid #b7b7b7;">
                                   
                                    <div class="amen_heading">Building features</div>
                                   </div>
                                     
                                        <?php  
                                        $explode1 = explode(',', $property_list['building_features']);
                                         ?>
                                         @foreach ($building_features as  $valuess)
                                              <?php if(in_array($valuess->id, $explode1)){ ?>
                                  <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 " style="display: flex;">
                                       <label style="color: #333;font-size: 14px;">
                                       <i class="fas fa-check-circle" style="color: green;"> </i>  
                                       {{$valuess->feature_name}}
                                       </label>
                                  </div>
                                          <?php
                                           } ?>
                                       @endforeach         
                                    
                   </div>
                  <div class="row content-padding">
                          <div class="col-sm-12">
                           <div class="dec" style="font-size: 22px; font-weight: 500;">Description</div>
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
            @endif      
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
      $('.amen').css('margin-top','0');

   });
}
function myFunction(x,y,z,a,b){
   var x = window.matchMedia("(max-width: 900px)")
   var a = window.matchMedia("(max-width : 823px)")
   var b = window.matchMedia("(max-width : 768px)")
   var y = window.matchMedia("(max-width : 640px)")
   var z = window.matchMedia("(max-width : 400px)") 
if (x.matches) { // If media query matches
    document.getElementById('space').style.margin = "108px 0px 0px 0px";
  }
  if(a.matches){
    document.getElementById('space').style.margin = "113px 0px 0px 0px";
  }
  if(b.matches){
    document.getElementById('space').style.margin = "79px 0px 0px 0px";
  }
  if(y.matches){
    document.getElementById('space').style.margin = "21px 0px 0px 0px";
  }
   if(z.matches){
    document.getElementById('space').style.margin = "57px 0px 0px 0px";
  }
}

</script>
@endsection