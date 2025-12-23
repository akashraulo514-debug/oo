<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include('php/config.php');

// Fetch all vendors
$query = "SELECT * FROM vendors";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error fetching vendors: " . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vendors</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .table th {
            background-color: #e74c3c;
            color: white;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            font-size: 14px;
        }
        footer {
    text-align: center;
    padding: 10px;
    margin-top: 20px;
}
        .btn-edit { background-color: #28a745; }
        .btn-edit:hover { background-color: #218838; }
        .btn-delete { background-color: #dc3545; }
        .btn-delete:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Vendors</h1>

        <?php if (isset($_GET['message'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Vendor ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($vendor = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($vendor['vendor_id']); ?></td>
                        <td><?php echo htmlspecialchars($vendor['name']); ?></td>
                        <td><?php echo htmlspecialchars($vendor['email']); ?></td>
                        <td><?php echo htmlspecialchars($vendor['phone']); ?></td>
                        <td><?php echo htmlspecialchars($vendor['status']); ?></td>
                        <td>
                            <a href="edit_vendor.php?vendor_id=<?php echo $vendor['vendor_id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete_vendor.php?vendor_id=<?php echo $vendor['vendor_id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this vendor?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="admin_dashboard.php" class="btn">Back to Dashboard</a>
    </div>

    <footer>
        <p>&copy; 2025 Ornate Occasions | All Rights Reserved</p>
    </footer>
</body>
</html>
<?php
mysqli_close($conn);
?>