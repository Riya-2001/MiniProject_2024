<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>DentCare - View Staff Profile</title>

<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <!-- build:css assets/css/app.min.css -->
  <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
  <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/core.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- endbuild -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
  <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
  <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
  <section class="app-content">
    <div class="row">
     
      <div class="col-md-12">
        <div class="widget">
          <header class="widget-header">
            <h3 class="widget-title">Staffs Applied For Registration</h3>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
          <div class="container">
  <div class="panel panel-primary">
    
    <table class="table table-hover" id="dev-table" width="100%" cellspacing="0" id="table" data-toggle="table" data-height="460"data-pagination="true"data-search="true">
      <thead>
        <tr>
        <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Address</th>
          <th>Approval Status</th>
            <th>Action</th>
        </tr>
        <?php
                                        $sql = "SELECT * FROM tblstaff WHERE Approval_status = 'Pending'";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $staffs = $query->fetchAll(PDO::FETCH_ASSOC);

                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($staffs as $staff) {
                                                ?>
                                                <tr>
                                                    <td><?= $staff['FullName']; ?></td>
                                                    <td><?= $staff['Email']; ?></td>
                                                    <td><?= $staff['MobileNo']; ?></td>
                                                    <td><?= $staff['Address']; ?></td>
                                                    <td><?= $staff['Approval_status']; ?></td>
                                                    <td>
                                                        <a class="btn btn-success btn-xs" href="manage_staff.php?id=<?= $staff['ID']; ?>&action=approve"><span class="glyphicon glyphicon-ok"></span></a> 
                                                        <a class="btn btn-danger btn-xs" href="manage_staff.php?id=<?= $staff['ID']; ?>&action=reject"><span class="glyphicon glyphicon-trash"></span></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $cnt = $cnt + 1;
                                            }
                                        }
                                        ?>
                                    </table>
  </div>
</div>

          </div><!-- .widget-body -->
        </div><!-- .widget -->
      </div><!-- END column -->

    </div><!-- .row -->
  </section><!-- #dash-content -->
</div><!-- .wrap -->
  <!-- APP FOOTER -->
  <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->
 <!-- build:js assets/js/core.min.js -->
 <script src="libs/bower/jquery/dist/jquery.js"></script>
  <script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
  <script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
  <script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
  <script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="libs/bower/PACE/pace.min.js"></script>
  <!-- endbuild -->

  <!-- build:js assets/js/app.min.js -->
  <script src="assets/js/library.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/app.js"></script>
  <!-- endbuild -->
  <script src="libs/bower/moment/moment.js"></script>
  <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="assets/js/fullcalendar.js"></script>
</body>
</html>


    
              