<?php
  session_start();
	include 'connection.php';

  $drid = $_GET['t'];
	$status=1;

  	$sql2 = "update tb_login set status='".$status."' where id='".$drid."'";
  	$ex2=mysqli_query($conn,$sql2);

  	if($ex2)
	{
    	echo "<SCRIPT type='text/javascript'>alert('Staff Activated');window.location.replace(\"viewstaff.php\"); </SCRIPT>";
	}
	else
	{
    	echo "<SCRIPT type='text/javascript'>alert('Updation Failed');window.location.replace(\"viewstaff.php\");</SCRIPT>";
  	}

?>
