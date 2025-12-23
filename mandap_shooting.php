<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandap for Shooting - Ornate Occasions</title>
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

<!-- Mandap for Shooting Form -->
<section class="form-section">
    <div class="container">
        <h2>Mandap for Shooting</h2>
        <form action="mandap_submission.php" method="POST">
            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" class="form-control" id="eventName" name="event_name" required>
            </div>
            <div class="form-group">
                <label for="date">Event Date:</label>
                <input type="date" class="form-control" id="date" name="event_date" required>
            </div>
            <div class="form-group">
                <label for="contactPerson">Contact Person:</label>
                <input type="text" class="form-control" id="contactPerson" name="contact_person" required>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" class="form-control" id="contactNumber" name="contact_number" required>
            </div>
            <div class="form-group">
                <label for="specialRequests">Special Requests:</label>
                <textarea class="form-control" id="specialRequests" name="special_requests"></textarea>
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

