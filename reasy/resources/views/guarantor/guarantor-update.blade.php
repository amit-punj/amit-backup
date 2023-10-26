@section('title','Update Details')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Update Details'])
        <div class="container edit-profile-page">
            <div class="row">
                <div class="col-md-1">
                    {{--@include('dashboard.sidebar') --}}
                </div>
                <div class="col-md-10">
                    <!-- <div class="profile-page-title">Edit Profile</div>    -->                                              
                    <!-------------->
                    <div class="register-page">
                        <div class="row justify-content-center">
                            <!-- <div class="col-md-3"></div> -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">{{ __('Edit your Details') }}</div>
                                    <?php $id = App\Helpers\Helper::encrypt_decrypt($guarantor->id, 'e' ); ?>
                                    <div class="card-body">
                                     <?php $booking_id = (isset($_GET['booking_id']) && !empty($_GET['booking_id'])) ? '?booking_id='.$_GET['booking_id'] : '' ; ?>
                                        <form method="POST" action="{{ url('/guarantor-update/'.$id.''.$booking_id) }}" enctype="multipart/form-data" id="edit_profile_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $guarantor->id }}">  
                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $guarantor->name }}" required autocomplete="name">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>
                                                <div class="col-md-6">
                                                    <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ $guarantor->phone_no }}"  autocomplete="phone_no" status="false">
                                                    @error('phone_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $guarantor->email }}"  autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="postal" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                                                <div class="col-md-6">
                                                    <input id="postal" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $guarantor->address }}"  autocomplete="Postal">
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
                                                @if($guarantor->photo)
                                                    <?php $url = '/images/guarantor/'.$guarantor->photo; ?>
                                                @else
                                                    <?php $url = '/images/users/user-image.png'; ?>
                                                @endif 
                                                <div class="col-md-6">
                                                    <input type="file" class="form-control" name="photo" id="photo">
                                                    <div class="user-image"><img style="margin-top: 10px;" id="photo_blah" src="{{ url($url)}}" alt="your image" height="100" width="100" />
                                                    </div>
                                                    @if ($errors->has('photo'))
                                                        <span class="help-block" style="color: red;">
                                                            <strong>{{ $errors->first('photo') }} </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> -->
                                            <div class="form-group row">
                                                <label for="photo_id_proof" class="col-md-4 col-form-label text-md-right">{{ __('ID Proof') }}</label>
                                                @if($guarantor->photo_id_proof)
                                                    <?php $url = '/images/guarantor/'.$guarantor->photo_id_proof; ?>
                                                @else
                                                    <?php $url = '/images/users/user-image.png'; ?>
                                                @endif 
                                                <div class="col-md-6">
                                                    <input type="file" class="form-control" name="photo_id_proof" id="photo_id_proof">
                                                    <div class="user-image"><img style="margin-top: 10px;" id="photo_id_proof_blah" src="{{ url($url)}}" alt="your image" height="100" width="100" />
                                                    </div>
                                                    @if ($errors->has('photo_id_proof'))
                                                        <span class="help-block" style="color: red;">
                                                            <strong>{{ $errors->first('photo_id_proof') }} </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tenant_photo_esignature" class="col-md-4 col-form-label text-md-right">{{ __('E-Signature') }}</label>
                                                <div class="col-md-6">
                                                    <a href="javascript::void()" data-toggle="modal" data-target="#upload_signature">Upload E-Signature</a>
                                                    <br>
                                                    <input type="hidden" class="form-control" 
                                                    id="tenant_photo_esignature" name="photo" >
                                                    <span class="errors" id="error_tenant_photo_esignature"></span>
                                                    @error('tenant_photo_esignature')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div> 
                                                @if($guarantor->photo)
                                                    <?php $url = '/images/users/'.$guarantor->photo; ?>
                                                @else
                                                    <?php $url = '/images/users/user-image.png'; ?>
                                                @endif 
                                                <div class="col-md-5">
                                                    <img id="image_name" class="sign-preview" src="{{ url($url)}}">
                                                </div>                                       
                                            </div>

                                            <div class="form-group row submit">
                                                    <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Update') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------------->
                </div>
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
                        <canvas class="sign-pad" id="sign-pad" width="508" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="">
                    <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button type="button" id="btnSaveSign">Save Signature</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <style type="text/css">
            span.invalid-feedback {color: red; font-size: 11px; }
            .gender_class span {width: auto; float: left;     padding-top: 5px; }
            .gender_class input {width: 12%; float: left; height: 20px; display: inline-block; border: 0 !important; box-shadow: none; }
            .user-image img {    width: 120px;    border-radius: 50%;    height: 120px; }
            .card-body {padding: 15px; }
            span#send_otp, span#m_send_otp {background-color: #f48400; padding: 8px 4px; font-size: 13px; border-radius: 3px; position: absolute; cursor: pointer; color: #fff;}
            span#phone_number_error {color: red; }
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
        </style>
        <script type="text/javascript">
            jQuery('#edit_profile_form').validate({
                errorClass:"red",
                validClass:"green",
                rules:{                  
                    name:{
                        required:true,
                    },
                }      
            });
        </script>
        <script type="text/javascript">
            // function readURL(input) {
            //   if (input.files && input.files[0]) {
            //     var reader = new FileReader();        
            //     reader.onload = function(e) {
            //       $('#photo_blah').attr('src', e.target.result);
            //     }        
            //     reader.readAsDataURL(input.files[0]);
            //   }
            // }

            // $("#photo").change(function() {
            //   readURL(this);
            // });

            function photo_id_proof_readURL(input) {
              if (input.files && input.files[0]) {
                var reader = new FileReader();        
                reader.onload = function(e) {
                  $('#photo_id_proof_blah').attr('src', e.target.result);
                }        
                reader.readAsDataURL(input.files[0]);
              }
            }

            $("#photo_id_proof").change(function() {
              photo_id_proof_readURL(this);
            });

        </script>
<script>
    $(document).ready(function() {
        $('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
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
                        // console.log(response);
                        // console.log(response.file_name);
                        // console.log(response.image_name);
                       // window.location.reload();
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
@endsection