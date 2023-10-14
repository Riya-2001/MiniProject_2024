<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include_once('includes/header.php');

include_once('includes/sidebar.php');
$ap_date = $_POST['ap_date'];
	$did = $_SESSION['damsid'];
	$tsslot = $_POST['tsslot'];
 // echo $tsslot;exit;
  if($tsslot=='No Slot Available')
  {
     echo "<SCRIPT type='text/javascript'>alert('No Slots Avaialble for Booking....Click Ok To Go Back to Home.');
     window.location.replace(\"drbooking.php\");
     </SCRIPT>";
  }
  else
  {


  $status = 1;

  $sql1="insert into tblbooking(did,bkdate,bktimeslot,status,LoginId) values ('".$did."','".$ap_date."','".$tsslot."','".$status."','".$ptid."')";
  $ex1 = $dbh->prepare($sql1);

  if($tsslot=='s1')
  {
    $sql1="update tblschedule set slot1='0' where availdate ='".$ap_date."' and LoginId='".$did."'";
    $ex1 = $dbh->prepare($sql1);
    $ex1->execute();
  }

  if($tsslot=='s2')
  {
    $sql1="update tblschedule set slot2='0' where availdate ='".$ap_date."' and LoginId='".$did."'";
    $ex1 = $dbh->prepare($sql1);
    $ex1->execute();
  }

  if($tsslot=='s3')
  {
    $sql1="update tblschedule set slot3='0' where availdate ='".$ap_date."' and LoginId='".$did."'";
    $ex1 = $dbh->prepare($sql1);
    $ex1->execute();
  }

  if($tsslot=='s4')
  {
    $sql1="update tblschedule set slot4='0' where availdate ='".$ap_date."' and LoginId='".$did."'";
    $ex1 = $dbh->prepare($sql1);
    $ex1->execute();
  }

  if($tsslot=='s5')
  {
    $sql1="update tblschedule set slot5='0' where availdate ='".$ap_date."' and LoginId='".$did."'";
    $ex1 = $dbh->prepare($sql1);
    $ex1->execute();
  }

  if($tsslot=='s6')
  {
    $sql1="update tblschedule set slot6='0' where availdate ='".$ap_date."' and LoginId='".$did."'";
    $ex1 = $dbh->prepare($sql1);
    $ex1->execute();
  }

  if($tsslot=='s7')
  {
    $sql1="update tblschedule set slot7='0' where availdate ='".$ap_date."' and LoginId='".$did."'";
    $ex1 = $dbh->prepare($sql1);
    $ex1->execute();
  }

  if($ex1)
	{
     echo "<SCRIPT type='text/javascript'>alert('Appoinment Booked Successfully');
     window.location.replace(\"viewdrbookings.php\");
     </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Appointment Booking Failed');
     window.location.replace(\"drbooking.php\");
     </SCRIPT>";
  }
}
?>
