@extends('layouts.main')
@section('content')
<style type="text/css">
.despflex{
  display: flex;
  margin-left: -5%;
}
.col-md-3.column.productbox {
    max-width: 25%;
    margin: 4px;
}
td{
  width: 20%;
  font-size: 12px;
}
a.list-group-item {
    color: #fff;
}
.padding{
  padding: 20px;
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
.new-property-list {
  .list-header {
    .row {
      margin: 40px 0;
    }
  }
}
  .property-listing {
    ::ng-deep mat-card-content {
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      height: 225px;
      position: relative;
    }

    .prop-tag {
      position: absolute;
      top: 0;
      right: 0px;
      background: rgba(0, 255, 0, 0.4);
      padding: 12px 30px;
      font-size: 14px;
      border-bottom-left-radius: 35px;
    }

    .property-info {
      position: absolute;
      bottom: 0px;
      left: 10px;
      background-color: rgba(0, 0, 0, 0.5);
      width: 100%;
      margin-left: -10px;
      padding-left:  5px;
      padding-top: 3px;
      padding-bottom: 3px;

      .badge {
        padding: 6px 10px;
        font-size: 14px;
        background-color: #ff8500;
      }

      .add1 {
        font-size: 16px;
        margin: 2px 0;
      }

      .add2 {
        font-size: 15px;
        margin: 2px 0;
        font-weight: 400;
      }
    }
  }

.f15 {
    font-size: 15px !important;
}

.color-gray {
    color: rgba(0, 0, 0, 0.6) !important;
}
.f25 {
    font-size: 25px !important;
}
.f700 {
    font-weight: 700 !important;
}

.f18 {
    font-size: 18px !important;
}
.color-orange {
    color: #28a745;
}
.f300 {
    font-weight: 300 !important;
}

.f13 {
    font-size: 13px !important;
}
svg:not(:root).svg-inline--fa {
    overflow: visible;
}
.f14 {
    font-size: 14px !important;
}
.btn-orange {
    background-color: #28a745 !important;
    color: #ffffff !important;
}
.bc-black {
    background: #202020 !important;
        color: white;
}
.btn:hover {
    color: #212529;
    text-decoration: none;
}
.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: green;
    border-color: #37a745;
}
.page-link {
    color: #37a745;
    }
    /*////new*/
    .productbox {
    background-color:#ffffff;
  padding:10px;
  margin-bottom:10px;
  -webkit-box-shadow: 0 8px 6px -6px  #999;
     -moz-box-shadow: 0 8px 6px -6px  #999;
          box-shadow: 0 8px 6px -6px #999;
}

.producttitle {
    font-weight:bold;
  padding:5px 0 5px 0;
}

.productprice {
  border-top:1px solid #dadada;
  padding-top:5px;
}

.pricetext {
  font-weight:bold;
  font-size:1.4em;
}
@media only screen and (min-width: 1025px) and (max-width: 1280px) {
}

@media only screen and (min-width: 768px) and (max-width: 1024px) {
}

@media only screen and (min-width: 601px) and (max-width: 767px) {
}

