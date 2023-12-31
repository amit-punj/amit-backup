<!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->                    
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-user"></span><i class="fa fa-caret-down"></i></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <li><a href="{{ url('/admin/edit-profile') }}"><span class="fa fa-user"></span>Edit Profile</a></li>
                            <li><a href="{{ url('/admin/general') }}"><span class="fa fa-gear"></span>Setting</a></li>
                            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                        </ul>                           
                    </li> 
                    <!-- END LANG BAR -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->