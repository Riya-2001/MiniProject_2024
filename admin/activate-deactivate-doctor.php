<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if doctor ID and action (activate or deactivate) are provided in the URL
if (isset($_GET['id']) && isset($_GET['action'])) {
    $doctorID = $_GET['id'];
    $action = $_GET['action'];

    // Define SQL query to update doctor status
    $sql = "";

    if ($action == 'activate') {
        $sql = "UPDATE tbldoctor SET Status = 'Active' WHERE ID = :id";
    } elseif ($action == 'deactivate') {
        $sql = "UPDATE tbldoctor SET Status = 'Inactive' WHERE ID = :id";
    }

    // Prepare and execute the SQL query
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $doctorID, PDO::PARAM_INT);

    if ($query->execute()) {
       
        header("Location: view_doctor.php");
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
