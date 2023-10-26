<section class="jumbotron text-center homebg" style="background-image: url('{{ asset('images/background.jpg') }}');">



@if($errors->any())
<style>
	#code {
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
		<form method="POST" action="{{ url('start_tour') }}">
			@csrf
			<div class="form-group row">

	            <div class="col-md-6 offset-md-3">
	                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" placeholder="{{ __('Enter tour code') }}" required autocomplete="code" autofocus>

	                @error('code')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                @enderror
	            </div>
	        </div>
	        <div class="form-group row mb-0">
	            <div class="col-md-6 offset-md-3">
	                <button type="submit" class="btn btn-primary">
	                    {{ __('Start Tour') }}
	                </button>
	            </div>
	        </div>
	    </form>
	</div>
</section>