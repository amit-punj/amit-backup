<?php $role = Auth::user()->user_role; ?>
<div class="dashboard-sidebar">
    <ul>
        <!-- <li><a href="{{ url('/profile') }}">Profile</a></li> -->
        @if($role == 2)
        	<li><a href="{{ url('/membership-details') }}">Membership Details</a></li>
          <li><a href="{{ url('/create-property') }}">Create New Unit</a></li>
          <!-- <li><a href="{{ url('/list-of-properties') }}">List Of Entity's</a></li> -->
          <li><a href="{{ url('/list-units') }}">List Of Unit</a></li>
          <!-- <li><a href="{{ url('/list-all-contracts') }}">List All Contracts</a></li>
          <li><a href="{{ url('/list-all-tenants') }}">List All Tenants</a></li> -->
        @endif

        @if($role == 3)
          <li><a href="{{ url('/list-units') }}">List Of Unit</a></li>
         <!--  <li><a href="{{ url('/list-all-contracts') }}">List All Contracts</a></li>
          <li><a href="{{ url('/list-all-tenants') }}">List All Tenants</a></li> -->
       		<!-- <li><a href="{{ url('/manage-list-of-properties') }}">List Of Entity's</a></li>
       		<li><a href="{{ url('/manage-list-units') }}">List Of Unit</a></li> -->
   		 @endif

        <!-- <li><a href="{{ url('/list-visits') }}">Visits</a></li> -->
        @if($role == 1 || $role == 5)
          <li><a href="#">Property Description Experts</a></li>
          <li><a href="#">Legal Advisor</a></li>
          <li><a href="#">Visit Organizer</a></li>
          <li><a href="#">Property Manager</a></li>
        @endif
    </ul>
</div>
<style type="text/css">
  .dashboard-sidebar li:hover {color: #1a1a1a; border: 0; }
</style>