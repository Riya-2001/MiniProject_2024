<?php
  session_start();
	include 'connection.php';

  $drid = $_GET['t'];
  $status=1;
  $fee=$_GET['fee'];

  $sql2 = "update tb_doctor set feestatus='".$status."',orgfee='".$fee."',comments='Ok' where loginid='".$drid."'";
  //echo $sql2;exit;
  $ex2=mysqli_query($conn,$sql2);


  if($ex2)
	{
    	echo "<SCRIPT type='text/javascript'>alert('New Fee Approved');window.location.replace(\"viewdoctor.php\"); </SCRIPT>";
	}
	else
	{
    	echo "<SCRIPT type='text/javascript'>alert('Updation Failed');window.location.replace(\"viewdoctor.php\");</SCRIPT>";
  	}

?>
