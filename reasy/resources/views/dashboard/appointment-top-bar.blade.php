<?php $role = Auth::user()->user_role; ?>
<ul class="nav nav-tabs">
    <li @if (\Request::is('list-visits')) class="active" @endif>
        <a href="{{url('list-visits' )}}">Upcoming Appointments</a>
    </li>
    <li @if (\Request::is('completed-visits')) class="active" @endif>
        <a href="{{url('completed-visits' )}}">Completed Appointments</a>
    </li>
   
</ul>
