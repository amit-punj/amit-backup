@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('flash_message_success') !!}</strong>
    </div>
@endif

<!-- <div class="card mb-4 py-0 border-left-primary">
    <div class="card-body">.border-left-primary</div>
</div> -->

@if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('flash_message_error') !!}</strong>
    </div>
@endif

@if(Session::has('flash_message_warning'))
    <div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('flash_message_warning') !!}</strong>
    </div>
@endif