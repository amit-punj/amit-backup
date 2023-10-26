<section class="jumbotron text-center homebg" style="background-image: url('{{ asset('images/background.jpg') }}');">
	<div class="container">
		<p><img src="{{ asset('images/logo.png') }}" width="150" height="150" alt=""></p>
		<form method="POST">
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
	                    {{ __('Get Started') }}
	                </button>
	            </div>
	        </div>
	    </form>
	</div>
	

  
</section>