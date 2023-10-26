
<style type="text/css">
.bs-example{
      margin: 20px;
    }
    nav.navbar.navbar-expand-md.navbar-light.bg-light {
      padding: 0;
      margin-top: -15px;
}
li.nav-item.dropdown {
    display: flex;
}
.bg-light {
    background-color: white !important;
}

.login-signup {
  border-radius: 20px; margin: 10px 10px; float: right; width: 40%; min-height: 21px; margin-top: 4.5%; padding: 2px; height: 30px;
}
.container-fliude.settop-bar {
    max-width: 1400px;
    /* justify-content: center; */
}
@media screen and (min-width: 1600px){
 .container-fliude.settop-bar {
   margin-left: 17%;
   margin-right: 17%;
    
} 
}
@media screen and (min-width: 2000px)
{
.container-fliude.settop-bar {
   margin-left: 28%;
   margin-right: 28%;
    
}
}
@media screen and (min-width: 4500px){
 .container-fliude.settop-bar {
   margin-left: 37%;
   margin-right: 36%;
    
} 
}

</style>
 @if(Session::has('flash_message_enquire'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('flash_message_enquire') !!}</strong>
                    </div>
         @endif
       
         <div class="container-fliude settop-bar">

          <?php if(isset(Auth::user()->role) && Auth::user()->role != 0 ) {
              if(Auth::user()->role == 3)
              {
              ?>
           <div class="bs-example">
              <nav class="navbar navbar-expand-md navbar-light bg-light">
                      <a href="{{url('agent-dashboard')}}" class="navbar-brand"><img src="{{ asset('images/default/logo2.png')}}" width="170" height="60"></a>
                      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                          <span class="navbar-toggler-icon"></span>
                      </button>
                      <div id="navbarCollapse" class="collapse navbar-collapse">
                          <ul class="nav navbar-nav">
                              <!-- <li class="nav-item">
                                  <a href="{{url('/')}}" class="nav-link active">Home</a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{url('agent/add/property')}}" class="nav-link">Add Property</a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{url('myproperty/list')}}" class="nav-link">My Properties</a>
                              </li> -->
                              <!-- <li class="nav-item dropdown">
                                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Messages</a>
                                  <div class="dropdown-menu">
                                      <a href="#" class="dropdown-item">Inbox</a>
                                      <a href="#" class="dropdown-item">Drafts</a>
                                      <a href="#" class="dropdown-item">Sent Items</a>
                                      <div class="dropdown-divider"></div>
                                      <a href="#" class="dropdown-item">Trash</a>
                                  </div>
                              </li> -->
                           <!--    <li class="nav-item">
                                  <a href="{{url('agent/add/requirement')}}" class="nav-link">Add Requirement</a>
                              </li> -->
                          </ul>
                          <ul class="nav navbar-nav ml-auto">
                              <li class="nav-item dropdown " style="display: contents;">
                              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="margin-top: 5px;">
                                @if(Auth::user()->profile_pic !="")
                                     <?php $img = Auth::user()->profile_pic; ?>
                                  <img src="{{ asset('images/'.$img)}}" height="55" width="55" style="border-radius: 50%;">
                                @else
                                  <img src="{{ asset('images/default/dummy-user.png')}}" height="55" width="55" style="border-radius: 50%;">
                                @endif 
                              </a>
                                  <div class="dropdown-menu dropdown-menu-right">
                                      <a href="{{ url('agent-dashboard') }}" class="dropdown-item">Dashboard</a>
                                      <?php $ids = Auth::user()->id; ?>
                                      <a href="{{url('property/user/view/'.$ids)}}" class="dropdown-item">My Profile</a>
                                      <a href="{{url('agent_membership/renew')}}" class="dropdown-item">Membership</a>
                                      <a href="{{url('agent/change-password')}}" class="dropdown-item">Change Password</a>
                                      <div class="dropdown-divider"></div>
                                      <a href="{{url('agent/logout')}}" class="dropdown-item">Logout</a>
                                  </div>
                              </li>
                          </ul>
                      </div>
              </nav>
            </div>
       <?php }
            }
       else{
      
       ?>
       
             <div class="row" style="margin-left: 0px; margin-right: 0px">
              <div class="col-md-3 col-xs-3 ">
              <a href="{{url('/')}}"><img src="{{ asset('images/default/logo.png') }}" class="logo"></a>
              </div>
             <!--  <div class="col-md-5 col-sm- col-xs-5 text-center"><p class="membership-option">Click Sign Up to view membership options <i class="fa fa-long-arrow-right" style="font-size: 18px;"></i></p></div> -->
            <!--   <i class="fas fa-sign-in-alt"></i> -->
             <!--  <i class="fas fa-arrow-alt-circle-right check-icon" style="font-size: 21px;"></i> -->
         <!--      <i class="fas fa-long-arrow-alt-right"></i> -->
              <!-- <div class=" col-md-4  col-xs-4 flex-button ">
             <a href="{{ url('agent/login') }}" style="" class="btn btn-success btn1 col-md-6 col-xs-6 form-control flex-button login-signup"  ><span class="logintext">Login</span></a>
              <a href="{{url('agent/signup')}}" style="" class="btn btn-success btn1 col-md-6 col-xs-6 form-control flex-button login-signup"><span class="signuptext">Sign Up</span></a>
              </div> -->


              <!-- ////example -->
              <div class="col-md-5 col-sm- col-xs-5 text-center"><p class="membership-option">Click Sign up to Membership option <i class="fa fa-long-arrow-right sine"></i></p></div>
         <!--      <i class="fas fa-long-arrow-alt-right"></i> -->
              <div class=" col-md-4  col-xs-4 flex-button ">
             <a href="{{ url('agent/login') }}" style="border-radius: 20px; margin: 10px 10px; float: right; width: 40%; min-height: 21px; margin-top: 5%; padding: 2px; height: 30px;" class="btn btn-success btn1 col-md-6 col-xs-6 form-control flex-button"  ><span class="logintext">Log In</span></a>
              <a href="{{url('agent/signup')}}" style="border-radius: 20px; margin: 10px 10px; float: right; width: 40%; min-height: 21px; margin-top: 5%; padding: 2px; height: 30px;" class="btn btn-success btn1 col-md-6 col-xs-6 form-control flex-button"><span class="signuptext">Sign Up</span></a>
              </div>
              </div>
        
              <?php } ?>
  </div>

