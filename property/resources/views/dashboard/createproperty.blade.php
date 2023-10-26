@section('title','Create Property')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Create Property'])
<style type="text/css">
    .c309 {
        top: -3px;
        left: -10px;
        width: 4%;
        cursor: inherit;
        height: 100%;
        margin: 0;
        /* opacity: 0; */
        padding: 0;
        position: absolute; 
    }
</style>
<div class="container">
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
                <div class="col-sm-12">
                    @include('dashboard..propertyform.form')
                </div>
            </div>  
        </div>
    </div>
</div>  
@endsection