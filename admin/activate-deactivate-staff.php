<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if staff ID and action (activate or deactivate) are provided in the URL
if (isset($_GET['id']) && isset($_GET['action'])) {
    $staffID = $_GET['id'];
    $action = $_GET['action'];

    // Define SQL query to update staff status
    $sql = "";

    if ($action == 'activate') {
        $sql = "UPDATE tblstaff SET Status = 'Active' WHERE ID = :id";
    } elseif ($action == 'deactivate') {
        $sql = "UPDATE tblstaff SET Status = 'Inactive' WHERE ID = :id";
    }

    // Prepare and execute the SQL query
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $staffID, PDO::PARAM_INT);

    if ($query->execute()) {
        // Redirect back to staff.php after the update
        header("Location: view_staff.php");
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
