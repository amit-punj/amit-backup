@extends('admin.layouts.app')
@section('content')

<ul class="breadcrumb">
    <li><a href="{{url('dashboard')}}">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB --> 


<div class="page-content-wrap">
<div class="clearfix"></div>
<!-- START WIDGETS -->                    
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Import Property CSV</div>
            <div class="panel-body">
                @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
                @endif
                <form action="{{ url('admin/import-property') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import Property Data</button>
                    <!-- <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a> -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END WIDGETS -->                    
</div>
@endsection