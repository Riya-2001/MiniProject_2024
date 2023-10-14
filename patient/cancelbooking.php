<?php
  session_start();
  error_reporting(0);
  include('includes/dbconnection.php');
  

  $did = $_GET['t'];
  $status=4;
  $_SESSION['damsid']=$did;
  $sql2 = "update tblbooking set status='".$status."' where LoginId='".$did."'";
  $ex2 = $dbh->prepare($sql2);
      $ex2->execute();

  if($ex2)
  {
    echo "<SCRIPT type='text/javascript'>alert('Booking Cancelled');window.location.replace(\"viewdrbookings.php\"); </SCRIPT>";
  }
  else
  {
    echo "<SCRIPT type='text/javascript'>alert('Booking Cancel Failed');window.location.replace(\"viewdrbookings.php\");</SCRIPT>";
  }

?>
