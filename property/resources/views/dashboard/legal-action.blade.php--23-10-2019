@section('title','Legal Actions')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Legal Actions'])
<div class="container">
    <div class="row">
        <div class="col-sm-12 top-nevigation" >
            <div class="col-sm-6">
                <!-- <ul class="nav nav-tabs" style="margin-left: -6px; margin-bottom: 25px;">
                    <li class="active"><a data-toggle="tab" href="#termination">Termination</a></li>
                    <li><a data-toggle="tab" href="#refunds">Refunds</a></li>
                    <li><a data-toggle="tab" href="#tickets">Tickets</a></li>
                </ul> -->
            </div>
            <div class="col-sm-6" style="margin-bottom: 25px;">
                @if(Auth::user()->user_role != 5)
                    @include('dashboard.legal-action-popup')
                @endif
            </div>
            <div class="tab-content">
                <div id="termination" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-sm-12">
                            <div  class="user-info-table">
                                <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                    <thead>
                                        <tr>
                                            <td >Unit Name</td>
                                            <td >Tenent Name</td>
                                            <td >Legal Advisor </td>
                                            <!-- <td >Contract</td> -->
                                            <td >Due Amount </td>
                                            <td >Comment </td>
                                            <td >Action</td>
                                        </tr> 
                                    </thead>   
                                    <tbody >         
                                        <tr>
                                            <td><a target="_blank" href="{{ url('propertydetails/23') }}">po1...</a></td>
                                            <td ><a target="_blank" href="{{ url('tenant-details/1') }}">John</a></td>
                                            <td >Legal</td>
                                            <!-- <td ><a target="_blank" href="{{url('contract-details/2')}}">Residential</a> </td> -->
                                            <td >$ 300</td>
                                            <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                                            <td >
                                                <a href="#"><span title="View" class="glyphicon glyphicon-eye-open"></span></a>
                                                <a data-toggle="modal" data-target="#extend"><span title="Legal Action" class="glyphicon glyphicon-edit"></span></a>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td><a target="_blank" href="{{ url('propertydetails/23') }}">po1...</a></td>
                                            <td ><a target="_blank" href="{{ url('tenant-details/1') }}">John</a></td>
                                            <td >Legal</td>
                                            <!-- <td ><a target="_blank" href="{{url('contract-details/2')}}">Residential</a> </td> -->
                                            <td >$ 300</td>
                                            <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                                            <td ><a href="#"><span title="View" class="glyphicon glyphicon-eye-open"></span></a>
                                            <a data-toggle="modal" data-target="#extend"><span title="Legal Action" class="glyphicon glyphicon-edit"></span></a></td>
                                        </tr> 
                                        <tr>
                                            <td><a target="_blank" href="{{ url('propertydetails/23') }}">po1...</a></td>
                                            <td ><a target="_blank" href="{{ url('tenant-details/1') }}">John</a></td>
                                            <td >Legal</td>
                                            <!-- <td ><a target="_blank" href="{{url('contract-details/2')}}">Residential</a> </td> -->
                                            <td >$ 300</td>
                                            <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                                            <td ><a href="#"><span title="View" class="glyphicon glyphicon-eye-open"></span></a>
                                            <a data-toggle="modal" data-target="#extend"><span title="Legal Action" class="glyphicon glyphicon-edit"></span></a></td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="refunds" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-12">
                            <div  class="user-info-table">
                                <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                    <thead>
                                        <tr>
                                            <td >Tenent Name</td>
                                            <td >Contract</td>
                                            <td >Refund Date</td>
                                            <td >Related to</td>
                                            <td >Amount</td>
                                            <td >Action</td>
                                        </tr> 
                                    </thead>   
                                    <tbody >         
                                        <tr>
                                            <td >Bright</td>
                                            <td ><a href="{{url('contract-details/2')}}">Residential</a> </td>
                                            <td > 07 September, 2020 - 10:35 am</td>
                                            <td >Rent</td>
                                            <td >$1200</td>
                                            <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr>  
                                        <tr>
                                            <td >Bright</td>
                                            <td ><a href="{{url('contract-details/2')}}">Residential</a> </td>
                                            <td > 07 September, 2020 - 10:35 am</td>
                                            <td >Rent</td>
                                            <td >$1200</td>
                                            <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr>  
                                        <tr>
                                            <td >Bright</td>
                                            <td ><a href="{{url('contract-details/2')}}">Residential</a> </td>
                                            <td > 07 September, 2020 - 10:35 am</td>
                                            <td >Rent</td>
                                            <td >$1200</td>
                                            <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr>  
                                        <tr>
                                            <td >Bright</td>
                                            <td ><a href="{{url('contract-details/2')}}">Residential</a> </td>
                                            <td > 07 September, 2020 - 10:35 am</td>
                                            <td >Rent</td>
                                            <td >$1200</td>
                                            <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr>                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tickets" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-12">
                            <div  class="user-info-table">
                                <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                    <thead>
                                        <tr>
                                            <td >Title</td>
                                            <td >Description</td>
                                            <td >Department</td>
                                            <td >Status</td>
                                            <td >Action</td>
                                        </tr> 
                                    </thead>   
                                    <tbody >         
                                        <tr>
                                            <td >Title</td>
                                            <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                            <td >Plumbing</td>
                                            <td >Closed</td>
                                            <td ><a href="{{url('ticket-view')}}"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr> 
                                        <tr>
                                            <td >Title</td>
                                            <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                            <td >Electricity</td>
                                            <td >Pending</td>
                                            <td ><a href="{{url('ticket-view')}}"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr> 
                                        <tr>
                                            <td >Title</td>
                                            <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                            <td >Insurance</td>
                                            <td >Pending</td>
                                            <td ><a href="{{url('ticket-view')}}"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr> 
                                        <tr>
                                            <td >Title</td>
                                            <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                            <td >Electricity</td>
                                            <td >Closed</td>
                                            <td ><a href="{{url('ticket-view')}}"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<style type="text/css">
    .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
    .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
    .unit_number {font-size: 18px; }
    .unit-body span { font-weight: bold;  }
    .unit {padding: 5px 0; }
    .top-nevigation {padding-bottom: 25px; }
    ul.nav.nav-tabs {border: 0; }
    .top-nevigation li {border: 0 !important; padding: 0 6px; }
    /*.top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }*/
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    .add-unit-main {text-align: right; }
    .unit-delete span {color: #000000bd; position: relative; float: right; }
    .Current_Active_Contract {font-size: 24px; text-align: center; }
    .documemt_action {text-align: right; }
    .documemt_action a {color: #000000bd; padding: 0 5px; }
    .contract-alert {background-color: bisque; padding: 9px; margin: 8px; border-radius: 5px; }
    .contract-alert-title {font-size: 24px; }
    ul.nav.nav-tabs {padding: 30px 0 0; }
    ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
    ul.nav.nav-tabs li {padding: 0 5px; }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
    ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
    .fs-24{ font-size: 24px; }
    .float-right { float: right; }
    .open > .ml-75 {margin-left: -75%;}
    ul.nav.nav-tabs .dropdown-menu > li a {font-size: 15px;background-color: #fff;color: inherit;}
</style>
@endsection