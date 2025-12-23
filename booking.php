<?php
session_start();

// Check if a mandap design has been selected
if (isset($_GET['design'])) {
    $_SESSION['selected_design'] = $_GET['design'];
} else {
    echo "<p class='text-center text-danger'>No mandap design selected. Please go back and select a design.</p>";
    exit; // Stop execution if no design is selected
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Event - Ornate Occasions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 50px auto;
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

<div class="container">
    <div class="form-container">
        <h3 class="text-center text-success">Mandap Selected: <?php echo $_SESSION['selected_design']; ?></h3>
        <form action="finalize_booking.php" method="POST">
            <div class="form-group">
                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date" required class="form-control">
            </div>
            <div class="form-group">
                <label for="user_name">Your Name:</label>
                <input type="text" id="user_name" name="user_name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" required class="form-control">
            </div>
            <input type="hidden" name="selected_design" value="<?php echo $_SESSION['selected_design']; ?>">
            <button type="submit" class="btn btn-custom btn-block">Finalize Booking</button>
        </form>
    </div>
</div>

</body>
</html>
