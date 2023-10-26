@section('title','List All Tenants')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'List All Tenants'])
<?php 
$role = Auth::user()->user_role; 
?>
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
                    <div class="col-sm-6">
                        <div class="tenent-title">List All Tenants</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            @if($role == 2)
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModel">Create Tenant <span class="glyphicon glyphicon-plus"></span></button>
                            @endif
                        </div>
                    </div>
                </div> 
                @if($bookings != null )
                <div class="row">
                    <div class="col-sm-12">
                        <div  class="user-info-table">
                            <table  class="table table-hover table-striped table-bordered">
                                <tbody >
                                    <tr>
                                        <td >Unit Name</td>
                                        <td >Name</td>
                                        <td >Phone No.</td>
                                        <td >Email</td>
                                        <td >Gendar</td>
                                        <td >Rating</td>
                                        <td >Action</td>
                                    </tr> 
                                    @foreach($bookings as $value)             
                                    <tr>
                                        <td ><a href="{{url('propertydetails/'.$value->unit_id)}}">{{$value->unit->unit_name}}</a></td>
                                        <td > {{ $value->user->name." ".$value->user->last_name }}</td>

                                        @if($value->user->phone_no != '')
                                        <td >{{ $value->user->phone_no }}</td>
                                        @else
                                        <td >--</td>
                                        @endif

                                        <td >{{ $value->user->email }}</td>

                                        @if($value->user->gender != '')
                                        <td >{{ $value->user->gender }}</td>
                                        @else
                                        <td >--</td>
                                        @endif

                                        <td >
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star "></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </td>
                                        <td ><a href="{{url('tenant-details/'.$value->user->id )}}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr>
                                    @endforeach         
                                </tbody>
                            </table>
                            {{ $bookings->links() }}
                        </div>
                    </div>
                </div>     
                @else
                    <div class="not_found">Not Found Any Tenant</div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h3 class="modal-title">Create Tenant</h3> -->
                    <ul class="nav nav-pills nav-justified">
                        <li id="create_tenant" class="active"><a href="#">Create Tenant</a></li>
                        <li id="create_company" class=""><a href="#">Create Company</a></li>
                    </ul>
                </div>
                <div class="modal-body">
                    <form method="post" action="" id="create_tenant_form">
                        @csrf
                        <input id="update_unit_id" type="hidden" class="form-control" name="unit_id" value="">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="">
                            </div>
                        </div>
                        <div class="form-group row gender_class">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                Male<input id="gender" type="radio" class="form-control" name="gender" value="male" checked>
                                Female<input id="gender1" type="radio" class="form-control" name="gender" value="female">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="" data="false">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="submit" id="create_tenant_button"class="btn btn-success">Create Tenant</button>
                            </div>
                        </div>
                    </form>


                    <form method="post" action="" id="create_company_form" style="display: none;">
                        @csrf
                        <input id="update_unit_id" type="hidden" class="form-control" name="unit_id" value="">
                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Legal Name') }}</label>
                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>
                            <div class="col-md-6">
                                <input id="company_phone_no" type="text" class="form-control" name="company_phone_no" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_email" class="col-md-4 col-form-label text-md-right">{{ __('Company Email') }}</label>
                            <div class="col-md-6">
                                <input id="company_email" type="text" class="form-control" name="company_email" value="" data="false">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_email" class="col-md-12 col-form-label text-md-right">{{ __('Name and details of representative') }}</label>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="">
                            </div>
                        </div>
                        <div class="form-group row gender_class">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                Male<input id="gender" type="radio" class="form-control" name="gender" value="male" checked>
                                Female<input id="gender1" type="radio" class="form-control" name="gender" value="female">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="c_email" type="text" class="form-control" name="email" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="submit" id="create_company_button" class="btn btn-success">Create Company</button>
                            </div>
                        </div>
                    </form>

                </div>          
            </div>
        </div>
    </div>
