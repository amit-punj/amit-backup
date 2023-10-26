@section('title','Managment')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Managment'])
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
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#financials">Financials</a></li>
                    <li><a data-toggle="tab" href="#documents">Documents</a></li>
                    <li><a data-toggle="tab" href="#communications">Communications</a></li>
                </ul>
                <div class="row">
                    <div class="tab-content">
                        <div id="financials" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="Building-Units">List of Transactions</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div  class="user-info-table">
                                        <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                            <thead>
                                                <tr>
                                                    <td >S.No</td>
                                                    <td >Date</td>
                                                    <td >Related to</td>
                                                    <td >Description</td>
                                                    <td >Amount</td>
                                                    <td >Manually/Automatically</td>
                                                    <td >Action</td>
                                                </tr> 
                                            </thead>   
                                            <tbody >         
                                                <tr>
                                                    <td >1</td>
                                                    <td > 07 September, 2020 - 10:35 am</td>
                                                    <td >Rent</td>
                                                    <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                    <td >$1200</td>
                                                    <td >Manually</td>
                                                    <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td>
                                                </tr>  
                                                <tr>
                                                    <td >2</td>
                                                    <td > 07 September, 2019 - 10:35 am</td>
                                                    <td >Rent</td>
                                                    <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                    <td >$1200</td>
                                                    <td >Manually</td>
                                                    <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td>
                                                </tr>  
                                                <tr>
                                                    <td >3</td>
                                                    <td > 07 September, 2019 - 10:35 am</td>
                                                    <td >Rent</td>
                                                    <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                    <td >$1200</td>
                                                    <td >Manually</td>
                                                    <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td>
                                                </tr>  
                                                <tr>
                                                    <td >4</td>
                                                    <td > 07 September, 2019 - 10:35 am</td>
                                                    <td >Rent</td>
                                                    <td >Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                    <td >$12000</td>
                                                    <td >Manually</td>
                                                    <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></td>
                                                </tr>                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div id="documents" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="Building-Units">List of Documents</div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span>File_name.csv</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="documemt_action">
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                    <a href="#"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span>File_name.csv</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="documemt_action">
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                    <a href="#"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span>File_name.csv</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="documemt_action">
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                    <a href="#"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="unit-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span>File_name.csv</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="documemt_action">
                                                    <a href="#"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                                    <a href="#"><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div id="communications" class="tab-pane fade">
                            <div class="row" style="margin-left: 0px;">
                                <div class="col-md-3">
                                    <div class="dashboard-sidebar">
                                        <ul>
                                            <li><a href="#">Property Description Experts</a></li>
                                            <li><a href="#">Legal Advisor</a></li>
                                            <li><a href="#">Visit Organizer</a></li>
                                            <li><a href="#">Property Manager</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="chat-container">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" style="width:100%;">
                                      <p>Hello. How are you today?</p>
                                      <span class="time-right">11:00</span>
                                    </div>
                                    <div class="chat-container darker">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" class="right" style="width:100%;">
                                      <p>Hey! I'm fine. Thanks for asking!</p>
                                      <span class="time-left">11:01</span>
                                    </div>
                                    <div class="chat-container">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" style="width:100%;">
                                      <p>Sweet! So, what do you wanna do today?</p>
                                      <span class="time-right">11:02</span>
                                    </div>
                                    <div class="chat-container darker">
                                      <img src="/property/public/images/users/bandmember.jpg" alt="Avatar" class="right" style="width:100%;">
                                      <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                                      <span class="time-left">11:05</span>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>                                    
            </div>
        </div>
    </div> 
    <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{-- url('/update-unit') --}}" id="create_unit_form">
                    @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Create Unit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Unit Name') }}</label>
                        <div class="col-md-6">
                            <input id="update_unit_name" type="text" class="form-control" name="unit_name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rent" class="col-md-4 col-form-label text-md-right">{{ __('Rent') }}</label>
                        <div class="col-md-6">
                            <input id="update_rent" type="text" class="form-control" name="rent" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-4 col-form-label text-md-right">{{ __('Deposit') }}</label>
                        <div class="col-md-6">
                            <input id="update_deposit" type="text" class="form-control" name="deposit" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deposit" class="col-md-12 col-form-label text-md-right">{{ __('Amenities/Facilities available') }}</label>
                        
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Create Unit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
            jQuery('#create_unit_form').validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    unit_name:{
                        required:true,
                    },
                    rent:{
                        required:true,
                        number:true
                    },
                    deposit:{
                        required:true,
                        number:true
                    },
                }      
            });
        </script>
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
        .add-unit-main {text-align: right; margin-top: 0px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: center; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
        a span {color: black; }
        .tab-pane {padding: 15px 0; }
        ul.nav.nav-tabs {padding: 30px 0 0; }
        ul.nav.nav-tabs li a {font-size: 15px; background-color: #fae4c4; color: inherit; }
        ul.nav.nav-tabs li {padding: 0 5px; }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {color: white; cursor: default; background-color: #f28401; }
        ul.nav.nav-tabs li.active a {background-color: #f28401; color: white; }
        div#list_of_transacions_length ,div#list_of_transacions_info {width: 50%; float: left; }
        div#list_of_transacions_filter , div#list_of_transacions_paginate{float: right; width: 50%; text-align: right; }
        a#list_of_transacions_previous {padding: 8px; border: 1px solid #ddd; color: black; border-radius: 5px 0 0 5px; }
        a#list_of_transacions_next {padding: 8px; border: 1px solid #ddd; color: black; border-radius: 0 5px 5px 0; }
        a.paginate_button {padding: 8px; border: 1px solid #ddd; color: black; border-top: 1px solid #ddd; border-right: 0; border-left: 0; }
        thead > tr > td {cursor: pointer; }
        .chat-container {border: 2px solid #dedede; background-color: #f1f1f1; border-radius: 5px; padding: 10px; margin: 10px 0; }
        .darker {border-color: #ccc; background-color: #ddd; }
        .chat-container::after {content: ""; clear: both; display: table; }
        .chat-container img {float: left; max-width: 60px; width: 100%; margin-right: 20px; border-radius: 50%; }
        .chat-container img.right {float: right; margin-left: 20px; margin-right:0; }
        .time-right {float: right; color: #aaa; }
        .time-left {float: left; color: #999; }
        .dashboard-sidebar li:hover {color: #1a1a1a; border: 0; }
    </style>
    <!-- <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script> -->
    <script type="text/javascript" src="{{url('js/main.js')}}"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>;
    <script type="text/javascript" src="{{url('js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
      $('#list_of_transacions').DataTable();
    </script>
@endsection