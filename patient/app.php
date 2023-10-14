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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking Form</title>
</head>
<body>
    <h1>Appointment Booking Form</h1>
    <form id="appointment-form" action="process.php" method="post">
        <label for="specialization">Specialization:</label>
        <select id="specialization" name="specialization">
            <option value="">Select Specialization</option>
            <option value="cardiology">Cardiology</option>
            <option value="dermatology">Dermatology</option>
            <!-- Add more specialization options -->
        </select>

        <label for="doctor">Doctor:</label>
        <select id="doctor" name="doctor">
            <option value="">Select Doctor</option>
            <!-- Doctor options will be populated dynamically using JavaScript -->
        </select>

        <label for="date">Date:</label>
        <select id="date" name="date">
            <option value="">Select Date</option>
            <!-- Date options will be populated dynamically using JavaScript -->
        </select>

        <label for="time">Time:</label>
        <select id="time" name="time">
            <option value="">Select Time</option>
            <!-- Time options will be populated dynamically using JavaScript -->
        </select>

        <label for="patient_name">Patient Name:</label>
        <input type="text" id="patient_name" name="patient_name" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message"></textarea>

        <input type="hidden" name="status" value="Pending">

        <button type="submit">Submit Appointment</button>
    </form>
<script>

document.addEventListener("DOMContentLoaded", function () {
    const specializationSelect = document.getElementById("specialization");
    const doctorSelect = document.getElementById("doctor");
    const dateSelect = document.getElementById("date");
    const timeSelect = document.getElementById("time");

    // Define available doctors and their schedules
    const doctorsBySpecialization = {
        cardiology: {
            "Dr. Smith": ["2023-09-22", "2023-09-25"],
            "Dr. Johnson": ["2023-09-24", "2023-09-27"]
        },
        dermatology: {
            "Dr. Brown": ["2023-09-23", "2023-09-26"],
            "Dr. Davis": ["2023-09-25", "2023-09-28"]
        }
        // Add more doctors and schedules as needed
    };

    specializationSelect.addEventListener("change", function () {
        const selectedSpecialization = specializationSelect.value;
        const doctors = doctorsBySpecialization[selectedSpecialization];

        // Clear doctor, date, and time options
        doctorSelect.innerHTML = "<option value=''>Select Doctor</option>";
        dateSelect.innerHTML = "<option value=''>Select Date</option>";
        timeSelect.innerHTML = "<option value=''>Select Time</option>";

        if (selectedSpecialization) {
            // Populate the doctor select options
            for (const doctor in doctors) {
                const option = document.createElement("option");
                option.value = doctor;
                option.textContent = doctor;
                doctorSelect.appendChild(option);
            }
        }
    });

    doctorSelect.addEventListener("change", function () {
        const selectedSpecialization = specializationSelect.value;
        const selectedDoctor = doctorSelect.value;
        const doctorSchedules = doctorsBySpecialization[selectedSpecialization][selectedDoctor];

        // Clear date and time options
        dateSelect.innerHTML = "<option value=''>Select Date</option>";
        timeSelect.innerHTML = "<option value=''>Select Time</option>";

        if (selectedDoctor) {
            // Populate the date select options
            for (const date of doctorSchedules) {
                const option = document.createElement("option");
                option.value = date;
                option.textContent = date;
                dateSelect.appendChild(option);
            }
        }
    });

    dateSelect.addEventListener("change", function () {
        const selectedDate = dateSelect.value;

        // Clear time options
        timeSelect.innerHTML = "<option value=''>Select Time</option>";

        if (selectedDate) {
            // You can populate the time options here based on the selected date.
            // You may need to fetch available time slots from a server.
            // For simplicity, I'm leaving this part for you to implement.
        }
    });
});
</script>
</body>
</html>