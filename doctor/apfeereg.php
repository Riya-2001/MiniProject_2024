<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('../class/Appointment.php');
$object = new Appointment;
include('header.php');

if (strlen($_SESSION['damsid'] == 0)) {
    header('location:logout.php');
} else {
  $did = $_SESSION['damsid'];
  //echo $drid;

  $apfee = $_POST['apfee'];

  $currentdate = date('Y-m-d H:m:s');

  $sql3="update tbldoctor set apfee='".$apfee."',apfeeupdatetime='".$currentdate."' where LoginId='".$did."'";
  $ex2 = $dbh->prepare($sql3);
  $ex2->execute();
}

  if($ex2)
  {
    echo "<SCRIPT type='text/javascript'>alert('Appointment Fee Updated Successfully');
    window.location.replace(\"viewlatestfee.php\");
    </SCRIPT>";
  }
  else
  {
    echo "<SCRIPT type='text/javascript'>alert('Appointment Fee Updation Failed');
    window.location.replace(\"setapfee.php\");
    </SCRIPT>";
  }  
  
?>
