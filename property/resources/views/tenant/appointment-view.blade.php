@section('title','Appointment Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Appointment Details'])
<?php
$role = Auth::user()->user_role; 
// $contractPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'contract_permission');
// $transactioPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'transactio_permission');
// $documentsPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'documents_permission');
// $ticketsPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'tickets_permission');
?>
    <div class="container bootom-space">
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
                    <div class="col-sm-6">
                        <h3>Appointment Details:</h3>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="unit" ><span>Appointment Title : </span></th>
                                <th>{{ucfirst($appointment->title) }}</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Desscription : </span></td>
                                    <td>{{$appointment->description }}</td>
                                </tr>
                                 <tr>
                                    <td class="unit" ><span>Appointment With : </span></td>
                                    <td>
                                        @if(Auth::user()->id == $appointment->created_by)
                                            {{$appointment->assigned->name}}
                                            @php $get = 'assigned' @endphp
                                        @else
                                            {{$appointment->create->name}}
                                            @php $get = 'create' @endphp
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Appointment Type : </span></td>
                                    <td>{{ucfirst($appointment->appointment_type)}}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Appointment Time : </span></td>
                                    <td>{!! \Helper::DateTime($appointment->time); !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <h3>
                            @if(Auth::user()->id == $appointment->created_by)
                                @if($appointment->appointment_type == 'Visit')
                                    Visitor Details
                                @else
                                    Place Description Details
                                @endif
                            @else
                                Tenant Details
                            @endif 
                        </h3>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="unit"><span>Name :</span></th>
                                <th>{{$appointment->$get->name}}</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Email : </span></td>
                                    <td>{{ $appointment->$get->email }}</a></td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Phone No : </span></td>
                                    <td>{{ $appointment->$get->phone_no }}</td>
                                </tr>
                                <!-- <tr>
                                    <td class="unit" ><span>Address : </span></td>
                                    <td>{{ $appointment->$get->tenant_address }}</td>
                                </tr> -->
                                <tr>
                                    <td class="unit" ><span>Photo : </span></td>
                                    <td><img src="{{ url('images/users/'.$appointment->$get->image) }}" width="80" height="60"> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-sm-6">
                        <h3>Unit Details:</h3>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="unit"><span>Unit Name :</span></th>
                                <th><a href="{{ url('propertydetails/'.$appointment->unit->id) }}">{{ $appointment->unit->unit_name }}</a></th>
                            </thead>
                            <tbody>
                                @if(!empty($appointment->unit->building_id))
                                <tr>
                                    <td class="unit" ><span>Building Name : </span></td>
                                    <td>{{ (isset($appointment->unit->building->unit_name)) ? $appointment->unit->building->unit_name : "No Building" }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="unit" ><span>Unit Address : </span></td>
                                    <td>{{ $appointment->unit->address }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Unit Type : </span></td>
                                    <td>{{ucfirst($appointment->unit->u_type)." (".ucfirst($appointment->unit->unit_category).")" }}</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Unit Size({{$appointment->unit->area_in}}) : </span></td>
                                    <td>{{ $appointment->unit->area }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div> 

<style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span {font-size: 15px; font-weight: bold; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .add-unit-main {text-align: right; margin-top: 20px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: right; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
        .tab-pane {padding: 15px 0; }
        /*ul.nav.nav-tabs {padding: 30px 0 0; }*/
        ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
        ul.nav.nav-tabs li {padding: 0 5px; }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
        ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
        ul.nav.nav-tabs .dropdown-menu> li a {font-size: 15px; background-color: #fff; color: inherit; }
        ul.nav.nav-tabs .dropdown-menu>.active> a {
            color: #fff !important;
            text-decoration: none;
            background-color: #337ab7 !important;
            outline: 0;
        }
        .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
            color: #262626 !important;
            text-decoration: none;
            background-color: #f5f5f5 !important;
        }
        dropdown active a.dropdown-toggle { background-color: #f28302;}
        .float-right { float: right; }
        .open>.ml-75 {margin-left: -75%;}
        .widget-small {display: -webkit-box; display: -ms-flexbox; display: flex; border-radius: 4px; margin-bottom: 30px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); }
        .widget-small .icon {display: -webkit-box; display: -ms-flexbox; display: flex; min-width: 50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; padding: 20px; background-color: rgba(0, 0, 0, 0.2); border-radius: 4px 0 0 4px; font-size: 2.5rem; }
        .widget-small.danger {background-color: #dc3545; }
        .widget-small.danger.coloured-icon {background-color: #fff; box-shadow: 2px 2px 4px #756767; color: #2a2a2a; }
        .widget-small.danger.coloured-icon .icon { background-color: #dc3545;color: #fff;}

      .icon.fa.fa-chack.fa-3x.success {background-color: #5cb85c;color: #fff;}
      .icon.fa.fa-exclamation-triangle.fa-3x.danger {background-color: #dc3545;color: #fff;}
        i.icon.fa.fa-check.success.fa-3x {background-color: #5cb85c;color: #fff;  }

      .widget-small .info h4 {text-transform: uppercase; margin: 0; margin-bottom: 5px; font-weight: 400; font-size: 1.1rem; }
      .widget-small .info p {margin: 0; font-size: 16px; }
      .widget-small .info {    padding: 7px 10px; }
    </style>
<style type="text/css">
    .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
    .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
    .unit_number {font-size: 18px; }
    .unit-body span { font-weight: bold;  }
    .unit {padding: 5px 0; }
    .top-nevigation {padding-bottom: 25px; }
    ul.nav.nav-tabs {border: 0; }
    .top-nevigation li {border: 0 !important; padding: 0 6px; }
    .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    .add-unit-main {text-align: right; } 
    .unit-delete span {color: #000000bd; position: relative; float: right; }
    .gender_class input {width: 8%; display: inline-block; height: 17px; border: 0; box-shadow: none; margin: 0 10px; }
    .tenent-title {font-size: 24px; }
    ul.nav.nav-pills.nav-justified li {background-color: bisque; }
    ul.nav.nav-pills.nav-justified a {color: black; }
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {background-color: #f28401;     color: #fff !important;}
    ul.nav.nav-pills.nav-justified {margin-top: 20px; }
    #create_company_form{display: none;}
    .add-unit-main, .tenent-title {padding: 15px 0; }
    .checked { color: orange; }
    .not_found {padding: 20px 0; }
</style>
@endsection