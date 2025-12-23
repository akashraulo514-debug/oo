<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect based on user role
    if ($_SESSION['role'] === 'admin') {
        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Redirect to user dashboard
        header("Location: user_dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Home Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #ff6b6b, #ff9e9e);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .wrapper {
            text-align: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 90%;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.5;
        }

        a {
            color: #ffedda;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #ffe6b3;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #ffe6b3;
            color: #ff6b6b;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: #ffc993;
            transform: translateY(-3px);
        }

        .btn:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Welcome to the Home Page</h1>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <p>You are not logged in. Please log in to access your dashboard.</p>
            <a href="login.php" class="btn">Login</a>
        <?php endif; ?>
    </div>
</body>
</html>
