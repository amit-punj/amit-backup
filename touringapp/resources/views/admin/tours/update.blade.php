@extends('admin.layouts.main')

@section('content')
<style type="text/css">
    div#cke_1_contents {
        height: 100px !important;
    }
    .mb-15 {
        margin-bottom: 15px;
        margin-right: 10px;
    }
</style>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                        <label for="variations" class="col-md-2">Variations List</label> 
                        <label><a href='{{ url("admin/tours/{$tour->id}/add_variation") }}'>Add new variation</a></label>
                        <div class="col-md-12" id="main_div" style="display: flex; margin-bottom: 5px;">
                            @if(count($variation_details))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>#</th>
                                            <th>Variation Name</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($variation_details as $variation)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$variation->variation_name}}</td>
                                                    <td>{{$variation->created_at}}</td>
                                                    <td>
                                                        <a href='{{ url("admin/tours/{$variation->id}/edit_variation") }}' title="Edit" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                                        <a href='{{ url("admin/tours/{$variation->id}/delete_variation") }}' onclick="return confirm('Are you sure to delete this Variation?')" title="Delete" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No Variation found here !</p>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group" id="poi_div">
                        <label for="poi" class="col-md-2">POI List</label>
                         @if(count($variation_details))
                            <label><a href='{{ url("admin/tours/{$tour->id}/add_poi") }}'>Add new poi</a></label>
                         @endif
                        <div class="col-md-12" id="main_div" style="display: flex; margin-bottom: 5px;">
                            <?php $p=0; ?>
                            @if(count($poi_details))
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th>#</th>
                                        <th>Poi Name</th>
                                        <th>Poi Type</th>
                                        <th>Make Default</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        @foreach($poi_details as $poi)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$poi->poi_name}}</td>
                                                <td>{{$poi->content_type}}</td>
                                                <td>
                                                    <label class="switch">
                                                      <input class="status" data-id="{{ $poi->id }}" type="checkbox" <?php if($poi->default_poi == 1) echo 'checked'; ?> >
                                                      <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>{{$poi->created_at}}</td>
                                                <td>
                                                    <a href='{{ url("admin/tours/{$poi->id}/edit_poi") }}' title="Edit" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href='{{ url("admin/tours/{$poi->id}/delete_poi") }}' onclick="return confirm('Are you sure to delete this Poi?')" title="Delete" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            @else
                                <p>No Poi found here !</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password"  class="form-control mb-15" id="set_password">
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
                        <?php $key = 0; ?>
                        <?php if($tour->set_password == 'constant') { ?>
                            @if(count($password_details))
                                 @foreach($password_details as $k => $password)
                                     <input type="hidden" name="p_id[{{$key}}]" id="p_id_{{$key}}" value="{{$password->id}}">   
                                    <input type="text" id="password_{{$key}}" data-id="{{$key}}" data-pid="{{ $password->id }}"  name="password[{{$key}}]" class="form-control mb-15 password" value="{{ $password->password}}" placeholder="Password"/>
                                    <?php $key++; ?>
                                 @endforeach
                            @endif
                        <?php } elseif ($tour->set_password == 'temporary') { ?>
                            <select type="text" name="password_type" class="form-control mb-15" id="password_type">
                                <option value="month" {{ ($tour->password_type == 'month')?'selected':''}}>{{ __("Month") }}</option>';
                                <option value="week" {{ ($tour->password_type == 'week')?'selected':''}}>{{ __("Week")  }}</option> ';
                                <option value="day" {{ ($tour->password_type == 'day')?'selected':''}}>{{ __("Day")  }}</option> ';
                                <!-- <option value="timezone" {{ ($tour->password_type == 'timezone')?'selected':''}}>{{ __("TimeZone")  }}</option> '; -->
                            </select>
                            @if(count($password_details))
                                <button type="button" onclick="javascript:addRow()" class="btn btn-primary btn-bg mb-15">Add New <i class="fa fa-plus" style="color:black"></i></button>
                                    @foreach($password_details as $k => $password)
                                        @if($tour->current_password == $password->password )
                                            <div class="col-md-10"  id="pass_div_{{$key}}" style="display:flex; ">
                                                <input type="hidden" name="p_id[{{$key}}]" id="p_id_{{$key}}" value="{{$password->id}}">
                                                <input type="text" style="border: 3px solid green;" id="password_{{$key}}" data-id="{{$key}}" data-pid="{{ $password->id }}" readonly="" name="password[{{$key}}]" class="form-control mb-15 password" value="{{ $password->password}}" placeholder="Password"/>
                                            </div>
                                        @else
                                            <div class="col-md-10"  id="pass_div_{{$key}}" style="display:flex;">
                                                <input type="hidden" name="p_id[{{$key}}]" id="p_id_{{$key}}" value="{{$password->id}}">
                                                <input type="text" id="password_{{$key}}" data-id="{{$key}}" data-pid="{{ $password->id }}" name="password[{{$key}}]" class="form-control mb-15 password" value="{{ $password->password}}" placeholder="Password"/>
                                                <a href="javascript:void(0)" style="height: 40px;" onclick="javascript:Remove_Row({{$key}})" class=" btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        @endif
                                         <?php $key++; ?>
                                    @endforeach
                            @endif
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
<script type="text/javascript">
var add_row =  '{{ $key }}';
var passwords = [];

    var image1 = "'{{ asset('images/d1.png') }}'";
    var image2 = "'{{ asset('images/d2.png') }}'";
    var image3 = "'{{ asset('images/d3.png') }}'";
    var image4 = "'{{ asset('images/d4.png') }}'";

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

   $(document).ready(function(){
         $("#set_password").change(function(){
        var val = $(this).val();
        if(val != "")
        {
            if(val == "constant")
            {
                var add_row1 = 0;
                // html = '<input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>';
                html =   '<input type="text" id="password_'+add_row1+'" data-id="'+add_row1+'" name="password['+add_row1+']" class="form-control mb-15 password" value="" placeholder="Password"/>';

                $("#password_div").html(html);
                $("#password_div").show();
                add_row1++;
            }
            else if(val == "temporary")
            {
                // add_row = 0;
                html = '';
                html +='  <select type="text" name="password_type" class="form-control mb-15" id="password_type">';
                html +='      <option value="month" >{{ __("Month") }}</option>';
                html +='      <option value="week" >{{ __("Week")  }}</option> ';
                html +='      <option value="day" >{{ __("Day")  }}</option> ';
                // html +='      <option value="timezone" >{{ __("TimeZone")  }}</option> ';
                html +='  </select>';
                html +='<button type="button" onclick="javascript:addRow()" class="btn btn-primary btn-bg mb-15">Add New <i class="fa fa-plus" style="color:black"></i></button>';
                html += '<div class="col-md-10"  id="pass_div_'+add_row+'" style="display:flex;">';
                html +=   '<input type="text" id="password_'+add_row+'" data-id="'+add_row+'" name="password['+add_row+']" class="form-control mb-15 password" value="" placeholder="Password"/>';
                html +='       <a href="javascript:void(0)" style="height: 40px;" onclick="javascript:RemoveRow('+add_row+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>'; 
                html +='</div>';
                $("#password_div").html(html);
                $("#password_div").show();
                add_row++;
            }
        }
        else
        {
            $("#password_div").css('display', 'none');
        }
    }); 
    });
</script>

<script type="text/javascript">
    $('#update_form').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
        
        //Add validation rule for dynamically generated email fields
        $("#top").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Lattitude",
                      }
                });
        $("#right").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Longitude",
                      }
                });
        $("#bottom").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Lattitude",
                      }
                });
        $("#left").rules("add", 
                {
                    required: true,
                    messages: {
                        required: "Please add Longitude",
                      }
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
        $('.password').each(function(e) {
            var ids = $(this).data('id');
                $( this ).rules("add", 
                    {
                        required: true,
                        remote: {
                            url: '{{ url("admin/tours/unique_password") }}',
                            type: "post",
                            data: {
                                    "_token": "{{ csrf_token() }}",
                                    password: function(  ) {
                                        return $( '#password_'+ids ).val();
                                    },
                                    'type' : 'update',
                                    'tour_id': "{{ $tour->id }}"
                                }
                        },
                        messages: {
                            required: "Password Field is required",
                            remote : "This password is already in use, please choose another one.",
                          }
                    });
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
function addRow()
{
    // add_row = 0;
    html='';
    html = '<div class="col-md-10" id="pass_div_'+add_row+'" style="display:flex;">';
    html += '<input type="text" id="password_'+add_row+'" data-id="'+add_row+'" name="password['+add_row+']" class="form-control password mb-15" value="" placeholder="Password"/>';
    html +='       <a href="javascript:void(0)" style="height: 40px;" onclick="javascript:RemoveRow('+add_row+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>';   
    html +='</div>';
    $("#password_div").append(html);
     add_row++;
}
function RemoveRow(ids) 
{
    $('#pass_div_'+ids+'').remove();
}
function Remove_Row(ids) 
{
    var id = $('#password_'+ids+'').data('pid');
        // $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
            var tour_id = '{{ $tour->id }}';
            $.ajax({
               type:'POST',
               url:'{{ url("admin/tours/delete_password") }}',
               data:{
                    "_token": "{{ csrf_token() }}",
                    tour_id:tour_id,
                    id:id
                },
               success:function(data){
                    console.log(data);
                    $('#pass_div_'+ids+'').remove();
               }
            });
}

$(document).on('blur','.password',function(){
    var val =  $(this).val();
    passwords.push([val]);
    console.log(passwords);
});

</script>

<script type="text/javascript">
$(document).ready(function()
  {    
      $(".status").click(function(){
      var id = $(this); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var status = 0;
        var ids = $(this).data('id');
        var tour_id = '{{$tour->id}}';
        if ($(this).prop('checked') ) 
        {
            status = 1;
        }
            $.ajax(
            {
                url: "{{url('admin/tours/default_poi')}}",
                type: "post",
                data: {'id':ids,'tour_id':tour_id,'status':status },
                success : function(data) { 
                  var myJSON = JSON.parse(data); 
                  console.log(myJSON);                
                    if(myJSON.response > "0")
                    {
                        $(".status").prop("checked", false);
                        if(status == 1){
                            $(id).prop("checked", true);
                        }
                      // $("#btnsub").prop('disabled', true);
                      // $('#search_eroor').text("You have already Active Search bar, Please InActive first!");
                    }                     
                },
                error : function(data) {
                }
            });
        
      });
  });
</script>
@endsection