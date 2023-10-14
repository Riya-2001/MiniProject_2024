<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');


$selectedDoctor = $_GET['doctor'];

$sql = "SELECT Available_date FROM tblschedule WHERE DoctorId = :selectedDoctor";
$query = $dbh->prepare($sql);   
$query->bindParam(':selectedDoctor', $selectedDoctor, PDO::PARAM_STR);
$query->execute();
$dates = $query->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($dates);
?>

