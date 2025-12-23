<?php
// Start the session and check if the user is an admin
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection
include('php/config.php');

// Fetch admin settings if needed, e.g. email settings, preferences, etc.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="style.css">
    <style>
/* Reset default styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* General Body Styling */
body {
    background-color: #f4f4f4;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

/* Main Container */
.container {
    width: 90%;
    max-width: 800px;
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Headings */
h1 {
    font-size: 28px;
    color: #ff6600;
    margin-bottom: 15px;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

label {
    font-weight: 600;
    text-align: left;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

/* Button Styling */
input[type="submit"] {
    background-color: #ff6600;
    color: white;
    border: none;
    padding: 12px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 5px;
    transition: background 0.3s;
}

input[type="submit"]:hover {
    background-color: #ff4500;
}

/* Success Message */
.success-message {
    color: green;
    font-size: 16px;
    text-align: center;
    margin-bottom: 10px;
}

/* Footer */
footer {
    margin-top: 20px;
    text-align: center;
    font-size: 14px;
    color: #666;
}

</style>
</head>
<body>
    <h1>Admin Settings</h1>

    <!-- Settings form for updating settings -->
    <form action="save_settings.php" method="POST">
        <label for="site_name">Site Name:</label>
        <input type="text" name="site_name" id="site_name">
        <br>

        <label for="email">Admin Email:</label>
        <input type="email" name="email" id="email">
        <br>

        <input type="submit" value="Save Settings" class="button">
    </form>

    <a href="admin_dashboard.php" class="button">Back to Dashboard</a>
</body>
</html>
