<?php
// Start PHP session if needed
session_start();

// Function to generate CSRF token
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a secure random token
    }
    return $_SESSION['csrf_token'];
}

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    // Simple form handling logic with validation
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate name (only letters and spaces)
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $_SESSION['form_feedback'] = "Invalid name. Only letters and spaces are allowed.";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['form_feedback'] = "Invalid email address.";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Feedback message stored in session
    $_SESSION['form_feedback'] = "Thank you, $name! Your message has been received.";
    header('Location: ' . $_SERVER['PHP_SELF']); // Redirect to avoid resubmission
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ornate Occasions - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        .navbar { background-color: #ff6b6b; }
        .navbar .nav-link { color: white !important; font-weight: bold; }
        .navbar .nav-link:hover { color: #ffe0e0 !important; }

        .hero {
            background: url('imge/decorated-indian-wedding-mandap-indian-background-theme_1279565-2013.jpg') no-repeat center center/cover;
            height: 100vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-top: -56px;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .section-orange {
            background-color: #ff6b6b;
            color: white;
            padding: 60px 0;
            margin-bottom: 30px;
        }

        .services .icon {
            font-size: 3rem;
            color: #ff6b6b;
            margin-bottom: 20px;
        }

        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

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
                <li class="nav-item"><a class="nav-link" href="events.php">Events</a></li>

                <?php if ($is_logged_in): ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div id="home" class="hero">
    <div>
        <h1>Welcome to Ornate Occasions</h1>
        <p>Your trusted partner for luxurious wedding and event decor.</p>
    </div>
</div>

<!-- About Section -->
<section class="section-orange text-center">
    <div class="container">
        <h2>We’ve Got What You Need!</h2>
        <p>At Ornate Occasions, we specialize in crafting unforgettable moments through elegant and customized mandap and venue decor.</p>
        <a href="about.php" class="btn btn-custom btn-lg mt-3">View More</a>
    </div>
</section>

<!-- Services Section -->
<!-- Services Section -->
<section id="services" class="services text-center">
    <div class="container">
        <h2>Our Services</h2>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="icon"><i class="fas fa-gem"></i></div>
                <h4>Luxurious Mandaps</h4>
                <p>Beautifully designed mandaps for your special day.</p>
            </div>
            <div class="col-md-3">
                <div class="icon"><i class="fas fa-seedling"></i></div>
                <h4>Floral Decor</h4>
                <p>Fresh and unique flower arrangements for any event.</p>
            </div>
            <div class="col-md-3">
                <div class="icon"><i class="fas fa-lightbulb"></i></div>
                <h4>Lighting</h4>
                <p>Elegant lighting to set the perfect ambiance.</p>
            </div>
            <div class="col-md-3">
                <div class="icon"><i class="fas fa-chair"></i></div>
                <h4>Seating & Draping</h4>
                <p>Customized seating and draping solutions.</p>
            </div>
        </div>
        
        <!-- "View More Services" Button -->
        <a href="services.php" class="btn btn-custom btn-lg mt-3">View More Services</a>
    </div>
</section>


<!-- Gallery Section -->
<section id="gallery" class="gallery">
    <div class="container">
        <h2 class="text-center">Our Work</h2>
        <div class="row mt-4">
            <div class="col-md-4"><img src="imge/Mandap-decoration-ideas2.jpg" alt="Gallery Image"></div>
            <div class="col-md-4"><img src="imge/5c64024ffd9138aac9e54606035fb6ed.jpg" alt="Gallery Image"></div>
            <div class="col-md-4"><img src="imge/53726642_1059660860901388_9196199404607465187_n.jpg" alt="Gallery Image"></div>
        </div>
        <a href="gallery.php" class="btn btn-custom btn-lg mt-3">View More</a>
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
            <!-- CSRF Token Field -->
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

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
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
