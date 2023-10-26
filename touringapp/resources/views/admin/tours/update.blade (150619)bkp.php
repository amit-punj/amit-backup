@extends('admin.layouts.main')

@section('content')
<style type="text/css">
    div#cke_1_contents {
        height: 100px !important;
    }
</style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Update Tour
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form action='{{ url("admin/tours/{$tour->id}/update") }}'   class="form-horizontal" method="post" role="form" id="create_formmcc" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tour_name" class="col-md-2">Tour Name</label>
                        <div class="col-md-10">
                            <input type="text" name="tour_name" class="form-control" value="{{ old('tour_name',$tour->tour_name ) }}"  placeholder="Tour Name"/>
                            @if ($errors->has('fname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tour_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tour_owner" class="col-md-2">Tour Owner</label>
                        <div class="col-md-10">
                            <select type="text" name="tour_owner" id="tour_owner" class="form-control" >
                             <?php  foreach ($users as $key => $user) 
                                {  ?>
                                    <option value="{{$user->id}}" {{ ($tour->tour_owner == $user->id)?'selected':''}}>{{ $user->name }}</option>
                            <?php   } ?>
                            </select>
                            @if ($errors->has('tour_owner'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tour_owner') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group" id="variations_div">
                        <label for="variations" class="col-md-2">Variations <button type="button" onclick="javascript:addRow()" class="btn btn-default"><i class="fa fa-plus" style="color:black"></i></button></label> 
                        <?php $i=0; ?>
                        <?php  
                    if(count($variation_details) > 0)
                    {
                        foreach ($variation_details as $key => $variation) 
                        { //echo "<pre>"; print_r($variation->id);
                    ?>
                        <div class="col-md-12" id="main_div_{{$i}}" style="display: flex;">
                            <input type="hidden" name="variation_id[{{$i}}]" id="variation_id_{{$i}}" value="{{$variation->id}}">
                            <div class="col-md-6" id="">
                                <input type="text" name="variations[{{ $i }}]" value="{{ old('variations',$variation->variation_name ) }}" id="variations_{{ $i }}" class="form-control"  placeholder="Variation Name"/>
                            </div>
                            <div class="col-md-4">
                                <select type="text" name="language[{{ $i }}]" id="language_{{ $i }}" class="form-control" >
                                    <option value="english" {{ ($variation->language == 'english')?'selected':''}} >{{ __('English') }}</option>
                                    <option value="dutch" {{ ($variation->language == 'dutch')?'selected':''}} >{{ __('Dutch') }}</option> 
                                    <option value="french" {{ ($variation->language == 'french')?'selected':''}} >{{ __('French') }}</option> 
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a href='javascript:void(0)' onclick="javascript:EditRow({{ $i }})" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href='javascript:void(0)' onclick="javascript:RemoveRow({{ $i }})" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    <?php $i++;
                        } 
                    }?>
                    </div>
                        <div class="col-md-12" id="message" style="display: none;color: red;"></div>
                    <div class="variation_data" id="variation_data">
                        <?php  foreach ($variation_details as $key => $variation) 
                                { ?>
                                    <span class="variation_list" id="variation_list_{{$variation->id}}" data-id="{{$variation->id}}" data-name="{{ $variation->variation_name }}" ></span>
                        <?php   } ?>
                    </div>
 
                    <div class="form-group" id="poi_div">
                        <label for="poi" class="col-md-2">POI's <button type="button" onclick="javascript:AddPoi()" class="btn btn-default"><i class="fa fa-plus" style="color:black"></i></button></label>
                        <?php $p=0; ?>
                     <?php  
                    if(count($poi_details) > 0)
                    {   
                        foreach ($poi_details as $key => $poi) 
                        { //echo "<pre>"; print_r($poi->id);
                    ?>
                    <div class="row" id="poi_div_{{$p}}">
                        <div class="col-md-12" id="main_poi_{{$p}}" style="display: flex;">
                            <input type="hidden" name="poi_id[{{$p}}]" id="poi_id_{{$p}}" value="{{$poi->id}}">
                            <div class="col-md-3">
                                <select type="text" class="variation_type" name="variation_type[{{ $p }}]" id="variation_type{{ $p }}" class="form-control" >
                                <?php  foreach ($variation_details as $key => $variation) 
                                        { ?>
                                            <option value="{{$variation->id}}" {{ ($poi->variation_id == $variation->id)?'selected':''}}>{{ $variation->variation_name }}</option>
                                <?php   } ?>
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="poi_name[{{ $p}}]" id="poi_name_{{ $p}}" value="{{ old('poi_name',$poi->poi_name ) }}" class="form-control"  placeholder="POI's (points of interest)"/>
                            </div>
                            <div class="col-md-3">
                                Location
                            </div>
                            <div class="col-md-3">
                                <select type="text" name="icon_type[{{ $p }}]" id="icon_type_{{ $p }}" class="form-control" >
                                    <option value="icon1" {{ ($poi->icon_type == 'icon1')?'selected':''}} title="{{ asset('images/icon1.png') }}" style="">Icon 1</option>
                                    <option value="icon2" {{ ($poi->icon_type == 'icon2')?'selected':''}} title="{{ asset('images/icon2.png') }}" style="">Icon 2</option> 
                                    <option value="icon3" {{ ($poi->icon_type == 'icon3')?'selected':''}} title="{{ asset('images/icon3.png') }}" style="">Icon 3</option> 
                                    <option value="icon4" {{ ($poi->icon_type == 'icon4')?'selected':''}} title="{{ asset('images/icon4.png') }}" style="">Icon 4</option> 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="main_poi_{{$p}}" style="display: flex;">
                            <div class="col-md-3">
                                <select type="text" onclick="javascript:select_content({{$p}})" name="content_type[{{ $p }}]" id="content_type_{{ $p }}" class="form-control" >
                                    <option value="text"  {{ ($poi->content_type == 'text')?'selected':''}} >{{ __('Text') }}</option>
                                    <option value="image"  {{ ($poi->content_type == 'image')?'selected':''}} >{{ __('Image') }}</option> 
                                    <option value="video"  {{ ($poi->content_type == 'video')?'selected':''}} >{{ __('Video') }}</option> 
                                </select>
                            </div>
                            <div class="col-md-7" id="content_{{$p}}">
                            <?php if($poi->content_type == 'text'){ ?>
                                    <input type="hidden" class="editor_list" id="editor_list" data-ids="editor{{ $p }}" >
                                    <textarea class="editor" name="editor{{ $p }}" id="editor_{{ $p }}"><?php ($poi->content) ? $poi->content : '' ; ?>
                                    </textarea>
                            <?php    }
                                elseif($poi->content_type == 'image')
                                { ?>
                                    <img src="{{ asset('images/'.$poi->image) }}" width="50" height="50" alt="">
                                    <input type="file" name="pic{{ $p }}" id="pic_{{$p}}" >
                            <?php }
                            else { ?>
                                <video width="320" height="240" controls>
                                  <source src="{{ asset('public/videos/'.$poi->image) }}" type="video/mp4">
                                </video>
                                <input type="file" name="pic{{ $p }}" id="pic_{{$p}}" >
                            <?php } ?>
                            </div>
                            <div class="col-md-2">
                                <a href='javascript:void(0)' onclick="javascript:EditPoi({{ $p }})" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href='javascript:void(0)' onclick="javascript:RemovePoi({{ $p }})" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div><br>
                        <?php $p++; 
                        }
                    }?>
                    </div>
                    <div class="col-md-12" id="poi_message" style="display: none;color: red;"></div>

                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password" class="form-control" id="set_password">
                                <option value="" >{{ __('Set Password') }}</option>
                                <option value="constant" {{ ($tour->set_password == 'constant')?'selected':''}}>{{ __('Constant') }}</option>
                                <option value="temporary" {{ ($tour->set_password == 'temporary')?'selected':''}} >{{ __('Temporary')  }}</option> 
                            </select>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-10" id="password_div">
                        <?php if($tour->set_password == 'constant') {?>
                            <input type="text" name="password" class="form-control" value="{{ $tour->current_password}}" placeholder="Password"/>
                        <?php } elseif ($tour->set_password == 'temporary') { ?>
                            <select type="text" name="password_type" class="form-control" id="password_type">
                                <option value="month" {{ ($tour->password_type == 'month')?'selected':''}}>{{ __("Month") }}</option>';
                                <option value="week" {{ ($tour->password_type == 'week')?'selected':''}}>{{ __("Week")  }}</option> ';
                                <option value="day" {{ ($tour->password_type == 'day')?'selected':''}}>{{ __("Day")  }}</option> ';
                                <!-- <option value="timezone" {{ ($tour->password_type == 'timezone')?'selected':''}}>{{ __("TimeZone")  }}</option> '; -->
                            </select>
                            <input type="text" name="password" class="form-control" value="{{ $tour->current_password}}" placeholder="Password"/>
                        <?php } ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="tour_control" class="col-md-2 required">Tour Control</label>
                        <div class="col-md-10">
                            <select type="text" name="tour_control" class="form-control" id="tour_control">
                                <option value="yes" {{ ($tour->tour_control == 'yes')?'selected':''}} >{{ __('Yes') }}</option>
                                <option value="no" {{ ($tour->tour_control == 'no')?'selected':''}} >{{ __('No') }}</option> 
                            </select>
                            @if ($errors->has('tour_control'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tour_control') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-5">
                            <button class="btn btn-info btn-block" id="craete_idValid">Update</button>
                        </div>
                       <!--  <div class="col-md-6">
                           <a href="{{ url('admin/users') }}"><button type="button" class="btn btn-primary btn-block">Cancel</button></a>
                        </div> -->
                    </div>
                </form>

                </div>
            </div>
            <!-- END WIDGETS -->
        </div>
    </div>

@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script>
        // CKEDITOR.replace( '.editor' );
    $(document).ready(function(){
        $('.editor_list').each(function (index) {
            var editor = $( this ).attr('data-ids');
            CKEDITOR.replace( editor );
        });
    });
   
</script>
<script type="text/javascript">
    var add_row=<?php echo $i;?>;
    function addRow()
    {
        html='';
        html+=' <div class="col-md-12" id="main_div_'+add_row+'" style="display: flex;">';
        html += '<input type="hidden" name="variation_id['+add_row+']" id="variation_id_'+add_row+'" value="">'; 
        html+='     <div class="col-md-6" id="">'; 
        html += '    <input type="text" name="variations['+add_row+']" id="variations_'+add_row+'" class="form-control"  placeholder="Variation Name"/>';  
        html += '   </div>';
        html +='    <div class="col-md-4">';
        html +='        <select type="text" name="language['+add_row+']" class="form-control" id="language_'+add_row+'">';
        html +='            <option value="english" >{{ __('English') }}</option>';
        html +='            <option value="dutch" >{{ __('Dutch') }}</option>';
        html +='            <option value="french" >{{ __('French') }}</option>'; 
        html +='        </select>';
        html +='    </div>';
        html +='    <div class="col-md-2">';
        html +='       <a href="javascript:void(0)" id="add'+add_row+'" onclick="javascript:add_new('+add_row+')" class=" btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i></i></a>';
        // html +='       <a href="javascript:void(0)" onclick="javascript:EditRow('+add_row+')"class=" btn btn-primary"><i class="fa fa-edit"></i></a>';
        // html +='       <a href="javascript:void(0)" onclick="javascript:RemoveRow('+add_row+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>'; 
        html +='    </div>';
        html +=' </div>';
        html +=' <div class="col-md-12" id="message_'+add_row+'" style="display: none;color: red;"></div>';
            
        $("#variations_div").append(html);
         add_row++;
    }
    function add_new(ids)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var tour_id = '{{ $tour->id }}';
        var variation_name = $("#variations_"+ids+"").val();
        var language = $("#language_"+ids+"").val();
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/add_variation") }}',
           data:{tour_id:tour_id, variation_name:variation_name,language:language},
           success:function(data){
            if(data.status == 'success')
            {
                $("#add"+ids+"").css("pointer-events", "none");
                $("#message").text(data.message);
                $("#message").css("display",'flex');
                html = '<span class="variation_list" id="variation_list_'+data.id+'" data-id="'+data.id+'" data-name="'+data.name+'" ></span>';
                $("#variation_data").append(html);
                updateVariations();
            }
            else
            {
                $("#message").text(data.message);
                $("#message").css("display",'flex');
            }
            
              console.log(data.message);
           }
        });
    }

    function updateVariations()
    {   
        var html= '';
        $('.variation_list').each(function (index) {
            var id      = $( this ).attr('data-id');
            var name    = $( this ).attr('data-name');
            // alert(id+'===='+name);
            html += '<option value="'+id+'" >'+name+'</option>';
        });
        $('.variation_type').html(html);
    }

    function RemoveRow(ids) 
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $("#variation_id_"+ids+"").val();
        var tour_id = '{{ $tour->id }}';
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/delete_variation") }}',
           data:{tour_id:tour_id, id:id},
           success:function(data){
                $('#variation_list_'+id+'').remove();
                $("#message").text(data.success);
                $("#message").css("display",'flex');
                updateVariations();
           }
        });
        $("#main_div_"+ids+"").remove();
    }
    function EditRow(ids) 
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $("#variation_id_"+ids+"").val();
        var tour_id = '{{ $tour->id }}';
        var variation_name = $("#variations_"+ids+"").val();
        var language = $("#language_"+ids+"").val();
        // console.log(id +"/"+tour_id+"//"+variation_name+"/"+language);
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/edit_variation") }}',
           data:{tour_id:tour_id, variation_name:variation_name,language:language,id:id},
           success:function(data){
            if(data.status == 'success')
            {
                $("#message").text(data.message);
                $("#message").css("display",'flex');
                $('#variation_list_'+id+'').attr('data-name',variation_name);
                updateVariations();
            }
            else
            {
                $("#message").text(data.message);
                $("#message").css("display",'flex');
            }
           }
        });
    }

