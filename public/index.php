<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Restaurant Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero {
            background-image: url('https://zeew.eu/wp-content/uploads/2024/03/51951042270_78ea1e8590_h.7.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            height: 65vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero::before {
            content: "";
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .footer {
            background-color: #343a40;
            color: #ccc;
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
        }
    </style>
</head>

<!-- Scroll-to-top button -->
<button onclick="scrollToTop()" id="topBtn" class="btn btn-primary position-fixed" style="bottom: 20px; right: 20px; display: none;">
    <i class="bi bi-arrow-up"></i>
</button>

<script>
    // Show button on scroll
    window.onscroll = function() {
        document.getElementById("topBtn").style.display = window.scrollY > 200 ? "block" : "none";
    };

    // Scroll to top
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>


<body>

    <header class="bg-primary text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="mb-0">RestaurantMS</h2>
            <div>
                <a href="about.php" class="btn btn-outline-light me-2">About</a>
                <a href="register.php" class="btn btn-light me-2">Register</a>
                <a href="login.php" class="btn btn-warning me-2">Login</a>
                <a href="place_order.php" class="btn btn-success">Place Order</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Manage Your Restaurant Effortlessly</h1>
            <p class="lead">From table bookings to order tracking, everything simplified.</p>
        </div>
    </section>
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-4">Explore Our Features</h2>
        <div id="featureCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="images/kitchen.jpg" class="d-block w-100 rounded" alt="Kitchen Efficiency">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Smart Kitchen Workflow</h5>
                        <p>Seamlessly track food prep from start to finish.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="images/menu_management.jpg" class="d-block w-100 rounded" alt="Menu Management">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Live Menu Updates</h5>
                        <p>Update prices and items instantly from the dashboard.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="images/table_management.jpg" class="d-block w-100 rounded" alt="Table Management">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Table Reservation System</h5>
                        <p>Organize reservations and walk-ins like a pro.</p>
                    </div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#featureCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#featureCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>



    <section class="py-5 text-center">
        <div class="container">
            <h2 class="mb-4">Why Choose Our System?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <i class="bi bi-speedometer2 display-5 text-primary"></i>
                    <h5 class="mt-3">Fast Performance</h5>
                    <p>Instant updates on orders, menu, and table management.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-shield-check display-5 text-success"></i>
                    <h5 class="mt-3">Secure Access</h5>
                    <p>All user and order data is protected with best practices.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-people display-5 text-warning"></i>
                    <h5 class="mt-3">User Friendly</h5>
                    <p>Intuitive UI for both staff and managers to get things done easily.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h2 class="mb-4">Get Started Today!</h2>
            <p class="lead">Join hundreds of restaurants already using our system.</p>
            <a href="register.php" class="btn btn-primary btn-lg">Register Now</a>
        </div>
        <section class="bg-light py-5">
            <div class="container text-center">
                <h2 class="mb-5">What Our Users Say</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-4 bg-white shadow rounded">
                            <p>"This system has transformed how we manage our kitchen and orders!"</p>
                            <h6 class="mt-3">— Sarah, Restaurant Manager</h6>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white shadow rounded">
                            <p>"Simple, fast, and effective. Just what we needed."</p>
                            <h6 class="mt-3">— Ahmed, Chef</h6>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white shadow rounded">
                            <p>"User interface is so intuitive, even new staff learn it fast."</p>
                            <h6 class="mt-3">— James, Front Desk</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="mb-4">Contact Us</h2>
            <p>If you have any questions or need support, feel free to reach out!</p>
            <a href="contact.php" class="btn btn-secondary">Contact Support</a>
        </div>
    </section>


    <footer class="footer">
        <div class="container d-flex justify-content-between flex-wrap align-items-center">
            <p class="mb-0">&copy; 2024 RestaurantMS. All rights reserved.</p>
            <div>
                <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>