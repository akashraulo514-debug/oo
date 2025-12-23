<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Vendor Availability</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header {
            background-color: #FF7F50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
        }
        input, select, button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #FF7F50;
            color: white;
            cursor: pointer;
            font-size: 18px;
        }
        button:hover {
            background-color: #FF6A33;
        }
        .message {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #D4EDDA;
            color: #155724;
            border: 1px solid #C3E6CB;
        }
        .error {
            background-color: #F8D7DA;
            color: #721C24;
            border: 1px solid #F5C6CB;
        }
    </style>
</head>
<body>

<header>
    <h1>Check Vendor Availability</h1>
</header>

<div class="container">
    <form action="check_availability.php" method="POST">
        <label for="service">Select Service:</label>
        <select id="service" name="service" required>
            <option value="">Select Service</option>
            <option value="Lighting">Lighting</option>
            <option value="Catering">Catering</option>
            <option value="Decoration">Decoration</option>
        </select>

        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" required>

        <button type="submit">Check Availability</button>
    </form>

    <!-- Display the result (Availability message) -->
    <?php if (isset($_GET['message'])): ?>
        <div class="message <?php echo htmlspecialchars($_GET['status']); ?>">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php endif; ?>
</div>

<footer>
    <p style="text-align: center; padding: 10px; background-color: #333; color: white;">&copy; 2025 Ornate Occasions. All Rights Reserved.</p>
</footer>

</body>
</html>
