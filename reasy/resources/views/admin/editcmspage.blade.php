@extends('adminlayouts.app')

@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Add Cms Page</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <!-- <li class="breadcrumb-item">Forms</li> -->
         <!--  <li class="breadcrumb-item"><a href="{{url('/admin/updatecmspage')}}">Add Cms Page</a></li> -->
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Vertical Form</h3>
            <div class="tile-body">
              <form method="post" action="{{url('/admin/updatecmspage')}}">
              	@csrf
                <input type="hidden" value="{{ $data->id }}" name="id">
                <div class="form-group">
                  <label class="control-label">Title</label>
                  <input class="form-control" type="text" placeholder="Enter full title" name="title" value="{{ $data->title }}">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Status</label>
                    <select class="form-control" name="status">
                      <option value="1">Enable</option>
                      <option value="0">Disable</option>
                    </select>
                  </div>
                <div class="form-group">
                  <label class="control-label">Content</label>
                  <textarea id="add_cms_content" class="form-control" name="content" rows="4" placeholder="Enter your content">{{ $data->content }}</textarea>
                </div>
                 <div class="tile-footer">
	              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
	            </div>
              </form>
            </div>
           
          </div>
        </div>
        <div class="clearix"></div>
      </div>
      <style>.popover-content.note-children-container {display: none; }</style>
    </main>
@endsection
