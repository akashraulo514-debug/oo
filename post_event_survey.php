<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post-Event Survey Form - Ornate Occasions</title>
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

<!-- Post-Event Survey Form -->
<section class="form-section">
    <div class="container">
        <h2>Post-Event Survey</h2>
        <form action="post_event_survey.php" method="POST">
            <div class="form-group">
                <label for="eventRating">Event Rating:</label>
                <select class="form-control" id="eventRating" name="event_rating" required>
                    <option value="Excellent">Excellent</option>
                    <option value="Good">Good</option>
                    <option value="Average">Average</option>
                    <option value="Poor">Poor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea class="form-control" id="feedback" name="feedback" required></textarea>
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

