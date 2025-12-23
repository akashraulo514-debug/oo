<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health and Safety Form - Ornate Occasions</title>
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

<!-- Health and Safety Form -->
<section class="form-section">
    <div class="container">
        <h2>Health and Safety Form</h2>
        <form action="health_safety.php" method="POST">
            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" class="form-control" id="eventName" name="event_name" required>
            </div>
            <div class="form-group">
                <label for="contactPerson">Contact Person:</label>
                <input type="text" class="form-control" id="contactPerson" name="contact_person" required>
            </div>
            <div class="form-group">
                <label for="emergencyContact">Emergency Contact Number:</label>
                <input type="tel" class="form-control" id="emergencyContact" name="emergency_contact" required>
            </div>
            <div class="form-group">
                <label for="healthPrecautions">Health and Safety Precautions:</label>
                <textarea class="form-control" id="healthPrecautions" name="health_precautions" required></textarea>
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

