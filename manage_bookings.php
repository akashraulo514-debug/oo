<?php
// Start the session and check if the user is an admin
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Connect to the database
include('php/config.php');

// Fetch all bookings
$query = "SELECT bookings.id, users.name AS customer_name, mandap_designs.title AS design_name, 
                 bookings.date, bookings.status 
          FROM bookings 
          JOIN users ON bookings.user_id = users.id 
          JOIN mandap_designs ON bookings.mandap_id = mandap_designs.id 
          ORDER BY bookings.date DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching bookings: " . mysqli_error($conn));
}

// Handle status update
if (isset($_POST['update_status'])) {
    $booking_id = intval($_POST['booking_id']);
    $new_status = $_POST['status'];

    $update_query = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "si", $new_status, $booking_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_bookings.php?message=Booking updated successfully");
        exit();
    } else {
        echo "Error updating booking: " . mysqli_error($conn);
    }
}

// Handle booking deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_bookings.php?message=Booking deleted successfully");
        exit();
    } else {
        echo "Error deleting booking: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #ff6600;
        }
        .container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #ff6600;
            color: white;
        }
        select {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .update-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .update-btn:hover {
            background-color: #218838;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .back-btn:hover {
            background-color: #cc5500;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Manage Bookings</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Mandap Design</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($row['design_name']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                        <select name="status">
                            <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Confirmed" <?php if ($row['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                            <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                        <button type="submit" name="update_status" class="update-btn">Update</button>
                    </form>
                </td>
                <td>
                    <a href="manage_bookings.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>

</body>
</html>
