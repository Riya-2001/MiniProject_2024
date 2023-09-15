
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">
  
  <!-- navbar header -->
  <div class="navbar-header">
    <button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
      <span class="sr-only">Toggle navigation</span>
      <span class="hamburger-box"><span class="hamburger-inner"></span></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-more"></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-search"></span>
    </button>

    <a href="profile.php" class="navbar-brand">
      <span class="brand-icon"><i class="fa fa-gg"></i></span>
      <span class="brand-name">DentCare</span>
    </a>
  </div><!-- .navbar-header -->
  
  <div class="navbar-container container-fluid">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      
      <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">

        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-settings"></i></a>
          <ul class="dropdown-menu animated flipInY">
            <li><a href="profile.php"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>My Profile</a></li>
            <li><a href="change-password.php"><i class="zmdi m-r-md zmdi-hc-lg zmdi-balance-wallet"></i>Change Password</a></li>
            <li><a href="logout.php"><i class="zmdi m-r-md zmdi-hc-lg zmdi-sign-in"></i>Logout</a></li>
            
          </ul>
        </li>

      </ul>
    </div>
  </div><!-- navbar-container -->
</nav>