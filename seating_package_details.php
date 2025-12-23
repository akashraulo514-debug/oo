<?php
session_start();

// Retrieve the package name from the query string
$package = isset($_GET['package']) ? $_GET['package'] : '';

// Define package details
$packages = [
    'classic_draping' => [
        'name' => 'Classic Draping',
        'description' => 'Simplistic yet elegant, perfect for all types of events.',
        'price' => '$1,000',
        'details' => 'This package includes high-quality drapes that will complement any event, with a simple but refined look.',
        'image' => 'imge/classic_draping.jpg'
    ],
    'luxury_draping' => [
        'name' => 'Luxury Draping',
        'description' => 'Transform your event with opulent, luxurious fabric draping.',
        'price' => '$1,500',
        'details' => 'For an extravagant touch, this package offers rich, luxurious fabric draping that adds glamour to any event.',
        'image' => 'imge/luxury_draping.jpg'
    ],
    'event_seating' => [
        'name' => 'Complete Event Seating',
        'description' => 'Stunning and comfortable seating arrangements for large and small events.',
        'price' => '$2,000',
        'details' => 'This package provides comfortable and elegant seating, designed to fit any event size with a touch of sophistication.',
        'image' => 'imge/event_seating.jpg'
    ]
];

// Check if the package exists in the array
if (!array_key_exists($package, $packages)) {
    echo "Package not found.";
    exit;
}

$packageDetails = $packages[$package];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $packageDetails['name']; ?> - Ornate Occasions</title>
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
        <h2><?php echo $packageDetails['name']; ?></h2>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $packageDetails['image']; ?>" alt="<?php echo $packageDetails['name']; ?>">
            </div>
            <div class="col-md-6">
                <h4>Description</h4>
                <p><?php echo $packageDetails['description']; ?></p>
                <h4>Details</h4>
                <p><?php echo $packageDetails['details']; ?></p>
                <h4>Price</h4>
                <p><strong><?php echo $packageDetails['price']; ?></strong></p>
                <a href="booking_page.php?service=seating_and_draping&package=<?php echo $package; ?>" class="btn btn-custom">Book Now</a>
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
