@section('title','Create Account') 
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Create Account'])

<div class="container register-page">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Create your Account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('co-tenant-register') }}" id="register_form">
                        @csrf
                        <input type="hidden" name="co_tenant_id" value="{{$TenantInvitation->id}}">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $TenantInvitation->email }}" required autocomplete="email" readonly="true">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" pwcheck="pwcheck" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tenant_photo_esignature" class="col-md-4 col-form-label text-md-right">{{ __('E-Signature') }}</label>
                            <div class="col-md-6">
                                <a href="javascript::void()" data-toggle="modal" data-target="#upload_signature">Upload E-Signature</a>
                                <br>
                                <input type="hidden" class="form-control" 
                                id="tenant_photo_esignature" name="tenant_photo_esignature" >
                                <span class="c_errors" id="c_error_tenant_photo_esignature"></span>
                                @error('tenant_photo_esignature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                            <div class="col-md-5">
                                <img style="display: none;" id="image_name" class="sign-preview" src="">
                            </div>                                       
                        </div>

                        <!-- <div class="form-group row mb-0"> -->
                        <div class="form-group row submit">
                            <!-- <div class="col-md-6 offset-md-4"> -->
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<div class="modal fade" id="upload_signature" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Put signature below</h3>
            </div>
            <div class="modal-body termsToPrint">
                <div id="signArea" >
                    <div class="sig sigWrapper" style="height:auto;">
                        <div class="typed"></div>
                        <form method="POST" action="">
                            <canvas class="sign-pad" id="sign-pad" width="508" height="100"></canvas>
                            <button id="removeSignature" type="button">Clear</button>
                            <button type="button" id="btnSaveSign" disabled="">Save Signature</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    #btnSaveSign {
        color: #fff;
        background: #f99a0b;
        padding: 5px;
        border: none;
        border-radius: 5px;
        font-size: 20px;
    }
    #signArea{
        width:510px;
    }
    .sign-preview {
        width: 150px;
        height: 50px;
        border: solid 1px #CFCFCF;
        margin: 10px 5px;
    }
    button#removeSignature {
        color: #fff;
        background: #c9302c;
        padding: 5px;
        border: none;
        border-radius: 5px;
        font-size: 20px;
    }
</style>
<script>
    $(document).ready(function() {
        $('#signArea').signaturePad({
            drawOnly:true, 
            drawBezierCurves:true,
            lineTop:90,
            clear : '#removeSignature',
            onDraw: (e)=>{ document.getElementById("btnSaveSign").disabled = false; }
        });
    });

    $("#removeSignature").click(function(e){
        document.getElementById("btnSaveSign").disabled = true;
    });
    $("#btnSaveSign").click(function(e){
        html2canvas([document.getElementById('sign-pad')], {
            onrendered: function (canvas) {
                var canvas_img_data = canvas.toDataURL('image/png');
                var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
                //ajax call to save image inside folder
                $.ajax({
                    url: "{{ url('upload-signature') }}",
                    data: {
                        _token:'<?php echo csrf_token() ?>',
                        img_data:img_data 
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {
                       var img = "{{url('images/users')}}";
                       $('#image_name').show();
                       $('#image_name').attr('src', img+'/'+response.image_name);
                       $('#tenant_photo_esignature').val(response.image_name);
                       $('#upload_signature').modal('hide');
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    jQuery('#register_form').validate({
        errorClass:"red",
        validClass:"green",
        rules:{
            email:{
                required:true,
                email:true,
            },
            name:{
                required:true,
            },
            last_name:{
                required:true,
            },
            password:{
                required:true,
                minlength: 8,
            },
            password_confirmation:{
                required:true,
                minlength: 8,
                equalTo : "#password"
            },
        }      
    });
    jQuery.validator.addMethod("pwcheck", 
        function(value) {
           // return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
           //     && /[a-z]/.test(value) // has a lowercase letter
           //     && /\d/.test(value) // has a digit

            var re = /(?=.*\d)(?=.*[%^()@$!%*?&])(?=.*[a-z])(?=.*[A-Z]).{8,}/;
            return re.test(value);
        },
        "Your password must be atleast 8 characters long, 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.");
</script>
@endsection
