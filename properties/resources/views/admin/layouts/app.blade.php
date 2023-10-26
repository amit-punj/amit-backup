 @include('admin.layouts.partials.header')

<!-- START PAGE CONTAINER -->
<div class="page-container">

    @include('admin.layouts.partials.sidebar')

    <!-- PAGE CONTENT -->
    <div class="page-content">

        @include('admin.layouts.partials.topbar')
 
        <!-- PAGE CONTENT WRAPPER -->
        @yield('content')
        <!-- END PAGE CONTENT WRAPPER -->                                
    </div>            
    <!-- END PAGE CONTENT -->

</div>
<!-- END PAGE CONTAINER -->

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title">
                    <span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?
            </div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>                    
                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="{{ url('admin/logout') }}" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->
@if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
@endif
<!-- START PRELOADS -->
<!-- <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio> -->
<!-- <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio> -->
<!-- END PRELOADS -->
@include('admin.layouts.partials.footer')
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARGpUdzBWKnyufzqzh6sS2jlB91Grx9Ys&libraries=places&callback=initAutocomplete"></script>