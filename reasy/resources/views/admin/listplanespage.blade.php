@extends('adminlayouts.app')

@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> List of All Plans</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="{{url('/admin/listplans')}}">All Plans Pages</a></li>
        </ul>
      </div>
      <div class="row">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="list_cms_pages">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($plans as $plan)                     
                    <tr>
                      <td>{{ $plan->title }}</td>
                      @if ($plan->status == 1)
                         <td>Enable</td>
                      @else
                          <td>Disable</td>
                      @endif                     
                      <td>{{ $plan->created_at }}</td>
                      <td><a href="{{ url('/admin/editplanpage/'.$plan->id) }}">Edit</a></td>
                      <td><a href="{{ url('/admin/deleteplanpage/'.$plan->id) }}">Delete</a></td>
                    </tr>
                  @endforeach                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <style type="text/css">div#list_cms_pages_filter {display: none; }</style>
    </main>
@endsection
