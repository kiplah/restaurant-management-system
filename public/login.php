<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 100px;
        }
        .btn-register {
            background-color: #0070ba; /* PayPal's color */
            color: white;
        }
        .btn-register:hover {
            background-color: #005a8c; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <!-- Forgot Password Link -->
            <div class="text-center">
                <a href="reset_password.php">Forgot password? Reset it here</a>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
        </form>
        <p style="text-align: center;">Or</p>

        <div class="text-center mt-3">
            <a href="register.php" class="btn btn-register btn-block">Register</a>
        </div>
    </div>

    <?php
    // Start a session to store user information
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../includes/db.php'; // Include database connection

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare a statement to find the user by email
        $stmt = $pdo->prepare("SELECT user_id, password, role FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user information in session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];
                echo "Login successful! Welcome, " . htmlspecialchars($email) . ".";
                // Redirect to another page (e.g., dashboard)
                header("Location: dashboard.php"); // Uncomment to redirect
                exit;
            } else {
                echo "<div class='alert alert-danger'>Invalid password!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>User not found! Please <a href='register.php'>register</a>.</div>";
        }
    }
    ?>
</body>
</html>
