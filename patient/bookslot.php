<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include_once('includes/header.php');
include_once('includes/sidebar.php');

$ptid = $_SESSION['damsid'];
$ap_date = $_POST['ap_date'];
$did = $_POST['did'];
$tsslot = $_POST['tsslot'];
$status = 0;

// Check if the selected time slot is available (not booked by 3 people)
$sql_check_slot = "SELECT COUNT(*) as booked_count FROM tblbooking WHERE did = :did AND bkdate = :ap_date AND bktimeslot = :tsslot";
$check_stmt = $dbh->prepare($sql_check_slot);
$check_stmt->bindParam(':did', $did, PDO::PARAM_INT);
$check_stmt->bindParam(':ap_date', $ap_date, PDO::PARAM_STR);
$check_stmt->bindParam(':tsslot', $tsslot, PDO::PARAM_STR);
$check_stmt->execute();
$slot_info = $check_stmt->fetch(PDO::FETCH_ASSOC);

if ($slot_info['booked_count'] < 3) {
    $sql_insert_booking = "INSERT INTO tblbooking(did, bkdate, bktimeslot, status, LoginId) VALUES (:did, :ap_date, :tsslot, :status, :ptid)";
    $insert_stmt = $dbh->prepare($sql_insert_booking);
    $insert_stmt->bindParam(':did', $did, PDO::PARAM_INT);
    $insert_stmt->bindParam(':ap_date', $ap_date, PDO::PARAM_STR);
    $insert_stmt->bindParam(':tsslot', $tsslot, PDO::PARAM_STR);
    $insert_stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $insert_stmt->bindParam(':ptid', $ptid, PDO::PARAM_INT);
    
    if ($insert_stmt->execute()) {
        echo "<SCRIPT type='text/javascript'>alert('Appointment Booked Successfully');
             window.location.replace(\"viewdrbookings.php\");
             </SCRIPT>";
    } else {
        echo "<SCRIPT type='text/javascript'>alert('Appointment Booking Failed');
             window.location.replace(\"drbooking.php\");
             </SCRIPT>";
    }
} else {
    echo "<SCRIPT type='text/javascript'>alert('This time slot is fully booked. Please choose another time slot.');
         window.location.replace(\"drbooking.php\");
         </SCRIPT>";
}
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

