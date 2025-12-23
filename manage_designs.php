<?php
// Start the session and check if the user is an admin
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Connect to the database
include('php/config.php');

// Fetch all mandap designs
$query = "SELECT * FROM mandap_designs ORDER BY title ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching mandap designs: " . mysqli_error($conn));
}

// Handle status update
if (isset($_POST['update_design'])) {
    $design_id = intval($_POST['design_id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $update_query = "UPDATE mandap_designs SET title = ?, description = ?, price = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "ssdi", $title, $description, $price, $design_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_designs.php?message=Design updated successfully");
        exit();
    } else {
        echo "Error updating design: " . mysqli_error($conn);
    }
}

// Handle design deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM mandap_designs WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_designs.php?message=Design deleted successfully");
        exit();
    } else {
        echo "Error deleting design: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mandap Designs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #ff6600;
        }
        .container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #ff6600;
            color: white;
        }
        .update-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .update-btn:hover {
            background-color: #218838;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .back-btn:hover {
            background-color: #cc5500;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Manage Mandap Designs</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td>
                    <!-- Update form -->
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="design_id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                        <input type="text" name="description" value="<?php echo htmlspecialchars($row['description']); ?>" required>
                        <input type="number" name="price" value="<?php echo $row['price']; ?>" required>
                        <button type="submit" name="update_design" class="update-btn">Update</button>
                    </form>

                    <!-- Delete link -->
                    <a href="manage_designs.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this design?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>

</body>
</html>
