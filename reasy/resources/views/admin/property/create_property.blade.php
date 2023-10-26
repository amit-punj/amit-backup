 @extends('adminlayouts.app')
@section('content')
<style type="text/css">
    .c309 {
        top: -3px;
        left: -10px;
        width: 4%;
        cursor: inherit;
        height: 100%;
        margin: 0;
        /* opacity: 0; */
        padding: 0;
        position: absolute; 
    }
</style>
<main class="app-content">
      <div class="app-title"><h3>Create Property</h3>
       </div>
     <div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if ($errors->any())
                    {!! implode('', $errors->all('<div class="error-message">:message</div>')) !!}
            @endif
            <div class="row">
                <div class="col-sm-12">
                    @include('admin..propertyform.form')
                </div>
            </div>  
        </div>
    </div>
  </div> 
</main>
@endsection   