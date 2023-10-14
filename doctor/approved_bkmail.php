<?php

include('includes/dbconnection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

function sendEmailNotification($toEmail, $subject, $content)
{
    $mail = new PHPMailer();

    // SMTP Configuration
    $mail->IsSMTP();
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "riyarobin2024@mca.ajce.in"; // Replace with your Gmail username
    $mail->Password   = "riya2001"; // Replace with your Gmail password

    $mail->IsHTML(true);
    $mail->AddAddress($toEmail, "");
    $mail->SetFrom("riyarobin2024@mca.ajce.in", "DentCare - Dental Clinic");
    $mail->Subject = $subject;
    $mail->MsgHTML($content);

    if (!$mail->Send()) {
        // Log or handle the error
        return false;
    } else {
        return true;
    }
}

$bkid = $_SESSION['damsid'];
$sql = "select * from tblbooking inner join tblrole on tblbooking.LoginId=tblrole.LoginId inner join tbldoctor on tbldoctor.LoginId where tblbooking.did='" . $bkid . "'";
$result = $dbh->prepare($sql);
$result->execute();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $bkdate = $row['bkdate'];
    $bktime = $row['bktimeslot'];
    $email = $row['Email'];
    $drname = $row['FullName'];
}

$ts = $bktime;
if ($ts == 's1') {
    $timeslot = "9am-9.30am";
} elseif ($ts == 's2') {
    $timeslot = "9.30am-10am";
} elseif ($ts == 's3') {
    $timeslot = "10am-10.30am";
} elseif ($ts == 's4') {
    $timeslot = "11am-11.30am";
} elseif ($ts == 's5') {
    $timeslot = "12.30pm-1pm";
} elseif ($ts == 's6') {
    $timeslot = "2pm-2.30pm";
} elseif ($ts == 's7') {
    $timeslot = "3pm-3.30pm";
}

$subject = "Doctor - Booking Status";
$content = "<b>Your Appointment Booking Approved by Dr." . $drname . "</b><br>Appointment Date: " . $bkdate . "<br>Time: " . $timeslot . "<br>Status: <font color='green'><b>Approved</b></font>";

if (sendEmailNotification($email, $subject, $content)) {
    echo "<script>alert('Booking Approval Notification Sent Successfully.');window.location.href='viewdrbookings.php';</script>";
} else {
    echo "<script>alert('Error Sending Booking Approval Notification.');window.location.href='viewdrbookings.php';</script>";
}
?>
