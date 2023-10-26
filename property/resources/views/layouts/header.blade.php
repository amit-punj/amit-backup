@if(Request::is('/'))
    <nav class="navbar navbar-inverse">
@else
    <nav class="navbar other-pages navbar-inverse">
@endif
  <div class="container">
    <div class="navbar-header ">
      <a class="navbar-brand" href="{{ url('/') }}">
        @if(Request::is('/'))
            <img src="{{ url('/images/logo.png') }}">
        @else
            <img src="{{ url('/images/logo_new.png') }}">
        @endif
      </a>
    </div>
    <ul class="nav navbar-nav menu1" >
     <!--  <li><a href="#">About Us</a></li>    
      <li><a href="#">Contact Us</a></li> -->
        @if (Auth::guest())
            <li><a href="{{ url('/list-membership-plans') }}">Membership</a></li>
        @endif
        <!-- @if (!Auth::guest())
          @if(Auth::user()->user_role == 3)

            <li class="" style="float: right;"><a href="{{ url('/messenger') }}"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
          @endif
        @endif -->
    </ul>
    <ul class="nav navbar-nav menu2 navbar-right">
        @if (Route::has('login'))
            @auth
                @if(Auth::user()->user_role == 3 || Auth::user()->user_role == 4 || Auth::user()->user_role == 5 || Auth::user()->user_role == 6)
                    <li class=""><a href="{{ url('/change-to-tenant') }}"><button class="btn btn-success">Switch To Tenant</button></a></li>
                @endif
                @if(Session::get('user_role') == 1)
                    <li class=""><a href="{{ url('/change-to-tenant') }}"><button class="btn btn-success">Switch Back</button></a></li>
                @endif
                @if(!empty(Auth::user()->image))
                    <li style="margin-top: -11px;"><a href="{{ url('/profile') }}"><img src="{{ asset('images/users/'.Auth::user()->image)}}" style="width: 50px; height: 50px; border-radius: 50%;"></a></li>
                @else
                <li style="margin-top: -11px;"><a href="{{ url('/profile') }}"><img src="{{ asset('images/dummy-user.png')}}" style="width: 50px; height: 50px; border-radius: 50%;"></a></li> 
                @endif
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class='user_name'>Welcome {{  Auth::user()->name }} </span>
                        <span class="caret"></span>
                    </a>
                  <ul class="dropdown-menu class_for_mobile">
                    @if(Auth::user()->user_role == 1)
                      <li><a href="{{ url('/dashboard?id=xyz') }}">Dashboard</a></li>
                      <li><a href="{{ url('/my-appointments') }}">Appointments</a></li>
                      <!-- <li><a href="{{ url('/messages') }}">Messages</a></li> -->
                      <li><a href="{{ url('/my-contract-list?page=1') }}">Contracts</a></li>
                      <li><a href="{{ url('/my-wallet') }}">Payments</a></li>
                      <!-- <li><a href="{{ url('/profile') }}">Profile</a></li> -->
                      <!-- <li><a href="{{ url('/book-appointment') }}">Book Appointments</a></li> -->
                    @endif
                    @if(Auth::user()->user_role == 2)
                      <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                      <!-- <li><a href="{{ url('/profile') }}">Profile</a></li> -->
                      <li><a href="{{ url('/membership-details') }}">Membership Details</a></li>
                      <li><a href="{{ url('/create-property') }}">Create Unit</a></li>
                      <!-- <li><a href="{{ url('/contracts') }}">Contract</a></li> -->
                      <!-- <li><a href="{{ url('/create-contract') }}">Contract</a></li> -->
                      <!-- <li><a href="{{ url('/list-of-properties') }}">List Of Entity's</a></li> -->
                      <li><a href="{{ url('/list-units') }}">Units</a></li>
                      <li><a href="{{ url('/my-contract-list?page=1') }}">Contracts</a></li>
                      <!-- <li><a href="{{ url('/list-booking-requests') }}">List Of Booking Requests</a></li> -->
                      <!-- <li><a href="{{ url('/managnent') }}">Managment</a></li> -->
                      <li><a href="{{ url('/legal-actions') }}">Legal Action</a></li>
                      <li><a href="{{ url('/access-permission') }}">Permissions</a></li>
                      <li><a href="{{ url('/ticket/list') }}">Repairs</a></li>
                      <!-- <li><a href="{{ url('/list-all-contracts') }}">List All Contracts</a></li> -->
                      <li><a href="{{ url('/list-all-tenants') }}">Tenants</a></li> 
                    @endif

                    @if(Auth::user()->user_role == 3)
                      <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                      <!-- <li><a href="{{ url('/list-booking-requests') }}">List Of Booking Requests</a></li> -->
                      <li><a href="{{ url('/list-units') }}">Units</a></li>
                      <li><a href="{{ url('/my-contract-list?page=1') }}">Contracts</a></li>
                      <li><a href="{{ url('/legal-actions') }}">Legal Action</a></li>
                      <li><a href="{{ url('/ticket/list') }}">Repairs</a></li>
                      <!-- <li><a href="{{ url('/contracts') }}">Contracts</a></li> -->
                      <!-- <li><a href="{{ url('/create-contract') }}">Contracts</a></li> -->
                      <!-- <li><a href="{{ url('/managnent') }}">Managment</a></li> -->
                      <li><a href="{{ url('/list-all-tasks') }}">Payments</a></li>
                      <li><a href="{{ url('/list-all-tenants') }}">Tenants</a></li>
                      <!-- <li><a href="{{ url('/give-permissions/1') }}">Permissions</a></li> -->
                      
                     <!--  <li><a href="{{ url('/list-all-contracts') }}">List All Contracts</a></li>
                      <li><a href="{{ url('/list-all-tenants') }}">List All Tenants</a></li> -->
                      <!-- <li><a href="{{ url('/manage-list-of-properties') }}">List Of Entity's</a></li>
                      <li><a href="{{ url('/manage-list-units') }}">List Of Unit</a></li> -->
                      <!-- <li><a href="{{ url('/profile') }}">Profile</a></li> -->
                    @endif
                    @if(Auth::user()->user_role == 6)
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <!-- <li><a href="{{ url('/messages') }}">Messages</a></li> -->
                        <li><a href="{{ url('/list-units') }}">Units</a></li>
                        <!-- <li><a href="{{ url('/list-visits') }}">List Of Appointments</a></li> -->
                        <li><a href="{{ url('/my-appointments') }}">Appointments</a></li>
                        <!-- <li><a href="{{ url('/my-calender') }}">My Calender</a></li> -->
                        <!-- <li><a href="{{ url('/profile') }}">Profile</a></li> -->
                    @endif
                    @if(Auth::user()->user_role == 4)
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <!-- <li><a href="{{ url('/messages') }}">Messages</a></li> -->
                        <li><a href="{{ url('/list-units') }}">Tasks</a></li>
                        <li><a href="{{ url('/my-appointments') }}">Appointments</a></li>
                        <!-- <li><a href="{{ url('/my-calender') }}">Calender</a></li> -->
                        <!-- <li><a href="{{ url('/profile') }}">Profile</a></li> -->
                    @endif
                    @if(Auth::user()->user_role == 5)
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('/list-units') }}">Units</a></li>
                        <!-- <li><a href="{{ url('/my-contract-list?page=1') }}">Contracts</a></li> -->
                        <li><a href="{{ url('/legal-actions') }}">Legal Action</a></li>
                        <!-- <li><a href="{{ url('/profile') }}">Profile</a></li> -->
                    @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">  @csrf  </form>
                        </li>
                  </ul>
                </li>
                @if(Auth::user()->user_role == 1 || Auth::user()->user_role == 2)
                  <li class=""><a href="{{ url('/messenger') }}"><i class="fa fa-commenting-o" aria-hidden="true"></i></a></li>
                 @endif
            @else
              <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              @if (Route::has('register'))
                   <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
              @endif
            @endauth
        @endif
    </ul>
  </div>
</nav>
@if (!Auth::guest())
<style type="text/css">
  @media only screen and (max-width: 767px) {
    ul.nav.navbar-nav.menu1 {margin-top: 35px; }
    ul.nav.navbar-nav.menu2 >li {display: inline-block; }
    ul.dropdown-menu li {background-color: #fff; border-bottom: 1px solid; }
  }
</style>
@else
<style type="text/css">
  @media only screen and (max-width: 767px) {
    ul.nav.navbar-nav.navbar-right li {width: 45%; float: left; }
    ul.nav.navbar-nav.navbar-right {margin-top: 35px; }
  }
</style>
@endif