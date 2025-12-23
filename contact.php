<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Ornate Occasions</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        header {
            background-color: #FF6B6B;
            color: white;
            text-align: center;
            padding: 50px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            font-size: 48px;
            font-weight: 600;
            margin: 0;
        }
        header p {
            font-size: 20px;
            margin-top: 10px;
        }
        section {
            max-width: 1200px;
            margin: auto;
            padding: 50px 20px;
        }
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        .contact-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            color: #555;
        }
        .contact-form button {
            background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .contact-form button:hover {
            background-color: #e15555;
        }
        .map-section {
            margin-top: 50px;
        }
        iframe {
            width: 100%;
            height: 450px;
            border: none;
            border-radius: 8px;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<header>
    <h1>Contact Us</h1>
    <p>We'd love to hear from you! Reach out for any questions or inquiries.</p>
</header>

<section>
    <h2>Get in Touch</h2>
    
    <!-- Contact Form -->
    <div class="contact-form">
        <form action="process_contact.php" method="POST">
            <!-- Name field with regex validation to only accept letters and spaces -->
            <input type="text" name="name" placeholder="Your Name" required pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces.">
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <!-- Google Map Section -->
    <div class="map-section">
        <h2>Our Location</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1931.513325639635!2d75.22109240059582!3d19.837676110091156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1738240807792!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<footer>
    <p>&copy; 2025 Ornate Occasions. All Rights Reserved.</p>
</footer>

</body>
</html>
