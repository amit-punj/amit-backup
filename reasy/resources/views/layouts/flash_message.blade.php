@if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('flash_message_success') !!}</strong>
    </div>
@endif
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