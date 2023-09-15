<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedule</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Add any additional CSS or JavaScript libraries here -->
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}
    .label-group {
        display: inline-block;
        margin-right: 20px; /* Adjust the margin as needed to control spacing between groups */
    }

    .label-group label {
        display: block;
        margin-bottom: 5px; /* Adjust the margin as needed to control spacing between labels within a group */
    }
header {
    background-color: #007bff;
    color: white;
    text-align: center;
    padding: 20px;
}

.main {
    margin: 20px;
}

.schedule-form {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
}

.time-slots {
    margin-top: 10px;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
    <header>
        <h2>Set Schedule for Next Day</h2>
    </header>
    <main>
        <div class="schedule-form">
            <h3>Select Date:</h3>
            <input type="date" id="date" name="date" required>
            <div class="time-slots">
                <h3>Select Time Slots:</h3>
<div class="label-group">
    <label>
                    <input type="checkbox" name="time-slot" value="9:00 AM - 9:30 AM">
                    9:00 AM - 9:30 AM
                </label>
    <label>
                    <input type="checkbox" name="time-slot" value="10:30 AM - 11:00 AM">
                    10:30 AM - 11:00 AM
                </label>
    <label>
                    <input type="checkbox" name="time-slot" value="12:00 AM - 12:30 AM">
                    12:00 AM - 12:30 AM
                </label>
</div>

<div class="label-group">
    <label>
                    <input type="checkbox" name="time-slot" value="9:30 AM - 10:00 AM">
                    9:30 AM - 10:00 AM
                </label>
                <label>
                    <input type="checkbox" name="time-slot" value="11:00 AM - 11:30 AM">
                    11:00 AM - 11:30 AM
                </label>
                <label>
                    <input type="checkbox" name="time-slot" value=" 12:30 AM - 1:00 PM">
                    12:30 AM - 1:00 PM
                </label>

</div>

<div class="label-group">
    <label>
                    <input type="checkbox" name="time-slot" value="10:00 AM - 10:30 AM">
                    10:00 AM - 10:30 AM
                </label>
                <label>
                    <input type="checkbox" name="time-slot" value="11:30 AM - 12:00 AM">
                    11:30 AM - 12:00 AM
                </label>
                <input type="checkbox" name="time-slot" value="2:00 PM - 2:30 PM">
                    2:00 PM - 2:30 PM
                </label>
                
</div>
            
            </div>
            <button onclick="submitSchedule()">Submit</button>
        </div>
    </main>
    <script src="script.js"></script>
    <!-- Add any additional scripts here -->
    <script>
        function submitSchedule() {
    const date = document.getElementById('date').value;
    const selectedTimeSlots = Array.from(document.querySelectorAll('input[name="time-slot"]:checked')).map(checkbox => checkbox.value);

    // You can now send the selected date and time slots to the server for processing
    // Example: Use fetch() or AJAX to send the data to your backend

    console.log('Selected Date:', date);
    console.log('Selected Time Slots:', selectedTimeSlots);
}
</script>
</body>
</html>
