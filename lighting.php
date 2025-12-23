<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lighting - Ornate Occasions</title>
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

        /* Styling for the additional services */
        #moreOptions {
            display: none;
            margin-top: 20px;
        }

        .package-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .package-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
        <h2>Lighting</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="imge/wedding-event-lighting-scene-min.jpg" alt="Lighting">
            </div>
            <div class="col-md-6">
                <h4>Description</h4>
                <p>Our lighting solutions create a captivating atmosphere for your event. From ambient lighting to dramatic spotlights, we offer a wide range of options to match your event's theme and mood.</p>
                <h4>Features</h4>
                <ul>
                    <li>Custom lighting setups</li>
                    <li>Elegant chandeliers, fairy lights, and more</li>
                    <li>LED and color-changing lighting effects</li>
                    <li>Professional installation and setup</li>
                </ul>
                <h4>Pricing</h4>
                <p>Lighting prices depend on the scale and complexity of the installation. Please reach out for a custom quote.</p>
                <a href="contact_us.php" class="btn btn-custom">Request a Quote</a>

                <!-- See More Button -->
                <button id="seeMoreBtn" class="btn btn-custom mt-3">See More Options</button>

                <!-- Additional Lighting Options -->
                <div id="moreOptions">
                    <h4>Additional Lighting Packages</h4>
                    <div class="row">
                        <!-- Package 1 -->
                        <div class="col-md-4">
                            <div class="card package-card">
                                <h5>Elegant Chandeliers</h5>
                                <p>Perfect for an elegant touch to your event.</p>
                                <p><strong>$1,500</strong></p>
                                <a href="booking_page.php?service=lighting&package=chandelier" class="btn btn-custom">Book Now</a>
                                <a href="lighting_package_details.php?package=chandelier" class="btn btn-custom mt-2">View</a>
                            </div>
                        </div>

                        <!-- Package 2 -->
                        <div class="col-md-4">
                            <div class="card package-card">
                                <h5>Fairy Lights</h5>
                                <p>Bring a whimsical touch with soft fairy lights.</p>
                                <p><strong>$800</strong></p>
                                <a href="booking_page.php?service=lighting&package=fairy_lights" class="btn btn-custom">Book Now</a>
                                <a href="lighting_package_details.php?package=fairy_lights" class="btn btn-custom mt-2">View</a>
                            </div>
                        </div>

                        <!-- Package 3 -->
                        <div class="col-md-4">
                            <div class="card package-card">
                                <h5>LED Color Changing Lights</h5>
                                <p>For a vibrant and dynamic atmosphere.</p>
                                <p><strong>$1,200</strong></p>
                                <a href="booking_page.php?service=lighting&package=led_lights" class="btn btn-custom">Book Now</a>
                                <a href="lighting_package_details.php?package=led_lights" class="btn btn-custom mt-2">View</a>
                            </div>
                        </div>
                    </div>
                </div>
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

<script>
    // Toggle the "See More" options
    document.getElementById('seeMoreBtn').addEventListener('click', function() {
        var moreOptions = document.getElementById('moreOptions');
        if (moreOptions.style.display === 'none' || moreOptions.style.display === '') {
            moreOptions.style.display = 'block';
            this.textContent = 'See Less Options';
        } else {
            moreOptions.style.display = 'none';
            this.textContent = 'See More Options';
        }
    });
</script>
</body>
</html>
