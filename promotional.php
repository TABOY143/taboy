<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student System</title>
    
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .cta-button {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #0056b3;
        }

        .features, .testimonials, .contact {
            padding: 50px 0;
            text-align: center;
        }

        .features h2, .testimonials h2, .contact h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .feature-item, .testimonial-item {
            margin: 20px;
            display: inline-block;
            width: 250px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .feature-item h3, .testimonial-item h3 {
            color: #333;
            font-size: 1.5em;
        }

        .feature-item p, .testimonial-item p {
            color: #777;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>Welcome to the Student System</h1>
        <p>Manage your students, courses, and records with ease.</p>
        <a href="login.php" class="cta-button">Get Started</a>
    </header>

    <!-- Features Section -->
    <div class="features">
        <h2>Features</h2>
        <div class="feature-item">
            <h3>Student Records</h3>
            <p>Manage and view student records, including contact information, courses, and more.</p>
        </div>
        <div class="feature-item">
            <h3>Course Management</h3>
            <p>Easily manage and track courses for your students, including grades and progress.</p>
        </div>
        <div class="feature-item">
            <h3>Teacher Dashboard</h3>
            <p>Access a personalized dashboard to view student data, reports, and more.</p>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials">
        <h2>What Our Users Say</h2>
        <div class="testimonial-item">
            <h3>John Doe</h3>
            <p>"The Student System has made it so easy to manage my students and keep track of their progress. Highly recommend!"</p>
        </div>
        <div class="testimonial-item">
            <h3>Jane Smith</h3>
            <p>"I love how intuitive the system is. It's saved me so much time in organizing my classes and students."</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact">
        <h2>Contact Us</h2>
        <p>Have questions or need support? Get in touch with us today!</p>
        <a href="contact.php" class="cta-button">Contact Us</a>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Student System. All rights reserved.</p>
    </footer>

</body>
</html>