@media only screen and (min-width: 481px) and (max-width: 600px) {
}
@media screen and (max-width: 420px)
{
  .note p{
    font-size: 16px !important;
  }
  td{
    font-size: 12px;
  }
  th{
    font-size: 14px;
  }
}
</style>
<div class="container">
  <div class="row m-0">
    <div class="col-md-3 setmd">
      @include('dashboard.dashboard-sidebar')
    </div>
    <div class="col-md-9 setmd">
    @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
    <div class="note"><p style="font-size: 22px;"> My <span style="color: #41ac1b"> Buyers </span></p>
    </div>
      @if(count($list))
          <table class="table table-striped table-responsive">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Client</th>
                  <th scope="col">Price</th>
                  <th scope="col">Neighborhood</th>
                  <th scope="col">Views</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                      <?php $i=0; $p= 108; ?>
                      @foreach($list as $key => $lists)
                          <?php $i++; $p++; ?>
                          <tr>
                            <th scope="row">{{ $i }}</th>
                            @if($lists->title !="")
                            <td>{{ $lists->title }}</td>
                            @else
                              <td>Not found</td>
                            @endif
                            @if($lists->client_name !='')
                            <td>{{ $lists->client_name }}</td>
                            @else
                             <td>No client!!</td>
                            @endif
                            <td> ${{ number_format($lists->min_price,2)}} - {{ number_format($lists->max_price,2) }} </td>
                            <td> {{$lists->local_area}} </td>
                            <td> {{$lists->count}} </td>
                            <td class="despflex">
                                  <button  data-toggle="collapse" data-target="#demo{{ $i }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-plus-circle" style="color: green; font-size: 17px;"></i></button>
                                  <button data-toggle="collapse" data-target="#demo{{ $p }}" class="btn btn-default btn-xs accordion-toggle"><i class="fas fa-link" style="font-size: 17px; color: green;"></i></button>
                                  <a href="{{ url('myview/require/'.$lists->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green;" href="#"><i class="fas fa-eye"></i></a>
                                  <a href="{{ url('edit/require/'.$lists->id)}}" class="btn btn-default btn-xs" style="font-size: 17px; color: green;" href="#"><i class="fa fa-pencil-square"></i></a>
                                  <a href='{{ url("delete/requirement/{$lists->id}") }}' onclick="return confirm('Are you sure to delete this Buyer Listing?')"  class=" btn btn-default btn-xs" style="font-size: 17px; color: green;" title="delete"><i class="fas fa-minus-circle"></i></a>
                            </td>
                          </tr>
                          <tr>
                              <td colspan="12" class="hiddenRow">
                                  <div class="accordian-body collapse" id="demo{{ $i }}"> 
                                      <table class="table table-striped table-dark table-responsive">
                                              <thead>
                                                <tr>
                                                  <th>Address</th>
                                                  <th>Property Type</th>
                                                  <th>Type</th>
                                                  <th>exchange</th>
                                                  <th>All Cash</th>
                                                  <th>Bathroom</th>
                                                  <th>Rooms</th></tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <td>{{$lists->city_name}}</td>
                                                  <td> {{ Str::ucfirst($lists->property_type) }} </td>
                                                  <td>{{ Str::ucfirst($lists->purpose) }}</td>
                                                  <td>{{$lists->exchange}}</td>
                                                  <td>{{ Str::ucfirst($lists->all_cash)}}</td>
                                                  <td>{{$lists->min_bathroom}} - {{ $lists->max_bathroom }}</td>
                                                  <td>{{$lists->min_room}} - {{$lists->max_room}}</td></tr>
                                        </tbody>
                                  </table>
                                </div>
                              </td>
                          </tr>

                          <!-- Related properties -->
                          <tr>
                              <td colspan="11" class="hiddenRow 1"><div class="accordian-body collapse 1" id="demo{{ $p }}"> 
                                <table class="table table-striped table-dark table-responsive">
                                        <thead>
                                          <tr><th>Related Properties</th><th></th><th></th><th></th></tr>
                                        </thead>
                                        <tbody>
                                          
                                        </tbody>
                                  </table>
                                      <div class="row text-center bg-color color-gray p-3">
                                        @if(count($match[$lists->id]))
                                          <?php $limit = 0;  ?>
                                          @foreach($match[$lists->id] as $matches)
                                            <?php 
                                              if($limit == 4){ break; }
                                            ?>
                                            <div class="col-md-3 column productbox">
                                                <div class="producttitle">{{ Str::substr($matches->title,0,5)}}</div>
                                                <div class="productprice"><div class="pull-right"><a href="{{ url('property/detail/pub/'.$matches->id)}}" class="btn btn-success btn-sm" role="button">See</a></div><div class="pricetext">${{ number_format($matches->price,2)}} </div>
                                                </div>
                                            </div>
                                            <?php $limit++; ?>
                                          @endforeach
                                        @else 
                                        <p> No related property found! </p>
                                        @endif
                                      </div>
                                </div>
                                </td>
                          </tr>
                      @endforeach
              </tbody>
          </table>
      @else
      <p class="padding">
          No Requirement found!!!
      </p>
      @endif
 {!! $list->render() !!}

  </div>
</div>
@endsection
