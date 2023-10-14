<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $staffId = $_GET['id'];

    // Update approval status based on admin action
    if ($action == 'approve') {
        $approvalStatus = 'Approved';
    } elseif ($action == 'reject') {
        $approvalStatus = 'Rejected';
    }

    // Update the staff's approval status in the database
    $sql = "UPDATE tblstaff SET Approval_status = :approvalStatus WHERE ID = :staffId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':approvalStatus', $approvalStatus, PDO::PARAM_STR);
    $query->bindParam(':staffId', $staffId, PDO::PARAM_INT);
    if ($query->execute()) {
       
        header("Location: approve_reject_staff.php");
        exit();
    } else {
        // Handle the error (e.g., display an error message)
        echo "Error updating staff status.";
    }
} else {
    // Handle the case when staff ID or action is not provided in the URL
    echo "Invalid request.";
}
?>
