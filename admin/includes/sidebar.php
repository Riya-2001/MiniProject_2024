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
         session_start();
         include('includes/dbconnection.php'); 
$eid=$_SESSION['damsid'];
$sql="SELECT FullName,Email from  tbladmin where ID=:eid";
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
          <a href="home.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Homepage</span>
          </a>
        </li>
        <li class="has-submenu">
          <a href="admin_doctor.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Doctor</span>
          </a>
        </li>

        <li class="has-submenu">
          <a href="admin_staff.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Staff</span>
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
        
        <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiess"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseUtilitiess" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       
                        
                        <a class="collapse-item" href="pdf/doctor-pdf.php" target="_blank">Doctor Details</a>
                        <a class="collapse-item" href="pdf/staff-pdf.php" target="_blank">Staff Details</a>
                        <!-- <a class="collapse-item" href="viewlogs.php">Login Logs</a> -->
                        
                    </div>
                </div>
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