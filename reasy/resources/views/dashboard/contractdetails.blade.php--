@section('title','Contract Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Contract Details'])
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
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th class="unit"><span>Unit Name :</span></th>
                                <th><a href="#">Test Unit</a></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="unit" ><span>Status : </span></td>
                                    <td>Cancled</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Contract With(Tenent) : </span></td>
                                    <td><a href="{{ url('tenant-details/1') }}">Anil Ambani</a></td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Owner Name : </span></td>
                                    <td><a href="{{ url('tenant-details/1') }}">Amit</a></td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Legal Advisor : </span></td>
                                    <td><a href="{{ url('tenant-details/1') }}">Reasy</a></td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Contract Type : </span></td>
                                    <td>Commercial</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Payment Status : </span></td>
                                    <td>Pending</td>
                                </tr> 
                                <tr>
                                    <td class="unit" ><span>Unit Rent : </span></td>
                                    <td>$ 400</td>
                                </tr> 
                                <tr>
                                    <td class="unit" ><span>Extra Charges : </span></td>
                                    <td>$ 160 </td>
                                </tr> 
                                <tr>
                                    <td class="unit" ><span>Balance in Contract : </span></td>
                                    <td>$ 200</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Bank Account : </span></td>
                                    <td>HDFC, Sector 5, Panchkula, Haryana 134109</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Key Dates : </span></td>
                                    <td>2019-07-13 to 2019-07-13</td>
                                </tr>
                                <tr>
                                    <td class="unit" ><span>Next Payment : </span></td>
                                    <td>2019-07-13</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        @include('dashboard.legal-action-popup')
                    </div>
                </div>  
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="Building-Units">Management</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" style="margin-left: -6px;" role="tablist">
                            <li class="dropdown active">
                                <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">Management <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="active"><a data-toggle="tab" href="#communication">Communication</a></li>
                                    <li><a data-toggle="tab" href="#transaction">Payments</a></li>
                                    <li><a data-toggle="tab" href="#document">Documents</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" aria-expanded="false">Refunds <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a data-toggle="tab" href="#clearDues">Dues</a></li>
                                    <li><a data-toggle="tab" href="#refundStatus">Refund Status</a></li>
                                </ul>
                            </li>
                            <li><a data-toggle="tab" href="#tickets">Tickets</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="communication" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Communication</div>
                                    </div>
                                </div> 
                                <div class="row" style="margin-left: 0px;">
                                    <div class="col-md-3">
                                        @include('dashboard.sidebar')
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
                            <div id="transaction" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Payments</div>
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
                            <div id="document" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Documents</div>
                                    </div>
                                    @if(Auth::user()->user_role != 1)
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Doc <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div> 
                                @include('dashboard.contract-documents')
                            </div>
                            <div id="clearDues" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Dues</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table table-hover table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="unit"><span>Water Bill :</span></td>
                                                <td>$ 20</td>
                                            </tr>
                                            <tr>
                                                <td class="unit" ><span>Electricity Bill : </span></td>
                                                <td>$ 100</td>
                                            </tr>
                                            <tr>
                                                <td class="unit" ><span>Internet Bill : </span></td>
                                                <td>$ 5</td>
                                            </tr>
                                            <tr>
                                                <td class="unit" ><span>Miscellaneous : </span></td>
                                                <td>$ 50</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                                 
                            </div>
                            <div id="refundStatus" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="Building-Units">Refund Status</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div  class="user-info-table">
                                            <table  class="table table-hover table-striped table-bordered" id="list_of_transacions">
                                                <thead>
                                                    <tr>
                                                        <td >Payment Mode</td>
                                                        <td >Payment Ampount</td>
                                                        <td >Status</td>
                                                        <td >Action</td>
                                                    </tr> 
                                                </thead>   
                                                <tbody >         
                                                    <tr>
                                                        <td >Paypal</td>
                                                        <td >$ 50</td>
                                                        <td >Pending</td>
                                                        <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                                    </tr> 
                                                    <tr>
                                                        <td >Bank Transfer</td>
                                                        <td >$ 700</td>
                                                        <td >Done</td>
                                                        <td ><a href="#"><span title="Delete" class="glyphicon glyphicon-eye-open"></span></a></td>
                                                    </tr> 
                                                    <tr>
                                                        <td >Paypal</td>
                                                        <td >$ 100</td>
                                                        <td >Pending</td>
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
                                    <div class="col-sm-6">
                                        <div class="Building-Units">List of Tickets</div>
                                    </div>
                                    @if(Auth::user()->user_role == 1)
                                    <div class="col-sm-6">
                                        <div class="add-unit-main">
                                            <button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#TicketModal">Raise Ticket <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div> 
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
        </div>
    </div> 
    <div class="modal fade" id="TicketModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" id="raise_ticket">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Raise Ticket</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="t_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="t_title" id="t_title" class="form-control @error('t_title') is-invalid @enderror">
                                @error('t_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('t_description') is-invalid @enderror" cols="50" rows="5" name="t_description" id="t_description"></textarea>
                                @error('t_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="b_address" class="col-md-4 col-form-label text-md-right">{{ __('Related Department') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('t_department') is-invalid @enderror" name="t_department" id="t_department">
                                    <option value="">Select Department</option>
                                    <option value="pm">Property Manager</option>
                                    <option value="gq">General Question</option>
                                    <option value="electricity">Electricity</option>
                                    <option value="heating">Heating</option>
                                    <option value="internet">Internet</option>
                                    <option value="keys">Keys</option>
                                    <option value="plumbing">Plumbing</option>
                                    <option value="insurance">Insurance</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('t_department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" id="b_create" class="btn btn-success">Raise</button>
                    </div>
                </form>
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
        var date = new Date();
        $('.form_datetime').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            startDate: date
        });
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
        jQuery('#raise_ticket').validate({
            errorClass:"red",
            validClass:"green",
            rules:{                  
                t_title:{
                    required:true,
                },
                t_description:{
                    required:true,
                },
                t_department:{
                    required:true,
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
        ul.nav.nav-tabs {padding: 30px 0 0; }
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
    </style>
<style>
    .chat-container {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .chat-container::after {
      content: "";
      clear: both;
      display: table;
    }

    .chat-container img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .chat-container img.right {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }
</style>
@endsection