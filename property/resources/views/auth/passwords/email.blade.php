@section('title','Reset Password')
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Reset Password'])
<div class="container login-page">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
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

<style type="text/css">
    .form-group.row.mb-0 {text-align: center; }
    button.btn.btn-primary {margin-left: 35px; }


</style>
@endsection
