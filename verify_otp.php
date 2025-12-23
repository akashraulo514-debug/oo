<?php
// Include database connection
include("php/config.php"); // Ensure this path is correct

session_start(); // Start session first

// Handle OTP verification
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_otp'])) {
    $otp = trim($_POST['otp']);
    
    // Check if email is set in session
    if (!isset($_SESSION['email'])) {
        echo "<script>alert('Session expired. Please try again.'); window.location.href='forgot_password.php';</script>";
        exit();
    }
    
    $email = $_SESSION['email'];

    // Check if OTP exists and is valid
    $sql = "SELECT * FROM Users WHERE email='$email' AND otp='$otp' AND otp_expiry > NOW()";
    $result = $conn->query($sql);

    // Debugging: Check if there are errors in the query
    if (!$result) {
        echo "<script>alert('Error in database query: " . addslashes($conn->error) . "');</script>";
    } else {
        if ($result->num_rows > 0) {
            // OTP is valid, allow password reset
            $_SESSION['otp_valid'] = true;  // Store in session for later
            header("Location: reset_password.php");  // Redirect to reset page
            exit();
        } else {
            // Invalid or expired OTP
            echo "<script>alert('Invalid OTP or OTP has expired. Please request a new OTP.');</script>";
        }
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
    <title>Verify OTP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <div class="otp_verification_box">
            <div class="otp-header">
                <span>Verify OTP</span>
            </div>
            <form action="verify_otp.php" method="POST">
                <div class="input_box">
                    <input type="text" id="otp" name="otp" class="input-field" required>
                    <label for="otp">Enter OTP</label>
                </div>
                <button type="submit" name="submit_otp" class="btn">
                    Verify OTP
                </button>
                <p><a href="forgot_password.php">Back to Forgot Password</a></p>
            </form>
        </div>
    </div>
</body>
</html>
