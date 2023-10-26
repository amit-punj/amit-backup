@extends('admin.layout.base')

@section('title', 'Providers ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            @if(Setting::get('demo_mode') == 1)
                <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : No Permission to Edit and Delete.
                </div>
            @endif
            <h5 class="mb-1">
                @lang('admin.provides.providers')
                @if(Setting::get('demo_mode', 0) == 1)
                <span class="pull-right">(*personal information hidden in demo)</span>
                @endif
            </h5>
            <a href="{{ route('admin.provider.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right">
                <i class="fa fa-plus" style="padding-right: 5px;"></i>@lang('admin.provides.add_new_provider')
            </a>
            <table class="table table-striped table-bordered dataTable" id="table-2" style="width: 100%">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.provides.full_name')</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.mobile')</th>
                        <th>@lang('admin.provides.total_requests')</th>
                        <th>@lang('admin.provides.accepted_requests')</th>
                        <th>@lang('admin.provides.cancelled_requests')</th>
                        <th>@lang('admin.provides.service_type')</th>
                        <th>@lang('admin.provides.online')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($providers as $index => $provider)
                    <tr <?php if($provider->status == 'banned'){ echo "style='color:#ea303a'"; } ?>>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $provider->first_name }} {{ $provider->last_name }}</td>
                        @if(Setting::get('demo_mode', 0) == 1)
                        <td>{{ substr($provider->email, 0, 3).'****'.substr($provider->email, strpos($provider->email, "@")) }}</td>
                        @else
                        <td>{{ $provider->email }}</td>
                        @endif
                        @if(Setting::get('demo_mode', 0) == 1)
                        <td>+919876543210</td>
                        @else
                        <td>{{ $provider->mobile }}</td>
                        @endif
                        <td>{{ $provider->total_requests }}</td>
                        <td>{{ $provider->accepted_requests }}</td>
                        <td>{{ $provider->total_requests - $provider->accepted_requests }}</td>
                        <td>
                            @if($provider->active_documents() < count_DriverDocuments() || $provider->service == null || $provider->active_service() == 0)
                                <a class="btn btn-danger btn-block label-right" href="{{route('admin.provider.document.index', $provider->id )}}">Attention! <span class="btn-label"></span></a>
                            @else
                                <a class="btn btn-success btn-block" href="{{route('admin.provider.document.index', $provider->id )}}">All Set!</a>
                            @endif
                            <!-- @if($provider->pending_documents() > 0 || $provider->service == null)
                                <a class="btn btn-danger btn-block label-right" href="{{route('admin.provider.document.index', $provider->id )}}">Attention! <span class="btn-label">{{ $provider->pending_documents() }}</span></a>
                            @else
                                <a class="btn btn-success btn-block" href="{{route('admin.provider.document.index', $provider->id )}}">All Set!</a>
                            @endif -->
                        </td>
                        <td>
                            @if($provider->service)
                                @if($provider->service->status == 'active')
                                    <label class="btn btn-block btn-primary">Yes</label>
                                @else
                                    <label class="btn btn-block btn-warning">No</label>
                                @endif
                            @else
                                <label class="btn btn-block btn-danger">N/A</label>
                            @endif
                        </td>
                        <td>
                            <div class="input-group-btn">
                                @if($provider->status == 'approved')
                                <a class="btn btn-danger btn-block" href="{{ route('admin.provider.disapprove', $provider->id ) }}">@lang('Disable')</a>
                                @else
                                <a class="btn btn-success btn-block" href="{{ route('admin.provider.approve', $provider->id ) }}">@lang('Enable')</a>
                                @endif
                                <button type="button" 
                                    class="btn btn-info btn-block dropdown-toggle"
                                    data-toggle="dropdown">@lang('admin.action')
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.provider.request', $provider->id) }}" class="btn btn-default">
                                            <i class="fa fa-search"></i> @lang('admin.History')
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.provider.statement', $provider->id) }}" class="btn btn-default">
                                            <i class="fa fa-tasks" aria-hidden="true"></i> @lang('admin.Statements')
                                        </a>
                                    </li>
                                    @if( Setting::get('demo_mode') == 0)
                                    <li>
                                        <a href="{{ route('admin.provider.edit', $provider->id) }}" class="btn btn-default">
                                            <i class="fa fa-pencil"></i> @lang('admin.edit')
                                        </a>
                                    </li>
                                    @endif
                                    <li>
                                        <form action="{{ route('admin.provider.destroy', $provider->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            @if( Setting::get('demo_mode') == 0)
                                            <button class="btn btn-default look-a-like" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>@lang('admin.delete')</button>
                                            @endif
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.provider.ticketList', $provider->id) }}" class="btn btn-default">
                                            <i class="fa fa-search"></i> @lang('admin.include.tickets')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="input-group-btn" style="left: 20px;">
                                <!-- <a href="javascript::void()" class="btn btn-success btn-block pull-right" onclick="providerAccountModal('{{$provider->id}}')" data-target-id="{{$provider->id}}">Bank Details</a>

                                <a href="javascript::void()" class="btn btn-success btn-block pull-right" onclick="docModal('{{$provider->id}}')" data-target-id="{{$provider->id}}">Documents</a> -->
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.provides.full_name')</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.mobile')</th>
                        <th>@lang('admin.provides.total_requests')</th>
                        <th>@lang('admin.provides.accepted_requests')</th>
                        <th>@lang('admin.provides.cancelled_requests')</th>
                        <th>@lang('admin.provides.service_type')</th>
                        <th>@lang('admin.provides.online')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- /.Account Modal -->
<div id="ModalAddAccount" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title col-sm-11">Add Account</h3>
                <button data-dismiss="modal" type="button" class="close col-sm-1 text-right" style="margin-top: 7px">x</button>
            </div>
            <div class="modal-body" style="height: 280px">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /.Docs Modal -->
<div id="ModalAddDocs" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title col-sm-11">Manage Documents</h1>
                <button data-dismiss="modal" type="button" class="close col-sm-1 mt-1">x</button>
            </div>
            <div class="modal-body">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#ModalAddAccount").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('target-id');
            $('#pid').val(id);
        });
    });

    function docModal($id){
        var url = "{{url('/admin/provider/user_edit_docs')}}"+"/"+$id;
        $('#ModalAddDocs .modal-body').load(url,function(result){
            $('#ModalAddDocs').modal({show:true});
        });
        $('#admin_provider_doc').on('submit',function(e){
            e.preventDefault();
            alert('form submit');
        })
    }

    function providerAccountModal($id){
        var url = "{{url('/admin/provider/provider_account')}}"+"/"+$id;
        $('#ModalAddAccount .modal-body').load(url,function(result){
            $('#ModalAddAccount').modal({show:true});
        });
    }


    
</script>
@endsection