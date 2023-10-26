<!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="logo">
                <a class="x-navigation" id="hidelogo" href="{{ url('dashboard') }}" style="background-color:#f2f3f2;"><img src="{{ asset('images/default/logo2.png')}}" height="60" width="200" style="margin-left: 11%;"></a>
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
                                <a href="{{ url('dashboard') }}"><img src='{{ asset("images/{$profile}") }}' style="height: 100px; width: 100px;" alt="John Doe"/></a>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">{{Auth::user()->name}}</div>
                                <div class="profile-data-title">{{ $role }}</div>
                            </div>
                            
                        </div>
                    </li>
                    
                    <li class="<?php if($sidebar == 'dashboard') echo "active"; ?>">
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
                    <li class="xn-openable <?php if($sidebar == 'allusers' || $sidebar == 'user_create') echo "active"; ?>">
                        <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Users</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'allusers') echo "active"; ?>"><a href="{{ url('allusers') }}"><span class="xn-text">All Users</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="<?php if($sidebar == 'user_create') echo "active"; ?>"><a href="{{ url('/admin/users/create') }}"><span class="xn-text">Add New User</span></a></li>
                        </ul>
                    </li>
                    <!-- <li class="xn-openable <?php if($sidebar == 'allclient' || $sidebar == 'client_create') echo "active"; ?>">
                        <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Clients</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'allclient') echo "active"; ?>"><a href="{{ url('admin/all/client') }}"><span class="xn-text">All Clients</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                           <!--  <li class="<?php if($sidebar == 'client_create') echo "active"; ?>"><a href="{{ url('/admin/add/client') }}"><span class="xn-text">Add New Client</span></a></li>
                        </ul>
                    </li> -->
                    <li class="xn-openable <?php if($sidebar == 'requirement' || $sidebar == 'add_requirement') echo "active"; ?>">
                        <a href="#"><span class="fa fa-asterisk"></span> <span class="xn-text">buyers</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'requirement') echo "active"; ?>""><a href="{{ url('admin/all/requirement') }}"><span class="xn-text">All buyers</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="<?php if($sidebar == 'add_requirement') echo "active"; ?>""><a href="{{url('admin/add/requirement')}}"><span class="xn-text">Add New buyer</span></a></li>
                        </ul>
                    </li>
                    <li class="xn-openable <?php if($sidebar == 'properties' || $sidebar == 'add_property' || $sidebar == 'import_csv') echo "active"; ?>">
                        <a href="#"><span class="fa fa-home"></span> <span class="xn-text">Seller Properties</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'properties') echo "active"; ?>"><a href="{{url('admin/all/properties')}}"><span class="xn-text">All Properties</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="<?php if($sidebar == 'add_property') echo "active"; ?>"><a href="{{url('admin/add/property')}}"><span class="xn-text">Add New Property</span></a></li>
                            <li class="<?php if($sidebar == 'import_csv') echo "active"; ?>"><a href="{{url('admin/import-property')}}"><span class="xn-text">{{ __('Import CSV') }}</span></a></li>
                        </ul>
                    </li>
                     <li class="xn-openable <?php if($sidebar == 'subsciption' || $sidebar == 'transaction_list' || $sidebar == 'add_subscription') echo "active"; ?>">
                        <a href="#"><span class="fa fa-random"></span> <span class="xn-text">Subscriptions</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'subsciption') echo "active"; ?>"><a href="{{ url('/admin/view-subscription') }}"><span class="xn-text">Subscription List</span></a></li>
                            <li class="<?php if($sidebar == 'add_subscription') echo "active"; ?>"><a href="{{ url('/admin/add-subscription') }}"><span class="xn-text">Add Subscription</span></a></li>
                            <li class="<?php if($sidebar == 'transaction_list') echo "active"; ?>"><a href="{{ url('/admin/transaction-list') }}"><span class="xn-text">Transaction List</span></a></li>
                        </ul>
                    </li>  
                     <li class="xn-openable <?php if($sidebar == 'slider' || $sidebar == 'add_slider') echo "active"; ?>">
                        <a href="#"><span class="fa fa-home"></span> <span class="xn-text">HomePage Slider</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'slider') echo "active"; ?>"><a href="{{url('admin/all/slider')}}"><span class="xn-text">All Slider</span></a></li>
                            <!-- <li><a href="#"><span class="xn-text">Buyer</span></a></li> -->
                            <li class="<?php if($sidebar == 'add_slider') echo "active"; ?>"><a href="{{url('admin/add/slider')}}"><span class="xn-text">Add New Slider</span></a></li>
                        </ul>
                    </li>
                    <li class="xn-openable <?php if($sidebar == 'testimonial' || $sidebar == 'add_testimonial') echo "active"; ?>">
                        <a href="#"><span class="fa fa-file-code-o"></span> <span class="xn-text">Testimonial</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'testimonial') echo "active"; ?>"><a href="{{ url('/admin/testimonial/all') }}"><span class="xn-text">All Testimonial</span></a></li>
                            <li class="<?php if($sidebar == 'add_testimonial') echo "active"; ?>"><a href="{{ url('/admin/testimonial/add') }}"><span class="xn-text">Add Testimonial</span></a></li>
                        </ul>
                    </li> 
                    <li class="xn-openable <?php if($sidebar == 'page' || $sidebar == 'add_page') echo "active"; ?>">
                        <a href="#"><span class="fa fa-file-code-o"></span> <span class="xn-text">Page</span></a>
                        <ul>
                            <li class="<?php if($sidebar == 'page') echo "active"; ?>"><a href="{{ url('/admin/view-page') }}"><span class="xn-text">Page List</span></a></li>
                            <li class="<?php if($sidebar == 'add_page') echo "active"; ?>"><a href="{{ url('/admin/add-page') }}"><span class="xn-text">Add Page</span></a></li>
                        </ul>
                    </li> 
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR