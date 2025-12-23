<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include('php/config.php');

if (isset($_GET['id'])) {
    $vendor_id = intval($_GET['id']);
    $delete_query = "DELETE FROM vendors WHERE id = $vendor_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: manage_vendors.php?message=Vendor deleted successfully");
        exit();
    } else {
        echo "Error deleting vendor: " . mysqli_error($conn);
    }
} else {
    echo "Invalid vendor ID.";
}

mysqli_close($conn);
?>
