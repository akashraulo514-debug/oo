<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include('php/config.php');

if (isset($_GET['vendor_id'])) {
    $vendor_id = intval($_GET['vendor_id']);
    
    // Prepared statement for fetching vendor details
    $query = "SELECT * FROM vendors WHERE vendor_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $vendor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $vendor = mysqli_fetch_assoc($result);
    
    if (!$vendor) {
        echo "Vendor not found.";
        exit();
    }
} else {
    echo "Invalid vendor ID.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Validate name: Only letters and spaces are allowed
    if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        echo "Invalid name format. Only letters and spaces are allowed.";
        exit();
    }

    // Basic validation for email and phone
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }
    if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
        echo "Invalid phone number format.";
        exit();
    }

    // Prepared statement for updating vendor
    $update_query = "UPDATE vendors SET name=?, email=?, phone=?, status=? WHERE vendor_id=?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $phone, $status, $vendor_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_vendors.php?message=Vendor updated successfully");
        exit();
    } else {
        echo "Error updating vendor: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vendor</title>
    
    <style>
    .container {
        width: 80%;
        margin: auto;
        text-align: center;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Form Styling */
    form {
        display: grid;
        grid-template-columns: 1fr;
        gap: 15px;
        max-width: 600px;
        margin: 0 auto;
        text-align: left;
    }

    /* Form Inputs */
    input[type="text"],
    input[type="email"],
    input[type="submit"],
    select {
        width: 100%;
        padding: 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 16px;
        margin: 8px 0;
    }

    input[type="submit"] {
        background-color: #e74c3c;
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #c0392b;
    }

    /* Labels */
    label {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    /* Status Dropdown */
    select {
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 12px;
        border-radius: 5px;
    }

    /* Button Style */
    .btn {
        display: inline-block;
        padding: 10px 15px;
        margin: 5px;
        text-decoration: none;
        border-radius: 5px;
        background-color:#c0392b;
        color: white;
        font-size: 14px;
    }

    .btn:hover {
        background-color:#c0392b ;
    }

    /* Footer Styling */
    footer {
        text-align: center;
        padding: 10px;
        margin-top: 20px;
        background-color: #f4f4f4;
        border-top: 1px solid #ddd;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 90%;
        }
        
        form {
            grid-template-columns: 1fr;
        }
    }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Vendor</h1>

        <form action="" method="POST">
            <label for="name">Vendor Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($vendor['name']); ?>" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($vendor['email']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($vendor['phone']); ?>" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="active" <?php if ($vendor['status'] == 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($vendor['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>

            <input type="submit" value="Update Vendor">
        </form>

        <a href="manage_vendors.php" class="btn">Back to Vendors</a>
    </div>

</body>
</html>
