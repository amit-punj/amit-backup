@extends('admin.layout.base')

@section('title', 'Help ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            	<p>No Content Available !!</p>
                {!! $Data['content'] !!}
            </div>
        </div>
    </div>

@endsection
