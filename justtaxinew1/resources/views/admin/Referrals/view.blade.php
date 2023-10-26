@extends('admin.layout.base')

@section('title', 'Referral View')

@section('content')

    <div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.referrals.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.referrals.referral_view')</h5>
            <div class="form-group row">
                <label for="promo_code" class="col-xs-2 col-form-label">@lang('admin.referrals.user')</label>
                <div class="col-xs-10">
                    <span>{{ (isset($referrals->user->first_name)) ? $referrals->user->first_name.' '.$referrals->user->last_name : ''}}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="promo_code" class="col-xs-2 col-form-label">@lang('admin.referrals.referral_code')</label>
                <div class="col-xs-10">
                    <span>{{$referrals->referral_code}}</span>
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection