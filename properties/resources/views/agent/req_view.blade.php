@extends('layouts.main')
@section('content')
<style type="text/css">
td{
    width: 15%;
}
a.list-group-item {
    color: #fff;
}

	.color-orange{
		color: #b0b1b0;
	}
	.f13 {
		padding-right: 0;
    font-size: 13px !important;
}
.viewbtn{
     border-radius: 20px; width: 100%; background-color: #b0b1b0;
    }
    .editbtn{
    	border-radius: 20px; width: 100%; background-color: green; color: white;
    }
.mg{
	margin-top: 2%;
}
.card-title{
	font-size: 29px;
	font-weight: bold;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: green;
}
.page-link {
    color: #37a745;
    }
    .descrip{
    	height: 40px;
    }
    .rmt{
    	margin-top: 4%;
    }
 .note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
   /* background-color: #4fad26;*/
    font-weight: bold;
    line-height: 80px;
}
div#main {
    background-color: #f3f3f3;
}
.titlepro
{
	/*font-family: 'Farro', sans-serif;*/
	font-size: 30px;
	color: green;
	padding: 2px;
}
.addresspro{
	color: gray;
}
.fontfac{
	text-align: center;
	margin-top: 9px;
	font-size: 19px;
}
.price{color: green;font-weight: bold;font-size: 25px;padding: 3px;}
.min-max{
    font-size: 12px; padding: 0; margin: 0;
}
@media screen and (max-width: 414px)
{
    th{
        font-size: 11px;
    }
}
</style>
<div class="container">
    <div class="row m-0">
        		<div class="col-md-3 setmd">
        			@include('dashboard.dashboard-sidebar')
        		</div>
	    <div class="col-md-9 setmd">
            <div class="content" style="background-color: white;">
            @if(Session::has('flash_message_update'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_update') !!}</strong>
                    </div>
            @endif
            	    <div class="note"><p style="font-size: 22px;"> My <span style="color: #41ac1b">Buyer Requirement </span></p>
                    </div>
                @if(!empty($req))
			        <div class="row" style="padding: 20px;" >
        				<div class="col-md-12 col-sm-12">
                				<div class="titlepro">{{$req->title}}
                                </div>
                				<div class="addresspro">
                                <i class="fa fa-map-marker" style="color: green;"></i>
                                 {{$req->city_name}} , {{$req->local_area}}
                				</div>
                    				<hr style="border: 0.6px solid gray;">
                    		<div class="facility">
                                <div class="row">
                                    <div class="col-sm-12">
                                              <div class="price">
                                             $ {{ number_format($req->min_price,2) }} - {{ number_format($req->max_price,2)}}</div>
                                        <table class="table table-striped table-responsive">
                                                <thead>
                                                  <tr>
                                                   <th scope="col">Property Type</th>
                                                    <th scope="col">Exchange</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">All Cash</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                  <td> {{ Str::ucfirst($req->property_type) }} </td>
                                                    <td> {{ Str::ucfirst($req->exchange) }} </td>
                                                    <td> {{ Str::ucfirst($req->purpose)}} </td>
                                                    <td> {{ Str::ucfirst($req->all_cash)}}</td>
                                                  </tr>
                                                </tbody>
                                        </table>
                                            <button id="change_text" class="btn btn-default btn-xs btn" style="background-color: green; color: white;" data-toggle="collapse" data-target="#demo" class="accordion-toggle">
                                            More..
                                            </button>
                                        <div class="ab" style="margin-top: 5%;">
                                            <tr>
                                                <td colspan="11" class="hiddenRow 1">
                                                    <div class="accordian-body collapse 1" id="demo"> 
                                                        <table class="table table-striped table-responsive">
                                                            <thead>
                                                                  <tr><th>Rooms<p class="min-max">(min - max)</p></th><th>Bathroom<p class="min-max">(min - max)</p></th>
                                                                  </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                  <td>{{$req->min_room}} - {{$req->max_room}}</td>
                                                                  <td>{{$req->min_bathroom}} - {{$req->max_bathroom}}</td>
                                                                 
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </div>
                                    </div>
                                </div>   
                    		</div>
            			</div>		
            		</div>
                                      <div class="row" style="padding: 20px; margin-top: -5%;">
                                      @if($req->amenities != "")
                                        <div class="col-sm-12 amenties">
                                            <div style="font-weight: 600; font-size: 19px;"><h4>Apartments Amenities</h4>
                                             <hr>
                                            </div> 
                                          </div> 
                                          <?php  
                                        $explode = explode(',', $req['amenities']);
                                         ?>   
                                          @foreach ($amenities as $key => $value)
                                               <?php if(in_array($value->id, $explode)){ ?>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 text-center" style="display: flex;">
                                              <label style="color: #333;font-size: 14px;"><i class="fas fa-check-circle" style="color: green;"></i>  {{$value->amenities_name}} </label>
                                             </div>
                                              <?php
                                               } ?>
                                          @endforeach
                                    @endif
                              @if($req->building_features != "")
                                     <div class="col-sm-12 amenties">
                                            <div style="font-weight: 600; font-size: 19px;"><h4>Building features</h4>
                                             <hr>
                                            </div> 
                                          </div> 
                                          <?php  
                                        $explode1 = explode(',', $req['building_features']);
                                         ?>   
                                          @foreach ($building_features as $building_featuress)
                                               <?php if(in_array($building_featuress->id, $explode1)){ ?>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 text-center" style="display: flex;">
                                              <label style="color: #333;font-size: 14px;"><i class="fas fa-check-circle" style="color: green;"></i>  {{$building_featuress->feature_name}} </label>
                                             </div>
                                              <?php
                                               } ?>
                                          @endforeach
                                    @endif

                                          <div class="col-sm-12">
                                           <div style="font-size: 22px; font-weight: 500; margin-top: 5%;">Description</div>
                                          <p style="color: #868686;">
                                              {{$req->discription}}
                                                </p> 
                                          </div>
                                    </div>   
	            @endif			
	    </div>
    <div>
  </div>
 </div>
 </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
        $("#change_text").click(function(){
            $(this).text($(this).text() == 'Less...' ? 'More...' : 'Less...');
        });
    });
</script>

@endsection