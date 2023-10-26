@section('title','List of Tenants')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List of Tenants'])
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
                    <div class="col-sm-12">
                        <div class="top-nevigation">
                            @include('dashboard.topnevigation')
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tenent-title">List of Tenants</div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >Status</td>
                                        <td >First Name</td>
                                        <td >Last Name</td>
                                        <td >Phone No.</td>
                                        <td >Email</td>
                                        <td >Starting date</td>
                                        <td >End Date</td>
                                        <td >Rental Price</td>
                                        <td >Comments</td>
                                        <td >Action</td>
                                    </tr>              
                                    <tr>
                                        <td >Active</td>
                                        <td > First Name</td>
                                        <td > Last Name</td>
                                        <td >7707907474</td>
                                        <td >test@gmail.com</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >3000</td>
                                        <td >great</td>
                                        <td ><a href="{{url('tenant-details/1')}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr> 
                                    <tr>
                                        <td >Past</td>
                                        <td > First Name</td>
                                        <td > Last Name</td>
                                        <td >7707907474</td>
                                        <td >test@gmail.com</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >3000</td>
                                        <td >great</td>
                                        <td ><a href="{{url('tenant-details/1')}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr> 
                                    <tr>
                                        <td >Active</td>
                                        <td > First Name</td>
                                        <td > Last Name</td>
                                        <td >7707907474</td>
                                        <td >test@gmail.com</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >3000</td>
                                        <td >great</td>
                                      <td ><a href="{{url('tenant-details/1')}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr> 
                                    <tr>
                                        <td >Past</td>
                                        <td > First Name</td>
                                        <td > Last Name</td>
                                        <td >7707907474</td>
                                        <td >test@gmail.com</td>
                                        <td >30-12-2018</td>
                                        <td >30-12-2019</td>
                                        <td >3000</td>
                                        <td >great</td>
                                        <td ><a href="{{url('tenant-details/1')}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr>                         
                                </tbody>
                            </table>
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
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right; }
        
        .tenent-title {font-size: 24px; }
        </style>
@endsection