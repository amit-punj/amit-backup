<style type="text/css">
.m-0 {
    margin: 0!important;
}
.smallersize{
  font-size: 14px;
}
.box[_ngcontent-rst-c14] {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.list-group-item.active {
    background-color: #5fb43a;
    border-color: #5fb43a;
}
#sidebar {
	margin-bottom: 10px;
	background-color: #0e2a60; 
}
.list-group-item {
     background-color: inherit; 
}
.p-0 {
    padding: 0!important;
}

.mb-0, .my-0 {
    margin-bottom: 0!important;
}
.m-2 {
    margin: .5rem!important;
}
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
 /* font-size: 20px;*/
  color: white;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}


/* On mouse-over */

/* Main content */


/* Add an active class to the active dropdown button */
.active {
  background-color: #5fb43a;
  color: white;
}
:active, :focus, :visited, a:hover {
    outline: 0;
    text-decoration: unset;
}
a:hover{
   color: white;
}
a {
	color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
 

@media screen and (min-width: 1100px)
{
  .sidebarheight{
    min-height: 589px;
  }
}
</style>

<div id="sidebar" class="sidebarheight">
	<a class="list-group-item text-center" data-parent="#sidebar" href="{{url('/agent-profile')}}">
		@if(Auth::user()->profile_pic !="")
		<?php $img = Auth::user()->profile_pic; ?>
			<img src="{{ asset('images/'.$img)}}" height="100" width="100" style="border-radius: 50%;">
      	@else
			<img src="{{ asset('images/default/dummy-user.png')}}" height="100" width="100" style="border-radius: 50%;">
      	@endif
		
	</a>
	<a class="list-group-item <?php if($sidebar == 'requirement') echo "active"; ?>" data-parent="#sidebar" href="{{ url('agent-dashboard') }}">
		<span _ngcontent-rst-c14="" class="hidden-sm-down"><i class="fas fa-tachometer-alt"></i>  Dashboard</span>
	</a>
  <a class="list-group-item <?php if($sidebar == 'my_messages') echo "active"; ?>" data-parent="#sidebar" href="{{ url('agent-message-friends') }}">
    <span _ngcontent-rst-c14="" class="hidden-sm-down"><i class="fas fa-inbox"></i> Messages</span>
  </a>
          <ul class="navbar-nav">
                <li class="nav-item">
                    <a onclick="search_list()" class="nav-link list-group-item mysearch " href="#navbar-examples4" data-toggle="collapse" role="button1" aria-expanded="true" aria-controls="navbar-examples">
                    &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-search"></i>
                        <span class="nav-link-text">{{ __('Search') }}</span>
                        <span style="float: right; margin-right: 5%;"><i class="fa fa-caret-down"></i></span>
                    </a>

                    <div class="collapse <?php if($sidebar == 'search_property') echo "show"; ?><?php if($sidebar == 'search_buyer') echo "show"; if($sidebar == 'my_search_list') echo "show"; ?>" id="navbar-examples4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link smallersize list-group-item <?php if($sidebar == 'search_property') echo "active"; ?>" href="#" id="serch_property_data_link">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fab fa-searchengin"></i> {{ __('Search Property') }}
                                </a>
                            </li>
                            <li class="nav-item">
                             <a class="nav-link smallersize list-group-item <?php if($sidebar == 'search_buyer') echo "active"; ?>" id="serch_buyer_data_link" style="color: white;">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <i class="fab fa-searchengin"></i> {{ __('Search Buyers') }}
                               </a>
                               <li class="nav-item">
                                 <a class="nav-link smallersize list-group-item <?php if($sidebar == 'my_search_list') echo "active"; ?>" href="{{ url('agent/search_list/data')}}">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-list"></i>  {{ __('My Search List') }}
                               </a>
                            </li>
                            </li>
                        </ul>
                    </div>
                </li> 
                <li class="nav-item">
                    <a onclick="myFunction()" class="nav-link list-group-item client <?php if($sidebar == 'client') echo "active"; ?>" data-parent="#sidebar" href="#navbar-examplesl" data-toggle="collapse" role="button1" aria-expanded="true" id="fun1" aria-controls="navbar-examples">
                       &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-users"></i>
                        <span class="nav-link-text" >  {{ __('Clients') }}</span>
                        <span style="float: right; margin-right: 5%;"><i class="fa fa-caret-down"></i></span>
                    </a>
                    <div class="collapse <?php if($sidebar == 'client_list') echo "show"; ?><?php if($sidebar == 'client') echo "show"; if($sidebar == 'add_client') echo "show";?>" id="navbar-examplesl">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link list-group-item link1 smallersize <?php if($sidebar == 'add_client') echo "active"; ?>"  href="{{url('agent/add/client')}}">
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-user-plus"></i> {{ __('Add Client') }}
                                </a>
                            </li>
                            <li class="nav-item" >
                             <a class="nav-link list-group-item smallersize <?php if($sidebar == 'client_list') echo "active"; ?>" href="{{url('client/list/agent')}}">
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-list"></i> {{ __('Clients List') }}
                               </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a onclick="buyer()" class="nav-link list-group-item buyer " href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-store-alt"></i>
                        <span class="nav-link-text">   {{ __('Buyers') }}</span>
                        <span style="float: right; margin-right: 5%;"><i class="fa fa-caret-down"></i></span>
                    </a>

                    <div class="collapse <?php if($sidebar == 'add_requirement') echo "show"; ?><?php if($sidebar == 'my_requirement') echo "show"; ?>" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a id="clear_req_item" class="smallersize nav-link list-group-item <?php if($sidebar == 'add_requirement') echo "active"; ?>" href="{{url('agent/add/requirement')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus"></i>
                                    {{ __('Add Buyers') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link smallersize list-group-item <?php if($sidebar == 'my_requirement') echo "active"; ?>"  data-parent="#sidebar" href="{{ url('agent/requirement/list') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   <i class="fas fa-list"></i>  {{ __('My Buyers List') }}
                                </a>
                            </li>
                            <!--  <li class="nav-item">
                                <a class="nav-link smallersize list-group-item <?php if($sidebar == 'import_pro') echo "active"; ?>"  data-parent="#sidebar" href="{{ url('import-requirement') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   <i class="fas fa-list"></i>  {{ __('Import CSV') }}
                                </a>
                            </li> -->
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a onclick="properties()" class="nav-link list-group-item mylisting " href="#navbar-examples3" data-toggle="collapse" role="button1" aria-expanded="true" aria-controls="navbar-examples">
                    &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-building"></i>
                        <span class="nav-link-text">{{ __('Properties') }}</span>
                        <span style="float: right; margin-right: 5%;"><i class="fa fa-caret-down"></i></span>
                    </a>

                    <div class="collapse <?php if($sidebar == 'my_property') echo "show"; ?><?php if($sidebar == 'add_property') echo "show"; ?>" id="navbar-examples3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a id="clear_property_item" class="nav-link smallersize list-group-item <?php if($sidebar == 'add_property') echo "active"; ?>" href="{{url('agent/add/property')}}">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus"></i> {{ __('Add Property') }}
                                </a>
                            </li>
                            <li class="nav-item">
                             <a class="nav-link smallersize list-group-item <?php if($sidebar == 'my_property') echo "active"; ?>" href="{{ url('myproperty/list') }}">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-list"></i> {{ __('My Properties List') }}
                               </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link smallersize list-group-item <?php if($sidebar == 'import_csv') echo "active"; ?>"  data-parent="#sidebar" href="{{ url('import-property') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   <i class="fas fa-list"></i>  {{ __('Import CSV') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
          </ul>
        <a class="list-group-item <?php if($sidebar == 'my_request') echo "active"; ?>" data-parent="#sidebar" href="{{ url('user_request/connect')}}">
          <span _ngcontent-rst-c14="" class="hidden-sm-down"><i class="fas fa-user"></i>  Connection Requests</span>
       </a>
       <a class="list-group-item <?php if($sidebar == 'agent_list') echo "active"; ?>" data-parent="#sidebar" href="{{ url('agent/list/users_accepted')}}">
          <span _ngcontent-rst-c14="" class="hidden-sm-down"><i class="fas fa-user-friends"></i>  Connection List</span>
       </a>        
	   <a class="list-group-item <?php if($sidebar == 'transaction') echo "active"; ?>" data-parent="#sidebar" href="{{ url('agent-transaction') }}">
		<span _ngcontent-rst-c14="" class="hidden-sm-down"><i class="fas fa-money-check"></i>  Transaction List</span>
    </a>
    
</div>
  <form id="search_data_form_property"  action="{{url('agent/search_req')}}" method="get" style="display: none;">
  @csrf
                <select name="search_by" class="form-control abcd">
                  <option value="property">Property</option>
                </select>
               <input name="latitude"  id="latitude" type="hidden">   
              <input name="longitude"  id="longitude" type="hidden">
</form>
 <form id="search_data_form_buyer"  action="{{url('agent/search_req')}}" method="get" style="display: none;">
  @csrf
                <select name="search_by" class="form-control abcd">
                  <option value="requirement">requirement</option>
                </select>
                <input name="latitude"  id="latitude1" type="hidden">   
              <input name="longitude"  id="longitude1" type="hidden">
</form>