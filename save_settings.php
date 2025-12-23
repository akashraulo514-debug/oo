<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include('php/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
    $admin_email = mysqli_real_escape_string($conn, $_POST['email']);
    $site_description = mysqli_real_escape_string($conn, $_POST['site_description']);
    $contact_phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);

    $update_query = "UPDATE site_settings 
                     SET site_name = '$site_name', admin_email = '$admin_email', 
                     site_description = '$site_description', contact_phone = '$contact_phone' 
                     WHERE id = 1";

    if (mysqli_query($conn, $update_query)) {
        header("Location: admin_settings.php?message=Settings updated successfully");
        exit();
    } else {
        echo "Error updating settings: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
