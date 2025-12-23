<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Ornate Occasions</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #FF6B6B;
            color: white;
            text-align: center;
            padding: 50px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            font-size: 48px;
            font-weight: 600;
            margin: 0;
        }
        header p {
            font-size: 20px;
            margin-top: 10px;
        }
        section {
            padding: 70px 20px;
            max-width: 1200px;
            margin: auto;
        }
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        .core-values {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .core-value {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 32%;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .core-value:hover {
            transform: translateY(-10px);
        }
        .core-value h3 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #FF6B6B;
        }
        .core-value p {
            font-size: 16px;
            color: #555;
        }
        .team-section {
            display: flex;
            justify-content: center;
            margin-top: 60px;
            flex-wrap: wrap;
        }
        .team-member {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 20px 30px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .team-member:hover {
            transform: translateY(-10px);
        }
        .team-member img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .team-member h3 {
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }
        .team-member p {
            font-size: 16px;
            color: #777;
        }
        .testimonials {
            margin-top: 60px;
            background-color: #FF6B6B;
            color: white;
            padding: 50px 20px;
            text-align: center;
            border-radius: 8px;
        }
        .testimonials h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .testimonials p {
            font-size: 18px;
            font-style: italic;
            color: #ffdddd;
        }
        .cta {
            text-align: center;
            margin-top: 50px;
        }
        .cta h2 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        .cta button {
            background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 20px 40px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }
        .cta button:hover {
            background-color: #e15555;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>About Us</h1>
    <p>Your trusted partner in creating unforgettable events.</p>
</header>

<section>
    <h2>Our Mission</h2>
    <p>At Ornate Occasions, our mission is to transform every event into a timeless celebration. We specialize in crafting unique and stylish event decor that brings your vision to life. Whether it's a wedding, corporate event, or private party, we create unforgettable moments that exceed expectations.</p>
    
    <h2>Core Values</h2>
    <div class="core-values">
        <div class="core-value">
            <h3>Excellence</h3>
            <p>We believe in the pursuit of excellence in every project, from design to execution.</p>
        </div>
        <div class="core-value">
            <h3>Customer Satisfaction</h3>
            <p>Your satisfaction is our top priority. We listen to your needs and deliver what you envision.</p>
        </div>
        <div class="core-value">
            <h3>Innovation</h3>
            <p>We continuously innovate our designs to stay ahead of trends and offer fresh ideas.</p>
        </div>
    </div>
    
    <h2>Our Story</h2>
    <p>Founded in 2010, Ornate Occasions began with a simple idea: to provide event decor that would leave lasting impressions. What started as a small local business has grown into a trusted name in the industry, serving hundreds of clients every year.</p>
    
    <h2>Meet Our Team</h2>
    <div class="team-section">
        <div class="team-member">
            <img src="team_member_1.jpg" alt="Team Member 1">
            <h3>John Doe</h3>
            <p>Creative Director</p>
            <p>John is the visionary behind our stunning event designs and leads the creative team.</p>
        </div>
        <div class="team-member">
            <img src="team_member_2.jpg" alt="Team Member 2">
            <h3>Jane Smith</h3>
            <p>Lead Event Planner</p>
            <p>Jane brings over 10 years of experience in planning events and ensuring every detail is perfect.</p>
        </div>
        <div class="team-member">
            <img src="team_member_3.jpg" alt="Team Member 3">
            <h3>Michael Lee</h3>
            <p>Operations Manager</p>
            <p>Michael handles logistics and ensures everything runs smoothly on event day.</p>
        </div>
    </div>

    <h2>What Our Clients Say</h2>
    <div class="testimonials">
        <h2>Client Testimonials</h2>
        <p>"Ornate Occasions made our wedding unforgettable! Their attention to detail and creativity exceeded our expectations." - Sarah & Tom</p>
        <p>"The team at Ornate Occasions designed a beautiful corporate event for us. We couldn't be more pleased with the results!" - XYZ Corp.</p>
    </div>
    
    <div class="cta">
        <h2>Ready to Make Your Event Unforgettable?</h2>
        <button onclick="window.location.href='contact.php'">Contact Us Today</button>
    </div>
</section>

<footer>
    <p>&copy; 2025 Ornate Occasions. All Rights Reserved.</p>
</footer>

</body>
</html>
