@extends('admin.layout.base')

@section('title', 'Provider Details ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            	<h2>@lang('admin.provides.Provider_Account_Details')</h2>
            	<div class="row">
					<div class="col-md-8">
						@if(isset($account->bank_account) && isset($account->bank_name) && isset($account->branch_name) && isset($account->ifsc_code)) 
						<div class="details row mt-3">
							<div class="col-md-4" style="font-size: 18px">
								<b><u>	Account Number	</u></b>
							</div>
							<div class="col-md-6" style="text-align: left; font-size: 16px">
								{{$account->bank_account}}
							</div>
						</div>
						<div class="details row mt-3">
							<div class="col-md-4" style="font-size: 18px">
								<b><u>	Bank Name	</u></b>
							</div>
							<div class="col-md-6" style="text-align: left; font-size: 16px">
								{{$account->bank_name}}
							</div>
						</div>
						<div class="details row mt-3">
							<div class="col-md-4" style="font-size: 18px">
								<b><u>	Branch Name & Code	</u></b>
							</div>
							<div class="col-md-6" style="text-align: left; font-size: 16px">
								{{$account->branch_name}}, ({{$account->branch_code}})
							</div>
						</div>
						<div class="details row mt-3">
							<div class="col-md-4" style="font-size: 18px">
								<b><u>	IFSC Code	</u></b>
							</div>
							<div class="col-md-6" style="text-align: left; font-size: 16px">
								{{$account->ifsc_code}}
							</div>
						</div>
						@else
							<p class="mt-3" style="color: indianred">Account Details not found !!</a></p>
						@endif
					</div>
					<div class="col-md-4">
						<div class="box bg-white user-1">
						<?php $background = asset('admin/assets/img/photos-1/4.jpg'); ?>
							<div class="u-img img-cover" style="background-image: url({{$background}}); height: 60px;"></div>
							<div class="u-content">
								<div class="avatar box-64">
									<img class="b-a-radius-circle shadow-white" src="{{img($provider->picture)}}" alt="">
									<i class="status bg-success bottom right"></i>
								</div>
							</div>
						</div>
					</div>
            	</div>
            </div>
        </div>
    </div>

@endsection
