@extends('admin.layout.base')

@section('title', 'Referrals ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                @if(Setting::get('demo_mode') == 1)
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : No Permission to Edit and Delete.
                    </div>
                @endif
                <h5 class="mb-1">@lang('admin.referrals.referrals')</h5>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.referrals.user') </th>
                            <th>@lang('admin.referrals.referral_code') </th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($referrals as $index => $promo)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td style="text-transform: uppercase;">{{ (isset($promo->user->first_name)) ? $promo->user->first_name.' '.$promo->user->last_name : ''}}</td>
                            <td>{{$promo->referral_code}}</td>
                            <td>
                               <!--  <form action="{{ route('admin.promocode.destroy', $promo->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode') == 0)
                                    <a href="{{ route('admin.promocode.edit', $promo->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                    @endif
                                </form> -->
                                <a href="{{ route('admin.referrals.show', $promo->id) }}" class="btn btn-info"><i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.referrals.user') </th>
                            <th>@lang('admin.referrals.referral_code') </th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection