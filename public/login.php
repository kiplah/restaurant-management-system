<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
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
                echo "Invalid password!";
            }
        } else {
            echo "User not found!";
        }
    }
    ?>
</body>
</html>
