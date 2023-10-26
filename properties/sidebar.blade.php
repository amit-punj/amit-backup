<!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                <a href="{{ url('dashboard') }}">ATLANT</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <?php
                        $role =Auth::user()->role;
                        if($role == 1)
                        {
                            $role = 'Super Admin';
                        }
                        if($role == 2)
                        {
                            $role = 'Office Admin';
                        }
                        $profile =Auth::user()->profile_pic;
                        if(is_null($profile))
                        {
                            $profile = "default/no-image.jpg"; 
                        }
                    ?>
                    <li class="xn-profile">
                        <div class="profile">
                            <div class="profile-image">
                                <a href="{{ url('dashboard') }}"><img src='{{ asset("images/{$profile}") }}' alt="John Doe"/></a>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">{{Auth::user()->name}}</div>
                                <div class="profile-data-title">{{ $role }}</div>
                            </div>
                            
                        </div>
                    </li>
                    
                    <li class="active">
                        <a href="{{ url('dashboard') }}"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboards</span></a>
                        <!-- <ul>
                            <li class="active"><a href="index.html"><span class="xn-text">Dashboard 1</span></a></li>
                            <li><a href="dashboard.html"><span class="xn-text">Dashboard 2</span></a></li>
                            <li><a href="dashboard-dark.html"><span class="xn-text">Dashboard 3</span></a></li>
                        </ul> -->
                    </li>
                    <!-- <li>
                        <a href="{{ url('/admin/users') }}"><span class="fa fa-users"></span> <span class="xn-text">Users</span></a>
                    </li> -->
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Users</span></a>
                        <ul>
                            <li class="active"><a href="{{ url('allusers') }}"><span class="xn-text">All Users</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="active"><a href="{{ url('/admin/users/create') }}"><span class="xn-text">Add New User</span></a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-asterisk"></span> <span class="xn-text">Requirements</span></a>
                        <ul>
                            <li class="active"><a href="{{ url('admin/all/requirement') }}"><span class="xn-text">All Requirements</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="active"><a href="{{url('admin/add/requirement')}}"><span class="xn-text">Add New Requirement</span></a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-home"></span> <span class="xn-text">Seller Properties</span></a>
                        <ul>
                            <li class="active"><a href="{{url('admin/all/properties')}}"><span class="xn-text">All Properties</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="active"><a href="{{url('admin/add/property')}}"><span class="xn-text">Add New Property</span></a></li>
                        </ul>
                    </li>
                     <li class="xn-openable">
                        <a href="#"><span class="fa fa-random"></span> <span class="xn-text">Subsciption</span></a>
                        <ul>
                            <li class="active"><a href="{{ url('/admin/add-subscription') }}"><span class="xn-text">Add Subsciption</span></a></li>
                            <li><a href="{{ url('/admin/view-subscription') }}"><span class="xn-text">Subsciption List</span></a></li>
                            <li><a href="#"><span class="xn-text">Transactions</span></a></li>
                        </ul>
                    </li>  
                     <li class="xn-openable">
                        <a href="#"><span class="fa fa-home"></span> <span class="xn-text">HomePage Slider</span></a>
                        <ul>
                            <li class="active"><a href="{{url('admin/all/slider')}}"><span class="xn-text">All Slider</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="active"><a href="{{url('admin/add/slider')}}"><span class="xn-text">Add New Slider</span></a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-code-o"></span> <span class="xn-text">Testimonial</span></a>
                        <ul>
                            <li><a href="{{ url('/admin/testimonial/all') }}"><span class="xn-text">All Testimonial</span></a></li>
                            <li class="active"><a href="{{ url('/admin/testimonial/add') }}"><span class="xn-text">Add Testimonial</span></a></li>
                        </ul>
                    </li> 
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-code-o"></span> <span class="xn-text">Page</span></a>
                        <ul>
                            <!-- <li class="active"><a href="{{ url('/admin/add-page') }}"><span class="xn-text">Add Page</span></a></li> -->
                            <li><a href="{{ url('/admin/view-page') }}"><span class="xn-text">Page List</span></a></li>
                        </ul>
                    </li> 
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR