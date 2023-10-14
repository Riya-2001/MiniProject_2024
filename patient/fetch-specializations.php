<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$sql = "SELECT DISTINCT Specialization FROM tbldoctor";
$query = $dbh->prepare($sql);
$query->execute();
$specializations = $query->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($specializations);
?>
