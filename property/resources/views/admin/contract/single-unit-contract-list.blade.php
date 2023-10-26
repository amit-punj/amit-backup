@extends('adminlayouts.app')
@section('content')
<main class="app-content">
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
                            @include('admin.topnevigation')
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="dropdown active">
                                <a class="dropdown-toggle" data-toggle="dropdown" style="background-color:#f28302;" href="#" aria-expanded="false">Filter Contracts<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="active"><a href="#current" role="tab" data-toggle="tab" aria-expanded="false">Current</a></li>
                                    <li class=""><a href="#archive" role="tab" data-toggle="tab" aria-expanded="true">Archive</a></li>
                                </ul>
                            </li>                            
                        </ul>
                        <div class="tab-content">
                            <div id="current" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Current_Active_Contract">Current Active Contract</div>
                                        <div class="unit-body">
                                            <div class="unit-delete"><a href="{{ url('/delete-contract/2') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></div>
                                            <div class="unit"><span>Status : </span> Actice </div>
                                            <div class="unit"><span>Unit Name : </span> Second flore </div>
                                            <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                            <div class="unit"><span>Contract Type : </span> Commercial </div>
                                            <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                            <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="Current_Active_Contract">Reminders</div>
                                        <div class="unit-body">
                                            <div class="contract-alert"><span>Next Electric Bill  Date : </span>25-02-2019</div>
                                            <div class="contract-alert"><span>Next Water Bill  Date : </span>25-02-2019</div>
                                            <div class="contract-alert"><span>Next Payment  Date : </span>25-02-2019</div>
                                        </div> 
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Documents</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                        </div>
                                    </div>
                                </div> 
                                @include('dashboard.contract-documents')
                            </div>
                            <div id="archive" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="Current_Active_Contract">Old Contract List</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="unit-body">
                                            <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                            <div class="unit"><span>Status : </span> Cancel </div>
                                            <div class="unit"><span>Unit Name : </span> Second flore </div>
                                            <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                            <div class="unit"><span>Contract Type : </span> Commercial </div>
                                            <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                            <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="unit-body">
                                            <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                            <div class="unit"><span>Status : </span> Cancel </div>
                                            <div class="unit"><span>Unit Name : </span> Second flore </div>
                                            <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                            <div class="unit"><span>Contract Type : </span> Commercial </div>
                                            <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                            <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                        </div>
                                    </div>  
                                    <div class="col-sm-4">
                                        <div class="unit-body">
                                            <div class="unit-delete"><a href="{{ url('/contract-details/2') }}"><span class="glyphicon glyphicon-eye-open" title="View"></span></a></div>
                                            <div class="unit"><span>Status : </span> Cancel </div>
                                            <div class="unit"><span>Unit Name : </span> Second flore </div>
                                            <div class="unit"><span>Contract With(Tenent) : </span> Anil Ambani </div>
                                            <div class="unit"><span>Contract Type : </span> Commercial </div>
                                            <div class="unit"><span>Starting Date : </span>  2019-07-13</div>
                                            <div class="unit"><span>End Date : </span>  2020-07-13</div>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                                                
            </div>
        </div>
    </div> 
 </main>   
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span { font-weight: bold;  }
        .unit {padding: 5px 0; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right; }
        .Current_Active_Contract {font-size: 24px; text-align: center; }
        .documemt_action {text-align: right; }
        .documemt_action a {color: #000000bd; padding: 0 5px; }
        .contract-alert {background-color: bisque; padding: 9px; margin: 8px; border-radius: 5px; }
        .contract-alert-title {font-size: 24px; }
        

    </style>
@endsection