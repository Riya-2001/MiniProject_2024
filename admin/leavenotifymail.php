<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';
    include 'connection.php';
    //https://myaccount.google.com/u/0/lesssecureapps - Turn on less secure apps
    $ptids= $_SESSION['ptids'];
    $d=$_SESSION['d'];
    $sql = "select username from tb_login where id in (".$ptids.")";
    //echo $sql;exit;

    $result = mysqli_query($conn,$sql);
    $str='';
    while ($row=mysqli_fetch_array($result))
    {
        $emaillist=$row['username'];
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";

        $mail->IsHTML(true);
        $mail->AddAddress($emaillist, "");
        $mail->SetFrom("riyarobin2024@mca.ajce.in", "DentCare - Dental Clinic");
        $mail->Subject = "Doctor - Appointments Cancelled";
        $content = "<b><font color='red'>Due to some reason your appointments has been cancelled for the date(s) ".$d."</font></b>";
        $mail->MsgHTML($content);
        $mail->Send();
    }

    echo "<script>alert('Appointment Cancellation Notification Sent Successfully.');window.location.href='viewdoctorleaves.php';</script>";
   
?>
