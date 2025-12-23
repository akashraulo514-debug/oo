<?php
include("php/config.php"); // Database connection file

// Check if the 'id' parameter is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the mandap design details from the database
    $query = "SELECT id, design_name, image_url, description, theme, price FROM mandap_designs WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['design_name'];
        $image = $row['image_url'];
        $description = $row['description'];
        $theme = $row['theme'];
        $price = $row['price']; // Get the current price
    } else {
        echo "Design not found.";
        exit();
    }
} else {
    echo "No design ID provided.";
    exit();
}

// Update the mandap design if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = $_POST['design_name'];
    $new_image = $_POST['image_url']; // You may handle file uploads separately
    $new_description = $_POST['description'];
    $new_theme = $_POST['theme'];
    $new_price = $_POST['price']; // Get the new price

    // Update query
    $update_query = "UPDATE mandap_designs SET 
                        design_name = '$new_name', 
                        image_url = '$new_image', 
                        description = '$new_description', 
                        theme = '$new_theme',
                        price = '$new_price' 
                     WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "Mandap design updated successfully.";
        // Redirect to the gallery page or another relevant page
        header("Location: gallery.php");
        exit();
    } else {
        echo "Error updating design: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mandap Design</title>
</head>
<body>

<h2>Edit Mandap Design</h2>

<form action="edit_mandap.php?id=<?php echo $id; ?>" method="POST">
    <label for="design_name">Design Name:</label>
    <input type="text" id="design_name" name="design_name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>

    <label for="image_url">Image URL:</label>
    <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($image); ?>" required><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea><br><br>

    <label for="theme">Theme:</label>
    <select id="theme" name="theme" required>
        <option value="traditional" <?php echo ($theme == 'traditional') ? 'selected' : ''; ?>>Traditional</option>
        <option value="modern" <?php echo ($theme == 'modern') ? 'selected' : ''; ?>>Modern</option>
        <option value="royal" <?php echo ($theme == 'royal') ? 'selected' : ''; ?>>Royal</option>
        <option value="floral" <?php echo ($theme == 'floral') ? 'selected' : ''; ?>>Floral</option>
    </select><br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" step="0.01" required><br><br>

    <button type="submit">Update Design</button>
</form>

</body>
</html>
