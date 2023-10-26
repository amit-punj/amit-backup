@extends('admin.layouts.app')

@section('content')

<div id="content">
  <div id="content-header">
    <ul class="breadcrumb">
        <li><a href="{{ url('/admin') }}">Home</a></li>                    
        <li class="active">Pages</li>
    </ul>
    <div class="page-content-wrap">

    <!-- START WIDGETS -->                    
    <div class="row">
      <div class="col-md-12">
        <h2>Listing Pages</h2>
        @if(Session::has('flash_message_error'))    
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif 
        @if(Session::has('flash_message_success'))    
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
        <table class="table table-bordered data-table">
          <thead>
            <tr>
              <th>Page ID</th>
              <th>Page Name</th>
              <th>Page Content</th>
              <th>Pages Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $Pages as $page )
            <tr class="gradeX">
              <td>{{ $page->id }}</td>
              <td>{{ $page->name }}</td>
              <td>{{ $page->content }}</td>
              <td>{{ ($page->status == 1)?"Active":"Inactive" }}</td>
              <td class="center">
                <a href="{{ url('/admin/edit-page/'. $page->id ) }}" class="btn btn-primary btn-mini"><i class="fa fa-edit"></i></a> 
                <a href="{{ url('/admin/delete-page/'. $page->id ) }}" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure to delete this page?')"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
         </tbody>
        </table>
      </div>
    </div>
</div>


@endsection