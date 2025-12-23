<?php
session_start();
include('php/config.php'); // Database connection

// Check if the vendor is logged in
if (!isset($_SESSION['vendor_id'])) {
    echo "You must be logged in to manage inventory.";
    exit();
}

$vendor_id = $_SESSION['vendor_id'];

// Fetch all mandap designs by the logged-in vendor
$query = "SELECT * FROM mandap_designs WHERE vendor_id = '$vendor_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error fetching designs: " . mysqli_error($conn);
    exit();
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM mandap_designs WHERE id = '$delete_id' AND vendor_id = '$vendor_id'";
    
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Design deleted successfully'); window.location='manage_inventory.php';</script>";
    } else {
        echo "Error deleting design: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mandap Designs</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: left;
            width: 100%;
            margin: 0 auto;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td img {
            max-width: 100px;
            max-height: 100px;
        }

        .button {
            padding: 10px 20px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 10px;
        }

        .button:hover {
            background-color: #ff4500;
        }

        .table-container {
            overflow-x: auto;
        }

        .action-container {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Mandap Designs</h1>

        <!-- Add Mandap Design Button -->
        <div class="action-container">
            <a href="upload_mandap.php" class="button">Upload New Mandap Design</a>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Design Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Theme</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['design_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['theme']); ?></td>
                            <td><img src="images/<?php echo htmlspecialchars($row['image_url']); ?>" width="100" height="100"></td>
                            <td>
                                <!-- Edit Mandap Design -->
                                <a href="edit_mandap.php?id=<?php echo $row['id']; ?>" class="button">Edit</a>
                                <!-- Delete Mandap Design -->
                                <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this design?')" class="button">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="action-container">
            <a href="vendor_dashboard.php" class="button">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
