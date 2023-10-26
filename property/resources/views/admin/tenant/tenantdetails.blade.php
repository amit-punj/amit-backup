@extends('adminlayouts.app')
@section('content')
<main class="app-content">
      <div class="app-title">
          <h1><i class="fa fa-th-list"></i>  Detail </h1>
        </div>
<?php 
$role = Auth::user()->user_role;
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
                        @if($userDetail->tenant_type == 'company')
                            <div class="Building-title">Company Details</div>
                        @else
                            <div class="Building-title">Details</div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <a class="btn btn-success" href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-6">
                            @if($userDetail->tenant_type == 'company')
                                <div class="unit capitalize"><span>Legal Name : </span> {{ $userDetail->company_name }} </div>
                                <div class="unit"><span>Phone No. : </span> {{ $userDetail->company_phone_no }} </div>
                                <div class="unit"><span>Company Email. : </span> {{ $userDetail->company_email }} </div>
                                <h4>Name and details of representative</h4>
                            @endif
                            <div class="unit capitalize"><span>Name : </span> {{ $userDetail->name." ".$userDetail->last_name }}</div>
                            <div class="unit"><span>Email : </span> {{ $userDetail->email }}</div>
                            @if($userDetail->phone_no != null)
                                <div class="unit"><span>Phone No. : </span> {{ $userDetail->phone_no }}  </div>
                            @endif
                            @if($userDetail->tenant_address != null)
                                <div class="unit"><span>Address : </span> {{ $userDetail->tenant_address }} </div>
                            @endif
                            @if($userDetail->gender != null)
                                <div class="unit capitalize"><span>Gender : </span> {{ $userDetail->gender }} </div>
                            @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="tenant_image">
                            @if($userDetail->image != null)
                            <img src="{{ url('images/users/'.$userDetail->image) }}">
                            @else
                            <img src="{{ url('images/users/user-image.png') }}">
                            @endif
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                         @if($userDetail->tenant_type == 'company')
                             <div class="Building-Units">Company Documents</div>
                        @else
                            <div class="Building-Units">Documents</div>
                        @endif
                    </div>
                </div> 
                <div class="row">
                    @if($userDetail->tenant_photo)
                    <div class="col-sm-4">
                        <div class="unit-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>User Photo</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="documemt_action">
                                        @if($role == 0 || $role == 1)
                                        <a class="delete" href="{{ url('delete-tenant-document/'.$userDetail->id.'/tenant_photo') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                        @endif
                                        <a href="{{ url('images/users/'.$userDetail->tenant_photo) }}" download><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($userDetail->tenant_photo_id_proof)
                    <div class="col-sm-4">
                        <div class="unit-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>User Photo ID Proof</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="documemt_action">
                                        @if($role == 2 || $role == 1)
                                        <a class="delete" href="{{ url('delete-tenant-document/'.$userDetail->id.'/tenant_photo_id_proof') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                        @endif
                                        <a href="{{ url('images/users/'.$userDetail->tenant_photo_id_proof) }}" download><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($userDetail->tenant_photo_esignature)
                    <div class="col-sm-4">
                        <div class="unit-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>User Esignaturef</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="documemt_action">
                                        @if($role == 2 || $role == 1)
                                        <a class="delete" href="{{ url('delete-tenant-document/'.$userDetail->id.'/tenant_photo_esignature') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
                                        @endif
                                        <a href="{{ url('images/users/'.$userDetail->tenant_photo_esignature) }}" download><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(($userDetail->tenant_photo == null) && ($userDetail->tenant_photo_id_proof == null) && ($userDetail->tenant_photo_esignature == null))
                        <div class="not_found">Not Found Any Document</div>
                    @endif
                </div>                 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.delete').click(function(e){
                e.preventDefault();
               var href      = jQuery(this).attr('href');
               var result = confirm("Want to Delete Document?");
               if (result) {
                   window.location = href;
               }
            });
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
        .unit.capitalize {text-transform: capitalize; }
        .not_found {padding: 20px; }
    </style>
@endsection