<?php
session_start();
include('php/config.php'); // Database connection

// Ensure the vendor is logged in
if (!isset($_SESSION['vendor_id'])) {
    echo "You must be logged in to view your profile.";
    exit();
}

$vendor_id = $_SESSION['vendor_id'];

// Fetch vendor information
$query = "SELECT vendor_name, business_name, contact_person, email, phone, address, business_type FROM vendors WHERE vendor_id = '$vendor_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error fetching vendor profile: " . mysqli_error($conn);
    exit();
}

$vendor = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Vendor Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        .profile-container {
            width: 400px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .profile-container p {
            padding: 8px 10px;
            background-color: #f1f1f1;
            margin: 10px 0;
            border-radius: 5px;
        }

        .profile-container a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #ff6600;
        }

        .profile-container a:hover {
            color: #ff4500;
        }
    </style>
</head>
<body>
    <h1>View Your Profile</h1>

    <div class="profile-container">
        <label for="vendor_name">Vendor Name:</label>
        <p><?php echo htmlspecialchars($vendor['vendor_name']); ?></p>

        <label for="business_name">Business Name:</label>
        <p><?php echo htmlspecialchars($vendor['business_name']); ?></p>

        <label for="contact_person">Contact Person:</label>
        <p><?php echo htmlspecialchars($vendor['contact_person']); ?></p>

        <label for="email">Email:</label>
        <p><?php echo htmlspecialchars($vendor['email']); ?></p>

        <label for="phone">Phone:</label>
        <p><?php echo htmlspecialchars($vendor['phone']); ?></p>

        <label for="address">Address:</label>
        <p><?php echo htmlspecialchars($vendor['address']); ?></p>

        <label for="business_type">Business Type:</label>
        <p><?php echo htmlspecialchars($vendor['business_type']); ?></p>

        <a href="update_profile.php">Update Profile</a>
    </div>

</body>
</html>
