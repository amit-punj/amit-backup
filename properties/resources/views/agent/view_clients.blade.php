@extends('layouts.main')
@section('content')
<style type="text/css">
.reqprop{
    font-size: 22px;
  }
  .despflex{
    display: flex;
  }
  .table td, .table th {
    font-size: 12px;
  }
  td{
    width: 20%;
  }
.note
{
    text-align: center;
    height: 80px;
    background-color:  #0f2b61;
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
@media screen and (max-width: 990px)
{
  table.table{
    margin-left: 17%;
  }
}
@media screen and (max-width: 767px)
{
  table.table{
    margin-left: unset;
  }
}
</style>
<div class="container">
	<div class="row m-0">
		<div class="col-md-3 setmd">
			@include('dashboard.dashboard-sidebar')
		</div>
		<div class="col-md-9 setmd">
				 <div class="note"><p style="font-size: 22px;">  My  <span style="color: #41ac1b">  Client  </span> View </p>
		         </div>
		         <div class="row">
		         <div class="col-md-12">
		          <table class="table">
                              <tbody>   
                                      @if($slider_detail->fname !="")
                                      <tr>
                                          <td class="bold">First Name</td>
                                          <td class="bold2">{{ $slider_detail->fname}}</td>
                                      </tr>
                                      @endif
                                      <tr>
                                          <td class="bold">Last Name</td>
                                          <td class="bold2">{{ $slider_detail->lname}}</td>
                                      </tr>
                                      <tr>
                                          <td class="bold">Email</td>
                                          @if($slider_detail->email != "")
                                          <td class="bold2">{{ $slider_detail->email}}</td>
                                          @else
                                           <td class="bold2">Not found!!</td>
                                          @endif
                                      </tr>
                                    
                                      <tr>
                                          <td class="bold">Phone Number</td>
                                          @if($slider_detail->mobile !="")
                                          <td class="bold2">{{ $slider_detail->mobile}}</td>
                                          @else
                                           <td class="bold2">Not found!!!</td>
                                          @endif
                                      </tr>
                                     
                                      <tr>
                                          <td class="bold">Created Date </td>
                                        
                                          <td class="bold2">{{ $slider_detail->created_at}}</td>
                                      </tr>
                                  </tbody>
                               </table>

		         </div>
		     </div>
           <div class="requirement">      
                  <span class="reqprop">Buyers</span>
                  <hr style="border: 1px solid #37a65a;">
                  @if(count($list))
                 <table class="table table-striped table-responsive">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">exchange</th>
                    <th scope="col">Property Type</th>
                    <th scope="col">Neighborhood</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $number=0; $i=01111; $p= 108; ?>
                  @foreach($list as $key => $lists)
                  <?php $number++; $i++; $p++; ?>
                  <tr>
                    <th scope="row">{{ $number }}</th>
                    <td>{{ $lists->title }}</td>
                    <td> {{$lists->min_price}} - {{ $lists->max_price }} </td>
                      <td>{{$lists->exchange}}</td>
                      <td> {{ Str::ucfirst($lists->property_type) }} </td>
                    <td> {{$lists->local_area}} </td>
                    <td class="despflex">
                          <button  data-toggle="collapse" data-target="#demo{{ $i }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 17px;"></i>
                          </button>
                         
                          <a href="{{ url('myview/require/'.$lists->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green !important;" href="#"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="12" class="hiddenRow">
                      <div class="accordian-body collapse" id="demo{{ $i }}"> 
                          <table class="table table-dark table-responsive">
                              <thead>
                                <tr>
                                  <th>Address</th>
                                  <th>Type</th>
                                  <th>All Cash</th>
                                  <th>Bathroom</th>
                                  <th>Rooms</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{$lists->city_name}}</td>
                                  <td>{{ Str::ucfirst($lists->purpose) }}</td>
                                  <td>{{ Str::ucfirst($lists->all_cash)}}</td>
                                  <td>{{$lists->min_bathroom}} - {{ $lists->max_bathroom }}</td>
                                  <td>{{$lists->min_room}} - {{$lists->max_room}}</td>
                                </tr>
                            </tbody>
                          </table>
                      </div>
                    </td>
                  </tr>

        <!-- Related properties -->
             <tr>
             </tr>
             @endforeach
           </tbody>
         </table>
        @else
       <p style="padding: 10px;">
       No buyer found!!!
       </p>
      @endif
    </div>   
<span class="reqprop">Properties</span>
<hr style="border: 1px solid #37a65a;">
 @if(count($property_list))
                   <table class="table table-striped table-responsive">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col"> Purpose </th>
                             <th scope="col"> exchange </th>
                            <th scope="col">Neighborhood</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                    <tbody>
                 
                        <?php $x=0; ?>
                        @foreach($property_list as $key => $properties)
                        <?php $x++; ?>
                        <tr>
                          <th scope="row">{{ $x }}</th>
                          <td>{{ $properties->title }}</td>
                          <td>{{ $properties->price }} </td>
                          <td>{{ str_replace("_"," ",$properties->purpose) }}</td>
                          <td>{{$properties->exchange}}</td>
                          <td> {{$properties->local_area}} </td>
                          <td class="despflex"><button data-toggle="collapse" data-target="#demo{{ $x }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 20px;"></i></button>
                          <a href="{{url('property/detail/'.$properties->id)}}" class="btn btn-default btn-xs" style="font-size: 20px; color: green !important;" href="#"><i class="fas fa-eye"></i></a>
                          </td>
                        </tr>
                        <tr>
                        <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo{{ $x }}"> 
                          <table class="table table-striped table-dark table-responsive">
                                  <thead>
                                    <tr>
                                    <th> Address </th>
                                    <th scope="col"> Property Type </th>
                                  
                                    <th> All Cash </th>
                                    <th> Bathroom </th>
                                    <th> Rooms </th></tr>
                                  </thead>
                                  <tbody class="table-text">
                                    <tr>
                                      <td>{{$properties->city_name}}</td>
                                      <td> {{ Str::ucfirst($properties->property_type) }} </td>
                                 
                                      <td>{{ Str::ucfirst($properties->all_cash)}}</td>
                                      <td>{{$properties->bathroom}}</td>
                                      <td> {{$properties->rooms}}</td>
                                    </tr>
                            </tbody>
                      </table>
                      </div>
                      </td>
                </tr>
    @endforeach
  </tbody>
</table>

        <!-- Related properties -->
                     
    
    @else
    <p style="padding: 10px;">
    No property found!!!
    </p>
    @endif
		</div>
		</div>         


@endsection