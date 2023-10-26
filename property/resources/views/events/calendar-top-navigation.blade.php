<ul class="nav nav-tabs">
    <li @if (\Request::is('my-calender')) class="active" @endif>
        <a href="{{url('my-calender' )}}">My Calendar</a>
    </li>
    <li @if (\Request::is('add-availability')) class="active" @endif>
        <a href="{{url('add-availability' )}}">Add Availability</a>
    </li>
</ul>