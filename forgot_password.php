<?php
// Include database connection
include("php/config.php");

// Include PHPMailer
require 'vendor/autoload.php';  // Ensure PHPMailer is installed via Composer

// Start the session
session_start();

// Handle forgot password form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_email'])) {
    $email = $conn->real_escape_string(trim($_POST['email']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!');</script>";
    } else {
        // Check if email exists in the database
        $sql = "SELECT * FROM Users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Store email in session for use in the OTP verification
            $_SESSION['email'] = $email;

            // Generate OTP (6 digits)
            $otp = rand(100000, 999999);
            $expiry = date("Y-m-d H:i:s", strtotime("+15 minutes"));

            // Insert OTP and expiry into the database
            $sql = "UPDATE Users SET otp='$otp', otp_expiry='$expiry' WHERE email='$email'";
            if ($conn->query($sql)) {
                // Send the OTP via email using PHPMailer
                $subject = "Your OTP for Password Reset";
                $message = "Your OTP for password reset is: $otp. This OTP will expire in 15 minutes.";

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ornateoccasions83@gmail.com';
                $mail->Password = 'cuwe gouc qhuz mkak';
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('ornateoccasions83@gmail.com', 'Ornate Occasions');
                $mail->addAddress($email);  // Send to user's email
                $mail->Subject = $subject;
                $mail->Body    = $message;

                if ($mail->send()) {
                    echo "<script>alert('OTP sent to your email!'); window.location.href = 'verify_otp.php';</script>";
                } else {
                    echo "<script>alert('Error sending OTP email!');</script>";
                }
            } else {
                echo "<script>alert('Error updating OTP in database!');</script>";
            }
        } else {
            echo "<script>alert('Email not registered!');</script>";
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
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <div class="forgot_password_box">
            <div class="forgot-header">
                <span>Forgot Password</span>
            </div>
            <form action="forgot_password.php" method="POST">
                <div class="input_box">
                    <input type="email" id="email" name="email" class="input-field" required>
                    <label for="email">Enter your email</label>
                </div>
                <button type="submit" name="submit_email" class="btn">
                    Send OTP
                </button>
                <p><a href="login.php">Back to Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
