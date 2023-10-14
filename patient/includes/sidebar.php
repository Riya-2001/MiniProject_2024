<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="assets/images/images.png" alt="avatar"/></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          <?php
$eid=$_SESSION['damsid'];
$sql="SELECT FullName,Email from  tblpatient where ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

foreach($results as $row)
{    
$email=$row->Email;   
$fname=$row->FullName;     
}   ?>
          <h5><a href="javascript:void(0)" class="username"><?php  echo $fname ;?></a></h5>
          
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">


        <li class="has-submenu">
          <a href="drbooking.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">New Appointment</span>
          </a>
        </li>
        
        <li class="has-submenu">
            <a  href="viewdrbookings.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
              <span class="menu-text">View Bookings</span>
            </a>
          </li>
          <li class="has-submenu">
            <a  href="viewreports.php" class="nav-link ">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
              <span class="menu-text">View Report</span>
            </a>
          </li>
        <li class="has-submenu">
          <a href="profile.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Profile Updation</span>
          </a>
        </li>

        <li class="has-submenu">
          <a href="change-password.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Change Password</span>
          </a>
        </li>
        
        <li class="has-submenu">
          <a href="logout.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Logout</span>
          </a>
        </li>
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>