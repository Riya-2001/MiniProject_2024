<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get the doctor ID from the URL
    $doctorId = $_GET['id'];

    // Perform the doctor deletion operation (you need to replace 'your_database_table_name' with your actual table name)
    $sql = "DELETE FROM tbldoctor WHERE ID = :doctorId";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':doctorId', $doctorId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Doctor deleted successfully, you can redirect or show a success message
        header("Location: delete_doctor.php"); // Redirect to the doctors list page
        exit();
    } else {
        // An error occurred during deletion, you can handle it accordingly
        echo "Error deleting doctor.";
    }
} else {
    // Invalid or missing doctor ID in the URL, handle the error
    echo "Invalid doctor ID.";
}
?>