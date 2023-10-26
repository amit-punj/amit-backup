
@extends('layouts.app')
@section('content')
@include('layouts.banner')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('dashboard.sidebar')
            </div>
            <div class="col-md-9">
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
                    <div class="col-sm-12">
                        <div class="add-unit-main">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Invite Guarantor <span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="profile-page-title">List Of Invitation's</div>    -->                                              
                        <div  class="user-info-table">
                            @if (count($invitations) >= 1)
                                <table  class="table table-hover table-striped table-bordered">
                                    <tbody >
                                        <tr>
                                            <td >Name</td>
                                            <td >Email</td>
                                            <td >User Role</td>
                                            <td >Status</td>
                                        </tr>
                                            @foreach($invitations as $invitation)                     
                                                <tr>
                                                    <td >{{ $invitation->name }}</td>
                                                    <td >{{ $invitation->email }}</td>
                                                      @if ($invitation->user_role == 0)
                                                         <td>Admin</td>
                                                      @elseif($invitation->user_role == 1)
                                                          <td>Tenant</td>
                                                      @elseif($invitation->user_role == 2)
                                                          <td>Property Owner</td>
                                                      @elseif($invitation->user_role == 3)
                                                          <td>Property Manager</td>
                                                      @elseif($invitation->user_role == 4)
                                                          <td>Property Description Experts</td>
                                                      @elseif($invitation->user_role == 5)
                                                          <td >Legal Advisor</td>
                                                      @elseif($invitation->user_role == 6)
                                                          <td >Visit Organizer</td>
                                                      @else
                                                          <td>Not Define</td>
                                                      @endif
                                                    <td >Not Confirn</td>
                                                </tr>
                                            @endforeach                           
                                    </tbody>
                                </table>
                            @else
                                <div>Not found any invitation.</div>
                            @endif
                        </div>                  
                    </div>
                </div>                                               
            </div>
        </div>
    </div> 
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/send-invitation') }}" id="Guarantor_invitation">
                    @csrf
                     <input id="property_id" type="hidden" class="form-control" name="property_id" value="{{ $unit->id }}">
                     <input id="property_unit_id" type="hidden" class="form-control" name="property_unit_id" value="{{ $unit->id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Guarantor</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Guarantor Type') }}</label>
                        <div class="col-md-6">
                            <select id="type" type="text" class="form-control" name="user_role" value="">
                                <option value="3">Property Manager</option>
                                <option value="4">Property Description Experts</option>
                                <option value="5">Legal Advisor</option>
                                <option value="6">Visit Organizer</option>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label for="Name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="Name" type="text" class="form-control" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>
                        <div class="col-md-6">
                            <textarea id="Message" type="text" class="form-control" name="message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Send Invitation</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ url('/update-unit') }}">
                    @csrf
                     <input id="update_unit_id" type="hidden" class="form-control" name="unit_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Update Unit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="property_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Entity') }}</label>
                        <div class="col-md-6">
                            
                        </div>
                    </div>   
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
                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Create Unit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.updateUnitButton').click(function(){
            	var self = this;
            	$('#update_property_id option').each(function() {
				    if($(this).text() == $(self).attr('entityname')) {
				        $(this).prop("selected", true);
				    }
				});
            	$('#update_unit_id').val($(this).attr('unitid'));
            	$('#update_unit_name').val($(this).attr('unitname'));
            	$('#update_rent').val($(this).attr('unitrent'));
            	$('#update_deposit').val($(this).attr('unitdeposit'));
            });
        });            
    </script>
     <script type="text/javascript">
            jQuery('#Guarantor_invitation').validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    name:{
                        required:true,
                    },
                    email:{
                        required:true,
                        email:true
                    },
                    message:{
                        required:true
                    },
                }      
            });
        </script>
    <style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit-body span {font-size: 15px; font-weight: bold; color: #f28401; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 0 !important; padding: 0 6px; }
        .top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }
        .top-nevigation li.active a {background: #f28302; color: #fff; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .user-info-table {margin-top: 15px; }
        </style>
@endsection