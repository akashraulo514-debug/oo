<?php
// Start the session and check if the user is an admin
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Connect to the database
include('php/config.php');

// Check if user ID is set and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_users.php?error=Invalid user ID");
    exit();
}

$user_id = intval($_GET['id']);

// Prevent admin from deleting themselves
if ($user_id == $_SESSION['user_id']) {
    header("Location: manage_users.php?error=You cannot delete your own account");
    exit();
}

// Delete user using a prepared statement
$query = "DELETE FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: manage_users.php?message=User deleted successfully");
} else {
    header("Location: manage_users.php?error=Error deleting user");
}

// Close the database connection
mysqli_close($conn);
exit();
?>
