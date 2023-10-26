@extends('admin.layout.base')

@section('title', 'Provider Documents ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        
        <div class="box box-block bg-white">
            <h5 class="mb-1">@lang('admin.provides.provider_name'): {{ $Document->provider->first_name }} {{ $Document->provider->last_name }}</h5>
            <h5 class="mb-1">Document: {{ $Document->document->name }}</h5>
            <embed src="{{ storageImg($Document->url) }}" width="100%" height="400px" />

            <div class="row">
                @if($Document->status == 'ASSESSING')
                    <div class="col-xs-6">
                        <form action="{{ route('admin.provider.document.update', [$Document->provider->id, $Document->id,'status=active']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <button class="btn btn-block btn-primary" type="submit" onclick="return confirm('Are you sure?')">@lang('admin.provides.approve')</button>
                        </form>
                    </div>

                    <div class="col-xs-6">
                        <form action="{{ route('admin.provider.document.update', [$Document->provider->id, $Document->id,'status=reject']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <button class="btn btn-block btn-danger" type="submit" onclick="return confirm('Are you sure?')">@lang('admin.provides.reject')</button>
                        </form>
                    </div>
                @elseif($Document->status == 'ACTIVE')
                    <div class="col-lg-12 col-xs-6">
                        <form action="{{ route('admin.provider.document.update', [$Document->provider->id, $Document->id,'status=reject']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <button class="btn btn-block btn-danger" type="submit" onclick="return confirm('Are you sure?')">@lang('admin.provides.reject')</button>
                        </form>
                    </div>
                @else
                    <div class="col-lg-12 col-xs-12">
                        <form action="{{ route('admin.provider.document.update', [$Document->provider->id, $Document->id,'status=active']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <button class="btn btn-block btn-primary" type="submit" onclick="return confirm('Are you sure?')">@lang('admin.provides.approve')</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        
    </div>
</div>
@endsection