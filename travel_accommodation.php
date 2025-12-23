<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel and Accommodation Form - Ornate Occasions</title>
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

<!-- Travel and Accommodation Form -->
<section class="form-section">
    <div class="container">
        <h2>Travel and Accommodation Form</h2>
        <form action="travel_accommodation.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="travelDate">Travel Date:</label>
                <input type="date" class="form-control" id="travelDate" name="travel_date" required>
            </div>
            <div class="form-group">
                <label for="returnDate">Return Date:</label>
                <input type="date" class="form-control" id="returnDate" name="return_date" required>
            </div>
            <div class="form-group">
                <label for="accommodation">Accommodation Requirements:</label>
                <textarea class="form-control" id="accommodation" name="accommodation" required></textarea>
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
