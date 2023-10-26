@section('title','List of Units')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List of Units'])
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                        {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
                @endif
                <div class="row">
                    @if(count($propertiesWithBuilding) > 0)
                    @foreach ($propertiesWithBuilding as $property)
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="building-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="building-main">
                                        <div class="building-title">Building</div>
                                        <div class="building-edit">
                                            @if (!Auth::guest())
                                                @if(Auth::user()->user_role == 2 || Auth::user()->user_role == 3)
                                                    <a class="delete_building" href="{{ url('delete-property/'.$property['building_id']->id) }}" data-count="{{$property['active_unit_count']}}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                    <a class="edit" href="{{ url('building-details/'.$property['building_id']->id) }}"><span class="glyphicon glyphicon-eye-open" title="Edit"></span></a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="building-detail">
                                                <div class="unit-info">
                                                    <span>Name : </span> {{ substr($property['building_id']->unit_name,0,20) }}... 
                                                </div>
                                                <div class="unit-info">
                                                    <span>Address : </span> {{ substr($property['building_id']->address,0,30) }}... 
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="col-sm-12">
                                    @if(count($property['data']) > 0)
                                    @foreach ($property['data'] as $unit)
                                    @if((count($property['data']) > 2 ) &&($loop->index > 1))
                                    <div class="unit-body showallbuildingunit">
                                    @else
                                    <div class="unit-body">
                                    @endif
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="unit-icon">
                                                @if($unit->u_type == 'residential')
                                                    <span class="glyphicon glyphicon-home"></span>
                                                @else
                                                    <span class="fa fa-building" aria-hidden="true"></span>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="unit-info-main">
                                                    <div class="unit-info">
                                                        <span>Name : </span> {{ substr($unit->unit_name,0,10) }}... 
                                                    </div>
                                                    <div class="unit-info"><span>Rent : </span> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{$unit->rent }} </div>
                                                    @if($unit->booking_status == 2)
                                                    <div class="unit-info status_onrent"><span>Occupied </span></div>
                                                    @else
                                                    <div class="unit-info status_indraft"><span>UnOccupied</span></div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="unit-discription"><span>{{ substr($unit->description,0,50) }}...</div>
                                            </div>
                                            <div class="col-sm-3">
                                                 <div class="unit-edit">
                                                    @if (!Auth::guest())
                                                        @if(Auth::user()->user_role == 2 || Auth::user()->user_role == 3)
                                                            <a class="delete" href="{{ url('delete-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                            <a class="edit" href="{{ url('edit-unit/'.$unit->id) }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
                                                        @endif
                                                    @endif
                                                    <a class="view_detail" href="{{ url('propertydetails/'.$unit->id) }}">View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                     @if(count($property['data']) > 2 )
                                    <div class="showallbuildingunit_button">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#showallbuildingunit">
                                            Show All
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="line"></div>
                    <div class="unit-title">Units</div>
                    @if(count($propertiesWithoutBuilding) > 0)
                    @foreach ($propertiesWithoutBuilding as $property)
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        @if( (count($propertiesWithoutBuilding) > 4) && ($loop->index > 3))
                        <div class="building-body showall">
                        @else
                        <div class="building-body">
                        @endif
                            <div class="row">
                                <div class="col-sm-12">
                                   <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="unit-icon">
                                                @if($property->u_type == 'residential')
                                                    <span class="glyphicon glyphicon-home"></span>
                                                @else
                                                    <span class="fa fa-building" aria-hidden="true"></span>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="unit-info-main">
                                                    <div class="unit-info">
                                                        <span>Name : </span> {{ substr($property->unit_name,0,10) }}... 
                                                    </div>
                                                    <div class="unit-info"><span>Rent : </span> {{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $property->rent }} </div>
                                                    @if($property->booking_status == 1)
                                                    <div class="unit-info status_onrent"><span>  OccuPied </span>  </div>
                                                    @else
                                                    <div class="unit-info status_indraft"><span>UnOccuPied </span> </div>
                                                    @endif
                                                    @if(isset($property->current_contracts->start_date))
                                                        @php 
                                                            $diff = strtotime($property->current_contracts->end_date) - strtotime(date('Y/m/d'));
                                                            // 1 day = 24 hours 
                                                            // 24 * 60 * 60 = 86400 seconds 
                                                            $days = (round($diff / 86400))
                                                        @endphp
                                                    <div class="unit-info status_onrent" style="width: max-content;"><span>Date : </span>From {{$property->current_contracts->start_date}} To 
                                                        @if( $days < 30 )
                                                            <span style="color: red;">{{$property->current_contracts->end_date}} </span>
                                                        @elseif( $days < 60 )
                                                            <span style="color: orange;">{{$property->current_contracts->end_date}} </span>
                                                        @else
                                                            <span>{{$property->current_contracts->end_date}} </span>
                                                        @endif                      
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="unit-discription"><span>{{ substr($property->description,0,50) }}...</div>
                                            </div>
                                            <div class="col-sm-3">
                                                 <div class="unit-edit">
                                                    <?php
                                                        $unitPermission = App\Helpers\Helper::accessPermission(
                                                                    $property->user_id, 
                                                                    Auth::user()->user_role, 
                                                                    'unit_permission');
                                                    ?>
                                                    @if (!Auth::guest())
                                                        @if(Auth::user()->user_role == 2)
                                                            <a class="delete" href="{{ url('delete-unit/'.$property->id) }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                            <a class="edit" href="{{ url('edit-unit/'.$property->id) }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
                                                        @elseif(Auth::user()->user_role == 3)
                                                            @if($unitPermission == 2)
                                                            <a class="delete" href="{{ url('delete-unit/'.$property->id) }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                            <a class="edit" href="{{ url('edit-unit/'.$property->id) }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
                                                            @elseif($unitPermission == 0)
                                                            <a class="edit" href="{{ url('list-meters/'.$property->id) }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
                                                            @else
                                                            <a class="edit" href="{{ url('edit-unit/'.$property->id) }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
                                                            @endif
                                                        @elseif((Auth::user()->user_role == 4) || (Auth::user()->user_role == 5))
                                                            <a class="edit" href="{{ url('list-meters/'.$property->id) }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
                                                        @endif
                                                    @endif
                                                    <a class="view_detail" href="{{ url('propertydetails/'.$property->id) }}">View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if(count($propertiesWithoutBuilding) > 4)
                        <div class="showall_button">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#showall">
                                Show All
                            </button>
                        </div>
                    @endif
                    @if( (count($propertiesWithoutBuilding) <= 0) && (count($propertiesWithBuilding) <= 0) )
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="not_found">Not Found any Unit or Building</div>
                            </div>
                        </div>
                    @endif
                </div> 
            </div>
        </div>
    </div> 
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.delete').click(function(e){
                e.preventDefault();
               var href      = jQuery(this).attr('href');
               var result = confirm("Want to Delete Unit?");
               if (result) {
                   window.location = href;
               }
            }); 
            jQuery('.delete_building').click(function(e){
                e.preventDefault();
               var href      = jQuery(this).attr('href');
               var count      = jQuery(this).data('count');
               if(count > 0)
               {
                    var result1 = confirm("Sorry! You can not delete this building. One unit is active now.");
                    return false;
               }
               else
               {
                    var result = confirm("Want to Delete Building? Unit of this building will also delete.");
               }
               if (result) {
                    window.location = href;
               }
            }); 
            jQuery('.showall_button').click(function(){
                jQuery('.building-body.showall').show();
                jQuery('.showall_button').hide();
            });
            jQuery('.showallbuildingunit_button').click(function(){
                jQuery('.unit-body.showallbuildingunit').show();
                jQuery('.showallbuildingunit_button').hide();
            });
        });
    </script>
    <style type="text/css">
        .line {width: 98%; display: block; height: 1px; background: #f28401; margin: 2% 0 2% 1%; float: left; box-sizing: border-box; }
        .unit-title {display: block; float: left; width: 100%; text-align: center; font-size: 33px; font-weight: normal; }
        .building-detail {padding: 15px 0; }
        .showall_button {text-align: center; padding: 20px 0 30px; display: block; float: left; width: 100%; }
        .showallbuildingunit_button{text-align: center; padding: 0; display: block; float: left; width: 100%; }
        .building-body.showall ,.unit-body.showallbuildingunit {display: none; }
        .not_found {padding: 20px; font-size: 15px; }
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .building-body{border: 1px solid #f28401; padding: 15px; margin: 15px 0;     min-height: 165px;}
        .unit-body {border-bottom: 1px solid #f28401;  margin: 15px 0; background-color: #F0F0F0; width: 100%;     float: left;}
        .unit_number {font-size: 18px; }
        /*.unit-body span {font-size: 15px; font-weight: bold; color: #f28401; }*/
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .list-units-title {font-size: 28px; }
        .unit-home span {font-size: 40px; margin-top: 10px; }
        .unit-delete {position: absolute; top: 0; right: 10px; }
        .building-edit {width: 50%; float: left; text-align: right; margin-top: 15px;}
        .unit-edit {width: 100%; float: left; text-align: right; margin-top: 17px;}
        .building-edit span ,.unit-edit span{color: #fff; font-weight: bold; }
        .building-main {   border-bottom: 1px solid #f28401;     padding-bottom: 15px; width: 100%; float: left; }
        .building-title {font-size: 33px; font-weight: normal; float: left; width: 50%; }
        .building-edit a.edit {background-color: #202020; padding: 10px 15px; }
        .unit-edit a.edit {background-color: #202020; padding: 20px 15px; }
        .building-edit a.delete_building {background-color: #F28401; padding: 10px 15px; }
        .building-edit a.delete {background-color: #F28401; padding: 10px 15px; }
        .unit-edit a.delete_building {background-color: #202020; padding: 20px 15px; }
        .unit-edit a.delete {background-color: #202020; padding: 20px 15px; }
        a.view_detail { float: right; padding: 12px 11px; margin-top: 20px; background-color: #F28401; color: #fff; text-decoration: none;}
        .unit-icon {text-align: center; }
        .unit-icon span {color: black; font-size: 40px; margin-top: 50%; margin-left: 25%; }
        .unit-discription {padding: 10px 0; }
        .unit-info-main {padding: 10px 0; }
        .unit-info.status_indraft {color: red; }
        .unit-info.status_onrent {color: green;  }

        @media only screen and (max-width: 767px) {
          .unit-icon span {color: black; font-size: 90px; margin-top: 15px; margin-left: 0; }
          .unit-info-main,.unit-discription {padding: 15px; }
          .unit-edit {width: 100%; float: left; text-align: left; margin-top: 17px; margin-left: 15px; }
          a.view_detail {float: right; padding: 12px 11px; margin-top: 0; background-color: #F28401; color: #fff; text-decoration: none; margin-right: 19px; }
        }
        @if (!Auth::guest())
            @if(Auth::user()->user_role != 2 && Auth::user()->user_role != 3)
                a.view_detail {margin-top: 19px !important;
            @endif 
        @endif
}
    </style>
@endsection