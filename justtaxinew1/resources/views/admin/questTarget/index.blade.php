@extends('admin.layout.base')

@section('title', 'Quest ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                @if(Setting::get('demo_mode') == 1)
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : No Permission to Edit and Delete.
                    </div>
                @endif
                <h5 class="mb-1">@lang('admin.quest.quests')</h5>
                <a href="{{ route('admin.quest.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('admin.quest.add_quest')</a>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.quest.number_of_trips') </th>
                            <th>@lang('admin.quest.bonus_amount')</th>
                            <th>@lang('admin.quest.time_period') </th>
                            <th>@lang('admin.quest.trips_count')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($quests as $index => $promo)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td style="text-transform: uppercase;">{{$promo->number_of_trips}}</td>
                            <td>{{$promo->bonus_amount}}</td>
                            <td>
                                {{date('d-m-Y',strtotime($promo->time_period))}}
                            </td>
                            <td>
                                {{promo_used_count($promo->id)}}
                            </td>
                            <td>
                                @if(date("Y-m-d") <= $promo->time_period)
                                    <span class="tag tag-success">Valid</span>
                                @else
                                    <span class="tag tag-danger">Expiration</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.quest.destroy', $promo->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode') == 0)
                                    <a href="{{ route('admin.quest.edit', $promo->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.quest.number_of_trips') </th>
                            <th>@lang('admin.quest.bonus_amount')</th>
                            <th>@lang('admin.quest.time_period') </th>
                            <th>@lang('admin.quest.trips_count')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection