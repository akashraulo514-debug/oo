<?php
session_start(); // Start the session
include("php/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
    // Sanitize and validate inputs
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $confirm_pass = trim($_POST['confirm_password']);
    $phone = trim($_POST['phone']);

    // Check if all fields are filled
    if (empty($user) || empty($email) || empty($pass) || empty($confirm_pass) || empty($phone)) {
        echo "<script>alert('All fields are required!');</script>";
        exit();
    }

    // Validate username: allow letters, numbers, and spaces
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $user)) {
        echo "<script>alert('Username must contain only letters, numbers, and spaces.');</script>";
        exit();
    }

    // Validate if passwords match
    if ($pass !== $confirm_pass) {
        echo "<script>alert('Passwords do not match.');</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

    // Prepare the query to check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email is already registered!');</script>";
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user, $email, $hashed_password, $phone);

        if ($stmt->execute()) {
            // Start a session and store user information
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $user;
            $_SESSION['email'] = $email;

            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!-- User Registration Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <div class="register_box">
            <div class="register-header">
                <span>Register</span>
            </div>
            <form action="register.php" method="POST">
                <div class="input_box">
                    <input type="text" id="username" name="username" class="input-field" required>
                    <label for="username">Username</label>
                </div>
                <div class="input_box">
                    <input type="email" id="email" name="email" class="input-field" required>
                    <label for="email">Email</label>
                </div>
                <div class="input_box">
                    <input type="password" id="password" name="password" class="input-field" required>
                    <label for="password">Password</label>
                </div>
                <div class="input_box">
                    <input type="password" id="confirm_password" name="confirm_password" class="input-field" required>
                    <label for="confirm_password">Confirm Password</label>
                </div>
                <div class="input_box">
                    <input type="tel" id="phone" name="phone" class="input-field" required>
                    <label for="phone">Phone</label>
                </div>
                <button type="submit" name="register" class="btn">Register</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
