<?php
session_start();
include('php/config.php'); // Database connection

// Ensure the vendor is logged in
if (!isset($_SESSION['vendor_id'])) {
    echo "You must be logged in to view bookings.";
    exit();
}

$vendor_id = $_SESSION['vendor_id'];

// Fetch bookings for the logged-in vendor
$query = "SELECT bookings.id, bookings.customer_name, bookings.date, bookings.status, mandap_designs.design_name 
          FROM bookings 
          JOIN mandap_designs ON bookings.design_id = mandap_designs.id 
          WHERE bookings.vendor_id = '$vendor_id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error fetching bookings: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="style.css"> 
    <style>body {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 0;
}

h1 {
    text-align: center;
}

table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background-color: #f4f4f4;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
    color: #ff6600;
}

a:hover {
    color: #ff4500;
}
</style>
</head>
<body>
    <h1>Bookings for Your Designs</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Customer Name</th>
                <th>Design</th>
                <th>Booking Date</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['design_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>

    <a href="vendor_dashboard.php">Back to Dashboard</a>
</body>
</html>
