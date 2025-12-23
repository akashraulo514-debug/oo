
<?php
session_start();
include('php/config.php'); // Database connection

// Ensure the vendor is logged in
if (!isset($_SESSION['vendor_id'])) {
    echo "You must be logged in to update your profile.";
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

// If the form is submitted, update the profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $vendor_name = mysqli_real_escape_string($conn, $_POST['vendor_name']);
    $business_name = mysqli_real_escape_string($conn, $_POST['business_name']);
    $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $business_type = mysqli_real_escape_string($conn, $_POST['business_type']);

    // Validate the vendor name (must contain only letters and spaces)
    if (empty($vendor_name) || !preg_match("/^[a-zA-Z\s]+$/", $vendor_name)) {
        echo "Invalid vendor name. It should only contain alphabetic characters.";
        exit();
    }

    // Check if all necessary fields are provided
    if (empty($business_name) || empty($contact_person) || empty($email) || empty($phone) || empty($address) || empty($business_type)) {
        echo "All fields are required.";
        exit();
    }

    // Update vendor profile in the database
    $update_query = "UPDATE vendors SET 
                        vendor_name = '$vendor_name',
                        business_name = '$business_name', 
                        contact_person = '$contact_person', 
                        email = '$email', 
                        phone = '$phone', 
                        address = '$address',
                        business_type = '$business_type' 
                     WHERE vendor_id = '$vendor_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "Profile updated successfully.";
        header("Location: vendor_dashboard.php"); // Redirect to dashboard after update
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vendor Profile</title>
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

        form {
            width: 400px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            background-color: #ff6600;
            color: white;
            cursor: pointer;
            border: none;
        }

        form input[type="submit"]:hover {
            background-color: #ff4500;
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

    <script>
        // Client-side validation for vendor name (only alphabetic and spaces)
        function validateForm() {
            var vendorName = document.forms["updateProfileForm"]["vendor_name"].value;
            var nameRegex = /^[a-zA-Z\s]+$/;

            // Check if name is empty or contains non-alphabetic characters
            if (vendorName == "" || !nameRegex.test(vendorName)) {
                alert("Please enter a valid vendor name. It should contain only alphabetic characters.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Update Your Profile</h1>

    <form name="updateProfileForm" action="update_profile.php" method="POST" onsubmit="return validateForm()">
        <label for="vendor_name">Vendor Name:</label>
        <input type="text" name="vendor_name" value="<?php echo htmlspecialchars($vendor['vendor_name']); ?>" required><br>

        <label for="business_name">Business Name:</label>
        <input type="text" name="business_name" value="<?php echo htmlspecialchars($vendor['business_name']); ?>" required><br>

        <label for="contact_person">Contact Person:</label>
        <input type="text" name="contact_person" value="<?php echo htmlspecialchars($vendor['contact_person']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($vendor['email']); ?>" required><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($vendor['phone']); ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($vendor['address']); ?>" required><br>

        <label for="business_type">Business Type:</label>
        <input type="text" name="business_type" value="<?php echo htmlspecialchars($vendor['business_type']); ?>" required><br>

        <input type="submit" value="Update Profile">
    </form>

    <a href="vendor_dashboard.php">Back to Dashboard</a>
</body>
</html>
