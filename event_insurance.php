<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Insurance Form - Ornate Occasions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-section {
            padding: 60px 0;
        }
        .form-section h2 {
            color: #ff6b6b;
            text-align: center;
        }
        .btn-custom {
            background-color: #ff6b6b;
            color: white;
        }
        .btn-custom:hover {
            background-color: #e63900;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<?php
if (file_exists("navbar.php")) {
    include("navbar.php");
} else {
    echo "<p>Navbar file is missing. Please check the file path.</p>";
}
?>

<!-- Event Insurance Form -->
<section class="form-section">
    <div class="container">
        <h2>Event Insurance Form</h2>
        <form action="event_insurance.php" method="POST">
            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" class="form-control" id="eventName" name="event_name" required>
            </div>
            <div class="form-group">
                <label for="eventDate">Event Date:</label>
                <input type="date" class="form-control" id="eventDate" name="event_date" required>
            </div>
            <div class="form-group">
                <label for="insuranceType">Insurance Type:</label>
                <select class="form-control" id="insuranceType" name="insurance_type" required>
                    <option value="General Liability">General Liability</option>
                    <option value="Event Cancellation">Event Cancellation</option>
                    <option value="Property Damage">Property Damage</option>
                </select>
            </div>
            <div class="form-group">
                <label for="insuredAmount">Insured Amount:</label>
                <input type="number" class="form-control" id="insuredAmount" name="insured_amount" required>
            </div>
            <button type="submit" class="btn btn-custom">Submit</button>
        </form>
    </div>
</section>
</body>
</html>

<!-- Footer -->
<?php
if (file_exists("footer.php")) {
    include("footer.php");
} else {
    echo "<p>Footer file is missing. Please check the file path.</p>";
}
