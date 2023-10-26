@extends('admin.layouts.main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Create New Password
                    </h6>
                </div>
                <div class="card-body">
                    <!-- START WIDGETS -->
                    <form  action='{{ url("admin/tours/{$tour->id}/add_password") }}' class="form-horizontal" method="post" role="form" id="create_formmcc" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="Password" class="col-md-2 required">Set Login Password</label>
                        <div class="col-md-10" id="">
                            <select type="text" name="set_password" class="form-control" id="set_password" style="margin-bottom: 15px;">
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
                            <select type="text" name="password_type" class="form-control" id="password_type" style="margin-bottom: 15px;">';
                                <option value="month" >{{ __("Month") }}</option>
                                <option value="week" >{{ __("Week")  }}</option> 
                                <option value="day" >{{ __("Day")  }}</option> 
                                <!-- <option value="timezone" >{{ __("TimeZone")  }}</option> -->
                            </select>
                            <input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>
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
                html +='  <select type="text" name="password_type" class="form-control" id="password_type" style="margin-bottom: 15px;">';
                html +='      <option value="month" >{{ __("Month") }}</option>';
                html +='      <option value="week" >{{ __("Week")  }}</option> ';
                html +='      <option value="day" >{{ __("Day")  }}</option> ';
                // html +='      <option value="timezone" >{{ __("TimeZone")  }}</option> ';
                html +='  </select>';
                html +=   '<input type="text" id="password" name="password" class="form-control" value="" placeholder="Password"/>';
            }
            $("#password_div").html(html);
            $("#password_div").show();
        }
        else
        {
            $("#password_div").css('display', 'none');
        }
    });
});
</script>  
<script type="text/javascript">
    $('form#create_formmcc').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
        
        //Add validation rule for dynamically generated email fields
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
                                'type' : 'create',
                            }
                    },
                    messages: {
                        required: "Password Field is required",
                        remote : "This password is already in use, please choose another one."
                      }
                });
    });
    $("#create_formmcc").validate();
</script>

@endsection


