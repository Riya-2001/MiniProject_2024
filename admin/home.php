
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>EyeLet Eye Care</title>

<!-- Fav Icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <!-- build:css assets/css/app.min.css -->
  <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
  <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/core.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- endbuild -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
  <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
<!-- Stylesheets -->
<link href="assets/css/font-awesome-all.css" rel="stylesheet">
<link href="assets/css/flaticon.css" rel="stylesheet">
<link href="assets/css/owl.css" rel="stylesheet">
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/elpath.css" rel="stylesheet">
<link href="assets/css/jquery-ui.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
        .error_form
{
top: 12px;
color: rgb(216, 15, 15);
    font-size: 15px;
font-weight:bold;
    font-family: Helvetica;
}
.goog-te-combo{
    color:#ffff;
    background-color:black;
}
</style>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">DentCare Dental Clinic Web Application</h1><br><br><hr>

<!-- //--------------------------------------BOX Starts-----------------------------------// -->
<?php

error_reporting(0);
include('includes/dbconnection.php');

  $sql = "SELECT COUNT(*) AS count FROM tbldoctor";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if (count($results) > 0) {
      $dr = $results[0]->count;
     
  }

  $sql = "SELECT COUNT(*) AS count FROM tblpatient";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if (count($results) > 0) {
      $pt = $results[0]->count;
     
  }
  

  $sql = "SELECT COUNT(*) AS count FROM tblstaff";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if (count($results) > 0) {
      $st = $results[0]->count;
     
  }

  $sql = "SELECT COUNT(*) AS count FROM tblbooking where txnid != ''";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if (count($results) > 0) {
      $paid = $results[0]->count;
     
  }

  $sql = "SELECT COUNT(*) AS count FROM tblbooking where rfnid != ''";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if (count($results) > 0) {
      $refund = $results[0]->count;
     
  }

?>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="card text-white bg-info mb-3">
                      <div class="card-body ">
                        <h5 class="card-title">Doctors</h5>
                        <p class="card-text">Total number of doctors.</p>
                        <center><a  class="btn btn-dark"><?php echo $dr; ?></a></center>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="card text-white bg-success mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Staffs</h5>
                        <p class="card-text">Total number of staffs.</p>
                        <center><a  class="btn btn-dark"><?php echo $st; ?></a></center>
                      </div>
                    </div>
                  </div>
                </div>

                <br><br>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="card text-white bg-success mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Patients</h5>
                        <p class="card-text">Headcount of total patients visited.</p>
                        <center><a  class="btn btn-dark"><?php echo $pt; ?></a></center>
                      </div>
                    </div>
                  </div>

                <br><br>

                
                    <div class="col-sm-6">
                    <div class="card text-white bg-success mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Payments</h5>
                        <p class="card-text">Total payments done using Razorpay Gateway.</p>
                        <center><a  class="btn btn-dark">Payments : <?php echo $paid; ?></a>&nbsp;<a  class="btn btn-dark">Refunds : <?php echo $refund; ?></a>&nbsp;<a  class="btn btn-dark">Total Successfull Transactions : <?php echo $paid+$refund; ?></a></center>
                      </div>
                    </div>
                  </div>
                </div>

<!-- //--------------------------------------BOX Ends-----------------------------------// -->
                   
                <br><br><br>     
                    </h1>

                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
           
