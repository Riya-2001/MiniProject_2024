<?php
   session_start();
   error_reporting(0);
   include('includes/dbconnection.php');

  $did = $_GET['t'];
  $status=0;
  $_SESSION['damsid']=$did;
  $sql2 = "update tblbooking set status='".$status."' where did='".$did."'";
  $ex2 = $dbh->prepare($sql2);
  $ex2->execute();
  if($ex2)
  {
    echo "<SCRIPT type='text/javascript'>alert('Booking Rejected');window.location.replace(\"rejected_bkmail.php\"); </SCRIPT>";
  }
  else
  {
    echo "<SCRIPT type='text/javascript'>alert('Booking Rejection Failed');window.location.replace(\"viewdrbookings.php\");</SCRIPT>";
  }

?>
