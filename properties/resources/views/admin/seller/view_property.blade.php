<style type="text/css">
body {
  margin: 0;
  font-family: Arial;
  overflow-x: unset !important;
}
img.mySlides.shadow {
width: 600px;
height: 400px;
}
</style>
@extends('admin.layouts.app')
@section('content')
<div style="margin-left: 10px;">
 <div class="card mb-4">
		<div class="card-body">
<h2>Property Detail</h2>
            
               <div class="col-lg-8 col-md-12 col-sm-12" style="margin-bottom: 3%;">
                                    @if(count($property_images) > 0 )
                                        @foreach($property_images as $property_image)
                                           <img class="mySlides shadow" src="{{ asset('images/'.$property_image->image_name)}}" style=" display: none;" >
                                        @endforeach
                                     @else
                              <img src="{{asset('images/noimage.jpg')}}" class="shadow" style="" height="300" width="500">
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
            
			<table class="table user-view-table m-0">
				<tbody>
 			<div class="subbutton" style="float: right; margin-top: -5%; margin-right: 10px;">
				</div>
				  <?php  
                  $explode = explode(',', $property_detail['amenities']);
                  $explode1 = explode(',', $property_detail['building_features']);
                ?>
                	<tr>
						<td>Owner:</td>
						<td>
							@foreach($users as $user)
								@if($user->id == $property_detail->user_id)
									{{ $user->name }}
								@endif
							@endforeach

						</td>
					</tr>
					<tr>
						<td>Title:</td>
						<td>{{ $property_detail->title }}</td>
					</tr>
					<tr>
						<td>Address:</td>
						<td>{{ $property_detail->address }}</td>
					</tr>
					<tr>
						<td>City:</td>
						<td>{{ $property_detail->city_name }}</td>
					</tr>
					<tr>
						<td>Zipcode:</td>
						<td>{{ $property_detail->zipcode }}</td>
					</tr>
					<tr>
						<td>Property type:</td>
						<td>{{ $property_detail->property_type }}</td>
					</tr>
					<tr>
						<td>Price $:</td>
						<td>${{ $property_detail->price }} </td>
					</tr>
					<tr>
						<td>Purpose:</td>
						<td>{{ $property_detail->purpose }}</td>
					</tr>
					<tr>
						<td>Type:</td>
						<td>{{ $property_detail->type }}</td>
					</tr>
					<tr>
						<td>Cross streets:</td>
						<td>{{ $property_detail->cross_streets }}</td>
					</tr>
					<tr>
						<td> Rooms:</td>
						<td>{{ $property_detail->rooms}} </td>
					</tr>
					<tr>
						<td>All cash :</td>
						<td>{{ $property_detail->all_cash }}</td>
					</tr>
					<tr>
						<td>Exchange :</td>
						<td>{{ $property_detail->exchange }}</td>
					</tr>
					<tr>
						<td> Bathroom :</td>
						<td>{{ $property_detail->bathroom }}</td>
					</tr>
					<tr>
						<td>Half Bathroom :</td>
						<td>{{ $property_detail->half_bathroom }}</td>
					</tr>
					<tr>
						<td>Monthly Tax $ :</td>
						<td>${{ $property_detail->monthly_tax }}</td>
					</tr>
					<tr>
						<td>Monthly maintenance $ :</td>
						<td>${{ $property_detail->monthly_maintenance }}</td>
					</tr>
					<tr>
						<td>exposure :</td>
						<td>{{ $property_detail->exposure }}</td>
					</tr>
					<tr>
						<td>Size (sq-ft) :</td>
						<td>{{ $property_detail->size }}</td>
					</tr>
					<tr>
						<td>Discription :</td>
						<td>{{ $property_detail->discription }}</td>
					</tr>
					<tr>
						<td>Apartment amenties :</td>
						<td>
						<?php
							foreach ($amenities as $key => $value) {
								if(in_array($value->id, $explode))
								{
									$abc[]=  $value->amenities_name;
								}
							}
							if(isset($abc))
							{
							echo implode(',', $abc);
						}
						else{
							echo"No Apartment amenities Found !!!";
						}
						?>
						</td>
					</tr>
					<tr>
						<td>Building features :</td>
						<td>
						<?php
							foreach ($building_features as $value2) {
								if(in_array($value2->id, $explode1))
								{
									$abcd[]=  $value2->feature_name;
								}
							}
							if(isset($abcd))
							{
							echo implode(',', $abcd);
						}
						else{
							echo"No Building features found!!!";
						}
						?>
						</td>
					</tr>
                </tbody>
			  </table>    
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
			 function myFunction(imgs) {
			  var expandImg = document.getElementById("expandedImg");
			  var imgText = document.getElementById("imgtext");
			  expandImg.src = imgs.src;
			  imgText.innerHTML = imgs.alt;
			  expandImg.parentElement.style.display = "block";
			}
</script>
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