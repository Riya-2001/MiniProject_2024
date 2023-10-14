<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $appdate = $_POST['date'];
    $apptime = $_POST['time'];
    $specialization = $_POST['specialization'];
    $doctorlist = $_POST['doctorlist'];
    $message = $_POST['message'];
    $aptnumber = mt_rand(100000000, 999999999);
    $cdate = date('Y-m-d');

    if ($appdate <= $cdate) {
        echo '<script>alert("Appointment date must be greater than today\'s date")</script>';
    } else {
        $sql = "INSERT INTO tblappointment (AppointmentNumber, AppointmentDate, AppointmentTime, Specialization, Doctor, Message, Status, PatientID) VALUES (:aptnumber, :appdate, :apptime, :specialization, :doctorlist, :message, 'Booked', :patient_id)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aptnumber', $aptnumber, PDO::PARAM_STR);
        $query->bindParam(':appdate', $appdate, PDO::PARAM_STR);
        $query->bindParam(':apptime', $apptime, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        $query->bindParam(':doctorlist', $doctorlist, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':patient_id', $_SESSION['damsid'], PDO::PARAM_INT);

        if ($query->execute()) {
            echo '<script>alert("Your Appointment Request Has Been Sent. We Will Contact You Soon.")</script>';
            echo "<script>window.location.href ='book-appointment.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Doctor Appointment Management System || Home Page</title>
    <!-- CSS FILES -->
    <style>
        /* Style for the form container */
        .booking-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Style for form inputs and labels */
        .form-control {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        label {
            font-weight: bold;
        }

        /* Style for the "Book Now" button */
        #submit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #submit-button:hover {
            background-color: #0056b3;
        }

        /* Add more CSS rules to style your form as needed */

    </style>
    
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
    <script>
        Breakpoints();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function getdoctors(val) {
            $.ajax({
                type: "POST",
                url: "get_doctors.php",
                data: 'sp_id=' + val,
                success: function (data) {
                    $("#doctorlist").html(data);
                }
            });
        }
    </script>
</head>

<body id="top" class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <div class="booking-form">
            <section class="app-content">
                <div class="row">
                    <!-- DOM dataTable -->
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                            </header><!-- .widget-header -->
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <h2 class="text-center mb-lg-3 mb-2">Book an appointment</h2>
                                <form role="form" method="post">
                                    <div class="col-lg-6 col-12">
                                        <input type="date" name="date" id="date" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <input type="time" name="time" id="time" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <select onChange="getdoctors(this.value);" name="specialization" id="specialization"
                                                class="form-control" required>
                                            <option value="">Select specialization</option>
                                            <!--- Fetching States--->
                                            <?php
                                            $sql = "SELECT * FROM tblspecialization";
                                            $stmt = $dbh->query($sql);
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch()) { ?>
                                                <option value="<?php echo $row['Specialization']; ?>"><?php echo $row['Specialization']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <select name="doctorlist" id="doctorlist" class="form-control">
                                            <option value="">Select Doctor</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" rows="5" id="message" name="message"
                                                  placeholder="Additional Message"></textarea>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12"> <!-- Corrected class definition -->
    <button type="submit" class="form-control" name="submit" id="submit-button">
        Book Now
    </button>
</div>
                                </form>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div><!-- .row -->
            </section><!-- .app-content -->
        </div><!-- .wrap -->
        <!-- APP FOOTER -->
        <?php include_once('includes/footer.php');?>
        <!-- /#app-footer -->
    </div>
</main>
<!--========== END app main -->

<!-- APP CUSTOMIZER -->
<?php include_once('includes/customizer.php');?>

<!-- JAVASCRIPT FILES -->
<script src="libs/bower/jquery/dist/jquery.js"></script>
<script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="libs/bower/PACE/pace.min.js"></script>
<!-- endbuild -->

<!-- build:js assets/js/app.min.js -->
<script src="assets/js/library.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/app.js"></script>
<!-- endbuild -->
<script src="libs/bower/moment/moment.js"></script>
<script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="assets/js/fullcalendar.js"></script>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/scrollspy.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
