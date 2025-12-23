<?php
// Include database connection
include("php/config.php"); 

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    // Check if the email exists in the Users table
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found in Users table
        $user = $result->fetch_assoc();
        
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php"); // Regular User Dashboard
            }
            exit();
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        // If the email is not found in Users table, check Vendors table
        $stmt = $conn->prepare("SELECT * FROM vendors WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Vendor found in Vendors table
            $vendor = $result->fetch_assoc();

            if (password_verify($pass, $vendor['vendor_password'])) {
                $_SESSION['vendor_id'] = $vendor['id'];
                $_SESSION['vendor_name'] = $vendor['business_name'];
                $_SESSION['email'] = $vendor['email'];
                $_SESSION['role'] = "vendor";

                // Redirect to vendor dashboard
                header("Location: vendor_dashboard.php"); 
                exit();
            } else {
                echo "<script>alert('Invalid password!');</script>";
            }
        } else {
            echo "<script>alert('Email not registered!');</script>";
        }
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN link for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Positioning the Vendor Login Link at the bottom-right corner */
        .vendor-login-link {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 16px;
            color:white;
            text-decoration: none;
            font-weight: bold;
        }

        .vendor-login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Login</span>
            </div>
            <form action="login.php" method="POST">
                <div class="input_box">
                    <input type="email" id="email" name="email" class="input-field" required>
                    <label for="email">Email</label>
                </div>
                <div class="input_box">
                    <input type="password" id="password" name="password" class="input-field" required>
                    <label for="password">Password</label>
                </div>
                <button type="submit" name="login" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <p>Don't have an account? <a href="register.php">Register</a></p>
                <p><a href="forgot_password.php">Forgot your password?</a></p>
            </form>
        </div>
    </div>

    <!-- Vendor Login Link positioned at the bottom-right -->
    <a href="vendor_register.php" class="vendor-login-link">Vendor Register</a>
</body>
</html>
