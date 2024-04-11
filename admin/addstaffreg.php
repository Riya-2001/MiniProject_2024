<?php
  session_start();
	include 'connection.php';

	$email = $_POST['email'];
	$name = $_POST['name'];
	$phno = $_POST['phno'];

  $status = 1;
  $utype = 'staff';

  $pass=substr($name,0,3).substr($phno,6,10); //first 3 chars of name and last four digit of phone #
  //echo $pass;exit;
  $encpass=($pass);

  /*$drkey=md5(microtime());
  $policekey=substr($drkey,0,8);*/
  $sql2="select username from tb_login where username='".$email."'";
  
  $result = mysqli_query($conn,$sql2);
  $flag=0;
  while($row=mysqli_fetch_array($result))
  {
      $flag=1;
  }

  if($flag==1)
  {
    echo "<SCRIPT type='text/javascript'>alert('Email already registered. Try another email.');
     window.location.replace(\"addstaff.php\");
     </SCRIPT>";
  }

  $sql1="insert into tb_login(username,password,utype,status) values ('".$email."','".$encpass."','".$utype."','".$status."')";
 
  $ex1=mysqli_query($conn,$sql1);

  $sql2="select id from tb_login where username='".$email."' and password='".$encpass."'";
  
  $result = mysqli_query($conn,$sql2);
  while($row=mysqli_fetch_array($result))
  {
      $loginid=$row["id"];
  }

  $sql3="insert into tb_staff (name,phno,loginid) values ('".$name."','".$phno."','".$loginid."')";
  $ex2=mysqli_query($conn,$sql3);

  if($ex1 && $ex2)
	{
      $_SESSION['email'] = $email;
      $_SESSION['pass'] = $pass;
      echo "<SCRIPT type='text/javascript'>window.location.replace(\"staffmail.php\");</SCRIPT>";
      /*echo "<SCRIPT type='text/javascript'>alert('Registration Successfull');
     window.location.replace(\"viewstaff.php\");
     </SCRIPT>";*/
    
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Registration Failed');
     window.location.replace(\"addstaff.php\");
     </SCRIPT>";
  }

?>