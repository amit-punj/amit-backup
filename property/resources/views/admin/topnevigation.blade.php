<?php $role = Auth::user()->user_role; ?>
<ul class="nav nav-tabs">
    <li @if (\Request::is('edit-unit-admin/*')) class="active" @endif><a class="btn btn-success" href="{{url('/edit-unit-admin/'.$unit->id )}}">Edit Unit</a></li>
    <li @if (\Request::is('list-meters-admin/*')) class="active" @endif><a class="btn btn-success" href="{{url('/list-meters-admin/'.$unit->id)}}">Utilities</a></li>
   @if($role != 6)
    <li @if (\Request::is('list-contracts-admin/*')) class="active" @endif><a class="btn btn-success" href="{{ url('/list-contracts-admin/'.$unit->id) }}">Contracts</a></li>
    <li @if (\Request::is('list-tenants-admin/*')) class="active" @endif><a class="btn btn-success" href="{{ url('/list-tenants-admin/'.$unit->id) }}">Tenants</a></li>
    <li @if (\Request::is('unit-managment-admin/*')) class="active" @endif><a class="btn btn-success" href="{{ url('/unit-managment-admin/'.$unit->id) }}">ManageMent</a></li>
    <!-- <li @if (\Request::is('list-guarantors/*')) class="active" @endif><a href="{{ url('/list-guarantors/'.$unit->id) }}">Guarantors</a></li> -->
    @endif
    @if($role == 3)
    <!-- <li @if (\Request::is('list-tenants/*')) class="active" @endif><a href="{{ url('/list-tenants/'.$unit->id) }}">Tenants</a></li> -->
    <!-- <li @if (\Request::is('list-managment/*')) class="active" @endif><a href="{{ url('/list-managment/'.$unit->id) }}">Managment</a></li> -->
    @endif
</ul>
<style type="text/css">
    @media only screen and (max-width: 767px) {
        .top-nevigation li {border: 0 !important; padding: 15px 6px 0 !important; }
        
    }
</style>