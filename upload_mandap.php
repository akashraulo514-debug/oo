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
<!-- upload_mandap.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Mandap Design</title>
    <style>
        /* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #ff6b6b;  /* Matching the orange theme color */
    margin-bottom: 30px;
    font-size: 2em;
}

/* Form Styling */
form {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
    display: block;
    color: #333;
}

/* Input Fields */
input[type="text"],
input[type="file"],
select,
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
}

/* Textarea */
textarea {
    resize: vertical;
    height: 120px;
}

/* Select box */
select {
    font-size: 14px;
}

/* Submit Button */
input[type="submit"] {
    width: 100%;
    padding: 14px;
    background-color: : #ff6b6b;  /* Matching the orange theme color */
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #ff6b6b;
}

/* File Input Styling */
input[type="file"] {
    padding: 10px;
    font-size: 14px;
    color: #333;
}

/* Success/Error Messages */
.error, .success {
    text-align: center;
    margin-top: 20px;
    padding: 15px;
    border-radius: 5px;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}

.success {
    background-color: #d4edda;
    color: #155724;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    form {
        padding: 20px;
    }

    input[type="submit"] {
        font-size: 14px;
        padding: 12px;
    }
}

    </style>
</head>
<body>
    <h1>Upload Mandap Design</h1>
    <form action="upload_mandap_process.php" method="POST" enctype="multipart/form-data">
        <label for="design_name">Design Name:</label>
        <input type="text" name="design_name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="text" name="price" required><br>

        <label for="theme">Theme:</label>
        <select name="theme">
            <option value="Traditional">Traditional</option>
            <option value="Modern">Modern</option>
            <option value="Luxury">Luxury</option> <!-- New theme option -->
            <option value="Minimalistic">Minimalistic</option> <!-- New theme option -->
            <option value="Royal">Royal</option> <!-- New theme option -->
            <option value="Beach">Beach</option> <!-- New theme option -->
            <option value="Rustic">Rustic</option> <!-- New theme option -->
        </select><br>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <input type="submit" name="submit" value="Upload Mandap Design">
    </form>
</body>
</html>
