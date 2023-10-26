<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
           @if(!empty(Auth::user()->image))
              <img class="app-sidebar__user-avatar" width="51px" height="51px" src="{{ asset('images/'.Auth::user()->image)}}" alt="User Image">
           @else
             <img class="app-sidebar__user-avatar" width="48px" src="{{url('/images/user.jpg')}}" alt="User Image">
           @endif
        <div>
          <p class="app-sidebar__user-name">Admin</p>
        </div>
      </div>
      <ul class="app-menu">
        <li>
          <a class="app-menu__item" href="{{ url('/admin/dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Cms Pages</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/admin/listcmspage')}}"><i class="icon fa fa-circle-o"></i>All Cms Pages</a></li>
            <li><a class="treeview-item" href="{{url('/admin/addcmspage')}}"><i class="icon fa fa-circle-o"></i> Create New</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Property</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{ url('list/all/properties')}}"><i class="icon fa fa-circle-o"></i> List All Properts</a></li>
            <li><a class="treeview-item" href="{{ url('create-property-admin')}}"><i class="icon fa fa-circle-o"></i> Add Property</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Membership Plans</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/admin/listplans')}}"><i class="icon fa fa-circle-o"></i> List All Plans</a></li>
            <li><a class="treeview-item" href="{{url('/admin/addnewplan')}}"><i class="icon fa fa-circle-o"></i> Add Plan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user fa-lg"></i>
            <span class="app-menu__label">Users</span><i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('/admin/listusers')}}"><i class="icon fa fa-circle-o"></i> List All Users</a></li>
            <li><a class="treeview-item" href="{{url('/admin/newuser')}}"><i class="icon fa fa-circle-o"></i> Add User</a></li>
            <li><a class="treeview-item" href="{{url('/admin/user/membership/list')}}"><i class="icon fa fa-circle-o"></i> User Membership</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user fa-lg"></i>
            <span class="app-menu__label">Contracts</span><i class="fas fa-file-contract"></i>
          </a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('contract-list-admin?page=1')}}"><i class="icon fa fa-circle-o"></i> List All Contracts</a></li>
          </ul>
        </li>
         <li>
          <a class="app-menu__item" href="{{ url('/admin/ticket/listing') }}"><i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Tickets</span>
          </a>
        </li>
         <li>
          <a class="app-menu__item" href="{{ url('admin/extend-request/listing')}}"><i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Extend Request</span>
          </a>
        </li>
      </ul>
    </aside>