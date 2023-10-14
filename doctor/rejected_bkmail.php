<?php
    
    //https://myaccount.google.com/u/0/lesssecureapps - Turn on less secure apps
    include('includes/dbconnection.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";


    $bkid = $_SESSION['bkid'];
    $sql="select * from tblbooking inner join tblrole on tblbooking.LoginId=tblrole.LoginId inner join tbldoctor on tbldoctor.LoginId where tblbooking.did='".$bkid."'";
    $result = $dbh->prepare($sql);
$result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
       $bkdate=$row['bkdate'];
       $bktime=$row['bktimeslot'];
       $email=$row['username'];
       $drname=$row['name'];
    } 

    $ts=$bktime;
    if($ts=='s1')
    { 
      $timeslot = "9am-9.30am";
    }
    if($ts=='s2')
    { 
      $timeslot = "9.30am-10am";
    }
    if($ts=='s3')
    { 
      $timeslot = "10am-10.30am";
    }
    if($ts=='s4')
    { 
      $timeslot = "11am-11.30am";
    }
    if($ts=='s5')
    { 
      $timeslot = "12.30pm-1pm";
    }
    if($ts=='s6')
    { 
      $timeslot = "2pm-2.30pm";
    }
    if($ts=='s7')
    { 
      $timeslot = "3pm-3.30pm";
    }

    $mail->SMTPDebug  = 1;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";

    $mail->IsHTML(true);
    $mail->AddAddress($email, "");
    $mail->SetFrom("riyarobin2024@mca.ajce.in", "DentCare - Dental Clinic");
    $mail->Subject = "Doctor - Booking Status";

   

    $content = "<b>You Appointment Booking Rejected by Dr.".$drname."</b><br>Appointment Date :".$bkdate."<br>Time : ".$timeslot."<br>Status : <font color='red'><b>Rejected</b></font>";



    $mail->MsgHTML($content);
    if(!$mail->Send())
    {
      //echo "Error while sending Email.";
      //var_dump($mail);
    }
    else
    {
      echo "<script>alert('Booking Rejection Notification Sent Successfully.');window.location.href='viewdrbookings.php';</script>";
    }
?>
