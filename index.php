<?php
// Start PHP session if needed
session_start();

// Function to handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simple form handling logic
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // Validate name: only alphabetic characters and spaces
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $_SESSION['form_feedback'] = "Error: Name must contain only letters and spaces.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Example: Store form data in a session (or process it further)
    $_SESSION['form_feedback'] = "Thank you, $name! Your message has been received.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ornate Occasions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Add your CSS here */
        .navbar { background-color: #ff6b6b; }
        .navbar .nav-link { color: white !important; font-weight: bold; }
        .navbar .nav-link:hover { color: #ffe0e0 !important; }
        .hero { background: url('imge/decorated-indian-wedding-mandap-indian-background-theme_1279565-2013.jpg') no-repeat center center/cover; height: 100vh; color: white; display: flex; justify-content: center; align-items: center; text-align: center; margin-top: -56px; }
        .hero h1 { font-size: 3.5rem; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); }
        .section-orange { background-color: #ff6b6b; color: white; padding: 60px 0; }
        .services .icon { font-size: 3rem; color: #ff6b6b; margin-bottom: 20px; }
        .gallery img { width: 100%; height: auto; border-radius: 10px; }
        .contact { padding: 60px 0; }
        .footer { background-color: #333; color: white; padding: 20px 0; text-align: center; }
    .btn-custom {
        background-color: #ff6b6b;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #e63900; 
        color: white;
    }

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Ornate Occasions</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div id="home" class="hero">
    <div>
        <h1>Welcome to Ornate Occasions</h1>
        <p>Your trusted partner for luxurious wedding and event decor.</p>
        <a href="login.php" class="btn btn-custom btn-lg mt-3">Get Started</a>
    </div>
</div>

<!-- About Section -->
<section class="section-orange text-center">
    <div class="container">
        <h2>We’ve Got What You Need!</h2>
        <p>At Ornate Occasions, we specialize in crafting unforgettable moments through elegant and customized mandap and venue decor.</p>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact text-center">
    <div class="container">
        <h2>Get In Touch</h2>
        <?php if (!empty($_SESSION['form_feedback'])): ?>
            <p class="alert alert-success"><?php echo $_SESSION['form_feedback']; unset($_SESSION['form_feedback']); ?></p>
        <?php endif; ?>
        <form action="" method="POST" class="mt-4">
            <div class="row">
                <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Your Name" required></div>
                <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Your Email" required></div>
            </div>
            <textarea name="message" class="form-control mt-3" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit" class="btn btn-custom btn-lg mt-3">Send Message</button>
        </form>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer">
    <p>&copy; 2025 Ornate Occasions. All rights reserved.</p>
    <div class="social-icons">
    <a href="https://www.facebook.com/yourpage" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/yourpage" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/8010047026" target="_blank"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.youtube.com/watch?v=f3dcagtvnT8&t=19s" target="_blank"><i class="fab fa-youtube"></i></a>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
