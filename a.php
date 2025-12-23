<?php
// Include PHPMailer
require 'vendor/autoload.php'; // Use this if you installed PHPMailer via Composer
// If you downloaded PHPMailer manually, use: require 'path/to/PHPMailerAutoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();

// Set mailer to use SMTP
$mail->isSMTP();

// Set the SMTP server to Gmail
$mail->Host = 'smtp.gmail.com';  
$mail->SMTPAuth = true;           // Enable SMTP authentication
$mail->Username = 'ornateoccasions83@gmail.com'; // Your Gmail address
$mail->Password = 'cuwe gouc qhuz mkak';  // Your Gmail password
$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;  // Use STARTTLS
$mail->Port = 587;                // SMTP port for Gmail (587 is the port for STARTTLS)

// Sender's email address and name
$mail->setFrom('ornateoccasions83@gmail.com', 'Ornate Occasions');
$mail->addAddress('ornateoccasions83@gmail.com'); // Recipient's email address

// Email subject and body
$mail->Subject = 'Forgot Password Request';
$mail->Body    = 'This is a test email sent from PHP using PHPMailer with Gmail SMTP.';

// Send the email
if($mail->send()) {
    echo 'Message has been sent';
} else {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
?>
