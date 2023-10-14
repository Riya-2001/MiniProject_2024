<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $doctorId = $_GET['id'];

    // Update approval status based on admin action
    if ($action == 'approve') {
        $approvalStatus = 'Approved';
    } elseif ($action == 'reject') {
        $approvalStatus = 'Rejected';
    }

    // Update the doctor's approval status in the database
    $sql = "UPDATE tbldoctor SET Approval_status = :approvalStatus WHERE ID = :doctorId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':approvalStatus', $approvalStatus, PDO::PARAM_STR);
    $query->bindParam(':doctorId', $doctorId, PDO::PARAM_INT);
    if ($query->execute()) {
       
        header("Location: approve_reject_doctor.php");
        exit();
    } else {
        // Handle the error (e.g., display an error message)
        echo "Error updating doctor status.";
    }
} else {
    // Handle the case when doctor ID or action is not provided in the URL
    echo "Invalid request.";
}
?>
