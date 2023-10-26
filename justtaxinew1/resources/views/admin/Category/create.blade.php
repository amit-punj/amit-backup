@extends('admin.layout.base')

@section('title', 'Add Category ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.category.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.category.Add_category')</h5>

            <form class="form-horizontal" action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label">Category</label>
                    <div class="col-md-10">
                        <select type="text" name="parent" class="form-control" id="parent">
                            <option value="0" >Select Category</option>
                            @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{ $category->category }} </option>
                            @endforeach
                            @endif
                        </select>
                        <span class="errors" id="error_name"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit" class="col-md-12 required">Sub Category</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="category" name="category" placeholder="Enter Sub-Category">
                        <span class="errors" id="error_unit"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">@lang('admin.category.Add_category')</button>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-danger btn-block">@lang('admin.cancel')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#hour_price").hide();
    $("#calculator").change(function(){
        if($("#calculator").val() == 'DISTANCEHOUR'){
            $("#hour_price").show();
        }
        else{
            $("#hour_price").hide();
        }
    });
});
</script>
@endsection
