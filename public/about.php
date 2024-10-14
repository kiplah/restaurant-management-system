<!-- about.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            background-image: url('https://media.istockphoto.com/id/1339827092/photo/happy-waitress-serving-food-to-a-couple-at-a-restaurant.jpg?s=612x612&w=0&k=20&c=XevKkQP84Xk5bZ6QA0-eVCVMg3wRj_8LiAEhMNVweU0=');
            background-size: cover; /* Makes sure the background covers the entire area */
            background-position: center; /* Centers the image */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensures the footer sticks to the bottom */
            position: relative;
        }

        /* Overlay to darken background */
        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            z-index: 1;
        }

        .header, .content, .footer {
            position: relative;
            z-index: 2; /* Ensures content is above the overlay */
        }

        .header {
            background-color: rgba(0, 112, 186, 0.8); /* Slightly transparent background for header */
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .content {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            text-align: center; /* Ensure text alignment is centered */
            min-height: calc(100vh - 140px); /* Adjust height to center content */
            padding: 120px;
            color: white; /* Ensures content is readable on dark overlay */
            font-size: large;
        }

        .button-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .footer {
            background-color: rgba(241, 241, 241, 0.9); /* Slightly transparent background for footer */
            padding: 20px 0;
            position: relative; /* Ensures it can be positioned */
            margin-top: auto; /* Pushes footer to the bottom */
        }

        .footer-links {
            display: flex;
            align-items: center;
        }

        .footer-links a {
            margin-right: 15px; /* Space between links */
        }
    </style>
</head>
<body>

    <!-- Background overlay -->
    <div class="background-overlay"></div>

    <header class="header">
        <h1>About Us</h1>
        <div class="button-container">
            <a href="index.php" class="btn btn-light">Home</a>
            <a href="contact.php" class="btn btn-light">Contact Us</a>
        </div>
    </header>

    <div class="content">
        <h2>Welcome to Our Restaurant Management System</h2>
        <p>We are dedicated to providing the best management solutions for restaurants. Our system simplifies the operations, allowing you to focus on what matters most - serving your customers.</p>
        <p>Our mission is to enhance your restaurant's efficiency through innovative technology and exceptional service.</p>
    </div>

    <footer class="footer">
        <div class="container d-flex justify-content-between align-items-center">
            <p class="mb-0">&copy; 2024 Restaurant Management System. All rights reserved.</p>
            <div class="footer-links d-flex">
                <a href="#" class="text-secondary">Need Help?</a>
                <p class="mb-0">Follow Us: 
                    <a href="#" class="text-secondary"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-instagram"></i></a>
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
