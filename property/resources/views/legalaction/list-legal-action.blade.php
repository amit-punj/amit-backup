@section('title','Legal Actions')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Legal Actions'])
<?php
$role = Auth::user()->user_role;
//$meterPermission = App\Helpers\Helper::accessPermission($unit->user_id,Auth::user()->user_role,'legal_permission');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 top-nevigation" >
            <div class="row">
                <div class="col-sm-6">
                    <div class="tenent-title">List All Legal Actions</div>
                </div>
                <div class="col-sm-6">
                    <div class="add-unit-main">
                        @if($role == 2 )
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModel">Create Legal Actions <span class="glyphicon glyphicon-plus"></span></button>
                        @endif
                        @if($role == 3)
                            <style type="text/css">.add-unit-main {display: none; }</style>
                            @if(count($units) > 0)
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateModel">Create Legal Actions <span class="glyphicon glyphicon-plus"></span></button>
                            @endif
                        @endif
                    </div>
                </div>
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
                                            <td >Due Amount </td>
                                            <td >Comment </td>
                                            <td >Status </td>
                                            <td >Action</td>
                                        </tr> 
                                    </thead>   
                                    <tbody >
                                        @foreach($legalActions as $legalAction)
                                        <tr>
                                            <td>
                                                <a target="_blank" href="{{ url('propertydetails/'.$legalAction->unit_id) }}">
                                                    {{ substr($legalAction->unit['unit_name'], 0, 20) }}...
                                                </a>
                                            </td>
                                            <td >
                                                <a target="_blank" href="{{ url('tenant-details/'.$legalAction->tenant_id) }}">
                                                {{ $legalAction->tenant['name']." ".$legalAction->tenant['last_name'] }}
                                                </a>
                                            </td>
                                            <td >
                                                {{ $legalAction->legalAdvisor['name']." ".$legalAction->legalAdvisor['last_name'] }}
                                            </td>
                                            @if($legalAction->due_amount != '')
                                                <td >{{ $legalAction->due_amount }}</td>
                                            @else
                                                <td >--</td>
                                            @endif
                                            <td >{{ substr($legalAction->comment, 0, 25) }}...</td>
                                            <td >{{ $legalAction->status }}</td>
                                            <td >
                                                <a href="{{ url('/legal-action/'.$legalAction->id ) }}"><span title="View" class="glyphicon glyphicon-eye-open"></span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $legalActions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@if($role == 2 || $role == 3)
<div class="modal fade" id="updateModel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Legal Action</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/create-legal-action') }}" id="create_tenant_form">
                    @csrf
                    @if($role == 2)
                    <input type="hidden" name="po_id" value="{{ Auth::user()->id }}">
                    @elseif($role == 3)
                    <input type="hidden" id="po_id" name="po_id" value="">
                    @endif
                    <input id="contract_id" type="hidden" name="contract_id" value="">
                    <div class="form-group row">
                        <label for="related_to" class="col-md-4 col-form-label text-md-right">Related To</label>
                        <div class="col-md-6">
                            <input type="text" name="related_to" class="form-control green" aria-invalid="false">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="unit_id" class="col-md-4 col-form-label text-md-right">Select Unit</label>
                        <div class="col-md-6">
                            <?php $count = 0; ?>
                            
                            <select name="unit_id" id="unit_id" class="form-control green" aria-invalid="false">
                                <option value="">Select Unit</option>
                                @if(count($units) > 0 && $role == 2)
                                    @foreach($units as $unit)
                                        <option data-po="{{$unit->user_id}}" data-contract="{{ $unit->unit_contract_id }}" data-tenant="{{ $unit->tenant_id}}" data-legal="{{ $unit->property_legal_advisor_id}}" value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                @elseif(count($units) > 0 && $role == 3)
                                    @foreach($units as $unit)
                                       @if(count(\App\AccessPermission::where('po_id',$unit->user_id)-> where('user_role',3)->where('legal_permission',2)->get()) > 0)
                                        <?php $count = $count+1; ?>
                                        <option data-po="{{$unit->user_id}}" data-contract="{{ $unit->unit_contract_id }}" data-tenant="{{ $unit->tenant_id}}" data-legal="{{ $unit->lad_id}}" value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @if($count > 0)
                            <style type="text/css">.add-unit-main {display: block !important; }</style>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tenant_id" class="col-md-4 col-form-label text-md-right">Tenant</label>
                        <div class="col-md-6">
                            <select name="tenant_id" id="tenant_id" class="form-control green" aria-invalid="false" disabled="true">
                                <option value="">Select Tenant</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="legal_advisor_id" class="col-md-4 col-form-label text-md-right">Legal Advisor</label>
                        <div class="col-md-6">
                            <select name="legal_advisor_id" id="legal_advisor_id" class="form-control green" aria-invalid="false" disabled="true">
                                <option value="">Select Legal Advisor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="due_amount" class="col-md-4 col-form-label text-md-right">Due Amount</label>
                        <div class="col-md-6">
                            <input type="text" name="due_amount" class="form-control green" aria-invalid="false">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comment" class="col-md-4 col-form-label text-md-right">Message</label>
                        <div class="col-md-6">
                            <textarea name="comment" class="form-control green" aria-invalid="false"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" id="create_tenant_button"class="btn btn-success">Create Action</button>
                        </div>
                    </div>
                </form>
            </div>   
        </div>          
    </div>
</div>
@endif
<script type="text/javascript">
    jQuery('#create_tenant_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{
            related_to:{
                required:true,
            },
            unit_id:{
                required:true,
            },
            tenant_id:{
                required:true,
            },            
            legal_advisor_id:{
                required:true,
            },
            due_amount:{
                //required:true,
                number:true
            },
            comment:{
                required:true,
            }
        }
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#unit_id').change(function(){

            @if($role == 3)
            jQuery('#po_id').val(jQuery("#unit_id").find(':selected').attr('data-po'));
            @endif

            jQuery('#contract_id').val(jQuery("#unit_id").find(':selected').attr('data-contract'));
            var tenant_id = jQuery("#unit_id").find(':selected').attr('data-tenant');
            var legal_id = jQuery("#unit_id").find(':selected').attr('data-legal');
            jQuery.ajax({
                url: "{{ url('/unit-tenant-legal-advisor') }}",
                type: "POST",
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'tenant_id':tenant_id,
                    'legal_id':legal_id
                },
                success: function(data){
                    console.log(data);
                    jQuery('#tenant_id, #legal_advisor_id').find('option:not(:first)').remove();
                    jQuery('#tenant_id').append(data.tenant);
                    jQuery('#legal_advisor_id').append(data.legal);
                    jQuery('#tenant_id, #legal_advisor_id').prop("disabled", false);
                }
            });
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
    /*.top-nevigation a {border: 0 !important; background-color: #fae4c4; color: inherit; }*/
    .top-nevigation li.active a {background: #f28302; color: #fff; }
    .add-unit-main {text-align: right;     padding: 15px 0; }
    .unit-delete span {color: #000000bd; position: relative; float: right; }
    .Current_Active_Contract {font-size: 24px; text-align: center; }
    .documemt_action {text-align: right; }
    .documemt_action a {color: #000000bd; padding: 0 5px; }
    .contract-alert {background-color: bisque; padding: 9px; margin: 8px; border-radius: 5px; }
    .contract-alert-title {font-size: 24px; }
    .tenent-title {font-size: 24px; padding: 15px 0; }
    .modal-title {float: left; }
</style>
@endsection