<?php
	session_start();
	include 'connection.php';
	$status=2;

	$sql2 = "update tb_leaves set status='".$status."',comments='".$_POST['comments']."' where id='".$_POST['lid']."'";
	$ex2=mysqli_query($conn,$sql2);

	if($ex2)
	{
    	echo "<SCRIPT type='text/javascript'>alert('Rejected Successfully');window.location.replace(\"viewleaves.php\"); </SCRIPT>";
	}
	else
	{
    	echo "<SCRIPT type='text/javascript'>alert('Rejection Failed');window.location.replace(\"viewleaves.php\");</SCRIPT>";
  	}

?>
