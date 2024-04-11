<?php
  session_start();
	include 'connection.php';

  $lid = $_GET['t'];
	$status=1;

	$sql2 = "update tb_leaves set status='".$status."',comments='OK' where id='".$lid."'";
	$ex2=mysqli_query($conn,$sql2);

	if($ex2)
	{
    	echo "<SCRIPT type='text/javascript'>alert('Approved Successfully');window.location.replace(\"viewstaffleaves.php\"); </SCRIPT>";
	}
	else
	{
    	echo "<SCRIPT type='text/javascript'>alert('Approval Failed');window.location.replace(\"viewstaffleaves.php\");</SCRIPT>";
  	}

?>
