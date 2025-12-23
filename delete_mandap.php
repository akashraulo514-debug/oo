<?php
session_start();
include('php/config.php'); // Database connection

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);

    // Query to delete the mandap design by its ID
    $query = "DELETE FROM mandap_designs WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // Optionally, delete the image from the server if you want to remove it too
        // $image_query = "SELECT image_url FROM mandap_designs WHERE id = $id";
        // $result = mysqli_query($conn, $image_query);
        // if ($result && mysqli_num_rows($result) > 0) {
        //     $row = mysqli_fetch_assoc($result);
        //     $image_path = 'images/' . $row['image_url'];
        //     if (file_exists($image_path)) {
        //         unlink($image_path); // Delete image from server
        //     }
        // }

        echo "Mandap design deleted successfully.";
        header("Location: gallery.php");  // Redirect to the gallery page after deletion
        exit();
    } else {
        echo "Error deleting mandap design: " . mysqli_error($conn);
    }
} else {
    echo "No design ID provided.";
}

mysqli_close($conn);
?>
