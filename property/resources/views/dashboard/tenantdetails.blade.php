@section('title','Tenant Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Tenant Details'])
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
                        <div class="Building-title">Tenant Details</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <a class="btn btn-success" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-6">
                            <div class="unit"><span>Name : </span> Tenant Name</div>
                            <div class="unit"><span>Email : </span> test@gmail.com</div>
                            <div class="unit"><span>Phone No. : </span> 7707907474  </div>
                            <div class="unit"><span>Address : </span> MDC Sec 5, Panchkula, Haryana, India 136118 </div>
                            <div class="unit"><span>Starting Date : </span> 2019-07-13 </div>
                            <div class="unit"><span>End Date : </span> 2019-07-13 </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="tenant_image">
                            <img src="{{ url('images/users/user-image.png') }}">
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Building-Units">Tenant Documents</div>
                    </div>
                </div> 
                <div class="row">
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
               <!--  <div class="row">
                    <div class="col-sm-12">
                        <div class="Building-Units">Meter Readings</div>
                    </div>
                </div> -->
<!--                 <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >Date</td>
                                        <td >S.No</td>
                                        <td >Last Reading</td>
                                        <td >Per unit Price</td>
                                        <td >Total Amount</td>
                                        <td >Status</td>
                                    </tr>              
                                    <tr>
                                        <td >1</td>
                                        <td > 07 September, 2019 - 10:35 am</td>
                                        <td >5642</td>
                                        <td >8</td>
                                        <td >$1200</td>
                                        <td >Pending</td>
                                    </tr>  
                                    <tr>
                                        <td >2</td>
                                        <td > 03 September, 2019 - 10:35 am</td>
                                        <td >5642</td>
                                        <td >8</td>
                                        <td >$1200</td>
                                        <td >Pending</td>
                                    </tr> 
                                    <tr>
                                        <td >3</td>
                                        <td > 08 September, 2019 - 10:35 am</td>
                                        <td >5642</td>
                                        <td >8</td>
                                        <td >$1200</td>
                                        <td >Pending</td>
                                    </tr>                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  -->                                     
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
        .add-unit-main {text-align: right; margin-top: 20px;}
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .amenities-input{    width: 20px; display: inline-block; height: 20px; padding-top: 2px;}
        .container.bootom-space {margin-bottom: 50px; }
        .Building-title {font-size: 28px; }
        .Building-Units {font-size: 28px; margin-top: 20px;}
        .unit span {font-weight: bold; }
        .documemt_action {text-align: right; } 
        .documemt_action span {color: #000000bd; padding: 0 5px; }
        .tenant_image {text-align: center; }
        .tenant_image img {width: 150px; }
         </style>
@endsection