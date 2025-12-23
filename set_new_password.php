<?php
// Include database connection
include("php/config.php");

// Start the session
session_start();

// Check if session email and OTP verification exist
if (!isset($_SESSION['email']) || !isset($_SESSION['otp_verified'])) {
    die("Unauthorized access. Please verify your OTP first.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_SESSION['email']);
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : null;

    if (empty($new_password)) {
        die("New password not provided. Please try again.");
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password and clear OTP details
    $sql = "UPDATE Users SET password='$hashed_password', otp=NULL, otp_expiry=NULL WHERE email='$email'";
    if ($conn->query($sql)) {
        // Clear session variables and redirect to login
        session_unset();
        session_destroy();
        echo "<script>alert('Password reset successful! Please login.'); window.location.href = 'login.php';</script>";
    } else {
        die("Error updating password: " . $conn->error);
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <div class="set_password_box">
            <div class="password-header">
                <span>Set New Password</span>
            </div>
            <form action="set_new_password.php" method="POST">
                <div class="input_box">
                    <input type="password" id="new_password" name="new_password" class="input-field" required>
                    <label for="new_password">New Password</label>
                </div>
                <button type="submit" class="btn">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>
