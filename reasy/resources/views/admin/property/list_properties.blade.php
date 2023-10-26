@extends('adminlayouts.app')
@section('content')

     <main class="app-content">
      <div class="app-title"><h3>Properties List</h3>
       </div>
          @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors->any())
                        {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
                @endif
       <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Buildings </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Unit Without Building</a>
                  </li>
                 
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active show" id="profile">
                      @if(count($propertiesWithBuilding) > 0)
                    @foreach ($propertiesWithBuilding as $property)
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="building-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="building-main">
                                        <div class="building-title">Building</div>
                                        <div class="building-edit">
                                          
                                                    <a class="delete_building btn btn-danger" href="{{ url('delete-property/'.$property['building_id']) }}">Delete</a>
                                                    <a class="edit btn btn-success" href="{{ url('building-details_admin/'.$property['building_id']) }}">View</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    @if(count($property['data']) > 0)
                                    @foreach ($property['data'] as $unit)
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="unit-icon">
                                                    <span class="glyphicon glyphicon-home"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="unit-info-main">
                                                    <div class="unit-info">
                                                        <span>Name : </span> {{ substr($unit->unit_name,0,10) }}... 
                                                    </div>
                                                    <div class="unit-info"><span>Rent : </span> {{ App\Helpers\Helper::CURRENCYSYMBAL.$unit->rent }} </div>
                                                    <div class="unit-info"><span>Status : </span> On Rent </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="unit-discription"><span>{{ substr($unit->description,0,50) }}...</div>
                                            </div>
                                            <div class="col-sm-3">
                                                 <div class="unit-edit">
                                                    
                                                            <a class="delete btn" href="{{ url('delete-unit/'.$unit->id) }}">Delete</a>
                                                            <a class="edit btn" href="{{ url('edit-unit-admin/'.$unit->id) }}">Edit</a>
                                                    
                                                    <a class="view_detail btn btn-success" href="{{ url('view_unit-admin/'.$unit->id) }}">View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="buzz">
                      
                       @if(count($propertiesWithoutBuilding) > 0)
                    @foreach ($propertiesWithoutBuilding as $property)
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="building-body">
                            <div class="row">
                                <div class="col-sm-12">
                                   <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="unit-icon"><span class="glyphicon glyphicon-home"></span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="unit-info-main">
                                                    <div class="unit-info">
                                                        <span>Name : </span> {{ substr($property->unit_name,0,10) }}... 
                                                    </div>
                                                    <div class="unit-info"><span>Rent : </span> ${{ $property->rent }} </div>
                                                    <div class="unit-info"><span>Status : </span> On Rent </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="unit-discription"><span>{{ substr($property->description,0,50) }}...</div>
                                            </div>
                                            <div class="col-sm-3">
                                                 <div class="unit-edit">
                                                   
                                                            <a class="delete btn" href="{{ url('delete-unit/'.$property->id) }}">delete</a>
                                                            <a class="edit btn" href="{{ url('edit-unit-admin/'.$property->id) }}">Edit</a>
                                                       
                                                    <a class="view_detail btn btn-success" href="{{ url('view_unit-admin/'.$property->id) }}">View Detail</a>
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
        });
    </script>
    <style type="text/css">
                a.view_detail.btn.btn-success {
                margin-bottom: 7%;
            }
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .building-body{border: 1px solid #349688; padding: 15px; margin: 15px 0;}
        .unit-body {border-bottom: 1px solid #349688;  margin: 15px 0; background-color: #F0F0F0; width: 100%;     float: left;}
        .unit_number {font-size: 18px; }
        /*.unit-body span {font-size: 15px; font-weight: bold; color: #f28401; }*/
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #349688; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .list-units-title {font-size: 28px; }
        .unit-home span {font-size: 40px; margin-top: 10px; }
        .unit-delete {position: absolute; top: 0; right: 10px; }
        .building-edit {width: 50%; float: left; text-align: right; margin-top: 15px;}
        .unit-edit {width: 100%; float: left; text-align: right; margin-top: 17px;}
        .building-edit span ,.unit-edit span{color: #fff; font-weight: bold; }
        .building-main {   border-bottom: 1px solid #349688;     padding-bottom: 15px; width: 100%; float: left; }
        .building-title {font-size: 33px; font-weight: normal; float: left; width: 50%; }
        /*.building-edit a.edit {background-color: #202020; padding: 10px 15px; }*/
      /*  .unit-edit a.edit {background-color: #202020; padding: 20px 15px; }*/
        /*.building-edit a.delete_building {background-color: #F28401; padding: 10px 15px; }
        .building-edit a.delete {background-color: #F28401; padding: 10px 15px; }*/
        .unit-edit a.delete_building {background-color: #202020; padding: 20px 15px; }
        /*.unit-edit a.delete {background-color: #202020; padding: 20px 15px; }*/
      /*  a.view_detail { float: right; padding: 12px 11px; margin-top: 20px; background-color: #F28401; color: #fff; text-decoration: none;}*/
        .unit-icon {text-align: center; }
        .unit-icon span {color: black; font-size: 40px; margin-top: 50%; margin-left: 25%; }
        .unit-discription {padding: 10px 0; }
        .unit-info-main {padding: 10px 0; }
        @media only screen and (max-width: 767px) {
          .unit-icon span {color: black; font-size: 90px; margin-top: 15px; margin-left: 0; }
          .unit-info-main,.unit-discription {padding: 15px; }
          .unit-edit {width: 100%; float: left; text-align: left; margin-top: 17px; margin-left: 15px; }
         /* a.view_detail {float: right; padding: 12px 11px; margin-top: 0; background-color: #F28401; color: #fff; */text-decoration: none; margin-right: 19px; }
        }
       
                a.view_detail {margin-top: 12px !important;
          
	 }
    </style>

@endsection