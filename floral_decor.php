<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floral Decor - Ornate Occasions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .service-detail {
            padding: 60px 0;
        }

        .service-detail h2 {
            color: #ff6b6b;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .service-detail img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .service-detail .card-body {
            padding: 20px;
        }

        .btn-custom {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-custom:hover {
            background-color: #e63900;
        }

        .view-gallery-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
        }

        .view-gallery-btn:hover {
            background-color: #e63900;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<?php
if (file_exists("navbar.php")) {
    include("navbar.php");
} else {
    echo "<p>Navbar file is missing. Please check the file path.</p>";
}
?>

<!-- Service Detail Section -->
<section class="service-detail">
    <div class="container">
        <h2>Floral Decor</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="imge/9666da66-1ab9-483d-bdea-b37aa0523f94~rs_768.jpg" alt="Floral Decor">
            </div>
            <div class="col-md-6">
                <h4>Description</h4>
                <p>Transform your venue with breathtaking floral arrangements. From traditional to modern designs, we bring your vision to life with our stunning floral decor. Our expert florists create arrangements that complement the theme and ambiance of your event, adding elegance and beauty.</p>
                <h4>Features</h4>
                <ul>
                    <li>Custom floral arrangements for all occasions</li>
                    <li>Fresh flowers sourced from top-quality growers</li>
                    <li>Theme-based designs tailored to your event</li>
                    <li>Elegant floral installations and centerpieces</li>
                </ul>
                <h4>Pricing</h4>
                <p>Pricing is based on the type and size of the floral arrangements. Please contact us for a personalized quote.</p>

                <!-- View Floral Decor Gallery Button -->
                <button class="view-gallery-btn" onclick="window.location.href='floral_gallery.php'">View Gallery</button>

                <a href="contact.php" class="btn btn-custom">Request a Quote</a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php
if (file_exists("footer.php")) {
    include("footer.php");
} else {
    echo "<p>Footer file is missing. Please check the file path.</p>";
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
