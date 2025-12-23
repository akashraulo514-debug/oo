<?php
session_start();
include('php/config.php'); // Database connection

if (isset($_POST['submit'])) {
    $design_name = mysqli_real_escape_string($conn, $_POST['design_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $theme = mysqli_real_escape_string($conn, $_POST['theme']);
    
    // Handle file upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_error = $_FILES['image']['error'];

    // Check if file was uploaded without errors
    if ($image_error === 0) {
        // Generate unique name for the image to avoid conflicts
        $image_new_name = uniqid('', true) . '.' . pathinfo($image, PATHINFO_EXTENSION);
        $image_destination = 'images/' . $image_new_name;

        // Move the uploaded image to the images folder
        if (move_uploaded_file($image_tmp, $image_destination)) {
            // Insert mandap design into the database with image filename
            $vendor_id = $_SESSION['vendor_id'];  // Get the vendor ID
            $query = "INSERT INTO mandap_designs (vendor_id, design_name, description, image_url, price, theme) 
                      VALUES ('$vendor_id', '$design_name', '$description', '$image_new_name', '$price', '$theme')";

            if (mysqli_query($conn, $query)) {
                echo "Mandap Design Uploaded Successfully!";
                header("Location: vendor_dashboard.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading the image.";
        }
    } else {
        echo "Error: File upload failed.";
    }
}
?>