<script type="text/javascript">
     jQuery('#create_tenant_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            email:{
                required:true,
                email:true,
            },
            phone_number:{
                required:true,
                number:true,
            },
            address:{
                required:true,
            },
        }      
    });

    jQuery('#create_company_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{                  
            company_name:{
                required:true,
            },
            company_phone_no:{
                required:true,
                 number:true,
            },
            company_email:{
                required:true,
                email:true,
            },
            name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            email:{
                required:true,
                email:true,
            },
            phone_number:{
                required:true,
                number:true,
            },
            address:{
                required:true,
            },
        }      
    });
    jQuery('#email').blur(function(){
        jQuery('#email_error').remove();
        jQuery.ajax({
            url: "{{ url('/verify-user-email') }}",
            type: "POST",
            data: {'_token':'<?php echo csrf_token() ?>','email':$('#email').val()},
            success: function(data){
                if(data.status == 'true'){
                    jQuery('#email').after("<span id='email_error'>"+data.message+"</span>");
                    jQuery('#email').attr('data','false');
                } else {
                    jQuery('#email').attr('data','true');
                    jQuery('#create_tenant_button').attr("disabled", false);
                }
            }
        });
    });
    jQuery('#c_email').blur(function(){
        jQuery('#email_error_c').remove();
        jQuery.ajax({
            url: "{{ url('/verify-user-email') }}",
            type: "POST",
            data: {'_token':'<?php echo csrf_token() ?>','email':$('#c_email').val()},
            success: function(data){
                if(data.status == 'true'){
                    jQuery('#c_email').after("<span id='email_error_c'>"+data.message+"</span>");

                    jQuery('#c_email').attr('data','false');
                } else {
                    jQuery('#c_email').attr('data','true');
                    jQuery('#create_company_button').attr("disabled", false);
                }
            }
        });
    });
    jQuery('#create_tenant_form').submit(function(e){
        e.preventDefault();
        if(jQuery('#email').attr('data') == 'false'){
            return false;
        } else {
            jQuery('#create_tenant_button').attr("disabled", true);
            jQuery.ajax({
                url: "{{ url('/create-contract-user') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','data':jQuery( "#create_tenant_form" ).serialize()},
                success: function(data){
                    if(data.status == 'true'){
                        toastr.success("Tenant Create Successfully");
                        jQuery('#create_tenant_form input').val('');
                        jQuery('.close').trigger('click');
                    } else {
                        jQuery('#create_tenant_button').after("<span id='email_error'>Allready Exist!</span>");
                    }
                }
            });
        }
    });
    jQuery('#create_company_form').submit(function(e){
        e.preventDefault();
        if(jQuery('#c_email').attr('data') == 'false'){
            return false;
        } else {
            jQuery('#create_company_button').attr("disabled", true);
            jQuery.ajax({
                url: "{{ url('/create-contract-company') }}",
                type: "POST",
                data: {'_token':'<?php echo csrf_token() ?>','data':jQuery( "#create_company_form" ).serialize()},
                success: function(data){
                    if(data.status == 'true'){
                        toastr.success("Company Create Successfully");
                        jQuery('#create_company_form input').val('');
                        jQuery('.close').trigger('click');
                    } else {
                        jQuery('#create_company_button').after("<span id='email_error'>Allready Exist!</span>");
                    }
                }
            });
        }
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.nav.nav-pills.nav-justified li').click(function(){
            jQuery('#create_company_form').hide();
            jQuery('ul.nav.nav-pills.nav-justified li').removeClass('active');
            jQuery(this).addClass('active');
        });
        jQuery('#create_tenant').click(function(){ 
            jQuery('#create_tenant_form').show();
            jQuery('#create_company_form').hide();
        });
        jQuery('#create_company').click(function(){ 
             jQuery('#create_company_form').show();
            jQuery('#create_tenant_form').hide();
        });
    });
</script>
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