<?php
session_start();

// Function to get package details (this can be extended to fetch from a database if needed)
function getPackageDetails($package) {
    $packages = [
        'chandelier' => [
            'title' => 'Elegant Chandeliers',
            'description' => 'Perfect for an elegant touch to your event. These chandeliers bring a sophisticated and classy look to any setting.',
            'price' => 1500,
            'image' => 'images/chandelier.jpg',
            'additional_info' => 'These chandeliers are available in various sizes and styles to fit your event’s theme.'
        ],
        'fairy_lights' => [
            'title' => 'Fairy Lights',
            'description' => 'Bring a whimsical touch with soft fairy lights. Ideal for creating a magical ambiance at your event.',
            'price' => 800,
            'image' => 'images/fairy_lights.jpg',
            'additional_info' => 'These lights come in warm white or colorful options and can be strung across your venue to create a dreamy effect.'
        ],
        'led_lights' => [
            'title' => 'LED Color Changing Lights',
            'description' => 'For a vibrant and dynamic atmosphere. Our LED lights can change colors to fit the mood of your event.',
            'price' => 1200,
            'image' => 'images/led_lights.jpg',
            'additional_info' => 'These lights are perfect for modern or high-energy events. They can be controlled remotely to set the perfect ambiance.'
        ]
    ];

    return isset($packages[$package]) ? $packages[$package] : null;
}

// Get the package from the URL parameter
$package = isset($_GET['package']) ? $_GET['package'] : '';

// Get the details for the selected package
$packageDetails = getPackageDetails($package);
if (!$packageDetails) {
    die('Package not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $packageDetails['title']; ?> - Ornate Occasions</title>
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

        .btn-custom {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-custom:hover {
            background-color: #e63900;
        }

        .package-description {
            margin-top: 30px;
        }

        .package-info {
            margin-top: 20px;
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
        <h2><?php echo $packageDetails['title']; ?></h2>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $packageDetails['image']; ?>" alt="<?php echo $packageDetails['title']; ?>">
            </div>
            <div class="col-md-6">
                <div class="package-description">
                    <h4>Description</h4>
                    <p><?php echo $packageDetails['description']; ?></p>
                </div>
                <div class="package-info">
                    <h4>Price</h4>
                    <p><strong>$<?php echo number_format($packageDetails['price'], 2); ?></strong></p>
                    <h4>Additional Information</h4>
                    <p><?php echo $packageDetails['additional_info']; ?></p>
                </div>
                <a href="booking_page.php?service=lighting&package=<?php echo $package; ?>" class="btn btn-custom">Book Now</a>
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
