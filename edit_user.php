<?php
// Start the session and check if the user is an admin
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Connect to the database
include('php/config.php');

// Check if user ID is set
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid user ID.";
    exit();
}

$user_id = intval($_GET['id']);

// Fetch user details
$query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    // Name validation (only letters and spaces allowed)
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        echo "Invalid name. Only letters and spaces are allowed.";
        exit();
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Allowed roles
    $valid_roles = ['admin', 'user'];
    if (!in_array($role, $valid_roles)) {
        echo "Invalid role.";
        exit();
    }

    // Update user details
    $update_query = "UPDATE users SET name=?, email=?, role=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $role, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_users.php?message=User updated successfully");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ff6600;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #333;
        }

        input, select {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #ff6600;
            color: white;
            border: none;
            cursor: pointer;
            width: 85%;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background-color: #cc5200;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            background-color: #ff6600;
            color: white;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: #cc5200;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit User</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
        </select>

        <input type="submit" value="Update User">
    </form>

    <a href="manage_users.php" class="btn">Back to Users</a>
</div>

</body>
</html>
