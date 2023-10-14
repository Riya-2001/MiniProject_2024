<?php
include('includes/dbconnection.php');

// Assuming you have a table named 'tbldoctor'
$sql = "SELECT FullName FROM tbldoctor";
$query = $dbh->prepare($sql);
$query->execute();
$doctors = $query->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($doctors);
?>
