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
                    @if(count($propertiesWithoutBuilding) > 0)
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr class="text-center f17">
                                        <th >Unit name</th>
                                        <th >Unit description</th>
                                        <th >Rent</th>
                                        <th >Status</th>
                                        <th >Start date</th>
                                        <th >End date</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($propertiesWithoutBuilding as $key =>$property)    
                                    <tr>
                                        <td> <a href="{{url('propertydetails/'.$property->id)}}">{{ substr($property->unit_name,0,20) }}</a></td>
                                        <td>{{ substr($property->description,0,50) }}...</td>
                                        <td>{{ App\Helpers\Helper::CURRENCYSYMBAL}} {{ $property->rent }}</td>
                                        <td>
                                            @if($property->booking_status == 1)
                                                On Rent
                                            @else
                                                 Draft
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($property->current_contracts->start_date))
                                                {{$property->current_contracts->start_date}} 
                                            @else
                                                Not Active
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($property->current_contracts->end_date))
                                                {{$property->current_contracts->end_date}} 
                                            @else
                                                Not Active
                                            @endif
                                        </td>
                                        <td>
                                            <?php
                                                $unitPermission = App\Helpers\Helper::accessPermission(
                                                            $property->user_id, 
                                                            Auth::user()->user_role, 
                                                            'unit_permission');
                                            ?>
                                            @if (!Auth::guest())
                                                @if((Auth::user()->user_role == 5))
                                                    <a class="edit" href="{{ url('list-meters/'.$property->id) }}"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
                                                @endif
                                            @endif
                                            <a href="{{ url('propertydetails/'.$property->id) }}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a>
                                            @if(isset($property->current_contracts->end_date))
                                                <a class="btn btn-success" href="{{ url('contract-details/'.$property->current_contracts->id) }}">Contract View</a>
                                            @endif

                                        </td>
                                    </tr> 
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
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
               var result = confirm("Want to Delete Building?");
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
        .unit-info.status_onrent {color: green; }

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