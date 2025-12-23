<?php
session_start();

// Check if the vendor is logged in
if (!isset($_SESSION['vendor_id'])) {
    header("Location: vendor_login.php");
    exit();
}

$vendor_id = $_SESSION['vendor_id'];  // Get the vendor ID from session
$vendor_name = $_SESSION['vendor_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
  
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 0; }
        .main-content { width: 100%; padding: 30px; max-width: 900px; margin: 0 auto; }
        .main-content h1 { font-size: 36px; text-align: center; margin-bottom: 20px; color: #444; }
        .dashboard-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
        .action-box { background-color: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px; text-align: center; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .action-box:hover { transform: translateY(-5px); box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); }
        .action-box h3 { font-size: 24px; margin-bottom: 15px; color: #555; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #e74c3c; color: #fff; text-decoration: none; border-radius: 5px; font-size: 16px; transition: background-color 0.3s ease, transform 0.2s ease; }
        .btn:hover { background-color: #c0392b; transform: scale(1.05); }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome, <?php echo htmlspecialchars($vendor_name); ?>!</h1>
    </div>
    <div class="container">
        <h2>Your Dashboard</h2>
        <div class="dashboard-actions">
            <div class="action-box">
                <h3>Manage Bookings</h3>
                <a href="view_bookings.php" class="btn">View Details</a>
            </div>
            <div class="action-box">
                <h3>View Profile</h3>
                <a href="view_profile.php" class="btn">View Profile</a>
            </div>
            <div class="action-box">
                <h3>Update Profile</h3>
                <a href="update_profile.php" class="btn">Edit Profile</a>
            </div>
            <div class="action-box">
                <h3>Upload Mandap Design</h3>
                <a href="upload_mandap.php" class="btn">Upload Design</a>
            </div>
            <div class="action-box">
                <h3>Vendor Inventory</h3>
                <a href="manage_inventory.php" class="btn">Manage Inventory</a>
            </div>
            <div class="action-box">
                <h3>Logout</h3>
                <a href="logout.php" class="btn">Log Out</a>
            </div>
        </div>
    </div>
</body>
</html>
