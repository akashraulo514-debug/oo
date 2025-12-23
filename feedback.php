<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

include('php/config.php');

// Fetch feedback based on user role
if ($_SESSION['role'] == 'customer') {
    // If the user is a customer, show their feedback
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session
    $query_feedback = "SELECT feedback.message, feedback.created_at
                       FROM feedback 
                       WHERE feedback.user_id = $user_id
                       ORDER BY feedback.created_at DESC";
} elseif ($_SESSION['role'] == 'vendor') {
    // If the user is a vendor, show feedback related to their designs
    $vendor_id = $_SESSION['user_id']; // Assuming vendor ID is stored in session
    $query_feedback = "SELECT feedback.message, feedback.created_at, mandap_designs.title AS design_name
                       FROM feedback 
                       JOIN mandap_designs ON feedback.design_id = mandap_designs.id
                       WHERE mandap_designs.vendor_id = $vendor_id
                       ORDER BY feedback.created_at DESC";
} else {
    // If the user is an admin, show all feedback
    $query_feedback = "SELECT feedback.message, feedback.created_at, users.name AS customer_name
                       FROM feedback
                       JOIN users ON feedback.user_id = users.id
                       ORDER BY feedback.created_at DESC";
}

$result_feedback = mysqli_query($conn, $query_feedback);

if (!$result_feedback) {
    die("Error fetching feedback: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your styling here */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
        }
        .feedback-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #ff6600;
            color: white;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #cc5200;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Your Feedback</h1>
        <a href="dashboard.php" class="button">Back to Dashboard</a>
    </div>

    <div class="feedback-section">
        <h2>All Feedback</h2>

        <table>
            <tr>
                <th>Feedback</th>
                <th>Submitted On</th>
                <?php if ($_SESSION['role'] == 'vendor') { ?>
                <th>Design</th>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                <th>Customer</th>
                <?php } ?>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result_feedback)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['message']); ?></td>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                <?php if ($_SESSION['role'] == 'vendor') { ?>
                <td><?php echo htmlspecialchars($row['design_name']); ?></td>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>
