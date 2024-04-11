<?php
    include 'connection.php';
    include 'count.php';
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <link href="resources/core/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="resources/core/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    
    
    
    
    
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


  

    <title>DentCare - Admin</title>

    <!-- Custom fonts for this template -->
    <link rel="icon" href="../resources/images/covid-logo.png" type="image/icon type">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<div class="modal fade in " id="pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 9999">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="card ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>

                <div class="header  header-navy text-center ">
                    <h4 class="card-title"></h4>

                </div>
            </div>
            <div class="modal-body">
                <div id="pdfView"></div>
            </div>
        </div>
    </div>
</div>
</div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DentCare  Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item"> 
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Homepage</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Services
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fab fa-redhat"></i>
                    <span>Doctors </span><span class="badge badge-pill badge-info"><?php echo $count3; ?></span></a>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Services</h6>
                        <a class="collapse-item" href="adddoctor.php">Add Doctor</a>
                        <a class="collapse-item" href="viewdoctor.php">View Doctors <span class="badge badge-pill badge-info"><?php echo $count3; ?></span></a></a>
                    </div>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-h-square" aria-hidden="true"></i>
                    <span>Staff</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Services</h6>
                        <a class="collapse-item" href="addstaff.php">Add Staff</a>
                        <a class="collapse-item" href="viewstaff.php">View Staffs</a>
                       <!--  <a class="collapse-item" href="utilities-other.html">Assign Applications</a> -->
                    </div>
                </div>
            </li> 

           <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities12"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-bed" aria-hidden="true"></i>
                    <span>Beds</span>
                </a>
                <div id="collapseUtilities12" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Services</h6>
                       
                        <a class="collapse-item" href="viewbed.php">View Bed</a>
                       
                    </div>
                </div>
            </li> -->

            

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiess"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-file-pdf"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseUtilitiess" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tools</h6>
                        <a class="collapse-item" href="fpdf/todoctorpdf.php" target="_blank">Doctor Details</a>
                        <a class="collapse-item" href="fpdf/tostaffpdf.php" target="_blank">Staff Details</a>
                        <!-- <a class="collapse-item" href="viewlogs.php">Login Logs</a> -->
                        
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiessss"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-book"></i>
                    <span>Leave </span><span class="badge badge-pill badge-info"><?php echo $count1+$count2; ?></span>
                </a>
                <div id="collapseUtilitiessss" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions </h6>
                        <a class="collapse-item" href="addleaves.php" >Add Leaves</a>
                        <a class="collapse-item" href="viewdoctorleaves.php" >Doctor Leaves <span class="badge badge-pill badge-info"><?php echo $count1; ?></span></a>
                        <a class="collapse-item" href="viewstaffleaves.php" >Staff Leaves <span class="badge badge-pill badge-info"><?php echo $count2; ?></span> </a>
                        <!-- <a class="collapse-item" href="fpdf/tostaffpdf.php" target="_blank">Staff Details</a> -->
                        <!-- <a class="collapse-item" href="viewlogs.php">Login Logs</a> -->
                        
                    </div>
                </div>
            </li> 



            <li class="nav-item">
                <a class="nav-link" href="viewfeedback.php">
                     <i class="fas fa-comments text-gray-400"></i>
                    <span>Feedback</span></a> 
                <hr class="sidebar-divider">
                <a class="nav-link" href="logout.php">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span>Logout</span></a>
            </li>

                 


            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
<h3>DentCare | 2023</h1>

                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>





                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">DentCare Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
