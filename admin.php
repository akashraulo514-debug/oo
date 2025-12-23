<?php
// Include the database connection
include("php/config.php");

// Admin details
$admin_name = 'Admin';
$admin_email = 'ornateoccasions83@gmail.com';
$admin_password = 'admin_password'; // Plaintext password
$admin_role = 'admin'; // Admin role

// Hash the admin password securely using BCRYPT
$hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

// SQL query to insert admin into Users table
$sql = "INSERT INTO Users (name, email, password, role) 
        VALUES ('$admin_name', '$admin_email', '$hashed_password', '$admin_role')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>

