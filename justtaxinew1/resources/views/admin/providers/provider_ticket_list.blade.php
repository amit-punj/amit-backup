@extends('admin.layout.base')

@section('title', 'Tickets ')

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
                @lang('admin.include.tickets') raised by {{$user->first_name}} {{$user->last_name}}
                @if(Setting::get('demo_mode', 0) == 1)
                <span class="pull-right">(*personal information hidden in demo)</span>
                @endif
            </h5>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.tickets.title')</th>
                        <th>@lang('admin.tickets.description')</th>
                        <th>@lang('admin.tickets.category')</th>
                        <!-- <th>@lang('admin.tickets.raised')</th> -->
                        <th>@lang('admin.tickets.status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $index => $ticket)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->description }}</td>
                       <!--  @if(Setting::get('demo_mode', 0) == 1)
                        <td>{{ substr($ticket->email, 0, 3).'****'.substr($ticket->email, strpos($ticket->email, "@")) }}</td>
                        @else
                        <td>{{ $ticket->email }}</td>
                        @endif
                        @if(Setting::get('demo_mode', 0) == 1)
                        <td>+919876543210</td>
                        @else
                        <td>{{ $ticket->mobile }}</td>
                        @endif -->
                        <td>{{ $ticket->category }}</td>
                        <!-- <td>{{ $ticket->issue_raised_by }}</td> -->
                        <td>{{ $ticket->status }}</td>
                        <td>
                            <div class="input-group-btn">
                            @if( Setting::get('demo_mode') == 0)
                                <a href="{{ route('admin.provider.providerTicket', [$ticket->id]) }}"><span class="btn btn-success btn-large">View</span></a>
                            @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.tickets.title')</th>
                        <th>@lang('admin.tickets.description')</th>
                        <th>@lang('admin.tickets.category')</th>
                        <!-- <th>@lang('admin.tickets.raised')</th> -->
                        <th>@lang('admin.tickets.status')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    
</script>
@endsection