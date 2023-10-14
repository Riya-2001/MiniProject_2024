<?php
   session_start();
   error_reporting(0);
   include('includes/dbconnection.php');
   include('header.php');
   
   if (isset($_SESSION['damsid']) && !empty($_SESSION['damsid'])) {
       $did = $_SESSION['damsid'];
      $ap_date = $_POST['ap_date'];
      //echo $ap_date;exit;
      $sql="select * from tbldoctor inner join tblbooking on tbldoctor.LoginId=tblbooking.did where tblbooking.LoginId='".$did."' and tblbooking.bkdate='".$ap_date."' order by tblbooking.bkdate desc";
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $flag=0;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $flag=1;
      }
      $sql="select * from tbldoctor inner join tblbooking on tbldoctor.LoginId=tblbooking.did where tblbooking.LoginId='".$did."' and tblbooking.bkdate='".$ap_date."' order by tblbooking.bkdate desc";
      //echo $sql;exit;
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
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
              <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <h2 style="font-family: 'Open Sans', sans-serif;"><center><b>Appointment Booking History</b></center></h2><br>

               <div class="form-group"> 
                 <font color="orange" size="5px"><b><center>Booking Date : <?php echo $ap_date; ?></center></b></font>
               </div> 
<?php 
  if($flag==1)
  {
?>

        <table class="table table-bordered" id="table"  data-toggle="table" data-height="460"  data-pagination="true"   data-search="true"> 
        <thead>
    <tr style="text-align: center;">
      <th>#</th>
      <th>Dr. Name</th>
      <th>Specialization</th>
      <th>Booking Date</th>
      <th>Time Slot</th>
      <th>Status</th>
      <th>Payment/Refund</th>

    </tr>
  </thead>
  <tbody>
  <?php $c=1;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  { ?>
    <tr style="text-align: center;">
      <td><?php echo $c; $c=$c+1; ?></td>
      <td>Dr.<?php echo $row['FullName']; ?></td>
      <td><?php 
                
                $s=$row['Specialization']; 
                if($s==''){
                  echo "General";
                }
                else
                {
                  echo $s;
                }

          ?></td>
      <td><?php echo $row['bkdate']; ?></td>
      <td><?php 
        $ts=$row['bktimeslot']; 
        if($ts=='s1')
        { 
          echo "9am-9.30am";
        }
        if($ts=='s2')
        { 
          echo "9.30am-10am";
        }
        if($ts=='s3')
        { 
          echo "10am-10.30am";
        }
        if($ts=='s4')
        { 
          echo "11am-11.30am";
        }
        if($ts=='s5')
        { 
          echo "12.30pm-1pm";
        }
        if($ts=='s6')
        { 
          echo "2pm-2.30pm";
        }
        if($ts=='s7')
        { 
          echo "3pm-3.30pm";
        }
?></td>
     
      <!-- <td><button class="btn btn-secondary" data-toggle="modal" data-target="#example<?php //echo $row['ambkey']; ?>">Notify</button></td> -->
      <td><?php $status = $row['status'];
      $pstatus=$row['paymentstatus'];
      if($status==2)
        { ?>
          <font color="grey"><b>Pending for Approval</b></font>
                    <a href="cancelbooking.php?t=<?php echo $row['id']; ?>"><button class="btn btn-outline-danger btn-block"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</button></a>
      
  <?php      }
        if($status==1)
        { ?>
           <font color="green"><b>Approved</b></font>
                     <a href="cancelbooking.php?t=<?php echo $row['id']; ?>"><button class="btn btn-outline-danger btn-block"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</button></a>
      
  <?php      }
        if($status==0)
        {   ?>
           <font color="red"><b>Rejected</b></font>
  <?php      }   
        if($status==3)
        {   ?>
           <font color="red"><b>Cancelled [ Doctor on Leave ]</b></font>
  <?php      }  
  if($status==4)
        {   ?>
           <font color="red"><b>Cancelled By User</b></font>
  <?php      }    ?>  
   <?php       
  if($status==5)
        {   ?>
           <font color="green"><b>Approved</b></font><br><hr><font color="green">TXN ID : <?php echo $row['txnid']; ?></font>
  <?php      }    
if($status==6)
        {  
  ?>  
<font color="green"><b>Refund Initiated - 750 INR</b></font> <?php } 
if($status==7)
{ ?>
  <font color="green">Refund ID : <?php echo $row['rfndid']; ?></font>
<?php }
?>
  </td> 
  <td>
    <?php 
    if($status==1)
    {   
    ?>
      <a href="payment/pay.php?t=<?php echo $row['id']; ?>"><button class="btn btn-primary">Make Payment 750 INR</button></a>
    <?php } 
    elseif($status==5) 
    { ?>
    <font color="green"><b>Paid</b></a></font>&nbsp;<a target="_blank" href="../admin/fpdf/viewreciept.php?t=<?php echo $row['id']; ?>"><i class='fas fa-file-pdf' style='font-size:24px;color:red'></i></a><br>
    <?php } 
    elseif($status==6)
    { ?>
      <font color="green"><b>Processing</b></font>
    <?php }
    elseif($status==7)
    {?>
      <font color="green"><b>Refund Completed - 750 INR</b></font>
    <?php }
    if($status!=1 and $status!=5 and $status!=6 and $status!=7)
    {
      ?>
      <font color="red"><b>NA</b></font>
    <?php  
    }
  ?>

  </td>                                      
    </tr> 
  <?php } ?> 
  </tbody>
</table>
<div class="form-group"> <br>
          <a href="viewdrbookings.php"><button class="btn btn-outline-success btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Booking</button></a>
      </div>
<?php
}
else
{ ?>
      <div class="form-group"> <br><br><br><br><br><br><br><br>
          <font color="red" size="4px"><b><center>No Booking Found For The Selected Date</center></b></font><br>
          <a href="viewdrbookings.php"><button class="btn btn-danger btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Booking</button></a>
      </div>
<?php
}
?>
          
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