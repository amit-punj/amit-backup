@section('title','Legal Action Detail')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Legal Action Detail'])
<?php 
$role = Auth::user()->user_role;
$legalPermission = App\Helpers\Helper::accessPermission($legalAction->po_id,Auth::user()->user_role,'legal_permission');
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
                        <div class="Building-title">Legal Action Detail</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="add-unit-main">
                            <a class="btn btn-success" href="{{ url()->previous() }}">Back</a>
                            @if( ($role == 5) && ($legalAction->status != 'complete') && ($legalPermission != 0))
                                <a class="btn btn-success" href="#" data-toggle="modal" data-target="#updateModel">
                                    Create Action Report
                                </a>
                            @endif
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                            <div class="unit capitalize"><span>Related To : </span> {{ $legalAction->related_to }}</div>
                            <div class="unit capitalize"><span>Unit : </span> 
                                <a href="{{ url('/propertydetails/'.$legalAction->unit_id) }}">
                                    {{ $legalAction->unit['unit_name'] }}
                                </a>
                            </div>
                            <div class="unit capitalize"><span>Property Owner : </span> 
                                <a href="{{ url('/tenant-details/'.$legalAction->po_id) }}">
                                    {{ $legalAction->propertyOwner['name']." ".$legalAction->propertyOwner['last_name'] }}
                                </a>
                            </div>
                            <div class="unit capitalize"><span>Tenant : </span> 
                                <a href="{{ url('/tenant-details/'.$legalAction->tenant_id) }}">
                                    {{ $legalAction->tenant['name']." ".$legalAction->tenant['last_name'] }}
                                </a>
                            </div>
                            <div class="unit capitalize"><span>Legal Advisor : </span> 
                                <a href="{{ url('/tenant-details/'.$legalAction->legal_advisor_id) }}">
                                    {{ $legalAction->legalAdvisor['name']." ".$legalAction->legalAdvisor['last_name'] }}
                                </a>
                            </div>
                            <div class="unit capitalize"><span>Contract : </span> 
                                <a href="{{ url('/contract-details/'.$legalAction->contract_id) }}">
                                    {{ $legalAction->contract['contract_type'] }}
                                </a>
                            </div>
                            <div class="unit capitalize"><span>Status : </span> {{ $legalAction->status }}</div>
                            @if($legalAction->due_amount != null)
                                <div class="unit"><span>Due Amount : </span> {{ $legalAction->due_amount }}  </div>
                            @endif
                            @if($legalAction->create_time != null)
                                <div class="unit"><span>Action Time : </span> {{ $legalAction->create_time }} </div>
                            @endif
                            @if($legalAction->comment != null)
                                <div class="unit capitalize"><span>Message : </span> {{ $legalAction->comment }} </div>
                            @endif
                    </div>
                </div>
                @if($legalAction->status == 'complete')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Building-Units">Legal Adviser Report</div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="unit capitalize"><span>Legal Adviser Message : </span> {{ $legalAction->action_comment }}</div>
                    </div>
                </div> 
                @endif 
                @if($legalAction->document != '')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="Building-Units document">Documents:</div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-4">
                        <div class="unit-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>{{ $legalAction->document }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="documemt_action">
                                       <!--  <a class="delete" href="{{ url('delete-tenant-document/'.$legalAction->id.'/tenant_photo') }}"><span class="glyphicon glyphicon-trash" title="Delete"></span></a> -->
                                        <a href="{{ url('legal_document/'.$legalAction->document) }}" download><span class="glyphicon glyphicon-download-alt" title="Download"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                @endif           
            </div>
        </div>
    </div>
    @if($role == 5)
    <div class="modal fade" id="updateModel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Create Action Report</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" action="{{ url('/submit-legal-action-report') }}" id="submit_report_form">
                        @csrf
                        <input type="hidden" name="legal_action_id" value="{{ $legalAction->id }}">
                        <div class="form-group row">
                            <label for="action_comment" class="col-md-4 col-form-label text-md-right">Message</label>
                            <div class="col-md-6">
                                <textarea name="action_comment" class="form-control green" aria-invalid="false"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="document" class="col-md-4 col-form-label text-md-right">Document</label>
                            <div class="col-md-6">
                                <input type="file" name="document" class="form-control green" aria-invalid="false" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="submit" id="create_tenant_button"class="btn btn-success">Submit Report</button>
                            </div>
                        </div>
                    </form>
                </div>   
            </div>          
        </div>
    </div>
    @endif
    <script type="text/javascript">
        jQuery('#submit_report_form').validate({
            errorClass:"red",
            validClass:"green",
            rules:{
                action_comment:{
                    required:true,
                },
                document:{
                    required:true,
                    accept:"pdf, jpeg, png, jpg, docx, xls",
                   //maxsize: 2000000
                }
            }
        });
    </script>
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
        .modal-title {float: left; }
        .Building-Units.document {font-size: 15px; font-weight: bold; margin: 0; }
    </style>
@endsection