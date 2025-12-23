<?php
// Start the session
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate the form inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: contact.php");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please provide a valid email address.";
        header("Location: contact.php");
        exit();
    }

    // Set admin email address
    $admin_email = "admin@gmail.com";
    $admin_subject = "New Contact Us Message: $subject";
    
    // Message for the admin
    $admin_message = "You have received a new message from the contact form on your website.\n\n";
    $admin_message .= "Name: $name\n";
    $admin_message .= "Email: $email\n";
    $admin_message .= "Subject: $subject\n";
    $admin_message .= "Message: \n$message\n";

    // Email the admin
    if (mail($admin_email, $admin_subject, $admin_message)) {
        // Send a confirmation email to the user
        $user_subject = "Thank you for contacting us!";
        $user_message = "Dear $name,\n\n";
        $user_message .= "Thank you for reaching out! We have received your message and will get back to you soon.\n\n";
        $user_message .= "Here is a copy of your message:\n";
        $user_message .= "$message\n\n";
        $user_message .= "Best regards,\n";
        $user_message .= "The Ornate Occasions Team";

        // Send the confirmation email to the user
        mail($email, $user_subject, $user_message);

        // Set a success message
        $_SESSION['success'] = "Your message has been sent successfully!";
    } else {
        // Set an error message
        $_SESSION['error'] = "There was an error sending your message. Please try again later.";
    }

    // Redirect back to the contact page with success or error message
    header("Location: contact.php");
    exit();
}
?>
