<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the form is submitted
if (isset($_POST['selected_date']) && isset($_POST['doctor'])) {
    $selectedDate = $_POST['selected_date'];
    $selectedDoctor = $_POST['doctor'];

    // Assuming you have a PDO database connection in $dbh
    $sql = "SELECT * FROM tblschedule WHERE scheduleDate = :selectedDate AND DoctorName = :selectedDoctor";
    $query = $dbh->prepare($sql);
    $query->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
    $query->bindParam(':selectedDoctor', $selectedDoctor, PDO::PARAM_STR);
    $query->execute();

    // Check if any time slots are available for the selected day and doctor
    if ($query->rowCount() > 0) {
        echo '<h2>Available Time Slots</h2>';
        echo '<ul>';
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<li>' . $row['startTime'] . ' - ' . $row['endTime'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No available time slots for the selected day and doctor.</p>';
    }
} else {
    // Handle the case where the form was not submitted properly
    echo '<p>Form not submitted correctly.</p>';
}
?>
