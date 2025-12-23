<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include('php/config.php');

// Fetch stats for the dashboard
$query_vendors = "SELECT COUNT(*) as total_vendors FROM vendors";
$query_bookings = "SELECT COUNT(*) as total_bookings FROM bookings";
$query_designs = "SELECT COUNT(*) as total_designs FROM mandap_designs";
$query_feedbacks = "SELECT COUNT(*) as total_feedbacks FROM feedback"; 

$result_vendors = mysqli_query($conn, $query_vendors);
$result_bookings = mysqli_query($conn, $query_bookings);
$result_designs = mysqli_query($conn, $query_designs);
$result_feedbacks = mysqli_query($conn, $query_feedbacks);

// Check for query errors
if (!$result_vendors || !$result_bookings || !$result_designs || !$result_feedbacks) {
    die('Error in queries: ' . mysqli_error($conn));
}

$vendors = mysqli_fetch_assoc($result_vendors);
$bookings = mysqli_fetch_assoc($result_bookings);
$designs = mysqli_fetch_assoc($result_designs);
$feedbacks = mysqli_fetch_assoc($result_feedbacks);

// Fetch the latest 5 event feedbacks
$query_event_feedbacks = "SELECT name, event_experience, created_at FROM event_feedback ORDER BY created_at DESC LIMIT 5";
$result_event_feedbacks = mysqli_query($conn, $query_event_feedbacks);

// Check for query errors
if (!$result_event_feedbacks) {
    die('Error fetching event feedbacks: ' . mysqli_error($conn));
}

// Fetch the latest 5 general feedbacks
$query_general_feedbacks = "SELECT name, feedback, created_at FROM feedback ORDER BY created_at DESC LIMIT 5";
$result_general_feedbacks = mysqli_query($conn, $query_general_feedbacks);

// Check for query errors
if (!$result_general_feedbacks) {
    die('Error fetching general feedbacks: ' . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
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
        .dashboard {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }
        .overview, .actions, .notifications {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 60%;
        }
        .overview h2, .actions h2, .notifications h3 {
            margin-bottom: 15px;
            color: #ff6600;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px 0;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #cc5200;
        }
        .notifications ul {
            list-style-type: none;
            padding-left: 0;
        }
        .notifications li {
            background: #fff3e0;
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
            font-size: 14px;
        }
        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome, Admin!</h1>
    </div>

    <div class="dashboard">
        <div class="overview">
            <h2>Dashboard Overview</h2>
            <p>Total Vendors: <span><?php echo $vendors['total_vendors']; ?></span></p>
            <p>Total Bookings: <span><?php echo $bookings['total_bookings']; ?></span></p>
            <p>Total Designs: <span><?php echo $designs['total_designs']; ?></span></p>
            <p>Total Feedbacks: <span><?php echo $feedbacks['total_feedbacks']; ?></span></p>
        </div>

        <div class="actions">
            <h2>Manage Actions</h2>
            <a href="manage_users.php" class="button">Manage Users</a>
            <a href="manage_vendors.php" class="button">Manage Vendors</a>
            <a href="manage_bookings.php" class="button">Manage Bookings</a>
            <a href="manage_designs.php" class="button">Manage Designs</a>
            <a href="view_feedback.php" class="button">View Feedback</a>
            <a href="admin_settings.php" class="button">Settings</a>
        </div>

        <div class="notifications">
            <h3>Latest Event Feedbacks</h3>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result_event_feedbacks)) { ?>
                    <li>
                        <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
                        <em><?php echo $row['created_at']; ?></em><br>
                        <p><?php echo nl2br(htmlspecialchars($row['event_experience'])); ?></p>
                    </li>
                <?php } ?>
            </ul>

            <h3>Latest General Feedbacks</h3>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result_general_feedbacks)) { ?>
                    <li>
                        <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
                        <em><?php echo $row['created_at']; ?></em><br>
                        <p><?php echo nl2br(htmlspecialchars($row['feedback'])); ?></p>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Ornate Occasions | All Rights Reserved</p>
    </footer>
</body>
</html>
