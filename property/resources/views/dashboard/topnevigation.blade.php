<?php $role = Auth::user()->user_role; ?>
<ul class="nav nav-tabs">
    @if($role == 4)
        <li @if (\Request::is('list-meters/*')) class="active" @endif><a href="{{url('/list-meters/'.$unit->id)}}">Utilities</a></li>
        <!-- <li @if (\Request::is('dues-damages/*')) class="active" @endif><a href="{{url('/dues-damages/'.$unit->id)}}">Dues & Damages</a></li> -->
    @elseif($role == 2)
        <li @if (\Request::is('edit-unit/*')) class="active" @endif><a href="{{url('/edit-unit/'.$unit->id )}}">Edit Unit</a></li>
        <li @if (\Request::is('list-meters/*')) class="active" @endif><a href="{{url('/list-meters/'.$unit->id)}}">Utilities</a></li>
        <li @if (\Request::is('list-contracts/*')) class="active" @endif><a href="{{ url('/list-contracts/'.$unit->id) }}">Contracts</a></li>
        <li @if (\Request::is('list-tenants/*')) class="active" @endif><a href="{{ url('/list-tenants/'.$unit->id) }}">Tenants</a></li>
        <li @if (\Request::is('unit-managment/*')) class="active" @endif><a href="{{ url('/unit-managment/'.$unit->id) }}">ManageMent</a></li>
    @elseif($role == 3)
        <?php
            $unitPermission = App\Helpers\Helper::accessPermission($unit->user_id, Auth::user()->user_role, 'unit_permission');
        ?>
        @if($unitPermission !=0)
        <li @if (\Request::is('edit-unit/*')) class="active" @endif><a href="{{url('/edit-unit/'.$unit->id )}}">Edit Unit</a></li>
        @endif
        <li @if (\Request::is('list-meters/*')) class="active" @endif><a href="{{url('/list-meters/'.$unit->id)}}">Utilities</a></li>
        <li @if (\Request::is('list-contracts/*')) class="active" @endif><a href="{{ url('/list-contracts/'.$unit->id) }}">Contracts</a></li>
        <li @if (\Request::is('list-tenants/*')) class="active" @endif><a href="{{ url('/list-tenants/'.$unit->id) }}">Tenants</a></li>
        <li @if (\Request::is('unit-managment/*')) class="active" @endif><a href="{{ url('/unit-managment/'.$unit->id) }}">ManageMent</a></li>
    @elseif($role == 5)
        <li @if (\Request::is('list-meters/*')) class="active" @endif><a href="{{url('/list-meters/'.$unit->id)}}">Utilities</a></li>
        <li @if (\Request::is('list-contracts/*')) class="active" @endif><a href="{{ url('/list-contracts/'.$unit->id) }}">Contracts</a></li>
        <li @if (\Request::is('list-tenants/*')) class="active" @endif><a href="{{ url('/list-tenants/'.$unit->id) }}">Tenants</a></li>
        <li @if (\Request::is('unit-managment/*')) class="active" @endif><a href="{{ url('/unit-managment/'.$unit->id) }}">ManageMent</a></li>
    @endif

    <!-- <li @if (\Request::is('edit-unit/*')) class="active" @endif><a href="{{url('/edit-unit/'.$unit->id )}}">Edit Unit</a></li>
    <li @if (\Request::is('list-meters/*')) class="active" @endif><a href="{{url('/list-meters/'.$unit->id)}}">Utilities</a></li> -->
    @if($role != 6)
    <!-- <li @if (\Request::is('list-contracts/*')) class="active" @endif><a href="{{ url('/list-contracts/'.$unit->id) }}">Contracts</a></li>
        <li @if (\Request::is('list-tenants/*')) class="active" @endif><a href="{{ url('/list-tenants/'.$unit->id) }}">Tenants</a></li>
        <li @if (\Request::is('unit-managment/*')) class="active" @endif><a href="{{ url('/unit-managment/'.$unit->id) }}">ManageMent</a></li>
        <li @if (\Request::is('list-guarantors/*')) class="active" @endif><a href="{{ url('/list-guarantors/'.$unit->id) }}">Guarantors</a></li> -->
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