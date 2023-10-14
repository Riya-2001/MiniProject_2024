<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $available_date = $_POST['date'];
    $timeslot = $_POST['time'];
    $specialization = $_POST['specialization'];
    $doctor = $_POST['doctor'];
    $message = $_POST['message'];
    $aptnumber = mt_rand(100000000, 999999999);
    $cdate = date('Y-m-d');

    if ($appdate <= $cdate) {
        echo '<script>alert("Appointment date must be greater than today\'s date")</script>';
    } else {
        $sql = "INSERT INTO tblappointment (AppointmentNumber, AppointmentDate, AppointmentTime, Specialization, Doctor, Message, Status) VALUES (:aptnumber, :available_date, :timeslot, :specialization, :doctor, :message, 'Booked')";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aptnumber', $aptnumber, PDO::PARAM_STR);
        $query->bindParam(':appdate', $appdate, PDO::PARAM_STR);
        $query->bindParam(':apptime', $apptime, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        $query->bindParam(':doctor', $doctor, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':patient_id', $_SESSION['damsid'], PDO::PARAM_INT);
        if ($query->execute()) {
            // Insert successful
            echo '<script>alert("Your Appointment Request Has Been Sent. We Will Contact You Soon.")</script>';
            echo "<script>window.location.href ='book-appointment.php'</script>";
        } else {
            // Insert failed, display the error message
            echo '<script>alert("Error: ' . $query->errorInfo()[2] . '")</script>';
        }
        
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Style for dropdown labels */
        label {
            font-weight: bold;
        }

        /* Style for dropdown selects */
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Style for the message input */
        #message {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Style for the submit button */
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Specialization Dropdown -->
    <label for="specialization">Select Specialization:</label>
    <select id="specialization" name="specialization" onchange="loadDoctorsBySpecialization()">
        <option value="">Select a specialization</option>
        <!-- Options will be populated dynamically using JavaScript -->
    </select>

    <!-- Doctor Dropdown -->
    <label for="doctor">Select Doctor:</label>
    <select id="doctor" name="doctor" onchange="loadAvailableDates()">
        <option value="">Select a doctor</option>
        <!-- Options will be populated dynamically using JavaScript -->
    </select>

    <!-- Date Dropdown -->
    
    <label for="date">Select Date:</label>
    <select id="date" name="date" onchange="loadAvailableTimeSlots()">
        <option value="">Select a date</option>
        <!-- Options will be populated dynamically using JavaScript -->
    </select>

    <!-- Time Slot Dropdown -->
    <label for="time">Select Time Slot:</label>
    <select id="time" name="time">
        <option value="">Select a time slot</option>
        <!-- Options will be populated dynamically using JavaScript -->
    </select>

    <!-- Message Input -->
    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="4" cols="50"></textarea>

    <!-- Book Appointment Button -->
    <button type="submit" class="btn-submit" name="submit">Book Appointment</button>


<script>
// Function to populate specialization dropdown
function loadSpecializations() {
    fetch('fetch-specializations.php')
        .then(response => response.json())
        .then(data => {
            const specializationDropdown = document.getElementById('specialization');
            specializationDropdown.innerHTML = '<option value="">Select a specialization</option>';
            for (const specialization of data) {
                specializationDropdown.innerHTML += '<option value="' + specialization + '">' + specialization + '</option>';
            }
        })
        .catch(error => {
            console.error('Error fetching specializations: ', error);
        });
}

// Function to populate doctors based on selected specialization
function loadDoctorsBySpecialization() {
    const selectedSpecialization = document.getElementById('specialization').value;
    const doctorDropdown = document.getElementById('doctor');
    // Reset doctor and subsequent dropdowns
    doctorDropdown.innerHTML = '<option value="">Select a doctor</option>';
    document.getElementById('date').innerHTML = '<option value="">Select a date</option>';
    document.getElementById('time').innerHTML = '<option value="">Select a time slot</option>';

    if (selectedSpecialization) {
        fetch('fetch-doctors-by-specialization.php?specialization=' + selectedSpecialization)
            .then(response => response.json())
            .then(data => {
                for (const doctor of data) {
                    doctorDropdown.innerHTML += '<option value="' + doctor + '">' + doctor + '</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching doctors: ', error);
            });
    }
}

function loadAvailableDates() {
    const selectedDoctor = document.getElementById('doctor').value;
    const selectedSpecialization = document.getElementById('specialization').value;
    const dateDropdown = document.getElementById('date');

    // Reset date and time slot dropdowns
    dateDropdown.innerHTML = '<option value="">Select a date</option>';
    document.getElementById('time').innerHTML = '<option value="">Select a time slot</option>';

    if (selectedDoctor && selectedSpecialization) {
        // Make an AJAX request to fetch available dates
        fetch('fetch-available-dates.php?doctor=' + selectedDoctor + '&specialization=' + selectedSpecialization)
            .then(response => response.json())
            .then(data => {
                for (const date of data) {
                    dateDropdown.innerHTML += '<option value="' + date + '">' + date + '</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching available dates: ', error);
            });
    }
}

function loadAvailableTimeSlots() {
    const selectedDoctor = document.getElementById('doctor').value;
    const selectedDate = document.getElementById('date').value; // Updated variable name
    const timeSlotDropdown = document.getElementById('time');

    // Reset time slot dropdown
    timeSlotDropdown.innerHTML = '<option value="">Select a time slot</option>';

    if (selectedDoctor && selectedDate) {
        // Make an AJAX request to fetch available time slots
        fetch('fetch-available-time-slots.php?doctor=' + selectedDoctor + '&appdate=' + selectedDate) // Updated variable name
            .then(response => response.json())
            .then(data => {
                for (const apptime of data) {
                    timeSlotDropdown.innerHTML += '<option value="' + apptime + '">' + apptime + '</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching available time slots: ', error);
            });
    }
}

// Load specializations when the page loads
loadSpecializations();
</script>
</body>
</html>