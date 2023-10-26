@section('title','Change Password')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Change Password'])
<div class="container login-page">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            @if(session()->has('message'))
                  <div class="alert alert-success">
                      {{ session()->get('message') }}
                  </div>
            @endif
            @if(session()->has('error'))
                  <div class="alert alert-success" style="color: #000;background-color: #ff00002e; border: 0; }">
                      {{ session()->get('error') }}
                  </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('update-password') }}" id="change_password">
                        @csrf

                        <div class="form-group row">
                            <label for="current_password" class="col-sm-4 col-form-label text-sm-right">{{ __('Current Password') }}</label>

                            <div class="col-sm-6">
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current_password" autofocus>

                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-sm-4 col-form-label text-sm-right">{{ __('New Password') }}</label>

                            <div class="col-sm-6">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new_password">

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_new_password" class="col-sm-4 col-form-label text-sm-right">{{ __('Confirm New Password') }}</label>

                            <div class="col-sm-6">
                                <input id="confirm_new_password" type="password" class="form-control @error('confirm_new_password') is-invalid @enderror" name="confirm_new_password" required autocomplete="confirm_new_password">

                                @error('confirm_new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row submit">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <div class="col-sm-2"></div>
    </div>
</div>
<script type="text/javascript">
    jQuery('#change_password').validate({
          errorClass:"red",
          validClass:"green",
          rules:{
              current_password:{
                required:true,
              },
              new_password:{
                required:true,
              },
              confirm_new_password:{
                required:true,
              }
          }      
      });
</script>
@endsection
