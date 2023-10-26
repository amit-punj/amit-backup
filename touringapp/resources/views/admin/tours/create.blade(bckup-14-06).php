@extends('admin.layouts.main')

@section('content')
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
                    <form  action="{{ url('admin/tours/create') }}" class="form-horizontal" method="post" role="form" id="create_formmcc" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="tour_name" class="col-md-2">Tour Name</label>
                        <div class="col-md-10">
                            <input type="text" name="tour_name" class="form-control"  placeholder="Tour Name"/>
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
                             <?php  foreach ($users as $key => $user) 
                                { ?>
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
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
                    </div>
                   
 
                    <div class="form-group" id="poi_div">
                        <label for="poi" class="col-md-2">POI's <button type="button" onclick="javascript:AddPoi()" class="btn btn-default"><i class="fa fa-plus" style="color:black"></i></button></label>
                        <!-- <div class="col-md-10">
                            <input type="text" name="poi" class="form-control"  placeholder="POI's (points of interest)"/>
                            @if ($errors->has('poi'))
                                <span class="help-block">
                                   <strong>{{ $errors->first('poi') }}</strong>
                                </span>
                            @endif
                        </div> -->
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password" class="form-control" id="set_password">
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
                        <div class="col-md-10" id="password_div">
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
                            <button class="btn btn-info btn-block" id="craete_idValid">Create</button>
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
                html +='      <option value="timezone" >{{ __("TimeZone")  }}</option> ';
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

<script type="text/javascript">
    var add_row=<?php echo $i = '0';?>;
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
        // html +='       <a href="javascript:void(0)" id="add'+add_row+'" onclick="javascript:add_new('+add_row+')" class=" btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i></i></a>';
        // html +='       <a href="javascript:void(0)" onclick="javascript:EditRow('+add_row+')"class=" btn btn-primary"><i class="fa fa-edit"></i></a>';
        // html +='       <a href="javascript:void(0)" onclick="javascript:RemoveRow('+add_row+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>'; 
        html +='    </div>';
        html +=' </div>';
        // html +=' <div class="col-md-12" id="message_'+add_row+'" style="display: none;color: red;"></div>';
            
        $("#variations_div").append(html);
         add_row++;
    }

    var add_poi=<?php echo $p = "0";?>;
    function AddPoi()
    {
        html= '';
        html +='        <div class="row" id="poi_div_{{$p}}">';
        html +='                <div class="col-md-12" id="main_poi_'+add_poi+'" style="display: flex;">';
        html +='                    <div class="col-md-3">';
        
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
        // html +='                        <a href="javascript:void(0)" id="add_p'+add_poi+'" onclick="javascript:addPoi('+add_poi+')" class=" btn btn-success"><i class="fa fa-user-plus" aria-hidden="true"></i></i></a>';
        // html +='                        <a href="javascript:void(0)" onclick="javascript:EditPoi('+add_poi+')" class=" btn btn-primary"><i class="fa fa-edit"></i></a>';
        // html +='                        <a href="javascript:void(0)" onclick="javascript:RemovePoi('+add_poi+')" class=" btn btn-danger"><i class="fa fa-trash"></i></a>';
        html +='                    </div>';
        html +='                </div>';
        html +='          </div><br>';

        $("#poi_div").append(html);
         add_poi++;
    }
    
</script>
@endsection


