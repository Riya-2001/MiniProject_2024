<?php
	session_start();
	include 'connection.php';

	$newlvbal = $_POST['newlvbal'];

	$sql3 = "update tb_staff set lvbal=lvbal+'".$newlvbal."' where id!='null'";
	//echo $sql3;exit; 
	$ex2=mysqli_query($conn,$sql3);

	$sql3 = "update tb_doctor set lvbal=lvbal+'".$newlvbal."' where id!='null'"; 
	$ex2=mysqli_query($conn,$sql3);	

	if($ex2)
	{
		echo "<SCRIPT type='text/javascript'>alert('Leave Details Updated Successfully');window.location.replace(\"index.php\"); </SCRIPT>";
	}
	else
	{
		echo "<SCRIPT type='text/javascript'>alert('Updation Failed.');window.location.replace(\"addleaves.php\");</SCRIPT>";
	}

?>
