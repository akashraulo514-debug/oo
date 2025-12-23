<?php
session_start();
require_once("php/config.php"); // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT name, email, profile_picture FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Check if the user record exists
if (!$user) {
    // If user is not found, redirect to login page or show an error
    header("Location: login.php");
    exit();
}

// Handle Profile Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['profile_feedback'] = "Invalid email address.";
    } else {
        $update_sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($update_sql);
        
        if ($stmt->execute([$name, $email, $user_id])) {
            $_SESSION['profile_feedback'] = "Profile updated successfully.";
            $user['name'] = $name;
            $user['email'] = $email;
        } else {
            $_SESSION['profile_feedback'] = "Error updating profile. Try again.";
        }
    }
}

// Handle Profile Picture Upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 5 * 1024 * 1024; // 5 MB limit

    if (!in_array($_FILES['profile_picture']['type'], $allowed_types)) {
        $_SESSION['profile_feedback'] = "Invalid file type. Only JPEG, PNG, or GIF files are allowed.";
    } elseif ($_FILES['profile_picture']['size'] > $max_size) {
        $_SESSION['profile_feedback'] = "File size exceeds the limit of 5MB.";
    } else {
        $safe_file_name = preg_replace("/[^a-zA-Z0-9\-_\.]/", "", $_FILES["profile_picture"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($safe_file_name);
        
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $update_sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $pdo->prepare($update_sql);
            $stmt->execute([$target_file, $user_id]);
            $user['profile_picture'] = $target_file;
        } else {
            $_SESSION['profile_feedback'] = "Error uploading file. Try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Ornate Occasions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            max-width: 400px; /* Set the maximum width to make it thinner */
            margin: 0 auto; /* Center the card horizontally */
            padding: 1rem; /* Adjust the padding if necessary */
        }
        .profile-pic-container {
            position: relative;
            display: inline-block;
        }
        .profile-pic {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .upload-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
            font-size: 18px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Ornate Occasions</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    <?php
    // Display feedback messages
    if (isset($_SESSION['profile_feedback'])) {
        echo '<div class="alert alert-info">' . $_SESSION['profile_feedback'] . '</div>';
        unset($_SESSION['profile_feedback']);
    }
    ?>
    
    <div class="card p-4 shadow text-center">
        <!-- Profile Picture -->
        <div class="profile-pic-container">
            <img src="<?php echo $user['profile_picture'] ?: 'uploads/default-profile.png'; ?>" class="profile-pic">
            <label class="upload-icon" data-toggle="modal" data-target="#profileModal">+</label>
        </div>

        <!-- User Details -->
        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
    </div>
</div>

<!-- Modal for Profile Actions -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Edit Profile or Upload Profile Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit Profile Form -->
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#editProfileForm">Edit Profile</button>
                <div id="editProfileForm" class="collapse mt-2">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                    </form>
                </div>

                <!-- Profile Picture Upload Form -->
                <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                    <div class="form-group">
                        <label for="file-input">Upload Profile Picture</label>
                        <input type="file" name="profile_picture" id="file-input" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="footer mt-5 bg-dark text-white text-center py-3">
    <p>&copy; 2025 Ornate Occasions. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
