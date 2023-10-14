<?php
session_start();
error_reporting(0);
  date_default_timezone_set("Asia/Calcutta");
include('includes/dbconnection.php');
include_once('includes/header.php');

include_once('includes/sidebar.php');


  
  $a = strval(date('Hms'));
  $s0 = '090000';
  $s1 = '093000';

  $s2 = '100000';

  $s3 = '110000';

  $s4 = '123000';
  $s5 = '140000'; //2pm

  $s6 = '150000'; //3pm

// ... (Previous code remains unchanged)



  $ptid=$_SESSION['damsid'];
  //echo $lkey;
  $date=$_POST['ap_date']; //ap_date
  $did = $_POST['drnames']; //drloginid
  
  	$sql="select * from tbldoctor where LoginId = '".$did."'";
      $result = $dbh->prepare($sql);
      $result->execute();
  	while ($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		$drname=$row['FullName'];
		$spec=" [ ".$row['Specialization']." ] ";
	}

	$sql="select * from tblschedule where LoginId = '".$did."' and availdate='".$date."'";
	$result = $dbh->prepare($sql);
      $result->execute();
  
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
                          <center><h3 style="color: grey;"><b>Doctor Appoinment Booking</b></h3></center>
<div class="card-body" ><div class="card-body" ><div class="card-body" ><div class="card-body" >
            

			<form role="form" action="bookslot.php" method="post" enctype="multipart/form-data" name="myform">
                <div class="form-group">
					<input value="<?php echo $date; ?>" class="form-control input-sm" id="ap_date" name="ap_date" readonly>
					<span style="color: red;font-size: 14px" id="f5"></span>
				</div> 

				<div class="form-group">
					<input value="<?php echo $drname.$spec; ?>" class="form-control input-sm" id="drname" name="drname" readonly>
					<input type="hidden" name="did" value="<?php echo $did; ?>" id='did'>
					<span style="color: red;font-size: 14px" id="f5"></span>
				</div> 

				<div class="form-group" >
					<select name="tsslot" id="tsslot" class="form-control input-sm">
					<?php
						$f=0;
						while ($row = $result->fetch(PDO::FETCH_ASSOC))
              {   
                
                $slot=$row['slot1'];
                if($slot=='0' ){}else{$f=1;  if($a < $s0 or date('Y-m-d')< $date){     ?> <option value="s1">9am-9.30am</option> <?php }}   

                $slot=$row['slot2'];
                if($slot==0){}else{$f=1;   if($a < $s1 or date('Y-m-d')< $date){     ?> <option value="s2">9.30am-10am</option> <?php  } } 

                $slot=$row['slot3'];
                if($slot==0){}else{$f=1;   if($a < $s2 or date('Y-m-d')< $date){     ?> <option value="s3">10am-10.30am</option> <?php  } }

                $slot=$row['slot4'];
                if($slot==0){}else{$f=1;   if($a < $s3 or date('Y-m-d')< $date){     ?> <option value="s4">11am-11.30am</option> <?php }  } 

                $slot=$row['slot5'];
                if($slot==0){}else{$f=1;   if($a < $s4 or date('Y-m-d')< $date){     ?> <option value="s5">12.30pm-1pm</option> <?php }  } 

                $slot=$row['slot6'];
                if($slot==0){}else{$f=1;   if($a < $s5 or date('Y-m-d')< $date){     ?> <option value="s6">2pm-2.30pm</option> <?php  }}  

                $slot=$row['slot7'];
                if($slot==0){}else{$f=1;   


                  if($a < $s6 or date('Y-m-d')< $date)
                  {     ?> 
                      <option value="s7">3pm-3.30pm</option> <?php 
                  }
                  else
                  { ?>

                    <option value="No Slot Available">No Slot Available</option>

                 <?php } }   ?>
          <?php } 
				  	if($f==0){
                 	?>  <option value="No Slot Available">No Slot Available</option>
          <?php       }
                 ?>
					</select>
				</div> 
                <?php 
                 if($f==1 and $a < $s6 or date('Y-m-d')< $date){
                 	?>  <input type="submit" value="Book Slot" class="btn btn-info btn-block" >
          <?php       } ?>
                           
                 </form>


                 <?php 
                 if($f==1 and $a < $s6 or date('Y-m-d')< $date){
                  ?>  
          <?php       }else{?>
           <a href="drbooking.php"><button class="btn btn-danger btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Booking</button></a>
 <?php         }
                 ?>





                 <?php 
                 if($f==0 or $a > $s6){
                  if( date('Y-m-d') > $date)
                  { ?>
                    <a href="drbooking.php"><button class="btn btn-danger btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Booking</button></a>
                  <?php } 
                 	?> 
          <?php       }
                 ?>

                 

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

