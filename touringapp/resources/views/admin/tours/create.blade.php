@extends('admin.layouts.main')

@section('content')
<style type="text/css">
    .mb-15 {
        margin-bottom: 15px;
        margin-right: 10px;
    }
</style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Create Tour
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form  action="{{ url('admin/tours/create') }}" class="form-horizontal" method="post" role="form" id="create_formmcc" enctype="multipart/form-data" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tour_name" class="col-md-2">Tour Name</label>
                        <div class="col-md-10">
                            <input type="text" id="tour_name" name="tour_name" class="form-control"  placeholder="Tour Name"/>
                            @if ($errors->has('tour_name'))
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
                             @if(Auth::user()->role == 1)
                             <?php  foreach ($users as $key => $user) 
                                { ?>
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                            <?php   } ?>
                            @else
                            <?php $id = Auth::user()->id; ?>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                            @endif
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
                            <input type="text" id="center_lattitude" name="center_lattitude" class="form-control"  placeholder="Center Lattitude"/>
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
                            <input type="text" id="center_longitude" name="center_longitude" class="form-control"  placeholder="Center Longitude"/>
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
                            <input type="text" id="top" name="top" class="form-control" value=""  placeholder="Top"/>
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
                            <input type="text" id="right" name="right" class="form-control" value="" placeholder="Right"/>
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
                            <input type="text" id="bottom" name="bottom" class="form-control" value="" placeholder="Bottom"/>
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
                            <input type="text" id="left" name="left" class="form-control" value="" placeholder="Left"/>
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
                                <option value="13" selected="">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
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
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16" selected="">16</option>
                            </select>
                            @if ($errors->has('maximum_zoom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('maximum_zoom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password" class="form-control mb-15" id="set_password">
                                <option value="" >{{ __('Set Password') }}</option>
                                <option value="constant" @if(old("tour_control") == "constant") selected="selected" @endif >{{ __('Constant') }}</option>
                                <option value="temporary" @if(old("tour_control") == "temporary") selected="selected" @endif >{{ __('Temporary')  }}</option> 
                            </select>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-10" id="password_div" style="display: none;">
                            <select type="text" name="password_type" class="form-control" id="password_type">';
                                <option value="month" >{{ __("Month") }}</option>
                                <option value="week" >{{ __("Week")  }}</option> 
                                <option value="day" >{{ __("Day")  }}</option> 
                                <!-- <option value="timezone" >{{ __("TimeZone")  }}</option> -->
                            </select>
                            <input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="tour_control" class="col-md-2 required">Tour Control</label>
                        <div class="col-md-10">
                            <select type="text" name="tour_control" class="form-control" id="tour_control">
                                <option value="yes" @if(old("tour_control") == "yes") selected="selected" @endif >{{ __('Yes') }}</option>
                                <option value="no" @if(old("tour_control") == "no") selected="selected" @endif >{{ __('No')  }}</option> 
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
                            <button class="btn btn-info btn-block" type="submit" id="craete_idValid">Create</button>
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
    var add_row; 
    var passwords = [];
$(document).ready(function(){
    $("#set_password").change(function(){
        var val = $(this).val();
        if(val != "")
        {
            if(val == "constant")
            {
                add_row = 0;
                // html = '<input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>';
                html =   '<input type="text" id="password_'+add_row+'" data-id="'+add_row+'" name="password['+add_row+']" class="form-control mb-15 password" value="" placeholder="Password"/>';
            }
            else if(val == "temporary")
            {
                add_row = 0;
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
            }
            $("#password_div").html(html);
            $("#password_div").show();
            add_row++;
        }
        else
        {
            $("#password_div").css('display', 'none');
        }
    });  
});
    var image1 = "'{{ asset('images/d1.png') }}'";
    var image2 = "'{{ asset('images/d2.png') }}'";
    var image3 = "'{{ asset('images/d3.png') }}'";
    var image4 = "'{{ asset('images/d4.png') }}'";
    var add_poi=<?php echo $p = "0";?>;

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
    
</script>
<script type="text/javascript">
    $('form#create_formmcc').on('submit', function(event) {
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
                                    'type' : 'create',
                                }
                        },
                        // repeat: {
                        //     // check: function(){
                        //     //     var dd =  $( '#password_'+ids ).val();
                        //     //     if(passwords.indexOf(dd)){
                        //     //         return 'false';
                        //     //     }
                        //     //     else
                        //     //     {
                        //     //         return 'true';
                        //     //     }
                        //     // }
                        //         var unique = passwords.filter(function(item, pos) {
                        //             return passwords.indexOf(item) != pos;
                        //       });
                        // },
                        messages: {
                            required: "Password Field is required",
                            remote : "This password is already in use, please choose another one.",
                            // repeat : "You can not repeat password."
                          }
                    });
            });       
    });
    $("#create_formmcc").validate();
</script>

<script>
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

$(document).on('blur','.password',function(){
    var val =  $(this).val();
    passwords.push([val]);
    console.log(passwords);
});

</script>
@endsection


