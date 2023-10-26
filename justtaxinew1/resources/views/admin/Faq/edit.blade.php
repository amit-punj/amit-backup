@extends('admin.layout.base')

@section('title', 'Update Area ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('admin.faq.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

            <h5 style="margin-bottom: 2em;">@lang('admin.faq.Update_category')</h5>

            <form class="form-horizontal" action="{{route('admin.faq.update', $faq->id )}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">

                <div class="form-group row">
                    <label for="name" class="col-md-12 col-form-label">Category</label>
                    <div class="col-md-10">
                         <?php  $explode = (!empty($faq->category_id) ) ? explode(",",$faq->category_id ) : array() ;  ?>
                        <select type="text" name="category[]" class="form-control js-example-basic-multiple" id="category" multiple="multiple">
                            <option value="0" >Select Category</option>
                            @if(count($categories) > 0)
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}" {{(in_array($cat->id,$explode)) ? 'selected' : ''}}>{{ $cat->category }} </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit" class="col-md-12 required">Question</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{$faq->question}}" id="question" name="question" placeholder="Enter Question">
                        <span class="errors" id="error_unit"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit" class="col-md-12 required">Answer</label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="answer" name="answer" placeholder="Enter Answer">{{$faq->answer}}</textarea>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <label for="custom-fields" style="font-size: 16px; padding-top: 5px">
                            Custom Fields
                        </label>
                    </div>
                    <div class="col-lg-3 col-md-3 mb-1" style="text-align: end;">
                        <a class="btn bg-primary" id="add-custom">Add Custom Fields</a>
                    </div>
                </div>
                <div id="custom-field">
                    <div class="custom-field-data">
                        @foreach($faqfield as $key => $faq)
                            <div class="fields{{$faq->id}} mb-2 pl-2" data-id="{{$faq->id}}" style="border: 1px solid lightgray; width: 83%; padding-top: 5px;">
                                <a href="javascript:void(0);" class="remove-custom-db" style="float: right; padding-right: 20px; cursor: pointer;" data-id="{{$faq->id}}">x</a>
                                <div class="form-group row">
                                    <label for="unit" class="col-md-11 required">Field Label</label>
                                    <div class="col-md-11">
                                        <input type="hidden" name="faqfield_id[]" value="{{$faq->id}}">
                                        <input type="text" class="form-control" id="label_of_field0" name="label_of_field[]" placeholder="Enter Field Label" value="{{$faq->label}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unit" class="col-md-12 required">Field Type</label>
                                    <div class="col-md-11">
                                        <select name="type_of_field[]" class="form-control" id="type_of_field0">
                                            <option value="0" disabled>Select Category</option>
                                            <option value="textarea" {{$faq->type == 'textarea' ? "selected" : ''}}>TextArea </option>
                                            <option value="text" {{$faq->type == 'text' ? "selected" : ''}}>Text </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                        <button type="submit" class="btn btn-primary btn-block">@lang('admin.faq.Update_category')</button>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <a href="{{route('admin.faq.index')}}" class="btn btn-danger btn-block">@lang('admin.cancel')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    });

    var i = 0;
    $("#add-custom").click(function () {
        ++i;
        $("#custom-field").append('<div class="fields mb-2 pl-2" style="border: 1px solid lightgray; width: 83%; padding-top: 5px;" id='+i+'><a href="javascript:void(0);" class="remove-custom" style="float: right; padding-right: 20px; cursor: pointer;">x</a><div class="form-group row"><label for="unit" class="col-md-11 required">Field Label</label><div class="col-md-11"><input type="text" class="form-control" id="label_of_field'+i+'" name="label_of_field[]" placeholder="Enter Field Label"></div></div><div class="form-group row"><label for="unit" class="col-md-12 required">Field Type</label><div class="col-md-11"><select name="type_of_field[]" class="form-control" id="type_of_field'+i+'"><option value="0" disabled selected>Select Category</option><option value="textarea">TextArea </option><option value="text">Text </option></select></div></div></div>');
    });

    $("#custom-field").on("click",".remove-custom", function(e){
        e.preventDefault();
        $(this).parents('.fields').remove();
    });


    $(".remove-custom-db").click(function(){
        var id = $(this).data("id");
        // alert(id);
        $.ajax({
                type:'POST',
                url: "{{ URL('admin/faq/delete') }}/"+id,
                data: {
                    "id": id,
                    "method": 'POST',
                    "_token": "{{ csrf_token() }}",
                },
                success:function(response){
                   console.log(response);
                   if(response.status == true)
                   {
                        $('.fields'+id).remove();
                   }
                   else
                   {
                       var errors = response.errors;
                   }
                }
        });
    });

</script>
@endsection
