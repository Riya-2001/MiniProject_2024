<?php
   session_start();
   error_reporting(0);
   include('includes/dbconnection.php');
   include('header.php');
   
   if (isset($_SESSION['damsid']) && !empty($_SESSION['damsid'])) {
       $did = $_SESSION['damsid'];
      $ap_date = $_POST['ap_date'];
      //echo $ap_date;exit;
      $sql="select * from tblpatient inner join tblbooking on tblpatient.ID=tblbooking.LoginId where tblbooking.did='".$did."' and tblbooking.bkdate='".$ap_date."' order by tblbooking.bkdate desc";
      $stmt = $dbh->prepare($sql);
    $stmt->execute();
      $flag=0;
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $flag=1;
      }
      $sql="select * from tblpatient inner join tblbooking on tblpatient.ID=tblbooking.LoginId where tblbooking.did='".$did."' and tblbooking.bkdate='".$ap_date."' order by tblbooking.bkdate desc";
      $stmt = $dbh->prepare($sql);
    $stmt->execute();
   }

?>
  
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">



        <!-- Small boxes (Stat box) --><br><br><br>
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
      <th>Patient Name</th>
      <th>Booking Date</th>
      <th>Time Slot</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php $c=1;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  { ?>
    <tr style="text-align: center;">
      <td><?php echo $c; $c=$c+1; ?></td>
      <td><?php echo $row['FullName']; ?></td>
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
                                            if($status==1)
                                            { ?>
                                               <font color="green"><b>Approved</b></font>&nbsp;&nbsp;<a href="deactivatebooking.php?t=<?php echo $row['id']; ?>"><button class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></a>
                                 <?php      }
                                            if($status==0)
                                            {   ?>
                                               <font color="red"><b>Rejected</b></font>&nbsp;&nbsp;<a href="activatebooking.php?t=<?php echo $row['id']; ?>"><button class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i></button></a>
                                 <?php      }    
                                 if($status==3)
                                            {   ?>
                                               <font color="green"><b>On Leave</b></font>
                                 <?php      } 
                                  if($status==2)
                                            {   ?>

                                              <a href="activatebooking.php?t=<?php echo $row['id']; ?>"><button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button></a>
                                               <a href="deactivatebooking.php?t=<?php echo $row['id']; ?>"><button class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></a>


                                 <?php      } 
                                 if($status==4 or $status==5)
                                            {      ?>

<font color="green"><b>Paid</b></font> 

<a href="addprescription.php?ptid=<?php echo $row['id']; ?>"><button class="btn btn-dark"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
<font size="2px">Prescription</font></button></a>

<!-- <a href="addprescription.php?ptid=<?php// echo $row['id']; ?>"><button class="btn btn-info">
<font size="2px">View Prescription</font></button></a> -->

<?php } 
if($status==6){
?>
         <font color="green"><b>Cancelled Booking</b></font>    <a href="../patient/applyrefund.php?t=<?php echo $row['id']; ?>"><button class="btn btn-info">Process Refund</button></a>                             </td><?php } ?> 
         <?php 
if($status==7){
?>
              <font color="green">Refund ID : <?php echo $row['rfndid']; ?></font>                       </td><?php } ?> 
    </tr> 
  <?php } ?> 
  </tbody>
</table>
<div class="form-group"> <br>
          <a href="viewdrbookings.php"><button class="btn btn-outline-success btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Home</button></a>
      </div>
<?php
}
else
{ ?>
      <div class="form-group"> <br><br><br><br><br><br><br><br>
          <font color="red" size="4px"><b><center>No Booking Found For The Selected Date</center></b></font><br>
          <a href="viewdrbookings.php"><button class="btn btn-danger btn-block"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Back To Home</button></a>
      </div>
<?php
}
?>
          

</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


</div>
<!-- ./wrapper -->

