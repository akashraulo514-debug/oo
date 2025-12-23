<?php
session_start();

// Initialize variables for error messages
$message = "";
$message_class = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('php/config.php');  // Include database connection file

    // Get form data and trim to avoid extra spaces
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $event_experience = trim(mysqli_real_escape_string($conn, $_POST['event_experience']));

    // Server-side validation for name
    if (empty($name)) {
        $message = "Name is required!";
        $message_class = "message";  // Error class for styling
    } elseif (strlen($name) < 3 || strlen($name) > 100) {
        $message = "Name must be between 3 and 100 characters!";
        $message_class = "message";  // Error class for styling
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $message = "Name should only contain letters and spaces!";
        $message_class = "message";  // Error class for styling
    }
    // Server-side validation for event experience
    elseif (empty($event_experience)) {
        $message = "Event experience is required!";
        $message_class = "message";  // Error class for styling
    } else {
        // Insert feedback into the event_feedback table
        $query = "INSERT INTO event_feedback (name, event_experience) VALUES ('$name', '$event_experience')";
        if (mysqli_query($conn, $query)) {
            $message = "Thank you for your feedback!";
            $message_class = "message-success";  // Success class for styling
        } else {
            $message = "There was an error submitting your feedback. Please try again.";
            $message_class = "message";  // Error class for styling
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Feedback Form - Ornate Occasions</title>
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
        .message {
            text-align: center;
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .message-success {
            background-color: #d4edda;
            color: #155724;
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

<!-- Event Feedback Form -->
<section class="form-section">
    <div class="container">
        <h2>Event Feedback</h2>
        
        <!-- Display message if any -->
        <?php if ($message != ""): ?>
            <div class="message <?php echo $message_class; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="event_feedback.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" required minlength="3" maxlength="100" pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="eventExperience">Event Experience:</label>
                <textarea class="form-control" id="eventExperience" name="event_experience" required><?php echo isset($_POST['event_experience']) ? htmlspecialchars($_POST['event_experience']) : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-custom">Submit Feedback</button>
        </form>
    </div>
</section>

<!-- Footer -->
<?php
if (file_exists("footer.php")) {
    include("footer.php");
} else {
    echo "<p>Footer file is missing. Please check the file path.</p>";
}
?>

</body>
</html>
