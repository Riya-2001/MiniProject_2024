<?php
  session_start();
	include 'connection.php';

	$name = $_POST['name'];
	$email = $_POST['email'];
  $feed = $_POST['feed'];
  $curdate = date('Y-m-d H:m:s');

  $sql1="insert into tb_feedback(name,email,feed,date) values ('".$name."','".$email."','".$feed."','".$curdate."')";
  //echo $sql1;exit;
  $ex1=mysqli_query($conn,$sql1);


  if($ex1)
	{
    //exit;
      echo "<SCRIPT type='text/javascript'>alert('Feedback Submission Successfull');
     window.location.replace(\"index.php\");
     </SCRIPT>";    
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Submission Failed');
     window.location.replace(\"patientreg.php\");
     </SCRIPT>";
  }

?>