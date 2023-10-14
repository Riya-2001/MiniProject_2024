<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$selectedSpecialization = $_GET['specialization']; // Get the selected specialization from the client-side

$sql = "SELECT FullName FROM tbldoctor WHERE Specialization = :specialization";
$query = $dbh->prepare($sql);
$query->bindParam(':specialization', $selectedSpecialization, PDO::PARAM_STR);
$query->execute();
$doctors = $query->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($doctors);
?>
