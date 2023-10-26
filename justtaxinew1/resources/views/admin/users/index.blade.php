@extends('admin.layout.base')

@section('title', 'Users ')

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
                @lang('admin.users.Users')
                @if(Setting::get('demo_mode', 0) == 1)
                <span class="pull-right">(*personal information hidden in demo)</span>
                @endif
            </h5>
            <a href="{{ route('admin.user.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Rider</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.first_name')</th>
                        <th>@lang('admin.last_name')</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.mobile')</th>
                        <th>@lang('admin.users.Rating')</th>
                        <th>@lang('admin.users.Wallet_Amount')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr <?php if($user->status != 'approved'){ echo "style='color:#ea303a'"; } ?>>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        @if(Setting::get('demo_mode', 0) == 1)
                        <td>{{ substr($user->email, 0, 3).'****'.substr($user->email, strpos($user->email, "@")) }}</td>
                        @else
                        <td>{{ $user->email }}</td>
                        @endif
                        @if(Setting::get('demo_mode', 0) == 1)
                        <td>+919876543210</td>
                        @else
                        <td>{{ $user->mobile }}</td>
                        @endif
                        <td>{{ $user->rating }}</td>
                        <td>{{ currency().$user->wallet_balance }}</td>
                        <td>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">

                                @if($user->status == 'approved')
                                <a class="btn btn-danger" href="{{ route('admin.user.disapprove', $user->id ) }}">@lang('Disable')</a>
                                @else
                                <a class="btn btn-success" href="{{ route('admin.user.approve', $user->id ) }}">@lang('Enable')</a>
                                @endif
                                <div class="dropdown">
                                    <a href="javascript:void(0)" 
                                        class="btn btn-info btn-block dropdown-toggle"
                                        data-toggle="dropdown">@lang('admin.action')
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('admin.user.request', $user->id) }}" class="">
                                                <i class="fa fa-search ml-1 mr-1 mb-1"></i> 
                                                @lang('admin.History')
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="javascript::void()" class="" onclick="userAccountModal('{{$user->id}}')" data-target-id="{{$user->id}}">
                                                <i class="fa fa-bank ml-1 mr-1 mb-1"></i>@lang('admin.Accounts')</a>
                                        </li> -->
                                        @if( Setting::get('demo_mode') == 0)
                                        <li>
                                            <a href="{{ route('admin.user.edit', $user->id) }}" class=""><i class="fa fa-pencil ml-1 mr-1 mb-1"></i> @lang('admin.edit')</a>
                                        </li>
                                        <li style="color: red">
                                            <button style="color: red" class="btn btn-default look-a-like" onclick="return confirm('Are you sure?')"><i class="fa fa-trash mr-1 mb-1"></i>@lang('admin.delete')</button>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('admin.user.ticketList', $user->id) }}" class=""><i class="fa fa-ticket ml-1 mr-1 mb-1"></i> Tickets</a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.first_name')</th>
                        <th>@lang('admin.last_name')</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.mobile')</th>
                        <th>@lang('admin.users.Rating')</th>
                        <th>@lang('admin.users.Wallet_Amount')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- /.Account Modal -->
<div id="ModalUserAccount" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title col-sm-11">Manage User Account</h3>
                <button data-dismiss="modal" type="button" class="close col-sm-1 text-right" style="margin-top: 7px">x</button>
            </div>
            <div class="modal-body" style="height: auto;">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#ModalUserAccount").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('target-id');
            $('#uid').val(id);
        });
    });
    
    function userAccountModal($id){
        var url = "{{url('/admin/user/user_account')}}"+"/"+$id;
        $('#ModalUserAccount .modal-body').load(url,function(result){
            $('#ModalUserAccount').modal({show:true});
        });
    }
</script>
@endsection