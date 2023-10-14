<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Date and View Doctor's Time Slots</title>
    <!-- Include necessary CSS and JavaScript libraries -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function loadDatesForDoctor() {
        const selectedDoctor = document.getElementById('doctor').value;
        fetch('fetch-dates-for-doctor.php?doctor=' + selectedDoctor)
            .then(response => response.json())
            .then(data => {
                const dateDropdown = document.getElementById('selected_date');
                // Reset the date dropdown
                dateDropdown.innerHTML = '<option value="">Select a date</option>';
                for (const date of data) {
                    dateDropdown.innerHTML += '<option value="' + date + '">' + date + '</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching dates for doctor: ', error);
            });
    }

    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Select Date to View Doctor's Time Slots</h2>
        <form method="POST" action="getschedule.php">
            <div class="form-group">
                <label for="doctor">Select Doctor:</label>
                <select class="form-control" id="doctor" name="doctor" onchange="loadDatesForDoctor()">
                    <?php
                    // Assuming you have a PDO database connection in $dbh
                    $sqlDoctors = "SELECT DISTINCT FullName FROM tbldoctor";
                    $queryDoctors = $dbh->query($sqlDoctors);
                    while ($rowDoctor = $queryDoctors->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $rowDoctor['FullName'] . "'>" . $rowDoctor['FullName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="selected_date">Select Date:</label>
                <select class="form-control" id="selected_date" name="selected_date" required>
                    <option value="">Select a date</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">View Time Slots</button>
        </form>
    </div>
</body>
</html>
