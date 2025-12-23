<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo Section -->
        <a class="navbar-brand" href="index.php">
            <h3>Ornate Occasions</h3>
        </a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Home Link -->
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <!-- Services Link -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="mandap.php">Luxurious Mandaps</a>
                        <a class="dropdown-item" href="floral_decor.php">Floral Decor</a>
                        <a class="dropdown-item" href="lighting.php">Lighting</a>
                        <a class="dropdown-item" href="seating.php">Seating & Draping</a>
                        <a class="dropdown-item" href="catering.php">Catering Services</a>
                        <a class="dropdown-item" href="photography.php">Photography & Videography</a>
                        <a class="dropdown-item" href="entertainment.php">Entertainment</a>
                    </div>
                </li>

                

                <!-- About Us Link -->
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>

                <!-- Contact Us Link -->
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
