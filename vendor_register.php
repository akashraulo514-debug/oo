<?php
session_start();
include("php/config.php"); // Ensure the path to the config file is correct

// Check if the connection is successful
if ($conn === null) {
    die("Database connection failed.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $business_name = $_POST['business_name'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['vendor_password'], PASSWORD_DEFAULT);
    $business_type = $_POST['business_type'];

    // Handle file uploads
    $aadhaar_card = $_FILES['aadhaar_card']['name'];
    $pan_card = $_FILES['pan_card']['name'];
    $upload_dir = 'uploads/';

    // Check if the files were uploaded without errors
    if ($_FILES['aadhaar_card']['error'] === UPLOAD_ERR_OK && $_FILES['pan_card']['error'] === UPLOAD_ERR_OK) {

        // Check for file types (optional: only allow specific extensions like .jpg, .png, .pdf)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $aadhaar_ext = pathinfo($aadhaar_card, PATHINFO_EXTENSION);
        $pan_ext = pathinfo($pan_card, PATHINFO_EXTENSION);

        if (!in_array($aadhaar_ext, $allowed_extensions) || !in_array($pan_ext, $allowed_extensions)) {
            $error_message = "Invalid file type. Only jpg, jpeg, png, and pdf are allowed.";
        } else {
            // Generate unique filenames for files to avoid conflicts
            $aadhaar_card_new = uniqid('aadhaar_', true) . '.' . $aadhaar_ext;
            $pan_card_new = uniqid('pan_', true) . '.' . $pan_ext;

            // Move files to the upload directory
            if (move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $upload_dir . $aadhaar_card_new) &&
                move_uploaded_file($_FILES['pan_card']['tmp_name'], $upload_dir . $pan_card_new)) {

                // Check if email exists
                $email_check_query = $conn->prepare("SELECT * FROM vendors WHERE email = ? LIMIT 1");
                $email_check_query->bind_param("s", $email);
                $email_check_query->execute();
                $result = $email_check_query->get_result();

                if ($result->num_rows > 0) {
                    $error_message = "Email already exists. Please use a different one.";
                } else {
                    // Proceed with insertion using prepared statements
                    $stmt = $conn->prepare("INSERT INTO vendors (business_name, contact_person, email, phone, vendor_password, business_type, aadhaar_card, pan_card) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                    // Bind the parameters to the prepared statement
                    $stmt->bind_param("ssssssss", $business_name, $contact_person, $email, $phone, $password, $business_type, $aadhaar_card_new, $pan_card_new);

                    if ($stmt->execute()) {
                        $_SESSION['vendor_id'] = $conn->insert_id; // Storing vendor id
                        $_SESSION['vendor_name'] = $business_name; // Storing vendor business name
                        // Redirect to the login page after success
                        header("Location: login.php");
                        exit();
                    } else {
                        $error_message = "Error registering vendor: " . $stmt->error;
                    }
                }
            } else {
                $error_message = "Error uploading files. Please try again.";
            }
        }
    } else {
        $error_message = "File upload failed. Please check your file.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="wrapper">
        <div class="registration_box">
            <div class="registration-header">
                <span>Register Vendor</span>
            </div>
            <form action="register_vendor.php" method="POST" enctype="multipart/form-data">
                <div class="input_box">
                    <input type="text" name="business_name" class="input-field" required>
                    <label for="business_name">Business Name</label>
                </div>
                <div class="input_box">
                    <input type="text" name="contact_person" class="input-field" required>
                    <label for="contact_person">Contact Person</label>
                </div>
                <div class="input_box">
                    <input type="email" name="email" class="input-field" required>
                    <label for="email">Email</label>
                </div>
                <div class="input_box">
                    <input type="text" name="phone" class="input-field" required>
                    <label for="phone">Phone</label>
                </div>
                <div class="input_box">
                    <input type="password" name="vendor_password" class="input-field" required>
                    <label for="vendor_password">Password</label>
                </div>
                <div class="input_box">
                    <input type="text" name="business_type" class="input-field" required>
                    <label for="business_type">Business Type</label>
                </div>
                <div class="input_box">
                    <input type="file" name="aadhaar_card" required>
                    <label for="aadhaar_card">Aadhaar Card</label>
                </div>
                <div class="input_box">
                    <input type="file" name="pan_card" required>
                    <label for="pan_card">Pan Card</label>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>

            <?php if (isset($error_message)) { ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
