<?php
// Include database connection
include("php/config.php");

// Start the session
session_start();

// Redirect if OTP is not verified
if (!isset($_SESSION['otp_valid']) || $_SESSION['otp_valid'] !== true) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reset_password'])) {
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $email = $_SESSION['email']; 


    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update password in the database
        $sql = "UPDATE Users SET password='$hashed_password', otp=NULL, otp_expiry=NULL WHERE email='$email'";
        if ($conn->query($sql)) {
            unset($_SESSION['otp_valid']);
            echo "<script>alert('Password reset successful!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error resetting password!');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match!');</script>";
    }
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <div class="reset_password_box">
            <div class="reset-header">
                <span>Reset Password</span>
            </div>
            <form action="reset_password.php" method="POST">
                <div class="input_box">
                    <input type="password" id="new_password" name="new_password" class="input-field" required>
                    <label for="new_password">New Password</label>
                </div>
                <div class="input_box">
                    <input type="password" id="confirm_password" name="confirm_password" class="input-field" required>
                    <label for="confirm_password">Confirm Password</label>
                </div>
                <button type="submit" name="reset_password" class="btn">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>
