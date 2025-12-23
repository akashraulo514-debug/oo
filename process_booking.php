<?php
// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the Composer autoload file (if using Composer)
require 'vendor/autoload.php';

// Include the config.php file for database connection
include("php/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate vendor_id
    if (!isset($_POST['vendor_id']) || empty($_POST['vendor_id'])) {
        echo "Error: Vendor ID is missing.";
        exit;
    } else {
        $vendor_id = $_POST['vendor_id'];
    }

    // Collect other POST data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $event_date = $_POST['event_date'];
    $message = $_POST['message'];
    $design = $_POST['design'];

    // Use prepared statement to insert booking into the database
    $query = $conn->prepare("INSERT INTO bookings (name, email, phone, event_date, message, design, vendor_id) 
                             VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssssi", $name, $email, $phone, $event_date, $message, $design, $vendor_id);

    // Execute query
    if ($query->execute()) {
        // Booking successfully added to database

        // Retrieve the vendor's email using vendor_id
        $vendor_query = "SELECT vendor_email FROM vendors WHERE vendor_id = $vendor_id";
        $vendor_result = mysqli_query($conn, $vendor_query);
        $vendor = mysqli_fetch_assoc($vendor_result);
        $vendor_email = $vendor['vendor_email'];

        // Send email to the vendor using PHPMailer
        $mail_vendor = new PHPMailer(true);
        try {
            $mail_vendor->isSMTP();
            $mail_vendor->Host = 'smtp.gmail.com';
            $mail_vendor->SMTPAuth = true;
            $mail_vendor->Username = 'ornateoccasions83@gmail.com';
            $mail_vendor->Password = 'cuwe gouc qhuz mkak';
            $mail_vendor->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail_vendor->Port = 587;

            $mail_vendor->setFrom('ornateoccasions83@gmail.com', 'Ornate Occasions');
            $mail_vendor->addAddress($vendor_email, 'Vendor');

            $mail_vendor->isHTML(true);
            $mail_vendor->Subject = "New Event Booking from " . $name;
            $mail_vendor->Body = "
            <html>
            <body>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Event Date:</strong> $event_date</p>
                <p><strong>Message:</strong> $message</p>
                <p><strong>Mandap Design:</strong> $design</p>
            </body>
            </html>";

            $mail_vendor->send();
        } catch (Exception $e) {
            echo "Error: Unable to send email to the vendor. Mailer Error: " . $mail_vendor->ErrorInfo;
        }

        // Send confirmation email to the user
        $mail_user = new PHPMailer(true);
        try {
            $mail_user->isSMTP();
            $mail_user->Host = 'smtp.gmail.com';
            $mail_user->SMTPAuth = true;
            $mail_user->Username = 'ornateoccasions83@gmail.com';
            $mail_user->Password = 'cuwe gouc qhuz mkak';
            $mail_user->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail_user->Port = 587;

            $mail_user->setFrom('ornateoccasions83@gmail.com', 'Ornate Occasions');
            $mail_user->addAddress($email, $name);

            $mail_user->isHTML(true);
            $mail_user->Subject = "Your Event Booking Confirmation";
            $mail_user->Body = "
            <html>
            <body>
                <p>Dear $name,</p>
                <p>Thank you for booking with Ornate Occasions! Here are your event details:</p>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Event Date:</strong> $event_date</p>
                <p><strong>Message:</strong> $message</p>
                <p><strong>Mandap Design:</strong> $design</p>
                <p>We will contact you soon to finalize the details.</p>
            </body>
            </html>";

            $mail_user->send();
            echo "Booking successfully submitted! Confirmation email has been sent.";
        } catch (Exception $e) {
            echo "Error: Unable to send confirmation email to the user. Mailer Error: " . $mail_user->ErrorInfo;
        }
    } else {
        echo "Error: " . $query->error;
    }

    // Close the database connection
    $conn->close();
}
?>