/*Poi start*/
    var add_poi=<?php echo $p;?>;
    function AddPoi()
    {
        html= '';
        html +='        <div class="row" id="poi_div_{{$p}}">';
        html +='                <div class="col-md-12" id="main_poi_'+add_poi+'" style="display: flex;">';
        html +='                    <div class="col-md-3">';
        html +='                        <select type="text" class="variation_type" name="variation_type['+add_poi+']" id="variation_type'+add_poi+'" class="form-control" >';
        html +='          <?php  foreach ($variation_details as $key => $variation) 
                            { ?>';
        html +='                <option value="{{$variation->id}}" >{{ $variation->variation_name }}</option>';
        html +='                        <?php   } ?>';
                                    
        html +='                        </select>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">';
        html +='                        <input type="text" name="poi_name['+add_poi+']" id="poi_name_'+add_poi+'"    value="" class="form-control"  placeholder="POI (points of interest)"/>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">Location</div>';
        html +='                    <div class="col-md-3">';
        html +='           <select type="text" name="icon_type['+add_poi+']" id="icon_type_'+add_poi+'" class="form-control" >';
        html +='              <option value="icon1" title="{{ asset('images/icon1.png') }}">icon 1</option>';
        html +='              <option value="icon2" title="{{ asset('images/icon2.png') }}" >icon 2</option>'; 
        html +='              <option value="icon3" title="{{ asset('images/icon3.png') }}" >icon 3</option>'; 
        html +='              <option value="icon4" title="{{ asset('images/icon4.png') }}" >icon 4</option>'; 
        html +='           </select>';
        html +='                    </div>';
        html +='                </div>';
        html +='                <div class="col-md-12" id="main_poi_'+add_poi+'" style="display: flex;">';
        html +='                    <div class="col-md-3">';
        html +='                        <select type="text" onclick="javascript:select_content('+add_poi+')" name="content_type['+add_poi+']" id="content_type_'+add_poi+'" class="form-control" >';
        html +='                            <option value="text" >{{ __("Text") }}</option>';
        html +='                            <option value="image" >{{ __("Image") }}</option>';
        html +='                            <option value="video" >{{ __("Video") }}</option>'; 
        html +='                        </select>';
        html +='                    </div>';
        html +='                    <div class="col-md-7" id="content_'+add_poi+'">';
        html +='                        <textarea name="editor'+add_poi+'" id="editor_'+add_poi+'"></textarea>';
        html +='                    </div>';
        html +='                    <div class="col-md-2">';
        html +='                        <a href="javascript:void(0)" id="add_p'+add_poi+'" onclick="javascript:addPoi('+add_poi+')" class=" btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i></i></a>';
        // html +='                        <a href="javascript:void(0)" onclick="javascript:EditPoi('+add_poi+')" class=" btn btn-primary"><i class="fa fa-edit"></i></a>';
        // html +='                        <a href="javascript:void(0)" onclick="javascript:RemovePoi('+add_poi+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>';
        html +='                    </div>';
        html +='                </div>';
        html +='          </div><br>';

        $("#poi_div").append(html);
        CKEDITOR.replace( 'editor'+add_poi+'' );
        updateVariations();
         add_poi++;
    }

    function select_content(ids)
    {
        var val = jQuery("#content_type_"+ids+"").val();
        if(val == 'text')
        {
            html='<textarea name="editor'+ids+'" id="editor_'+ids+'"></textarea>';
        }
        else
        {
            html='<input type="file" name="pic'+ids+'" id="pic_'+ids+'" >';
        }
         $("#content_"+ids+"").html(html);
         CKEDITOR.replace( 'editor'+ids+'' );
    }

    function addPoi(ids)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var editor          = "";
        var fileName        = "";
        var tour_id         = '{{ $tour->id }}';
        var variation_id    = $("#variation_type"+ids+"").val();
        var poi_name        = $("#poi_name_"+ids+"").val();
        var icon_type       = $("#icon_type_"+ids+"").val();
        var content_type    = $("#content_type_"+ids+"").val();

        formdata = new FormData();
        formdata.append("tour_id", tour_id);
        formdata.append("variation_id", variation_id);
        formdata.append("poi_name", poi_name);
        formdata.append("icon_type", icon_type);
        formdata.append("content_type", content_type);

        if(content_type == "text")
        {
            editor = CKEDITOR.instances['editor_'+ids+''].getData();
            editor = editor.replace("</p>", "<p>");
            editor = editor.split("<p>");
            editor = editor[1];
            formdata.append("content", editor);
        }
        else
        {            
            if($('#pic_'+ids+'').prop('files').length > 0)
            {
                fileName =$('#pic_'+ids+'').prop('files')[0];
                formdata.append("image", fileName);
            }
        }
      
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/add_poi") }}',
           data:formdata,
           contentType:false,
           cache:false,
           processData:false,
           success:function(data){
            if(data.status == 'success')
            {
                $("#add_p"+ids+"").css("pointer-events", "none");
                $("#poi_message").text(data.message);
                $("#poi_message").css("display",'flex');
            }
            else
            {
                $("#poi_message").text(data.message);
                $("#poi_message").css("display",'flex');
            }
           }
        });
    }

    function EditPoi(ids)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var editor          = "";
        var fileName        = "";
        var id              = $("#poi_id_"+ids+"").val();
        var tour_id         = '{{ $tour->id }}';
        var variation_id    = $("#variation_type"+ids+"").val();
        var poi_name        = $("#poi_name_"+ids+"").val();
        var icon_type       = $("#icon_type_"+ids+"").val();
        var content_type    = $("#content_type_"+ids+"").val();

        formdata = new FormData();
        formdata.append("tour_id", tour_id);
        formdata.append("variation_id", variation_id);
        formdata.append("poi_name", poi_name);
        formdata.append("icon_type", icon_type);
        formdata.append("content_type", content_type);
        formdata.append("id", id);

        if(content_type == "text")
        {
            editor = CKEDITOR.instances['editor_'+ids+''].getData();
            editor = editor.replace("</p>", "<p>");
            editor = editor.split("<p>");
            editor = editor[1];
            formdata.append("content", editor);
        }
        else
        {            
            if($('#pic_'+ids+'').prop('files').length > 0)
            {
                fileName =$('#pic_'+ids+'').prop('files')[0];
                formdata.append("image", fileName);
            }
        }
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/edit_poi") }}',
           data:formdata,
           contentType:false,
           cache:false,
           processData:false,
           success:function(data){
            if(data.status == 'success')
            {
                $("#poi_message").text(data.message);
                $("#poi_message").css("display",'flex');
            }
            else
            {
                $("#poi_message").text(data.message);
                $("#poi_message").css("display",'flex');
            }
           }

        });
    }
    function RemovePoi(ids)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $("#poi_id_"+ids+"").val();
        var tour_id = '{{ $tour->id }}';
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/delete_poi") }}',
           data:{tour_id:tour_id, id:id},
           success:function(data){
              $("#poi_message").text(data.success);
              $("#poi_message").css("display",'flex');
           }
        });
        $("#poi_div_"+ids+"").remove();
    }
/*Poi end*/
   $(document).ready(function(){
        $("#set_password").change(function(){
            var val = $(this).val();
            if(val != "")
            {
                if(val == "constant")
                {
                    html = '<input type="text" name="password" class="form-control" value="" placeholder="Password"/>';
                }
                else if(val == "temporary")
                {
                    html = '';
                    html +='  <select type="text" name="password_type" class="form-control" id="password_type">';
                    html +='      <option value="month" >{{ __("Month") }}</option>';
                    html +='      <option value="week" >{{ __("Week")  }}</option> ';
                    html +='      <option value="day" >{{ __("Day")  }}</option> ';
                    // html +='      <option value="timezone" >{{ __("TimeZone")  }}</option> ';
                    html +='  </select>';
                    html +=   '<input type="text" name="password" class="form-control" value="" placeholder="Password"/>';
                }
                $("#password_div").html(html);
            }
            else
            {
                $("#password_div").html('');
            }
        });
    });
</script>
@endsection