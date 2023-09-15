<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>DentCare - View Doctor Profile</title>

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
            <h3 class="widget-title">Activate/Deactivate Doctor</h3>
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
          <th>Specialization</th>
          <th>Activate / Deactivate</th>
        </tr>
      </thead>
      <?php
      $sql1="SELECT * from tbldoctor";
    $query1 = $dbh -> prepare($sql1);
    $query1->execute();
    $doctors=$query1->fetchAll(PDO::FETCH_OBJ);
    
    $cnt=1;
    if($query1->rowCount() > 0)
    {
        foreach ($doctors as $d) { ?>
            <tr>
              <td><?php echo $d->FullName; ?></td>
              <td><?php echo $d->Email; ?></td>
              <td><?php echo $d->MobileNumber; ?></td>
              <td><?php echo $d->Specialization; ?></td>
        <td>
          <?php
           if ($d->Status == 'Active') {
            echo '<a class="btn btn-danger btn-xs" href="activate-deactivate-doctor.php?id=' . $d->ID . '&action=deactivate">Deactivate</a>';
          } else {
            echo '<a class="btn btn-success btn-xs" href="activate-deactivate-doctor.php?id=' . $d->ID . '&action=activate">Activate</a>';
          }
          ?>
        </td>
      </tr>
    <?php $cnt = $cnt + 1;
    }
  } ?>
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