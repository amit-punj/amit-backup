@extends('layouts.home')

@section('content')
<section class="jumbotron text-center homebg" style="margin-bottom: 0;height: 100vh; background-image: url('{{ asset('images/background.jpg') }}'); position: relative;">
@if(session('errors'))
<style>
    #password {
      animation: shake 0.5s;
      /*animation-iteration-count: infinite;*/
      border: 3px solid red;
    }

    @keyframes shake {
      0% { transform: translate(1px, 1px) rotate(0deg); }
      10% { transform: translate(-1px, -2px) rotate(-1deg); }
      20% { transform: translate(-3px, 0px) rotate(1deg); }
      30% { transform: translate(3px, 2px) rotate(0deg); }
      40% { transform: translate(1px, -1px) rotate(1deg); }
      50% { transform: translate(-1px, 2px) rotate(-1deg); }
      60% { transform: translate(-3px, 1px) rotate(0deg); }
      70% { transform: translate(3px, 1px) rotate(-1deg); }
      80% { transform: translate(-1px, -1px) rotate(1deg); }
      90% { transform: translate(1px, 2px) rotate(0deg); }
      100% { transform: translate(1px, -2px) rotate(-1deg); }
    }
</style>    
@endif
    <div class="container">
        <p><img src="{{ asset('images/logo.png') }}" width="150" height="150" alt=""></p>
        <form method="POST" action="{{ url('signin') }}">
            @csrf
            <div class="form-group row">
                <div class="col-md-6 offset-md-3">
                    <input type="hidden" name="email" id="email" value="{{ $email }}">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="{{ __('Enter your password') }}" required autocomplete="password" autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $password }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="container about-button">
        <p class="">
            <a href="{{ url('https://www.heyhello.be/touringapp') }}">About the Touringapp</a>
        </p>
    </div>
    
</section>

@endsection

@section('scripts')
@endsection