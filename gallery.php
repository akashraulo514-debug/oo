<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandap Decoration Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #ff6b6b;
            color: white;
            padding: 40px 20px;
            text-align: center;
            background-image: url('images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        header h1 {
            font-size: 48px;
            margin: 0;
        }

        header p {
            font-size: 20px;
            margin-top: 10px;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .filters select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 180px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }

        .gallery-item {
            position: relative;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 300px;
            height: 450px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #f1f1f1;
        }

        .gallery-item h3 {
            margin: 10px 0;
            font-size: 18px;
            line-height: 1.2;
            font-weight: bold;
            color: #333;
        }

        .gallery-item p {
            color: #555;
            font-size: 14px;
            margin: 5px 0;
        }

        .gallery-item .price {
            font-size: 16px;
            font-weight: bold;
            color: #ff6b6b;
            margin: 10px 0;
        }

        .gallery-item button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 5px 0;
        }

        .gallery-item button:hover {
            background-color: #e15555;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            text-align: center;
            position: relative;
        }

        .modal-content img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        .modal-content .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <h1>Mandap Decoration Gallery</h1>
    <p>Find the perfect decoration for your special occasion!</p>
</header>

<div class="filters">
    <select id="theme-filter">
        <option value="">All Themes</option>
        <option value="traditional">Traditional</option>
        <option value="modern">Modern</option>
        <option value="royal">Royal</option>
        <option value="floral">Floral</option>
    </select>
</div>

<div class="gallery" id="gallery">
    <?php
    include("php/config.php"); // Database connection file

    // Fetching all mandap designs
    $query = "SELECT id, design_name AS name, image_url AS image, description, theme, price FROM mandap_designs";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Ensure keys exist to prevent warnings
            $image = isset($row['image']) ? $row['image'] : 'default_image.jpg';
            $name = isset($row['name']) ? $row['name'] : 'Design Name';
            $description = isset($row['description']) ? $row['description'] : 'Description not available';
            $theme = isset($row['theme']) ? $row['theme'] : 'Unknown Theme';
            $price = isset($row['price']) ? $row['price'] : 'N/A';

            echo "
            <div class='gallery-item' data-theme='$theme'>
                <img src='images/$image' alt='$name'>
                <h3>$name</h3>
                <p>$description</p>
                <p class='price'>Price: $$price</p>
                <button class='view-details' data-id='{$row['id']}'>View Details</button>
                <form action='booking.php' method='GET' style='margin-top: 10px;'>
                    <input type='hidden' name='design' value='$name'>
                    <button type='submit'>Select and Book</button>
                </form>
            </div>
            ";
        }
    } else {
        echo "<p>No mandap designs found!</p>";
    }
    ?>
</div>

<footer>
    <p>&copy; 2025 Ornate Occasions. All Rights Reserved.</p>
</footer>

<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="modal-image" src="" alt="Design Image">
        <h3 id="modal-title"></h3>
        <p id="modal-description"></p>
    </div>
</div>

<script>
    // Modal functionality
    const modal = document.getElementById('modal');
    const closeModal = document.querySelector('.close');

    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', () => {
            const item = button.closest('.gallery-item');
            const imageSrc = item.querySelector('img').src;
            const title = item.querySelector('h3').textContent;
            const description = item.querySelector('p').textContent;

            document.getElementById('modal-image').src = imageSrc;
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-description').textContent = description;

            modal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Filter functionality
    const filters = document.querySelectorAll('.filters select');
    filters.forEach(filter => {
        filter.addEventListener('input', () => {
            const theme = document.getElementById('theme-filter').value.toLowerCase();

            document.querySelectorAll('.gallery-item').forEach(item => {
                const itemTheme = item.getAttribute('data-theme').toLowerCase();

                const matchesTheme = !theme || itemTheme === theme;

                item.style.display = matchesTheme ? 'block' : 'none';
            });
        });
    });
</script>

</body>
</html>
