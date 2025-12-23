<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Ornate Occasions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .service-section {
            padding: 60px 0;
        }

        .service-section h2 {
            color: #ff6b6b;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .service-card {
            background-color: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-card img {
            border-radius: 10px 10px 0 0;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service-card .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
        }

        .btn-custom {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-custom:hover {
            background-color: #e63900;
        }

        /* Initially hide the additional options */
        #additionalOptions {
            display: none;
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

<!-- Services Section -->
<section class="service-section">
    <div class="container">
        <h2>Our Services</h2>
        <div class="row">
            <!-- Luxurious Mandaps -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/43fb865b-9a46-45cc-996d-369ddf5b88c6~rs_768.jpg" alt="Luxurious Mandaps">
                    <div class="card-body">
                        <h4 class="card-title">Luxurious Mandaps</h4>
                        <p class="card-text">We create stunning mandaps that serve as the centerpiece of your special day. Choose from a variety of themes and styles tailored to your needs.</p>
                        <a href="mandap.php" class="btn btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Floral Decor -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/9666da66-1ab9-483d-bdea-b37aa0523f94~rs_768.jpg" alt="Floral Decor">
                    <div class="card-body">
                        <h4 class="card-title">Floral Decor</h4>
                        <p class="card-text">Transform your venue with breathtaking floral arrangements. From traditional to modern designs, we bring your vision to life.</p>
                        <a href="floral_decor.php" class="btn btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Lighting -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/wedding-event-lighting-checklist-min.jpg" alt="Lighting">
                    <div class="card-body">
                        <h4 class="card-title">Lighting</h4>
                        <p class="card-text">Set the perfect ambiance with our professional lighting solutions. From romantic to dramatic, we illuminate your moments.</p>
                        <a href="lighting.php" class="btn btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Seating & Draping -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/622b57cc5b53ba73a826a2d7_Design-Event-Seating-Chart.jpg" alt="Seating & Draping">
                    <div class="card-body">
                        <h4 class="card-title">Seating & Draping</h4>
                        <p class="card-text">Create a cozy and elegant atmosphere with our custom seating and draping solutions, tailored to fit your theme perfectly.</p>
                        <a href="seating_and_draping.php" class="btn btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Catering Services -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/catering-business-ideas-gallery-art-gala-1024x576.jpg" alt="Catering Services">
                    <div class="card-body">
                        <h4 class="card-title">Catering Services</h4>
                        <p class="card-text">Delight your guests with a wide array of delicious cuisines prepared by our expert chefs, ensuring a memorable dining experience.</p>
                        <a href="Catering Services.php" class="btn btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Photography & Videography -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/service-image-Photography.jpg" alt="Photography & Videography">
                    <div class="card-body">
                        <h4 class="card-title">Photography & Videography</h4>
                        <p class="card-text">Capture every special moment with our professional photography and videography services to create lasting memories.</p>
                        <a href="Photography & Videography .php" class="btn btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Entertainment -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/img13.jpg" alt="Entertainment">
                    <div class="card-body">
                        <h4 class="card-title">Entertainment</h4>
                        <p class="card-text">From live bands to DJs and cultural performances, we provide entertainment that keeps your guests engaged and happy.</p>
                        <a href="Entertainment.php" class="btn btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Additional Options -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card">
                    <img src="imge/2Ijt8kmWTJKG6RkoOOjF.jpg" alt="Event Forms">
                    <div class="card-body">
                        <h4 class="card-title">Event Options</h4>
                        <p class="card-text">Explore a variety of additional services tailored to enhance your events.</p>
                        <button id="toggleButton" class="btn btn-custom">Explore More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Options Section -->
<section id="additionalOptions" class="service-section bg-light">
    <div class="container">
        <h2>Additional Options</h2>
        <div class="list-group">
            <a href="mandap_shooting.php" class="list-group-item list-group-item-action">
                Mandap for Shooting
            </a>
            <a href="speaker_submission.php" class="list-group-item list-group-item-action">
                Speaker/Presenter Submission Form
            </a>
            <a href="sponsor_registration.php" class="list-group-item list-group-item-action">
                Sponsor Registration Form
            </a>
            <a href="health_safety.php" class="list-group-item list-group-item-action">
                Health and Safety Form
            </a>
            <a href="event_insurance.php" class="list-group-item list-group-item-action">
                Event Insurance Form
            </a>
            <a href="travel_accommodation.php" class="list-group-item list-group-item-action">
                Travel and Accommodation Form
            </a>
            <a href="post_event_survey.php" class="list-group-item list-group-item-action">
                Post-Event Survey Form
            </a>
            <a href="event_feedback.php" class="list-group-item list-group-item-action">
                Event Feedback Form
            </a>
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
    // Toggle the visibility of the Additional Options section
    document.getElementById('toggleButton').addEventListener('click', function() {
        var optionsSection = document.getElementById('additionalOptions');
        if (optionsSection.style.display === 'none' || optionsSection.style.display === '') {
            optionsSection.style.display = 'block';
            this.textContent = 'Explore Less'; // Change button text
        } else {
            optionsSection.style.display = 'none';
            this.textContent = 'Explore More'; // Reset button text
        }
    });
</script>
</body>
</html>
