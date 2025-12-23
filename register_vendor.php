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
