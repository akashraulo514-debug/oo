<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsor Registration - Ornate Occasions</title>
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

<!-- Sponsor Registration Form -->
<section class="form-section">
    <div class="container">
        <h2>Sponsor Registration</h2>
        <form action="sponsor_registration.php" method="POST">
            <div class="form-group">
                <label for="companyName">Company Name:</label>
                <input type="text" class="form-control" id="companyName" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="contactPerson">Contact Person:</label>
                <input type="text" class="form-control" id="contactPerson" name="contact_person" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="sponsorshipType">Sponsorship Type:</label>
                <select class="form-control" id="sponsorshipType" name="sponsorship_type" required>
                    <option value="Platinum">Platinum</option>
                    <option value="Gold">Gold</option>
                    <option value="Silver">Silver</option>
                    <option value="Bronze">Bronze</option>
                </select>
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
