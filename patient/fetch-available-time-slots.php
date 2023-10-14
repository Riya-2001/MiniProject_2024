

<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$selectedDoctor = $_GET['doctor'];
$selectedDate = $_GET['date'];

$sql = "SELECT Timeslot FROM tblschedule WHERE DoctorId = :selectedDoctor AND Available_date = :selectedDate";
$query = $dbh->prepare($sql);
$query->bindParam(':selectedDoctor', $selectedDoctor, PDO::PARAM_STR);
$query->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
$query->execute();
$timeSlots = $query->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($timeSlots);
?>
