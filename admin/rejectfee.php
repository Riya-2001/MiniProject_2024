<?php
  session_start();
  include 'connection.php';

  $drid = $_GET['t'];
  $status=2;

  $sql2 = "update tb_doctor set feestatus='".$status."', comments='Not Possible' where loginid='".$drid."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
  {
      echo "<SCRIPT type='text/javascript'>alert('New Fee Rejected');window.location.replace(\"viewdoctor.php\"); </SCRIPT>";
  }
  else
  {
      echo "<SCRIPT type='text/javascript'>alert('Rejection Failed');window.location.replace(\"viewdoctor.php\");</SCRIPT>";
    }

?>
