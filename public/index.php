<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .header {
            background-color: #0070ba;
            color: white;
            padding: 20px 0;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 20px 0;
            text-align: center;
        }
        .btn-custom {
            margin: 5px;
            padding: 10px 25px;
            font-size: 16px;
        }
        .hero {
            position: relative;
            height: 60vh; /* Adjust height as needed */
            background-image: url('https://zeew.eu/wp-content/uploads/2024/03/51951042270_78ea1e8590_h.7.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Black with 50% opacity */
            z-index: 1; /* Ensure it's behind the text */
        }
        .hero h2,
        .hero p {
            position: relative; /* Bring text above the overlay */
            z-index: 2; /* Ensure text is above the overlay */
            text-align: center;
        }
        .about-us {
            margin-top: 20px;
            font-size: 18px;
        }
        .button-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }
        .button-container a {
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>Restaurant Management System</h1>
            <div class="button-container">
                <a href="about.php" class="btn btn-light">About Us</a>
                <a href="register.php" class="btn btn-primary btn-custom">Register</a>
                <a href="login.php" class="btn btn-secondary btn-custom">Login</a>
                <a href="place_order.php" class="btn btn-success btn-custom">Place Order</a>
            </div>
        </div>
    </header>

    <div class="hero">
        <div class="container">
            <h2>Welcome to Our Restaurant Management System</h2>
            <p class="about-us">Efficiently manage your restaurant operations, from order processing to customer management.</p>
        </div>
    </div>

    <footer class="footer">
        <div class="container d-flex justify-content-between align-items-center">
            <p class="mb-0">&copy; 2024 Restaurant Management System. All rights reserved.</p>
            <div class="footer-links d-flex">
                <a href="#" class="text-secondary mx-2">Contact Us</a>
                <a href="#" class="text-secondary mx-2">Need Help?</a>
                <p class="mb-0 mx-2">Follow Us: 
                    <a href="#" class="text-secondary"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-instagram"></i></a>
                </p>
            </div>
        </div>
    </footer>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensures the footer sticks to the bottom */
        }

        .footer {
            background-color: #f1f1f1; /* Optional: change footer background color */
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

</body>
</html>
