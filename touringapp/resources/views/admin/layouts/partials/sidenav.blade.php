<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"> <!-- bg-gradient-primary -->

      <!-- Sidebar - Brand -->
      <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{URL::to('admin/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Touring <sup>app</sup>
        </div>
      </a> -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{URL::to('admin/')}}">
        <img src="{{ asset('images/logo.png') }}" width="100" height="60" alt="">
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <!-- <a class="nav-link" href="{ /* route('admin.index') */ }"> -->
        <a class="nav-link" href="{{ URL::to('admin/') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Users</span>
        </a>
        @if(Auth::user()->role == 1)
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users:</h6>
            <a class="collapse-item" href="{{ URL::to('admin/users') }}">Listing</a>
            <a class="collapse-item" href="{{ URL::to('admin/users/create') }}">Create</a>
          </div>
        </div>
        @else
        <?php $id = Auth::user()->id; ?>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Users:</h6>
              <a class="collapse-item" href='{{ url("admin/users/{$id}/update") }}'>View Profile</a>
            </div>
          </div>
        @endif
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTour" aria-expanded="true" aria-controls="collapseTour">
          <i class='fas fa-plane-departure'></i>
          <span>Tours</span>
        </a>
        <div id="collapseTour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tours:</h6>
            <a class="collapse-item" href="{{ URL::to('admin/tours') }}">Listing</a>
            <a class="collapse-item" href="{{ URL::to('admin/tours/create') }}">Create</a>
          </div>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePassword" aria-expanded="true" aria-controls="collapsePassword">
          <i class='fa fa-lock'></i>
          <span>Passwords</span>
        </a>
        <div id="collapsePassword" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Passwords:</h6>
            <a class="collapse-item" href="{{ URL::to('admin/tours/password') }}">Listing</a>
          </div>
        </div>
      </li> -->

      <!-- Nav Item - Utilities Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li> -->

      <!-- Divider -->
      <!-- <hr class="sidebar-divider"> -->

      <!-- Heading -->
      <!-- <div class="sidebar-heading">
        Addons
      </div> -->

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li> -->

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li> -->

      <!-- Nav Item - Tables -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>