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

                    
                    <div class="form-group">
                        <label for="variations" class="col-md-2">Variations</label>
                        <div class="col-md-10">
                            <input type="text" name="variations" class="form-control"  placeholder="Tour Owner"/>
                            @if ($errors->has('variations'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('variations') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                   
 
                    <div class="form-group">
                        <label for="poi" class="col-md-2">POI's</label>
                        <div class="col-md-10">
                            <input type="text" name="poi" class="form-control"  placeholder="POI's (points of interest)"/>
                            @if ($errors->has('poi'))
                                <span class="help-block">
                                   <strong>{{ $errors->first('poi') }}</strong>
                                </span>
                            @endif
                        </div>
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


