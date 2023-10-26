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
                    <h6 class="m-0 font-weight-bold ">
                        Update Tour
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form action='{{ url("admin/tours/{$tour->id}/update") }}'   class="form-horizontal" method="post" role="form" id="update_form" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tour_name" class="col-md-2">Tour Name</label>
                        <div class="col-md-10">
                            <input type="text" name="tour_name" id="tour_name" class="form-control" value="{{ old('tour_name',$tour->tour_name ) }}"  placeholder="Tour Name"/>
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
                    <!-- <div class="form-group">
                        <label for="center_lattitude" class="col-md-2">Center Lattitude</label>
                        <div class="col-md-10">
                            <input type="text" id="center_lattitude" value="{{ old('center_lattitude',$tour->center_lattitude ) }}" name="center_lattitude" class="form-control"  placeholder="Center Lattitude"/>
                            @if ($errors->has('center_lattitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('center_lattitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="center_longitude" class="col-md-2">Center Longitude</label>
                        <div class="col-md-10">
                            <input type="text" id="center_longitude" value="{{ old('center_longitude',$tour->center_longitude ) }}" name="center_longitude" class="form-control"  placeholder="Center Longitude"/>
                            @if ($errors->has('center_longitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('center_longitude') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="top" class="col-md-2">Top</label>
                        <div class="col-md-10">
                            <input type="text" id="top" value="{{ old('top',$tour->top ) }}" name="top" class="form-control"  placeholder="Top"/>
                            @if ($errors->has('top'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('top') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="right" class="col-md-2">Right</label>
                        <div class="col-md-10">
                            <input type="text" id="right"  value="{{ old('right',$tour->right ) }}" name="right" class="form-control"  placeholder="Right"/>
                            @if ($errors->has('right'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('right') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bottom" class="col-md-2">Bottom</label>
                        <div class="col-md-10">
                            <input type="text" id="bottom" value="{{ old('bottom',$tour->bottom ) }}" name="bottom" class="form-control"  placeholder="Bottom"/>
                            @if ($errors->has('bottom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bottom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="left" class="col-md-2">Left</label>
                        <div class="col-md-10">
                            <input type="text" id="left" value="{{ old('left',$tour->left ) }}" name="left" class="form-control"  placeholder="Left"/>
                            @if ($errors->has('left'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('left') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="minimum_zoom" class="col-md-2">Minimum Zoom</label>
                        <div class="col-md-10">
                            <select type="text" name="minimum_zoom" id="minimum_zoom" class="form-control" >
                                <option value="13" {{ ($tour->minimum_zoom == 13 )?'selected':''}} >13</option>
                                <option value="14" {{ ($tour->minimum_zoom == 14 )?'selected':''}} >14</option>
                                <option value="15" {{ ($tour->minimum_zoom == 15 )?'selected':''}} >15</option>
                                <option value="16" {{ ($tour->minimum_zoom == 16 )?'selected':''}} >16</option>
                            </select>
                            @if ($errors->has('minimum_zoom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('minimum_zoom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="maximum_zoom" class="col-md-2">Maximum Zoom</label>
                        <div class="col-md-10">
                            <select type="text" name="maximum_zoom" id="maximum_zoom" class="form-control" >
                                <option value="13" {{ ($tour->maximum_zoom == 13 )?'selected':''}} >13</option>
                                <option value="14" {{ ($tour->maximum_zoom == 14 )?'selected':''}} >14</option>
                                <option value="15" {{ ($tour->maximum_zoom == 15 )?'selected':''}} >15</option>
                                <option value="16" {{ ($tour->maximum_zoom == 16 )?'selected':''}} >16</option>
                            </select>
                            @if ($errors->has('maximum_zoom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('maximum_zoom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group" id="variations_div">
                        <label for="variations" class="col-md-2">Variations <button type="button" onclick="javascript:addRow()" class="btn btn-primary btn-bg">Add New <i class="fa fa-plus" style="color:black"></i></button></label> 
                        <?php $i=0; ?>
                        <?php  
                    if(count($variation_details) > 0)
                    {
                        foreach ($variation_details as $key => $variation) 
                        { //echo "<pre>"; print_r($variation->id);
                    ?>
                        <div class="col-md-12" id="main_div_{{$i}}" style="display: flex; margin-bottom: 5px;">
                            <input type="hidden" name="variation_id[{{$i}}]" id="variation_id_{{$i}}" value="{{$variation->id}}">
                            <div class="col-md-6" id="">
                                <input type="text"  name="variations[{{ $i }}]" value="{{ old('variations',$variation->variation_name ) }}" id="variations_{{ $i }}" class="form-control variations_name"  placeholder="Variation Name"/>
                            </div>
                            <!-- <div class="col-md-4">
                                <select type="text" name="language[{{ $i }}]" id="language_{{ $i }}" class="form-control" >
                                    <option value="english" {{ ($variation->language == 'english')?'selected':''}} >{{ __('English') }}</option>
                                    <option value="dutch" {{ ($variation->language == 'dutch')?'selected':''}} >{{ __('Dutch') }}</option> 
                                    <option value="french" {{ ($variation->language == 'french')?'selected':''}} >{{ __('French') }}</option> 
                                </select>
                            </div> -->
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
                        <label for="poi" class="col-md-2">POI's <button type="button" onclick="javascript:AddPoi()" class="btn btn-primary btn-bg">Add New <i class="fa fa-plus" style="color:black"></i></button></label>
                        <input type="hidden" name="location_line_id" id="location_line_id">
                        <?php $p=0; ?>
                     <?php  
                    if(count($poi_details) > 0)
                    {   
                        foreach ($poi_details as $key => $poi) 
                        { //echo "<pre>"; print_r($poi->content);
                    ?>
                    <div class="row" id="poi_div_{{$p}}">
                        <div class="col-md-12" id="main_poi_{{$p}}" style="display: flex; margin-bottom: 5px;">
                            <input type="hidden" name="poi_id[{{$p}}]" id="poi_id_{{$p}}" value="{{$poi->id}}">
                            <div class="col-md-3">
                                <select type="text" name="variation_type[{{ $p }}]" id="variation_type{{ $p }}" class="form-control variation_type" >
                                <?php  foreach ($variation_details as $key => $variation) 
                                        { ?>
                                            <option value="{{$variation->id}}" {{ ($poi->variation_id == $variation->id)?'selected':''}}>{{ $variation->variation_name }}</option>
                                <?php   } ?>
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="poi_name[{{ $p}}]" id="poi_name_{{ $p}}" value="{{ old('poi_name',$poi->poi_name ) }}" class="form-control poi_name"  placeholder="POI's (points of interest)"/>
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" name="mapList[{{ $p }}]" class="mapList" value="{{$p}}">
                                <input type="hidden" name="lat[{{ $p }}]" id="lat_{{$p}}" value="{{ old('lat',$poi->lat ) }}">
                                <input type="hidden" name="long[{{ $p }}]" id="long_{{$p}}" value="{{ old('long',$poi->long ) }}">
                                <button type="button" data-location="{{ $p }}" class="openModel btn btn-info"  >Update Location</button>
                            </div>
                            <div class="col-md-3">
                                <select type="text" name="icon_type[{{ $p }}]" id="icon_type_{{ $p }}" class="form-control icon_type" >
                                    <option value="icon1" {{ ($poi->icon_type == 'icon1')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d1.png') }}');" >Icon 1</option>
                                    <option value="icon2" {{ ($poi->icon_type == 'icon2')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d2.png') }}');" >Icon 2</option> 
                                    <option value="icon3" {{ ($poi->icon_type == 'icon3')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d3.png') }}');" >Icon 3</option> 
                                    <option value="icon4" {{ ($poi->icon_type == 'icon4')?'selected':'' }} data-class="avatar" data-style= "background-image: url('{{ asset('images/d4.png') }}');" >Icon 4</option> 
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
                                    <textarea class="editor" name="editor{{ $p }}" id="editor_{{ $p }}"> 
                                    {{ ($poi->content) ? $poi->content : '' }}
                                    </textarea>
                            <?php    }
                                elseif($poi->content_type == 'image')
                                { ?>
                                    <img src="{{ asset('images/'.$poi->image) }}" width="50" height="50" alt="">
                                    <input type="file" name="pic{{ $p }}" id="pic_{{$p}}" >
                            <?php }
                            else { ?>
                                <video width="250" height="200" controls>
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
                    <!-- Modal -->
                      <div class="modal fade" id="myModal_{{ $p }}" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 900px;">
                                <div id="map_{{ $p }}" style="height: 450px; width: 900px;"></div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                      </div>
                        <?php $p++; 
                        }
                    }?>
                    </div>
                    <div class="col-md-12" id="poi_message" style="display: none;color: red;"></div>

                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password"  class="form-control" id="set_password">
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
                            <input type="text" name="password" id="password" class="form-control" value="{{ $tour->current_password}}" placeholder="Password"/>
                        <?php } elseif ($tour->set_password == 'temporary') { ?>
                            <select type="text" name="password_type" class="form-control" id="password_type">
                                <option value="month" {{ ($tour->password_type == 'month')?'selected':''}}>{{ __("Month") }}</option>';
                                <option value="week" {{ ($tour->password_type == 'week')?'selected':''}}>{{ __("Week")  }}</option> ';
                                <option value="day" {{ ($tour->password_type == 'day')?'selected':''}}>{{ __("Day")  }}</option> ';
                                <!-- <option value="timezone" {{ ($tour->password_type == 'timezone')?'selected':''}}>{{ __("TimeZone")  }}</option> '; -->
                            </select>
                            <input type="text" name="password" id="password" class="form-control" value="{{ $tour->current_password}}" placeholder="Password"/>
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
                            <button class="btn btn-info btn-block" type="submit" id="craete_idValid">Update</button>
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
var north;
var south;
var east;
var west;
var minimum_zoom;
var maximum_zoom; 
var center_lattitude;   
var center_longitude;  
        // CKEDITOR.replace( '.editor' );
    $(document).ready(function(){
        $('.editor_list').each(function (index) {
            var editor = $( this ).attr('data-ids');
            CKEDITOR.replace( editor );
        });

        $('.mapList').each(function (index) {
            var ss = $( this ).val();
            add_map(ss);
        });
    });
   
</script>
<script type="text/javascript">
    var add_row=<?php echo $i;?>;
    function addRow()
    {
        html='';
        html+=' <div class="col-md-12" id="main_div_'+add_row+'" style="display: flex; margin-bottom: 5px; ">';
        html += '<input type="hidden" name="variation_id['+add_row+']" id="variation_id_'+add_row+'" value="">'; 
        html+='     <div class="col-md-6" id="">'; 
        html += '    <input type="text" name="variations['+add_row+']" id="variations_'+add_row+'" class="form-control variations_name"  placeholder="Variation Name"/>';  
        html += '   </div>';
        // html +='    <div class="col-md-4">';
        // html +='        <select type="text" name="language['+add_row+']" class="form-control" id="language_'+add_row+'">';
        // html +='            <option value="english" >{{ __('English') }}</option>';
        // html +='            <option value="dutch" >{{ __('Dutch') }}</option>';
        // html +='            <option value="french" >{{ __('French') }}</option>'; 
        // html +='        </select>';
        // html +='    </div>';
        html +='    <div class="col-md-2">';
        html +='       <a href="javascript:void(0)" id="add'+add_row+'" onclick="javascript:add_new('+add_row+')" class=" btn btn-success"><i class="fa fa-save" aria-hidden="true"></i></a>';
        // html +='       <a href="javascript:void(0)" onclick="javascript:EditRow('+add_row+')"class=" btn btn-primary"><i class="fa fa-edit"></i></a>';
        html +='       <a href="javascript:void(0)" onclick="javascript:Remove_Row('+add_row+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>'; 
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
        // var language = $("#language_"+ids+"").val();
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/add_variation") }}',
           // data:{tour_id:tour_id, variation_name:variation_name,language:language},
           data:{tour_id:tour_id, variation_name:variation_name},
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
    // Remove extra variation before saving
    function Remove_Row(ids) 
    {
        $("#main_div_"+ids+"").remove();
        $("#message").text('Delete Successfully');
        $("#message").css("display",'flex');
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
        // var language = $("#language_"+ids+"").val();
        $.ajax({
           type:'POST',
           url:'{{ url("admin/tours/edit_variation") }}',
           // data:{tour_id:tour_id, variation_name:variation_name,language:language,id:id},
           data:{tour_id:tour_id, variation_name:variation_name,id:id},
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
    var image1 = "'{{ asset('images/d1.png') }}'";
    var image2 = "'{{ asset('images/d2.png') }}'";
    var image3 = "'{{ asset('images/d3.png') }}'";
    var image4 = "'{{ asset('images/d4.png') }}'";
    var add_poi=<?php echo $p;?>;
    function AddPoi()
    {
        north = $('#top').val() ;
        south = $('#bottom').val() ;
        east =  $('#right').val();
        west =  $('#left').val();   

        // center_lattitude =  $('#center_lattitude').val();   
        // center_longitude =  $('#center_longitude').val();   
        if(north === "" || south === "" || east === "" || west === ""  )
        {
            $("#poi_message").text("Please add Top, Right, Bottom and Left first");
            $("#poi_message").css("display",'flex');
            return false;
        }
        else
        {
            $("#poi_message").text('');
            $("#poi_message").css("display",'none');
        }

        html= '';
        html +='        <div class="row" id="poi_div_'+add_poi+'">';
        html +='                <div class="col-md-12" id="main_poi_'+add_poi+'" style="display: flex; margin-bottom: 5px;">';
        html +='                    <div class="col-md-3">';
        html +='                        <select type="text"  name="variation_type['+add_poi+']" id="variation_type'+add_poi+'" class="form-control variation_type" >';
        html +='          <?php  foreach ($variation_details as $key => $variation) 
                            { ?>';
        html +='                <option value="{{$variation->id}}" >{{ $variation->variation_name }}</option>';
        html +='                        <?php   } ?>';
                                    
        html +='                        </select>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">';
        html +='                        <input type="text" name="poi_name['+add_poi+']" id="poi_name_'+add_poi+'"    value="" class="form-control poi_name"  placeholder="POI (points of interest)"/>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">';
        html +='                            <input type="hidden" name="lat['+add_poi+']" id="lat_'+add_poi+'"                               value="">';
        html +='                            <input type="hidden" name="long['+add_poi+']" id="long_'+add_poi+'"                                 value="">';
        html +='                            <button type="button" data-location="'+add_poi+'"                               class="openModel btn btn-info"  >Update Location</button>';
        html +='                    </div>';
        html +='                    <div class="col-md-3">';
        html +='           <select type="text" name="icon_type['+add_poi+']" id="icon_type_'+add_poi+'" class="form-control icon_type" >';
        html +='              <option value="icon1" data-class="avatar" data-style= "background-image: url('+image1+');">icon 1</option>';
        html +='              <option value="icon2" data-class="avatar" data-style= "background-image: url('+image2+');" >icon 2</option>'; 
        html +='              <option value="icon3" data-class="avatar" data-style= "background-image: url('+image3+');" >icon 3</option>'; 
        html +='              <option value="icon4" data-class="avatar" data-style= "background-image: url('+image4+');" >icon 4</option>'; 
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
        html +='                        <a href="javascript:void(0)" id="add_p'+add_poi+'" onclick="javascript:add_Poi('+add_poi+')" class=" btn btn-success"><i class="fa fa-save" aria-hidden="true"></i></i></a>';
        // html +='                        <a href="javascript:void(0)" onclick="javascript:EditPoi('+add_poi+')" class=" btn btn-primary"><i class="fa fa-edit"></i></a>';
        html +='                        <a href="javascript:void(0)" onclick="javascript:Remove_Poi('+add_poi+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>';
        html +='                    </div>';
        html +='                </div>';
        html +='          </div><br>';



        html +='<div class="modal fade" id="myModal_'+add_poi+'" role="dialog">';
        html +='    <div class="modal-dialog">';
        html +='        <div class="modal-content" style="width: 900px;">';
        html +='            <div id="map_'+add_poi+'" style="height: 450px; width: 900px;"></div>';
        html +='            <div class="modal-footer">';
        html +='              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        html +='            </div>';
        html +='        </div>';
        html +='    </div>';
        html +='</div>';

        $("#poi_div").append(html);

        CKEDITOR.replace( 'editor'+add_poi+'' );
        updateVariations();
        var ss = add_poi;
        setTimeout(function()
        {
            add_map(ss);
        },300);
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
            html='<input type="file" onchange="javascript:image_upload('+ids+')" name="pic'+ids+'" id="pic_'+ids+'" >';
        }
         $("#content_"+ids+"").html(html);
         CKEDITOR.replace( 'editor'+ids+'' );
    }
    function image_upload(ids)
    {
        var content_type    = $("#content_type_"+ids+"").val();
        var files = $('#pic_'+ids+'').prop('files')[0]
        var error = '';
        var name = files.name;
        var extension = name.split('.').pop().toLowerCase();
        if(content_type == "image")
        {
            var array = ['png'];
        }
        else if(content_type == "video")
        {
            var array = ['mp4'];
        }

        if(jQuery.inArray(extension, array) == -1)
        {
            $('#poi_message').text('Not support this format.Only support '+array+'');
            $("#poi_message").css("display",'flex');
        }
        else
        {   
            $("#poi_message").css("display",'none');
        }
    }

    function add_Poi(ids)
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
        var lat             = $("#lat_"+ids+"").val();
        var long            = $("#long_"+ids+"").val();

        formdata = new FormData();
        formdata.append("tour_id", tour_id);
        formdata.append("variation_id", variation_id);
        formdata.append("poi_name", poi_name);
        formdata.append("icon_type", icon_type);
        formdata.append("content_type", content_type);
        formdata.append("lat", lat);
        formdata.append("long", long);

        if(content_type == "text")
        {
            editor = CKEDITOR.instances['editor_'+ids+''].getData();
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
        var lat             = $("#lat_"+ids+"").val();
        var long            = $("#long_"+ids+"").val();

        formdata = new FormData();
        formdata.append("tour_id", tour_id);
        formdata.append("variation_id", variation_id);
        formdata.append("poi_name", poi_name);
        formdata.append("icon_type", icon_type);
        formdata.append("content_type", content_type);
        formdata.append("id", id);
        formdata.append("lat", lat);
        formdata.append("long", long);

        if(content_type == "text")
        {
            editor = CKEDITOR.instances['editor_'+ids+''].getData();
            formdata.append("content", editor);
        }
        else
        {            
            if($('#pic_'+ids+'').prop('files').length > 0)
            {
                fileName =$('#pic_'+ids+'').prop('files')[0];
                formdata.append("image", fileName);
            }
            else
            {
                formdata.append("image", '');
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
    // remove extra poi before saving 
    function Remove_Poi(ids)
    {
        $("#poi_div_"+ids+"").remove();
        $("#poi_message").text('Delete Successfully');
        $("#poi_message").css("display",'flex');
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
                    html = '<input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>';
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
                    html +=   '<input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>';
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

<script type="text/javascript">
    $('#update_form').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
        $('.variations_name').each(function() {
            
            $(this).rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Variation Name is required",
                    }
                });
        });
        //Add validation rule for dynamically generated email fields
        $('.poi_name').each(function() {
            $(this).rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Poi Name is required",
                      }
                });
        });
        $('.variation_type').each(function() {
            $(this).rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Add atleast 1 variation",
                      }
                });
        });
        $("#tour_name").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Tour Name is required",
                      }
                });
        $("#set_password").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Set Login password first",
                      }
                });
        $("#password").rules("add", 
                {
                    required: true,
                    remote: {
                        url: '{{ url("admin/tours/unique_password") }}',
                        type: "post",
                        data: {
                                "_token": "{{ csrf_token() }}",
                                password: function() {
                                    return $( "#password" ).val();
                                },
                                'type' : 'update',
                                'tour_id': "{{ $tour->id }}"
                            }
                    },
                    messages: {
                        required: "Password Field is required",
                        remote : "This password is already in use, please choose another one."
                      }
                });
    });
    $("#update_form").validate();
</script>

<script>
  $( function() {
        $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
          _renderItem: function( ul, item ) {
            var li = $( "<li>" ),
              wrapper = $( "<div>", { text: item.label } );
     
            if ( item.disabled ) {
              li.addClass( "ui-state-disabled" );
            }
     
            $( "<span>", {
              style: item.element.attr( "data-style" ),
              "class": "ui-icon " + item.element.attr( "data-class" )
            })
              .appendTo( wrapper );
     
            return li.append( wrapper ).appendTo( ul );
          }
        });

     
        $( ".icon_type" )
          .iconselectmenu()
          .iconselectmenu( "menuWidget")
            .addClass( "ui-menu-icons avatar" );
    });
    function add_image()
      {
            $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
              _renderItem: function( ul, item ) {
                var li = $( "<li>" ),
                  wrapper = $( "<div>", { text: item.label } );
         
                if ( item.disabled ) {
                  li.addClass( "ui-state-disabled" );
                }
         
                $( "<span>", {
                  style: item.element.attr( "data-style" ),
                  "class": "ui-icon " + item.element.attr( "data-class" )
                })
                  .appendTo( wrapper );
         
                return li.append( wrapper ).appendTo( ul );
              }
            });

         
            $( ".icon_type" )
              .iconselectmenu()
              .iconselectmenu( "menuWidget")
                .addClass( "ui-menu-icons avatar" );
      }
  </script>

<script type="text/javascript">
    $(document).on('click','.openModel',function(){
        $('#location_line_id').val($(this).data('location'));
        $('#myModal_'+$(this).data('location')).modal('toggle');
    });

function add_map(tt)
{
    var north = $('#top').val() ;
    var south = $('#bottom').val() ;
    var east =  $('#right').val();
    var west =  $('#left').val();   

    if(north > south){
        center_lattitude = north - south;
        center_lattitude = center_lattitude / 2;
        center_lattitude = parseFloat(parseFloat(center_lattitude) + parseFloat(south));
        center_lattitude = center_lattitude.toFixed(6);
    }
    else{
        center_lattitude = south - north;
        center_lattitude = center_lattitude / 2;
        center_lattitude = parseFloat(parseFloat(center_lattitude) + parseFloat(north));
        center_lattitude = center_lattitude.toFixed(6);
    }

    if(east > west)
    {
        center_longitude = east - west;
        center_longitude = center_longitude / 2;
        center_longitude = parseFloat(parseFloat(center_longitude) + parseFloat(west));
        center_longitude = center_longitude.toFixed(6);
    }
    else
    {
        center_longitude = west - east;
        center_longitude = center_longitude / 2;
        center_longitude = parseFloat(parseFloat(center_longitude) + parseFloat(east));
        center_longitude = center_longitude.toFixed(6);
    }
    // center_lattitude =  $('#center_lattitude').val();   
    // center_longitude =  $('#center_longitude').val();   
    var minimum_zoom = $('#minimum_zoom').val();
    var maximum_zoom = $('#maximum_zoom').val();

    var getMarkerUniqueId= function(lat, lng) {
        return lat + '_' + lng;
    };

    var getLatLng = function(lat, lng) {
        return new google.maps.LatLng(lat, lng);
    };

    var zoom_level = {
        minZoom: parseFloat(minimum_zoom), 
        maxZoom: parseFloat(maximum_zoom),
    }

    var center_latLong = {
        lat: parseFloat(center_lattitude), 
        lng: parseFloat(center_longitude),
    };
 console.log(center_latLong);
    var boundries = {
        north: parseFloat(north) ,
        south: parseFloat(south) ,
        west: parseFloat(west) ,
        east: parseFloat(east) ,
      };

    var markers = {};

    var infowindow;
    var map;
    var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
    var purple_icon =  'http://maps.google.com/mapfiles/ms/icons/purple-dot.png' ;
    var locations = "";
    var myOptions = {
        zoom: 13,
        // center: {lat: 51.1956, lng: 4.4188},
        center: center_latLong,
        restriction: {
            latLngBounds: boundries,
            strictBounds: false,
          },
        mapTypeId: 'roadmap'
    };
    map = new google.maps.Map(document.getElementById('map_'+tt), myOptions);
    map.setOptions(zoom_level);

    var addMarker = google.maps.event.addListener(map, 'click', function(e) {
        var location_line_id = $('#location_line_id').val();
        // alert(location_line_id);
        var lat = e.latLng.lat(); // lat of clicked point
        var lng = e.latLng.lng(); // lng of clicked point
        alert(lat+"/"+lng);
        $("#lat_"+location_line_id+"").val(lat);
        $("#long_"+location_line_id+"").val(lng);
        var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
        var marker = new google.maps.Marker({
            position: getLatLng(lat, lng),
            map: map,
            animation: google.maps.Animation.DROP,
            id: 'marker_' + markerId,
            html: "    <div id='info_"+markerId+"'>\n" +
            "        <table class=\"map1\">\n" +
            "            <tr>\n" +
            "                <td><a>Description:</a></td>\n" +
            "                <td><textarea  id='manual_description' placeholder='Description'></textarea></td></tr>\n" +
            "            <tr><td></td><td><input type='button' value='Save' onclick='saveData("+lat+","+lng+")'/></td></tr>\n" +
            "        </table>\n" +
            "    </div>"
        });
        markers[markerId] = marker; // cache marker in markers object
        // bindMarkerEvents(marker); // bind right click event to marker
        // bindMarkerinfo(marker); // bind infowindow with click event to marker
    });

    var bindMarkerinfo = function(marker) {
            google.maps.event.addListener(marker, "click", function (point) {
                var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                var marker = markers[markerId]; // find marker
                infowindow = new google.maps.InfoWindow();
                infowindow.setContent(marker.html);
                infowindow.open(map, marker);
                // removeMarker(marker, markerId); // remove it
            });
        };

        /**
         * Binds right click event to given marker and invokes a callback function that will remove the marker from map.
         * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
         */
        var bindMarkerEvents = function(marker) {
            google.maps.event.addListener(marker, "rightclick", function (point) {
                var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
                var marker = markers[markerId]; // find marker
                removeMarker(marker, markerId); // remove it
            });
        };
        var removeMarker = function(marker, markerId) {
            marker.setMap(null); // set markers setMap to null to remove it from map
            delete markers[markerId]; // delete marker instance from markers object
        };

        var i ; var confirmed = 0;
        console.log(locations);
        // for (i = 0; i < locations.length; i++) {
            var lat = $('#lat_'+tt).val();
            var long = $('#long_'+tt).val();
            // alert(lat+"//"+long);
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, long),
                map: map,
                // icon :   locations[i][4] === '1' ?  red_icon  : purple_icon,
                html: "<div>\n" +
                "<table class=\"map1\">\n" +
                "<tr>\n" +
                "<td><a>Description:</a></td>\n" +
                "<td><textarea disabled id='manual_description' placeholder='Description'>"+confirmed+"</textarea></td></tr>\n" +
                "</table>\n" +
                "</div>"
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow = new google.maps.InfoWindow();
                    // confirmed =  confirmed === '1' ?  'checked'  :  0;
                    // $("#confirmed").prop(confirmed,locations[i][4]);
                    // $("#id").val(locations[i][0]);
                    // $("#description").val(locations[i][3]);
                    $("#form").show();
                    infowindow.setContent(marker.html);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        // }
}

</script>


@endsection