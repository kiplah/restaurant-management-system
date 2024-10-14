<!-- reset_password.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f6f7f8;
        }
        .container {
            max-width: 400px;
            margin-top: 100px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="reset_password.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include '../includes/db.php'; // Include database connection

            $email = $_POST['email'];

            // Check if the email exists
            $stmt = $pdo->prepare("SELECT user_id FROM Users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user) {
                // Generate a reset token
                $token = bin2hex(random_bytes(16));
                $stmt = $pdo->prepare("INSERT INTO PasswordResetTokens (user_id, token) VALUES (?, ?)");
                $stmt->execute([$user['user_id'], $token]);

                // Prepare reset link
                $reset_link = "http://yourdomain.com/reset_token.php?token=$token";

                // Send email (assuming mail setup is correctly configured)
                $to = $email;
                $subject = "Password Reset Request";
                $message = "To reset your password, please click the following link: $reset_link";
                mail($to, $subject, $message);

                echo "<div class='alert alert-success mt-3'>A password reset link has been sent to your email.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>No account found with that email address.</div>";
            }
        }
        ?>

        <div class="footer">
            <p> <a href="login.php">Log in</a></p>
        </div>
    </div>
</body>
</html>
