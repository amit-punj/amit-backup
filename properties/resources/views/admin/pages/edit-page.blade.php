@extends('admin.layouts.app')

@section('content')

<div id="content">
  <div id="content-header">
    <ul class="breadcrumb">
        <li><a href="{{ url('/admin') }}">Home</a></li>                    
        <li class="active">Pages</li>
    </ul>
    
  </div>
  <div class="container-fluid">
    <h1>Add New Pages</h1>
    <div class="col-md-12">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Pages</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-page/'.$PageDetails->id) }}" name="basic_validate" id="edit_page" novalidate="novalidate">{{ csrf_field() }}
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Name</label>
                <div class="col-sm-10">
                  <input type="text" name="page_name" id="page_name"  class="form-control" value="{{ $PageDetails->name }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Slug</label>
                <div class="col-sm-10">
                  <input type="text" name="page_slug" id="page_slug" readonly="" class="form-control" value="{{ $PageDetails->slug }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Content</label>
                <div class="col-sm-10">
                  <textarea name="page_content" id="page_content" class="form-control">{{ $PageDetails->content }}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Meta key</label>
                <div class="col-sm-10">
                  <input type="text" name="meta_key" id="meta_key"  class="form-control" value="{{ $PageDetails->meta_key }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Meta Value</label>
                <div class="col-sm-10">
                  <input type="text" name="meta_value" id="meta_value"  class="form-control" value="{{ $PageDetails->meta_value }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 control-label"> Status</label>
                <div class="col-sm-10">
                	<select name="page_status" id="page_status" class="form-control">
                		<option {{ ($PageDetails->status == 1)?"selected:selected":"" }} value="1">Active </option>
                		<option {{ ($PageDetails->status == 0)?"selected:selected":"" }} value="0">Inactive </option>
                	</select>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add New Page" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection