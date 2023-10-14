<?php
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $selectedDoctor = $_SESSION['damsid'];

    // Assuming you have a PDO database connection in $dbh
    $sql = "SELECT DISTINCT Available_date FROM tblschedule WHERE Doctor_id = :selectedDoctor";
    $query = $dbh->prepare($sql);
    $query->bindParam(':selectedDoctor', $selectedDoctor, PDO::PARAM_STR);
    $query->execute();

    $dates = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $dates[] = $row['Available_date'];
    }

    header('Content-Type: application/json');
    echo json_encode($dates);
}
?>
