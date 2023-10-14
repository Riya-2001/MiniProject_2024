<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include_once('includes/header.php');

include_once('includes/sidebar.php');


?>
 <!DOCTYPE html>
<html lang="en">
<head>
  
  <title>DentCare - Appointment</title>
  
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
  <script>
    Breakpoints();
  </script>
  <script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

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
           
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
            
            
          <section class="content-header">
      
      </section> 
  
       <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
          
              <div class="col-lg-8 col-12">
              
          </div>
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
  
              <div class="card-body" >
                            <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Doctor Appointment Booking</b></center></h2><br>
  <div class="card-body" ><div class="card-body" >
              
  
                            <form role="form" action="viewdoctors.php" method="post" enctype="multipart/form-data" name="myform">
                          
                <div class="form-group">
                  
                <input placeholder="Appointment Date" 
       min="<?php echo date('Y-m-d'); ?>" 
       max="<?php echo date('Y-m-d', strtotime('+2 months')); ?>" 
       class="textbox-n form-control input-sm" 
       type="date" 
       id="ap_date" 
       name="ap_date" 
       required>
<span style="color: red;font-size: 14px" id="f5"></span>
                                </div> 
                    <input type="submit" value="View Available Doctors" class="btn btn-info btn-block" > <?php //onclick="return checkAll()" ?>
                              </form>
  
  
                          </div>  
  
                          </div>
  
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </div>
        <?php
  include('footer.php');
  ?>
  <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  
  
  
  
  </div>
  <!-- ./wrapper -->
  
  
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
  <!-- SIDE PANEL -->
 

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