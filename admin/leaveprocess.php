<?php
  	session_start();
  	include 'connection.php';

  	$lvid=$_SESSION['id'];
	

	$sql = "select * from tb_leaves where id='".$lvid."'";

  	$result = mysqli_query($conn,$sql);
  	while ($row=mysqli_fetch_array($result))
    {
    	$sdate=$row['sdate'];
    	$edate=$row['edate'];
    	$drid=$row['staffid'];
    	$type=$row['type'];
    }
    $_SESSION['d']=$sdate." To ".$edate;

    $sql = "select distinct loginid from tb_booking where bkdate between '".$sdate."' and '".$edate."' and drid='".$drid."'";
    //echo $sql;exit;
    $result = mysqli_query($conn,$sql);
    $str='';
    while ($row=mysqli_fetch_array($result))
    {
      $str=$str."".$row['loginid'].",";
    }
    $str=substr($str, 0, -1);
    $_SESSION['ptids']=$str;

    //echo $sdate." ".$edate." ".$drid." ".$type;exit;
    if ($type=='Full Day')
    {
      $sql2 = "update tb_drslots set slot1='0',slot2='0',slot3='0',slot4='0',slot5='0',slot6='0',slot7='0' where availdate between '".$sdate."' and '".$edate."' and loginid='".$drid."'";
     // echo $sql2;exit;
      $ex2=mysqli_query($conn,$sql2);
    }
    if ($type=='FN')
    {
     $sql2 = "update tb_drslots set slot1='0',slot2='0',slot3='0',slot4='0' where availdate between '".$sdate."' and '".$edate."' and loginid='".$drid."'";
    // echo $sql2;exit;
      $ex2=mysqli_query($conn,$sql2);
    }
    if ($type=='AN')
    {
      $sql2 = "update tb_drslots set slot5='0',slot6='0',slot7='0' where availdate between '".$sdate."' and '".$edate."' and loginid='".$drid."'";
    //  echo $sql2;exit;
      $ex2=mysqli_query($conn,$sql2);
    }

	$status=0; //rejected

	$sql2 = "update tb_booking set status='".$status."' where id in (select id from tb_booking where bkdate between '".$sdate."' and '".$edate."' and drid='".$drid."')";
	$ex2=mysqli_query($conn,$sql2);

	echo "<SCRIPT type='text/javascript'>window.location.replace(\"leavenotifymail.php\"); </SCRIPT>";
?>
