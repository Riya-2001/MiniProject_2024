<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>DentCare - Add Doctor Schedule</title>
  
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
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 10px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .time-slots label {
            display: inline-block;
            margin-right: 10px;
        }
        .btn-submit {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>
<main id="app-main" class="app-main">
  <div class="wrap">
  <section class="app-content">
    <div class="row">
     
      <div class="col-md-12">
        <div class="widget">
          <header class="widget-header">
            <h3 class="widget-title">Set Your Schedule</h3>
          </header><!-- .widget-header -->
          <hr class="widget-separator">
          <div class="widget-body">
    
		  <form class="form-horizontal" method="post" id="scheduleForm">
            <div class="form-group">
                <label for="availdate">Select Date:</label>
                <input type="date" id="availdate" name="availdate" required>
            </div>
            <div class="form-group">
                <label>Select Time Slots:</label><br>
                <div class="time-slots">
                    <label><input type="checkbox" name="timeslot[]" value="9am-9.30am"> 9am-9.30am</label>
                    <label><input type="checkbox" name="timeslot[]" value="9.30am-10am"> 9.30am-10am</label>
                    <label><input type="checkbox" name="timeslot[]" value="10am-10.30am"> 10am-10.30am</label>
					<label><input type="checkbox" name="timeslot[]" value="10.30am-11.00am"> 10.30am-11.00am</label>
					<label><input type="checkbox" name="timeslot[]" value="11am-11.30am"> 11am-11.30am</label>
					<label><input type="checkbox" name="timeslot[]" value="11.30am-12.00am"> 11.30am-12.00am</label>
                    <!-- Add more time slots as needed -->
                </div>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
			</form>
          </div><!-- .widget-body -->
        </div><!-- .widget -->
      </div><!-- END column -->

    </div><!-- .row -->
  </section><!-- #dash-content -->
</div><!-- .wrap -->
  <!-- APP FOOTER -->
  <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>

    <script>
        // JavaScript to handle form submission
        document.getElementById("scheduleForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting normally
            
            // Get selected date and time slots
            var selectedDate = document.getElementById("availdate").value;
            var selectedTimeSlots = [];
            var checkboxes = document.querySelectorAll('input[name="timeslot[]"]:checked');
            checkboxes.forEach(function(checkbox) {
                selectedTimeSlots.push(checkbox.value);
            });

            // You can now send the selectedDate and selectedTimeSlots to the server via AJAX or perform any other actions.

            // For example, displaying them in an alert for testing:
            alert("Selected Date: " + selectedDate + "\nSelected Time Slots: " + selectedTimeSlots.join(", "));
        });
    </script>
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
</body>
</html>
